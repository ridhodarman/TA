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
            <a href="index.html"><img src="assets/images/icon/logo.png" alt="logo"></a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-home"></i><span>House</span></a>
                        <ul class="collapse">
                            <li><a href="javascript:void(0)" onclick="tampilsemuarumah()">Show All House</a></li>
                            <li><a href="javascript:void(0)" onclick="rumahberpenghuni()">Show Rumah Berpenghuni</a></li>
                            <li><a href="javascript:void(0)" onclick="rumahkosong()">Show Rumah Kosong</a></li>
                            <li><a href="javascript:void(0)" aria-expanded="true">Cari Berdasarkan No. KK</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Kartu Keluarga">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)" aria-expanded="true">Cari Berdasarkan Nama Pemilik</a>
                                <ul class="collapse">
                                    <li>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="nama pemilik">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    </li>
                                </ul>
                            </li>    
                            <li><a href="javascript:void(0)" aria-expanded="true">Cari Berdasarkan Radius</a>
                                <ul class="collapse">
                                    <li>
                                    <div style="color: lightgray"><b>Radius: <font id="km">0</font> m<br></b></div>
                                    <input  type="range" onchange="aktifkanRadius();" id="inputradius" name="inputradius" data-highlight="true" min="1" max="10" value="1"/>
                                    </li>
                                </ul>
                            </li>                                 
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
                                            <div class="input-group-append" style="width: 25%">
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
                            <li><a href="javascript:void(0)" onclick="tampilsemuat4ibadah">Show All Office Building</a></li>
                            <li><a href="linechart.html">line Chart</a></li>
                            <li><a href="piechart.html">pie chart</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fas fa-school"></i><span>Educational Building</span></a>
                        <ul class="collapse">
                            <li><a href="javascript:void(0)" onclick="tampilsemuat4ibadah">Show All Educational Building</a></li>
                            <li><a href="linechart.html">line Chart</a></li>
                            <li><a href="piechart.html">pie chart</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fas fa-hospital-alt"></i><span>Health Building</span></a>
                        <ul class="collapse">
                            <li><a href="javascript:void(0)" onclick="tampilsemuat4ibadah">Show All Health Building</a></li>
                            <li><a href="linechart.html">line Chart</a></li>
                            <li><a href="piechart.html">pie chart</a></li>
                        </ul>
                    </li>
                    
                    <li><a href="maps.html"><i class="ti-map-alt"></i> <span>maps</span></a></li>
                    
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
                <h5 class="modal-title">Choose MSME Facility</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
            <table width="100%" class="table table-striped table-bordered table-hover" id="listfasilitas">
                <thead>
                    <tr style="text-align: center">
                        <th>.</th>
                        <th>MSME Facility</th>
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
                <h5 class="modal-title">Choose Worship Facility</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
            <table width="100%" class="table table-striped table-bordered table-hover" id="listfasilitas">
                <thead>
                    <tr style="text-align: center">
                        <th>.</th>
                        <th>Worship Facility</th>
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
</script>