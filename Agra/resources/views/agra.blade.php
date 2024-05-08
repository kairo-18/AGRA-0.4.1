
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title -->
    <title>AGRA Course</title>

    <!-- External CSS -->
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="/agra.css">
    <style>
        /* Custom CSS for responsiveness */
        @media (max-width: 768px) {
            .wrapper {
                display: flex;
            }
            #sidebar {
                width: 250px;
                position: fixed;
                height: 100%;
                overflow-y: auto;
                transition: all 0.3s;
            }
            .main {
                margin-left: 250px;
            }
        }
    </style>
</head>

<body>
<!-- Sidebar Wrapper -->
<div class="wrapper">

    <!-- Sidebar -->
    <x-sidebar>

    </x-sidebar>

    <!-- Main Content -->
    <x-divlayouts>
        <div class = "container left">
            <div class="container upperleft">
                <div class="container panel-1"></div>
            </div>
            <div class = "container lowerleft">
                <div class="container panel-3"></div>
                <div class="container panel-4">
                </div>
            </div>
        </div>
        <div class="container right">
            <div class="container panel-2">
                <form action="/agraCourses">
                    <button class="btn btn-primary" type="submit">
                        GET STARTED
                        <i class="bi bi-arrow-right-circle"></i>
                    </button>
                </form>
            </div>
        </div>


    </x-divlayouts>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
<!-- Custom Script -->

<script src="/agra.js"></script>
</body>

</html>
