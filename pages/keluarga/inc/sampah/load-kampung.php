<?php
    session_start();
    if(is_null($_SESSION['username'])){
        echo '<script>window.location="../../../assets/403"</script>';
    }
    include ('../../../inc/koneksi.php');
?>
    <h4 style="text-align: center;">Village List</h4>
   
        <table width="100%" class="table table-striped table-bordered table-hover" id="listkampung">
            <thead>
                <tr style="text-align: center">
                    <th>No.</th>
                    <th>Village Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody  id="tabel-jenis-umkm">
                <?php
                    $sql=pg_query("SELECT * FROM village ORDER BY village_name ASC");
                    $no=1;
                    while ($data=pg_fetch_assoc($sql)) {
                        $id=$data['village_id'];
                        $id_enc= "'".base64_encode($id)."'";
                        $namakampung=$data['village_name'];
                        echo "<tr>";
                        echo "<td>".$no."</td>";
                        echo "<td>".$namakampung."</td>";
                        echo '<td>
                            <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#edit-kampung'.$id.'"><i class="fa fa-edit"></i> Edit</button>
                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete-kampung'.$id.'"><i class="fa fa-trash"></i> Delete</button>
                            </td>';
                        echo "</tr>";

                        echo '
                            <div class="modal fade" id="delete-kampung'.$id.'">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete '.$namakampung.' ?</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure to delete "'.$namakampung.'" from the village list? <br/>
                                            There are as many as <b>-</b> head(s) of family(ies) who have this village.
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-danger" onclick="hapuskampung('.$id_enc.','.$id.')">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="modal fade" id="edit-kampung'.$id.'">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <form method="post" id="form-editkampung">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Village Name:</p>
                                                <input type="text" class="form-control" id="kampung-edit'.$id.'" placeholder="enter the name of village..." value="'.$namakampung.'">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary" onclick="editkampung('.$id.')"><i class="ti-save"></i> Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        ';
                        $no++;
                    }
                ?>
            </tbody>
        </table>

<script type="text/javascript">
	$(document).ready(function() {
        $('#listkampung').DataTable();
    } );
</script>