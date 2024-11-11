<nav class="bg-gradient-to-r from-blue-800 to-blue-600 border-gray-200 dark:bg-gray-900">
    <div class="w-full flex flex-wrap items-center justify-between p-5 pl-10 pr-10">

        <!---------Start Menu btn-------------->
        <div class ="btn-menu flex flex-row justify-start w-1/3">
            <button class="text-black bg-white hover:bg-blue-300 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 transition ease-in-out delay-150 bg-blue-300 hover:-translate-y-1 hover:scale-110 hover:bg-blue-600 duration-300" type="button" data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation" aria-controls="drawer-navigation">
            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 17 14">
                <path d="M16 2H1a1 1 0 0 1 0-2h15a1 1 0 1 1 0 2Zm0 6H1a1 1 0 0 1 0-2h15a1 1 0 1 1 0 2Zm0 6H1a1 1 0 0 1 0-2h15a1 1 0 0 1 0 2Z"/>
            </svg>
            </button>
        </div>

        <!---------End Menu btn-------------->

        <!-- ---------Start Drawer Menu----------------->
        <div id="drawer-navigation" class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-hidden transition-transform -translate-x-full bg-blue-800 w-64 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-navigation-label">
            <h5 id="drawer-navigation-label" class="text-2xl font-semibold text-white uppercase dark:text-gray-400">Menu</h5>
            <button type="button" data-drawer-hide="drawer-navigation" aria-controls="drawer-navigation" class="text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white" >
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close menu</span>
            </button>

            <div class="flex flex-col h-full justify-between">
        <div class="py-4 overflow-y-hidden">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="/agra" class="flex items-center p-2 mb-10 mt-10 text-white hover:text-blue-800 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <img src="/AGRA-Logo.png" class="w-7 h-7" alt="" />
                        <span class="ms-3 text-xl">AGRA</span>
                    </a>
                </li>
                <li>
                    <a href="/" class="flex items-center p-2 mb-10 text-white hover:text-blue-800 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-7 h-7 text-white transition duration-75 dark:text-white group-hover:text-blue-800 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z" clip-rule="evenodd"/>
                        </svg>
                        <span class="ms-3 text-xl">Home</span>
                    </a>
                </li>
                <li>
                    <a href="/courses" class="flex items-center p-2 mb-10 text-white hover:text-blue-800 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-7 h-7 text-white transition duration-75 dark:text-gray-400 group-hover:text-blue-800 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M11 4.717c-2.286-.58-4.16-.756-7.045-.71A1.99 1.99 0 0 0 2 6v11c0 1.133.934 2.022 2.044 2.007 2.759-.038 4.5.16 6.956.791V4.717Zm2 15.081c2.456-.631 4.198-.829 6.956-.791A2.013 2.013 0 0 0 22 16.999V6a1.99 1.99 0 0 0-1.955-1.993c-2.885-.046-4.76.13-7.045.71v15.081Z" clip-rule="evenodd"/>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap text-xl">Courses</span>
                        <span class="inline-flex items-center justify-center px-2 ms-3 text-sm font-medium text-white bg-blue-600 rounded-full dark:bg-gray-700 dark:text-gray-300">New</span>
                    </a>
                </li>
                <li>
                    <a href="/recommendation" class="flex items-center p-2 mb-10 text-white hover:text-blue-800 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="w-7 h-7 text-white dark:text-white ransition duration-75 dark:text-gray-400 group-hover:text-blue-800 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 22 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16.5A2.493 2.493 0 0 1 6.51 18H6.5a2.468 2.468 0 0 1-2.4-3.154 2.98 2.98 0 0 1-.85-5.274 2.468 2.468 0 0 1 .921-3.182 2.477 2.477 0 0 1 1.875-3.344 2.5 2.5 0 0 1 3.41-1.856A2.5 2.5 0 0 1 11 3.5m0 13v-13m0 13a2.492 2.492 0 0 0 4.49 1.5h.01a2.467 2.467 0 0 0 2.403-3.154 2.98 2.98 0 0 0 .847-5.274 2.468 2.468 0 0 0-.921-3.182 2.479 2.479 0 0 0-1.875-3.344A2.5 2.5 0 0 0 13.5 1 2.5 2.5 0 0 0 11 3.5m-8 5a2.5 2.5 0 0 1 3.48-2.3m-.28 8.551a3 3 0 0 1-2.953-5.185M19 8.5a2.5 2.5 0 0 0-3.481-2.3m.28 8.551a3 3 0 0 0 2.954-5.185"/>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap text-xl">Recommendation</span>
                    </a>
                </li>
                <li>
                    <a href="/aboutUs" class="flex items-center p-2 mb-10 text-white hover:text-blue-800 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-7 h-7 text-white transition duration-75 dark:text-gray-400 group-hover:text-blue-800 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v5a1 1 0 1 0 2 0V8Zm-1 7a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H12Z" clip-rule="evenodd"/>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap text-xl">About Us</span>
                    </a>
                </li>

                <li>
                    <a href="/multiplayer" class="flex items-center p-2 mb-10 text-white hover:text-blue-800 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="w-6 h-6 text-white dark:text-white ransition duration-75 dark:text-gray-400 group-hover:text-blue-800 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 22 21">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M7.24 7.194a24.16 24.16 0 0 1 3.72-3.062m0 0c3.443-2.277 6.732-2.969 8.24-1.46 2.054 2.053.03 7.407-4.522 11.959-4.552 4.551-9.906 6.576-11.96 4.522C1.223 17.658 1.89 14.412 4.121 11m6.838-6.868c-3.443-2.277-6.732-2.969-8.24-1.46-2.054 2.053-.03 7.407 4.522 11.959m3.718-10.499a24.16 24.16 0 0 1 3.719 3.062M17.798 11c2.23 3.412 2.898 6.658 1.402 8.153-1.502 1.503-4.771.822-8.2-1.433m1-6.808a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z"/>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap text-xl">Multiplayer</span>
                    </a>
                </li>
            </ul>
        </div>


        <div class="pb-10">
            <form method="POST" id="logout" action="{{ route('logout') }}">
                <a href="javascript:document.getElementById('logout').submit();" class="flex items-center p-2 text-white hover:text-blue-800 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg class="flex-shrink-0 w-7 h-7 text-white transition duration-75 dark:text-gray-400 group-hover:text-blue-800 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H4m12 0-4 4m4-4-4-4m3-4h2a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-2"/>
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap text-xl font-semibold">Log Out</span>
                </a>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
        </div>
        <!-------------End Drawer menu--------------------->

        <!-----------------Start Logo--------------------->
        <div class ="btn-logo flex flex-row justify-center w-1/3">
            <a href="/agra" class="flex items-center space-x-3 rtl:space-x-reverse transition ease-in-out delay-150 bg-transparent hover:-translate-y-1 hover:scale-110 hover:bg-blue-600 duration-300 rounded-lg w-30 h-full">
                <img src="/AGRA-Logo.png" class="h-8" alt="Flowbite Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">AGRA</span>
            </a>
        </div>
        <!-----------------End Logo--------------------->


        <!---------------Start User Profile btn img---------------->
        <div class ="btn-profile flex flex-row gap-10 justify-end w-1/3">
            <!-- Notifications Button -->
            <div class="relative ml-4">
                <button id="notification-button" class="flex items-center p-2 text-gray-500 hover:opacity-50 rounded-md">
                    <img src="/notif-icon.svg" alt="Notification Icon" class="w-8 h-8" />
                </button>

                <!-- Notifications Dropdown -->
                <div id="notifications-dropdown" class="absolute right-0 z-50 hidden w-[500px] mt-5 bg-gray-100 shadow-2xl divide-y divide-gray-100 rounded-lg dark:bg-gray-700 dark:divide-gray-600">
                    <div class="pb-2">
                        <span class="block px-4 py-2 text-lg font-bold text-white bg-blue-900 dark:text-white rounded-lg">Notifications</span>
                        <button id="read-all-button" class="block underline px-4 py-2 text-sm text-blue-500 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white">
                            Read All
                        </button>
                        <div id="notification-list">

                            @foreach(Auth::user()->agraNotifications as $notification)
                                @if($notification->read_at == null)
                                <div class="px-4 py-2 text-blue-700" data-notification-id="{{ $notification->id }}">
                                    {{ $notification->sender }}: {{ $notification->message }}
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-black bg-white hover:bg-blue-200 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                <img src="/profileIcon.png" class="w-[30px] mr-4">
                <a class="">{{\Illuminate\Support\Facades\Auth::user()->name}}</a> <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                </svg>
            </button>

            <!-- Dropdown menu -->
            <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                    <li>
                        <a href="/userProfile" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Profile</a>
                    </li>
                    <li>
                        <a href="/userAnalytics" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Analytics</a>
                    </li>
                    <li>
                        <form method="POST" id="logout" action="{{ route('logout') }}">
                            <a href="javascript:document.getElementById('logout').submit();" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                Log Out
                            </a>
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </div>



            </div>

        </div>
        <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">

            <!---------------End User Profile btn img---------------->


            <!--------------------------Start Dropdown btn User profile  -------------------->



            <!--------------------------End Dropdown btn User profile  -------------------->

        </div>
    </div>
</nav>

<!--=====================================End Navbar=====================================-->
