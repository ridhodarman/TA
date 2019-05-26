<?php
    session_start();
    if(is_null($_SESSION['username'])){
        echo '<script>window.location="../../../assets/403"</script>';
    }
?>
<h4 style="text-align: center;">Construction Type List</h4>
    <table width="100%" class="table table-striped table-bordered table-hover" id="listkonstruksi">
        <thead>
            <tr style="text-align: center">
                <th>No.</th>
                <th>Construction Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no=1;
                include ('../../../inc/koneksi.php');
                $sql=pg_query("SELECT type_id, name_of_type FROM type_of_construction ORDER BY name_of_type");
                while ($data=pg_fetch_assoc($sql)) {
                    $id=$data['type_id'];
                    $id_enc = "'".base64_encode($id)."'";
                    $jenis=$data['name_of_type'];
                    $ids="'".$id."'";
                    echo "<tr>";
                    echo "<td>".$no."</td>";
                    echo "<td>".$jenis."</td>";
                    echo '<td>
                            <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#edit-k'.$id.'"><i class="fa fa-edit"></i> Edit</button>
                            <button class="btn btn-danger btn-xs" title="Hapus" data-toggle="modal" data-target="#delete-jenis'.$id.'"><i class="fa fa-trash"></i> Delete</button>
                          </td>';
                    echo "</tr>";
                    $rumah=pg_num_rows(pg_query("SELECT house_building_id FROM house_building WHERE type_of_construction='$id'"));
                    $umkm=pg_num_rows(pg_query("SELECT msme_building_id FROM msme_building WHERE type_of_construction='$id'"));
                    $pendidikan=pg_num_rows(pg_query("SELECT educational_building_id FROM educational_building WHERE type_of_construction='$id'"));
                    $kesehatan=pg_num_rows(pg_query("SELECT health_building_id FROM health_building WHERE type_of_construction='$id'"));
                    $ibadah=pg_num_rows(pg_query("SELECT worship_building_id FROM worship_building WHERE type_of_construction='$id'"));
                    $kantor=pg_num_rows(pg_query("SELECT office_building_id FROM office_building WHERE type_of_construction='$id'"));
                    $total=$rumah+$umkm+$pendidikan+$kesehatan+$ibadah+$kantor;
                    echo '
                            <div class="modal fade" id="delete-jenis'.$id.'">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete '.$jenis.' ?</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure to delete "'.$jenis.'" from construction type list ? <br/>
                                            There are as many as <b> '.$total.' </b> building(s) that have this construction type.
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-danger" onclick="hapusjenis('.$id_enc.','.$ids.')">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="modal fade" id="edit-k'.$id.'">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                <form method="post" id="form-editjenis'.$id.'">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Name of Construction Type:</label>
                                                <input type="text" class="form-control" name="jenis-baru" id="jenis-baru'.$id.'" value="'.$jenis.'" required>
                                            </div>
                                            <input type="hidden" class="form-control" name="id-jenisk" value="'.$id.'">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-primary" id="tombol-edit" onclick="editjenis('.$ids.')"><i class="ti-save"></i> Save</button>
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
        $('#listkonstruksi').DataTable();
    } );
</script>