<div style="text-align: center; padding-top: 3%; padding-bottom:3%">
<button class="btn btn-default btn-lg" style="width: 90%; background-color: #fafafa" data-toggle="modal" data-target="#tambahsuku">+
    Add Tribe Data </button>
</div>

<div class="modal fade" id="tambahsuku">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" id="form-tambahsuku">
                <div class="modal-header">
                    <h5 class="modal-title">Add Tribe</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>Name of Tribe:</p>
                    <input type="text" class="form-control" name="suku" id="suku" placeholder="Enter tribal name...">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="tambahkansuku">+ Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="panel-body" style="padding-top: 2%; padding-left: 2%; padding-right: 2%" id="tabel-suku">
    <h4 style="text-align: center;">Tribe List</h4>
   
        <table width="100%" class="table table-striped table-bordered table-hover" id="listsuku">
            <thead>
                <tr style="text-align: center">
                    <th>No.</th>
                    <th>Name of Tribe</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql=pg_query("SELECT * FROM tribe ORDER BY name_of_tribe ASC");
                    $no=1;
                    while ($data=pg_fetch_assoc($sql)) {
                        $id=$data['tribe_id'];
                        $id_enc= "'".base64_encode($id)."'";
                        $suku=$data['name_of_tribe'];
                        echo "<tr>";
                        echo "<td>".$no."</td>";
                        echo "<td>".$suku."</td>";
                        echo '<td>
                            <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#edit-suku'.$id.'"><i class="fa fa-edit"></i> Edit</button>
                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete-suku'.$id.'"><i class="fa fa-trash"></i> Delete</button>
                            </td>';
                        echo "</tr>";

                        $j_datuk=pg_num_rows(pg_query("SELECT datuk_id FROM datuk WHERE tribe_id='$id'"));

                        echo '
                        	<div class="modal fade" id="delete-suku'.$id.'">
    						    <div class="modal-dialog">
    						        <div class="modal-content">
    						            <div class="modal-header">
    						                <h5 class="modal-title">Delete '.$suku.' ?</h5>
    						                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
    						            </div>
    						            <div class="modal-body"><center>
    						                <p>Are you sure to delete "'.$suku.'" from tribe list ? <br/>
    						                There are as many as <b>'.$j_datuk.'</b> datuk that have this tribe.
    						                </center>
    						            </div>
    						            <div class="modal-footer">
    						                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
    						                <button type="button" class="btn btn-danger" onclick="hapussuku('.$id_enc.','.$id.')">Delete</button>
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
                                                <input type="text" class="form-control" id="suku-edit'.$id.'" placeholder="Enter tribal name..." value="'.$suku.'">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary" onclick="editsuku('.$id.')""><i class="ti-save"></i> Save</button>
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
        $("#tambahkansuku").click(function(){ 
            var suku = document.getElementById('suku').value;
            if (suku==null || suku=='') {
                $('#datakosong').modal('show');
            }
            else {
                var data = $('#form-tambahsuku').serialize();
                $.ajax({
                    type: 'POST',
                    url: "act/tambah-suku.php",
                    data: data,
                    success: function() {
                        $('#tabel-suku').load("inc/load-suku.php");
                        $('#tambahsuku').modal('hide');
                        $('#sukses-tambah').modal('show');
                        document.getElementById('suku').value=null;
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
    function hapussuku(id, idtemp) {
        $.ajax({ 
            url: 'act/hapus-suku.php?id='+id,
            data: "",
            success: function() {
                $('#tabel-suku').load("inc/load-suku.php");
                $('#sukses-hapus').modal('show');
                $('#delete-suku'+idtemp).modal('hide');
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
    function editsuku(id) {
        var suku_edit = document.getElementById('suku-edit'+id).value;
            if (suku_edit==null || suku_edit=='') {
                $('#datakosong').modal('show');
            }
            else {
                var data = $('#form-editjenis'+id).serialize();
                $.ajax({
                    url: "act/edit-suku.php?id="+id+"&suku-edit="+suku_edit,
                    data: "",
                    success: function() {
                        $('#tabel-suku').load("inc/load-suku.php");
                        $('#edit-suku'+id).modal('hide');
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
            $('#listsuku').DataTable();
    } );
</script>