<?php session_start(); ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>srtdash - ICO Dashboard</title>
    <?php include('inc/index-head.php') ?>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <!-- <div id="preloader">
        <div class="loader"></div>
    </div> -->
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
        <?php include('inc/sidebar.php') ?>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div style="position: fixed; z-index: 1; width: 100%">
                <div class="header-area" id="tampilan-header">
                    <div class="row align-items-center">
                        <!-- nav and search button -->
                        <div class="col-md-6 col-sm-8 clearfix">
                            <div class="nav-btn pull-left">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                        <!-- profile info & task notification -->
                        <div class="clearfix">
                            <ul class="notification-area pull-right">   
                                <li><button class="btn btn-outline btn-primary" onclick="dashboard()"><i class="ti-direction-alt"></i> Back To Admin Dashboard</button></li>                         
                                <li id="full-view"><i class="ti-fullscreen"></i></li>
                                <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                                <li class="user-name dropdown-toggle" data-toggle="dropdown"><i class="ti-settings"></i>
                                    <div class="dropdown-menu">
                                        <div class="icon-container" onclick="pengaturan()" style="font-size: 90%"><span class="icon-name">&emsp;<i class="fas fa-wrench"></i> Account Setting</span></div>
                                        <div class="icon-container" onclick="logout()" style="font-size: 90%"><span class="icon-name">&emsp;<i class="fas fa-sign-out-alt"></i> Log Out</span></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div style="visibility: hidden; z-index: 0" id="belakang"></div>
            <script type="text/javascript">
                $("#tampilan-header").clone().prependTo("#belakang");

                function pengaturan () {
                     window.location.href="setting/akun.php";
                }

                function logout () {
                     window.location.href="../act/logout.php";
                }
            </script>
            <!-- header area end -->

            <br/>

            <!-- page title area start -->
            <!-- page title area end -->
            
            <div class="main-content-inner">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="far fa-building"></i> Manage Building Data</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="konstruksi-tab" data-toggle="tab" href="#konstruksi" role="tab" aria-controls="konstruksi" aria-selected="false"><i class="fas fa-hammer"></i> Manage Data on Types of Construction</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="model-tab" data-toggle="tab" href="#model" role="tab" aria-controls="model" aria-selected="false"><i class="fas fa-home"></i> Manage Building Model Data</a>
                            </li>
                        </ul>
                        <div class="tab-content mt-3" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <?php include ("tab/databangunan.php") ?>
                            </div>
                            <div class="tab-pane fade" id="konstruksi" role="tabpanel" aria-labelledby="konstruksi">
                                <?php include ("tab/jeniskonstruksi.php") ?>
                            </div>

                            <div class="tab-pane fade" id="model" role="tabpanel" aria-labelledby="model">
                                <?php include ("tab/modelbangunan.php") ?>
                            </div>
                        </div>
                    </div>
                </div>          
            </div>



    <!-- SAMPAI DISINI -->
    
                
                <!-- row area start-->
            </div>
        </div>

    <!-- page container area end -->
    <!-- offset area start -->

    <!-- offset area end -->

    <?php include('inc/index-foot.php') ?>
</body>
    <script type="text/javascript">
        $("#databangunan").addClass("active");

        function dashboard() {
            window.location.href="../";
        }
    </script>
</html>
