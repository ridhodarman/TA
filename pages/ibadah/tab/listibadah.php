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
<button class="btn btn-default btn-lg" style="width: 90%; background-color: #fafafa" data-toggle="modal" data-target="#tambahibadah">+
    Add Worship Building Data </button>
</div>

<div class="panel-body" style="padding-top: 2%; padding-left: 2%; padding-right: 2%">
    <h4 style="text-align: center;">List of Worship Buildings</h4>
    <table width="100%" class="table table-striped table-bordered table-hover" id="listibadah">
        <thead>
            <tr style="text-align: center">
                <th>ID</th>
                <th>Worship Building Name</th>
                <th>Address</th>
                <th>Type of Worship Building</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                                $sql=pg_query("SELECT W.worship_building_id, W.name_of_worship_building, W.address, J.name_of_type AS jenis
                                    FROM worship_building AS W 
                                    LEFT JOIN type_of_worship AS J ON J.type_id=W.type_of_worship");
                                while ($data=pg_fetch_assoc($sql)) {
                                    $id=$data['worship_building_id'];
                                    $nama=$data['name_of_worship_building'];
                                    echo "<tr>";
                                    echo "<td>".$id."</td>";
                                    echo "<td>".$nama."</td>";
                                    echo "<td>".wordlimit($data['address'],50)."</td>";
                                    echo "<td>".$data['jenis']."</td>";
                                    echo '<td>
                                        <a href="info-b-ibadah.php?id='.$id.'"><button class="btn btn-info btn-xs" title="View Detail"><i class="fa fa-info-circle"></i> View Detail</button></a>
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
                                                        <p>Are you sure to delete "'.$nama.'" from  the worship building data ?</p>
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

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDM2fDXHmGzCDmDBk3bdPIEjs6zwnI1kGQ&libraries=drawing"></script>        
<script src="../inc/mapupd.js" type="text/javascript"></script>

<div class="modal fade bd-example-modal-lg modal-xl" id="tambahibadah">
        <div class="modal-dialog modal-lg modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Worship Building Data</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form role="form" action="act/tambah-b-ibadah.php" enctype="multipart/form-data" method="post">
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
                                        <label><span style="color:red">*</span>Name</label>
                                        <input type="text" class="form-control" name="nama" value="" required>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label><span style="color:red">*</span>Worship Building Type</label>
                                        <select name="j-ibadah" class="form-control" style="font-size: 85%">
                                            <?php                
                                                $sql_jibadah=pg_query("SELECT * FROM type_of_worship ORDER BY name_of_type");
                                                while($row = pg_fetch_assoc($sql_jibadah))
                                                {
                                                    echo"<option value=".$row['type_id'].">".$row['name_of_type']."</option>";
                                                }
                                            ?>
                                        </select>
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
                                        <label>Parking Area (m<sup>2</sup>)</label><label id="parkirs"></label>
                                        <input type="text" class="form-control" name="parkir" value="0" onkeypress="return hanyaAngka(event, '#parkirs')">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Electricity Capacity (kWh)</label><label id="listriks"></label>
                                        <input type="text" class="form-control" name="listrik" value="0" onkeypress="return hanyaAngka(event, '#listriks')">
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
                                        <label>Standing Year</label><label id="tahuns"></label>
                                        <input type="text" class="form-control" name="tahun" value="0" onkeypress="return hanyaAngka(event, '#tahuns')">
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
        $('#listibadah').DataTable();
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

    $(".readonly").on('keydown paste', function(e){
        e.preventDefault();
    });

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