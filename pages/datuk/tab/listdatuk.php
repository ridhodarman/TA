<div style="text-align: center; padding-top: 3%; padding-bottom:3%">
<button class="btn btn-default btn-lg" style="width: 90%; background-color: #fafafa" onclick="load()" data-toggle="modal" data-target="#tambahdatuk">+
    Add Datuk Data</button>
</div>

<div class="modal fade" id="tambahdatuk">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Datuk</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form method="post" id="form-tambahdatuk">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name of Datuk:</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="" required>
                    </div>
                    <div class="form-group" id="sukunya">
                        <label>Tribe:</label>
                        <select class="form-control" name="suku" id="daftarsuku" required style="height: 45px">
                            <?php                
                                $sql_suku=pg_query("SELECT * FROM tribe ORDER BY name_of_tribe");
                                while($row = pg_fetch_assoc($sql_suku))
                                {
                                    echo"<option value=".$row['tribe_id'].">".$row['name_of_tribe']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="tambahkandatuk">+ Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="panel-body" style="padding-top: 2%; padding-left: 2%; padding-right: 2%" id="tabel-datuk">
    <h4 style="text-align: center;">Datuk List</h4>
    <table width="100%" class="table table-striped table-bordered table-hover" id="listdatuk">
        <thead>
            <tr style="text-align: center">
                <th>No.</th>
                <th>Name of Datuk</th>
                <th>Tribe</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no=1;
                $sql=pg_query("SELECT D.datuk_id, D.datuk_name, D.tribe_id, T.name_of_tribe 
                                FROM datuk AS D
                                JOIN tribe AS T ON D.tribe_id=T.tribe_id
                                ORDER BY datuk_name
                            ");
                while ($data=pg_fetch_assoc($sql)) {
                    $id=$data['datuk_id'];
                    $id_enc= "'".base64_encode($id)."'";
                    $id_suku=$data['D.tribe_id'];
                    $nama=$data['datuk_name'];
                    $ids="'".$id."'";
                    echo "<tr>";
                    echo "<td>".$no."</td>";
                    echo "<td>".$nama."</td>";
                    echo "<td>".$data['name_of_tribe']."</td>";
                    echo '<td>
                            <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#edit-datuk'.$id.'"><i class="fa fa-edit"></i> Edit</button>
                            <button class="btn btn-danger btn-xs" title="Hapus" data-toggle="modal" data-target="#delete-datuk'.$id.'"><i class="fa fa-trash"></i> Delete</button>
                          </td>';
                    echo "</tr>";

                    //$j_datuk=pg_num_rows(pg_query("SELECT datuk_id FROM datuk WHERE tribe_id='$id'"));

                    echo '
                            <div class="modal fade" id="delete-datuk'.$id.'">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete '.$nama.' ?</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <center><p>Are you sure to delete "'.$nama.'" from data of datuk list ? <br/>
                                            There are as many as <b> - </b> families that have this datuk.
                                            </p></center>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-danger" onclick="hapusdatuk('.$id_enc.','.$ids.')">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="modal fade" id="edit-datuk'.$id.'">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                <form method="post" id="form-editdatuk">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Name of Datuk:</label>
                                                <input type="text" class="form-control" id="edit-nama'.$id.'" value="'.$nama.'" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Tribe:</label>
                                                <select class="form-control" id="edit-suku'.$id.'" value="'.$suku.'" required style="height: 45px">
                                                <option></option>';
                                                $sql_suku=pg_query("SELECT * FROM tribe ORDER BY name_of_tribe");
                                                while($row = pg_fetch_assoc($sql_suku))
                                                {
                                                    echo"<option value=".$row['tribe_id'].">".$row['name_of_tribe']."</option>";
                                                }
                            
                            echo '
                                                </select>
                                            </div>
                                            <input type="hidden" class="form-control" name="id" value="'.$id.'" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-primary" onclick="editdatuk('.$ids.')""><i class="ti-save"></i> Save</button>
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
     //$("#daftarsuku").clone().prependTo("[name='daftarsuku2']").show()

    //tambah data
    $(document).ready(function(){
        $("#tambahkandatuk").click(function(){ 
            var nama = document.getElementById('nama').value;
            if (nama==null || nama=='') {
                $('#datakosong').modal('show');
            }
            else {
                var data = $('#form-tambahdatuk').serialize();
                $.ajax({
                    type: 'POST',
                    url: "act/tambah-datuk.php",
                    data: data,
                    success: function() {
                        $('#tabel-datuk').load("inc/load-datuk.php");
                        $('#tambahdatuk').modal('hide');
                        $('#sukses-tambah').modal('show');
                        document.getElementById('nama').value=null;
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
    function hapusdatuk(id, idtemp) {
        $.ajax({ 
            url: 'act/hapus-datuk.php?id='+id,
            data: "",
            success: function() {
                $('#tabel-datuk').load("inc/load-datuk.php");
                $('#sukses-hapus').modal('show');
                $('#delete-datuk'+idtemp).modal('hide');
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
    function editdatuk(id) {
         $("#daftarsuku").clone().prependTo("#edit-suku"+id);
        var edit_nama = document.getElementById('edit-nama'+id).value;
        var edit_suku = document.getElementById('edit-suku'+id).value;
            if (edit_nama==null || edit_nama=='' || edit_suku==null || edit_suku=='') {
                $('#datakosong').modal('show');
            }
            else {
                var data = $('#form-editdatuk'+id).serialize();
                $.ajax({
                    url: "act/edit-datuk.php?id="+id+"&nama="+edit_nama+"&suku="+edit_suku,
                    data: "",
                    success: function() {
                        $('#tabel-datuk').load("inc/load-datuk.php");
                        $('#edit-datuk'+id).modal('hide');
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

    function load() {
        $('#sukunya').load("inc/combobox-suku.php");
    }

    $(document).ready(function() {
            $('#listdatuk').DataTable();
    } );
</script>