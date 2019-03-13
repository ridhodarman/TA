<div style="text-align: center; padding-top: 3%; padding-bottom:3%">
<button class="btn btn-default btn-lg" style="width: 90%; background-color: #fafafa" data-toggle="modal" data-target="#tambahkeluarga">+
    Add Family Data </button>
</div>

<div class="panel-body" style="padding-top: 2%; padding-left: 2%; padding-right: 2%">
    <h4 style="text-align: center;">List of Family Data</h4>
   
        <table width="100%" class="table table-striped table-bordered table-hover" id="listkeluarga">
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
                                $sql=pg_query("SELECT * FROM msme_building");
                                while ($data=pg_fetch_assoc($sql)) {
                                    $id=$data['msme_building_id'];
                                    echo "<tr>";
                                    echo "<td>".$id."</td>";
                                    echo "<td>".$data['name_of_msme_building']."</td>";
                                    echo '<td>
                                        <a href="inforumah.php?id='.$id.'" target="_blank"><button class="btn btn-info btn-xs" title="View Detail"><i class="fa fa-info-circle"></i> View Detail</button></a>
                                        <a href="act/hapusrumah.php?id='.$id.'"><button class="btn btn-danger btn-xs" title="Hapus" onclick="return confirm(\'Yakin?\')"><i class="fa fa-trash"></i> Delete</button></a>
                                        </td>';
                                    echo "</tr>";
                                }
                            ?>
        </tbody>
    </table>
</div>


<div class="modal fade" id="tambahkeluarga">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h6 class="modal-title">Add Family Data</h6>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body" style="font-size: 110%">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            Family Card Number: <input class="form-control" type="text" name="" value="<?php echo $nokk ?>">
                        </div>
                        <div class="form-group col-sm-6">
                            Name: <input class="form-control" type="text" name="" value="<?php echo $nama ?>">
                        </div>
                        <div class="form-group col-sm-6">
                            Birth Date: <input class="form-control" type="date" name="" value="<?php echo $tgl ?>">
                        </div>
                        <div class="form-group col-sm-6">
                            Education Level:
                            <select class="form-control" name="kerja" required style="font-size: 81%; font-weight: bold">
                                <option></option>
                                <?php                
                                    $sql_p=pg_query("SELECT * FROM education ORDER BY educational_level");
                                    while($row = pg_fetch_assoc($sql_p))
                                    {
                                        echo"<option value=".$row['education_id'].">".$row['educational_level']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            Job: 
                            <select class="form-control" name="kerja" required style="font-size: 81%; font-weight: bold">
                                <option></option>
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
                                <input type="text" class="form-control" id="penghasilan" onkeyup="ceknominal()">
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            Take Insurance:
                             <select class="form-control" name="asuransi" required style="font-size: 81%; font-weight: bold">
                                <option></option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            Savings:
                            <select class="form-control" name="tabungan" required style="font-size: 81%; font-weight: bold">
                                <option></option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            Datuk:
                            <select class="form-control" name="datuk" required onchange="ceksuku()" id="iddatuk" style="font-size: 81%; font-weight: bold">
                                <option></option>
                                <?php                
                                    $sql_suku=pg_query("SELECT * FROM datuk ORDER BY datuk_name");
                                    while($row = pg_fetch_assoc($sql_suku))
                                    {
                                        echo"<option value=".$row['datuk_id'].">".$row['datuk_name']."</option>";
                                    }
                                ?>
                            </select>
                            <div id="suku">Tribe: <?php echo $suku ?></div>
                        </div>
                        <div class="form-group col-sm-6">Village:
                            <select class="form-control" name="kampung" required style="font-size: 81%; font-weight: bold">
                                <option></option>
                                <?php                
                                    $sql_v=pg_query("SELECT * FROM village ORDER BY village_name");
                                    while($row = pg_fetch_assoc($sql_v))
                                    {
                                        echo"<option value=".$row['village_id'].">".$row['village_name']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
        $(document).ready(function() {
            $('#listkeluarga').DataTable();
        } );

function ceknominal() {
    var rupiah = document.getElementById('penghasilan');
    rupiah.value = formatRupiah(rupiah.value, '');
}

function formatRupiah(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split           = number_string.split(','),
    sisa            = split[0].length % 3,
    rupiah          = split[0].substr(0, sisa),
    ribuan          = split[0].substr(sisa).match(/\d{3}/gi);
 
    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }
 
    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
}

function ceksuku() {
    var iddatuk = document.getElementById('iddatuk').value; 
    //alert(iddatuk)
    $("#suku").empty()
    $("#suku").load("inc/suku.php?id_datuk="+iddatuk);
}
</script>