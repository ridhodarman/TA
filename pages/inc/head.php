<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" type="image/png" href="../../assets/images/icon/favicon.ico">
<link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
<link rel="stylesheet" href="../../assets/css/font-awesome.min.css">
<link rel="stylesheet" href="../../assets/css/themify-icons.css">
<link rel="stylesheet" href="../../assets/css/metisMenu.css">
<link rel="stylesheet" href="../../assets/css/owl.carousel.min.css">
<link rel="stylesheet" href="../../assets/css/slicknav.min.css">
<!-- amchart css -->
<!-- <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" /> -->
<!-- others css -->

<!--     <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css"> -->
<link rel="stylesheet" type="text/css" href="../../assets/css/dataTables.bootstrap4.min.css">

<link rel="stylesheet" href="../../assets/css/typography.css">
<link rel="stylesheet" href="../../assets/css/default-css.css">
<link rel="stylesheet" href="../../assets/css/styles.css">
<link rel="stylesheet" href="../../assets/css/responsive.css">
<link rel="stylesheet" href="../../assets/css/style2.css">


<!-- modernizr css -->
<script src="../../assets/js/vendor/modernizr-2.8.3.min.js"></script>
<script type="text/javascript" src="../../js/jquery-3.2.1.min.js"></script>
<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> -->
<link rel="stylesheet" href="../../assets/fontawesome-free-5.6.3-web/css/all.css">
<link rel="stylesheet" href="../../assets/fontawesome-free-5.6.3-web/css/all.min.css">
<script type="text/javascript" src="../../assets/fontawesome-free-5.6.3-web/js/all.js"></script>
<script type="text/javascript" src="../../assets/fontawesome-free-5.6.3-web/js/all.min.js"></script>

<!-- <script type="text/javascript" src="../../assets/js/bootbox.min.js"></script> -->

<!-- <link rel="stylesheet" type="text/css" href="../../assets/sweetalert-master/src/sweetalert.css">
<script type="text/javascript" src="../../assets/sweetalert-master/docs/assets/sweetalert/sweetalert.min.js"></script> -->

<?php 
	include('../../inc/koneksi.php');
	$loc = "../";
	//session_start();
	if(is_null($_SESSION['username'])){
        echo '<script>window.location="../../assets/403"</script>';
    }
?>

<script type="text/javascript">
	function hanyaAngka(event, id) {
	  var charCode = (event.which) ? event.which : event.keyCode
	  if (charCode > 31 && (charCode < 48 || charCode > 57)){
	    $(id).css('color', 'red');
	    $(id).html("Only Numbers!").show().fadeOut("slow");
	    return false;
	  }
	  else {
	    return true
	  }
	}
</script>


<?php
    function wordlimit($text,$limit){

    if(strlen($text)>$limit) {
        $word = substr($text, 0, $limit)."...";
    }
    else {
        $word = $text;
    }
    return $word;          
    }
?>