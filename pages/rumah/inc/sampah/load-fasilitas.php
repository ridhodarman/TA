<?php
    session_start();
    if(is_null($_SESSION['username'])){
        echo '<script>window.location="../../../assets/403"</script>';
    }
?>
<h4 style="text-align: center;">List of Worship Facilities</h4>

    <table width="100%" class="table table-striped table-bordered table-hover" id="listfasilitas">
        <thead>
            <tr style="text-align: center">
                <th>No.</th>
                <th>Worship Facilities</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                include ('../../../inc/koneksi.php');
                $sql=pg_query("SELECT * FROM worship_building_facilities ORDER BY name_of_facility ASC");
                $no=1;
                while ($data=pg_fetch_assoc($sql)) {
                    $id=$data['facility_id'];                    
                    $id_enc= "'".base64_encode($id)."'";
                    $fas=$data['name_of_facility'];
                    echo "<tr>";
                    echo "<td>".$no."</td>";
                    echo "<td>".$fas."</td>";
                    echo '<td>
                        <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#edit-fas'.$id.'"><i class="fa fa-edit"></i> Edit</button>
                        <button class="btn btn-danger btn-xs" title="Hapus" data-toggle="modal" data-target="#deletefas-'.$id.'"><i class="fa fa-trash"></i> Delete</button>
                        </td>';
                    echo "</tr>";

                    $fas_ibadah=pg_num_rows(pg_query("SELECT worship_building_id FROM detail_worship_building_facilities WHERE facility_id='$id'"));

                    echo '
                        <div class="modal fade" id="deletefas-'.$id.'">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete '.$fas.' ?</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure to delete "'.$fas.'" from  the worship facility data ? <br/>
                                        There are as many as <b> '.$fas_ibadah.' </b> worship building(s) that have this facility.
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-danger" onclick="hapusfas('.$id_enc.','.$id.')">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="modal fade" id="edit-fas'.$id.'">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                            <form method="post" id="form-editfas">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Worship Facilities:</p>
                                        <input type="text" class="form-control" name="fas-edit" id="fas-edit'.$id.'" placeholder="Enter the name of the worship facility..." value="'.$fas.'">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="editfas('.$id.')"><i class="ti-save"></i> Save</button>
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
        $('#listfasilitas').DataTable();
    } );
</script>