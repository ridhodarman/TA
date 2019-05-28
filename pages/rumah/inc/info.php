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
                            <td>Electricity Capacity</td>
                            <td>:</td>
                            <td>
                                <?php echo $listrik ?>
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
            <div class="modal-header">
                <h6 class="modal-title">Edit House Building Info</h6>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form method="post" action="act/info-edit.php">
            <div class="modal-body" style="font-size: 110%">
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label> ID Survey</label><label id="ids"></label>
                        <input type="text" class="form-control" name="id" value="<?php echo $id ?>" id="id" onkeyup="besarkan()" onchange="cekid()" required>
                        <input type="hidden" name="id-temp" value="<?php echo $id ?>"/>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Standing Year</label><label id="tahuns"></label>
                        <input type="text" class="form-control" name="tahun" value="<?php echo $tahun ?>" onkeypress="return hanyaAngka(event, '#tahuns')">
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
                        <select name="konstruksi" class="form-control" style="height: 43px" required>
                            <option value="<?php echo $tipe_k ?>"><?php echo $jkonstruksi ?></option>
                            <?php                
                                $sql_jibadah=pg_query("SELECT * FROM type_of_construction WHERE type_id != '$tipe_k' ORDER BY name_of_type");
                                while($row = pg_fetch_assoc($sql_jibadah))
                                {
                                    echo"<option value=".$row['type_id'].">".$row['name_of_type']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Electricity Capacity (kWh)</label><label id="listriks"></label>
                        <input type="text" class="form-control" name="listrik" value="<?php echo $listrik ?>" onkeypress="return hanyaAngka(event, '#listriks')">
                    </div>
                    <div class="form-group col-sm-6" id="water">
                        <label>Tap Water</label>
                        <select name="water" class="form-control" style="height: 43px">
                            <option value="0">Not Available</option>
                            <option value="1">Available</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <div class="row">
                            <div class="form-group col-sm-12" id="status">
                                <label>Status</label>
                                <select name="status" class="form-control" style="height: 43px">
                                    <option value="0">Unhabited</option>
                                    <option value="1">Inhabited</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-12" id="model">
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
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Alamat</label>
                        <textarea class="form-control" name="alamat"><?php echo $alamat ?></textarea>
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

<script type="text/javascript">
    $("#water select").val(<?php echo "'".$i_water."'" ?>);
    $("#status select").val(<?php echo "'".$i_status."'" ?>);
    $("#model select").val(<?php echo "'".$id_model."'" ?>);

    function besarkan() {
        var id=document.getElementById('id').value.toUpperCase();
        document.getElementById('id').value=id;
    }

    function cekid () {
        var id=document.getElementById('id').value
        var ketemu=false;
        <?php 
          $sql = pg_query("SELECT worship_building_id FROM worship_building WHERE worship_building_id NOT LIKE '$id'");
          while ($data = pg_fetch_array($sql))
          {
            $idnya = $data['worship_building_id'];
            echo "if (id == \"".$idnya."\")";
            echo "{
                    ketemu=true;
                    $('#ids').css('color', 'red');
                    $('#ids').html('...This ID is already registered');
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