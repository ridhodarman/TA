<?php
    session_start();
    if(is_null($_SESSION['username'])){
        echo '<script>window.location="../../../assets/403"</script>';
    }
    include ('../../../inc/koneksi.php');
?>
<h4 style="text-align: center;">Type of Micro, Small, Medium Enterprises List</h4>
   
        <table width="100%" class="table table-striped table-bordered table-hover" id="listjenis">
            <thead>
                <tr style="text-align: center">
                    <th>No.</th>
                    <th>Type of MSME</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql=pg_query("SELECT type_id, name_of_type FROM type_of_msme ORDER BY name_of_type ASC");
                    $no=1;
                    while ($data=pg_fetch_assoc($sql)) {
                        $id=$data['type_id'];
                        $id_enc= "'".base64_encode($id)."'";
                        $jenis=$data['name_of_type'];
                        echo "<tr>";
                        echo "<td>".$no."</td>";
                        echo "<td>".$jenis."</td>";
                        echo '<td>
                            <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#edit-j'.$id.'"><i class="fa fa-edit"></i> Edit</button>
                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete-j'.$id.'"><i class="fa fa-trash"></i> Delete</button>
                            </td>';
                        echo "</tr>";

                        $u=pg_num_rows(pg_query("SELECT msme_building_id FROM msme_building WHERE type_of_msme='$id'"));

                        echo '
                            <div class="modal fade" id="delete-j'.$id.'">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete '.$jenis.' ?</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure to delete "'.$jenis.'" from the type of MSME ? <br/>
                                            There are as many as <b>'.$u.'</b> MSME building(s) that have this type.
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-danger" onclick="hapusjenis('.$id_enc.','.$id.')">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="modal fade" id="edit-j'.$id.'">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <form method="post" id="form-editjenis">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>MSME Type:</p>
                                                <input type="text" class="form-control" name="jenis-edit" id="jenis-edit'.$id.'" placeholder="Enter the type of MSME..." value="'.$jenis.'">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary" onclick="editjenis('.$id.')"><i class="ti-save"></i> Save</button>
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
        $('#listjenis').DataTable();
    } );
</script>