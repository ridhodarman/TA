<?php session_start(); ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>srtdash - ICO Dashboard</title>
    
    <?php include('inc/head.php') ?>

    <script src="//maps.google.com/maps/api/js?key=AIzaSyBNnzxae2AewMUN0Tt_fC3gN38goeLVdVE"></script>
    
    <script type="text/javascript" src="script.js"></script>
    <script type="text/javascript" src="script_rumah.js"></script>
    <script type="text/javascript" src="script_umkm.js"></script>
    <script type="text/javascript" src="script_ibadah.js"></script>
    <script type="text/javascript" src="script_office.js"></script>
    <script type="text/javascript" src="script_pendidikan.js"></script>
    <script type="text/javascript" src="script_kesehatan.js"></script>
</head>

<body>
    <div id="legend" class="panel panel-primary">
        <div style="text-align: center;"><h6>LEGEND</h6></div>
    </div>
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
        <?php include('inc/sidebar.php') ?>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div style="position: fixed; z-index: 1; width: 100%">
                <div class="header-area" id="tampilan-header">
                    <div class="row align-items-center">
                        <!-- nav and search button -->
                        <div class="col-md-4 col-sm-8 clearfix">
                            <div class="nav-btn pull-left">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                        <!-- profile info & task notification -->
                        <div class="col-md-8 col-sm-4 clearfix">
                            <ul class="notification-area pull-right" style="padding-right: 32%">
                                <li id="tombol-login"><button class="btn btn-outline btn-primary" data-toggle="modal" data-target="#login"><i class="fas fa-sign-in-alt"></i> Login</button></li>
                                <li id="kelola"><button class="btn btn-outline btn-primary" onclick="keloladata()"><i class="ti-settings"></i> Manage Data</button></li>
                                <li id="settingan" class="user-name dropdown-toggle" data-toggle="dropdown">
                                    <i class="ti-settings"></i>
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

            <style type="text/css">
                .gambarlogin {
                    background-image: url('inc/bg.jpg');
                     -webkit-background-size: 100% 100%;
                    -moz-background-size: 100% 100%;
                    -o-background-size: 100% 100%;
                    background-size: 100% 100%;
                    }
                .tulisan {
                    text-shadow: #ff0000 0 0 10px;
                    color: white;
                    font-weight : bold; 
                }
                .form-transparan {
                    background: rgba(0, 0, 0, 0.59);
                    color: lightgray;
                }

                .tombol-login {
                    background: rgba(0, 93, 199, 0.68);
                }

                .tombol-kensyel {
                    background: rgba(0, 12, 26, 0.68)
                }
            </style>
            <div class="modal fade" id="login">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content gambarlogin">
                        <div class="modal-header">
                            <h5 class="modal-title tulisan">L o g i n</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <form method="post" action="act/login.php" style="width: 90%">
                        <div class="modal-body">
                            <font class="tulisan">Username:</font>
                            <input type="text" class="form-control form-transparan" name="username" placeholder="username..." required>
                            <font class="tulisan">Password:</font>
                            <input type="password" class="form-control form-transparan" name="password" placeholder="password..." required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary tombol-kensyel" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary tombol-login"><i class="fas fa-sign-in-alt"></i> Login</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="belakang" style="z-index: 0; visibility: hidden;"></div>
            <script type="text/javascript">
                $("#tampilan-header").clone().prependTo("#belakang");

                function pengaturan () {
                     window.location.href="pages/setting/akun.php";
                }

                function logout () {
                     window.location.href="act/logout.php";
                }

                function keloladata () {
                     window.location.href="pages";
                }
            </script>
            <!-- header area end -->
            <!-- page title area start -->

            <!-- page title area end -->
            <div class="main-content-inner">
                <input type="hidden" name="" id="jr" style="width: 50px">
                <input type="hidden" name="" id="lat" style="width: 5px">
                <input type="hidden" name="" id="lng" style="width: 5px">
                <!-- sales report area start -->
                <br />
                <button class="btn btn-default" title="current position" onclick="aktifkanGeolocation()"><i class="fas fa-map-marker-alt"></i></button>
                <button class="btn btn-default" title="manual position" onclick="manualLocation()"><i class="fas fa-map-marked-alt"></i></button>

                <a id="legenda">
                    <button class="btn btn-default" title="show legend" onclick="legenda()"><i class="fa fa-globe"></i></button>
                </a>

                <?php include('inc/aturlayer.php') ?>

                <button class="btn btn-default" title="refresh" onclick="refresh()"><i class="fa fa-refresh"></i></button>

                

                <p/>

                <div class="row">
                    <div id="peta" style="width: 100%">
                        <br />
                        <div style="width:100%; height: 450px;" id="map"></div>
                    </div>

                    <div class="col-md-3" id="detail-informasi-pencarian">
                        <button class="btn btn-default btn-xs" onclick="sembunyikancari()" id="hidecari" style="float: right;"><i
                                class="fa fa-times-circle"></i> Close Result</button>
                        <div class="panel-body table-responsive card" id="rute">
                            <!-- <div id="detailrute"></div> -->
                        </div>
                        <font id="found"></font>
                        <div class="panel-body table-responsive" id="panjangtabel">
                            <table class="table table-striped table-bordered table-hover" id="tampilanpencarian" style="background-color: white; border-radius: 7%">
                                <thead>
                                    <tr style="background-color: #4336FB; color: white">
                                        <th colspan="2" style="text-align: center;">Result</th>
                                    </tr>
                                </thead>
                                <tbody id="hasilcari">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- SAMPAI DISINI -->
                
            </div>
        </div>


        <button class="btn btn-default" data-toggle="modal" data-target="#kosong">+ Not Found</button>

        <button class="btn btn-default" data-toggle="modal" data-target="#atur-posisi">+ Posisinya</button>


        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>© Copyright 2018. All right reserved. Template by <a href="https://colorlib.com/wp/">Colorlib</a>.</p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
    <!-- offset area start -->

    <script>
        var map;

        function initMap() {
            loadpeta();
            semuadigitasi();
        }

        initMap();
    </script>
    <!-- offset area end -->

    <!-- Notifikasi untuk klik pada peta -->
    <div class="modal fade" id="posisimanual">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <center>
                        <div>
                            <img src="inc/klikpeta.gif" style="width: 150px">
                            <p>Click on the map</p>
                        </div>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">OK</button>
                    </center>
                </div>
            </div>
        </div>
    </div>

    <!-- Notifikasi untuk mengatur lokasi -->
    <div class="modal fade" id="atur-posisi">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <center>
                        <div>
                            <img src="inc/marker.gif" style="width: 150px">
                            <p>Click the current position or manual position button first!</p>
                        </div>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">OK</button>
                    </center>
                </div>
            </div>
        </div>
    </div>

    <!-- Notifikasi pencarian tidak ditemukan -->
    <div class="modal fade" id="kosong">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-dialog modal-sm" style="width: 200%">
                <div class="modal-content">
                    <div class="modal-body">
                        <center>
                            <div>
                                <p style="font-size: 400%; color: #edd83b"><i class="fas fa-exclamation-circle"></i></p>
                                <p>Not Found</p>
                            </div>
                            <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="peringatan">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-dialog modal-sm" style="width: 200%">
                <div class="modal-content">
                    <div class="modal-body">
                        <center>
                            <div>
                                <p style="font-size: 400%; color: #edd83b"><i class="fas fa-exclamation-circle"></i></p>
                                <div id="ket-p"></div>
                            </div>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">OK</button>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="gagal">
        <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <center>
                            <div>
                                <p style="font-size: 400%; color: red"><i class="far fa-times-circle"></i></p>
                                <p>Oopss..,  Something went wrong!</p>
                                <div id="notifikasi"><?php  ?></div>
                            </div>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">OK</button>
                        </center>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>

    <!-- start chart js -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script> -->
    <!-- start highcharts js -->
    <!-- <script src="https://code.highcharts.com/highcharts.js"></script> -->
    <!-- start zingchart js -->
    <!-- <script src="https://cdn.zingchart.com/zingchart.min.js"></script> -->
    <!-- <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script> -->
    <!-- all line chart activation -->
    <script src="assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="assets/js/pie-chart.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>
