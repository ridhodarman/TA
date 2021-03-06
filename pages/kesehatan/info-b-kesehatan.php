<?php session_start(); ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>health building info</title>
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

                $querysearch = "SELECT H.health_building_id, H.name_of_health_building, H.building_area, H.land_area, H.parking_area, H.standing_year, H.electricity_capacity, H.address, H.type_of_construction, H.type_of_health_building, H.name_of_head, H.number_of_medical_personnel, H.number_of_nonmedical_personnel, M.name_of_model,
                                ST_X(ST_Centroid(H.geom)) AS longitude, ST_Y(ST_CENTROID(H.geom)) As latitude,
                                T.name_of_type as constr, J.name_of_type as type, ST_AsText(geom) as geom,
                                T.type_id AS constr_id, J.type_id AS type_hid, H.model_id
					            FROM health_building as H
                                LEFT JOIN type_of_construction as T ON H.type_of_construction=T.type_id
                                LEFT JOIN type_of_health_building as J ON H.type_of_health_building=J.type_id
                                LEFT JOIN building_model AS M ON M.model_id=H.model_id
                                WHERE H.health_building_id='$id' 
				            ";

                $hasil = pg_query($querysearch);
                while ($row = pg_fetch_array($hasil)) {
                    $longitude = $row['longitude'];
                    $latitude = $row['latitude'];
                    $nama = $row['name_of_health_building'];
                    $bang = $row['building_area'];
                    $lahan = $row['land_area'];
                    $parkir = $row['parking_area'];
                    $tahun = $row['standing_year'];
                    $listrik = $row['electricity_capacity'];
                    $alamat = $row['address'];
                    $konstruksi = $row['constr'];
                    $jenis = $row['type'];
                    $id_k = $row['type_of_construction'];
                    $id_h = $row['type_of_health_building'];
                    $kepala = $row['name_of_head'];
                    $medis = $row['number_of_medical_personnel'];
                    $non = $row['number_of_nonmedical_personnel'];
                    $geom = $row['geom'];
                    $model = $row['name_of_model'];
                    $id_model = $row['model_id'];
                    $id_kons = $row['constr_id'];
                    $id_jenis = $row['type_hid'];
                }

                

                function tampilfoto(){
                    $id=$_GET['id'];
                    $sql = pg_query("SELECT photo_url, upload_date FROM health_building_gallery WHERE health_building_id='$id' 
                            ");
                    $cek = pg_num_rows($sql);

                    $n=0;$foto;$tglfoto;
                    while ($row = pg_fetch_assoc($sql)) {
                        $foto[$n]=$row['photo_url'];
                        $tglfoto[$n]=$row['upload_date'];
                        $n++;
                    }

                    $server='../../foto/b-kesehatan/';
                    echo '<div data-carousel-3d>';
                    if ($cek<1) {
                        echo '
                                <div style="min-width: 320px; min-height: 213px; max-height: 700px; max-height: 500px; text-align-last: center;  vertical-align: middle; display: table-cell;">
                                    <img src="../../foto/rs.png" />
                                    <a class="icon-container" style="background-color: #d8dbff" href="#">
                                        <span class="ti-na"></span><span class="icon-name">No Image Available</span>
                                    </a>
                                </div>
                                <div style="min-width: 320px; min-height: 213px; max-height: 700px; max-height: 500px; text-align-last: center;  vertical-align: middle; display: table-cell;">
                                    <img src="../../foto/rs.png" />
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
                <h3>Health Building Info</h3>
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
                                        <h5 class="mb-3">Photo
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
                                                icon:server+'assets/ico/kesehatan.png',
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