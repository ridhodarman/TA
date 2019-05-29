<style type="text/css">
    input,
select {
  box-sizing: content-box;
  width: 70%
}
.putih {
    background-color: white;
}
</style>
<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="javascript:void(0)"><img src="inc/m.png" width="50px" /><h6 style="color: white;">GIS KOTO GADANG</h6></a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-home"></i><span>House</span></a>
                        <ul class="collapse">
                            <li><a href="javascript:void(0)" aria-expanded="true">Search By Survey ID</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group mb-3">
                                        <input type="text" aria-label="Text input with dropdown button" id="id-rumah">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" onclick="cari_idrumah()"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    </li>
                                </ul>
                            </li>
                            <li name="terbatas"><a href="javascript:void(0)" aria-expanded="true">Search By Owner Name</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group mb-3">
                                        <input type="text" aria-label="Text input with dropdown button" id="pemilik">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" onclick="cari_pemilik()"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    </li>
                                </ul>
                            </li>
                            <li name="terbatas"><a href="javascript:void(0)" aria-expanded="true">Search By National ID Number of Owner</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group mb-3">
                                        <input type="text" aria-label="Text input with dropdown button" id="nikpemilik">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" onclick="cari_nikpemilik()"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    </li>
                                </ul>
                            </li>
                            <li name="terbatas"><a href="javascript:void(0)" aria-expanded="true">Search By Name of Householder</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group mb-3">
                                        <input type="text" aria-label="Text input with dropdown button" id="penghuni">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" onclick="cari_penghuni()"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    </li>
                                </ul>
                            </li>
                            <li name="terbatas"><a href="javascript:void(0)" aria-expanded="true">Search By National ID Number of Householder</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group mb-3">
                                        <input type="text" aria-label="Text input with dropdown button" id="nikpenghuni">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" onclick="cari_nikpenghuni()"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    </li>
                                </ul>
                            </li>
                            <li name="terbatas"><a href="javascript:void(0)" aria-expanded="true">Search By Family Card Number of Householder</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group mb-3">
                                        <input type="text" aria-label="Text input with dropdown button" id="kk">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" onclick="cari_kk()"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    </li>
                                </ul>
                            </li> 
                            <li name="terbatas"><a href="javascript:void(0)" aria-expanded="true">Search By Tribe of Owner</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group mb-3">
                                        <select aria-label="Text input with dropdown button" id="suku">
                                            <?php                
                                                $sql_s=pg_query("SELECT * FROM tribe ORDER BY name_of_tribe");
                                                while($row = pg_fetch_assoc($sql_s))
                                                {
                                                    echo"<option value=".$row['tribe_id'].">".$row['name_of_tribe']."</option>";
                                                }
                                            ?>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" onclick="cari_suku()"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    </li>
                                </ul>
                            </li> 
