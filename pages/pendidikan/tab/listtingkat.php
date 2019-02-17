<div style="text-align: center; padding-top: 3%; padding-bottom:3%">
<button class="btn btn-default btn-lg" style="width: 90%; background-color: #fafafa" data-toggle="modal" data-target="#tambahtingkat">+
    Add Level of Education </button>
</div>

<div class="modal fade" id="tambahtingkat">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" id="form-tambahtingkat">
                <div class="modal-header">
                    <h5 class="modal-title">Add Level of Education</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>Level of Education:</p>
                    <input type="text" class="form-control" name="tingkat" id="tingkat" placeholder="Enter the name of the education level...">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="tambahkant">+ Add</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="panel-body" style="padding-top: 2%; padding-left: 2%; padding-right: 2%" id="tabel-tingkat">
    <h4 style="text-align: center;">List of Education Levels</h4>
   
        <table width="100%" class="table table-striped table-bordered table-hover" id="listtingkat">
            <thead>
                <tr style="text-align: center">
                    <th>No.</th>
                    <th>Level of Education</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql=pg_query("SELECT level_id, name_of_level FROM level_of_education ORDER BY name_of_level ASC");
                    $no=1;
                    while ($data=pg_fetch_assoc($sql)) {
                        $id=$data['level_id'];
                        $id_enc= "'".base64_encode($id)."'";
                        $tingkat=$data['name_of_level'];
                        echo "<tr>";
                        echo "<td>".$no."</td>";
                        echo "<td>".$tingkat."</td>";
                        echo '<td>
                            <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#edit-t'.$id.'"><i class="fa fa-edit"></i> Edit</button>
                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete-t'.$id.'"><i class="fa fa-trash"></i> Delete</button>
                            </td>';
                        echo "</tr>";

                        $pen=pg_num_rows(pg_query("SELECT educational_building_id FROM educational_building WHERE id_level_of_education='$id'"));

                        echo '
                        	<div class="modal fade" id="delete-t'.$id.'">
    						    <div class="modal-dialog">
    						        <div class="modal-content">
    						            <div class="modal-header">
    						                <h5 class="modal-title">Delete '.$tingkat.' ?</h5>
    						                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
    						            </div>
    						            <div class="modal-body">
    						                <p>Are you sure to delete "'.$tingkat.'" from the level of education ? <br/>
    						                There are as many as <b>'.$pen.'</b> education building(s) that have this level.
    						                </p>
    						            </div>
    						            <div class="modal-footer">
    						                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
    						                <button type="button" class="btn btn-danger" onclick="hapustingkat('.$id_enc.','.$id.')">Delete</button>
    						            </div>
    						        </div>
    						    </div>
    						</div>


                            <div class="modal fade" id="edit-t'.$id.'">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <form method="post" id="form-edittingkat">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Level of Education:</p>
                                                <input type="text" class="form-control" name="tingkat-edit" id="tingkat-edit'.$id.'" placeholder="Enter the name of the education level..." value="'.$tingkat.'">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary" onclick="edittingkat('.$id.')"><i class="ti-save"></i> Save</button>
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
        $("#tambahkant").click(function(){ 
            var tingkat = document.getElementById('tingkat').value;
            if (tingkat==null || tingkat=='') {
                $('#datakosong').modal('show');
            }
            else {
                var data = $('#form-tambahtingkat').serialize();
                $.ajax({
                    type: 'POST',
                    url: "act/tambah-tingkat.php",
                    data: data,
                    success: function() {
                        $('#tabel-tingkat').load("inc/load-tingkat.php");
                        $('#tambahtingkat').modal('hide');
                        $('#sukses-tambah').modal('show');
                        document.getElementById('tingkat').value=null;
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
    function hapustingkat(id, idtemp) {
        $.ajax({ 
            url: 'act/hapus-tingkat.php?id='+id,
            data: "",
            success: function() {
                $('#tabel-tingkat').load("inc/load-tingkat.php");
                $('#sukses-hapus').modal('show');
                $('#delete-t'+idtemp).modal('hide');
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
    function edittingkat(id) {
        var tingkat_edit = document.getElementById('tingkat-edit'+id).value;
            if (tingkat_edit==null || tingkat_edit=='') {
                $('#datakosong').modal('show');
            }
            else {
                var data = $('#form-edittingkat'+id).serialize();
                $.ajax({
                    url: "act/edit-tingkat.php?id="+id+"&tingkat-edit="+tingkat_edit,
                    data: "",
                    success: function() {
                        $('#tabel-tingkat').load("inc/load-tingkat.php");
                        $('#edit-t'+id).modal('hide');
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
            $('#listtingkat').DataTable();
    } );
</script>