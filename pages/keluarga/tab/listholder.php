<div style="text-align: center; padding-top: 3%; padding-bottom:3%">
<button class="btn btn-default btn-lg" style="width: 90%; background-color: #fafafa" onclick="load2()" data-toggle="modal" data-target="#tambahholder">+
    Add Householder Data </button>
</div>

<div class="panel-body" style="padding-top: 2%; padding-left: 2%; padding-right: 2%" id="tabel-holder">
    <h4 style="text-align: center;">List of Householder</h4>
   
        <table width="100%" class="table table-striped table-bordered table-hover" id="listholder">
            <thead>
                <tr style="text-align: center">
                    <th>No. Family Card</th>
                    <th>Name of Head Family</th>
                    <th>Action</th>
                </tr>
            </thead>
            </tr>
        </thead>
        <tbody>
            <?php
                                $sql=pg_query("SELECT family_card_number, head_of_family FROM householder");
                                while ($data=pg_fetch_assoc($sql)) {
                                    $id=$data['family_card_number'];
                                    $nama = $data['head_of_family'];
                                    $id_enc = "'".base64_encode($id)."'";
                                    $id2 = "'".$id."'";
                                    echo "<tr>";
                                    echo "<td>".$id."</td>";
                                    echo "<td>".$nama."</td>";
                                    echo '<td>
                                        <a href="info-holder.php?id='.$id.'"><button class="btn btn-info btn-xs" title="View Detail"><i class="fa fa-info-circle"></i> View Detail</button></a>
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
                                                        <p>Are you sure to delete '.$id.' (Head of Family: '.$nama.') from  householder data ?</p>
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
                    <h6 class="modal-title">Add Householder Data</h6>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body" style="font-size: 110%">
                    <div class="row">
                        <div id="alertH"></div>
                        <div class="form-group col-sm-6">
                            Family Card Number: <input class="form-control" type="text" name="kk2" id="kk2" required>
                        </div>
                        <div class="form-group col-sm-6">
                            Name of head family: <input class="form-control" type="text" name="nama2" id="nama2" required>
                        </div>
                        <div class="form-group col-sm-6">
                            Birth Date: <input class="form-control" type="date" name="tgl2" required>
                        </div>
                        <div class="form-group col-sm-6" id="combobox-pend2">
                            Education Level:
                            <select class="form-control" name="pend2" required style="font-size: 81%; font-weight: bold">
                                <?php                
                                    $sql_p=pg_query("SELECT * FROM education ORDER BY educational_level");
                                    while($row = pg_fetch_assoc($sql_p))
                                    {
                                        echo"<option value=".$row['education_id'].">".$row['educational_level']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-sm-6" id="combobox-kerja2">
                            Job: 
                            <select class="form-control" name="kerja2" required style="font-size: 81%; font-weight: bold">
                                <?php                
                                    $sql_k=pg_query("SELECT * FROM job ORDER BY job_name");
                                    while($row = pg_fetch_assoc($sql_k))
                                    {
                                        echo"<option value=".$row['job_id'].">".$row['job_name']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            Income:
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp</div>
                                </div>
                                <input type="text" class="form-control" id="penghasilan2" name="penghasilan2" onkeyup="ceknominal2()">
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            Take Insurance:
                             <select class="form-control" name="asuransi2" required style="font-size: 81%; font-weight: bold">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            Savings:
                            <select class="form-control" name="tabungan2" required style="font-size: 81%; font-weight: bold">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-6" id="combobox-kampung2">
                        	Village:
                            <select class="form-control" name="kampung2" required style="font-size: 81%; font-weight: bold">
                                <?php                
                                    $sql_v=pg_query("SELECT * FROM village ORDER BY village_name");
                                    while($row = pg_fetch_assoc($sql_v))
                                    {
                                        echo"<option value=".$row['village_id'].">".$row['village_name']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            Number of Dependents<label id="tanggungs"></label>
                            <input type="text" class="form-control" name="tanggung2" onkeypress="return hanyaAngka(event, '#tanggungs')">
                        </div>
                        <div class="form-group col-sm-6">
                            Datuk:
                            <select class="form-control" name="datuk2" required onchange="ceksuku2()" id="iddatuk2" style="font-size: 81%; font-weight: bold">
                                <?php                
                                    $sql_suku=pg_query("SELECT * FROM datuk ORDER BY datuk_name");
                                    while($row = pg_fetch_assoc($sql_suku))
                                    {
                                        echo"<option value=".$row['datuk_id'].">".$row['datuk_name']."</option>";
                                    }
                                ?>
                            </select>
                            <div id="suku2"></div>
                        </div>
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

$p_nama = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Name of head family</strong> cannot be emptied.&emsp;&emsp;<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span></button></div>';

$kk_ada = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Family card number</strong> already registered.&emsp;&emsp;<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span></button></div>';
?>
<script type="text/javascript">
        $(document).ready(function() {
            $('#listholder').DataTable();
        } );

function ceksuku2() {
    var iddatuk = document.getElementById('iddatuk2').value; 
    //alert(iddatuk)
    $("#suku2").empty()
    $("#suku2").load("inc/suku.php?id_datuk="+iddatuk);
}

function ceknominal2() {
    var rupiah = document.getElementById('penghasilan2');
    rupiah.value = formatRupiah(rupiah.value, '');
}

$(document).ready(function(){
    $("#tambahkanholder").click(function(){
        var kk = document.getElementById('kk2').value;
        var nama = document.getElementById('nama2').value;
        $('#alertH').empty();
        if (kk==null || kk=='' || nama==null || nama=='') {
            //$('#datakosong').modal('show');
            if (kk==null || kk=='') {
                $('#alertH').append('<?php echo $p_kk ?>');
            }
            if (nama==null || nama=='') {
                $('#alertH').append('<?php echo $p_nama ?>');    
            }
        }
        else {
            var ketemu = false;
            <?php 
                $sql = pg_query("SELECT family_card_number FROM householder");
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
                    url: "act/tambah-holder.php",
                    data: data,
                    success: function() {
                        $('#tabel-holder').load("inc/load-holder.php");
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
            $('#tabel-holder').load("inc/load-holder.php");
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

    function load2() {
        $('#combobox-pend2').load("inc/combobox-holder-pend.php");
        $('#combobox-kerja2').load("inc/combobox-holder-kerja.php");
        $('#combobox-kampung2').load("inc/combobox-holder-kampung.php");
    }
</script>