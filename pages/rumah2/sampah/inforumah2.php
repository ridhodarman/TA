
    <?php 
        include('../../inc/koneksi.php');
        include('../inc/headinfodanslideshow.php');

  
                $id=null;

                $querysearch = "SELECT H.national_identity_owner, H.address, H.standing_year, H.land_building_tax, H.type_of_construction, H.electricity_capacity, H.tap_water, H.building_status,
                                ST_X(ST_Centroid(H.geom)) AS longitude, ST_Y(ST_CENTROID(H.geom)) As latitude,
                                T.name_of_type as jkonstruksi,
                                O.*
					            FROM house_building as H
                                LEFT JOIN type_of_construction as T ON H.type_of_construction=T.type_id
                                JOIN house_building_owner as O ON H.national_identity_owner=O.national_identity_number
                                
				            ";

                $hasil = pg_query($querysearch);
                while ($row = pg_fetch_array($hasil)) {
                    $tgl="null";$pendapatan="null";$pendidikan="null";$pekerjaan="null";$asuransi="null";$tabungan="null";$kampung=$datuk="null";

                    echo '<br>'.$longitude = $row['longitude'];
                    echo '<br>'.$latitude = $row['latitude'];
                    echo '<br>'.$nik = $row['national_identity_owner'];
                    echo '<br>'.$alamat = $row['address'];
                    echo '<br>'.$tahun = $row['standing_year'];
                    echo '<br>'.$pbb = $row['land_building_tax'];
                    echo '<br>'.$jkonstruksi = $row['jkonstruksi'];
                    echo '<br>'.$listrik = $row['electricity_capacity'];
                    echo '<br>'.$pdam=$row['tap_water'];
                    echo '<br>'.$status=$row['building_status'];

                    echo '<br>'.$nama = $row['owner_name'];
                    echo '<br>'.$nokk = $row['family_card_number'];
                    echo '<br>'.$tgl = $row['birth_date'];
                    echo '<br>'.$pendidikan = $row['educational_id'];
                    echo '<br>'.$pekerjaan = $row['job_id'];
                    
                    echo '<br>'.$asuransi= $row['savings'];

                    echo '<br>'.$pendapatan = $row['income'];

                    echo '<br>'.$tabungan=$row['savings'];

                    echo '<br>'.$datuk = $row['datuk_id'];

                    echo '<br>'.$kampung = $row['village_id'];
                    echo '<hr>';
                    $query = pg_query("SELECT family_card_number, head_of_family, national_identity_number, birth_date, educational_id, job_id, income, insurance, savings, the_number_of_dependents, datuk_id, village_id FROM householder WHERE head_of_family='$nama'");
                        $jumlah_kk = pg_num_rows($query);

                        $jnama = pg_num_rows($query);
                        
                        if($jnama>0) {
                            if ($tgl==null||$pendapatan==null||$pendidikan==null||$pekerjaan==null||$asuransi==null||$tabungan==null||$kampung=$datuk==null) {
                                $tgl="null";$pendapatan="null";$pendidikan="null";$pekerjaan="null";$asuransi="null";$tabungan="null";$kampung=$datuk="null";
                            }

                            $q=pg_query("UPDATE householder SET 
                                national_identity_number='$nik',
                                birth_date=$tgl,
                                educational_id=$pendidikan,
                                job_id=$pekerjaan,
                                income=$pendapatan,
                                insurance=$asuransi,
                                savings=$tabungan,
                                datuk_id=$datuk,
                                village_id=$kampung
                                WHERE head_of_family='$nama'
                            ");
                            if ($q==true) {
                                echo "<script>alert('".$nama." diubah!')</script>";
                            }
                        }
                        
                }

                


                
                        $query = pg_query("SELECT family_card_number, head_of_family, national_identity_number, birth_date, educational_id, job_id, income, insurance, savings, the_number_of_dependents, datuk_id, village_id FROM householder");
                        $jumlah_kk = pg_num_rows($query);

                      
                        while ($data=pg_fetch_assoc($query)) {
                            echo '<br>'.$kk_penghuni = $data['family_card_number'];
                            echo '<br>'.$nama_kk = $data['head_of_family'];
                            echo '<br>'.$nik_kk = $data['national_identity_number'];
                            echo '<br>'.$tgl_penghuni = $data['birth_date'];
                            echo '<br>'.$pdkk_penghuni = $data['educational_id'];
                            echo '<br>'.$kerja_penghuni = $data ['job_id'];
                            echo '<br>'.$penghasilan_penghuni = $data['income'];
                            echo '<br>'.$tabungan = $data['savings'];
                            echo '<br>'.$tanggungan_penghuni = $data['the_number_of_dependents'];
                            echo '<br>'.$datu = $data['datuk_id'];
                            echo '<br>'.$kampung = $data['kampung_id'];

                            echo '<br>'.$asuransi_penghuni=$row['insurance'];

                            echo '<br>'.$tabungan=$row['savings'];

                            echo '<hr>';
}
                           