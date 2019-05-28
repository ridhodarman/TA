<?php session_start(); ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>house building info</title>
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

                $querysearch = "SELECT H.owner_id, H.address, H.standing_year, H.land_building_tax, H.type_of_construction, H.electricity_capacity, H.tap_water, H.building_status,
                                ST_X(ST_Centroid(H.geom)) AS longitude, ST_Y(ST_CENTROID(H.geom)) AS latitude, ST_AsText(H.geom) AS geom,
                                T.name_of_type AS jkonstruksi, M.name_of_model, H.model_id,
                                C.*
                                FROM house_building AS H
                                LEFT JOIN type_of_construction AS T ON H.type_of_construction=T.type_id
                                LEFT JOIN citizen AS C ON H.owner_id=C.national_identity_number
                                LEFT JOIN building_model AS M ON M.model_id=H.model_id
                                WHERE H.house_building_id='$id' 
                            ";

                $hasil = pg_query($querysearch);
                while ($row = pg_fetch_array($hasil)) {
                    $longitude = $row['longitude'];
                    $latitude = $row['latitude'];
                    $nik = $row['owner_id'];
                    $alamat = $row['address'];
                    $tahun = $row['standing_year'];
                    $pbb = $row['land_building_tax'];
                    
                    $tipe_k = $row['type_of_construction'];
                    $jkonstruksi = $row['jkonstruksi'];
                    
                    $listrik = $row['electricity_capacity'];
                    
                    $i_water = $row['tap_water'];
                    $pdam=null;
                    if ($i_water==0) {
                        $pdam = "Not Available";
                    }
                    else if ($i_water==1) {
                        $pdam = "Available";
                    }
                    else if ($i_water==3) {
                        $pdam = "unknown";
                    }

                    $status=null;
                    $i_status = $row['building_status'];
                    if ($i_status==0) {
                        $status = "Unhabited";
                    }
                    else if ($i_status==1) {
                        $status = "Inhabited";
                    }
                    else if ($i_status==3) {
                        $status = "unknown";
                    }

                    $nama = $row['name'];
                    $nokk = $row['family_card_number'];
                    $tgl = $row['birth_date'];
                    $pendidikan = $row['educational_id'];
                    $pekerjaan = $row['job_id'];

                    $pendapatan = $row['income'];

                    $datuk = $row['datuk_id'];

                    $geom = $row['geom'];

                    $model = $row['name_of_model'];
                    $id_model = $row['model_id'];
                }

                

                function tampilfoto(){
                    $id=$_GET['id'];
                    $sql = pg_query("SELECT photo_url, upload_date FROM house_building_gallery WHERE house_building_id='$id' 
                            ");
                    $cek = pg_num_rows($sql);

                    $n=0;$foto;$tglfoto;
                    while ($row = pg_fetch_assoc($sql)) {
                        $foto[$n]=$row['photo_url'];
                        $tglfoto[$n]=$row['upload_date'];
                        $n++;
                    }

                    $server='../../foto/rumah/';
                    echo '<div data-carousel-3d>';
                    if ($cek<1) {
                        echo '
                                <div style="min-width: 320px; min-height: 213px; max-height: 700px; max-height: 500px; text-align-last: center;  vertical-align: middle; display: table-cell;">
                                    <img src="../../foto/rumah.png" />
                                    <a class="icon-container" style="background-color: #d8dbff" href="#">
                                        <span class="ti-na"></span><span class="icon-name">No Image Available</span>
                                    </a>
                                </div>
                                <div style="min-width: 320px; min-height: 213px; max-height: 700px; max-height: 500px; text-align-last: center;  vertical-align: middle; display: table-cell;">
                                    <img src="../../foto/rumah.png" />
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
                <h3>House Building Info</h3>
                <div class="row">
                    <div class="col-lg-6 mt-5">
                        <?php include ('inc/info.php') ?>
                    </div>
                    <div class="col-lg-6 mt-5">
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
                                        <?php include('inc/info-pemilik.php') ?>
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
                                                icon:server+'assets/ico/home.png',
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

                    <?php
                        $query = pg_query("SELECT family_card_number FROM family_card WHERE house_building_id='$id'");

                        $jumlah_kk = pg_num_rows($query);

                    ?>      
                <div class="col-lg-12 mt-6" style="padding-top: 1%">
                    <div class="card">
                        <div class="card-body">
                                <div class="media-body">
                                    <div style="float: right">
                                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#tambahpenghuni">
                                            <b><i class="fa fa-user-plus"></i> Add Householder</b>
                                        </button>
                                    </div>
                                            

                            <div class="modal fade" id="tambahpenghuni">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <form action="act/tambahpenghuni.php" method="POST">
                                            <div class="modal-header">
                                                <h6 class="modal-title">Add Householder</h6>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <select class="selectpicker form-control" id="kk" data-container="body" data-live-search="true" title="Choose FCN" data-hide-disabled="true" style="font-size: 89%; font-weight: bold" onchange="simpanpenghuni()">
                                                    <?php                
                                                        $sql_d=pg_query("SELECT family_card_number FROM family_card");
                                                        while($row = pg_fetch_assoc($sql_d))
                                                        {
                                                            echo"<option value=".$row['family_card_number'].">".$row['family_card_number']."</option>";
                                                        }
                                                    ?>
                                                </select>
                                                <a href="../keluarga">
                                                    <button type="button" class="btn btn-success btn-xs btn-flat btn-lg mt-3"><i class="fas fa-users"></i> Manage Family Card Data</button>
                                                </a>
                                                <input type="hidden" name="penghuni" id="penghuni">
                                                <input type="hidden" name="id-bang2" value="<?php echo $id ?>"/>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">+ Add</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                    
                        
                    <h6>Householder List:</h6></div>
                   

                    <table class="table table-hover" style="width: 70%">
                    <tr>
                        <th>Family Card Number</th>
                        <th><center> Action</center></th>
                    </tr>
                    <?php
                            while ($data=pg_fetch_assoc($query)) {
                            $kk_penghuni = $data['family_card_number'];
                                echo "<tr>";
                                echo "<td>".$kk_penghuni."</td>";
                                echo '<td><center>
                                    <a href="../keluarga/info-kk.php?id='.$kk_penghuni.'" class="btn btn-info btn-xs">
                                        <i class="fa fa-info"></i> View Details</a> 
                                    <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#coret-kk'.$nik.'">
                                        <i class="fas fa-user-minus"></i> Remove</button>
                                    </center><td>';
                                echo "</tr>";
                                echo '
                                    <div class="modal fade" id="coret-kk'.$nik.'">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Delete '.$kk_penghuni.' ?</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure to delete "'.$kk_penghuni.'" from list of residents? <br/>
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <a href="act/hapuspenghuni.php?kk='.$kk_penghuni.'&bang='.$id.'" ><button type="button" class="btn btn-danger" ">Remove</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                ';
                                
                            }

                            if ($jumlah_kk < 1  ) { 
                                echo "<td colspan='2'><center>No data..</center></td>";
                            }

                        ?>
                        </table>
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
                            <h5 class="modal-title">Photo</h5>
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

    document.getElementById("penghuni").value=document.getElementById("kk").value;
    function simpanpenghuni() {
        document.getElementById("penghuni").value=document.getElementById("kk").value;
    }
</script>
</body>

</html>