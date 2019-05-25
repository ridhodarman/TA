<div style="text-align: center; padding-top: 3%; padding-bottom:3%">
<button class="btn btn-default btn-lg" style="width: 90%; background-color: #fafafa" data-toggle="modal" data-target="#tambahkampung">+
    Add Village Data</button>
</div>

<div class="modal fade" id="tambahkampung">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Village Data</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form method="post" id="form-tambahkampung">
            <div class="modal-body">
                <p>Village Name:</p>
                <input type="text" class="form-control" name="kampung2" id="kampung2" placeholder="enter the name of village...">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="tambahkankampung">+ Add</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="panel-body" style="padding-top: 2%; padding-left: 2%; padding-right: 2%" id="tabel-kampung">
    <h4 style="text-align: center;">Village List</h4>
   
        <table width="100%" class="table table-striped table-bordered table-hover" id="listkampung">
            <thead>
                <tr style="text-align: center">
                    <th>No.</th>
                    <th>Village Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody  id="tabel-jenis-umkm">
                <?php
                    $sql=pg_query("SELECT * FROM village ORDER BY village_name ASC");
                    $no=1;
                    while ($data=pg_fetch_assoc($sql)) {
                        $id=$data['village_id'];
                        $id_enc= "'".base64_encode($id)."'";
                        $namakampung=$data['village_name'];
                        echo "<tr>";
                        echo "<td>".$no."</td>";
                        echo "<td>".$namakampung."</td>";
                        echo '<td>
                            <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#edit-kampung'.$id.'"><i class="fa fa-edit"></i> Edit</button>
                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete-kampung'.$id.'"><i class="fa fa-trash"></i> Delete</button>
                            </td>';
                        echo "</tr>";

                        echo '
                        	<div class="modal fade" id="delete-kampung'.$id.'">
    						    <div class="modal-dialog">
    						        <div class="modal-content">
    						            <div class="modal-header">
    						                <h5 class="modal-title">Delete '.$namakampung.' ?</h5>
    						                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
    						            </div>
    						            <div class="modal-body">
    						                <p>Are you sure to delete "'.$namakampung.'" from the village list? <br/>
    						                There are as many as <b>-</b> head(s) of family(ies) who have this village.
    						                </p>
    						            </div>
    						            <div class="modal-footer">
    						                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
    						                <button type="button" class="btn btn-danger" onclick="hapuskampung('.$id_enc.','.$id.')">Delete</button>
    						            </div>
    						        </div>
    						    </div>
    						</div>


                            <div class="modal fade" id="edit-kampung'.$id.'">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <form method="post" id="form-editkampung">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Village Name:</p>
                                                <input type="text" class="form-control" id="kampung-edit'.$id.'" placeholder="enter the name of village..." value="'.$namakampung.'">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary" onclick="editkampung('.$id.')"><i class="ti-save"></i> Save</button>
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
        $("#tambahkankampung").click(function(){
            var kampung = document.getElementById('kampung2').value;
            if (kampung==null || kampung=='') {
                $('#datakosong').modal('show');
            }
            else {
                var data = $('#form-tambahkampung').serialize();
                $.ajax({
                    type: 'POST',
                    url: "act/tambah-kampung.php",
                    data: data,
                    success: function() {
                        $('#tabel-kampung').load("inc/load-kampung.php");
                        $('#tambahkampung').modal('hide');
                        $('#sukses-tambah').modal('show');
                        document.getElementById('kampung2').value=null;
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
    function hapuskampung(id, idtemp) {
        $.ajax({ 
            url: 'act/hapus-kampung.php?id='+id,
            data: "",
            success: function() {
                $('#tabel-kampung').load("inc/load-kampung.php");
                $('#sukses-hapus').modal('show');
                $('#delete-kampung'+idtemp).modal('hide');
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
    function editkampung(id) {
        var kampung_edit = document.getElementById('kampung-edit'+id).value;
            if (kampung_edit==null || kampung_edit=='') {
                $('#datakosong').modal('show');
            }
            else {
                $.ajax({
                    url: "act/edit-kampung.php?id="+id+"&kampung-edit="+kampung_edit,
                    data: "",
                    success: function() {
                        $('#tabel-kampung').load("inc/load-kampung.php");
                        $('#edit-kampung'+id).modal('hide');
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
            $('#listkampung').DataTable();
    } );
</script>