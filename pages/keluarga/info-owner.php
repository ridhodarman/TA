<?php session_start(); ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Info House Owner</title>

    <?php 
        include('../inc/head.php') 
    ?>

</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
          <div class="wrapper">
            <div class="circle circle-1"></div>
            <div class="circle circle-1a"></div>
            <div class="circle circle-2"></div>
            <div class="circle circle-3"></div>
          </div>
          <h1 style="font-size: 200%">Loading&hellip;</h1>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <?php include('../inc/sidebar.php') ?>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <?php include ('../inc/header2.php'); ?>
            <!-- header area end -->
            <!-- page title area start -->

            <br>
            <!-- page title area end -->
            <div class="main-content-inner">
                <div class="card">
                    <div class="card-body">
                        <h5>House Owner Info</h5>
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit" style="float: right;"><i class="fa fa-edit"></i> Edit</button>
                        <br/>
                        <table class="table table-hover" style="width: 90%">
                            <?php
                                $id = $_GET['id'];
                                 $querysearch = "SELECT H.*,
                                            D.datuk_name, T.name_of_tribe, V.village_name, J.job_name, E.educational_level
                                    FROM house_building_owner AS H
                                    LEFT JOIN datuk AS D ON H.datuk_id=D.datuk_id
                                    LEFT JOIN tribe AS T ON D.tribe_id=T.tribe_id
                                    LEFT JOIN village AS V ON H.village_id=V.village_id
                                    LEFT JOIN job AS J ON H.job_id=J.job_id
                                    LEFT JOIN education AS E ON H.educational_id=E.education_id
                                    WHERE H.national_identity_number='$id' 
                                ";

                                $hasil = pg_query($querysearch);
                                while ($row = pg_fetch_array($hasil)) {
                                    $nama = $row['owner_name'];
                                    $nik = $row['national_identity_number'];
                                    $nokk = $row['family_card_number'];
                                    $tgl = $row['birth_date'];

                                    $id_pendidikan = $row['educational_id'];
                                    $pendidikan = $row['educational_level'];
                                    
                                    $id_kerja = $row['job_id'];
                                    $pekerjaan = $row['job_name'];

                                    $asuransi="-";
                                    if ($row['savings']!=null) {
                                        if ($row['insurance']==1) {
                                             $asuransi="Exist";
                                         }
                                        else if ($row['insurance']==0) {
                                            $asuransi="Do not have";
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
                                            $tabungan="Do not have";
                                        }
                                    }

                                    $id_datuk = $row['datuk_id'];
                                    $datuk = $row['datuk_name'];

                                    $id_suku = $row['tribe_id'];
                                    $suku = $row['name_of_tribe'];

                                    $id_kampung = $row['village_id'];
                                    $kampung = $row['village_name'];

                                    $a=$row['insurance'];
                                }
                            ?>
                            <tr>
                                <td>National Identity Number</td>
                                <td>:
                                    <?php echo $nik ?>    
                                </td>
                            </tr>
                            <tr>
                                <td>Family Card Number</td>
                                <td>:
                                    <?php echo $id ?>    
                                </td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>:
                                    <?php echo $nama ?>        
                                </td>
                            </tr>
                            <tr>
                                <td>Birth Date </td>
                                <td>:
                                    <?php
                                        $tgl2 = date('Y-m-d');
                                        if ($tgl!=null && $tgl!=$tgl2) {
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
                                    <?php
                                        if ($pendapatan!=null) {
                                             echo "Rp. ". number_format($pendapatan); 
                                         } 
                                        
                                    ?>
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

    <!-- SAMPAI DISINI -->
<div class="modal fade" id="edit">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="act/edit-holder.php" method="post">
                <div class="modal-header">
                    <h6 class="modal-title">Edit Owner Data</h6>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body" style="font-size: 110%">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            National Identity Number: <input class="form-control" type="text" name="kk" value="<?php echo $nik ?>">
                            <input type="hidden" name="kk-temp" value="<?php echo $nokk ?>">
                        </div>
                        <div class="form-group col-sm-6">
                            Family Card Number: <input class="form-control" type="text" name="kk" value="<?php echo $nokk ?>">
                            <input type="hidden" name="kk-temp" value="<?php echo $nokk ?>">
                        </div>
                        <div class="form-group col-sm-6">
                            Name: <input class="form-control" type="text" name="nama" value="<?php echo $nama ?>">
                        </div>
                        <div class="form-group col-sm-6">
                            Birth Date: <input class="form-control" type="date" name="tgl" value="<?php echo $tgl ?>">
                        </div>
                        <div class="form-group col-sm-6" id="pendidikan">
                            Education Level:
                            <select class="form-control" name="pend" required style="height: 43px">
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
                            <select class="form-control" name="kerja" required style="height: 43px">
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
                                <input type="text" class="form-control" id="penghasilan" name="penghasilan" onkeyup="ceknominal()" value="<?php echo $pendapatan ?>">
                            </div>
                        </div>
                        <div class="form-group col-sm-6" id="asuransi">
                            Take Insurance:
                             <select class="form-control" name="asuransi" required style="height: 43px">
                                <option></option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-6" id="tabungan">
                            Savings:
                            <select class="form-control" name="tabungan" required style="height: 43px">
                                <option></option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-6" id="kampung">
                            Village:
                            <select class="form-control" name="kampung" required style="height: 43px">
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
                        <div class="form-group col-sm-6" id="datuk">
                            Datuk:
                            <select class="form-control" name="datuk" id="iddatuk" required style="height: 43px" onchange="ceksuku()">
                                <option></option>
                                <?php                
                                    $sql_d=pg_query("SELECT * FROM datuk ORDER BY datuk_name");
                                    while($row = pg_fetch_assoc($sql_d))
                                    {
                                        echo"<option value=".$row['datuk_id'].">".$row['datuk_name']."</option>";
                                    }
                                ?>
                            </select>
                            <div id="suku"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

    
                
                <!-- row area start-->
            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <?php include('../inc/foot.php') ?>
</body>
</html>
    <script type="text/javascript">
        $("#kampung select").val(<?php echo "'".$id_kampung."'" ?>);
        $("#datuk select").val(<?php echo "'".$id_datuk."'" ?>);
        $("#tabungan select").val(<?php echo "'".$tab."'" ?>);
        $("#kerja select").val(<?php echo "'".$id_kerja."'" ?>);
        $("#pendidikan select").val(<?php echo "'".$id_pendidikan."'" ?>);
        $("#asuransi select").val(<?php echo "'".$a."'" ?>);

        function back() {
            window.history.back();
        }


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