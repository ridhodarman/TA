<div style="text-align: center; padding-top: 3%; padding-bottom:3%">
<button class="btn btn-default btn-lg" style="width: 90%; background-color: #fafafa" data-toggle="modal" data-target="#tambahsuku">+
    Add Tribe List </button>
</div>

<div class="modal fade" id="tambahsuku">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form method="post" id="form-tambahjenis" style="width: 90%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Tribe</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>Name of Tribe:</p>
                    <input type="text" class="form-control" name="fasilitas" id="fasilitas" placeholder="Enter tribal name...">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="tambahkanfas">+ Add</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="panel-body" style="padding-top: 2%; padding-left: 2%; padding-right: 2%">
    <h4 style="text-align: center;">Tribe List</h4>
   
        <table width="100%" class="table table-striped table-bordered table-hover" id="listsuku">
            <thead>
                <tr style="text-align: center">
                    <th>No.</th>
                    <th>Name of Tribe</th>
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
                            <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#edit-suku'.$id.'"><i class="fa fa-edit"></i> Edit</button>
                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete-suku'.$id.'"><i class="fa fa-trash"></i> Delete</button>
                            </td>';
                        echo "</tr>";

                        echo '
                        	<div class="modal fade" id="delete-suku'.$id.'">
    						    <div class="modal-dialog">
    						        <div class="modal-content">
    						            <div class="modal-header">
    						                <h5 class="modal-title">Delete '.$jenis.' ?</h5>
    						                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
    						            </div>
    						            <div class="modal-body">
    						                <p>Are you sure to delete "'.$jenis.'" from tribe list ? <br/>
    						                There are as many as <b>100</b> datuk that have this tribe.
    						                </p>
    						            </div>
    						            <div class="modal-footer">
    						                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
    						                <button type="button" class="btn btn-danger">Delete</button>
    						            </div>
    						        </div>
    						    </div>
    						</div>

                            <div class="modal fade" id="edit-suku'.$id.'">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <form method="post" id="form-editjenis">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Name of Tribe:</p>
                                                <input type="text" class="form-control" name="e-jenis" id="jenis" placeholder="Enter tribal name..." value="'.$jenis.'">
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

<script type="text/javascript">
    $(document).ready(function(){
        $(".tambahjenis").click(function(){
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
                        window.location.href="#listjenis";
                        alert("Successfully added data");
                    }
                });
            }
        });
    });

    $(document).ready(function() {
        $('#listsuku').DataTable();
    } );
</script>