<div style="text-align: center; padding-top: 3%; padding-bottom:3%">
<button class="btn btn-default btn-lg" style="width: 90%; background-color: #fafafa" data-toggle="modal" data-target="#tambahjenis">+
    Add Health Building Type </button>
</div>

<div class="modal fade" id="tambahjenis">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Health Building Type</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form method="post" id="form-tambahjenis">
                <div class="modal-body">
                    <p>Health Building Type:</p>
                    <input type="text" class="form-control" name="jenis" id="jenis" placeholder="Enter the type of health building...">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="tambahkanj">+ Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="panel-body" style="padding-top: 2%; padding-left: 2%; padding-right: 2%" id="tabel-jenis-ibadah">
    <h4 style="text-align: center;">List of Health Building Type</h4>
   
        <table width="100%" class="table table-striped table-bordered table-hover" id="listjenis">
            <thead>
                <tr style="text-align: center">
                    <th>No.</th>
                    <th>Types of Health Building</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql=pg_query("SELECT type_id, name_of_type FROM type_of_health_services ORDER BY name_of_type ASC");
                    $no=1;
                    while ($data=pg_fetch_assoc($sql)) {
                        $id=$data['type_id'];
                        $id_enc= "'".base64_encode($id)."'";
                        $jenis=$data['name_of_type'];
                        echo "<tr>";
                        echo "<td>".$no."</td>";
                        echo "<td>".$jenis."</td>";
                        echo '<td>
                            <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#edit-j'.$id.'"><i class="fa fa-edit"></i> Edit</button>
                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete-j'.$id.'"><i class="fa fa-trash"></i> Delete</button>
                            </td>';
                        echo "</tr>";

                        $kes=pg_num_rows(pg_query("SELECT health_building_id FROM health_building WHERE type_of_health_services='$id'"));

                        echo '
                        	<div class="modal fade" id="delete-j'.$id.'">
    						    <div class="modal-dialog">
    						        <div class="modal-content">
    						            <div class="modal-header">
    						                <h5 class="modal-title">Delete '.$jenis.' ?</h5>
    						                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
    						            </div>
    						            <div class="modal-body">
                                            <p>Are you sure to delete "'.$jenis.'" from the type of health building ? <br/>
                                            There are as many as <b>'.$kes.'</b> health buildings that have this type.
                                            </p>
    						            </div>
    						            <div class="modal-footer">
    						                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
    						                <button type="button" class="btn btn-danger" onclick="hapusjenis('.$id_enc.','.$id.')">Delete</button>
    						            </div>
    						        </div>
    						    </div>
    						</div>


                            <div class="modal fade" id="edit-j'.$id.'">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <form method="post" id="form-editjenis">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Health Building Type:</p>
                                                <input type="text" class="form-control" name="jenis-edit" id="jenis-edit'.$id.'" placeholder="Enter the type of health building..." value="'.$jenis.'">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary" onclick="editjenis('.$id.')"><i class="ti-save"></i> Save</button>
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

    //tambah data
    $(document).ready(function(){
        $("#tambahkanj").click(function(){ 
            var jenis = document.getElementById('jenis').value;
            if (jenis==null || jenis=='') {
                $('#datakosong').modal('show');
            }
            else {
                var data = $('#form-tambahjenis').serialize();
                $.ajax({
                    type: 'POST',
                    url: "act/tambah-jenis.php",
                    data: data,
                    success: function() {
                        $('#tabel-jenis-ibadah').load("inc/load-jenis.php");
                        $('#tambahjenis').modal('hide');
                        $('#sukses-tambah').modal('show');
                        document.getElementById('jenis').value=null;
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        $("#notifikasi").empty();
                        $('#gagal').modal('show');
                        $("#notifikasi").append("<p>"+xhr.status+"</p>");
                        $("#notifikasi").append("<p>"+thrownError+"</p>");
                    }
                });
            }
        });
    });

    //hapus data
    function hapusjenis(id, idtemp) {
        $.ajax({ 
            url: 'act/hapus-jenis.php?id='+id,
            data: "",
            success: function() {
                $('#tabel-jenis-ibadah').load("inc/load-jenis.php");
                $('#sukses-hapus').modal('show');
                $('#delete-j'+idtemp).modal('hide');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $("#notifikasi").empty();
                $('#gagal').modal('show');
                $("#notifikasi").append("<p>"+xhr.status+"</p>");
                $("#notifikasi").append("<p>"+thrownError+"</p>");
            }
        });
    }

    //edit data
    function editjenis(id) {
        var jenis_edit = document.getElementById('jenis-edit'+id).value;
            if (jenis_edit==null || jenis_edit=='') {
                $('#datakosong').modal('show');
            }
            else {
                var data = $('#form-editjenis'+id).serialize();
                $.ajax({
                    url: "act/edit-jenis.php?id="+id+"&jenis-edit="+jenis_edit,
                    data: "",
                    success: function() {
                        $('#tabel-jenis-ibadah').load("inc/load-jenis.php");
                        $('#edit-j'+id).modal('hide');
                        $('#sukses-update').modal('show');
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        $("#notifikasi").empty();
                        $('#gagal').modal('show');
                        $("#notifikasi").append("<p>"+xhr.status+"</p>");
                        $("#notifikasi").append("<p>"+thrownError+"</p>");
                    }
                });
            }
    }


    $(document).ready(function() {
            $('#listjenis').DataTable();
    } );
</script>