<link rel="stylesheet" type="text/css" href="../../assets/css/dataTables.bootstrap4.min.css">

<a style="float: right; padding-right: 1%; padding-bottom: 6%; ">
<button type="button" class="btn btn-info btn-sm btn-flat btn-lg mt-3" data-toggle="modal" data-target="#editfoto"><i class="fa fa-edit"></i> Edit</button>
</a>
            <!-- Modal -->
<div class="modal fade bd-example-modal-lg modal-xl" id="editfoto">
    <div class="modal-dialog modal-lg modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Edit Photo: <?php echo $nama." (".$id.")" ?></h6>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body" style="font-size: 110%">
            <?php
                $tgl=date('Y-m-d');
                //echo date("Ymdhis");
            ?>
                <form action="act/info-tambahfoto.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="file" name="gambar[]" multiple class="form-control" required>
                        </div>
                        <div class="col-sm-6">
                            <input type="submit" name="kirim" value="+ Add Photo" class="btn btn-primary">
                        </div>
                    </div>
                    <br>
                    <input type="hidden" name="id-bang" value="<?php echo $id ?>">
                    <input type="hidden" name="tgl" value="<?php echo $tgl ?>">
                </form>

                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Upload Date</th>
                            <th>File Size</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = pg_query("SELECT photo_url, upload_date FROM msme_building_gallery WHERE msme_building_id='$id' 
                                ");
                        $server='../../foto/umkm/';
                        while ($row = pg_fetch_assoc($sql)) {
                            $foto=$row['photo_url'];
                            $id2 = base64_encode($foto);
                            $file = $server.$foto;
                            $b =fsize($file);
                            //$alamat = $_SERVER["HTTP_HOST"]$_SERVER["REQUEST_URI"];
                            echo "<tr>";
                            echo '<td><img src="'.$file.'" style="height: 50px;"/></td>';
                            echo '<td>'.$row['upload_date'];               
                            echo "<td>".$b."</td>";
                            echo '<td><a href="'.$file.'" target="_blank"><button type="button" class="btn btn-info btn-sm"><i class="ti-zoom-in"></i> Show Fullscreen</button></a>/
                                <button type="button" class="btn btn-danger btn-sm" onclick="hapusfoto('."'".$id."',"."'".$id2."'".')"><i class="fa fa-trash"></i> Delete</button>
                                </td>
                            ';
                            echo "</tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php
function fsize($file){
    $a = array("B", "KB", "MB", "GB", "TB", "PB");
    $pos = 0;
    $size = filesize($file);
    while ($size >= 1024)
    {
    $size /= 1024;
    $pos++;
    }
    return round ($size,2)." ".$a[$pos];
}
?>
<script type="text/javascript">
    function hapusfoto(idbang, idfoto) {
        reset();
        alertify.set({ labels: { ok: "Cancel", cancel: "Delete" } });
        alertify.confirm("Are you sure to delete this photo ?", function (e) {
            if (e) {
                alertify.success("You've clicked Cancel");
            } else {
                window.location.href = "act/info-hapusfoto.php?id-bang="+idbang+"&&id-foto="+idfoto;
            }
        });
        return false;
    }
</script>