<?php
    session_start();
    if(is_null($_SESSION['username'])){
        echo '<script>window.location="../../../assets/403"</script>';
    }
    include ('../../../inc/koneksi.php');
?>
    <h4 style="text-align: center;">Level of Education List</h4>
   
        <table width="100%" class="table table-striped table-bordered table-hover" id="listpendidikan">
            <thead>
                <tr style="text-align: center">
                    <th>No.</th>
                    <th>Level of Education</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody  id="tabel-jenis-umkm">
                <?php
                    $sql=pg_query("SELECT * FROM education");
                    $no=1;
                    while ($data=pg_fetch_assoc($sql)) {
                        $id=$data['education_id'];
                        $id_enc= "'".base64_encode($id)."'";
                        $edu=$data['educational_level'];
                        echo "<tr>";
                        echo "<td>".$no."</td>";
                        echo "<td>".$edu."</td>";
                        echo '<td>
                            <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#edit-pend'.$id.'"><i class="fa fa-edit"></i> Edit</button>
                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete-pend'.$id.'"><i class="fa fa-trash"></i> Delete</button>
                            </td>';
                        echo "</tr>";

                        //$ibadah=pg_num_rows(pg_query("SELECT worship_building_id FROM worship_building WHERE type_of_worship='$id'"));

                        echo '
                        	<div class="modal fade" id="delete-pend'.$id.'">
    						    <div class="modal-dialog">
    						        <div class="modal-content">
    						            <div class="modal-header">
    						                <h5 class="modal-title">Delete '.$edu.' ?</h5>
    						                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
    						            </div>
    						            <div class="modal-body">
    						                <p>Are you sure to delete "'.$edu.'" from the type of education level ? <br/>
    						                There are as many as <b>-</b> head(s) of family that have this education type.
    						                </p>
    						            </div>
    						            <div class="modal-footer">
    						                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
    						                <button type="button" class="btn btn-danger" onclick="hapuspend('.$id_enc.','.$id.')">Delete</button>
    						            </div>
    						        </div>
    						    </div>
    						</div>


                            <div class="modal fade" id="edit-pend'.$id.'">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <form method="post" id="form-editpend">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Type of Education Level:</p>
                                                <input type="text" class="form-control" id="pend-edit'.$id.'" placeholder="enter the name of the education level..." value="'.$edu.'">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary" onclick="editpend('.$id.')"><i class="ti-save"></i> Save</button>
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
        $('#listpendidikan').DataTable();
    } );
</script>