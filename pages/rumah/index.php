<?php session_start(); ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>House</title>

    <?php 
        include('../inc/head.php') 
    ?>
    <!-- <link rel="stylesheet" href="../../js/jquery-ui.js" /> -->
    <link rel="stylesheet" href="../dist/css/bootstrap-select.css">
    <link rel="stylesheet" href="../../assets/alertify/themes/alertify.core.css" />
    <link rel="stylesheet" href="../../assets/alertify/themes/alertify.default.css" id="toggleCSS" />
    <meta name="viewport" content="width=device-width">
    <script src="../../assets/alertify/lib/alertify.min.js"></script>
    <style type="text/css">
        .readonly {
            background-color: #eee;
            cursor: col-resize;
        }
    </style>
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
                <div class="card">
                    <div class="card-body">
                        <div style="text-align: center; padding-top: 3%; padding-bottom:3%">
                            <button class="btn btn-default btn-lg" style="width: 90%; background-color: #fafafa" data-toggle="modal" data-target="#tambahrumah">+
                            Add House Building Data </button>
                        </div>
                        <div class="panel-body" style="padding-top: 2%; padding-left: 2%; padding-right: 2%">
                            <h4 style="text-align: center;">List of House Buildings</h4>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="listrumah">
                                <thead>
                                    <tr style="text-align: center">
                                        <th>ID</th>
                                        <!-- <th>Owner</th> -->
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql=pg_query("SELECT house_building_id, address FROM house_building");
                                        while ($data=pg_fetch_assoc($sql)) {
                                            $id=$data['house_building_id'];
                                            //$nama=$data['name_of_worship_building'];
                                            echo "<tr>";
                                            echo "<td>".$id."</td>";
                                            //echo "<td>".$nama."</td>";
                                            echo "<td>".wordlimit($data['address'],50)."</td>";
                                            echo '<td>
                                                <a href="info-rumah.php?id='.$id.'"><button class="btn btn-info btn-xs" title="View Detail"><i class="fa fa-info-circle"></i> View Detail</button></a>
                                                <button class="btn btn-danger btn-xs" title="Hapus" data-toggle="modal" data-target="#delete-bang'.$id.'"><i class="fa fa-trash"></i> Delete</button>
                                                </td>';
                                            echo "</tr>";
                                            $id2 = base64_encode($id);
                                            echo '
                                                <div class="modal fade" id="delete-bang'.$id.'">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Delete '.$id.' ?</h5>
                                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure to delete "'.$id.'" from  the house building data ?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                <a href="act/hapus-b-ibadah.php?id='.$id2.'"><button type="button" class="btn btn-danger">Delete</button></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            ';
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>          
            </div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDM2fDXHmGzCDmDBk3bdPIEjs6zwnI1kGQ&libraries=drawing"></script>        
<script src="../inc/mapupd.js" type="text/javascript"></script>

<div class="modal fade bd-example-modal-lg modal-xl" id="tambahrumah">
        <div class="modal-dialog modal-lg modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add House Building Data</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form role="form" action="act/tambah-rumah.php" enctype="multipart/form-data" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6" id="hide2">
                                <!-- menampilkan peta-->
                                <section class="panel">
                                    <header class="panel-heading">
                                        <h3>
                                            <input id="latlng" type="text" class="form-control" value="" placeholder="Latitude, Longitude">
                                            <p />
                                            <button class="btn btn-default my-btn" id="btnlatlng" type="button" title="Geocode"><i class="fa fa-search"></i></button>
                                            <button class="btn btn-default my-btn" type="button" title="Hapus Marker" onclick="hapusmarkerdankoor()"><i
                                                    class="fa fa-ban"></i></button>
                                            <button class="btn btn-default my-btn" id="delete-button" type="button" title="Remove shape"><i
                                                    class="fa fa-trash"></i></button>
                                        </h3>
                                    </header>
                                    <div class="panel-body" style="padding-top: 1%">
                                        <div id="map" style="width:100%;height:420px;"></div>
                                    </div>
                                </section>
                            </div>

                            <div class="col-sm-6" id="hide3">
                                <!-- menampilkan form tambah-->
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label><span style="color:red">*</span>ID Survey</label><b id="ids"></b>
                                        <input type="text" class="form-control" name="id" id="id" onkeyup="besarkan()" onchange="cekid()" required>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Standing Year</label><label id="tahuns"></label>
                                        <input type="text" class="form-control" name="tahun" value="0" onkeypress="return hanyaAngka(event, '#tahuns')">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Land & Building Tax</label><label id="pbbs"></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Rp</div>
                                            </div>
                                            <input type="text" class="form-control" name="pbb" value="0" onkeypress="return hanyaAngka(event, '#pbbs')">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Construction Type</label>
                                        <select name="konstruksi" class="form-control" style="font-size: 85%">
                                            <?php                
                                                $sql_j=pg_query("SELECT * FROM type_of_construction ORDER BY name_of_type");
                                                while($row = pg_fetch_assoc($sql_j))
                                                {
                                                    echo"<option value=".$row['type_id'].">".$row['name_of_type']."</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Building Area (m<sup>2</sup>)</label><label id="lbangs"></label>
                                        <input type="text" class="form-control" name="lbang" value="0" onkeypress="return hanyaAngka(event, '#lbangs')" value="<?php echo $bang ?>">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Land Area (m<sup>2</sup>)</label><label id="lahans"></label>
                                        <input type="text" class="form-control" name="lahan" value="0" onkeypress="return hanyaAngka(event, '#lahans')">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Electricity Capacity (kWh)</label><label id="listriks"></label>
                                        <input type="text" class="form-control" name="listrik" value="0" onkeypress="return hanyaAngka(event, '#listriks')">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Tap Water</label>
                                        <select name="water" class="form-control" style="font-size: 85%">
                                            <option value="0">Available</option>
                                            <option value="1">Not Available</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Status</label>
                                        <select name="status" class="form-control" style="font-size: 85%">
                                            <option value="0">Unhabited</option>
                                            <option value="1">Inhabited</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Alamat</label>
                                        <textarea class="form-control" name="alamat"></textarea>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label><span style="color:red">*</span> Coordinat</label>
                                        <textarea class="form-control readonly" id="geom" name="geom" required></textarea>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Owner:
                                        <div class="custom-control custom-radio">
                                            <input type="radio" checked id="unknown" name="customRadio" class="custom-control-input" onclick="cekhuni(0)">
                                            <label class="custom-control-label" for="unknown">Unknown</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="known" name="customRadio" class="custom-control-input" onclick="cekhuni(1)">
                                            <label class="custom-control-label" for="known">Known (Enter the Family Card Number)</label>
                                        </div>
                                        </label>
                                        <div id="nik2">
                                            <select class="selectpicker form-control" id="nik" data-container="body" data-live-search="true" title="Select a number" data-hide-disabled="true" onchange="simpanpemilik()">
                                                <option value="0">Unknown</option>
                                                <?php                
                                                    $sql_d=pg_query("SELECT national_identity_number, owner_name FROM house_building_owner ORDER BY owner_name");
                                                    while($row = pg_fetch_assoc($sql_d))
                                                    {
                                                        echo"<option value=".$row['national_identity_number'].">(".$row['national_identity_number'].") ".$row['owner_name']."</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <input type="hidden" name="pemilik" id="pemilik" required="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="tambahbangunan">+ Add</button>
                    </div>
                    </form>
                </form>
            </div>
        </div>
    </div>
    <!-- SAMPAI DISINI -->
    
                
                <!-- row area start-->
            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
       <?php include('../inc/foot.php') ?>
</body>
</html>
<script type="text/javascript">
    function back() {
        window.location.href ="../"
    }

    $(document).ready(function() {
        $('#listrumah').DataTable();
    } );

    function besarkan() {
        var id=document.getElementById('id').value.toUpperCase();
        document.getElementById('id').value=id;
    }

    function cekid () {
        var id=document.getElementById('id').value
        var ketemu=false;
        <?php 
          $sql = pg_query("SELECT worship_building_id FROM worship_building");
          while ($data = pg_fetch_array($sql))
          {
            $idnya = $data['worship_building_id'];
            echo "if (id == \"".$idnya."\")";
            echo "{
                    ketemu=true;
                    $('#ids').css('color', 'red');
                    $('#ids').html('...This ID is already registered');
                    $('#tambahbangunan').prop('disabled', true);
                  }";

          }
        ?>
         if (ketemu==false){
                $('#ids').empty();
                $('#tambahbangunan').prop('disabled', false);
            }
    }

    function reset () {
        $("#toggleCSS").attr("href", "../../assets/alertify/themes/alertify.default.css");
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

    $(".readonly").on('keydown paste', function(e){
        e.preventDefault();
    });

    $("#geom").on( 'click', function () {
        reset();
        alertify.alert('<img src="../../inc/poligon.gif" width="150px"><br/>please draw the area with polygon on the map');
        return false;
    });

    function cekhuni(val) {
        if (val==0) {
            document.getElementById("nik").value = "0";
            $('#nik2').hide();
            document.getElementById("pemilik").value=document.getElementById("nik").value;
        }
        else {
            $('#nik2').show();
        }
    }
    document.getElementById("nik").value = "0";
    $('#nik2').hide();

    document.getElementById("pemilik").value=document.getElementById("nik").value;
    function simpanpemilik() {
        document.getElementById("pemilik").value=document.getElementById("nik").value;
    }

</script>
<link rel="stylesheet" href="../../js/bootstrap.bundle.min.js" />
<script src="../dist/js/bootstrap-select.js"></script>