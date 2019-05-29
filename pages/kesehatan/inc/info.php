<div class="card">
    <div class="card-body">
        <div class="media mb-5">
            <div class="media-body">
                <button type="button" class="btn btn-info btn-sm btn-flat btn-lg mt-3" data-toggle="modal" data-target="#editinfo" style="float: right;"><i class="fa fa-edit"></i> Edit</button><br/>
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
                        <td>Type of Health Building</td>
                        <td>:</td>
                        <td>
                            <?php echo $jenis; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Name of Head</td>
                        <td>:</td>
                        <td>
                            <?php echo $kepala; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Number of Medical Personnel</td>
                        <td>:</td>
                        <td>
                            <?php echo $medis; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Number of Non-Medical Personnel</td>
                        <td>:</td>
                        <td>
                            <?php echo $non; ?>
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
            <!-- Modal -->
<div class="modal fade" id="editinfo">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" action="act/info-edit.php" style="width: 150%; background-color: white; border-radius: 1%">
            <div class="modal-header">
                <h6 class="modal-title">Edit Health Building Info</h6>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label><span style="color:red">*</span>ID Survey</label><div id="ids"></div>
                        <input type="text" class="form-control" name="id" id="id" onkeyup="besarkan()" onchange="cekid()" value="<?php echo $id; ?>" required>
                        <input type="hidden" name="id-temp" value="<?php echo $id; ?>">
                    </div>
                    <div class="form-group col-sm-4">
                        <label><span style="color:red">*</span>Name</label>
                        <input type="text" class="form-control" name="nama" value="<?php echo $nama; ?>" required>
                    </div>
                    <div class="form-group col-sm-4" id="jenis">
                        <label><span style="color:red">*</span>Type of Health Building</label>
                        <select name="j-kes" class="form-control" style="height: 43px">
                            <?php                
                                $sql_j=pg_query("SELECT * FROM type_of_health_building");
                                while($row = pg_fetch_assoc($sql_j))
                                {
                                    echo"<option value=".$row['type_id'].">".$row['name_of_type']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-4">
                        <label>Head Name</label>
                        <input type="text" class="form-control" name="kepala" value="<?php echo $kepala; ?>">
                    </div>
                    <div class="form-group col-sm-4">
                        <label>Number of Medical Personnel</label><label id="mediss"></label>
                        <input type="text" class="form-control" name="medis" value="<?php echo $medis; ?>" onkeypress="return hanyaAngka(event, '#mediss')">
                    </div>
                    <div class="form-group col-sm-4">
                        <label>Number of Non-Medical Personnel</label><label id="nons"></label>
                        <input type="text" class="form-control" name="non" value="<?php echo $non; ?>" onkeypress="return hanyaAngka(event, '#nons')">
                    </div>
                    <div class="form-group col-sm-4" id="konstruksi">
                        <label>Construction Type</label>
                        <select name="konstruksi" class="form-control" style="height: 43px">
                            <?php                
                                $sql_j=pg_query("SELECT * FROM type_of_construction");
                                while($row = pg_fetch_assoc($sql_j))
                                {
                                    echo"<option value=".$row['type_id'].">".$row['name_of_type']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-4">
                        <label>Building Area (m<sup>2</sup>)</label><label id="lbangs"></label>
                        <input type="text" class="form-control" name="lbang" value="<?php echo $bang; ?>" onkeypress="return hanyaAngka(event, '#lbangs')" value="<?php echo $bang ?>">
                    </div>
                    <div class="form-group col-sm-4">
                        <label>Land Area (m<sup>2</sup>)</label><label id="lahans"></label>
                        <input type="text" class="form-control" name="lahan" value="<?php echo $lahan; ?>" onkeypress="return hanyaAngka(event, '#lahans')">
                    </div>
                    <div class="form-group col-sm-4">
                        <label>Parking Area (m<sup>2</sup>)</label><label id="parkirs"></label>
                        <input type="text" class="form-control" name="parkir" value="<?php echo $parkir; ?>" onkeypress="return hanyaAngka(event, '#parkirs')">
                    </div>
                    <div class="form-group col-sm-4">
                        <label>Electricity Capacity (kWh)</label><label id="listriks"></label>
                        <input type="text" class="form-control" name="listrik" value="<?php echo $listrik; ?>" onkeypress="return hanyaAngka(event, '#listriks')">
                    </div>
                    <div class="form-group col-sm-4">
                        <label>Standing Year</label><label id="tahuns"></label>
                        <input type="text" class="form-control" name="tahun" value="<?php echo $tahun; ?>" onkeypress="return hanyaAngka(event, '#tahuns')">
                    </div>
                    <div class="form-group col-sm-4" id="model">
                        <label>Building Model</label>
                        <select name="model" class="form-control" style="height: 43px">
                            <?php                
                                $sql_j=pg_query("SELECT * FROM building_model ORDER BY name_of_model");
                                while($row = pg_fetch_assoc($sql_j))
                                {
                                    echo"<option value=".$row['model_id'].">".$row['name_of_model']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-4">
                        <label>Alamat</label>
                        <textarea class="form-control" name="alamat"><?php echo $alamat; ?></textarea>
                    </div>
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

<?php
$id_ada = '<div class="alert alert-danger alert-dismissible fade show" role="alert">This <strong>ID</strong> is already registered</div>';
?>

<script type="text/javascript">
    $("#jenis select").val(<?php echo "'".$id_jenis."'" ?>);
    $("#konstruksi select").val(<?php echo "'".$id_kons."'" ?>);
    $("#model select").val(<?php echo "'".$id_model."'" ?>);

    function besarkan() {
        var id=document.getElementById('id').value.toUpperCase();
        document.getElementById('id').value=id;
    }

    function cekid () {
        var id=document.getElementById('id').value
        var ketemu=false;
        <?php 
          $sql = pg_query("SELECT health_building_id FROM health_building WHERE health_building_id NOT LIKE '$id'");
          while ($data = pg_fetch_array($sql))
          {
            $idnya = $data['health_building_id'];
            echo "if (id == \"".$idnya."\")";
            echo "{
                    ketemu=true;
                    $('#ids').html('".$id_ada."');
                    $('#simpan').prop('disabled', true);
                  }";

          }
        ?>
         if (ketemu==false){
                $('#ids').empty();
                $('#simpan').prop('disabled', false);
            }
    }
</script>