<!--                             <li name="terbatas"><a href="javascript:void(0)" aria-expanded="true">Search By Income of Head Family</a>
                                <ul class="collapse">
                                    <li>
                                        <label style="color: white">Form:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Rp</div>
                                            </div>
                                            <input type="text" id="penghasilan1" onkeyup="ceknominal1()">
                                        </div>
                                        <br/>
                                        <label style="color: white">Until:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Rp</div>
                                            </div>
                                            <input type="text" id="penghasilan2" onkeyup="ceknominal2()">
                                        </div>
                                        <br/>
                                        <button class="btn btn-primary btn-sm" type="button" onclick="cari_pendapatan()" style="width: 90%"><i class="fa fa-search"></i> <b>search</b></button>
                                    </li>
                                </ul>
                            </li> -->
                            <li name="terbatas"><a href="javascript:void(0)" aria-expanded="true">Search By Village of Head Family</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group mb-3">
                                        <select aria-label="Text input with dropdown button" id="kampung">
                                            <?php                
                                                $sql_k=pg_query("SELECT * FROM village ORDER BY village_name");
                                                while($row = pg_fetch_assoc($sql_k))
                                                {
                                                    echo"<option value=".$row['village_id'].">".$row['village_name']."</option>";
                                                }
                                            ?>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" onclick="cari_kampung()"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    </li>
                                </ul>
                            </li> 
                            <li name="terbatas"><a href="javascript:void(0)" aria-expanded="true">Search By Education Level of Head Family</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group mb-3">
                                        <select aria-label="Text input with dropdown button" id="pendkk">
                                            <?php                
                                                $sql_e=pg_query("SELECT * FROM education ORDER BY educational_level");
                                                while($row = pg_fetch_assoc($sql_e))
                                                {
                                                    echo"<option value=".$row['education_id'].">".$row['educational_level']."</option>";
                                                }
                                            ?>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" onclick="cari_pendkk()"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    </li>
                                </ul>
                            </li> 
                            <li name="terbatas"><a href="javascript:void(0)" aria-expanded="true">Search By Construction Type</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group mb-3">
                                        <select aria-label="Text input with dropdown button" id="jeniskons_rumah">
                                            <?php                
                                                $sql_j=pg_query("SELECT * FROM type_of_construction ORDER BY name_of_type");
                                                while($row = pg_fetch_assoc($sql_j))
                                                {
                                                    echo"<option value=".$row['type_id'].">".$row['name_of_type']."</option>";
                                                }
                                            ?>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" onclick="carikons_rumah()"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    </li>
                                </ul>
                            </li>  
                            <li name="terbatas"><a href="javascript:void(0)" aria-expanded="true">Search By Standing Year</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group">
                                        <p aria-label="Amount (to the nearest dollar)">
                                            <div class="input-group-append" style="width: 28%">
                                                <input type="text" id="rumah_awaltahun" class="input-group-text putih" onkeypress="return hanyaAngka(event)" placeholder="from"/>
                                                <span class="input-group-text">-</span>
                                                <input type="text" id="rumah_akhirtahun" class="input-group-text putih" onkeypress="return hanyaAngka(event)" placeholder="until"/>
                                                <button class="btn btn-primary input-group-text" onclick="caritahun_rumah()"><i class="fa fa-search"></i></button>
                                            </div>
                                        </p>
                                    </div>
                                    </li>
                                </ul>
                            </li>     
                            <li name="terbatas"><a href="javascript:void(0)" aria-expanded="true">Search By Electricity Capacity</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group">
                                        <p aria-label="Amount (to the nearest dollar)">
                                            <div class="input-group-append" style="width: 25%">
                                                <input type="text" id="rumah_awallistrik" class="input-group-text putih" onkeypress="return hanyaAngka(event)" placeholder="from" />
                                                <span class="input-group-text">-</span>
                                                <input type="text" id="rumah_akhirlistrik" class="input-group-text putih" onkeypress="return hanyaAngka(event)" placeholder="until"/>
                                                <button class="btn btn-primary input-group-text" onclick="carilistrik_rumah()"><i class="fa fa-search"></i></button>
                                            </div>
                                        </p>
                                    </div>
                                    </li>
                                </ul>
                            </li>
                            <li name="terbatas"><a href="javascript:void(0)" onclick="rumahberpenghuni()">Show inhabited houses</a></li>
                            <li name="terbatas"><a href="javascript:void(0)" onclick="rumahkosong()">Show uninhabited houses</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true" title="Micro, Small, Medium Enterphrise"><i class="fas fa-store-alt"></i><span>MSME
                            </span></a>
                        <ul class="collapse">
                            <li><a href="javascript:void(0)" onclick="tampilsemuaumkm()">Show All MSME Buildings</a></li>
                            <li><a href="javascript:void(0)" aria-expanded="true">Search By Name</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group mb-3">
                                        <input type="text" aria-label="Text input with dropdown button" id="namaumkm">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" onclick="carinamaumkm()"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    </li>
                                </ul>
                            </li> 
                            <li><a href="javascript:void(0)" aria-expanded="true">Search By Type</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group mb-3">
                                        <select aria-label="Text input with dropdown button" id="jenisumkm">
                                            <?php                
                                                $sql_j=pg_query("SELECT * FROM type_of_msme ORDER BY name_of_type");
                                                while($row = pg_fetch_assoc($sql_j))
                                                {
                                                    echo"<option value=".$row['type_id'].">".$row['name_of_type']."</option>";
                                                }
                                            ?>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" onclick="carijenis_umkm()"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)" aria-expanded="true">Search By Construction Type</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group mb-3">
                                        <select aria-label="Text input with dropdown button" id="jeniskons_umkm">
                                            <?php                
                                                $sql_j=pg_query("SELECT * FROM type_of_construction ORDER BY name_of_type");
                                                while($row = pg_fetch_assoc($sql_j))
                                                {
                                                    echo"<option value=".$row['type_id'].">".$row['name_of_type']."</option>";
                                                }
                                            ?>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" onclick="carikons_umkm()"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)" aria-expanded="true">Search By Radius</a>
                                <ul class="collapse">
                                    <li>
                                    <div style="color: lightgray"><b>Radius: <font id="km_umkm">0</font> m<br></b></div>
                                    <input  type="range" onchange="aktifkanRadiusumkm();" id="inputradiusumkm" name="inputradius" data-highlight="true" min="1" max="10" value="1"/>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)" aria-expanded="true">Search By Jorong</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group mb-3">
                                        <select aria-label="Text input with dropdown button" id="jorong_umkm">
                                            <?php                
                                                $sql_j=pg_query("SELECT * FROM jorong ORDER BY name_of_jorong");
                                                while($row = pg_fetch_assoc($sql_j))
                                                {
                                                    echo"<option value=".$row['jorong_id'].">".$row['name_of_jorong']."</option>";
                                                }
                                            ?>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" onclick="carijorong_umkm()"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)" data-toggle="modal" data-target="#fas-umkm">Search By Facility</a>
                            </li>
                            <li name="terbatas"><a href="javascript:void(0)" aria-expanded="true">Search By Monthly Income</a>
                                <ul class="collapse">
                                    <li>
                                        <label style="color: white">Form:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Rp</div>
                                            </div>
                                            <input type="text" id="penghasilan-umkm1" onkeyup="ceknominal_umkm1()">
                                        </div>
                                        <br/>
                                        <label style="color: white">Until:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Rp</div>
                                            </div>
                                            <input type="text" id="penghasilan-umkm2" onkeyup="ceknominal_umkm2()">
                                        </div>
                                        <br/>
                                        <button class="btn btn-primary btn-sm" type="button" onclick="cari_pendumkm()" style="width: 90%"><i class="fa fa-search"></i> <b>search</b></button>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fas fa-mosque"></i><span>Worship Building</span></a>
                        <ul class="collapse">
                            <li><a href="javascript:void(0)" onclick="tampilsemuaibadah()">Show All Worship Building</a></li>
                            <li><a href="javascript:void(0)" aria-expanded="true">Search By Name</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group mb-3">
                                        <input type="text" aria-label="Text input with dropdown button" id="namaibadah">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" onclick="carinamaibadah()"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)" aria-expanded="true">Search By Type</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group mb-3">
                                        <select aria-label="Text input with dropdown button" id="jenisibadah">
                                            <?php                
                                                $sql_j=pg_query("SELECT * FROM type_of_worship ORDER BY name_of_type");
                                                while($row = pg_fetch_assoc($sql_j))
                                                {
                                                    echo"<option value=".$row['type_id'].">".$row['name_of_type']."</option>";
                                                }
                                            ?>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" onclick="carijenis_ibadah()"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)" aria-expanded="true">Search By Construction Type</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group mb-3">
                                        <select aria-label="Text input with dropdown button" id="jeniskons_ibadah">
                                            <?php                
                                                $sql_j=pg_query("SELECT * FROM type_of_construction ORDER BY name_of_type");
                                                while($row = pg_fetch_assoc($sql_j))
                                                {
                                                    echo"<option value=".$row['type_id'].">".$row['name_of_type']."</option>";
                                                }
                                            ?>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" onclick="carikons_ibadah()"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)" aria-expanded="true">Search By Building Area</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group">
                                        <p aria-label="Amount (to the nearest dollar)">
                                            <div class="input-group-append" style="width: 25%">
                                                <input type="text" id="ibadah_awalbang" class="input-group-text putih" onkeypress="return hanyaAngka(event)" placeholder="from" />
                                                <span class="input-group-text">-</span>
                                                <input type="text" id="ibadah_akhirbang" class="input-group-text putih" onkeypress="return hanyaAngka(event)" placeholder="until"/>
                                                <button class="btn btn-primary input-group-text" onclick="cariluasbang_ibadah()"><i class="fa fa-search"></i></button>
                                            </div>
                                        </p>
                                    </div>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)" aria-expanded="true">Search By Land Area</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group">
                                        <p aria-label="Amount (to the nearest dollar)">
                                            <div class="input-group-append" style="width: 25%">
                                                <input type="text" id="ibadah_awaltanah" class="input-group-text putih" onkeypress="return hanyaAngka(event)" placeholder="from"/>
                                                <span class="input-group-text">-</span>
                                                <input type="text" id="ibadah_akhirtanah" class="input-group-text putih" onkeypress="return hanyaAngka(event)" placeholder="until"/>
                                                <button class="btn btn-primary input-group-text" onclick="cariluastanah_ibadah()"><i class="fa fa-search"></i></button>
                                            </div>
                                        </p>
                                    </div>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)" aria-expanded="true">Search By Standing Year</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group">
                                        <p aria-label="Amount (to the nearest dollar)">
                                            <div class="input-group-append" style="width: 28%">
                                                <input type="text" id="ibadah_awaltahun" class="input-group-text putih" onkeypress="return hanyaAngka(event)" placeholder="from"/>
                                                <span class="input-group-text">-</span>
                                                <input type="text" id="ibadah_akhirtahun" class="input-group-text putih" onkeypress="return hanyaAngka(event)" placeholder="until"/>
                                                <button class="btn btn-primary input-group-text" onclick="caritahun_ibadah()"><i class="fa fa-search"></i></button>
                                            </div>
                                        </p>
                                    </div>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)" aria-expanded="true">Search By Radius</a>
                                <ul class="collapse">
                                    <li>
                                    <div style="color: lightgray"><b>Radius: <font id="m_ibadah">0</font> m<br></b></div>
                                    <input  type="range" onchange="aktifkanRadiusibadah();" id="inputradiusibadah" name="inputradius" data-highlight="true" min="1" max="10" value="1"/>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)" aria-expanded="true">Search By Jorong</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group mb-3">
                                        <select aria-label="Text input with dropdown button" id="jorong_ibadah">
                                            <?php                
                                                $sql_j=pg_query("SELECT * FROM jorong ORDER BY name_of_jorong");
                                                while($row = pg_fetch_assoc($sql_j))
                                                {
                                                    echo"<option value=".$row['jorong_id'].">".$row['name_of_jorong']."</option>";
                                                }
                                            ?>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" onclick="carijorong_ibadah()"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)" data-toggle="modal" data-target="#fas-ibadah">Search By Facility</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-bank"></i><span>Office Building</span></a>
                        <ul class="collapse">
                            <li><a href="javascript:void(0)" onclick="tampilsemuakantor()">Show All Office Buildings</a></li>
                            <li><a href="javascript:void(0)" aria-expanded="true">Search By Name</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group mb-3">
                                        <input type="text" aria-label="Text input with dropdown button" id="namakantor">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" onclick="carinamakantor()"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)" aria-expanded="true">Search By Type</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group mb-3">
                                        <select aria-label="Text input with dropdown button" id="jeniskantor">
                                            <?php                
                                                $sql_j=pg_query("SELECT * FROM type_of_office ORDER BY name_of_type");
                                                while($row = pg_fetch_assoc($sql_j))
                                                {
                                                    echo"<option value=".$row['type_id'].">".$row['name_of_type']."</option>";
                                                }
                                            ?>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" onclick="carijenis_kantor()"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)" aria-expanded="true">Search By Construction Type</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group mb-3">
                                        <select aria-label="Text input with dropdown button" id="jeniskons_kantor">
                                            <?php                
                                                $sql_j=pg_query("SELECT * FROM type_of_construction ORDER BY name_of_type");
                                                while($row = pg_fetch_assoc($sql_j))
                                                {
                                                    echo"<option value=".$row['type_id'].">".$row['name_of_type']."</option>";
                                                }
                                            ?>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" onclick="carikons_kantor()"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)" aria-expanded="true">Search By Standing Year</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group">
                                        <p aria-label="Amount (to the nearest dollar)">
                                            <div class="input-group-append" style="width: 28%">
                                                <input type="text" id="kantor_awaltahun" class="input-group-text putih" onkeypress="return hanyaAngka(event)" placeholder="from"/>
                                                <span class="input-group-text">-</span>
                                                <input type="text" id="kantor_akhirtahun" class="input-group-text putih" onkeypress="return hanyaAngka(event)" placeholder="until"/>
                                                <button class="btn btn-primary input-group-text" onclick="caritahun_kantor()"><i class="fa fa-search"></i></button>
                                            </div>
                                        </p>
                                    </div>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)" aria-expanded="true">Search By Radius</a>
                                <ul class="collapse">
                                    <li>
                                    <div style="color: lightgray"><b>Radius: <font id="m_kantor">0</font> m<br></b></div>
                                    <input  type="range" onchange="aktifkanRadiuskantor();" id="inputradiuskantor" name="inputradius" data-highlight="true" min="1" max="10" value="1"/>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)" aria-expanded="true">Search By Jorong</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group mb-3">
                                        <select aria-label="Text input with dropdown button" id="jorong_kantor">
                                            <?php                
                                                $sql_j=pg_query("SELECT * FROM jorong ORDER BY name_of_jorong");
                                                while($row = pg_fetch_assoc($sql_j))
                                                {
                                                    echo"<option value=".$row['jorong_id'].">".$row['name_of_jorong']."</option>";
                                                }
                                            ?>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" onclick="carijorong_kantor()"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)" data-toggle="modal" data-target="#fas-kantor">Search By Facility</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fas fa-school"></i><span>Educational Building</span></a>
                        <ul class="collapse">
                            <li><a href="javascript:void(0)" onclick="tampilsemuapendidikan()">Show All Educational Building</a></li>
                            <li><a href="javascript:void(0)" aria-expanded="true">Search By Name</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group mb-3">
                                        <input type="text" aria-label="Text input with dropdown button" id="namapendidikan">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" onclick="carinamapendidikan()"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)" aria-expanded="true">Search By Education Level</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group mb-3">
                                        <select aria-label="Text input with dropdown button" id="jenispendidikan">
                                            <?php                
                                                $sql_j=pg_query("SELECT * FROM level_of_education ORDER BY name_of_level");
                                                while($row = pg_fetch_assoc($sql_j))
                                                {
                                                    echo"<option value=".$row['level_id'].">".$row['name_of_level']."</option>";
                                                }
                                            ?>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" onclick="carijenis_pendidikan()"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)" aria-expanded="true">Search By Type</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group mb-3">
                                        <select aria-label="Text input with dropdown button" id="tipependidikan">
                                            <option value="0">Public School</option>
                                            <option value="1">Private School</option>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" onclick="caritipe_pendidikan()"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)" aria-expanded="true">Search By Building Area</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group">
                                        <p aria-label="Amount (to the nearest dollar)">
                                            <div class="input-group-append" style="width: 25%">
                                                <input type="text" id="pendidikan_awalbang" class="input-group-text putih" onkeypress="return hanyaAngka(event)" placeholder="from" />
                                                <span class="input-group-text">-</span>
                                                <input type="text" id="pendidikan_akhirbang" class="input-group-text putih" onkeypress="return hanyaAngka(event)" placeholder="until"/>
                                                <button class="btn btn-primary input-group-text" onclick="cariluasbang_pendidikan()"><i class="fa fa-search"></i></button>
                                            </div>
                                        </p>
                                    </div>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)" aria-expanded="true">Search By Land Area</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group">
                                        <p aria-label="Amount (to the nearest dollar)">
                                            <div class="input-group-append" style="width: 25%">
                                                <input type="text" id="pendidikan_awaltanah" class="input-group-text putih" onkeypress="return hanyaAngka(event)" placeholder="from"/>
                                                <span class="input-group-text">-</span>
                                                <input type="text" id="pendidikan_akhirtanah" class="input-group-text putih" onkeypress="return hanyaAngka(event)" placeholder="until"/>
                                                <button class="btn btn-primary input-group-text" onclick="cariluastanah_pendidikan()"><i class="fa fa-search"></i></button>
                                            </div>
                                        </p>
                                    </div>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)" aria-expanded="true">Search By Construction Type</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group mb-3">
                                        <select aria-label="Text input with dropdown button" id="jeniskons_pendidikan">
                                            <?php                
                                                $sql_j=pg_query("SELECT * FROM type_of_construction ORDER BY name_of_type");
                                                while($row = pg_fetch_assoc($sql_j))
                                                {
                                                    echo"<option value=".$row['type_id'].">".$row['name_of_type']."</option>";
                                                }
                                            ?>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" onclick="carikons_pendidikan()"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)" aria-expanded="true">Search By Radius</a>
                                <ul class="collapse">
                                    <li>
                                    <div style="color: lightgray"><b>Radius: <font id="m_pendidikan">0</font> m<br></b></div>
                                    <input  type="range" onchange="aktifkanRadiuspendidikan();" id="inputradiuspendidikan" data-highlight="true" min="1" max="10" value="0"/>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)" aria-expanded="true">Search By Jorong</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group mb-3">
                                        <select aria-label="Text input with dropdown button" id="jorong_pendidikan">
                                            <?php                
                                                $sql_j=pg_query("SELECT * FROM jorong ORDER BY name_of_jorong");
                                                while($row = pg_fetch_assoc($sql_j))
                                                {
                                                    echo"<option value=".$row['jorong_id'].">".$row['name_of_jorong']."</option>";
                                                }
                                            ?>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" onclick="carijorong_pendidikan()"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#fas-pendidikan">Search By Facility</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fas fa-hospital-alt"></i><span>Health Building</span></a>
                        <ul class="collapse">
                            <li><a href="javascript:void(0)" onclick="tampilsemuakesehatan()">Show All Health Building</a></li>
                            <li><a href="javascript:void(0)" aria-expanded="true">Search By Name</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group mb-3">
                                        <input type="text" aria-label="Text input with dropdown button" id="namakesehatan">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" onclick="carinamakesehatan()"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)" aria-expanded="true">Search By Type</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group mb-3">
                                        <select aria-label="Text input with dropdown button" id="jeniskesehatan">
                                            <?php                
                                                $sql_j=pg_query("SELECT * FROM type_of_health_building ORDER BY name_of_type");
                                                while($row = pg_fetch_assoc($sql_j))
                                                {
                                                    echo"<option value=".$row['type_id'].">".$row['name_of_type']."</option>";
                                                }
                                            ?>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" onclick="carijenis_kesehatan()"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)" aria-expanded="true">Search By Jorong</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group mb-3">
                                        <select aria-label="Text input with dropdown button" id="jorong_kesehatan">
                                            <?php                
                                                $sql_j=pg_query("SELECT * FROM jorong ORDER BY name_of_jorong");
                                                while($row = pg_fetch_assoc($sql_j))
                                                {
                                                    echo"<option value=".$row['jorong_id'].">".$row['name_of_jorong']."</option>";
                                                }
                                            ?>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" onclick="carijorong_kesehatan()"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)" aria-expanded="true">Search By Radius</a>
                                <ul class="collapse">
                                    <li>
                                    <div style="color: lightgray"><b>Radius: <font id="m_kesehatan">0</font> m<br></b></div>
                                    <input  type="range" onchange="aktifkanRadiuskesehatan();" id="inputradiuskesehatan" data-highlight="true" min="1" max="10" value="0"/>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#fas-kesehatan">Search By Facility</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fas fa-house-damage"></i><span>Search by Building Model
                            </span></a>
                        <ul class="collapse">
                            <li>
                                <div class="input-group mb-3">
                                        <select aria-label="Text input with dropdown button" id="model">
                                            <?php                
                                                $sql_m=pg_query("SELECT * FROM building_model ORDER BY name_of_model");
                                                while($row = pg_fetch_assoc($sql_m))
                                                {
                                                    echo"<option value=".$row['model_id'].">".$row['name_of_model']."</option>";
                                                }
                                            ?>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" onclick="carimodel()"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                            </li>
                        </ul>
                    </ul>
                </ul>
            </nav>
        </div>
    </div>
