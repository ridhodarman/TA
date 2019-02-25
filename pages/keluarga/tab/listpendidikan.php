<div style="text-align: center; padding-top: 3%; padding-bottom:3%">
<button class="btn btn-default btn-lg" style="width: 90%; background-color: #fafafa" data-toggle="modal" data-target="#tambahpend">+
    Add the type of education level</button>
</div>

<div class="modal fade" id="tambahpend">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add the type of education level</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form method="post" id="form-tambahpend">
            <div class="modal-body">
                <p>Type of Education Level:</p>
                <input type="text" class="form-control" name="pend" id="pend" placeholder="enter the name of the education level...">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="tambahkanpend">+ Add</button>
            </div>
        </div>
        </form>
    </div>
</div>

<div class="panel-body" style="padding-top: 2%; padding-left: 2%; padding-right: 2%" id="tabel-pendidikan">
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

    //tambah data
    $(document).ready(function(){
        $("#tambahkanpend").click(function(){
            var pend = document.getElementById('pend').value;
            if (pend==null || pend=='') {
                $('#datakosong').modal('show');
            }
            else {
                var data = $('#form-tambahpend').serialize();
                $.ajax({
                    type: 'POST',
                    url: "act/tambah-pend.php",
                    data: data,
                    success: function() {
                        $('#tabel-pendidikan').load("inc/load-pend.php");
                        $('#tambahpend').modal('hide');
                        $('#sukses-tambah').modal('show');
                        document.getElementById('pend').value=null;
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
    function hapuspend(id, idtemp) {
        $.ajax({ 
            url: 'act/hapus-pend.php?id='+id,
            data: "",
            success: function() {
                $('#tabel-pendidikan').load("inc/load-pend.php");
                $('#sukses-hapus').modal('show');
                $('#delete-pend'+idtemp).modal('hide');
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
    function editpend(id) {
        var pend_edit = document.getElementById('pend-edit'+id).value;
            if (pend_edit==null || pend_edit=='') {
                $('#datakosong').modal('show');
            }
            else {
                var data = $('#form-editpend'+id).serialize();
                $.ajax({
                    url: "act/edit-pend.php?id="+id+"&pend-edit="+pend_edit,
                    data: "",
                    success: function() {
                        $('#tabel-pendidikan').load("inc/load-pend.php");
                        $('#edit-pend'+id).modal('hide');
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
            $('#listpendidikan').DataTable();
    } );
</script>