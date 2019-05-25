<?php
    session_start();
    if(is_null($_SESSION['username'])){
        echo '<script>window.location="../../../assets/403"</script>';
    }
    include ('../../../inc/koneksi.php');
?>
    <h4 style="text-align: center;">Asset List</h4>
   
        <table width="100%" class="table table-striped table-bordered table-hover" id="listaset">
            <thead>
                <tr style="text-align: center">
                    <th>No.</th>
                    <th>Asset Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody  id="tabel-jenis-umkm">
                <?php
                    $sql=pg_query("SELECT * FROM asset ORDER BY name_of_asset ASC");
                    $no=1;
                    while ($data=pg_fetch_assoc($sql)) {
                        $id=$data['asset_id'];
                        $id_enc= "'".base64_encode($id)."'";
                        $aset=$data['name_of_asset'];
                        echo "<tr>";
                        echo "<td>".$no."</td>";
                        echo "<td>".$aset."</td>";
                        echo '<td>
                            <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#edit-aset'.$id.'"><i class="fa fa-edit"></i> Edit</button>
                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete-aset'.$id.'"><i class="fa fa-trash"></i> Delete</button>
                            </td>';
                        echo "</tr>";

                        echo '
                            <div class="modal fade" id="delete-aset'.$id.'">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete '.$aset.' ?</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure to delete "'.$aset.'" from the asset list? <br/>
                                            There are as many as <b>-</b> head(s) of family(ies) who own this asset.
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-danger" onclick="hapusaset('.$id_enc.','.$id.')">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="modal fade" id="edit-aset'.$id.'">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Asset Name:</p>
                                            <input type="text" class="form-control" id="aset-edit'.$id.'" placeholder="enter asset name..." value="'.$aset.'">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-primary" onclick="editaset('.$id.')"><i class="ti-save"></i> Save</button>
                                        </div>
                                    </div>
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
        $('#listaset').DataTable();
    } );
</script>