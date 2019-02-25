<div style="text-align: center; padding-top: 3%; padding-bottom:3%">
<button class="btn btn-default btn-lg" style="width: 90%; background-color: #fafafa" data-toggle="modal" data-target="#tambahkeluarga">+
    Add Family Data </button>
</div>

<div class="panel-body" style="padding-top: 2%; padding-left: 2%; padding-right: 2%">
    <h4 style="text-align: center;">List of Family Data</h4>
   
        <table width="100%" class="table table-striped table-bordered table-hover" id="listkeluarga">
            <thead>
                <tr style="text-align: center">
                    <th>No. Family Card</th>
                    <th>Name of Head Family</th>
                    <th>Action</th>
                </tr>
            </thead>
            </tr>
        </thead>
        <tbody>
            <?php
                                $sql=pg_query("SELECT * FROM msme_building");
                                while ($data=pg_fetch_assoc($sql)) {
                                    $id=$data['msme_building_id'];
                                    echo "<tr>";
                                    echo "<td>".$id."</td>";
                                    echo "<td>".$data['name_of_msme_building']."</td>";
                                    echo '<td>
                                        <a href="inforumah.php?id='.$id.'" target="_blank"><button class="btn btn-info btn-xs" title="View Detail"><i class="fa fa-info-circle"></i> View Detail</button></a>
                                        <a href="act/hapusrumah.php?id='.$id.'"><button class="btn btn-danger btn-xs" title="Hapus" onclick="return confirm(\'Yakin?\')"><i class="fa fa-trash"></i> Delete</button></a>
                                        </td>';
                                    echo "</tr>";
                                }
                            ?>
        </tbody>
    </table>
</div>


<div class="modal fade" id="tambahkeluarga">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h6 class="modal-title">Add Family Data</h6>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body" style="font-size: 110%">
                    Family Card Number: <input class="form-control" type="text" name="" value="<?php echo $nokk ?>">
                    Name: <input class="form-control" type="text" name="" value="<?php echo $nama ?>">
                    Birth Date: <input class="form-control" type="date" name="" value="<?php echo $tgl ?>">
                    Education Level: <input class="form-control" type="text" name="">
                    Job: <input class="form-control" type="text" name="">
                    Income:
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Rp</div>
                            </div>
                            <input type="text" class="form-control" id="penghasilan" value="<?php echo $pendapatan ?>" onkeyup="ceknominal()">
                        </div>
                    Take Insurance: <input class="form-control" type="text" name="">
                    Savings: <input class="form-control" type="text" name="">
                    Datuk: <input class="form-control" type="text" name="">
                    Tribe: <input class="form-control" type="text" name="">
                    Village: <input class="form-control" type="text" name="">
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
        $(document).ready(function() {
            $('#listkeluarga').DataTable();
        } );
</script>