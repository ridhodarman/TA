<?php
include('../../inc/koneksi.php');
include('../inc/headinfodanslideshow.php');

function tampilfoto2(){

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
                    }

                    echo '<div data-carousel-3d>
                            <div style="min-width: 320px; min-height: 213px; max-height: 700px; max-height: 500px; text-align-last: center;  vertical-align: middle; display: table-cell;">
                                    <img src="./image/1.jpg" />
                                    <a class="icon-container" style="background-color: #d8dbff" href="#">
                                        <label>Uploaded: </label>
                                        <span class="ti-zoom-in"></span><span class="icon-name">No Image Available</span>
                                    </a>
                                </div>
                            <div style="min-width: 320px; min-height: 213px; max-height: 700px; max-height: 500px; text-align-last: center;  vertical-align: middle; display: table-cell;">
                                    <img src="./image/2.jpg" />
                                    <a class="icon-container" style="background-color: #d8dbff" href="#">
                                        <label>Uploaded: </label>
                                        <span class="ti-zoom-in"></span><span class="icon-name">No Image Available</span>
                                    </a>
                                </div>
                            <div style="min-width: 320px; min-height: 213px; max-height: 700px; max-height: 500px; text-align-last: center;  vertical-align: middle; display: table-cell;">
                                    <img src="./image/3.jpg" />
                                    <a class="icon-container" style="background-color: #d8dbff" href="#">
                                        <label>Uploaded: </label>
                                        <span class="ti-zoom-in"></span><span class="icon-name">No Image Available</span>
                                    </a>
                                </div>
                            <div style="min-width: 320px; min-height: 213px; max-height: 700px; max-height: 500px; text-align-last: center;  vertical-align: middle; display: table-cell;">
                                    <img src="./image/4.jpg" />
                                    <a class="icon-container" style="background-color: #d8dbff" href="#">
                                        <label>Uploaded: </label>
                                        <span class="ti-zoom-in"></span><span class="icon-name">No Image Available</span>
                                    </a>
                                </div>
                            <div style="min-width: 320px; min-height: 213px; max-height: 700px; max-height: 500px; text-align-last: center;  vertical-align: middle; display: table-cell;">
                                    <img src="./image/5.jpg" />
                                    <a class="icon-container" style="background-color: #d8dbff" href="#">
                                        <label>Uploaded: </label>
                                        <span class="ti-zoom-in"></span><span class="icon-name">No Image Available</span>
                                    </a>
                                </div>
                    ';
                }


                tampilfoto2();

?>