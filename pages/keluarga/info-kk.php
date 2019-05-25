<?php session_start(); ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Info family_card</title>

    <?php 
        include('../inc/head.php') 
    ?>
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
                        <div class="row">
                            <div class="col-lg-6 mt-6">
                                <div class="card"><div class="card-body">
                                    <h6>Family Card Info
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit" style="float: right;"><i class="fa fa-edit"></i> Edit</button></h6>
                                    <br/>
                                    <table class="table table-hover" style="width: 90%">
                                        <?php
                                            $id = $_GET['id'];
                                             $querysearch = "SELECT F.family_card_number, F.house_building_id, F.category, H.address,
                                                            ST_X(ST_Centroid(H.geom)) AS longitude, ST_Y(ST_CENTROID(H.geom)) AS latitude
                                                            FROM family_card AS F
                                                            LEFT JOIN house_building AS H ON F.house_building_id=H.house_building_id
                                                            WHERE F.family_card_number='$id'
                                            ";

                                            $hasil = pg_query($querysearch);
                                            while ($row = pg_fetch_array($hasil)) {
                                                $nokk = $row['family_card_number'];
                                                $kategori = $row['category'];
                                                    if ($row['category']!=null) {
                                                        if ($kategori==0) {
                                                            $kategori="Poor Family";
                                                        }
                                                        else {
                                                            $kategori="Capable Family";
                                                        }
                                                    }
                                                    
                                                $id_rumah = $row['house_building_id'];
                                                $alamat = $row['address'];
                                                $longitude = $row['longitude'];
                                                $latitude = $row['latitude'];
                                            }
                                        ?>
                                        <tr>
                                            <td>Family Card Number</td>
                                            <td>:
                                                <?php echo $id ?>    
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Category</td>
                                            <td>:
                                                <?php echo $kategori ?>        
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>House Building ID</td>
                                            <td>:
                                                <?php echo $id_rumah; ?>        
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Address </td>
                                            <td>:
                                                <?php echo $alamat; ?>
                                            </td>
                                        </tr>
                                </table>
                            </div></div>
                        </div>
                        <div class="col-lg-6 mt-6">
                            <div class="card"><div class="card-body">
                                <h7 id="layer"><?php include('../../inc/aturlayer.php') ?></h7>
                                <h6 class="mb-3">Location of Residence
                                        <a href="../rumah/info-rumah.php?id=<?php echo $id_rumah ?>" class="btn btn-info btn-sm" style="float: right;" id="lihat-info"><i class="fa fa-info"></i> View House Building Info</a></h6>
                                </h6>
                                <?php 
                                    if ($latitude!=null && $longitude!=null) {
                                ?>
                                <div class="media-body">
                                    <?php include('../inc/headinfodanslideshow.php'); ?>
                                    <div style="padding-left: 1%; padding-bottom: 1%;">
                                        <script type="text/javascript" src="../../script.js"></script>
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
                                <?php }
                                    else {
                                        echo "<center>";
                                        echo '<h3><i class="fas fa-question-circle"></i></h3>';
                                        echo "location of the house or residence not found !";
                                        echo "</cente>";
                                        echo '<script>
                                                document.getElementById("lihat-info").style.display="none";
                                                document.getElementById("layer").style.display="none"
                                            </script>';
                                    }
                                ?>
                            </div></div>
                        </div>
                    </div>
                    <br/>
                    <div class="card"><div class="card-body">
                    <h6>Family Card Member:
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambah-a" style="float: right;">+ Add</button>
                    </h6>
                    <div class="modal fade" id="tambah-a">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <form method="post" action="act/info-tambahanggotakk.php">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Family Card Member</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <select class="selectpicker form-control" data-container="body" data-live-search="true"
                                            title="Select citizen" data-hide-disabled=" true" name="nik4">
                                            <option></option>
                                            <?php                
                                                $sql_k=pg_query("SELECT national_identity_number, name FROM citizen ORDER BY name");
                                                while($row = pg_fetch_assoc($sql_k))
                                                {
                                                    echo"<option value=".$row['national_identity_number'].">(".$row['national_identity_number'].") ".$row['name']."</option>";
                                                }
                                            ?>
                                        </select>
                                        <input type="hidden" name="kk4" value="<?php echo $nokk ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary" name="anggotakk">+ Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <table class="table table-hover" style="width: 90%">
                    <tr>
                        <th>National ID Number</th>
                        <th>Name</th>
                        <th>Birth Date</th>
                        <th>Status in Family</th>
                        <th><center> Action</center></th>
                    </tr>
                    <?php
                            $sql=pg_query("SELECT national_identity_number, name, birth_date, status_in_family
                                FROM citizen WHERE family_card_number = '$id' ORDER BY status_in_family
                                ");
                            $cekfas=pg_num_rows($sql);
                            if ($cekfas==0) {
                                echo "<tr><td colspan='5'>No member data . . . . .</td></tr>";
                            }
                            while ($data=pg_fetch_assoc($sql)) {
                                $nik = $data['national_identity_number'];
                                $nama = $data['name'];
                                $tgl = $data['birth_date'];
                                $status = $data['status_in_family'];
                                if ($data['status_in_family']!=null) {
                                    if ($status==1) {
                                     $status="Head of Family";
                                     }
                                    else if ($status==2) {
                                        $status="Wife";
                                    }
                                    else if ($status==3) {
                                        $status="Child";
                                    }
                                    else if ($status==4) {
                                        $status="Another Family";
                                    }
                                }
                                $tgl2 = date('Y-m-d');
                                if ($tgl!=null && $tgl!=$tgl2) {
                                     $tgl = date("d - F - Y",strtotime($tgl)); 
                                 } 
                                echo "<tr>";
                                echo "<td>".$nik."</td>";
                                echo "<td>".$nama."</td>";
                                echo "<td>".$tgl."</td>";
                                echo "<td>".$status."</td>";
                                echo '<td>
                                    <a href="info-citizen.php?id='.$nik.'" class="btn btn-info btn-xs">
                                        <i class="fa fa-info"></i> View Details</a> 
                                    <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#coret-kk'.$nik.'">
                                        <i class="fas fa-user-minus"></i> Remove</button>
                                    <td>';
                                echo "</tr>";
                                echo '
                                    <div class="modal fade" id="coret-kk'.$nik.'">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Delete '.$edu.' ?</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure to delete "'.$nama.'" from family card member? <br/>
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <a href="act/coret-kk.php?nik='.$nik.'&kk='.$nokk.'" ><button type="button" class="btn btn-danger" ">Remove</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                ';
                                
                            }
                        ?>
                        </table>
                    </div></div>
                </div>          
            </div>

    <!-- SAMPAI DISINI -->
<div class="modal fade" id="edit">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="act/edit-kk.php" method="post" style="width: 115%; background-color: white; border-radius: 1%">
                <div class="modal-header">
                    <h6 class="modal-title">Edit Family Card Data</h6>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body"">
                    <div id="alertH"></div>
                    <div class="form-group">
                        Family Card Number: <input class="form-control" type="text" name="kk2" id="kk2" required value="<?php echo $nokk ?>">
                        <input type="hidden" name="kk" value="<?php echo $nokk ?>">
                    </div>
                    <div class="form-group">
                        Category: 
                        <select class="form-control" name="kategori" style="height: 43px">
                            <option></option>
                            <option value="0">Poor Family</option>
                            <option value="1">Capable Family</option>
                        </select>
                    </div>
                    <div class="form-group" id="combobox-rumah">
                        House ID:
                        <select class="selectpicker form-control" data-container="body" data-live-search="true"
                            title="Select house.." data-hide-disabled=" true" name="rumah">
                            <option></option>
                            <?php                
                                $sql_k=pg_query("SELECT house_building_id FROM house_building ORDER BY house_building_id");
                                while($row = pg_fetch_assoc($sql_k))
                                {
                                    echo"<option value=".$row['house_building_id'].">".$row['house_building_id']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="simpan">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

    
                
                <!-- row area start-->
            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <?php include('../inc/foot.php') ?>
</body>
<?php
$kk_ada = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Family card number</strong> already registered.&emsp;&emsp;<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span></button></div>';
?>
</html>
    <script type="text/javascript">
        $("#kampung select").val(<?php echo "'".$id_kampung."'" ?>);
        $("#datuk select").val(<?php echo "'".$id_datuk."'" ?>);
        $("#tabungan select").val(<?php echo "'".$tab."'" ?>);
        $("#kerja select").val(<?php echo "'".$id_kerja."'" ?>);
        $("#pendidikan select").val(<?php echo "'".$id_pendidikan."'" ?>);
        $("#asuransi select").val(<?php echo "'".$a."'" ?>);

        function back() {
            window.history.back();
        }

function ceknominal() {
    var rupiah = document.getElementById('penghasilan');
    rupiah.value = formatRupiah(rupiah.value, '');
}

function formatRupiah(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split           = number_string.split(','),
    sisa            = split[0].length % 3,
    rupiah          = split[0].substr(0, sisa),
    ribuan          = split[0].substr(sisa).match(/\d{3}/gi);
 
    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }
 
    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
}


function ceksuku() {
    var iddatuk = document.getElementById('iddatuk').value; 
    //alert(iddatuk)
    $("#suku").empty()
    $("#suku").load("inc/suku.php?id_datuk="+iddatuk);
}

function cek_kk(){
        var kk = document.getElementById('kk').value;
        $('#alertH').empty();
        var ketemu = false;
        <?php 
            $sql = pg_query("SELECT family_card_number FROM family_card WHERE family_card_number != '$nokk'");
            while ($data = pg_fetch_array($sql))
            {
            $idnya = $data['family_card_number'];
            echo "if (kk == \"".$idnya."\")";
            echo "{
                    ketemu=true;
                    $('#alertH').append('".$kk_ada."'); 
                     $('#simpan').prop('disabled', true);
                  }";

            }
        ?>
        if (ketemu == false) {
            $('#simpan').prop('disabled', false);
        }
        
}

    </script>

<link rel="stylesheet" href="../../js/bootstrap.bundle.min.js" />
<script src="../dist/js/bootstrap-select.js"></script>