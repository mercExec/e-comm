<?php

namespace App\Http\Controllers;

use App\Models\CartProduct;
use App\Models\Order;
use App\Models\OrderProduct;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Stripe\StripeClient;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $userId = $request->user()->id;
        $cartProducts = \json_decode($request->cartProducts);
        $lineItems = [];
        $totalPrice = 0;
        $orderProducts = [];

        foreach ($cartProducts as $cartProduct) {
            $quantity = $cartProduct->quantity;
            $totalPrice += $cartProduct->product->price * $cartProduct->quantity;
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $cartProduct->product->title,
                    ],
                    'unit_amount' => $cartProduct->product->price * 100,
                ],
                'quantity' => $quantity,
            ];

            $orderProducts[] = [
                'product_id' => $cartProduct->product_id,
                'quantity' => $cartProduct->quantity,
            ];
        }

        $stripe = new StripeClient(env('VITE_STRIPE_SECRET'));

        $stripeSession = $stripe->checkout->sessions->create([
            'success_url' => URL::to('/') . '/checkout/success?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => URL::to('/') . '/checkout/failure',
            'line_items' => $lineItems,
            'mode' => 'payment',
        ]);

        $orderData = [
            'user_id' => $userId,
            'transaction_id' => $stripeSession->id,
            'status' => Order::PENDING,
            'total' => $totalPrice
        ];

        // Create Order
        $order = Order::create($orderData);

        // Create Order Items
        foreach ($orderProducts as $orderProduct) {
            $orderProduct['order_id'] = $order->id;
            OrderProduct::create($orderProduct);
        }

        CartProduct::where(['user_id' => $userId])->delete();

        return response()->json($stripeSession->url);
    }

    public function success(Request $request)
    {
        try {
            $stripe = new StripeClient(env('VITE_STRIPE_SECRET'));
            $sessionId = $request->input('session_id');
            $session = $stripe->checkout->sessions->retrieve($sessionId);

            if (!$session) {
                return response()->json(['error' => 'No stripe session found'], 500);
            }

            $order = Order::where(['transaction_id' => $sessionId])->whereIn('status', [Order::PENDING, Order::COMPLETED])->first();

            if (!$order) {
                return throw new NotFoundHttpException();
            }

            if ($order->status == Order::PENDING) {
                $this->updateOrderAndSession($order);
            }

            return $session;
        } catch (NotFoundHttpException $e) {
            return response()->json($e->getMessage(), 500);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function failure(Request $request)
    {
        return response()->json(['error' => 'Stripe payment failed'], 500);
    }

    public function checkoutOrder(Request $request, Order $order)
    {
        $lineItems = [];

        foreach ($order->orderProducts as $orderProduct) {
            $quantity = $orderProduct->quantity;
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $orderProduct->product->title,
                    ],
                    'unit_amount' => $orderProduct->product->price * 100,
                ],
                'quantity' => $quantity,
            ];
        }

        $stripe = new StripeClient(env('VITE_STRIPE_SECRET'));

        $stripeSession = $stripe->checkout->sessions->create([
            'success_url' => URL::to('/') . '/checkout/success?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => URL::to('/') . '/checkout/failure',
            'line_items' => $lineItems,
            'mode' => 'payment',
        ]);

        $order->transaction_id = $stripeSession->id;
        $order->save();

        return response()->json($stripeSession->url);
    }

    public function webhook()
    {
        $stripe = new StripeClient(env('VITE_STRIPE_SECRET'));

        $endpoint_secret = env('VITE_STRIPE_ENDPOINT_SECRET');

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            return response()->json('', 401);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response()->json('', 402);
        }

        // Handle the event
        switch ($event->type) {
            case 'checkout.session.completed':
                $paymentIntent = $event->data->object;
                $sessionId = $paymentIntent['id'];

                $order = Order::where(['transaction_id' => $sessionId, 'status' => Order::PENDING])->first();

                if ($order) {
                    $this->updateOrderAndSession($order);
                }


                // ... handle other event types
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        return response()->json('', 200);
    }

    private function updateOrderAndSession(Order $order)
    {
        $order->status = Order::COMPLETED;
        $order->update();
    }
}