</div>


<!-- FASILITAS UMKM -->
<div class="modal fade bd-example-modal-sm" id="fas-umkm">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Choose MSME Facilities</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
            <table width="100%" class="table table-striped table-bordered table-hover" id="listfasilitas">
                <thead>
                    <tr style="text-align: center">
                        <th>.</th>
                        <th>MSME Facilities</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql=pg_query("SELECT * FROM msme_building_facilities ORDER BY name_of_facility ASC");
                        while ($data=pg_fetch_assoc($sql)) {
                            $id=$data['facility_id'];
                            $fas=$data['name_of_facility'];
                            echo "<tr>";
                            echo '<td><center><input type="checkbox" class="form-control" value="'.$id.'" name="fas_umkm"/></center></td>';
                            echo "<td><center>".$fas."</center></td>";
                            echo "</tr>";  
                        }
                    ?>
                </tbody>
            </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="carifasilitas_umkm()"><i class="fa fa-search"></i> Search</button>
            </div>
        </div>
    </div>
</div>

<!-- FASILITAS IBADAH -->
<div class="modal fade bd-example-modal-sm" id="fas-ibadah">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Choose Worship Facility</h6>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
            <table width="100%" class="table table-striped table-bordered table-hover" id="listfasilitas">
                <thead>
                    <tr style="text-align: center">
                        <th>.</th>
                        <th>Worship Facilities</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql=pg_query("SELECT * FROM worship_building_facilities ORDER BY name_of_facility ASC");
                        while ($data=pg_fetch_assoc($sql)) {
                            $id=$data['facility_id'];
                            $fas=$data['name_of_facility'];
                            echo "<tr>";
                            echo '<td><center><input type="checkbox" class="form-control" value="'.$id.'" name="fas_ibadah"/></center></td>';
                            echo "<td><center>".$fas."</center></td>";
                            echo "</tr>";  
                        }
                    ?>
                </tbody>
            </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="carifasilitas_ibadah()"><i class="fa fa-search"></i> Search</button>
            </div>
        </div>
    </div>
