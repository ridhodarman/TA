<div style="float: right; padding-right: 1%; padding-bottom: 6%; ">
<button type="button" class="btn btn-info btn-sm btn-flat btn-lg mt-3" data-toggle="modal" data-target="#editpemilik"><i class="fa fa-edit"></i> Edit</button>

<button type="button" class="btn btn-warning btn-sm btn-flat btn-lg mt-3" data-toggle="modal" data-target="#gantipemilik">
    <b> <i class="fas fa-id-card-alt"></i> Change Owner</b></button>

</div>
            <!-- Modal -->
<div class="modal fade" id="editpemilik">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h6 class="modal-title">Edit Owner Data</h6>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body" style="font-size: 110%">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            Family Card Number: <input class="form-control" type="text" name="" value="<?php echo $nokk ?>">
                        </div>
                        <div class="form-group col-sm-6">
                            Name: <input class="form-control" type="text" name="" value="<?php echo $nama ?>">
                        </div>
                        <div class="form-group col-sm-6">
                            Birth Date: <input class="form-control" type="date" name="" value="<?php echo $tgl ?>">
                        </div>
                        <div class="form-group col-sm-6">
                            Education Level:
                            <select class="form-control" name="kerja" required>
                                <option></option>
                                <?php                
                                    $sql_p=pg_query("SELECT * FROM education ORDER BY educational_level");
                                    while($row = pg_fetch_assoc($sql_p))
                                    {
                                        echo"<option value=".$row['education_id'].">".$row['educational_level']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            Job: 
                            <select class="form-control" name="kerja" required>
                                <option></option>
                                <?php                
                                    $sql_k=pg_query("SELECT * FROM job ORDER BY job_name");
                                    while($row = pg_fetch_assoc($sql_k))
                                    {
                                        echo"<option value=".$row['job_id'].">".$row['job_name']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            Income:
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp</div>
                                </div>
                                <input type="text" class="form-control" id="penghasilan" onkeyup="ceknominal()">
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            Take Insurance:
                             <select class="form-control" name="asuransi" required>
                                <option></option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            Savings:
                            <select class="form-control" name="tabungan" required>
                                <option></option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            Datuk:
                            <select class="form-control" name="datuk" required>
                                <option></option>
                                <?php                
                                    $sql_suku=pg_query("SELECT * FROM datuk ORDER BY datuk_name");
                                    while($row = pg_fetch_assoc($sql_suku))
                                    {
                                        echo"<option value=".$row['datuk_id'].">".$row['datuk_name']."</option>";
                                    }
                                ?>
                            </select>
                            <font id="suku">Tribe: -</font>
                        </div>
                        <div class="form-group col-sm-6">Village:
                            <select class="form-control" name="kampung" id="kampung" required>
                                <option></option>
                                <?php                
                                    $sql_v=pg_query("SELECT * FROM village ORDER BY village_name");
                                    while($row = pg_fetch_assoc($sql_v))
                                    {
                                        echo"<option value=".$row['village_id'].">".$row['village_name']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $("#kampung").val(<?php echo "'".$id_kampung."'" ?>).change();
    alert(<?php echo "'".$id_kampung."'" ?>)
</script>