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
                                T.name_of_type AS jkonstruksi,
                                O.*
                                FROM house_building AS H
                                LEFT JOIN type_of_construction AS T ON H.type_of_construction=T.type_id
                                JOIN house_building_owner AS O ON H.owner_id=O.national_identity_number
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

                    $nama = $row['owner_name'];
                    $nokk = $row['family_card_number'];
                    $tgl = $row['birth_date'];
                    $pendidikan = $row['educational_id'];
                    $pekerjaan = $row['job_id'];
                    
                    $asuransi=null;
                    if ($row['savings']!=null) {
                        if ($row['insurance']==1) {
                             $asuransi="Exist";
                         }
                        else if ($row['insurance']==0) {
                            $asuransi="do not have";
                        } 
                    }

                    $pendapatan = $row['income'];

                    $tabungan="-";
                    if ($row['savings']!=null) {
                        if ($row['savings']==1) {
                         $tabungan="Exist";
                         }
                        else if ($row['savings']==0) {
                            $tabungan="do not have";
                        }
                    }

                    $datuk = $row['datuk_id'];

                    $kampung = $row['village_id'];

                    $geom = $row['geom'];
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
                        $query = pg_query("SELECT C.*,
                                        D.datuk_name, T.name_of_tribe, V.village_name, J.job_name, E.educational_level
                                        FROM family_card AS C
                                        LEFT JOIN datuk AS D ON C.datuk_id=D.datuk_id
                                        LEFT JOIN tribe AS T ON D.tribe_id=T.tribe_id
                                        LEFT JOIN village AS V ON C.village_id=V.village_id
                                        LEFT JOIN job AS J ON C.job_id=J.job_id
                                        LEFT JOIN education AS E ON C.educational_id=E.education_id
                                        WHERE C.house_building_id='$id' 
                                    ");

                        $jumlah_kk = pg_num_rows($query);

                    ?>      
                            <div class="col-lg-12 mt-6" style="padding-top: 1%">
                                <div class="card">
                                    <div class="card-body">
                                            <div class="media-body">
                                                <h6 class="mb-3" style="float: left; padding-right: 2px;">Number of Family Heads: <?php echo $jumlah_kk ?></h6>
                                                <div style="float: right">
                                                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#tambahpenghuni">
                                                        <b><i class="fa fa-user-plus"></i> Add Family Head Data</b>
                                                    </button>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="tambahpenghuni">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <form action="act/tambahpenghuni.php" method="POST">
                                            <div class="modal-header">
                                                <h6 class="modal-title">Add Head of Family Data</h6>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <select class="selectpicker form-control" id="kk" data-container="body" data-live-search="true" title="Choose FCN" data-hide-disabled="true" style="font-size: 89%; font-weight: bold" onchange="simpanpenghuni()">
                                                    <option></option>
                                                    <?php                
                                                        $sql_d=pg_query("SELECT family_card_number, head_of_family FROM family_card ORDER BY head_of_family");
                                                        while($row = pg_fetch_assoc($sql_d))
                                                        {
                                                            echo"<option value=".$row['family_card_number'].">(".$row['family_card_number'].") ".$row['head_of_family']."</option>";
                                                        }
                                                    ?>
                                                </select>
                                                <a href="../keluarga">
                                                    <button type="button" class="btn btn-primary btn-xs btn-flat btn-lg mt-3"><i class="fas fa-users"></i> Manage House Holder Data</button>
                                                </a>
                                                <input type="hidden" name="penghuni" id="penghuni">
                                                <input type="hidden" name="id-bang2" value="<?php echo $id ?>"/>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success">+ Add</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                    <?php
                        if ($jumlah_kk >0 ) {
                            echo '<div class="col-12" style="padding-top: 2%;"><h5>Householder List:</h5></div>';
                        
                        while ($data=pg_fetch_assoc($query)) {
                            $kk_penghuni = $data['family_card_number'];
                            $nama_kk = $data['head_of_family'];
                            $nik_kk = $data['national_identity_number'];
                            $tgl_penghuni = $data['birth_date'];
                            $pdkk_penghuni = $data['educational_level'];
                            $kerja_penghuni = $data ['job_name'];
                            $penghasilan_penghuni = $data['income'];
                            $tabungan = $data['savings'];
                            $tanggungan_penghuni = $data['the_number_of_dependents'];
                            $datuk = $data['datuk_name'];
                            $kampung = $data['village_name'];
                            $suku = $data['name_of_tribe'];

                            $asuransi_penghuni="-";
                            if ($row['insurance']==1) {
                                 $asuransi_penghuni="Exist";
                             }
                            else if ($row['insurance']==0 && $row['insurance']!=null) {
                                $asuransi_penghuni="do not have";
                            } 

                            $tabungan="-";
                            if ($row['savings']==1) {
                                 $tabungan_penghuni="Exist";
                             }
                            else if ($row['savings']==0 && $row['savings']!=null) {
                                $tabungan_penghuni="do not have";
                            }

                            if ($tgl_penghuni!=null) {
                                $tgl_penghuni = date("d - F - Y",strtotime($tgl_penghuni)); 
                            } 
                    ?>
                      
                            <div class="col-lg-6 mt-5">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media mb-5">
                                            <div class="media-body">
                                                <table style="width: 100%">
                                                    <tr>
                                                        <td>Family Card Number </td>
                                                        <td>:
                                                            <?php echo $kk_penghuni ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Name of Head Family </td>
                                                        <td>:
                                                            <?php echo $nama_kk ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>National ID Number of Head of Family </td>
                                                        <td>:
                                                            <?php echo $nik_kk ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Birth Date </td>
                                                        <td>:
                                                            <?php echo $tgl_penghuni ?>             
                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Education Level </td>
                                                        <td>:
                                                            <?php echo $pdkk_penghuni ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Job </td>
                                                        <td>:
                                                            <?php echo $kerja_penghuni ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Income </td>
                                                        <td>:
                                                             Rp. <?php echo number_format($penghasilan_penghuni) ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Savings </td>
                                                        <td>:
                                                            <?php echo $tabungan ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Take Insurance </td>
                                                        <td>:
                                                            <?php echo $asuransi_penghuni ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Datuk </td>
                                                        <td>:
                                                            <?php echo $datuk ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tribe </td>
                                                        <td>:
                                                            <?php echo $suku ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Village </td>
                                                        <td>:
                                                            <?php echo $kampung ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>The Number of Dependents </td>
                                                        <td>:
                                                            <?php echo $tanggungan_penghuni ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <div style="float: right; padding-right: 1%; padding-bottom: 6%; ">
                                                    <a>
                                                    <button type="button" class="btn btn-danger btn-sm btn-flat btn-lg mt-3" data-toggle="modal" data-target="#deletepenghuni<?php echo $kk_penghuni ?>"><i class="fas fa-user-slash"></i> Remove</button>
                                                    </a>
                                                    <a href="../keluarga/info-holder.php?id=<?php echo $kk_penghuni ?>">
                                                        <button type="button" class="btn btn-info btn-sm btn-flat btn-lg mt-3"><i class="fa fa-edit"></i> Edit</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="modal fade" id="deletepenghuni<?php echo $kk_penghuni ?>">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete family_card ?</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure to delete <b><?php echo $kk_penghuni ?> (Head of family: <?php echo $nama_kk?>)</b> from <?php echo $id ?> ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <a href="act/hapuspenghuni.php?id=<?php echo base64_encode($kk_penghuni) ?>&bang=<?php echo $id ?>"><button type="button" class="btn btn-danger">Delete</button></a>
                                            </div>
                                    </div>
                                </div>
                            </div>





                    <?php
                        }
                    }
                    ?>

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