<?php session_start(); ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>srtdash - ICO Dashboard</title>

    <?php 
        $loc = "../";
        include('../inc/head.php');

        function wordlimit($text,$limit){
            if(strlen($text)>$limit)
                $word = mb_substr($text,0,$limit-3)."...";
            else
                $word = $text;
            return $word;          
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
                 
                <a href="tambahrumah.php" class="btn btn-default btn-lg" style="width: 100%">+ Add House Building Data </a><br/><br/>

                
                <div class="panel-body card" style="padding-top: 2%; padding-left: 2%; padding-right: 2%">
                    <h4 style="text-align: center;">House List</h4>
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Owner</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql=pg_query("SELECT * FROM house_building");
                                while ($data=pg_fetch_assoc($sql)) {
                                    $id=$data['house_building_id'];
                                    echo "<tr>";
                                    echo "<td>".$id."</td>";
                                    echo "<td>".$data['fcn_owner']."</td>";
                                    echo "<td>".$data['address']."</td>";
                                    echo '<td>
                                        <a href="inforumah.php?id='.$id.'"><button class="btn btn-info btn-xs" title="View Detail"><i class="fa fa-info-circle"></i> View Detail</button></a>
                                        <a href="act/hapusrumah.php?id='.$id.'"><button class="btn btn-danger btn-xs" title="Hapus" onclick="return confirm(\'Yakin?\')"><i class="fa fa-trash"></i> Delete</button></a>
                                        </td>';
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            
        
                
    </div>

    <!-- SAMPAI DISINI -->
    
                
                <!-- row area start-->
            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>© Copyright 2018. All right reserved. Template by <a href="https://colorlib.com/wp/">Colorlib</a>.</p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
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
            window.location = "../";
        }
    </script>
</body>
</html>
