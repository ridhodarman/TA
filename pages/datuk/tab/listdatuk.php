<div style="text-align: center; padding-top: 3%; padding-bottom:3%">
<button class="btn btn-default btn-lg" style="width: 90%; background-color: #fafafa" data-toggle="modal" data-target="#tambahdatuk">+
    Add Datuk List</button>
</div>

<div class="modal fade" id="tambahdatuk">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Datuk</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form role="form" action="act/tambahrumah.php" enctype="multipart/form-data" method="post"></form>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name of Datuk:</label>
                        <input type="text" class="form-control" name="id" value="" required>
                    </div>
                    <div class="form-group">
                        <label>Tribe:</label>
                        <select class="form-control" name="suku" value="" required>
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">+ Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="panel-body" style="padding-top: 2%; padding-left: 2%; padding-right: 2%">
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
                $sql=pg_query("SELECT * FROM msme_building");
                while ($data=pg_fetch_assoc($sql)) {
                    $id=$data['msme_building_id'];
                    echo "<tr>";
                    echo "<td>".$no."</td>";
                    echo "<td>".$data['name_of_msme_building']."</td>";
                    echo "<td>".$data['type_of_msme']."</td>";
                    echo '<td>
                            <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#edit-datuk'.$id.'"><i class="fa fa-edit"></i> Edit</button>
                            <button class="btn btn-danger btn-xs" title="Hapus" data-toggle="modal" data-target="#delete-datuk'.$id.'"><i class="fa fa-trash"></i> Delete</button>
                          </td>';
                    echo "</tr>";
                    echo '
                            <div class="modal fade" id="delete-datuk'.$id.'">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete '.$jenis.' ?</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure to delete "'.$jenis.'" from data of datuk list ? <br/>
                                            There are as many as <b> 100 </b> families that have this datuk.
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-danger">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="modal fade" id="edit-datuk'.$id.'">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                <form method="post" id="form-tambahjenis">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Name of Datuk:</label>
                                                <input type="text" class="form-control" name="id" value="'.$datuk.'" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Tribe:</label>
                                                <select class="form-control" name="suku" value="'.$suku.'" required>
                                                    <option></option>
                                                </select>
                                            </div>
                                            <input type="hidden" class="form-control" name="id" value="'.$id.'" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="tambahkanfas"><i class="ti-save"></i> Save</button>
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

<div class="modal fade" id="tambahdatuk">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Datuk</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form role="form" action="act/tambahrumah.php" enctype="multipart/form-data" method="post"></form>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name of Datuk:</label>
                        <input type="text" class="form-control" name="id" value="" required>
                    </div>
                    <div class="form-group">
                        <label>Tribe:</label>
                        <select class="form-control" name="suku" value="" required>
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">+ Add</button>
                </div>
            </form>
        </div>
    </div>
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
        $('#listdatuk').DataTable();
    } );
</script>