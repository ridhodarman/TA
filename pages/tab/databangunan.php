<?php
    $rumah=pg_num_rows(pg_query("SELECT house_building_id FROM house_building"));
    $umkm=pg_num_rows(pg_query("SELECT msme_building_id FROM msme_building"));
    $pendidikan=pg_num_rows(pg_query("SELECT educational_building_id FROM educational_building"));
    $kesehatan=pg_num_rows(pg_query("SELECT health_building_id FROM health_building"));
    $ibadah=pg_num_rows(pg_query("SELECT worship_building_id FROM worship_building"));
    $kantor=pg_num_rows(pg_query("SELECT office_building_id FROM office_building"));
?>
<div class="main-content-inner">
     <div class="row">
         <div class="col-lg-12">
            <div class="row">

                <div class="col-md-6 mt-5 mb-3">
                    <div class="card">
                        <a href="ibadah">
                        <div class="seo-fact sbg2">
                            <div class="p-4 d-flex justify-content-between align-items-center">
                                <div class="seofct-icon"><i class="fas fa-mosque fa-3x"></i> Worship Building</div>
                                <h2><?php echo $ibadah; ?><br/><small style="font-size: 45%;">View Details</small></h2>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-6 mt-5 mb-3">
                    <div class="card">
                        <a href="rumah">
                        <div class="seo-fact cokelat">
                            <div class="p-4 d-flex justify-content-between align-items-center">
                                <div class="seofct-icon"><i class="ti-home"></i> House Building</div>
                                <h2><?php echo $rumah; ?><br/><small style="font-size: 45%;">View Details</small></h2>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-6 mt-5 mb-3">
                    <div class="card">
                        <a href="kantor">
                        <div class="seo-fact sbg1">
                            <div class="p-4 d-flex justify-content-between align-items-center">
                                <div class="seofct-icon"><i class="fas fa-university fa-3x"></i> Office Building</div>
                                <h2><?php echo $kantor; ?><br/><small style="font-size: 45%;">View Details</small></h2>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-6 mt-5 mb-3">
                    <div class="card">
                        <a href="pendidikan">
                        <div class="seo-fact hitam">
                            <div class="p-4 d-flex justify-content-between align-items-center">
                                <div class="seofct-icon"><i class="fas fa-school fa-3x"></i> Educational Building</div>
                                <h2><?php echo $pendidikan; ?><br/><small style="font-size: 45%;">View Details</small></h2>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-6 mt-5 mb-3">
                    <div class="card">
                        <a href="kesehatan">
                        <div class="seo-fact sbg3">
                            <div class="p-4 d-flex justify-content-between align-items-center">
                                <div class="seofct-icon"><i class="fas fa-hospital fa-3x"></i> Health Building</div>
                                <h2><?php echo $kesehatan; ?><br/><small style="font-size: 45%;">View Details</small></h2>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-6 mt-5 mb-3">
                    <div class="card">
                        <a href="umkm">
                        <div class="seo-fact ungu">
                            <div class="p-4 d-flex justify-content-between align-items-center">
                                <div class="seofct-icon">
                                    <div class="row">
                                        <div class="col-sm-2"><i class="fas fa-store-alt fa-3x"></i></div>
                                        <div class="col-sm-7">MSME<small> (Micro, Small & Medium Enterprises) Building</small></div>
                                        <div class="col-sm-3"><h2><?php echo $umkm; ?><br/><small style="font-size: 45%;">View Details</small></h2></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>

            </div>
        </div>
     </div>
</div>