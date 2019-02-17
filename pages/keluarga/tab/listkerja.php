<div style="text-align: center; padding-top: 3%; padding-bottom:3%">
<button class="btn btn-default btn-lg" style="width: 90%; background-color: #fafafa" data-toggle="modal" data-target="#tambahkerja">+
    Add Job List</button>
</div>

<div class="modal fade" id="tambahkerja">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form method="post" id="form-tambahjenis" style="width: 90%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Job List</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>Job Name:</p>
                    <input type="text" class="form-control" name="jenis" id="jenis" placeholder="enter job name...">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="tambahkanj">+ Add</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="panel-body" style="padding-top: 2%; padding-left: 2%; padding-right: 2%">
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
                    $sql=pg_query("SELECT * FROM type_of_msme ORDER BY name_of_type ASC");
                    $no=1;
                    while ($data=pg_fetch_assoc($sql)) {
                        $id=$data['type_id'];
                        $jenis=$data['name_of_type'];
                        echo "<tr>";
                        echo "<td>".$no."</td>";
                        echo "<td>".$jenis."</td>";
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
    						                <h5 class="modal-title">Delete '.$jenis.' ?</h5>
    						                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
    						            </div>
    						            <div class="modal-body">
    						                <p>Are you sure to delete "'.$jenis.'" from the job list? <br/>
    						                There are as many as <b>100</b> head(s) of family(ies) who have this job.
    						                </p>
    						            </div>
    						            <div class="modal-footer">
    						                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
    						                <button type="button" class="btn btn-danger">Delete</button>
    						            </div>
    						        </div>
    						    </div>
    						</div>


                            <div class="modal fade" id="edit-kj'.$id.'">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <form method="post" id="form-editjenis">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Job Name:</p>
                                                <input type="text" class="form-control" name="e-jenis" id="jenis" placeholder="enter job name..." value="'.$jenis.'">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary" id="tambahkanj"><i class="ti-save"></i> Save</button>
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
</div>

<div class="modal fade" id="suksestambahjenis">
    <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <center>
                        <div>
                            <p style="font-size: 400%; color: green"><i class="ti-check"></i></p>
                            <p>Successfully added the MSME type</p>
                        </div>
                        <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
                    </center>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#tambahkanj").click(function(){
            var jenis = document.getElementById('jenis').value;
            if (jenis==null || jenis=='') {
                alert("Enter the type name that will be added first!")
            }
            else {
                var data = $('#form-tambahjenis').serialize();
                $.ajax({
                    type: 'POST',
                    url: "act/tambahjenis.php",
                    data: data,
                    success: function() {
                        $('#tabel-jenis-umkm').load("inc/load-jenisumkm.php");
                        $('#tambahjenis').modal('hide');
                        $('#suksestambahjenis').modal('show');
                        document.getElementById('jenis').value=null;
                    }
                });
            }
        });
    });


    $(document).ready(function() {
            $('#listkerja').DataTable();
    } );
</script>