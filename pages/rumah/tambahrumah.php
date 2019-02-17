<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>srtdash - ICO Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="../../assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../../assets/css/metisMenu.css">
    <link rel="stylesheet" href="../../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../assets/css/slicknav.min.css">

    <script type="text/javascript" src="../../js/jquery-3.2.1.min.js"></script>

    <link rel="stylesheet" href="../inc/style2.css">
    <script src="../inc/script.js"></script>
    <!-- amchart css -->
    <!-- <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" /> -->
    <!-- others css -->

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="../../assets/css/typography.css">
    <link rel="stylesheet" href="../../assets/css/default-css.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="../../assets/css/responsive.css">
    <link rel="stylesheet" href="../../assets/css/style2.css">
    
    <!-- modernizr css -->
    <script src="../../assets/js/vendor/modernizr-2.8.3.min.js"></script>
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDM2fDXHmGzCDmDBk3bdPIEjs6zwnI1kGQ&libraries=drawing"></script>        
    <script src="../inc/mapupd.js" type="text/javascript"></script>

    <?php include('../../inc/koneksi.php') ?>

</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
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
            <div class="page-title-area" style="visibility: hidden;">
                <button class="btn btn-default">tesss</button>
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Dashboard</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="#">Home</a></li>
                                <li><span>Dashboard</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <!-- page title area end -->
            <div class="main-content-inner">
                 <h3 style="padding-bottom: 1%">Input Data Rumah</h3>
                <div class="row">
                <div class="col-sm-6" id="hide2"> <!-- menampilkan peta-->
                  <section class="panel">
                    <header class="panel-heading">
                    <h3>                    
                    <input id="latlng" type="text" class="form-control" value="" placeholder="Latitude, Longitude"> <p/>
                      <button class="btn btn-default my-btn" id="btnlatlng" type="button" title="Geocode"><i class="fa fa-search"></i></button>
                      <button class="btn btn-default my-btn" type="button" title="Hapus Marker" onclick="hapusmarkerdankoor()"><i class="fa fa-ban"></i></button>
                      <button class="btn btn-default my-btn" id="delete-button" type="button" title="Remove shape"><i class="fa fa-trash"></i></button> 
                    </h3>
                    </header>
                      <div class="panel-body" style="padding-top: 3%">
                          <div id="map" style="width:100%;height:420px;"></div>
                      </div>
                  </section>
                </div>
              
               <div class="col-sm-6" id="hide3"> <!-- menampilkan form tambah-->
                <div class="form-group" id="hasilcari1">
                <form role="form" action="act/tambahrumah.php" enctype="multipart/form-data" method="post">
                <input type="text" style="visibility: hidden;" class="form-control" id="id" name="id" value="<?php echo $idmax;?>">
                <div class="form-group">
                    <label for="geom"><span style="color:red">*</span> Coordinat</label>
                    <textarea class="form-control" id="geom" name="geom" readonly required></textarea>
                </div>
                <div class="form-group">
                    <label for="geom"><span style="color:red">*</span> ID Survey</label>
                    <input type="text" class="form-control" name="id" value="" required>
                </div>
                <div class="form-group">
                    <label for="nama"><span style="color:red">*</span>Name</label>
                    <input type="text" class="form-control" name="nama" value="" required>
                </div>
                <div class="form-group">
                    <label for="kategori">Category</label>
                    <select name="kategori" id="kategori" class="form-control">
                    <?php                
                    $kategori=pg_query("select * from category_worship_place ");
                    while($rowkategori = pg_fetch_assoc($kategori))
                    {
                    echo"<option value=".$rowkategori['id'].">".$rowkategori['name']."</option>";
                    }
                    ?>          
                    </select>
                </div> 
                <div class="form-group">
                    <label class="control-label col-md-3">Image Upload</label>
                    <div class="col-md-9">
                        <div id="filediv"><input name="file[]" type="file" id="file"/></div>
                        <input type="button" id="add_more" class="btn btn-theme02" value="Add+" style="float: right;" />
                    </div>
                </div>   
                <p>.</p>   
                <button type="submit" class="btn btn-primary pull-right" style="width: 100%;">Save <i class="fa fa-save"></i></button>   
                </form>         
            </div>

  
    
                
            </div>
            </div> <!-- SAMPAI DISINI -->
         </div>

        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>© Copyright 2018. All right reserved. Template by <a href="https://colorlib.com/wp/">Colorlib</a>.</p>
            </div>
        </footer>
        <!-- footer area end-->
  
    <!-- page container area end -->
    <!-- offset area start -->
    

    <!-- offset area end -->

    <!-- jquery latest version -->
<!--     <script src="../../assets/js/vendor/jquery-2.2.4.min.js"></script> -->
    <!-- bootstrap 4 js -->
    <script src="../../assets/js/popper.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/js/owl.carousel.min.js"></script>
    <script src="../../assets/js/metisMenu.min.js"></script>
    <script src="../../assets/js/jquery.slimscroll.min.js"></script>
    <script src="../../assets/js/jquery.slicknav.min.js"></script>

    <!-- start chart js -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script> -->
    <!-- start highcharts js -->
    <!-- <script src="https://code.highcharts.com/highcharts.js"></script> -->
    <!-- start zingchart js -->
    <!-- <script src="https://cdn.zingchart.com/zingchart.min.js"></script> -->
    <!-- <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script> -->
    <!-- all line chart activation -->
    <script src="../../assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="../../assets/js/pie-chart.js"></script>

    <!-- others plugins -->
    <script src="../../assets/js/plugins.js"></script>
    <script src="../../assets/js/scripts.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dataTables-example').DataTable();
        } );

        function back(){
            window.location = "index.php";
        }
    </script>
</body>
</html>
