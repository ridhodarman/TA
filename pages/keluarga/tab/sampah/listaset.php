<div style="text-align: center; padding-top: 3%; padding-bottom:3%">
<button class="btn btn-default btn-lg" style="width: 90%; background-color: #fafafa" data-toggle="modal" data-target="#tambahaset">+
    Add Asset Data</button>
</div>

<div class="modal fade" id="tambahaset">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form method="post" id="form-tambahaset" style="width: 90%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Asset Data</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>Asset Name:</p>
                    <input type="text" class="form-control" name="aset2" id="aset2" placeholder="enter asset name...">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="tambahkanaset">+ Add</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="panel-body" style="padding-top: 2%; padding-left: 2%; padding-right: 2%" id="tabel-aset">
    <h4 style="text-align: center;">Asset List</h4>
   
        <table width="100%" class="table table-striped table-bordered table-hover" id="listaset">
            <thead>
                <tr style="text-align: center">
                    <th>No.</th>
                    <th>Asset Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody  id="tabel-jenis-umkm">
                <?php
                    $sql=pg_query("SELECT * FROM asset ORDER BY name_of_asset ASC");
                    $no=1;
                    while ($data=pg_fetch_assoc($sql)) {
                        $id=$data['asset_id'];
                        $id_enc= "'".base64_encode($id)."'";
                        $aset=$data['name_of_asset'];
                        echo "<tr>";
                        echo "<td>".$no."</td>";
                        echo "<td>".$aset."</td>";
                        echo '<td>
                            <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#edit-aset'.$id.'"><i class="fa fa-edit"></i> Edit</button>
                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete-aset'.$id.'"><i class="fa fa-trash"></i> Delete</button>
                            </td>';
                        echo "</tr>";

                        echo '
                        	<div class="modal fade" id="delete-aset'.$id.'">
    						    <div class="modal-dialog">
    						        <div class="modal-content">
    						            <div class="modal-header">
    						                <h5 class="modal-title">Delete '.$aset.' ?</h5>
    						                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
    						            </div>
    						            <div class="modal-body">
    						                <p>Are you sure to delete "'.$aset.'" from the asset list? <br/>
    						                There are as many as <b>-</b> head(s) of family(ies) who own this asset.
    						                </p>
    						            </div>
    						            <div class="modal-footer">
    						                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
    						                <button type="button" class="btn btn-danger" onclick="hapusaset('.$id_enc.','.$id.')">Delete</button>
    						            </div>
    						        </div>
    						    </div>
    						</div>


                            <div class="modal fade" id="edit-aset'.$id.'">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Asset Name:</p>
                                            <input type="text" class="form-control" id="aset-edit'.$id.'" placeholder="enter asset name..." value="'.$aset.'">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-primary" onclick="editaset('.$id.')"><i class="ti-save"></i> Save</button>
                                        </div>
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
        $("#tambahkanaset").click(function(){
            var aset = document.getElementById('aset2').value;
            if (aset==null || aset=='') {
                $('#datakosong').modal('show');
            }
            else {
                var data = $('#form-tambahaset').serialize();
                $.ajax({
                    type: 'POST',
                    url: "act/tambah-aset.php",
                    data: data,
                    success: function() {
                        $('#tabel-aset').load("inc/load-aset.php");
                        $('#tambahaset').modal('hide');
                        $('#sukses-tambah').modal('show');
                        document.getElementById('aset2').value=null;
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
    function hapusaset(id, idtemp) {
        $.ajax({ 
            url: 'act/hapus-aset.php?id='+id,
            data: "",
            success: function() {
                $('#tabel-aset').load("inc/load-aset.php");
                $('#sukses-hapus').modal('show');
                $('#delete-aset'+idtemp).modal('hide');
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
    function editaset(id) {
        var aset_edit = document.getElementById('aset-edit'+id).value;
            if (aset_edit==null || aset_edit=='') {
                $('#datakosong').modal('show');
            }
            else {
                $.ajax({
                    url: "act/edit-aset.php?id="+id+"&aset-edit="+aset_edit,
                    data: "",
                    success: function() {
                        $('#tabel-aset').load("inc/load-aset.php");
                        $('#edit-aset'+id).modal('hide');
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
            $('#listaset').DataTable();
    } );
</script>