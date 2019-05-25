<?php
    session_start();
    if(is_null($_SESSION['username'])){
        echo '<script>window.location="../../../assets/403"</script>';
    }
    include ('../../../inc/koneksi.php');
?>
    <h4 style="text-align: center;">List of Householder</h4>
   
        <table width="100%" class="table table-striped table-bordered table-hover" id="listholder">
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
                                $sql=pg_query("SELECT family_card_number, head_of_family FROM family_card");
                                while ($data=pg_fetch_assoc($sql)) {
                                    $id=$data['family_card_number'];
                                    $nama = $data['head_of_family'];
                                    $id_enc = "'".base64_encode($id)."'";
                                    $id2 = "'".$id."'";
                                    echo "<tr>";
                                    echo "<td>".$id."</td>";
                                    echo "<td>".$nama."</td>";
                                    echo '<td>
                                        <a href="info-holder.php?id='.$id.'"><button class="btn btn-info btn-xs" title="View Detail"><i class="fa fa-info-circle"></i> View Detail</button></a>
                                        <button class="btn btn-danger btn-xs" title="Hapus" data-toggle="modal" data-target="#delete-h'.$id.'"><i class="fa fa-trash"></i> Delete</button>
                                        </td>';
                                    echo "</tr>";
                                    echo '
                                        <div class="modal fade" id="delete-h'.$id.'">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Delete '.$id.' ?</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure to delete '.$id.' (Head of Family: '.$nama.') from  family_card data ?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="button" class="btn btn-danger" onclick="hapusholder('.$id_enc.','.$id2.')">Delete</button>
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
        $('#listholder').DataTable();
    } );
</script>