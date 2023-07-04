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
                    <!-- Home -->
                    <li class="px-3 py-2 hover:bg-slate-600 rounded-sm mb-0.5 last:mb-0 @if(Route::is('home.index')){{ 'bg-slate-900' }}@endif">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150" href="{{ route('home.index') }}">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                    </svg>
                                    <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">{{ __('Home') }}</span>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-9 mt-1" :class="open ? '!block' : 'hidden'">

                            </ul>
                        </div>
                    </li>

                    <li class="px-3 py-2 hover:bg-slate-600 rounded-sm mb-0.5 last:mb-0 @if(Route::is('users.index')){{ 'bg-slate-900' }}@endif">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150" href="{{ route('users.index') }}">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                    </svg>
                                    <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">{{ __('User') }}</span>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-9 mt-1" :class="open ? '!block' : 'hidden'">
                            </ul>
                        </div>
                    </li>

                    <li class="px-3 py-2 hover:bg-slate-600 rounded-sm mb-0.5 last:mb-0 @if(Route::is('customers.index')){{ 'bg-slate-900' }}@endif">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150" href="{{ route('customers.index') }}">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="none"><path d="M4.5 5.75C4.5 4.50736 5.50736 3.5 6.75 3.5C7.99264 3.5 9 4.50736 9 5.75C9 6.99264 7.99264 8 6.75 8C5.50736 8 4.5 6.99264 4.5 5.75ZM6.75 2.5C4.95507 2.5 3.5 3.95507 3.5 5.75C3.5 7.54493 4.95507 9 6.75 9C8.54493 9 10 7.54493 10 5.75C10 3.95507 8.54493 2.5 6.75 2.5ZM10 10C10.2488 10 10.487 10.0454 10.7068 10.1285C10.2208 10.2909 9.8013 10.5986 9.49982 11H3.5C2.94772 11 2.5 11.4477 2.5 12V12.0602L2.50002 12.0612L2.50063 12.0781C2.50141 12.0951 2.50313 12.1233 2.50686 12.1611C2.51433 12.2368 2.52976 12.3497 2.56146 12.4874C2.62512 12.7638 2.75235 13.1312 3.00512 13.497C3.4916 14.2012 4.51315 15 6.75 15C7.7031 15 8.43556 14.855 9 14.634V15.5C9 15.564 9.00241 15.6275 9.00713 15.6903C8.3853 15.8845 7.64044 16 6.75 16C4.23685 16 2.8834 15.0801 2.18238 14.0655C1.8414 13.5719 1.67175 13.08 1.58697 12.7118C1.54446 12.5272 1.52278 12.3716 1.5117 12.2593C1.50614 12.2031 1.50322 12.1574 1.50169 12.1241C1.50092 12.1074 1.5005 12.0938 1.50027 12.0835L1.50005 12.0705L1.50001 12.0658L1.5 12.064L1.5 12.0625V12C1.5 10.8954 2.39543 10 3.5 10H10ZM13 6.5C13 5.67157 13.6716 5 14.5 5C15.3284 5 16 5.67157 16 6.5C16 7.32843 15.3284 8 14.5 8C13.6716 8 13 7.32843 13 6.5ZM14.5 4C13.1193 4 12 5.11929 12 6.5C12 7.88071 13.1193 9 14.5 9C15.8807 9 17 7.88071 17 6.5C17 5.11929 15.8807 4 14.5 4ZM10 12.5C10 11.6716 10.6716 11 11.5 11H17.5C18.3284 11 19 11.6716 19 12.5V15.5C19 16.3284 18.3284 17 17.5 17H11.5C10.6716 17 10 16.3284 10 15.5V12.5ZM11 12.5V13.5C11.8284 13.5 12.5 12.8284 12.5 12H11.5C11.5 12.2761 11.2761 12.5 11 12.5ZM18 13.5V12.5C17.7239 12.5 17.5 12.2761 17.5 12H16.5C16.5 12.8284 17.1716 13.5 18 13.5ZM16.5 16H17.5C17.5 15.7239 17.7239 15.5 18 15.5V14.5C17.1716 14.5 16.5 15.1716 16.5 16ZM11 14.5V15.5C11.2761 15.5 11.5 15.7239 11.5 16H12.5C12.5 15.1716 11.8284 14.5 11 14.5ZM14.5 15.5C15.3284 15.5 16 14.8284 16 14C16 13.1716 15.3284 12.5 14.5 12.5C13.6716 12.5 13 13.1716 13 14C13 14.8284 13.6716 15.5 14.5 15.5Z" fill="currentColor"></path></svg>
                                    <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">{{ __('Customers') }}</span>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-9 mt-1" :class="open ? '!block' : 'hidden'">
                            </ul>
                        </div>
                    </li>

                    <li class="px-3 py-2 hover:bg-slate-600 rounded-sm mb-0.5 last:mb-0 @if(Route::is('imports.index')){{ 'bg-slate-900' }}@endif">
                        <a class="block text-slate-200 hover:text-white truncate transition duration-150" href="{{ route('imports.index') }}">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 3.75H6.912a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H15M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859M12 3v8.25m0 0l-3-3m3 3l3-3" />
                                    </svg>
                                    <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">{{ __('Imports') }}</span>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-9 mt-1" :class="open ? '!block' : 'hidden'">
                                {{-- <li class="mb-1 last:mb-0">
                                    <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate @if(Route::is('customers')){{ '!text-indigo-500' }}@endif" href="#0">
                                <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Add new import</span>
                                </a>
                    </li>
                    <li class="mb-1 last:mb-0">
                        <a class="block text-slate-400 hover:text-slate-200 transition duration-150 truncate @if(Route::is('orders')){{ '!text-indigo-500' }}@endif" href="#0">
                            <span class="text-sm font-medium lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Show</span>
                        </a>
                    </li> --}}
                </ul>
            </div>
            </li>


            <li class="px-3 py-2 hover:bg-slate-600 rounded-sm mb-0.5 last:mb-0 @if(Route::is('exports.index')){{ 'bg-slate-900' }}@endif">
                <a class="block text-slate-200 hover:text-white truncate transition duration-150" href="{{ route('exports.index') }}">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                            </svg>
                            <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">{{ __('Exports') }}</span>
                        </div>
                    </div>
                </a>
                <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                    <ul class="pl-9 mt-1" :class="open ? '!block' : 'hidden'">
                    </ul>
                </div>
            </li>

            <li class="px-3 py-2 hover:bg-slate-600 rounded-sm mb-0.5 last:mb-0 @if(Route::is('categories.index')){{ 'bg-slate-900' }}@endif">
                <a class="block text-slate-200 hover:text-white truncate transition duration-150" href="{{ route('categories.index') }}">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0l4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0l-5.571 3-5.571-3" />
                            </svg>
                            <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">{{ __('Categories') }}</span>
                        </div>
                    </div>
                </a>
                <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                    <ul class="pl-9 mt-1" :class="open ? '!block' : 'hidden'">
                    </ul>
                </div>
            </li>

            <li class="px-3 py-2 hover:bg-slate-600 rounded-sm mb-0.5 last:mb-0 @if(Route::is('reservations.index')){{ 'bg-slate-900' }}@endif">
                <a class="block text-slate-200 hover:text-white truncate transition duration-150" href="{{ route('reservations.index') }}">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-6 h-6" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="6" height="6" fill="white" fill-opacity="0.01"></rect>
                                <path d="M48 1H0V49H48V1Z" fill="white" fill-opacity="0.01"></path>
                                <path d="M6 9.25564L24.0086 4L42 9.25564V20.0337C42 31.3622 34.7502 41.4194 24.0026 45.0005C13.2521 41.4195 6 31.36 6 20.0287V9.25564Z" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round"></path>
                                <path d="M15 23L22 30L34 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">{{ __('Reservations') }}</span>
                        </div>
                    </div>
                </a>
                <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                    <ul class="pl-9 mt-1" :class="open ? '!block' : 'hidden'">
                    </ul>
                </div>
            </li>

            <li class="px-3 py-2 hover:bg-slate-600 rounded-sm mb-0.5 last:mb-0 @if(Route::is('goods.index')){{ 'bg-slate-900' }}@endif">
                <a class="block text-slate-200 hover:text-white truncate transition duration-150" href="{{ route('goods.index') }}">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 16 16" fill="currentColor"><path fill="currentColor" d="M12 6v-6h-8v6h-4v7h16v-7h-4zM7 12h-6v-5h2v1h2v-1h2v5zM5 6v-5h2v1h2v-1h2v5h-6zM15 12h-6v-5h2v1h2v-1h2v5z"></path><path fill="currentColor" d="M0 16h3v-1h10v1h3v-2h-16v2z"></path></svg>
                            <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">{{ __('Goods') }}</span>
                        </div>
                    </div>
                </a>
                <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                    <ul class="pl-9 mt-1" :class="open ? '!block' : 'hidden'">
                    </ul>
                </div>
            </li>

            <li class="px-3 py-2 hover:bg-slate-600 rounded-sm mb-0.5 last:mb-0 @if(Route::is('positions.index')){{ 'bg-slate-900' }}@endif">
                <a class="block text-slate-200 hover:text-white truncate transition duration-150" href="{{ route('positions.index') }}">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zM7 9c0-2.76 2.24-5 5-5s5 2.24 5 5c0 2.88-2.88 7.19-5 9.88C9.92 16.21 7 11.85 7 9z"></path><circle cx="12" cy="9" r="2.5"></circle></svg>
                            <span class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">{{ __('Position') }}</span>
                        </div>
                    </div>
                </a>
                <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                    <ul class="pl-9 mt-1" :class="open ? '!block' : 'hidden'">
                    </ul>
                </div>
            </li>
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