</div>

<!-- FASILITAS IBADAH -->
<div class="modal fade bd-example-modal-sm" id="fas-kantor">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Choose Office Facilities</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
            <table width="100%" class="table table-striped table-bordered table-hover" id="listfasilitas">
                <thead>
                    <tr style="text-align: center">
                        <th>.</th>
                        <th>Worship Facilities</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql=pg_query("SELECT * FROM office_building_facilities ORDER BY name_of_facility ASC");
                        while ($data=pg_fetch_assoc($sql)) {
                            $id=$data['facility_id'];
                            $fas=$data['name_of_facility'];
                            echo "<tr>";
                            echo '<td><center><input type="checkbox" class="form-control" value="'.$id.'" name="fas_kantor"/></center></td>';
                            echo "<td><center>".$fas."</center></td>";
                            echo "</tr>";  
                        }
                    ?>
                </tbody>
            </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="carifasilitas_kantor()"><i class="fa fa-search"></i> Search</button>
            </div>
        </div>
    </div>
</div>

<!-- FASILITAS PENDIDIKAN -->
<div class="modal fade bd-example-modal-sm" id="fas-pendidikan">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Choose Educational Facilities</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
            <table width="100%" class="table table-striped table-bordered table-hover" id="listfasilitas">
                <thead>
                    <tr style="text-align: center">
                        <th>.</th>
                        <th>Educational Facilities</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql=pg_query("SELECT * FROM educational_building_facilities ORDER BY name_of_facility ASC");
                        while ($data=pg_fetch_assoc($sql)) {
                            $id=$data['facility_id'];
                            $fas=$data['name_of_facility'];
                            echo "<tr>";
                            echo '<td><center><input type="checkbox" class="form-control" value="'.$id.'" name="fas_pendidikan"/></center></td>';
                            echo "<td><center>".$fas."</center></td>";
                            echo "</tr>";  
                        }
                    ?>
                </tbody>
            </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="carifasilitas_pendidikan()"><i class="fa fa-search"></i> Search</button>
            </div>
        </div>
    </div>
