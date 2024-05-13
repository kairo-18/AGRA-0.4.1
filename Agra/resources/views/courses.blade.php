<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agra Courses</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}"/>
    <script src="{{asset('js/app.js')}}"></script>

</head>
<body>

<div class="navflex bg-white h-60 w-full rounded-lg">
    <!----------------------------start navbar--------------------------------------->
    <div class="navbar bg-blue-950 text-white absolute p-5">

        <div class="drawer flex justify-between">
            <!--start drawer-->
            <input id="my-drawer" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content">
                <label for="my-drawer" class="btn btn-primary drawer-button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-5 h-5 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </label>
            </div>
            <!--end drawer-->

            <!--start Logo/Brand-->
            <div class="flex">
                <a class="btn btn-ghost text-xl">AGRA</a>
            </div>
            <!--end Logo/Brand-->

            <!--start Logo/Brand-->
            <div class="flex">
                <a class="btn btn-primary text-xl">Account</a>
            </div>
            <!--end Logo/Brand-->

            <!--start toggled drawer-->
            <div class="drawer-side">
                <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
                <ul class="menu p-4 w-80 min-h-full bg-base-200 text-base-content">

                    <li><a>Sidebar Item 1</a></li>
                    <li><a>Sidebar Item 2</a></li>

                </ul>
            </div>
            <!--end toggled drawer-->
        </div>
    </div>
</div>
<!----------------------------End Navbar--------------------------------------->


<!----------------------------start outerDiv/MainDiv--------------------------------------->
<div class="outerDiv flex flex-wrap flex-row pb-5 pl-5 pr-5 bg-blue-950 min-h-full ">
    <!--start innerDiv-->
    <div class="innerDiv flex bg-white h-screen w-full rounded-lg">
        <!--start leftPanel-->
        <div class="left-panel flex flex-col  bg-slate-800 rounded-l-lg h-auto w-4/5 p-10">

            <!--1 div-->
            <div class="title-section flex p-3 bg-white h-16 w-full rounded-lg">
                <h1>Courses</h1>
            </div>

            <!--2 div-->
            <div class="nav-section flex content-center bg-white h-16 w-full rounded-lg">
                <div class="dropdown dropdown-bottom">
                    <div tabindex="0" role="button" class="btn w-68">Drop Down > </div>
                    <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                        <li><a>Item 1</a></li>
                        <li><a>Item 2</a></li>
                    </ul>
                </div>

                <div class="dropdown dropdown-bottom">
                    <div tabindex="0" role="button" class="btn w-68">Drop Down > </div>
                    <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                        <li><a>Item 1</a></li>
                        <li><a>Item 2</a></li>
                    </ul>
                </div>
            </div>
            <!--3 div-->
            <div class = "learM-section flex flex-col bg-white h-dvh w-full rounded-lg overflow-auto">
                <div class="flex flex-wrap justify-around p-5 gap-y-10">




                    <a href="#" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="/docs/images/blog/image-4.jpg" alt="">
                        <div class="flex flex-col justify-between p-4 leading-normal">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy technology acquisitions 2021</h5>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
                        </div>
                    </a>

                    <a href="#" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="/docs/images/blog/image-4.jpg" alt="">
                        <div class="flex flex-col justify-between p-4 leading-normal">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy technology acquisitions 2021</h5>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
                        </div>
                    </a>



                </div>
            </div>

        </div>
        <!--End leftPanel-->

        <!--start rightPanel-->
        <div class="right-panel flex flex-col bg-neutral-700 rounded-r-lg h-auto w-1/5">
            <div class="profile flex p-3 bg-white h-16 w-full rounded-lg">Profile</div>
            <div class="agenda flex p-3 bg-white h-16 w-full rounded-lg">Agenda</div>
            <div class="calendar flex p-3 bg-white h-16 w-full rounded-lg">calendar</div>
        </div>

    </div>
    <!--End outerDiv-->
</div>
<!--End outerDiv-->

</body>
</html>
