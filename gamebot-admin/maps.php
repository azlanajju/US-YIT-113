<!DOCTYPE html>
<html lang="en">
<?php
include("./getSystem.php");
include('./config.php');
if(isset($_GET['resetId'])){
    $resetId = $_GET['resetId'];
    $resetSql = "UPDATE messages SET no_of_players = '0' WHERE id = '$resetId'";
    $resetResult = $conn->query($resetSql);
}

?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!-- start linking  -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800,900" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/app.css" />
    <!-- icon -->
    <link rel="icon" href="img/log.png" />
    <!-- end linking -->
    <title>NutFlix - admin</title>

    <style>
        .system {
            padding: 25px;
            background-image: linear-gradient(89deg, #32ad39, #a2ffb1);
            border-radius: 12px;
            box-shadow: 5px 5px 5px #8080809c;
        }




        label.label-system-active {
            margin-bottom: 0px;
            margin-right: 5px;
        }

        select#players {
            background: white;
            border: 0px;
            box-shadow: 2px 2px 5px grey;
            padding: 5px;
            border-radius: 10px;
        }



        .timing-parent,
        .Cafe-parent {
            padding: 12px;
            border-radius: 10px;
            background-color: white;
        }

        p.total-time {
            margin-bottom: 0px;
            font-size: 14px;
        }

        .d-flex.food-head.justify-content-between {
            padding: 5px;
            background: #99f8a7;
            border-radius: 8px;
        }

        .food-taken,
        .food-total {
            padding: 5px;
        }

        .food-total {
            border-top: 1px solid black;
        }

        .cafe-list.row {
            background: #f5f5f5;
            padding: 5px 0px;
            border-bottom: 1px solid white;
        }
    </style>
</head>

<body>
    <!-- start admin -->
    <section id="admin">
        <!-- start sidebar -->
        <div class="sidebar">
            <!-- start with head -->
            <div class="head">
                <div class="logo">
                    <img src="img/site-logo.png" alt="Site Logo" />
                </div>
            </div>
            <!-- end with head -->
            <!-- start the list -->
            <div id="list">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="index.html" class="nav-link "><i class="fa fa-adjust"></i>Dashboard</a>
                    </li>
                    <!-- end user interface submenu -->

                    <li class="nav-item">
                        <a href="" class="nav-link active"><i class="fab fa-playstation"></i> Maps</a>
                    </li>
                    <li class="nav-item">
                        <a href="stats.html" class="nav-link"><i class="fa fa-chart-pie"></i>Stats</a>
                    </li>
                    <li class="nav-item">
                        <a href="cafe.html" class="nav-link"><i class="fas fa-utensils"></i> Cafe</a>
                    </li>

                    <li class="nav-item">
                        <a href="membership.html" class="nav-link"><i class="fa fa-users"></i>Membership</a>
                    </li>
                </ul>
            </div>
            <!-- end the list -->
        </div>
        <!-- end sidebar -->
        <!-- start content -->
        <div class="content">
            <!-- start content head -->
            <div class="head">
                <!-- head top -->
                <div class="top">
                    <div class="left">
                        <button id="on" class="btn btn-info">
                            <i class="fa fa-bars"></i>
                        </button>
                        <button id="off" class="btn btn-info hide">
                            <i class="fa fa-align-left"></i>
                        </button>

                    </div>
                    <div class="right">

                        <div class="dropdown">
                            <button class="btn btn-info dropdown-toggle" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                mohamed
                            </button>
                            <div class="dropdown-menu" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">Manipal</a>
                                <!-- <a class="dropdown-item" href="#">sitting</a> -->
                                <!-- <a class="dropdown-item" href="#">log out</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end head top -->
            <!-- start head bottom -->
            <div id="real">
                <!-- start content here -->
                <div class="wrap">
                    <section class="app-content">
                        <div class="row justify-content-between">
                            <div class="col-md-12 widget">
                                <div class=" row g-0 justify-content-between">
                                    <?php
                                    echo $systems;

                                    ?>
                                </div>
                            </div>

                        </div>

                    </section>
                </div>
            </div>
        </div>
    </section>
    <!-- start screpting -->
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="js/highcharts.js"></script>
    <script src="js/chart.js"></script>
    <script src="js/app.js"></script>
    <!-- end screpting -->
</body>

</html>