<div style="text-align: center; padding-top: 3%; padding-bottom:3%">
    <button class="btn btn-default btn-lg" style="width: 90%; background-color: #fafafa" onclick="load()"
        data-toggle="modal" data-target="#tambahcitizen">+
        Add Citizen Data </button>
</div>

<div class="panel-body" style="padding-top: 2%; padding-left: 2%; padding-right: 2%" id="tabel-citizen">
    <h4 style="text-align: center;">Citizen List</h4>

    <table width="100%" class="table table-striped table-bordered table-hover" id="listcitizen">
        <thead>
            <tr style="text-align: center">
                <th>National ID Number</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>


<div class="modal fade" id="tambahcitizen">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="form-tambahcitizen">
                <div class="modal-header">
                    <h6 class="modal-title">Add Citizen Data</h6>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body" style="font-size: 110%">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            National Identity Number: <input class="form-control" type="text" name="nik" id="nik" value="">
                        </div>
                        <div class="form-group col-sm-6">
                            Name: <input class="form-control" type="text" name="nama" value="">
                        </div>
                        <div class="form-group col-sm-6">
                            Birth Date: <input class="form-control" type="date" name="tgl" value="">
                        </div>
                        <div class="form-group col-sm-6" id="combobox-pend">
                            Education Level:
                            <select class="form-control" name="pend" required style="height: 43px">
                                <?php                
                                            $sql_p=pg_query("SELECT * FROM education ORDER BY educational_level");
                                            while($row = pg_fetch_assoc($sql_p))
                                            {
                                                echo"<option value=".$row['education_id'].">".$row['educational_level']."</option>";
                                            }
                                        ?>
                            </select>
                        </div>
                        <div class="form-group col-sm-6" id="combobox-kerja">
                            Job:
                            <select class="selectpicker form-control" data-container="body" data-live-search="true"
                                title="Select job.." data-hide-disabled=" true" name="kerja">
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
                                <input type="text" class="form-control" id="penghasilan" onkeyup="ceknominal()"
                                    name="penghasilan">
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            Family Card Number:
                            <select class="selectpicker form-control" data-container="body" data-live-search="true"
                                title="Select a number" data-hide-disabled="true" name="kk">
                                <?php                
                                    $sql_d=pg_query("SELECT family_card_number FROM family_card");
                                    while($row = pg_fetch_assoc($sql_d))
                                    {
                                        echo"<option value=".$row['family_card_number'].">".$row['family_card_number']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            Status in Family:
                            <select class="form-control" name="status" style="height: 43px">
                                <option></option>
                                <option value="1">Head of Family</option>
                                <option value="2">Wife</option>
                                <option value="3">Child</option>
                                <option value="4">Another Family</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            Datuk:
                            <select class="selectpicker form-control" data-container="body" data-live-search="true"
                                title="Select datuk.." data-hide-disabled="true" name="datuk" onchange="ceksuku()" id="iddatuk">
                                <?php                
                                    $sql_suku=pg_query("SELECT * FROM datuk ORDER BY datuk_name");
                                    while($row = pg_fetch_assoc($sql_suku))
                                    {
                                        echo"<option value=".$row['datuk_id'].">".$row['datuk_name']."</option>";
                                    }
                                ?>
                            </select>
                            <div id="suku"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="tambahkancitizen">+ Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
$p_nik = '<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>National identity number</strong> cannot be emptied.&emsp;&emsp;<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span></button></div>';

$nik_ada = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>National identity number</strong> already registered.&emsp;&emsp;<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span></button></div>';
?>
<script type="text/javascript">
$(document).ready(function() {
    $('#listcitizen').DataTable();
});

function ceknominal() {
    var rupiah = document.getElementById('penghasilan');
    rupiah.value = formatRupiah(rupiah.value, '');
}

function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
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
    $("#suku").load("inc/suku.php?id_datuk=" + iddatuk);
}

function load() {
    $('#combobox-pend').load("inc/combobox-owner-pend.php");
    $('#combobox-kerja').load("inc/combobox-owner-kerja.php");
}

$(document).ready(function() {
    $("#tambahkancitizen").click(function() {
        var nik = document.getElementById('nik').value;
        $('#alertH').empty();
        if (nik == null || nik == '') {
            $('#alertH').append('<?php echo $p_nik ?>');
        } else {
            var ketemu = false;
            <?php 
                $sql = pg_query("SELECT national_identity_number FROM citizen");
                while ($data = pg_fetch_array($sql))
                {
                $idnya = $data['national_identity_number'];
                echo "if (nik == \"".$idnya."\")";
                echo "{
                        ketemu=true;
                        $('#alertH').append('".$nik_ada."'); 
                      }";

                }
            ?>
            if (ketemu == false) {
                var data = $('#form-tambahcitizen').serialize();
                $.ajax({
                    type: 'POST',
                    url: "act/tambah-citizen.php",
                    data: data,
                    success: function() {
                        $('#tabel-citizen').load("inc/load-citizen.php");
                        $('#tambahcitizen').modal('hide');
                        $('#sukses-tambah').modal('show');
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $("#notifikasi").empty();
                        $('#gagal').modal('show');
                        $("#notifikasi").append("<p>" + xhr.status + "</p>");
                        $("#notifikasi").append("<p>" + thrownError + "</p>");
                    }
                });
            }
        }
    });
});

function hapuscitizen(id, idtemp) {
    $.ajax({ 
        url: 'act/hapus-citizen.php?id='+id,
        data: "",
        success: function() {
            $('#tabel-citizen').load("inc/load-citizen.php");
            $('#delete-c'+idtemp).modal('hide');
            $('#sukses-hapus').modal('show');
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