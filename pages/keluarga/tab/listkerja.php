<div style="text-align: center; padding-top: 3%; padding-bottom:3%">
<button class="btn btn-default btn-lg" style="width: 90%; background-color: #fafafa" data-toggle="modal" data-target="#tambahkerja">+
    Add Job Data</button>
</div>

<div class="modal fade" id="tambahkerja">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Job Data</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form method="post" id="form-tambahkerja">
                <div class="modal-body">
                    <p>Job Name:</p>
                    <input type="text" class="form-control" name="kerja2" id="kerja2" placeholder="enter job name...">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="tambahkankerja">+ Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="panel-body" style="padding-top: 2%; padding-left: 2%; padding-right: 2%" id="tabel-kerja">
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
                        $ids="'".$id."'";
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
    						                </p>
    						            </div>
    						            <div class="modal-footer">
    						                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
    						                <button type="button" class="btn btn-danger" onclick="hapuskerja('.$id_enc.','.$ids.')">Delete</button>
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
                                                <button type="button" class="btn btn-primary" onclick="editkerja('.$ids.')"><i class="ti-save"></i> Save</button>
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
        $("#tambahkankerja").click(function(){
            var kerja = document.getElementById('kerja2').value;
            if (kerja==null || kerja=='') {
                $('#datakosong').modal('show');
            }
            else {
                var data = $('#form-tambahkerja').serialize();
                $.ajax({
                    type: 'POST',
                    url: "act/tambah-kerja.php",
                    data: data,
                    success: function() {
                        $('#tabel-kerja').load("inc/load-kerja.php");
                        $('#tambahkerja').modal('hide');
                        $('#sukses-tambah').modal('show');
                        document.getElementById('kerja2').value=null;
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
    function hapuskerja(id, idtemp) {
        $.ajax({ 
            url: 'act/hapus-kerja.php?id='+id,
            data: "",
            success: function() {
                $('#tabel-kerja').load("inc/load-kerja.php");
                $('#delete-kj'+idtemp).modal('hide');
                $('#sukses-hapus').modal('show');
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
    function editkerja(id) {
        var kerja_edit = document.getElementById('kerja-edit'+id).value;
            if (kerja_edit==null || kerja_edit=='') {
                $('#datakosong').modal('show');
            }
            else {
                var data = $('#form-editkerja'+id).serialize();
                $.ajax({
                    url: "act/edit-kerja.php?id="+id+"&kerja-edit="+kerja_edit,
                    data: "",
                    success: function() {
                        $('#tabel-kerja').load("inc/load-kerja.php");
                        $('#edit-kj'+id).modal('hide');
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
            $('#listkerja').DataTable();
    } );
</script>