</div>

<!-- FASILITAS KESEHATAN -->
<div class="modal fade bd-example-modal-sm" id="fas-kesehatan">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Choose health facilities</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
            <table width="100%" class="table table-striped table-bordered table-hover" id="listfasilitas">
                <thead>
                    <tr style="text-align: center">
                        <th>.</th>
                        <th>Health facility</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql=pg_query("SELECT * FROM health_building_facilities ORDER BY name_of_facility ASC");
                        while ($data=pg_fetch_assoc($sql)) {
                            $id=$data['facility_id'];
                            $fas=$data['name_of_facility'];
                            echo "<tr>";
                            echo '<td><center><input type="checkbox" class="form-control" value="'.$id.'" name="fas_kesehatan"/></center></td>';
                            echo "<td><center>".$fas."</center></td>";
                            echo "</tr>";  
                        }
                    ?>
                </tbody>
            </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="carifasilitas_kesehatan()"><i class="fa fa-search"></i> Search</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function hanyaAngka(event) {
      var charCode = (event.which) ? event.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57)){
        return false;
      }
      else {
        return true
      }
    }

    function ceknominal1() {
        var rupiah = document.getElementById('penghasilan1');
        rupiah.value = formatRupiah(rupiah.value, '');
    }

    function ceknominal2() {
        var rupiah = document.getElementById('penghasilan2');
        rupiah.value = formatRupiah(rupiah.value, '');
    }

    function ceknominal_umkm1() {
        var rupiah = document.getElementById('penghasilan-umkm1');
        rupiah.value = formatRupiah(rupiah.value, '');
    }

    function ceknominal_umkm2() {
        var rupiah = document.getElementById('penghasilan-umkm2');
        rupiah.value = formatRupiah(rupiah.value, '');
    }

    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split           = number_string.split(','),
        sisa            = split[0].length % 3,
        rupiah          = split[0].substr(0, sisa),
        ribuan          = split[0].substr(sisa).match(/\d{3}/gi);
     
        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
     
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
    }
</script>

<?php
    if ($akses==true) {
        echo '
            <script>
                $("[name='."'".'terbatas'."'".']").show()
            </script>
        ';
    }
    else {
        echo '
            <script>
                $("[name='."'".'terbatas'."'".']").hide()
            </script>
        ';  
    }
?>