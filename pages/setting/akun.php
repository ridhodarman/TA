<?php session_start(); ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Account Setting</title>

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
                        <form method="POST" action="act/ubahpassword.php">
                            <h5>Account Setting</h5>
                            <br/>
                            <label>Username:</label>
                            <input type="text" class="form-control" name="username" value="<?php echo  $_SESSION['username'] ?>" placeholder="username..." readonly>
                            <br/>
                            <label>Password:</label>
                            <input type="password" class="form-control" name="pw" id="pw" value="" required onkeyup="cek()">
                            <br/>
                            <label>Re-type Password:</label>
                            <input type="password" class="form-control" name="cek-pw" id="cek-pw" value="" required onkeyup="cek()">
                            <label id="ket"></label>
                            <br/>
                            <div class="pull-right">
                                <button class="btn btn-default" onclick="back()"> Cancel</button>
                                <button type="submit" class="btn btn-primary" id="ubah" disabled><i class="fa fa-save"></i> Save</button>
                            </div>
                        </form>
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
</body>
</html>
    <script type="text/javascript">
        function back() {
            window.history.back();
        }

        function cek() {
            var pw1 = document.getElementById("pw").value;
            var pw2 = document.getElementById("cek-pw").value;

            if (pw1 == pw2) {
                $('#ubah').prop('disabled', false);
                 $('#ket').empty();
            }
            else {
                 $('#ubah').prop('disabled', true);
                 $('#ket').css('color', 'red');
                 $('#ket').html('the password entered must be the same!');
            }
        }
    </script>