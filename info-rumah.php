<script src="pages/inc/slideshow/jquery.resize.js"></script>
<script src="pages/inc/slideshow/jquery.waitforimages.min.js"></script>
<script src="pages/inc/slideshow/modernizr.js"></script>
<script src="pages/inc/slideshow/jquery.carousel-3d.js"></script>
<link rel="stylesheet" href="pages/inc/slideshow/jquery.carousel-3d.default.css">
<link rel="stylesheet" href="assets/alertify/themes/alertify.core.css" />
<link rel="stylesheet" href="assets/alertify/themes/alertify.default.css" id="toggleCSS" />
<meta name="viewport" content="width=device-width">
<script src="assets/alertify/lib/alertify.min.js"></script>
            <?php
            include ("inc/koneksi.php");
                $id=$_GET['id'];

                $querysearch = "SELECT H.fcn_owner, H.address, H.standing_year, H.land_building_tax, H.type_of_construction, H.electricity_capacity, H.tap_water, H.building_status,
                                ST_X(ST_Centroid(H.geom)) AS longitude, ST_Y(ST_CENTROID(H.geom)) AS latitude, ST_AsText(H.geom) AS geom,
                                T.name_of_type AS jkonstruksi,
                                O.*
                                FROM house_building AS H
                                LEFT JOIN type_of_construction AS T ON H.type_of_construction=T.type_id
                                JOIN house_building_owner AS O ON H.fcn_owner=O.national_identity_number
                                WHERE H.house_building_id='$id' 
                            ";

                $hasil = pg_query($querysearch);
                while ($row = pg_fetch_array($hasil)) {
                    $longitude = $row['longitude'];
                    $latitude = $row['latitude'];
                    $nik = $row['fcn_owner'];
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
                <div class="row">

                    <div class="col-lg-12 mt-5">
                        <center>
                        <div class="card" style="width: 70%;">
                            <div class="card-body">
                                <div class="media mb-5">
                                    <div class="media-body">
                                        <h5 class="mb-3">Foto
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

                    <div class="col-lg-6 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="media mb-5">
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
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

<?php

                $querysearch = "SELECT H.fcn_owner, O.*,
                                        D.datuk_name, T.name_of_tribe, V.village_name, J.job_name, E.educational_level
                                FROM house_building AS H
                                JOIN house_building_owner AS O ON H.fcn_owner=O.national_identity_number
                                JOIN datuk AS D ON O.datuk_id=D.datuk_id
                                JOIN tribe AS T ON D.tribe_id=T.tribe_id
                                JOIN village AS V ON O.village_id=V.village_id
                                JOIN job AS J ON O.job_id=J.job_id
                                JOIN education AS E ON O.educational_id=E.education_id
                                WHERE H.house_building_id='$id' 
                            ";

                $hasil = pg_query($querysearch);
                while ($row = pg_fetch_array($hasil)) {
                    $nama = $row['owner_name'];
                    $nokk = $row['family_card_number'];
                    $tgl = $row['birth_date'];

                    $id_pendidikan = $row['educational_id'];
                    $pendidikan = $row['educational_level'];
                    
                    $id_kerja = $row['job_id'];
                    $pekerjaan = $row['job_name'];
                    
                    $asuransi="-";
                    if ($row['savings']!=null) {
                        if ($row['insurance']==1) {
                             $asuransi="Exist";
                         }
                        else if ($row['insurance']==0) {
                            $asuransi="do not have";
                        } 
                    }

                    $pendapatan = $row['income'];

                    $tab = $row['savings'];
                    $tabungan="-";
                    if ($row['savings']!=null) {
                        if ($row['savings']==1) {
                         $tabungan="Exist";
                         }
                        else if ($row['savings']==0) {
                            $tabungan="do not have";
                        }
                    }

                    $id_datuk = $row['datuk_id'];
                    $datuk = $row['datuk_name'];

                    $id_suku = $row['tribe_id'];
                    $suku = $row['name_of_tribe'];

                    $id_kampung = $row['village_id'];
                    $kampung = $row['village_name'];
                }

?>

                    <div class="col-lg-6 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="media mb-5">
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
                                                <td>Take Insurance</td>
                                                <td>:
                                                    <?php echo $asuransi ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Savings </td>
                                                <td>:
                                                    <?php echo $tabungan ?>
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
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    <?php
                        $query = pg_query("SELECT H.*,
                                        D.datuk_name, T.name_of_tribe, V.village_name, J.job_name, E.educational_level
                                        FROM householder AS H
                                        JOIN datuk AS D ON H.datuk_id=D.datuk_id
                                        JOIN tribe AS T ON D.tribe_id=T.tribe_id
                                        JOIN village AS V ON H.village_id=V.village_id
                                        JOIN job AS J ON H.job_id=J.job_id
                                        JOIN education AS E ON H.educational_id=E.education_id
                                        WHERE H.house_building_id='$id' 
                                    ");

                        $jumlah_kk = pg_num_rows($query);

                    ?>      
                            <div class="col-lg-12 mt-6" style="padding-top: 1%">
                                <div class="card">
                                    <div class="card-body">
                                            <div class="media-body">
                                                <h6 class="mb-3" style="float: left; padding-right: 2px;">Number of Family Heads: <?php echo $jumlah_kk ?></h6>
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
                                                        $sql_d=pg_query("SELECT family_card_number, head_of_family FROM householder ORDER BY head_of_family");
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
                                            </div>
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


            <!-- main content area end -->
            <!-- footer area start-->