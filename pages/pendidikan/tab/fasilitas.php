<div style="text-align: center; padding-top: 3%; padding-bottom:3%">
<button class="btn btn-default btn-lg" style="width: 90%; background-color: #fafafa" data-toggle="modal" data-target="#tambahfasilitas">+
    Add Educational Facilities</button>
</div>

<div class="modal fade" id="tambahfasilitas">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" id="form-tambahfas">
                <div class="modal-header">
                    <h5 class="modal-title">Add Educational Facilities</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>Name of Educational Facility:</p>
                    <input type="text" class="form-control" name="fasilitas" id="fasilitas" placeholder="Enter the name of the educational facility...">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="tambahkanfas">+ Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="panel-body" style="padding-top: 2%; padding-left: 2%; padding-right: 2%" id="tabel-fasilitas">
    <h4 style="text-align: center;">List of Educational Facilities</h4>
   
        <table width="100%" class="table table-striped table-bordered table-hover" id="listfasilitas">
            <thead>
                <tr style="text-align: center">
                    <th>No.</th>
                    <th>Educational Facilities</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql=pg_query("SELECT * FROM educational_building_facilities ORDER BY name_of_facility ASC");
                    $no=1;
                    while ($data=pg_fetch_assoc($sql)) {
                        $id=$data['facility_id'];
                        $id_enc= "'".base64_encode($id)."'";
                        $fas=$data['name_of_facility'];
                        $ids="'".$id."'";
                        echo "<tr>";
                        echo "<td>".$no."</td>";
                        echo "<td>".$fas."</td>";
                        echo '<td>
                            <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#edit-fas'.$id.'"><i class="fa fa-edit"></i> Edit</button>
                            <button class="btn btn-danger btn-xs" title="Hapus" data-toggle="modal" data-target="#deletefas-'.$id.'"><i class="fa fa-trash"></i> Delete</button>
                            </td>';
                        echo "</tr>";

                        $fas_pen=pg_num_rows(pg_query("SELECT educational_building_id FROM detail_educational_building_facilities WHERE facility_id='$id'"));

                        echo '
                        	<div class="modal fade" id="deletefas-'.$id.'">
    						    <div class="modal-dialog">
    						        <div class="modal-content">
    						            <div class="modal-header">
    						                <h5 class="modal-title">Delete '.$fas.' ?</h5>
    						                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
    						            </div>
    						            <div class="modal-body">
                                            <p>Are you sure to delete "'.$fas.'" from  the education facility data ? <br/>
                                            There are as many as <b> '.$fas_pen.' </b> educational buildings that have this facility.
    						                </p>
    						            </div>
    						            <div class="modal-footer">
    						                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
    						                <button type="button" class="btn btn-danger" onclick="hapusfas('.$id_enc.','.$ids.')">Delete</button>
    						            </div>
    						        </div>
    						    </div>
    						</div>


                            <div class="modal fade" id="edit-fas'.$id.'">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                <form method="post" id="form-editfas">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Name of Educational Facility:</p>
                                            <input type="text" class="form-control" name="fasilitas" id="fas-edit'.$id.'" placeholder="Enter the name of the educational facility..." value="'.$fas.'">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" onclick="editfas('.$ids.')"><i class="ti-save"></i> Save</button>
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
        $("#tambahkanfas").click(function(){ 
            var fasilitas = document.getElementById('fasilitas').value;
            if (fasilitas==null || fasilitas=='') {
                $('#datakosong').modal('show');
            }
            else {
                var data = $('#form-tambahfas').serialize();
                $.ajax({
                    type: 'POST',
                    url: "act/tambah-fasilitas.php",
                    data: data,
                    success: function() {
                        $('#tabel-fasilitas').load("inc/load-fasilitas.php");
                        $('#tambahfasilitas').modal('hide');
                        $('#sukses-tambah').modal('show');
                        document.getElementById('fasilitas').value=null;
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
    function hapusfas(id, idtemp) {
        $.ajax({ 
            url: 'act/hapus-fasilitas.php?id="'+id+'"',
            data: "",
            success: function() {
                $('#tabel-fasilitas').load("inc/load-fasilitas.php");
                $('#sukses-hapus').modal('show');
                $('#deletefas-'+idtemp).modal('hide');
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
    function editfas(id) {
        var fas_edit = document.getElementById('fas-edit'+id).value;
            if (fas_edit==null || fas_edit=='') {
                $('#datakosong').modal('show');
            }
            else {
                var data = $('#form-editfas'+id).serialize();
                $.ajax({
                    url: "act/edit-fasilitas.php?id="+id+"&fas="+fas_edit,
                    data: "",
                    success: function() {
                        $('#tabel-fasilitas').load("inc/load-fasilitas.php");
                        $('#edit-fas'+id).modal('hide');
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
            $('#listfasilitas').DataTable();
    } );
</script>