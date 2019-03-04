<?php session_start(); ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Manage Admin Account</title>

    <?php 
        include('../inc/head.php');
        if($_SESSION['role'] != 1){
            echo '<script>window.location="../../assets/403"</script>';
        } 
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
                        <div style="text-align: center; padding-top: 3%; padding-bottom:3%">
                            <button class="btn btn-default btn-lg" style="width: 90%; background-color: #fafafa" data-toggle="modal" data-target="#tambahadmin">+
                                Add New Admin Nagari </button>
                        </div>

                        <div class="modal fade" id="tambahadmin">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Admin Nagari</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                    </div>
                                    <form method="post" id="form-tambahadmin">
                                        <div class="modal-body">
                                            <p>Username:</p><label id="ids"></label>
                                            <input type="text" class="form-control" name="username" id="user1" placeholder="Enter username..." onchange="cekid('user1', 'ids', 'tambahkanadmin')" required >
                                            <p>Password:</p>
                                            <input type="password" class="form-control" name="password" id="pw1" onkeyup="cek('pw1', 'pw2', 'tambahkanadmin', 'samakan')" required>
                                            <p>Re-type Password:</p>
                                            <input type="password" class="form-control" id="pw2" onkeyup="cek('pw1', 'pw2', 'tambahkanadmin', 'samakan')" required>
                                            <label id="samakan"></label>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="tambahkanadmin" disabled>+ Add</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <div class="panel-body" style="padding-top: 2%; padding-left: 2%; padding-right: 2%" id="tabel-admin">
                            <h4 style="text-align: center;">Admin Nagari List</h4>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="listadmin">
                                <thead>
                                    <tr style="text-align: center">
                                        <th>No.</th>
                                        <th>username</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql=pg_query("SELECT username FROM user_account WHERE role =0");
                                        $no=1;
                                        while ($data=pg_fetch_assoc($sql)) {
                                            $username=$data['username'];
                                            echo "<tr>";
                                            echo "<td>".$no."</td>";
                                            echo "<td>".$username."</td>";
                                            echo '<td>
                                                <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#edit-admin'.$username.'"><i class="fa fa-edit"></i> Edit</button>
                                                <button class="btn btn-danger btn-xs" title="Hapus" data-toggle="modal" data-target="#delete-admin'.$username.'"><i class="fa fa-trash"></i> Delete</button>
                                                </td>';
                                            echo "</tr>";
                                            $user_enc = "'".base64_encode($username)."'";
                                            $usr="'".$username."'";
                                            $usr2="'usr-edit".$username."'";
                                            $ids="'ids".$username."'";
                                            $pw="'pw-edit".$username."'";
                                            $pw2="'pw2-edit".$username."'";
                                            $button="'editadmin".$username."'";
                                            $label="'samakan-edit".$username."'";
                                            echo '
                                                <div class="modal fade" id="delete-admin'.$username.'">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Delete '.$username.' ?</h5>
                                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure to delete "'.$username.'" ?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                <button type="button" class="btn btn-danger" onclick="hapusadmin('.$user_enc.','.$usr.')">Delete</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade" id="edit-admin'.$username.'">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <form method="post" id="form-editadmin'.$username.'" action="act/edit-admin.php">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Username:<label id="ids'.$username.'"></label></p>
                                                                    <input type="hidden" name="usr-temp" value="'.$username.'">
                                                                    <input type="text" class="form-control" name="usr-edit" id="usr-edit'.$username.'" placeholder="Enter username..." value="'.$username.'" onchange="cekid2('.$usr2.', '.$ids.', '.$button.', '.$usr.')" required>
                                                                    <p>New Password:</p>
                                                                    <input type="password" class="form-control" name="pw-edit" id="pw-edit'.$username.'" value="'.$username.'" onkeyup="cek('.$pw.', '.$pw2.', '.$button.', '.$label.')" value="" required>
                                                                    <p>Re-type New Password:</p>
                                                                    <input type="password" class="form-control" id="pw2-edit'.$username.'" onkeyup="cek('.$pw.', '.$pw2.', '.$button.', '.$label.')" value="" required>
                                                                    <label id="samakan-edit'.$username.'"></label>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-primary" id="editadmin'.$username.'" disabled><i class="ti-save"></i> Save</button>
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
                    </div>
                </div>          
            </div>

    <!-- SAMPAI DISINI -->
    
                
                <!-- row area start-->
            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <?php include('../inc/foot.php') ?>
        <input type="hidden" name="" id="cari">
</body>
</html>
<script type="text/javascript">

    //tambah data
    $(document).ready(function(){
        $("#tambahkanadmin").click(function(){ 
            var user = document.getElementById('user1').value;
            if (user==null || user=='') {
                $('#datakosong').modal('show');
            }
            else {
                var data = $('#form-tambahadmin').serialize();
                $.ajax({
                    type: 'POST',
                    url: "act/tambah-admin.php",
                    data: data,
                    success: function() {
                        $('#tabel-admin').load("inc/load-user.php");
                        $('#tambahadmin').modal('hide');
                        $('#sukses-tambah').modal('show');
                        document.getElementById('user1').value=null;
                        document.getElementById('pw1').value=null;
                        document.getElementById('pw2').value=null;
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
    function hapusadmin(id, idtemp) {
        $.ajax({ 
            url: 'act/hapus-admin.php?id='+id,
            data: "",
            success: function() {
                $('#tabel-admin').load("inc/load-user.php");
                $('#sukses-hapus').modal('show');
                $('#delete-admin'+idtemp).modal('hide');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $("#notifikasi").empty();
                $('#gagal').modal('show');
                $("#notifikasi").append("<p>"+xhr.status+"</p>");
                $("#notifikasi").append("<p>"+thrownError+"</p>");
            }
        });
    }

    // //edit data
    // function editadmin(username, input) {
    //     console.log(username)
    //     console.log(input)
    //     var user = document.getElementById(input).value;
    //         if (user==null || user=='') {
    //             $('#datakosong').modal('show');
    //         }
    //         else {
    //             var data = $('#form-editadmin'+username).serialize();
    //             console.log(data)
    //             $.ajax({
    //                 type: 'POST',
    //                 url: "act/edit-admin.php",
    //                 data: data,
    //                 success: function() {
    //                     $('#tabel-admin').load("inc/load-user.php");
    //                     $('#edit-admin'+username).modal('hide');
    //                     $('#sukses-update').modal('show');
    //                 },
    //                 error: function (xhr, ajaxOptions, thrownError) {
    //                     $("#notifikasi").empty();
    //                     $('#gagal').modal('show');
    //                     $("#notifikasi").append("<p>"+xhr.status+"</p>");
    //                     $("#notifikasi").append("<p>"+thrownError+"</p>");
    //                 }
    //             });
    //         }
    // }

    function cek(input1, input2, button, label) {
        var pw1 = document.getElementById(input1).value;
        var pw2 = document.getElementById(input2).value;

        if (pw1 == pw2) {
            $('#'+button).prop('disabled', false);
            $('#'+label).empty();
        }
        else {
             $('#'+button).prop('disabled', true);
             $('#'+label).css('color', 'red');
             $('#'+label).html('the password entered must be the same!');
        }

        if (document.getElementById('cari').value == "true") {
            $('#'+button).prop('disabled', true);
            //alert(document.getElementById('cari').value)
        }
    }

    function cekid (input, label, button) {
        var ketemu=false;
        var user=document.getElementById(input).value
        <?php 
          $sql = pg_query("SELECT username FROM user_account");
          while ($data = pg_fetch_array($sql))
          {
            $cek = $data['username'];
            echo "if (user == \"".$cek."\")";
            echo "{
                    ketemu=true;
                    $('#'+label).css('color', 'red');
                    $('#'+label).html('...This username is already registered');
                    $('#'+button).prop('disabled', true);
                  }";

          }
        ?>
         if (ketemu==false){
                $('#'+label).empty();
                $('#'+button).prop('disabled', false);
            }
        document.getElementById('cari').value = ketemu;
    }

    function cekid2 (input, label, button, tempuser) {
        var ketemu=false;
        var user=document.getElementById(input).value
        <?php 
          $sql = pg_query("SELECT username FROM user_account");
          while ($data = pg_fetch_array($sql))
          {
            $cek = $data['username'];
            echo "if (user == \"".$cek."\")";
            echo "{
                    ketemu=true;
                    $('#'+label).css('color', 'red');
                    $('#'+label).html('...This username is already registered');
                    $('#'+button).prop('disabled', true);
                    if (user == tempuser){
                        ketemu=false;
                    }
                  }";

          }
        ?>
         if (ketemu==false){
                $('#'+label).empty();
                $('#'+button).prop('disabled', false);
            }
        document.getElementById('cari').value = ketemu;
    }

    $(document).ready(function() {
            $('#listadmin').DataTable();
    } );

    function back() {
        window.history.back();
    }
</script>