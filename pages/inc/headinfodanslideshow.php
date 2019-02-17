<script src="../inc/slideshow/jquery.resize.js"></script>
<script src="../inc/slideshow/jquery.waitforimages.min.js"></script>
<script src="../inc/slideshow/modernizr.js"></script>
<script src="../inc/slideshow/jquery.carousel-3d.js"></script>
<link rel="stylesheet" href="../inc/slideshow/jquery.carousel-3d.default.css">
<link rel="stylesheet" href="../../assets/alertify/themes/alertify.core.css" />
<link rel="stylesheet" href="../../assets/alertify/themes/alertify.default.css" id="toggleCSS" />
<meta name="viewport" content="width=device-width">
<script src="../../assets/alertify/lib/alertify.min.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDM2fDXHmGzCDmDBk3bdPIEjs6zwnI1kGQ&libraries=drawing"></script> 

<script type="text/javascript">
//untuk validasi hanya angka pada kolom input tahun
    $(document).ready(function(){
        $("input[name='tahun']").keypress(function(data){
        	if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {	
            	$("#tahun").css('color', 'red');
                $("#tahun").html("Only Numbers").show().fadeOut("slow");
                return false;
            }
        });
    });

//untuk validasi hanya angka pada kolom input pbb
    $(document).ready(function(){
        $("input[name='pbb']").keypress(function(data){
        	if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {	
            	$("#pbb").css('color', 'red');
                $("#pbb").html("Only Numbers").show().fadeOut("slow");
                return false;
            }
        });
    });


    // function hanyaAngka (id){
    // data=$("#"+id).val();
    // ////alert(data)
    // if(data.which!=8 && data.which!=0 && (data.which<48 || data>57))
    // {   alert("huruf")
    //     $("#"+id+"s").css('color', 'red');
    //     $("#"+id+"s").html("Only Numbers").show().fadeOut("slow");
    //     return false;
    // }
    // }

    function reset () {
        $("#toggleCSS").attr("href", "../../assets/alertify/themes/alertify.default.css");
        alertify.set({
            labels : {
                ok     : "OK",
                cancel : "Cancel"
            },
            delay : 5000,
            buttonReverse : false,
            buttonFocus   : "ok"
        });
    }
</script>

<script type="text/javascript" src="../../assets/DataTables-1.10.19/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../../assets/DataTables-1.10.19/media/js/dataTables.bootstrap4.min.js"></script>