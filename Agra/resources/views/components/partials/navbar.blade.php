<nav class="bg-gradient-to-r from-blue-800 to-blue-600 border-gray-200 dark:bg-gray-900">
    <div class="w-full flex flex-wrap items-center justify-between  p-5">

        <!---------Start Menu btn-------------->
        <div class ="btn-menu flex flex-row justify-start w-1/3">
            <button class="text-black bg-blue-100 hover:bg-blue-200 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 transition ease-in-out delay-150 bg-blue-300 hover:-translate-y-1 hover:scale-110 hover:bg-blue-600 duration-300" type="button" data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation" aria-controls="drawer-navigation">
            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 17 14">
                <path d="M16 2H1a1 1 0 0 1 0-2h15a1 1 0 1 1 0 2Zm0 6H1a1 1 0 0 1 0-2h15a1 1 0 1 1 0 2Zm0 6H1a1 1 0 0 1 0-2h15a1 1 0 0 1 0 2Z"/>
            </svg>
            </button>
        </div>

        <!---------End Menu btn-------------->

        <!-- ---------Start Drawer Menu----------------->
        <div id="drawer-navigation" class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-blue-800 w-64 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-navigation-label">
            <h5 id="drawer-navigation-label" class="text-base font-semibold text-white uppercase dark:text-gray-400">Menu</h5>
            <button type="button" data-drawer-hide="drawer-navigation" aria-controls="drawer-navigation" class="text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white" >
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close menu</span>
            </button>

            <div class="py-4 overflow-y-auto">
                <ul class="space-y-2 font-medium">
                    <li>
                        <a href="/agra" class="flex items-center p-2 text-white hover:text-blue-800 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">

                            <img src="/AGRA-Logo.png" class="w-5 h-5" alt="" />

                            <span class="ms-3">AGRA</span>
                        </a>
                    </li>
                    <li>
                        <a href="/" class="flex items-center p-2 text-white hover:text-blue-800 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-white transition duration-75 dark:text-white group-hover:text-blue-800 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z" clip-rule="evenodd"/>
                            </svg>

                            <span class="ms-3">Home</span>
                        </a>
                    </li>

                    <li>
                        <a href="/courses" class="flex items-center p-2 text-white hover:text-blue-800 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-white transition duration-75 dark:text-gray-400 group-hover:text-blue-800 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M11 4.717c-2.286-.58-4.16-.756-7.045-.71A1.99 1.99 0 0 0 2 6v11c0 1.133.934 2.022 2.044 2.007 2.759-.038 4.5.16 6.956.791V4.717Zm2 15.081c2.456-.631 4.198-.829 6.956-.791A2.013 2.013 0 0 0 22 16.999V6a1.99 1.99 0 0 0-1.955-1.993c-2.885-.046-4.76.13-7.045.71v15.081Z" clip-rule="evenodd"/>
                            </svg>

                            <span class="flex-1 ms-3 whitespace-nowrap">Courses</span>
                            <span class="inline-flex items-center justify-center px-2 ms-3 text-sm font-medium text-white bg-blue-600 rounded-full dark:bg-gray-700 dark:text-gray-300">New</span>
                        </a>
                    </li>

                    <li>
                        <a href="/home" class="flex items-center p-2 text-white hover:text-blue-800 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-white transition duration-75 dark:text-gray-400 group-hover:text-blue-800 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v5a1 1 0 1 0 2 0V8Zm-1 7a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H12Z" clip-rule="evenodd"/>
                        </svg>

                            <span class="flex-1 ms-3 whitespace-nowrap">About Us</span>
                        </a>
                    </li>

                    <li>
                    <form method="POST" id="logout" action="{{ route('logout') }}">
                        <a href="javascript:document.getElementById('logout').submit();" class="flex items-center p-2 text-white hover:text-blue-800 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-white transition duration-75 dark:text-gray-400 group-hover:text-blue-800 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H4m12 0-4 4m4-4-4-4m3-4h2a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-2"/>
                        </svg>


                            <span class="flex-1 ms-3 whitespace-nowrap">Log Out</span>
                        </a>
                        {{ csrf_field() }}
                        </form>
                    </li>

                </ul>
            </div>
        </div>
        <!-------------End Drawer menu--------------------->

        <!-----------------Start Logo--------------------->
        <div class ="btn-logo flex flex-row justify-center w-1/3">
            <a href="" class="flex items-center space-x-3 rtl:space-x-reverse transition ease-in-out delay-150 bg-transparent hover:-translate-y-1 hover:scale-110 hover:bg-blue-600 duration-300 rounded-lg w-30 h-full">
                <img src="AGRA-Logo.png" class="h-8" alt="Flowbite Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">AGRA</span>
            </a>
        </div>
        <!-----------------End Logo--------------------->


        <!---------------Start User Profile btn img---------------->
        <div class ="btn-profile flex flex-row justify-end w-1/3">
            <button type="button" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600 transition ease-in-out delay-150 bg-blue-500 hover:-translate-y-1 hover:scale-110 hover:bg-indigo-500 duration-300" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                <span class="sr-only">Open user menu</span>
                <img class="w-8 h-8 rounded-full" src="/docs/images/people/profile-picture-3.jpg" alt="user photo">
            </button>
        </div>
        <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">

            <!---------------End User Profile btn img---------------->


            <!--------------------------Start Dropdown btn User profile  -------------------->



            <!--------------------------End Dropdown btn User profile  -------------------->

        </div>
    </div>
</nav>
<!--=====================================End Navbar=====================================-->
