<!-- for home.php -->
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/icon" href="../image/logo/logo1.png">       <!--head eke icon eka tab ekata-->

    <title>AIMS</title>
    
    <link rel="stylesheet" href="../resources/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../resources/DataTables/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../resources/fontawesome/css/all.css">
    <link rel="stylesheet" href="../resources/fancybox/jquery.fancybox.css">
    <link rel="stylesheet" href="../resources/animate.css/animate.min.css">
    <link rel="stylesheet" href="../css/custom.css">

    <script src="../resources/jquery/jquery-3.6.0.min.js"></script>
    <script src="../resources/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../resources/DataTables/js/jquery.dataTables.min.js"></script>
    <script src="../resources/fancybox/jquery.fancybox.js"></script>
    <script src="../resources/sweetAlerts2/dist/sweetalert2.all.min.js"></script>

    <style>
        .sec-nav {
            min-height: 80px;
            height: auto;
            background-color: rgba(255, 255, 255, 0.8);
            margin: 0px;
            padding: 0px;
        }
    </style>
</head>







<body>
<div style="background-color: black; height:8px;"></div>    <!--nav bar ekata uda orange color bar eka-->





<!--  1st navigation bar eka ----------------------------------------------------------------------------------------------------------------------------->

                <!--1.navbar navbar-dark bg-dark(nav bar ekata color ek dnna)   
                    2.apata kamathi patak da gnna one nm  nav class="navbar navbar-light" style="background-color: #e3f2fd;"  me widiyta
                    3.btn btn-primary class eke"" athulata dnna ethakota button eke color eka change kra gnn puluwan (login button ekta kale)
                --->


    <nav class="navbar navbar-expand-md  justify-content-md-around navbar navbar-light"style="background-color:rgba(20,61,47)">
  
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

       <!--screen eka size change karama menu button eken pahalata gnna widiaya  ona dewal add kara gnna-->
        <div class="collapse navbar-collapse order-1 order-md-0" id="navbarNav">
           
        </div>
 <!--hii user kiyana ekaii login button ekaii-->
        <div>
            

                    <a id="loginBtn" href="../newlogin/login.php" class="button btn border-0 text-white text-uppercase text-decoration-none btn btn-primary" style="color:F9C10B">
                        <i class="fas fa-sign-in"></i> Login </a>

               
            </span>&nbsp;&nbsp;
        </div>

    </nav>










    <!-- /////////////////////////////////// 2nd Navbar ///////////////////////////////////// -->

        <!-- 1. sticky-top navbar kiynne eka hide wenne na top eke thiyenwa contet eka witharai scroll wenne.
        

         -->

    <nav id="sec-nav" class="navbar sec-nav sticky-top navbar-expand-sm justify-content-center">

        <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button> -->

        <div class="mid-logo mr-auto">
            <div class="navbar-brand">
                <img src="../image/NewLogo.png" href="../view/home.php"width="100px" height="100px" class="align-top" alt="logo">
            </div>
        </div>

        <ul class="navbar-nav text-uppercase font-weight-bolder">
            <li class="nav-item">
                <a class="nav-link navmenu" href="../view/home.php"style="color:rgba(11, 87, 4)">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link navmenu" href=""style="color:rgba(11, 87, 4)">Introduction</a>
            </li>
            <li class="nav-item">
                <a class="nav-link navmenu" href=" "style="color:rgba(11, 87, 4)">About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link navmenu" href=""style="color:rgba(11, 87, 4)">View Latest News</a>
            </li>
            <li class="nav-item">
                <a class="nav-link navmenu" href=""style="color:rgba(11, 87, 4)">Contact Us</a>
            </li>
        </ul>
    </nav>

    <!--body html tag close krnne na-->