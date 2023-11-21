<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUsers()
    {
        return response()->json(User::latest()->paginate(10));
    }

    public function destroy(User $user)
    {
        $user->delete();
        
        return response()->json('User deleted successfully');
    }

}
