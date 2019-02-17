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

<div style="text-align: center; padding-top: 3%; padding-bottom:3%">
<button class="btn btn-default btn-lg" style="width: 90%; background-color: #fafafa" data-toggle="modal" data-target="#tambahbang">+
    Add MSME Building Data </button>
</div>

<div class="panel-body" style="padding-top: 2%; padding-left: 2%; padding-right: 2%">
    <h4 style="text-align: center;">Micro, Small, Medium Enterprises List</h4>
    <table width="100%" class="table table-striped table-bordered table-hover" id="listbang">
        <thead>
            <tr style="text-align: center">
                <th>ID</th>
                <th>Name of MSME Building</th>
                <!-- <th>Type of MSME</th> -->
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql=pg_query("SELECT M.msme_building_id, M.name_of_msme_building, M.address, J.name_of_type AS jenis
                    FROM msme_building AS M 
                    LEFT JOIN type_of_health_services AS J ON J.type_id=M.type_of_msme");
                while ($data=pg_fetch_assoc($sql)) {
                    $id=$data['msme_building_id'];
                    $nama=$data['name_of_msme_building'];
                    echo "<tr>";
                    echo "<td>".$id."</td>";
                    echo "<td>".$nama."</td>";
                    // echo "<td>".$data['jenis']."</td>";
                    echo "<td>".wordlimit($data['address'],40)."</td>";
                    echo '<td>
                        <a href="info-umkm.php?id='.$id.'"><button class="btn btn-info btn-xs" title="View Detail"><i class="fa fa-info-circle"></i> View Detail</button></a>
                        <button class="btn btn-danger btn-xs" title="Hapus" data-toggle="modal" data-target="#delete-bang'.$id.'"><i class="fa fa-trash"></i> Delete</button>
                        </td>';
                    echo "</tr>";
                    $id2 = base64_encode($id);
                    echo '
                        <div class="modal fade" id="delete-bang'.$id.'">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete '.$nama.' ?</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure to delete "'.$nama.'" from  the msme building data ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <a href="act/hapus-umkm.php?id='.$id2.'"><button type="button" class="btn btn-danger">Delete</button></a>
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

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDM2fDXHmGzCDmDBk3bdPIEjs6zwnI1kGQ&libraries=drawing"></script>        
<script src="../inc/mapupd.js" type="text/javascript"></script>

<div class="modal fade bd-example-modal-lg modal-xl" id="tambahbang">
        <div class="modal-dialog modal-lg modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add MSME Building Data</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form role="form" action="act/tambah-umkm.php" enctype="multipart/form-data" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6" id="hide2">
                                <!-- menampilkan peta-->
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
                                        <div id="map" style="width:100%;height:440px;"></div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label>Standing Year</label><label id="tahuns"></label>
                                            <input type="text" class="form-control" name="tahun" value="0" onkeypress="return hanyaAngka(event, '#tahuns')">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label>Electricity Capacity (kWh)</label><label id="listriks"></label>
                                            <input type="text" class="form-control" name="listrik" value="0" onkeypress="return hanyaAngka(event, '#listriks')">
                                        </div>
                                    </div>
                            </div>

                            <div class="col-sm-6" id="hide3">
                                <!-- menampilkan form tambah-->
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label><span style="color:red">*</span>ID Survey</label><b id="ids"></b>
                                        <input type="text" class="form-control" name="id" id="id" onkeyup="besarkan()" onchange="cekid()" required>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label><span style="color:red">*</span>Name</label>
                                        <input type="text" class="form-control" name="nama" value="" required>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label><span style="color:red">*</span>Type of MSME</label>
                                        <select name="jenis" class="form-control" style="font-size: 85%">
                                            <?php                
                                                $sql_j=pg_query("SELECT * FROM type_of_msme ORDER BY name_of_type");
                                                while($row = pg_fetch_assoc($sql_j))
                                                {
                                                    echo"<option value=".$row['type_id'].">".$row['name_of_type']."</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Owner Name</label>
                                        <input type="text" class="form-control" name="pemilik" value="">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Mounthly Income</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Rp</div>
                                            </div>
                                            <input type="text" class="form-control" name="penghasilan" id="penghasilan" onkeyup="ceknominal()" value="0">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Contact Person</label>
                                        <input type="text" class="form-control" name="kontak" value="">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Number of Employee</label><label id="pegawais"></label>
                                        <input type="text" class="form-control" name="pegawai" value="0" onkeypress="return hanyaAngka(event, '#pegawais')">
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
                                        <label><span style="color:red">*</span> Coordinat</label>
                                        <textarea class="form-control readonly" id="geom" name="geom" required></textarea>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Alamat</label>
                                        <textarea class="form-control" name="alamat"></textarea>
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
                                        <label>Parking Area (m<sup>2</sup>)</label><label id="parkirs"></label>
                                        <input type="text" class="form-control" name="parkir" value="0" onkeypress="return hanyaAngka(event, '#parkirs')">
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


<script type="text/javascript">
    $(document).ready(function() {
        $('#listbang').DataTable();
    } );

    // $(document).ready(function() {
    //     if ($('#geom').val()=="") {
    //         $('#tambahbangunan').prop('disabled', true);
    //     }
    //     else {
    //         $('#tambahbangunan').prop('disabled', false);   
    //     }
    // } );

    function besarkan() {
        var id=document.getElementById('id').value.toUpperCase();
        document.getElementById('id').value=id;
    }

    function cekid () {
        var id=document.getElementById('id').value
        var ketemu=false;
        <?php 
          $sql = pg_query("SELECT msme_building_id FROM msme_building");
          while ($data = pg_fetch_array($sql))
          {
            $idnya = $data['msme_building_id'];
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

    $("#geom").on( 'click', function () {
        reset();
        alertify.alert('<img src="../../inc/poligon.gif" width="150px"><br/>please draw the area with polygon on the map');
        return false;
    });
</script>