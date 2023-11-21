<template>

    <aside id="sidebar"
        class="fixed top-0 left-0 z-20 flex-col flex-shrink-0 w-64 h-full  font-normal duration-75 lg:flex hidden transition-width"
        aria-label="Sidebar">
        <div
            class="relative flex flex-col flex-1 min-h-0 pt-0 bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
                <div class="block px-3 space-y-1 bg-white dark:bg-gray-800 ">
                    <div class="flex max-w-full px-4 items-center justify-center w-full">
                        <router-link :to="{ name: 'home' }" class="block  py-5 lg:py-3">
                            <img :src="$storage + '/logo.png'" alt="logo" class="w-20 h-16">
                        </router-link>
                    </div>

                    <ul class="pb-2 space-y-2">
                        <li>
                            <router-link :to="{ name: 'admin.orders' }"
                                class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                                <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="800px" height="800px"
                                    viewBox="0 0 503.379 503.379" xml:space="preserve">
                                    <g>
                                        <path
                                            d="M458.091,128.116v326.842c0,26.698-21.723,48.421-48.422,48.421h-220.92c-26.699,0-48.421-21.723-48.421-48.421V242.439   c6.907,1.149,13.953,1.894,21.184,1.894c5.128,0,10.161-0.381,15.132-0.969v211.594c0,6.673,5.429,12.104,12.105,12.104h220.92   c6.674,0,12.105-5.432,12.105-12.104V128.116c0-6.676-5.432-12.105-12.105-12.105H289.835c0-12.625-1.897-24.793-5.297-36.315   h125.131C436.368,79.695,458.091,101.417,458.091,128.116z M159.49,228.401c-62.973,0-114.202-51.229-114.202-114.199   C45.289,51.229,96.517,0,159.49,0c62.971,0,114.202,51.229,114.202,114.202C273.692,177.172,222.461,228.401,159.49,228.401z    M159.49,204.19c49.618,0,89.989-40.364,89.989-89.988c0-49.627-40.365-89.991-89.989-89.991   c-49.626,0-89.991,40.364-89.991,89.991C69.499,163.826,109.87,204.19,159.49,204.19z M227.981,126.308   c6.682,0,12.105-5.423,12.105-12.105s-5.423-12.105-12.105-12.105h-56.386v-47.52c0-6.682-5.423-12.105-12.105-12.105   s-12.105,5.423-12.105,12.105v59.625c0,6.682,5.423,12.105,12.105,12.105H227.981z M367.697,224.456h-131.14   c-6.682,0-12.105,5.423-12.105,12.105c0,6.683,5.423,12.105,12.105,12.105h131.14c6.685,0,12.105-5.423,12.105-12.105   C379.803,229.879,374.382,224.456,367.697,224.456z M367.91,297.885h-131.14c-6.682,0-12.105,5.42-12.105,12.105   s5.423,12.105,12.105,12.105h131.14c6.685,0,12.104-5.42,12.104-12.105S374.601,297.885,367.91,297.885z M367.91,374.353h-131.14   c-6.682,0-12.105,5.426-12.105,12.105c0,6.685,5.423,12.104,12.105,12.104h131.14c6.685,0,12.104-5.42,12.104-12.104   C380.015,379.778,374.601,374.353,367.91,374.353z" />
                                    </g>
                                </svg> <span class="ml-3" sidebar-toggle-item>Orders</span>
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'admin.users' }"
                                class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                                <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                                    xmlns="http://www.w3.org/2000/svg" height="1em"
                                    viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                    <path
                                        d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192h42.7c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0H21.3C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7h42.7C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3H405.3zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352H378.7C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7H154.7c-14.7 0-26.7-11.9-26.7-26.7z" />
                                </svg>
                                <span class="ml-3" sidebar-toggle-item>Users</span>
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'admin.productsIndex' }"
                                class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                                <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" viewBox="0 0 512 512" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="icon" fill="#000000" transform="translate(42.666667, 41.600000)">
                                            <path
                                                d="M85.334,107.733 L85.335,150.399 L42.6666667,150.4 L42.6666667,342.4 L175.702784,342.4 L192,350.539 L192,250.91 L202.665434,256.831437 L213.331989,262.740708 L223.998544,256.831437 L234.666,250.909 L234.666,350.539 L250.963883,342.4 L384,342.4 L384,150.4 L341.332,150.399 L341.331,107.733 L426.666667,107.733333 L426.666667,385.066667 L261.013333,385.066667 L213.333333,408.918058 L165.632,385.066667 L3.55271368e-14,385.066667 L3.55271368e-14,107.733333 L85.334,107.733 Z M362.666667,278.4 L362.666667,310.4 L256,310.4 L256,278.4 L362.666667,278.4 Z M170.666667,278.4 L170.666667,310.4 L64,310.4 L64,278.4 L170.666667,278.4 Z M362.666667,214.4 L362.666667,246.4 L256,246.4 L256,239.065 L300.43,214.399 L362.666667,214.4 Z M126.237,214.399 L170.666,239.065 L170.666667,246.4 L64,246.4 L64,214.4 L126.237,214.399 Z M213.333333,7.10542736e-15 L320,59.2604278 L320,177.780929 L213.333333,237.041357 L106.666667,177.780929 L106.666667,59.2604278 L213.333333,7.10542736e-15 Z M170.666667,107.370667 L170.666667,188.928 L192,200.789333 L192,119.232 L170.666667,107.370667 Z M128,83.6693333 L128,165.226723 L149.333333,177.088 L149.333333,95.5306667 L128,83.6693333 Z M256.768,48.5333333 L182.037333,89.28 L202.346667,100.565333 L276.373333,59.4133333 L256.768,48.5333333 Z M213.333333,24.4053901 L139.306667,65.536 L159.957333,77.0133333 L234.688,36.2666667 L213.333333,24.4053901 Z"
                                                id="Path-2">

                                            </path>
                                        </g>
                                    </g>
                                </svg>
                                <span class="ml-3" sidebar-toggle-item>Products</span>
                            </router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </aside>

    <div class="fixed inset-0 z-10 hidden bg-gray-900/50 dark:bg-gray-900/90" id="sidebarBackdrop"></div>
</template>

<script setup>

</script>

<style></style>