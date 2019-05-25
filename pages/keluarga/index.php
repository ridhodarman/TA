<?php session_start(); ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>srtdash - ICO Dashboard</title>

    <?php include('../inc/head.php'); ?>
    <link rel="stylesheet" href="../dist/css/bootstrap-select.css">
    <link rel="stylesheet" href="../../assets/alertify/themes/alertify.core.css" />
    <link rel="stylesheet" href="../../assets/alertify/themes/alertify.default.css" id="toggleCSS" />
    <meta name="viewport" content="width=device-width">
    <script src="../../assets/alertify/lib/alertify.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
          <div class="wrapper">
            <div class="circle circle-1"></div>
            <div class="circle circle-1a"></div>
            <div class="circle circle-2"></div>
            <div class="circle circle-3"></div>
          </div>
          <h1 style="font-size: 200%">Loading&hellip;</h1>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <?php include('../inc/sidebar.php') ?>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <?php include ('../inc/header2.php'); ?>
            <!-- header area end -->
            <!-- page title area start -->
            <br>
            <!-- page title area end -->
            <div class="main-content-inner">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                        	<li class="nav-item">
                                <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#home2" role="tab" aria-controls="home2" aria-selected="true"><i class="fas fa-user-edit"></i> Citizen</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-users"></i> Family Card</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pendidikan-tab" data-toggle="tab" href="#pendidikan" role="tab" aria-controls="pendidikan" aria-selected="false"><i class="fas fa-user-ninja"></i>Education List</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="kerja-tab" data-toggle="tab" href="#kerja" role="tab" aria-controls="kerja" aria-selected="false"><i class="fas fa-chalkboard-teacher"></i>Job List</a>
                            </li>
                        </ul>
                        <div class="tab-content mt-3" id="myTabContent">
                        	<div class="tab-pane fade show active" id="home2" role="tabpanel" aria-labelledby="home-tab2">
                                <?php include ("tab/listpenduduk.php") ?>
                            </div>
                            <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <?php include ("tab/listkk.php") ?>
                            </div>
                            <div class="tab-pane fade" id="pendidikan" role="tabpanel" aria-labelledby="pendidikan-tab">
                                    <?php include ("tab/listpendidikan.php") ?>
                            </div>
                            <div class="tab-pane fade" id="kerja" role="tabpanel" aria-labelledby="kerja-tab">
                                <?php include ("tab/listkerja.php") ?>
                            </div>
                        </div>
                    </div>
                </div>          
            </div>

    <!-- SAMPAI DISINI -->
    
                
                <!-- row area start-->
            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <?php include('../inc/foot.php') ?>
        <!-- footer area end-->
    </div>
  
    <script type="text/javascript">
        function back() {
            window.history.back();
        }

        $("#keluarga").addClass("active");
    </script>
    <link rel="stylesheet" href="../../js/bootstrap.bundle.min.js" />
    <script src="../dist/js/bootstrap-select.js"></script>
</body>
</html>
