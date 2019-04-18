<?php session_start(); ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>worship building info</title>
    <?php 
        include('../../inc/koneksi.php');
        include('../inc/head.php');
        include('../inc/headinfodanslideshow.php');
    ?>
    <script type="text/javascript" src="../../script.js"></script>
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
            <?php
                $id=$_GET['id'];

                $querysearch = "SELECT W.worship_building_id, W.name_of_worship_building, W.building_area, W.land_area, W.parking_area, W.standing_year, W.electricity_capacity, W.address, W.type_of_construction, W.type_of_worship,
                                ST_X(ST_Centroid(W.geom)) AS longitude, ST_Y(ST_CENTROID(W.geom)) As latitude,
                                T.name_of_type as constr, J.name_of_type as type,
                                ST_AsText(geom) as geom
					            FROM worship_building as W
                                LEFT JOIN type_of_construction as T ON W.type_of_construction=T.type_id
                                LEFT JOIN type_of_worship as J ON W.type_of_worship=J.type_id
                                WHERE W.worship_building_id='$id' 
				            ";

                $hasil = pg_query($querysearch);
                while ($row = pg_fetch_array($hasil)) {
                    $longitude = $row['longitude'];
                    $latitude = $row['latitude'];
                    $nama = $row['name_of_worship_building'];
                    $bang = $row['building_area'];
                    $lahan = $row['land_area'];
                    $parkir = $row['parking_area'];
                    $tahun = $row['standing_year'];
                    $listrik = $row['electricity_capacity'];
                    $alamat = $row['address'];
                    $konstruksi = $row['constr'];
                    $jenis = $row['type'];
                    $tipe_k = $row['type_of_construction'];
                    $tipe_i = $row['type_of_worship'];
                    $geom = $row['geom'];
                }

                

                function tampilfoto(){
                    $id=$_GET['id'];
                    $sql = pg_query("SELECT photo_url, upload_date FROM worship_building_gallery WHERE worship_building_id='$id' 
                            ");
                    $cek = pg_num_rows($sql);

                    $n=0;$foto;$tglfoto;
                    while ($row = pg_fetch_assoc($sql)) {
                        $foto[$n]=$row['photo_url'];
                        $tglfoto[$n]=$row['upload_date'];
                        $n++;
                    }

                    $server='../../foto/b-ibadah/';
                    echo '<div data-carousel-3d>';
                    if ($cek<1) {
                        echo '
                                <div style="min-width: 320px; min-height: 213px; max-height: 700px; max-height: 500px; text-align-last: center;  vertical-align: middle; display: table-cell;">
                                    <img src="../../foto/ibadah.png" />
                                    <a class="icon-container" style="background-color: #d8dbff" href="#">
                                        <span class="ti-na"></span><span class="icon-name">No Image Available</span>
                                    </a>
                                </div>
                                <div style="min-width: 320px; min-height: 213px; max-height: 700px; max-height: 500px; text-align-last: center;  vertical-align: middle; display: table-cell;">
                                    <img src="../../foto/ibadah.png" />
                                    <a class="icon-container" style="background-color: #d8dbff" href="#">
                                        <span class="ti-na"></span><span class="icon-name">No Image Available</span>
                                    </a>
                                </div>
                        ';
                    }
                    else{
                        $i=0;
                        while($i<$n){
                            echo'
                            <div style="min-width: 320px; min-height: 213px; max-height: 700px; max-height: 500px; text-align-last: center;  vertical-align: middle; display: table-cell;">
                                <img src="'.$server.$foto[$i].'" />
                                <label>Uploaded: '.$tglfoto[$i].'</label>
                                <a class="icon-container" style="background-color: #d8dbff" href="'.$server.$foto[$i].'" target="_blank">
                                    <span class="ti-zoom-in"></span><span class="icon-name">Fullscreen</span>
                                </a>
                            </div>';
                            $i++;
                        }
                        
                    }
                    
                    if ($n==1) {
                        echo '
                                    <div style="min-width: 320px; min-height: 213px; max-height: 700px; max-height: 500px; text-align-last: center;  vertical-align: middle; display: table-cell;">
                                    <img src="'.$server.$foto[$i-1].'" />
                                    <label>Uploaded: '.$tglfoto[$i-1].'</label>
                                    <a class="icon-container" style="background-color: #d8dbff" href="'.$server.$foto[$i-1].'" target="_blank">
                                        <span class="ti-zoom-in"></span><span class="icon-name">Fullscreen</span>
                                    </a>
                                </div>';
                    }
                    echo '</div>';    
                    
                    echo "Total Photo: ".$cek;
                    
                     
                }

            ?>

            <div class="main-content-inner">
                <h3>Worship Building Info</h3>
                <div class="row">
                    <div class="col-lg-5 mt-5">
                        <?php include ('inc/info.php') ?>
                    </div>
                    <div class="col-lg-7 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="media mb-5">
                                    <div class="media-body">
                                        <?php include ('inc/editfoto.php') ?>
                                        <h5 class="mb-3">Foto
                                            <button data-toggle="modal" data-target="#ukuranpenuh" class="btn btn-warning btn-sm"
                                                title="show all images in full screen">
                                                <i class="ti-fullscreen"></i>
                                            </button>
                                        </h5>
                                        <?php tampilfoto() ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-5">
                                        <?php include('inc/info-fasilitas.php') ?>
                    </div>
                    <div class="col-lg-6 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="media mb-5">
                                    <div class="media-body">
                                        <h5 class="mb-3">Location</h5>
                                        <?php include ('inc/editspasial.php') ?>
                                        <div style="padding-left: 1%; padding-bottom: 1%;">
                                            <?php include('../../inc/aturlayer.php') ?>
                                        </div>
                                        <div style="width:100%; height: 360px;" id="map2"></div>
                                        <script>
                                            function initMap() {
                                                posisi = {lat: <?php echo $latitude ?>, lng: <?php echo $longitude ?>}
                                                map = new google.maps.Map(document.getElementById('map2'), {
                                                    center: posisi,
                                                    zoom: 19,
                                                    mapTypeId: 'satellite'
                                                });
                                                server='../../'
                                                semuadigitasi();

                                                var marker = new google.maps.Marker({
                                                position: posisi,
                                                icon:server+'assets/ico/musajik.png',
                                                animation: google.maps.Animation.BOUNCE,
                                                map: map
                                                });
                                            }

                                            initMap();
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                </div>
            </div> <!-- SAMPAI DISINI BATAS ROW-->

            <div class="modal fade bd-example-modal-lg modal-xl" id="ukuranpenuh">
                <div class="modal-dialog modal-lg modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Foto</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <?php tampilfoto() ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- main content area end -->
            <!-- footer area start-->
    <?php include('../inc/foot.php') ?>


            <script type="text/javascript">
                
                function back() {
                    window.location = "index.php";
                }
            </script>
</body>

</html>