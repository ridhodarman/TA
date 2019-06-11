<?php session_start(); ?>
<script src="pages/inc/slideshow/jquery.resize.js"></script>
<script src="pages/inc/slideshow/jquery.waitforimages.min.js"></script>
<script src="pages/inc/slideshow/modernizr.js"></script>
<script src="pages/inc/slideshow/jquery.carousel-3d.js"></script>
<link rel="stylesheet" href="pages/inc/slideshow/jquery.carousel-3d.default.css">
            <?php
            include ("inc/koneksi.php");
                $id=$_GET['id'];

                $querysearch = "SELECT H.owner_id, H.address, H.standing_year, H.land_building_tax, H.type_of_construction, H.electricity_capacity, H.tap_water, H.building_status,
                                ST_X(ST_Centroid(H.geom)) AS longitude, ST_Y(ST_CENTROID(H.geom)) AS latitude, ST_AsText(H.geom) AS geom,
                                T.name_of_type, M.name_of_model,
                                C.*
                                FROM house_building AS H
                                LEFT JOIN type_of_construction AS T ON H.type_of_construction=T.type_id
                                LEFT JOIN citizen AS C ON H.owner_id=C.national_identity_number
                                LEFT JOIN building_model AS M ON M.model_id=H.model_id
                                WHERE H.house_building_id='$id' 
                            ";

                            // SELECT H.house_building_id, H.standing_year, H.land_building_tax, T.name_of_type, H.tap_water, 
                            //     H.electricity_capacity, H.building_status, H.address, M.name_of_model,
                            //     C.name, C.national_identity_number, C.family_card_number, C.birth_date, E.educational_level, 
                            //     J.job_name, C.income, D.datuk_name, T.name_of_tribe
                            //     FROM house_building AS H
                            //     LEFT JOIN type_of_construction AS T ON H.type_of_construction=T.type_id
                            //     LEFT JOIN citizen AS C ON H.owner_id=C.national_identity_number
                            //     LEFT JOIN building_model AS M ON M.model_id=H.model_id
                            //     LEFT JOIN datuk AS D ON C.datuk_id=D.datuk_id
                            //     LEFT JOIN tribe AS T ON D.tribe_id=T.tribe_id
                            //     LEFT JOIN job AS J ON C.job_id=J.job_id
                            //     LEFT JOIN education AS E ON C.education_id=E.education_id
                            //     WHERE H.house_building_id='$id' 
                            

                $hasil = pg_query($querysearch);
                while ($row = pg_fetch_array($hasil)) {
                    $longitude = $row['longitude'];
                    $latitude = $row['latitude'];
                    $nik = $row['owner_id'];
                    $alamat = $row['address'];
                    $tahun = $row['standing_year'];
                    $pbb = $row['land_building_tax'];
                    $model = $row['name_of_model'];
                    
                    $tipe_k = $row['type_of_construction'];
                    $jkonstruksi = $row['name_of_type'];
                    
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
                    

                    $pendapatan = $row['income'];

                    $datuk = $row['datuk_id'];

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

                    $server='foto/rumah/';
                    echo '<div data-carousel-3d>';
                    if ($cek<1) {
                        echo '
                                <div style="min-width: 320px; min-height: 213px; max-height: 700px; max-height: 500px; text-align-last: center;  vertical-align: middle; display: table-cell;">
                                    <img src="foto/rumah.png" />
                                    <a class="icon-container" style="background-color: #d8dbff" href="#">
                                        <span class="ti-na"></span><span class="icon-name">No Image Available</span>
                                    </a>
                                </div>
                                <div style="min-width: 320px; min-height: 213px; max-height: 700px; max-height: 500px; text-align-last: center;  vertical-align: middle; display: table-cell;">
                                    <img src="foto/rumah.png" />
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
                <div class="row" id="skip">

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                        <h6>ID:
                                            <?php echo $id ?>
                                        </h6>
                                        <br />
                                        <table style="width: 100%;">
                                            <table style="width: 100%;">
                                                <tr>
                                                    <td>Standing Year </td>
                                                    <td>:</td>
                                                    <td>
                                                        <?php echo $tahun ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Land and Building Tax </td>
                                                    <td>:</td>
                                                    <td>Rp.
                                                        <?php echo number_format($pbb); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Type of Construction </td>
                                                    <td>:</td>
                                                    <td>
                                                        <?php echo $jkonstruksi ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Tap Water </td>
                                                    <td>:</td>
                                                    <td>
                                                        <?php echo $pdam ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Electricity Capacity </td>
                                                    <td>:</td>
                                                    <td>
                                                        <?php echo $listrik ?> kWh
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Status </td>
                                                    <td>:</td>
                                                    <td>
                                                        <?php echo $status ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Address </td>
                                                    <td>:</td>
                                                    <td>
                                                        <?php echo $alamat ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Building Model </td>
                                                    <td>:</td>
                                                    <td>
                                                        <?php echo $model ?>
                                                    </td>
                                                </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <center>
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                        <h5>Photo
                                            <!-- <button id="ukuranpenuh" class="btn btn-warning btn-sm" title="show all images in full screen">
                                                <i class="ti-fullscreen"></i>
                                            </button> -->
                                        </h5>
                                        <?php tampilfoto() ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </center>
                    </div>

                    <?php

                $querysearch = "SELECT H.owner_id, C.*, D.datuk_name, T.name_of_tribe, J.job_name, E.educational_level
                                FROM house_building AS H
                                JOIN citizen AS C ON H.owner_id=C.national_identity_number
                                LEFT JOIN datuk AS D ON C.datuk_id=D.datuk_id
                                LEFT JOIN tribe AS T ON D.tribe_id=T.tribe_id
                                LEFT JOIN job AS J ON C.job_id=J.job_id
                                LEFT JOIN education AS E ON C.education_id=E.education_id
                                WHERE H.house_building_id='$id' 
                            ";

                $hasil = pg_query($querysearch);
                while ($row = pg_fetch_array($hasil)) {
                    $nama = $row['name'];
                    $nokk = $row['family_card_number'];
                    $tgl = $row['birth_date'];

                    $id_pendidikan = $row['educational_id'];
                    $pendidikan = $row['educational_level'];
                    
                    $id_kerja = $row['job_id'];
                    $pekerjaan = $row['job_name'];

                    $pendapatan = $row['income'];
                    $id_datuk = $row['datuk_id'];
                    $datuk = $row['datuk_name'];

                    $id_suku = $row['tribe_id'];
                    $suku = $row['name_of_tribe'];
                }

?>

                    <div class="col-lg-6" style="padding-top: 1%">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                    <h5 class="mb-3">Owner</h5>

                                        <table style="width: 100%">
                                            <tr>
                                                <td>Name </td>
                                                <td>:
                                                    <?php echo $nama ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>National ID Number </td>
                                                <td>:
                                                    <?php echo $nik?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Family Card Number </td>
                                                <td>:
                                                    <?php echo $nokk ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Birth Date </td>
                                                <td>:
                                                    <?php
                                                        $tgl2 = date('Y-m-d');
                                                        if ($tgl!=null && $tgl!=$tgl2) {
                                                             echo date("d - F - Y",strtotime($tgl)); 
                                                         } 
                                                        
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Education Level </td>
                                                <td>:
                                                    <?php echo $pendidikan ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Job </td>
                                                <td>:
                                                    <?php echo $pekerjaan ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Income </td>
                                                <td>:
                                                    <?php
                                                        if ($pendapatan!=null) {
                                                             echo "Rp. ". number_format($pendapatan); 
                                                         } 
                                                        
                                                    ?>
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
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                        $query = pg_query("SELECT family_card_number FROM family_card WHERE house_building_id='$id'");

                        $jumlah_kk = pg_num_rows($query);

                    ?>      
                    <div class="col-lg-6" style="padding-top: 1%">
                        <div class="card">
                            <div class="card-body">
                                <div class="media-body">
                                    <h6 class="mb-3">List of Residents:</h6>
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
                                                    <a href="pages/keluarga/info-kk.php?id='.$kk_penghuni.'" class="btn btn-info btn-xs">
                                                        <i class="fa fa-info"></i> View Details</a> 
                                                    </center><td>';
                                                echo "</tr>";
                                                
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


                    
                </div> <!-- SAMPAI DISINI BATAS ROW-->

<?php
        $querysearch = "SELECT H.standing_year, T.name_of_type, H.address,  H.tap_water, T.name_of_type, M.name_of_model
            FROM house_building AS H
            LEFT JOIN type_of_construction AS T ON H.type_of_construction=T.type_id
            LEFT JOIN building_model AS M ON M.model_id=H.model_id
            WHERE H.house_building_id='$id' 
        ";

                $hasil = pg_query($querysearch);
                while ($row = pg_fetch_array($hasil)) {
                    $longitude = $row['longitude'];
                    $latitude = $row['latitude'];
                    $alamat = $row['address'];
                    $tahun = $row['standing_year'];
                    $kons = $row['name_of_type'];
                    $model = $row['name_of_model'];
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
                }
?>
                <div class="row" id="oke">

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                        <h6>ID:
                                            <?php echo $id ?>
                                        </h6>
                                        <br />
                                        <table style="width: 100%;">
                                            <table style="width: 100%;">
                                                <tr>
                                                    <td>Standing Year </td>
                                                    <td>:</td>
                                                    <td>
                                                        <?php echo $tahun ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Type of Construction </td>
                                                    <td>:</td>
                                                    <td>
                                                        <?php echo $kons ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Tap Water </td>
                                                    <td>:</td>
                                                    <td>
                                                        <?php echo $pdam ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Address </td>
                                                    <td>:</td>
                                                    <td>
                                                        <?php echo $alamat ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Building Model </td>
                                                    <td>:</td>
                                                    <td>
                                                        <?php echo $model ?>
                                                    </td>
                                                </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                        <h5 class="mb-3">Photo
                                            <!-- <button id="ukuranpenuh" class="btn btn-warning btn-sm" title="show all images in full screen">
                                                <i class="ti-fullscreen"></i>
                                            </button> -->
                                        </h5>
                                        <?php tampilfoto() ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- SAMPAI DISINI BATAS ROW-->



            </div> <!-- BATAS MAIN KONTEN -->


            <!-- main content area end -->
            <!-- footer area start-->

<?php
@session_start();
    if(isset($_SESSION['username'])){
        echo '
            <script>
                $("#skip").show()
                $("#oke").hide()
            </script>
        ';
    }
    else {
        echo '
            <script>
                $("#skip").hide()
                $("#oke").show()
            </script>
        ';  
    }
?>