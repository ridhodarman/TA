<?php session_start(); ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Info Citizen</title>

    <?php 
        include('../inc/head.php') 
    ?>
    <link rel="stylesheet" href="../dist/css/bootstrap-select.css">
    <link rel="stylesheet" href="../../assets/alertify/themes/alertify.core.css" />
    <link rel="stylesheet" href="../../assets/alertify/themes/alertify.default.css" id="toggleCSS" />
    <meta name="viewport" content="width=device-width">
    <script src="../../assets/alertify/lib/alertify.min.js"></script>
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
                        <h5>Citizen Info</h5>
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit" style="float: right;"><i class="fa fa-edit"></i> Edit</button>
                        <br/>
                        <table class="table table-hover" style="width: 90%">
                            <?php
                                $id = $_GET['id'];
                                 $querysearch = "SELECT C.national_identity_number, C.name, C.birth_date,
                                            D.datuk_name, T.name_of_tribe, J.job_name, C.income, E.educational_level, C.family_card_number, C.status_in_family, C.education_id, C.datuk_id, C.job_id
                                    FROM citizen AS C
                                    LEFT JOIN datuk AS D ON C.datuk_id=D.datuk_id
                                    LEFT JOIN tribe AS T ON D.tribe_id=T.tribe_id
                                    LEFT JOIN job AS J ON C.job_id=J.job_id
                                    LEFT JOIN education AS E ON C.education_id=E.education_id
                                    WHERE C.national_identity_number='$id' 
                                ";

                                $hasil = pg_query($querysearch);
                                while ($row = pg_fetch_array($hasil)) {
                                    $nama = $row['name'];
                                    $nik = $row['national_identity_number'];
                                    $nokk = $row['family_card_number'];
                                    $tgl = $row['birth_date'];
                                    $pendapatan = $row['income'];

                                    $id_pendidikan = $row['education_id'];
                                    $pendidikan = $row['educational_level'];
                                    
                                    $id_kerja = $row['job_id'];
                                    $pekerjaan = $row['job_name'];
                                    $stat = $row['status_in_family'];
                                    $status = $row['status_in_family'];
                                    if ($row['status_in_family']!=null) {
                                        if ($status==1) {
                                         $status="Head of Family";
                                         }
                                        else if ($status==2) {
                                            $status="Wife";
                                        }
                                        else if ($status==3) {
                                            $status="Child";
                                        }
                                        else if ($status==4) {
                                            $status="Another Family";
                                        }
                                    }

                                    $id_datuk = $row['datuk_id'];
                                    $datuk = $row['datuk_name'];

                                    $id_suku = $row['tribe_id'];
                                    $suku = $row['name_of_tribe'];

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
                                <td>Family Card Number</td>
                                <td>:<a href="info-kk.php?id=<?php echo $nokk ?>">
                                    <?php echo $nokk ?>
                                    </a>    
                                </td>
                            </tr>
                            <tr>
                                <td>Status in Family</td>
                                <td>:
                                    <?php echo $status ?>    
                                </td>
                            </tr>
                    </table>
                    
                </div>          
            </div>

    <!-- SAMPAI DISINI -->
<div class="modal fade" id="edit">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="act/edit-citizen.php" method="post">
                <div class="modal-header">
                    <h6 class="modal-title">Edit Owner Data</h6>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body" style="font-size: 110%">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            National Identity Number: <input class="form-control" type="text" name="nik" value="<?php echo $nik ?>">
                            <input type="hidden" name="nik-temp" value="<?php echo $nik ?>">
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
                        <div class="form-group col-sm-6">
                            Family Card Number:
                            <select class="selectpicker form-control" data-container="body" data-live-search="true"
                                title="Select a number" data-hide-disabled="true" name="kk" style="height: 43px">
                                <?php                
                                    $sql_d=pg_query("SELECT family_card_number FROM family_card");
                                    while($row = pg_fetch_assoc($sql_d))
                                    {
                                        echo"<option value=".$row['family_card_number'].">".$row['family_card_number']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-sm-6" id="status">
                            Status in Family:
                             <select class="form-control" name="status" style="height: 43px">
                                <option></option>
                                <option value="1">Head of Family</option>
                                <option value="2">Wife</option>
                                <option value="3">Child</option>
                                <option value="2">Another Family</option>
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
        $("#datuk select").val(<?php echo "'".$id_datuk."'" ?>);
        $("#status select").val(<?php echo "'".$stat."'" ?>);
        $("#kerja select").val(<?php echo "'".$id_kerja."'" ?>);
        $("#pendidikan select").val(<?php echo "'".$id_pendidikan."'" ?>);
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

<link rel="stylesheet" href="../../js/bootstrap.bundle.min.js" />
    <script src="../dist/js/bootstrap-select.js"></script>