<?php
    // if(isset($_SESSION['username']) ) {
        if (isset($_POST["kirim"])) {
            $id = $_POST["id-bang"];
            $tgl = $_POST["tgl"];
            include ('../../../inc/koneksi.php');
            include ('../../inc/notif-act.php');
            $jumlah = count($_FILES['gambar']['name']);
            if ($jumlah > 0) {
                for ($i=0; $i < $jumlah; $i++) { 
                    //$tipe =array('image/jpg','image/jpeg','image/pjpeg','image/png','image/x-png');
                    $extensi = pathinfo($_FILES['gambar']['name'][$i], PATHINFO_EXTENSION);
                    if($extensi=="jpg" || $extensi=="png" || $extensi=="jpeg" || $extensi=="pjpeg" || $extensi=="gif"){
                        $waktusekarang = date("Ymdhis");
                        //$namanya = base64_encode($_FILES['gambar']['name'][$i].$waktusekarang);
                        $file_name = $id."-(".$i.")".$waktusekarang.".".$extensi;
                        $tmp_name = $_FILES['gambar']['tmp_name'][$i];              
                        $sql = pg_query("INSERT INTO educational_building_gallery (educational_building_id, photo_url, upload_date) VALUES ('$id', '$file_name', '$tgl')");    

                        if ($sql) {
                            move_uploaded_file($tmp_name, "../../../foto/b-pendidikan/".$file_name);
                            echo '<script>
                                $("#sukses").modal("show");
                                </script>
                            ';
                        }
                        else {
                            echo '<script>
                            $("#gagal").modal("show");
                            </script>
                            ';
                        }
                        echo '<meta http-equiv="REFRESH" content="1;url=../info-b-pendidikan.php?id='.$id.'">';
                    }
                    else {
                        echo '<script>
                            $("#gagal").modal("show");
                            $("#notifikasi").append("<p>wrong format</p>");
                            </script>
                            <meta http-equiv="REFRESH" content="1;url=../info-b-pendidikan.php?id='.$id.'">
                            ';
                    }
                }
            }
            else{
                echo '<script>
                    $("#gagal").modal("show");
                    $("#notifikasi").append("<p>no photo uploaded</p>");
                    </script>
                    <meta http-equiv="REFRESH" content="1;url=../">
                    ';
            }
        }
    // }
    // else {
    //     echo '<script>window.location="../../../assets/403"</script>';
    // } 
?>