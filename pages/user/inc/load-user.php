<?php
    session_start();
    if(is_null($_SESSION['username']) || $_SESSION['role'] != 1){
        echo '<script>window.location="../../../assets/403"</script>';
    }
    include ('../../../inc/koneksi.php');
?>
    <h4 style="text-align: center;">Admin Nagari List</h4>
    <table width="100%" class="table table-striped table-bordered table-hover" id="listadmin">
        <thead>
            <tr style="text-align: center">
                <th>No.</th>
                <th>username</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql=pg_query("SELECT username FROM user_account WHERE role =0");
                $no=1;
                while ($data=pg_fetch_assoc($sql)) {
                    $username=$data['username'];
                    echo "<tr>";
                    echo "<td>".$no."</td>";
                    echo "<td>".$username."</td>";
                    echo '<td>
                        <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#edit-admin'.$username.'"><i class="fa fa-edit"></i> Edit</button>
                        <button class="btn btn-danger btn-xs" title="Hapus" data-toggle="modal" data-target="#delete-admin'.$username.'"><i class="fa fa-trash"></i> Delete</button>
                        </td>';
                    echo "</tr>";
                    $user_enc = "'".base64_encode($username)."'";
                    $usr="'".$username."'";
                    $usr2="'usr-edit".$username."'";
                    $ids="'ids".$username."'";
                    $pw="'pw-edit".$username."'";
                    $pw2="'pw2-edit".$username."'";
                    $button="'editadmin".$username."'";
                    $label="'samakan-edit".$username."'";
                    echo '
                        <div class="modal fade" id="delete-admin'.$username.'">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete '.$username.' ?</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure to delete "'.$username.'" ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-danger" onclick="hapusadmin('.$user_enc.','.$usr.')">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="edit-admin'.$username.'">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <form method="post" id="form-editadmin'.$username.'" action="act/edit-admin.php">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Username:<label id="ids'.$username.'"></label></p>
                                            <input type="hidden" name="usr-temp" value="'.$username.'">
                                            <input type="text" class="form-control" name="usr-edit" id="usr-edit'.$username.'" placeholder="Enter username..." value="'.$username.'" onchange="cekid2('.$usr2.', '.$ids.', '.$button.', '.$usr.')" required>
                                            <p>New Password:</p>
                                            <input type="password" class="form-control" name="pw-edit" id="pw-edit'.$username.'" value="'.$username.'" onkeyup="cek('.$pw.', '.$pw2.', '.$button.', '.$label.')" value="" required>
                                            <p>Re-type New Password:</p>
                                            <input type="password" class="form-control" id="pw2-edit'.$username.'" onkeyup="cek('.$pw.', '.$pw2.', '.$button.', '.$label.')" value="" required>
                                            <label id="samakan-edit'.$username.'"></label>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary" id="editadmin'.$username.'" disabled><i class="ti-save"></i> Save</button>
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
        $('#listadmin').DataTable();
    } );
</script>