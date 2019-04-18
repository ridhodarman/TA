<script src="pages/inc/slideshow/jquery.resize.js"></script>
<script src="pages/inc/slideshow/jquery.waitforimages.min.js"></script>
<script src="pages/inc/slideshow/modernizr.js"></script>
<script src="pages/inc/slideshow/jquery.carousel-3d.js"></script>
<link rel="stylesheet" href="pages/inc/slideshow/jquery.carousel-3d.default.css">
            <?php
            include ("inc/koneksi.php");
                $id=$_GET['id'];

                $querysearch = "SELECT M.msme_building_id, M.name_of_msme_building, M.building_area, M.land_area, M.parking_area, M.standing_year, M.electricity_capacity, M.address, M.type_of_construction, M.type_of_msme, M.owner_name, M.number_of_employee, M.monthly_income, M.contact_person,
                                ST_X(ST_Centroid(M.geom)) AS longitude, ST_Y(ST_CENTROID(M.geom)) As latitude,
                                T.name_of_type as constr, J.name_of_type as type,
                                ST_AsText(geom) as geom
					            FROM msme_building as M
                                LEFT JOIN type_of_construction as T ON M.type_of_construction=T.type_id
                                LEFT JOIN type_of_msme as J ON M.type_of_msme=J.type_id
                                WHERE M.msme_building_id='$id' 
				            ";

                $hasil = pg_query($querysearch);
                while ($row = pg_fetch_array($hasil)) {
                    $longitude = $row['longitude'];
                    $latitude = $row['latitude'];
                    $nama = $row['name_of_msme_building'];
                    $bang = $row['building_area'];
                    $lahan = $row['land_area'];
                    $parkir = $row['parking_area'];
                    $tahun = $row['standing_year'];
                    $listrik = $row['electricity_capacity'];
                    $alamat = $row['address'];
                    $konstruksi = $row['constr'];
                    $jenis = $row['type'];
                    $id_k = $row['type_of_construction'];
                    $id_m = $row['type_of_msme'];
                    $pemilik = $row['owner_name'];
                    $pegawai = $row['number_of_employee'];
                    $penghasilan = $row['monthly_income'];
                    $kontak = $row['contact_person'];
                    $geom = $row['geom'];
                }

                

                function tampilfoto(){
                    $id=$_GET['id'];
                    $sql = pg_query("SELECT photo_url, upload_date FROM msme_building_gallery WHERE msme_building_id='$id' 
                            ");
                    $cek = pg_num_rows($sql);

                    $n=0;$foto;$tglfoto;
                    while ($row = pg_fetch_assoc($sql)) {
                        $foto[$n]=$row['photo_url'];
                        $tglfoto[$n]=$row['upload_date'];
                        $n++;
                    }

                    $server='foto/umkm/';
                    echo '<div id="foto1"><div data-carousel-3d>';
                    if ($cek<1) {
                        echo '
                                <div style="min-width: 320px; min-height: 213px; max-height: 700px; max-height: 500px; text-align-last: center;  vertical-align: middle; display: table-cell;">
                                    <img src="foto/umkm.png" />
                                    <a class="icon-container" style="background-color: #d8dbff" href="#">
                                        <span class="ti-na"></span><span class="icon-name">No Image Available</span>
                                    </a>
                                </div>
                                <div style="min-width: 320px; min-height: 213px; max-height: 700px; max-height: 500px; text-align-last: center;  vertical-align: middle; display: table-cell;">
                                    <img src="foto/umkm.png" />
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
                    echo '</div></div>';    
                    
                    echo "Total Photo: ".$cek;
                    
                     
                }

            ?>

            <div class="main-content-inner">
                <div class="row">
                    <div class="col-lg-5 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="media mb-5">
                                    <div class="media-body">
                                        <h6>ID:
                                            <?php echo $id ?>
                                        </h6>
                                        <br />
                                        <table style="width: 100%;">
                                            <tr>
                                                <td>Nama </td>
                                                <td>:</td>
                                                <td>
                                                    <?php echo $nama ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Type of MSME</td>
                                                <td>:</td>
                                                <td>
                                                    <?php echo $jenis; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Owner Name</td>
                                                <td>:</td>
                                                <td>
                                                    <?php echo $pemilik; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Contact Person</td>
                                                <td>:</td>
                                                <td>
                                                    <?php echo $kontak; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Number of Employee</td>
                                                <td>:</td>
                                                <td>
                                                    <?php echo $pegawai; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Monthly Income</td>
                                                <td>:</td>
                                                <td>Rp. 
                                                    <?php echo number_format($penghasilan); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Building Size </td>
                                                <td>:</td>
                                                <td>
                                                    <?php echo $bang; ?> m<sup>2</sup>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Land Area </td>
                                                <td>:</td>
                                                <td>
                                                    <?php echo $lahan; ?> m<sup>2</sup>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Parking Area </td>
                                                <td>:</td>
                                                <td>
                                                    <?php echo $parkir; ?> m<sup>2</sup>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Standing Year </td>
                                                <td>:</td>
                                                <td>
                                                    <?php echo $tahun ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Construction Type </td>
                                                <td>:</td>
                                                <td>
                                                    <?php echo $konstruksi; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Electricity Capacity </td>
                                                <td>:</td>
                                                <td>
                                                    <?php echo $listrik; ?> kWh
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Address </td>
                                                <td>:</td>
                                                <td>
                                                    <?php echo $alamat; ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 mt-5">
                        <div class="card">
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
                    </div>
                    <div class="col-lg-5 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="media mb-5">
                                    <div class="media-body">
                                    <h5 class="mb-3">Facility</h5>
                                    <table width="100%" class="table table-striped table-bordered table-hover">
                                        <thead style="text-align: center;">
                                            <th>Name of Facility</th>
                                            <th>Qty</th>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $sql=pg_query("SELECT D.msme_building_id, D.facility_id, D.quantity_of_facilities, F.name_of_facility
                                                FROM detail_msme_building_facilities AS D 
                                                LEFT JOIN msme_building_facilities AS F ON F.facility_id=D.facility_id
                                                WHERE D.msme_building_id = '$id'
                                                ");
                                            if (pg_num_rows($sql)>0) {
                                                while ($data=pg_fetch_assoc($sql)) {
                                                    $id_fas=$data['facility_id'];
                                                    $namafas =$data['name_of_facility'];
                                                    $qty = $data['quantity_of_facilities'];
                                                    echo "<tr>";
                                                    echo "<td>".$namafas."</td>";
                                                    echo "<td>".$qty."</td>";
                                                    echo "</tr>";
                                                }
                                            }
                                            else {
                                                echo '</tbody><td colspan="2">no facility data</td>';
                                            }
                                        ?>   
                                    </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                </div>
            </div> <!-- SAMPAI DISINI BATAS ROW-->

            <div class="modal fade bd-example-modal-lg modal-xl" id="ukuranpenuhhhh">
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
  <script type="text/javascript">
    function reset () {
        $("#toggleCSS").attr("href", "assets/alertify/themes/alertify.default.css");
        alertify.set({
            labels : {
                ok     : "OK",
                cancel : "Cancel"
            },
            delay : 5000,
            buttonReverse : false,
            buttonFocus   : "ok"
        });
    }

    // $("#ukuranpenuh").on( 'click', function () {
    //     reset();
    //     alertify.alert('<div id="foto2" style="width: 700px"></div>');
    //     $("#foto1").clone().prependTo("#foto2");
    //     return false;
    // });
  </script>