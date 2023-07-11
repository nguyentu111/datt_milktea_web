<div>
    <!-- Sidebar backdrop (mobile only) -->
    <div class="fixed inset-0 bg-slate-900 bg-opacity-30 z-40 lg:hidden lg:z-auto transition-opacity duration-200" :class="sidebarOpen ? 'opacity-100' : 'opacity-0 pointer-events-none'" aria-hidden="true" x-cloak></div>

    <!-- Sidebar -->
    <div id="sidebar" class="flex flex-col absolute z-40 left-0 top-0 lg:static lg:left-auto lg:top-auto lg:translate-x-0 h-screen overflow-y-scroll lg:overflow-y-auto no-scrollbar w-64 lg:w-20 lg:sidebar-expanded:!w-64 2xl:!w-64 shrink-0 bg-slate-800 p-4 transition-all duration-200 ease-in-out" :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64'" @click.outside="sidebarOpen = false" @keydown.escape.window="sidebarOpen = false" x-cloak="lg">
        <!-- Sidebar header -->
        <div class="flex justify-between mb-10 pr-3 sm:px-2">
            <!-- Close button -->
            <button class="lg:hidden text-slate-500 hover:text-slate-400" @click.stop="sidebarOpen = !sidebarOpen" aria-controls="sidebar" :aria-expanded="sidebarOpen">
                <span class="sr-only">Close sidebar</span>
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.7 18.7l1.4-1.4L7.8 13H20v-2H7.8l4.3-4.3-1.4-1.4L4 12z" />
                </svg>
            </button>

        </div>
        <!-- Links -->
        <div class="space-y-8">
            <!-- Pages group -->
            <div>
                <ul class="mt-3">
                    <li class="px-3 py-2 hover:bg-slate-600 rounded-sm mb-0.5 last:mb-0 @if(Route::is('home.index')){{ 'bg-slate-900' }}@endif">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150" href="{{ route('home.index') }}">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                    </svg> -->
                                    <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">{{ __('Home') }}</span>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-9 mt-1" :class="open ? '!block' : 'hidden'">

                            </ul>
                        </div>
                    </li>
                    @if(Auth::user()->isAdmin())
                    <li class="px-3 py-2 hover:bg-slate-600 rounded-sm mb-0.5 last:mb-0 @if(Route::is('staffs.index')){{ 'bg-slate-900' }}@endif">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150" href="{{ route('staffs.index') }}">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                    </svg> -->

                                    <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">{{ __('Staff') }}</span>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-9 mt-1" :class="open ? '!block' : 'hidden'">

                            </ul>
                        </div>
                    </li>
                    <li class="px-3 py-2 hover:bg-slate-600 rounded-sm mb-0.5 last:mb-0 @if(Route::is('branches.index')){{ 'bg-slate-900' }}@endif">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150" href="{{ route('branches.index') }}">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <!-- <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M0 0h24v24H0V0z" fill="none"></path>
                                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zM7 9c0-2.76 2.24-5 5-5s5 2.24 5 5c0 2.88-2.88 7.19-5 9.88C9.92 16.21 7 11.85 7 9z"></path>
                                        <circle cx="12" cy="9" r="2.5"></circle>
                                    </svg> -->

                                    <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">{{ __('Branch') }}</span>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-9 mt-1" :class="open ? '!block' : 'hidden'">

                            </ul>
                        </div>
                    </li>
                    @endif

                    @if(Auth::user()->staff->isBusinessManager())
                    <li class="px-3 py-2 hover:bg-slate-600 rounded-sm mb-0.5 last:mb-0 @if(Route::is('taxes.index')){{ 'bg-slate-900' }}@endif">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150" href="{{ route('taxes.index') }}">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">

                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" class="w-6 h-6" fill="currentColor">
                                        <path d="M 18 2 A 5 5 0 0 0 13 7 L 13 53 L 7 53 A 1 1 0 0 0 6 54 L 6 57 A 5 5 0 0 0 11 62 L 43 62 A 5 5 0 0 0 48 57 L 48 54 A 1 1 0 0 0 47 53 A 1 1 0 0 0 46 54 L 46 57 A 3 3 0 0 1 40 57 L 40 54 A 1 1 0 0 0 39 53 L 15 53 L 15 7 A 3 3 0 0 1 18 4 L 47 4 A 4.92 4.92 0 0 0 46 7 L 46 26 A 1 1 0 0 0 48 26 L 48 15 L 55 15 A 1 1 0 0 0 56 14 L 56 7 A 5 5 0 0 0 51 2 L 18 2 z M 51.087891 4.0019531 A 3 3 0 0 1 54 7 L 54 13 L 48 13 L 48 7 A 3 3 0 0 1 51.087891 4.0019531 z M 41.990234 10.994141 A 1 1 0 0 0 41.289062 11.289062 L 39 13.589844 L 36.710938 11.289062 A 1.0040916 1.0040916 0 0 0 35.289062 12.710938 L 37.589844 15 L 35.289062 17.289062 A 1 1 0 0 0 35.289062 18.710938 A 1 1 0 0 0 36.710938 18.710938 L 39 16.410156 L 41.289062 18.710938 A 1 1 0 0 0 42.710938 18.710938 A 1 1 0 0 0 42.710938 17.289062 L 40.410156 15 L 42.710938 12.710938 A 1 1 0 0 0 42.710938 11.289062 A 1 1 0 0 0 41.990234 10.994141 z M 19 11 A 1 1 0 0 0 19 13 L 21 13 L 21 18 A 1 1 0 0 0 22 19 A 1 1 0 0 0 23 18 L 23 13 L 25 13 A 1 1 0 0 0 25 11 L 19 11 z M 29.998047 11.005859 A 1 1 0 0 0 29.109375 11.550781 L 26.109375 17.550781 A 1 1 0 0 0 27.890625 18.449219 L 28.119141 18 L 31.880859 18 L 32.109375 18.449219 A 1 1 0 0 0 33 19 A 0.93 0.93 0 0 0 33.449219 18.890625 A 1 1 0 0 0 33.890625 17.550781 L 30.890625 11.550781 A 1 1 0 0 0 29.998047 11.005859 z M 30 14.240234 L 30.880859 16 L 29.119141 16 L 30 14.240234 z M 26 23 A 1 1 0 0 0 26 25 L 42 25 A 1 1 0 0 0 43 24 A 1 1 0 0 0 42 23 L 26 23 z M 20 28 A 1 1 0 0 0 20 30 L 35 30 A 1 1 0 0 0 35 28 L 20 28 z M 47 29 A 10.9 10.9 0 0 0 40.939453 30.830078 A 1 1 0 1 0 42 32.490234 A 9 9 0 1 1 39.490234 35 A 1 1 0 1 0 37.830078 33.900391 A 10.9 10.9 0 0 0 36 40 A 11 11 0 1 0 47 29 z M 46.970703 32 A 1 1 0 0 0 46 33 L 46 34.160156 A 3.49 3.49 0 0 0 47 41 A 1.5 1.5 0 0 1 47 44 A 1.5 1.5 0 0 1 45.5 42.5 A 1 1 0 0 0 43.5 42.5 A 3.5 3.5 0 0 0 46 45.839844 L 46 47 A 1 1 0 0 0 48 47 L 48 45.839844 A 3.49 3.49 0 0 0 47 39 A 1.5 1.5 0 1 1 48.5 37.5 A 1 1 0 0 0 50.5 37.5 A 3.5 3.5 0 0 0 48 34.160156 L 48 33 A 1 1 0 0 0 46.970703 32 z M 20 33 A 1 1 0 0 0 20 35 L 26 35 A 1 1 0 0 0 26 33 L 20 33 z M 30 33 A 1 1 0 0 0 30 35 L 33 35 A 1 1 0 0 0 33 33 L 30 33 z M 20 38 A 1 1 0 0 0 19 39 A 1 1 0 0 0 20 40 L 32 40 A 1 1 0 0 0 32 38 L 20 38 z M 23 43 A 1 1 0 0 0 23 45 L 32 45 A 1 1 0 0 0 32 43 L 23 43 z M 20 48 A 1 1 0 0 0 20 50 L 36 50 A 1 1 0 0 0 36 48 L 20 48 z M 8 55 L 38 55 L 38 57 A 5 5 0 0 0 39 60 L 11 60 A 3 3 0 0 1 8 57 L 8 55 z" />
                                    </svg> -->

                                    <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">{{ __('Tax') }}</span>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-9 mt-1" :class="open ? '!block' : 'hidden'">

                            </ul>
                        </div>
                    </li>
                    <li class="px-3 py-2 hover:bg-slate-600 rounded-sm mb-0.5 last:mb-0 @if(Route::is('uoms.index')){{ 'bg-slate-900' }}@endif">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150" href="{{ route('uoms.index') }}">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">


                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" class="w-6 h-6" fill="currentColor">
                                        <path d="M 5 4 A 1.0001 1.0001 0 0 0 4 5 L 4 20 A 1.0001 1.0001 0 0 0 5 21 L 11 21 L 11 29 L 10.146484 29 A 1.0001 1.0001 0 0 0 9.9804688 28.990234 A 1.0001 1.0001 0 0 0 9.8691406 29 L 5 29 A 1.0001 1.0001 0 0 0 4 30 L 4 39.847656 A 1.0001 1.0001 0 0 0 4 40.179688 L 4 44.847656 A 1.0001 1.0001 0 0 0 5.1523438 46 L 20 46 A 1.0001 1.0001 0 0 0 21 45 L 21 40.126953 A 1.0001 1.0001 0 0 0 21 39.851562 L 21 39 L 29 39 L 29 45 A 1.0001 1.0001 0 0 0 30 46 L 45 46 A 1.0001 1.0001 0 0 0 46 45 L 46 30 A 1.0001 1.0001 0 0 0 45 29 L 39 29 L 39 21 L 45 21 A 1.0001 1.0001 0 0 0 46 20 L 46 5 A 1.0001 1.0001 0 0 0 45 4 L 30 4 A 1.0001 1.0001 0 0 0 29 5 L 29 11 L 21 11 L 21 5 A 1.0001 1.0001 0 0 0 20 4 L 5 4 z M 6 6 L 19 6 L 19 17.09375 L 19 19 L 6 19 L 6 6 z M 31 6 L 44 6 L 44 19 L 31 19 L 31 16.625 L 31 6 z M 21 13 L 29 13 L 29 16.625 L 29 20 A 1.0001 1.0001 0 0 0 30 21 L 37 21 L 37 29 L 33.9375 29 L 30 29 A 1.0001 1.0001 0 0 0 29 30 L 29 37 L 21 37 L 21 35.126953 A 1.0001 1.0001 0 0 0 21 34.851562 L 21 33.65625 L 21 30 A 1.0001 1.0001 0 0 0 20 29 L 15.146484 29 A 1.0001 1.0001 0 0 0 14.980469 28.990234 A 1.0001 1.0001 0 0 0 14.869141 29 L 13 29 L 13 21 L 20 21 A 1.0001 1.0001 0 0 0 21 20 L 21 17.09375 L 21 13 z M 6 31 L 7.5859375 31 L 6 32.585938 L 6 31 z M 10.414062 31 L 12.585938 31 L 6 37.585938 L 6 35.414062 A 1.0001 1.0001 0 0 0 6.0078125 35.40625 L 10.414062 31 z M 15.414062 31 L 17.585938 31 L 6 42.585938 L 6 40.414062 L 15.414062 31 z M 31 31 L 33.9375 31 L 44 31 L 44 44 L 31 44 L 31 31 z M 19 32.414062 L 19 33.65625 L 19 34.585938 L 9.6933594 43.892578 A 1.0001 1.0001 0 0 0 9.5976562 44 L 7.4140625 44 L 19 32.414062 z M 19 37.414062 L 19 39.585938 L 14.693359 43.892578 A 1.0001 1.0001 0 0 0 14.597656 44 L 12.414062 44 L 19 37.414062 z M 19 42.414062 L 19 44 L 17.414062 44 L 19 42.414062 z" />
                                    </svg> -->

                                    <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">{{ __('Uom') }}</span>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-9 mt-1" :class="open ? '!block' : 'hidden'">

                            </ul>
                        </div>
                    </li>
                    <li class="px-3 py-2 hover:bg-slate-600 rounded-sm mb-0.5 last:mb-0 @if(Route::is('types.index')){{ 'bg-slate-900' }}@endif">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150" href="{{ route('types.index') }}">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">


                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" class="w-6 h-6" fill="currentColor">
                                        <path d="M 5 4 A 1.0001 1.0001 0 0 0 4 5 L 4 20 A 1.0001 1.0001 0 0 0 5 21 L 11 21 L 11 29 L 10.146484 29 A 1.0001 1.0001 0 0 0 9.9804688 28.990234 A 1.0001 1.0001 0 0 0 9.8691406 29 L 5 29 A 1.0001 1.0001 0 0 0 4 30 L 4 39.847656 A 1.0001 1.0001 0 0 0 4 40.179688 L 4 44.847656 A 1.0001 1.0001 0 0 0 5.1523438 46 L 20 46 A 1.0001 1.0001 0 0 0 21 45 L 21 40.126953 A 1.0001 1.0001 0 0 0 21 39.851562 L 21 39 L 29 39 L 29 45 A 1.0001 1.0001 0 0 0 30 46 L 45 46 A 1.0001 1.0001 0 0 0 46 45 L 46 30 A 1.0001 1.0001 0 0 0 45 29 L 39 29 L 39 21 L 45 21 A 1.0001 1.0001 0 0 0 46 20 L 46 5 A 1.0001 1.0001 0 0 0 45 4 L 30 4 A 1.0001 1.0001 0 0 0 29 5 L 29 11 L 21 11 L 21 5 A 1.0001 1.0001 0 0 0 20 4 L 5 4 z M 6 6 L 19 6 L 19 17.09375 L 19 19 L 6 19 L 6 6 z M 31 6 L 44 6 L 44 19 L 31 19 L 31 16.625 L 31 6 z M 21 13 L 29 13 L 29 16.625 L 29 20 A 1.0001 1.0001 0 0 0 30 21 L 37 21 L 37 29 L 33.9375 29 L 30 29 A 1.0001 1.0001 0 0 0 29 30 L 29 37 L 21 37 L 21 35.126953 A 1.0001 1.0001 0 0 0 21 34.851562 L 21 33.65625 L 21 30 A 1.0001 1.0001 0 0 0 20 29 L 15.146484 29 A 1.0001 1.0001 0 0 0 14.980469 28.990234 A 1.0001 1.0001 0 0 0 14.869141 29 L 13 29 L 13 21 L 20 21 A 1.0001 1.0001 0 0 0 21 20 L 21 17.09375 L 21 13 z M 6 31 L 7.5859375 31 L 6 32.585938 L 6 31 z M 10.414062 31 L 12.585938 31 L 6 37.585938 L 6 35.414062 A 1.0001 1.0001 0 0 0 6.0078125 35.40625 L 10.414062 31 z M 15.414062 31 L 17.585938 31 L 6 42.585938 L 6 40.414062 L 15.414062 31 z M 31 31 L 33.9375 31 L 44 31 L 44 44 L 31 44 L 31 31 z M 19 32.414062 L 19 33.65625 L 19 34.585938 L 9.6933594 43.892578 A 1.0001 1.0001 0 0 0 9.5976562 44 L 7.4140625 44 L 19 32.414062 z M 19 37.414062 L 19 39.585938 L 14.693359 43.892578 A 1.0001 1.0001 0 0 0 14.597656 44 L 12.414062 44 L 19 37.414062 z M 19 42.414062 L 19 44 L 17.414062 44 L 19 42.414062 z" />
                                    </svg> -->

                                    <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">{{ __('Type of products') }}</span>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-9 mt-1" :class="open ? '!block' : 'hidden'">

                            </ul>
                        </div>
                    </li>
                    <li class="px-3 py-2 hover:bg-slate-600 rounded-sm mb-0.5 last:mb-0 @if(Route::is('products.index')){{ 'bg-slate-900' }}@endif">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150" href="{{ route('products.index') }}">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">


                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" class="w-6 h-6" fill="currentColor">
                                        <path d="M 5 4 A 1.0001 1.0001 0 0 0 4 5 L 4 20 A 1.0001 1.0001 0 0 0 5 21 L 11 21 L 11 29 L 10.146484 29 A 1.0001 1.0001 0 0 0 9.9804688 28.990234 A 1.0001 1.0001 0 0 0 9.8691406 29 L 5 29 A 1.0001 1.0001 0 0 0 4 30 L 4 39.847656 A 1.0001 1.0001 0 0 0 4 40.179688 L 4 44.847656 A 1.0001 1.0001 0 0 0 5.1523438 46 L 20 46 A 1.0001 1.0001 0 0 0 21 45 L 21 40.126953 A 1.0001 1.0001 0 0 0 21 39.851562 L 21 39 L 29 39 L 29 45 A 1.0001 1.0001 0 0 0 30 46 L 45 46 A 1.0001 1.0001 0 0 0 46 45 L 46 30 A 1.0001 1.0001 0 0 0 45 29 L 39 29 L 39 21 L 45 21 A 1.0001 1.0001 0 0 0 46 20 L 46 5 A 1.0001 1.0001 0 0 0 45 4 L 30 4 A 1.0001 1.0001 0 0 0 29 5 L 29 11 L 21 11 L 21 5 A 1.0001 1.0001 0 0 0 20 4 L 5 4 z M 6 6 L 19 6 L 19 17.09375 L 19 19 L 6 19 L 6 6 z M 31 6 L 44 6 L 44 19 L 31 19 L 31 16.625 L 31 6 z M 21 13 L 29 13 L 29 16.625 L 29 20 A 1.0001 1.0001 0 0 0 30 21 L 37 21 L 37 29 L 33.9375 29 L 30 29 A 1.0001 1.0001 0 0 0 29 30 L 29 37 L 21 37 L 21 35.126953 A 1.0001 1.0001 0 0 0 21 34.851562 L 21 33.65625 L 21 30 A 1.0001 1.0001 0 0 0 20 29 L 15.146484 29 A 1.0001 1.0001 0 0 0 14.980469 28.990234 A 1.0001 1.0001 0 0 0 14.869141 29 L 13 29 L 13 21 L 20 21 A 1.0001 1.0001 0 0 0 21 20 L 21 17.09375 L 21 13 z M 6 31 L 7.5859375 31 L 6 32.585938 L 6 31 z M 10.414062 31 L 12.585938 31 L 6 37.585938 L 6 35.414062 A 1.0001 1.0001 0 0 0 6.0078125 35.40625 L 10.414062 31 z M 15.414062 31 L 17.585938 31 L 6 42.585938 L 6 40.414062 L 15.414062 31 z M 31 31 L 33.9375 31 L 44 31 L 44 44 L 31 44 L 31 31 z M 19 32.414062 L 19 33.65625 L 19 34.585938 L 9.6933594 43.892578 A 1.0001 1.0001 0 0 0 9.5976562 44 L 7.4140625 44 L 19 32.414062 z M 19 37.414062 L 19 39.585938 L 14.693359 43.892578 A 1.0001 1.0001 0 0 0 14.597656 44 L 12.414062 44 L 19 37.414062 z M 19 42.414062 L 19 44 L 17.414062 44 L 19 42.414062 z" />
                                    </svg> -->

                                    <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">{{ __('Products') }}</span>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-9 mt-1" :class="open ? '!block' : 'hidden'">

                            </ul>
                        </div>
                    </li>
                    <li class="px-3 py-2 hover:bg-slate-600 rounded-sm mb-0.5 last:mb-0 @if(Route::is('sizes.index')){{ 'bg-slate-900' }}@endif">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150" href="{{ route('sizes.index') }}">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">


                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" class="w-6 h-6" fill="currentColor">
                                        <path d="M 5 4 A 1.0001 1.0001 0 0 0 4 5 L 4 20 A 1.0001 1.0001 0 0 0 5 21 L 11 21 L 11 29 L 10.146484 29 A 1.0001 1.0001 0 0 0 9.9804688 28.990234 A 1.0001 1.0001 0 0 0 9.8691406 29 L 5 29 A 1.0001 1.0001 0 0 0 4 30 L 4 39.847656 A 1.0001 1.0001 0 0 0 4 40.179688 L 4 44.847656 A 1.0001 1.0001 0 0 0 5.1523438 46 L 20 46 A 1.0001 1.0001 0 0 0 21 45 L 21 40.126953 A 1.0001 1.0001 0 0 0 21 39.851562 L 21 39 L 29 39 L 29 45 A 1.0001 1.0001 0 0 0 30 46 L 45 46 A 1.0001 1.0001 0 0 0 46 45 L 46 30 A 1.0001 1.0001 0 0 0 45 29 L 39 29 L 39 21 L 45 21 A 1.0001 1.0001 0 0 0 46 20 L 46 5 A 1.0001 1.0001 0 0 0 45 4 L 30 4 A 1.0001 1.0001 0 0 0 29 5 L 29 11 L 21 11 L 21 5 A 1.0001 1.0001 0 0 0 20 4 L 5 4 z M 6 6 L 19 6 L 19 17.09375 L 19 19 L 6 19 L 6 6 z M 31 6 L 44 6 L 44 19 L 31 19 L 31 16.625 L 31 6 z M 21 13 L 29 13 L 29 16.625 L 29 20 A 1.0001 1.0001 0 0 0 30 21 L 37 21 L 37 29 L 33.9375 29 L 30 29 A 1.0001 1.0001 0 0 0 29 30 L 29 37 L 21 37 L 21 35.126953 A 1.0001 1.0001 0 0 0 21 34.851562 L 21 33.65625 L 21 30 A 1.0001 1.0001 0 0 0 20 29 L 15.146484 29 A 1.0001 1.0001 0 0 0 14.980469 28.990234 A 1.0001 1.0001 0 0 0 14.869141 29 L 13 29 L 13 21 L 20 21 A 1.0001 1.0001 0 0 0 21 20 L 21 17.09375 L 21 13 z M 6 31 L 7.5859375 31 L 6 32.585938 L 6 31 z M 10.414062 31 L 12.585938 31 L 6 37.585938 L 6 35.414062 A 1.0001 1.0001 0 0 0 6.0078125 35.40625 L 10.414062 31 z M 15.414062 31 L 17.585938 31 L 6 42.585938 L 6 40.414062 L 15.414062 31 z M 31 31 L 33.9375 31 L 44 31 L 44 44 L 31 44 L 31 31 z M 19 32.414062 L 19 33.65625 L 19 34.585938 L 9.6933594 43.892578 A 1.0001 1.0001 0 0 0 9.5976562 44 L 7.4140625 44 L 19 32.414062 z M 19 37.414062 L 19 39.585938 L 14.693359 43.892578 A 1.0001 1.0001 0 0 0 14.597656 44 L 12.414062 44 L 19 37.414062 z M 19 42.414062 L 19 44 L 17.414062 44 L 19 42.414062 z" />
                                    </svg> -->

                                    <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">{{ __('Size') }}</span>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-9 mt-1" :class="open ? '!block' : 'hidden'">

                            </ul>
                        </div>
                    </li>
                    @endif
                </ul>
            </div>

        </div>

        <!-- Expand / collapse button -->
        <div class="pt-3 hidden lg:inline-flex 2xl:hidden justify-end mt-auto">
            <div class="px-3 py-2 hover:bg-slate-600">
                <button @click="sidebarExpanded = !sidebarExpanded">
                    <span class="sr-only">Expand / collapse sidebar</span>
                    <svg class="w-6 h-6 fill-current sidebar-expanded:rotate-180" viewBox="0 0 24 24">
                        <path class="text-slate-400" d="M19.586 11l-5-5L16 4.586 23.414 12 16 19.414 14.586 18l5-5H7v-2z" />
                        <path class="text-slate-600" d="M3 23H1V1h2z" />
                    </svg>
                </button>
            </div>
        </div>

    </div>
</div>