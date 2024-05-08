<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title -->
    <title>Modules Lessons</title>

    <!-- External CSS -->
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="mix.css">
    <style>
        /* Importing Google Font */
@import url('https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Reddit+Mono:wght@200..900&display=swap');


body{
    margin: 0%;
    padding: 0%;
    font-family: "Montserrat", sans-serif;
}
p{
   margin: 0;
}

.sidebar-nav{
    width: 10%;


}
.nav-pills > li > a {
    border-radius: 0;
 }

 #wrapper {
    padding-left: 0;
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
    overflow: hidden;
 }


 #sidebar-wrapper {
    z-index: 1000;
    position: fixed;
    left: 250px;
    height: 100%;
    margin-left: -250px;
    background: #004AAD;
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
 }


 /* Sidebar Styles */

 .sidebar-nav {
    position: absolute;
    top: 0;
    width: 250px;
    margin: 0;
    padding: 0;
    list-style: none;
    margin-top: 2px;
 }

 .sidebar-nav li {
    text-indent: 0px;
    line-height: 120px;
 }

 .sidebar-nav li a {
    display: block;
    text-decoration: none;
    color: #ffffff;
 }

 .sidebar-nav li a:hover {
    text-decoration: none;
    color: #fff;
    background: rgba(255, 255, 255, 0.2);
    border-left: #ffffff 5px solid;
     width: 200px;
     -webkit-transition: all 0.5s ease;
     -moz-transition: all 0.5s ease;
     -o-transition: all 0.5s ease;
     transition: all 0.5s ease;
 }
 .hidden-text {
    display: none;
}

#sidebar-wrapper:hover .hidden-text {
    display: inline;
}


 .sidebar-nav li a:active,
 .sidebar-nav li a:focus {
    text-decoration: none;
 }

 .sidebar-nav > .sidebar-brand {
    height: 65px;
    font-size: 18px;
    line-height: 60px;
 }

 .sidebar-nav > .sidebar-brand a {
    color: #999999;
 }

 .sidebar-nav > .sidebar-brand a:hover {
    color: #fff;
    background: none;
 }

 .no-margin {
    margin: 0;
 }
 .active{
    row-gap: 20px;
 }
 /* Styling for sidebar links */
a.sidebar-link {
    padding: .625rem 1.625rem;
    color: #FFF;
    display: block;
    font-size: 0.9rem;
    white-space: nowrap;
    border-left: 3px solid transparent;
}

/* Styling for icons in sidebar links */
.sidebar-link i {
    font-size: 1rem;
    margin-right: 2rem;
    margin-left: 1rem;
}
#logout{
   margin-top:100px;
}

 @media (min-width: 768px) {
    #wrapper {
       padding-left: 80px;
       height: auto;
    }
    .fixed-brand {
       width: 200px;
    }
    #wrapper.toggled {
       padding-left: 0;
    }
    #sidebar-wrapper {
       width: 100px;
    }

    #wrapper.toggled-2 #sidebar-wrapper {
       width: 100px;
    }
    #wrapper.toggled-2 #sidebar-wrapper:hover {
       width: 200px;
    }



 }



    </style>
</head>

<body>
<div id="wrapper" class="toggled-2">
        <!-- Sidebar -->
      <div id="sidebar-wrapper">
         <ul class="sidebar-nav nav-pills nav-stacked" id="menu">

            <li class="active">
               <a href="/agra" class="sidebar-link" id="lgo">
                  <span class="fa-stack fa-lg"><img src="AGRA-Logo.png" alt="logo"></span>
                  <span class="hidden-text"> A G R A</span>
               </a>
            </li>
            <li>
               <a href="/" class="sidebar-link">
                  <span class="fa-stack fa-lg"><i class="lni lni-home"> </i></span>
                  <span class="hidden-text">Home</span>
               </a>
            </li>

            <li>
               <a href="/courses" class="sidebar-link">
                  <span class="fa-stack fa-lg"><i class="lni lni-book"> </i></span>
                  <span class="hidden-text">Courses</span>
               </a>
            </li>

            <li>
               <a href="/help" class="sidebar-link">
                  <span class="fa-stack fa-lg"><i class="lni lni-question-circle"> </i></span>
                  <span class="hidden-text">Help</span>
               </a>
            </li>

            <li>
               <a href="/sample" class="sidebar-link">
                  <span class="fa-stack fa-lg"><i class="lni lni-cog"> </i></span>
                  <span class="hidden-text">Settings</span>
               </a>
            </li>

            <li id="logout">
            <form method="POST" id="logoutForm" action="{{ route('logout') }}">
               @csrf
               <a href="#" onclick="document.getElementById('logoutButton').click();" class="sidebar-link">
                  <span class="fa-stack fa-lg"><i class="lni lni-exit"> </i></span>
                  <span class="hidden-text">Log Out</span>
               </a>
               <button type="submit" id="logoutButton" style="display: none;"></button>
            </form>

            </li>
         </ul>


      </div>



</div>


    <!-- Bootstrap JS Bundle -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <!-- Custom Script -->


</body>

</html>
