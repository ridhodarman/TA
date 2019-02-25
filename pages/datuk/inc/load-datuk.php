<?php
    session_start();
    if(is_null($_SESSION['username'])){
        echo '<script>window.location="../../../assets/403"</script>';
    }
    include ('../../../inc/koneksi.php');
?>
    <h4 style="text-align: center;">Datuk List</h4>
    <table width="100%" class="table table-striped table-bordered table-hover" id="listdatuk">
        <thead>
            <tr style="text-align: center">
                <th>No.</th>
                <th>Name of Datuk</th>
                <th>Tribe</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no=1;
                $sql=pg_query("SELECT D.datuk_id, D.datuk_name, D.tribe_id, T.name_of_tribe 
                                FROM datuk AS D
                                JOIN tribe AS T ON D.tribe_id=T.tribe_id
                            ");
                while ($data=pg_fetch_assoc($sql)) {
                    $id=$data['datuk_id'];
                    $id_enc= "'".base64_encode($id)."'";
                    $id_suku=$data['D.tribe_id'];
                    $nama=$data['datuk_name'];
                    echo "<tr>";
                    echo "<td>".$no."</td>";
                    echo "<td>".$nama."</td>";
                    echo "<td>".$data['name_of_tribe']."</td>";
                    echo '<td>
                            <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#edit-datuk'.$id.'"><i class="fa fa-edit"></i> Edit</button>
                            <button class="btn btn-danger btn-xs" title="Hapus" data-toggle="modal" data-target="#delete-datuk'.$id.'"><i class="fa fa-trash"></i> Delete</button>
                          </td>';
                    echo "</tr>";

                    //$j_datuk=pg_num_rows(pg_query("SELECT datuk_id FROM datuk WHERE tribe_id='$id'"));

                    echo '
                            <div class="modal fade" id="delete-datuk'.$id.'">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete '.$nama.' ?</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <center><p>Are you sure to delete "'.$nama.'" from data of datuk list ? <br/>
                                            There are as many as <b> - </b> families that have this datuk.
                                            </p></center>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-danger" onclick="hapusdatuk('.$id_enc.','.$id.')">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="modal fade" id="edit-datuk'.$id.'">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                <form method="post" id="form-editdatuk">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Name of Datuk:</label>
                                                <input type="text" class="form-control" id="edit-nama'.$id.'" value="'.$nama.'" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Tribe:</label>
                                                <select class="form-control" id="edit-suku'.$id.'" value="'.$suku.'" required>
                                                <option></option>';
                                                $sql_suku=pg_query("SELECT * FROM tribe ORDER BY name_of_tribe");
                                                while($row = pg_fetch_assoc($sql_suku))
                                                {
                                                    echo"<option value=".$row['tribe_id'].">".$row['name_of_tribe']."</option>";
                                                }
                            
                            echo '
                                                </select>
                                            </div>
                                            <input type="hidden" class="form-control" name="id" value="'.$id.'" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" onclick="editdatuk('.$id.')""><i class="ti-save"></i> Save</button>
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
        $('#listdatuk').DataTable();
    } );
</script>