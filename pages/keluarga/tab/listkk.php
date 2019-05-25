<div style="text-align: center; padding-top: 3%; padding-bottom:3%">
<button class="btn btn-default btn-lg" style="width: 90%; background-color: #fafafa" data-toggle="modal" data-target="#tambahholder">+
    Add Family Card Data </button>
</div>

<div class="panel-body" style="padding-top: 2%; padding-left: 2%; padding-right: 2%" id="tabel-holder">
    <h4 style="text-align: center;">List of Family Card</h4>
   
        <table width="100%" class="table table-striped table-bordered table-hover" id="listkk">
            <thead>
                <tr style="text-align: center">
                    <th>Family Card Number</th>
                    <th>House ID</th>
                    <th>Action</th>
                </tr>
            </thead>
            </tr>
        </thead>
        <tbody>
            <?php
                                $sql=pg_query("SELECT family_card_number, house_building_id FROM family_card");
                                while ($data=pg_fetch_assoc($sql)) {
                                    $id=$data['family_card_number'];
                                    $id_enc = "'".base64_encode($id)."'";
                                    $id2 = "'".$id."'";
                                    echo "<tr>";
                                    echo "<td>".$id."</td>";
                                    echo "<td>".$data['house_building_id']."</td>";
                                    echo '<td>
                                        <a href="info-kk.php?id='.$id.'"><button class="btn btn-info btn-xs" title="View Detail"><i class="fa fa-info-circle"></i> View Detail</button></a>
                                        <button class="btn btn-danger btn-xs" title="Hapus" data-toggle="modal" data-target="#delete-h'.$id.'"><i class="fa fa-trash"></i> Delete</button>
                                        </td>';
                                    echo "</tr>";
                                    echo '
                                        <div class="modal fade" id="delete-h'.$id.'">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Delete '.$id.' ?</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure to delete "'.$id.'" from  family card data ?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="button" class="btn btn-danger" onclick="hapusholder('.$id_enc.','.$id2.')">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    ';
                                }
                            ?>
        </tbody>
    </table>
</div>


<div class="modal fade" id="tambahholder">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="form-tambahholder">
                <div class="modal-header">
                    <h6 class="modal-title">Add Family Card Data</h6>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body" style="font-size: 110%">
                    
                        <div id="alertH"></div>
                        <div class="form-group">
                            Family Card Number: <input class="form-control" type="text" name="kk2" id="kk2" required>
                        </div>
                        <div class="form-group">
                            Category: 
                            <select class="form-control" name="kategori" style="height: 43px">
                                <option></option>
                                <option value="0">Poor Family</option>
                                <option value="1">Capable Family</option>
                            </select>
                        </div>
                        <div class="form-group" id="combobox-rumah">
                            House ID:
                            <select class="selectpicker form-control" data-container="body" data-live-search="true"
                                title="Select house.." data-hide-disabled=" true" name="rumah">
                                <option></option>
                                <?php                
                                    $sql_k=pg_query("SELECT house_building_id FROM house_building ORDER BY house_building_id");
                                    while($row = pg_fetch_assoc($sql_k))
                                    {
                                        echo"<option value=".$row['house_building_id'].">".$row['house_building_id']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="tambahkanholder">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
$p_kk = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Family card number</strong> cannot be emptied.&emsp;&emsp;<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span></button></div>';

$kk_ada = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Family card number</strong> already registered.&emsp;&emsp;<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span></button></div>';
?>
<script type="text/javascript">
        $(document).ready(function() {
            $('#listkk').DataTable();
        } );


$(document).ready(function(){
    $("#tambahkanholder").click(function(){
        var kk = document.getElementById('kk2').value;
        $('#alertH').empty();
        if (kk==null || kk=='') {
                $('#alertH').append('<?php echo $p_kk ?>');
        }
        else {
            var ketemu = false;
            <?php 
                $sql = pg_query("SELECT family_card_number FROM family_card");
                while ($data = pg_fetch_array($sql))
                {
                $idnya = $data['family_card_number'];
                echo "if (kk == \"".$idnya."\")";
                echo "{
                        ketemu=true;
                        $('#alertH').append('".$kk_ada."'); 
                      }";

                }
            ?>
            if (ketemu == false) {
                var data = $('#form-tambahholder').serialize();
                $.ajax({
                    type: 'POST',
                    url: "act/tambah-kk.php",
                    data: data,
                    success: function() {
                        $('#tabel-holder').load("inc/load-kk.php");
                        $('#tambahholder').modal('hide');
                        $('#sukses-tambah').modal('show');
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
    });
});

function hapusholder(id, idtemp) {
    $.ajax({ 
        url: 'act/hapus-holder.php?id='+id,
        data: "",
        success: function() {
            $('#tabel-holder').load("inc/load-kk.php");
            $('#sukses-hapus').modal('show');
            $('#delete-h'+idtemp).modal('hide');
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $("#notifikasi").empty();
            $('#gagal').modal('show');
            $("#notifikasi").append("<p>"+xhr.status+"</p>");
            $("#notifikasi").append("<p>"+thrownError+"</p>");
        }
    });
}
</script>