<script type="text/javascript">
    // $(document).ready(function() {
    //     $('#tampilanpencarian').DataTable({
    //         responsive: true
    //     });
    // }); 289
    $('#tampilanpencarian').hide();
    $('#hidecari').hide();
    $('#legend').hide();
    $("#rute").hide();
</script>
<?php
    if ($akses==true) {
        echo '
            <script>
                $("#kelola").show();
                $("#settingan").show();
                $("#tombol-login").hide();
            </script>
        ';
    }
    else {
        echo '
            <script>
                $("#kelola").hide();
                $("#settingan").hide();
                $("#tombol-login").show();
            </script>
        ';  
    }
?>
</html>
<div class="modal fade bd-example-modal-lg modal-xl" id="info-bang">
    <div class="modal-dialog modal-lg modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jenis-bang"></h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body" style="background-color: #eee">
                <div id="konten-bang"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function detailumkm(id) {
        $("#jenis-bang").empty()
        $("#jenis-bang").append("<i class='fas fa-store-alt'></i> Micro, Small, Medium, Enterprise Building Info")
        $('#konten-bang').load("info-umkm.php?id="+id);
        $('#info-bang').modal('show');
    }

    function detailibadah(id) {
        $("#jenis-bang").empty()
        $("#jenis-bang").append("<i class='fas fa-mosque'></i> Worship Building Info")
        $('#konten-bang').load("info-ibadah.php?id="+id);
        $('#info-bang').modal('show');
    }

    function detailpendidikan(id) {
        $("#jenis-bang").empty()
        $("#jenis-bang").append("<i class='fas fa-school'></i> Educational Building Info")
        $('#konten-bang').load("info-pendidikan.php?id="+id);
        $('#info-bang').modal('show');
    }

    function detailkesehatan(id) {
        $("#jenis-bang").empty()
        $("#jenis-bang").append("<i class='fas fa-hospital-alt'></i> Health Building Info")
        $('#konten-bang').load("info-kesehatan.php?id="+id);
        $('#info-bang').modal('show');
    }

    function detailkantor(id) {
        $("#jenis-bang").empty()
        $("#jenis-bang").append("<i class='fa fa-bank'></i> Office Building Info")
        $('#konten-bang').load("info-kantor.php?id="+id);
        $('#info-bang').modal('show');
    }
</script>