<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Collapsible sidebar using Bootstrap 3</title>

     <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Our Custom CSS -->
    
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
       <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" href="css/style5.css">
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
        <!--[if lt IE 9]>
        <link rel="stylesheet" type="text/css" href="css/style_ie.css" />
        <![endif]-->
        <!-- jQuery -->

        <!-- jmpress plugin -->
        <script src="http://code.jquery.com/jquery-migrate-1.0.0.js"></script>
        <script type="text/javascript" src="js/jmpress.min.js"></script>
        <!-- jmslideshow plugin : extends the jmpress plugin -->
        <script type="text/javascript" src="js/jquery.jmslideshow.js"></script>
        <script type="text/javascript" src="js/modernizr.custom.48780.js"></script>
    <noscript>
        <style>
        .step {
            width: 100%;
            position: relative;
        }
        .step:not(.active) {
            opacity: 1;
            filter: alpha(opacity=99);
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(opacity=99)";
        }
        .step:not(.active) a.jms-link{
            opacity: 1;
            margin-top: 40px;
        }
        </style>
    </noscript>
</head>

<body>

    <div class="wrapper">
        <!-- Sidebar Holder -->
        <?php include ('inc/sidebar.php') ?>

        <!-- Page Content Holder -->
        <div id="content">

            <?php include('inc/headbar2.php') ?>
            
            <?php
                $id= $_GET['id'];
            ?>

            <h3>Informasi <?php echo $id ?></h3>  
                <section id="jms-slideshow" class="jms-slideshow">
                <div class="step" data-color="color-0">                    
                    <img src="foto/1.jpg" /> 
                    <div class="jms-content">
                        <a class="jms-link" href="foto/1.jpg" target="_blank">View Full Screen</a><p/>
                        <font style="background-color: rgba(0, 0, 0, 0.20)">upload: 2/12/2018</font>
                    </div>
                </div>
                <div class="step" data-color="color-0">
                    <img src="foto/2.jpg" />
                    <div class="jms-content">
                        <a class="jms-link" href="foto/2.jpg" target="_blank">View Full Screen</a><p/>
                        <font style="background-color: rgba(0, 0, 0, 0.20)">upload: 2/12/2018</font>
                    </div>
                </div>
                <div class="step" data-color="color-0">
                    <img src="foto/3.jpg" />
                    <div class="jms-content">
                        <a class="jms-link" href="foto/3.jpg" target="_blank">View Full Screen</a><p/>
                        <font style="background-color: rgba(0, 0, 0, 0.20)">upload: 2/12/2018</font>
                    </div>
                </div>
                <div class="step" data-color="color-0">
                    <img src="foto/4.jpg" />
                    <div class="jms-content">
                        <a class="jms-link" href="foto/4.jpg" target="_blank">View Full Screen</a><p/>
                        <font style="background-color: rgba(0, 0, 0, 0.20)">upload: 2/12/2018</font>
                    </div>
                </div>
                <div class="step" data-color="color-0">
                    <img src="foto/5.jpg" />
                    <div class="jms-content">
                        <a class="jms-link" href="foto/5.jpg" target="_blank">View Full Screen</a><p/>
                        <font style="background-color: rgba(0, 0, 0, 0.20)">upload: 2/12/2018</font>
                    </div>
                </div>
            </section>
       
            <table width="100%">
                <tr>
                    <td>Nama</td>
                    <td>: Rumah</td>
                </tr>
                <tr><td colspan="2" class="line"></td></tr>
                <tr>
                    <td>Jenis Konstruksi</td>
                    <td>: Kayu</td>
                </tr>
            </table>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

            <div class="line"></div>

            <h2>Lorem Ipsum Dolor</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

            <div class="line"></div>

            <h2>Lorem Ipsum Dolor</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

            <div class="line"></div>

            <h3>Lorem Ipsum Dolor</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
    </div>

 
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
    </script>

    <!-- Custom Theme JavaScript -->

    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
        <script type="text/javascript">
            $(function() {
                
                var jmpressOpts = {
                    animation       : { transitionDuration : '3.0s' }
                };
                
                $( '#jms-slideshow' ).jmslideshow( $.extend( true, { jmpressOpts : jmpressOpts }, {
                    autoplay    : true,
                    bgColorSpeed: '0.8s',
                    arrows      : true
                }));
                
            });
        </script>
</body>

</html>