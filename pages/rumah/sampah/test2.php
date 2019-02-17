<?php
include('../../inc/koneksi.php');
include('../inc/headinfodanslideshow.php');

function tampilfoto(){
                    $id="KG033";
                    $sql = pg_query("SELECT url_photo, upload_date FROM house_building_gallery WHERE house_building_id='$id' 
                            ");
                    $cek = pg_num_rows($sql);

                    $n=0;$foto;$tglfoto;
                    $div="<div data-carousel-3d>";
                    $server='../../foto/rumah/';
                    while ($row = pg_fetch_assoc($sql)) {
                        $foto=$row['url_photo'];
                        $tglfoto=$row['upload_date'];
                        $div=$div.'
                        <div style="min-width: 320px; min-height: 213px; max-height: 700px; max-height: 500px; text-align-last: center;  vertical-align: middle; display: table-cell;">
                                <img src="'.$server.$foto.'" />
                                <label>Uploaded: '.$tglfoto.'</label>
                                <a class="icon-container" style="background-color: #d8dbff" href="'.$server.$foto[$i].'" target="_blank">
                                    <span class="ti-zoom-in"></span><span class="icon-name">Fullscreen</span>
                                </a>
                            </div>
                    ';
                    }

                    
                    if ($cek<1) {
                        $div=$div.'
                                <div style="min-width: 320px; min-height: 213px; max-height: 700px; max-height: 500px; text-align-last: center;  vertical-align: middle; display: table-cell;">
                                    <img src="../../assets/images/rumah.png" />
                                    <a class="icon-container" style="background-color: #d8dbff" href="#">
                                        <span class="ti-zoom-in"></span><span class="icon-name">No Image Available</span>
                                    </a>
                                </div>
                        ';
                    }
                    
                  
                   
                        $div=$div.'</div>';
                     
                     echo $div;
                }


                tampilfoto();

?>