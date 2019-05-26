<?php
    session_start();
    if(is_null($_SESSION['username'])){
        echo '<script>window.location="../../../assets/403"</script>';
    }
    include ('../../../inc/koneksi.php');
?>
    <h4 style="text-align: center;">Building Model List</h4>
    <table width="100%" class="table table-striped table-bordered table-hover" id="listmodel">
        <thead>
            <tr style="text-align: center">
                <th>No.</th>
                <th>Building Model</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no=1;
                $sql=pg_query("SELECT model_id, name_of_model FROM building_model ORDER BY name_of_model");
                while ($data=pg_fetch_assoc($sql)) {
                    $id=$data['model_id'];
                    $id_enc = "'".base64_encode($id)."'";
                    $model=$data['name_of_model'];
                    $ids="'".$id."'";
                    echo "<tr>";
                    echo "<td>".$no."</td>";
                    echo "<td>".$model."</td>";
                    echo '<td>
                            <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#edit-m'.$id.'"><i class="fa fa-edit"></i> Edit</button>
                            <button class="btn btn-danger btn-xs" title="Hapus" data-toggle="modal" data-target="#delete-model'.$id.'"><i class="fa fa-trash"></i> Delete</button>
                          </td>';
                    echo "</tr>";
                    $rumah=pg_num_rows(pg_query("SELECT house_building_id FROM house_building WHERE model_id='$id'"));
                    $umkm=pg_num_rows(pg_query("SELECT msme_building_id FROM msme_building WHERE model_id='$id'"));
                    $pendidikan=pg_num_rows(pg_query("SELECT educational_building_id FROM educational_building WHERE model_id='$id'"));
                    $kesehatan=pg_num_rows(pg_query("SELECT health_building_id FROM health_building WHERE model_id='$id'"));
                    $ibadah=pg_num_rows(pg_query("SELECT worship_building_id FROM worship_building WHERE model_id='$id'"));
                    $kantor=pg_num_rows(pg_query("SELECT office_building_id FROM office_building WHERE model_id='$id'"));
                    $total=$rumah+$umkm+$pendidikan+$kesehatan+$ibadah+$kantor;
                    echo '
                            <div class="modal fade" id="delete-model'.$id.'">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete '.$model.' ?</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure to delete "'.$model.'" from Building Model list ? <br/>
                                            There are as many as <b> '.$total.' </b> building(s) that have this model.
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-danger" onclick="hapusmodel('.$id_enc.','.$ids.')">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="modal fade" id="edit-m'.$id.'">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                <form method="post" id="form-editmodel'.$id.'">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Name of Building Model:</label>
                                                <input type="text" class="form-control" id="model-baru'.$id.'" value="'.$model.'" required>
                                            </div>
                                            <input type="hidden" class="form-control" value="'.$id.'">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="tombol-edit" onclick="editmodel('.$ids.')"><i class="ti-save"></i> Save</button>
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
        $('#listmodel').DataTable();
    } );
</script>