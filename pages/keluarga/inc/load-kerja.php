<?php
    session_start();
    if(is_null($_SESSION['username'])){
        echo '<script>window.location="../../../assets/403"</script>';
    }
    include ('../../../inc/koneksi.php');
?>
    <h4 style="text-align: center;">Job List</h4>
   
        <table width="100%" class="table table-striped table-bordered table-hover" id="listkerja">
            <thead>
                <tr style="text-align: center">
                    <th>No.</th>
                    <th>Job Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody  id="tabel-jenis-umkm">
                <?php
                    $sql=pg_query("SELECT * FROM job ORDER BY job_name ASC");
                    $no=1;
                    while ($data=pg_fetch_assoc($sql)) {
                        $id=$data['job_id'];
                        $id_enc= "'".base64_encode($id)."'";
                        $pekerjaan=$data['job_name'];
                        echo "<tr>";
                        echo "<td>".$no."</td>";
                        echo "<td>".$pekerjaan."</td>";
                        echo '<td>
                            <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#edit-kj'.$id.'"><i class="fa fa-edit"></i> Edit</button>
                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete-kj'.$id.'"><i class="fa fa-trash"></i> Delete</button>
                            </td>';
                        echo "</tr>";

                        echo '
                            <div class="modal fade" id="delete-kj'.$id.'">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete '.$pekerjaan.' ?</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure to delete "'.$pekerjaan.'" from the job list? <br/>
                                            There are as many as <b>-</b> head(s) of family(ies) who have this job.
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-danger" onclick="hapuskerja('.$id_enc.','.$id.')">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="modal fade" id="edit-kj'.$id.'">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <form method="post" id="form-editkerja">
                                            <div class="modal-body">
                                                <p>Job Name:</p>
                                                <input type="text" class="form-control" id="kerja-edit'.$id.'" placeholder="enter job name..." value="'.$pekerjaan.'">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary" onclick="editkerja('.$id.')"><i class="ti-save"></i> Save</button>
                                            </div>
                                        </form>
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
        $('#listkerja').DataTable();
    } );
</script>