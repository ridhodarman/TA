<?php

                $querysearch = "SELECT H.fcn_owner, O.*,
                                        D.datuk_name, T.name_of_tribe, V.village_name
                                FROM house_building AS H
                                JOIN house_building_owner AS O ON H.fcn_owner=O.national_identity_number
                                JOIN datuk AS D ON O.datuk_id=D.datuk_id
                                JOIN tribe AS T ON D.tribe_id=T.tribe_id
                                JOIN village AS V ON O.village_id=V.village_id
                                WHERE H.house_building_id='$id' 
                            ";

                // $querysearch = "SELECT H.national_identity_owner, H.address, H.standing_year, H.land_building_tax, H.type_of_construction, H.electricity_capacity, H.tap_water, H.building_status,
                //                 ST_X(ST_Centroid(H.geom)) AS longitude, ST_Y(ST_CENTROID(H.geom)) As latitude, ST_AsText(geom) as geom,
                //                 T.name_of_type as jkonstruksi,
                //                 O.*
                //                 FROM house_building as H
                //                 LEFT JOIN type_of_construction as T ON H.type_of_construction=T.type_id
                //                 JOIN house_building_owner as O ON H.national_identity_owner=O.national_identity_number
                //                 WHERE H.house_building_id='$id' 
                //             ";

                $hasil = pg_query($querysearch);
                while ($row = pg_fetch_array($hasil)) {
                    $nama = $row['owner_name'];
                    $nokk = $row['family_card_number'];
                    $tgl = $row['birth_date'];
                    $pendidikan = $row['educational_id'];
                    
                    $id_kerja = $row['job_id'];
                    $pekerjaan = $row['job_name'];
                    
                    $asuransi="-";
                    if ($row['savings']!=null) {
                        if ($row['insurance']==1) {
                             $asuransi="Exist";
                         }
                        else if ($row['insurance']==0) {
                            $asuransi="do not have";
                        } 
                    }

                    $pendapatan = $row['income'];

                    $tab = $row['savings'];
                    $tabungan="-";
                    if ($row['savings']!=null) {
                        if ($row['savings']==1) {
                         $tabungan="Exist";
                         }
                        else if ($row['savings']==0) {
                            $tabungan="do not have";
                        }
                    }

                    $id_datuk = $row['datuk_id'];
                    $datuk = $row['datuk_name'];

                    $id_suku = $row['tribe_id'];
                    $suku = $row['name_of_tribe'];

                    $id_kampung = $row['village_id'];
                    $kampung = $row['village_name'];

                    $geom = $row['geom'];
                }

?>
                        <div class="card">
                            <div class="card-body">
                                <div class="media mb-5">
                                    <div class="media-body">
                                        <div style="float: right; padding-right: 1%; padding-bottom: 6%; ">
                                            <button type="button" class="btn btn-info btn-sm btn-flat btn-lg mt-3" data-toggle="modal" data-target="#editpemilik"><i class="fa fa-edit"></i> Edit</button>

                                            <button type="button" class="btn btn-warning btn-sm btn-flat btn-lg mt-3" data-toggle="modal" data-target="#gantipemilik">
                                                <b> <i class="fas fa-id-card-alt"></i> Change Owner</b></button>

                                        </div>

                                        <h5 class="mb-3">Owner</h5>

                                        <table style="width: 100%">
                                            <tr>
                                                <td>Name </td>
                                                <td>:
                                                    <?php echo $nama ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>National ID Number </td>
                                                <td>:
                                                    <?php echo $nik?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Family Card Number </td>
                                                <td>:
                                                    <?php echo $nokk ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Birth Date </td>
                                                <td>:
                                                    <?php
                                                        if ($tgl!=null) {
                                                             echo date("d - F - Y",strtotime($tgl)); 
                                                         } 
                                                        
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Education Level </td>
                                                <td>:
                                                    <?php echo $pendidikan ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Job </td>
                                                <td>:
                                                    <?php echo $pekerjaan ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Income </td>
                                                <td>:
                                                    <?php echo "Rp. ". number_format($pendapatan) ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Take Insurance</td>
                                                <td>:
                                                    <?php echo $asuransi ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Savings </td>
                                                <td>:
                                                    <?php echo $tabungan ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Datuk </td>
                                                <td>:
                                                    <?php echo $datuk ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tribe </td>
                                                <td>:
                                                    <?php echo $suku ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Village </td>
                                                <td>:
                                                    <?php echo $kampung ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

<div class="modal fade" id="editpemilik">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h6 class="modal-title">Edit Owner Data</h6>
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
                        <div class="form-group col-sm-6" id="pendidikan">
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
                        <div class="form-group col-sm-6" id="kerja">
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
                                <input type="text" class="form-control" id="penghasilan" onkeyup="ceknominal()" value="<?php echo $pendapatan ?>">
                            </div>
                        </div>
                        <div class="form-group col-sm-6" id="asuransi">
                            Take Insurance:
                             <select class="form-control" name="asuransi" required style="font-size: 81%; font-weight: bold">
                                <option></option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-6" id="tabungan">
                            Savings:
                            <select class="form-control" name="tabungan" required style="font-size: 81%; font-weight: bold">
                                <option></option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-6" id="datuk">
                            Datuk:
                            <select class="form-control" name="datuk" required style="font-size: 81%; font-weight: bold">
                                <option></option>
                                <?php                
                                    $sql_d=pg_query("SELECT * FROM datuk ORDER BY datuk_name");
                                    while($row = pg_fetch_assoc($sql_d))
                                    {
                                        echo"<option value=".$row['datuk_id'].">".$row['datuk_name']."</option>";
                                    }
                                ?>
                            </select>
                            <font id="suku">Tribe: -</font>
                        </div>
                        <div class="form-group col-sm-6" id="kampung">
                            Village:
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
    $("#kampung select").val(<?php echo "'".$id_kampung."'" ?>);
    $("#datuk select").val(<?php echo "'".$id_datuk."'" ?>);
    $("#tabungan select").val(<?php echo "'".$tab."'" ?>);

    //alert(<?php echo "'".$id_datuk."'" ?>)



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
</script>