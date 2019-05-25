<?php
    session_start();
    if(is_null($_SESSION['username'])){
        echo '<script>window.location="../../../assets/403"</script>';
    }
    include ('../../../inc/koneksi.php');
?>
    <h4 style="text-align: center;">Citizen List</h4>

    <table width="100%" class="table table-striped table-bordered table-hover" id="listcitizen">
        <thead>
            <tr style="text-align: center">
                <th>National ID Number</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql=pg_query("SELECT national_identity_number, name FROM citizen");
                while ($data=pg_fetch_assoc($sql)) {
                    $id=$data['national_identity_number'];
                    $nama = $data['name'];
                    echo "<tr>";
                    echo "<td>".$id."</td>";
                    echo "<td>".$nama."</td>";
                    echo '<td>
                        <a href="info-citizen.php?id='.$id.'"><button class="btn btn-info btn-xs" title="View Detail"><i class="fa fa-info-circle"></i> View Detail</button></a>
                        <button class="btn btn-danger btn-xs" title="Hapus" data-toggle="modal" data-target="#delete-c'.$id.'"><i class="fa fa-trash"></i> Delete</button>
                        </td>';
                    echo "</tr>";
                    $id_enc = "'".base64_encode($id)."'";
                    $id2 = "'".$id."'";
                    echo '
                        <div class="modal fade" id="delete-c'.$id.'">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete '.$id.' ?</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure to delete '.$id.' ('.$nama.') from  citizen data ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-danger" onclick="hapuscitizen('.$id_enc.','.$id2.')">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ';
                }
            ?>
        </tbody>
    </table>

<script type="text/javascript">
	$(document).ready(function() {
        $('#listcitizen').DataTable();
    } );
</script>