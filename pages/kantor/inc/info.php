<div class="card">
    <div class="card-body">
        <div class="media mb-5">
            <div class="media-body">
                <button type="button" class="btn btn-info btn-sm btn-flat btn-lg mt-3" data-toggle="modal" data-target="#editinfo" style="float: right;"><i class="fa fa-edit"></i> Edit</button><br/>
                <h6>ID:
                    <?php echo $id ?>
                </h6>
                <br />
                <table style="width: 100%;">
                    <tr>
                        <td>Nama </td>
                        <td>:</td>
                        <td>
                            <?php echo $nama ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Type of Office</td>
                        <td>:</td>
                        <td>
                            <?php echo $jenis; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Building Size </td>
                        <td>:</td>
                        <td>
                            <?php echo $bang; ?> m<sup>2</sup>
                        </td>
                    </tr>
                    <tr>
                        <td>Land Area </td>
                        <td>:</td>
                        <td>
                            <?php echo $lahan; ?> m<sup>2</sup>
                        </td>
                    </tr>
                    <tr>
                        <td>Parking Area </td>
                        <td>:</td>
                        <td>
                            <?php echo $parkir; ?> m<sup>2</sup>
                        </td>
                    </tr>
                    <tr>
                        <td>Standing Year </td>
                        <td>:</td>
                        <td>
                            <?php echo $tahun ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Construction Type </td>
                        <td>:</td>
                        <td>
                            <?php echo $konstruksi; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Electricity Capacity </td>
                        <td>:</td>
                        <td>
                            <?php echo $listrik; ?> kWh
                        </td>
                    </tr>
                    <tr>
                        <td>Address </td>
                        <td>:</td>
                        <td>
                            <?php echo $alamat; ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
            <!-- Modal -->
<div class="modal fade" id="editinfo">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Edit Info</h6>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form method="post" action="act/info-edit.php">
            <div class="modal-body" style="font-size: 110%">
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label><span style="color:red">*</span>ID Survey</label><b id="ids"></b>
                        <input type="text" class="form-control" name="id" id="id" onkeyup="besarkan()" onchange="cekid()" required value="<?php echo $id ?>">
                        <input type="hidden" name="id-temp" value="<?php echo $id ?>">
                    </div>
                    <div class="form-group col-sm-6">
                        <label><span style="color:red">*</span>Name</label>
                        <input type="text" class="form-control" name="nama" value="<?php echo $nama ?>" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label><span style="color:red">*</span>Type of Office</label>
                        <select name="jenis" class="form-control" style="font-size: 85%" required>
                            <option value="<?php echo $id_o ?>"><?php echo $jenis; ?></option>
                            <?php                
                                $sql_j=pg_query("SELECT * FROM type_of_office WHERE type_id != '$id_o' ORDER BY name_of_type");
                                while($row = pg_fetch_assoc($sql_j))
                                {
                                    echo"<option value=".$row['type_id'].">".$row['name_of_type']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Construction Type</label>
                        <select name="konstruksi" class="form-control" style="font-size: 85%">
                            <option value="<?php echo $id_k ?>"><?php echo $konstruksi ?></option>
                            <?php                
                                $sql_j=pg_query("SELECT * FROM type_of_construction WHERE type_id != '$id_k' ORDER BY name_of_type");
                                while($row = pg_fetch_assoc($sql_j))
                                {
                                    echo"<option value=".$row['type_id'].">".$row['name_of_type']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Building Area (m<sup>2</sup>)</label><label id="lbangs"></label>
                        <input type="text" class="form-control" name="lbang" value="<?php echo $bang ?>" onkeypress="return hanyaAngka(event, '#lbangs')" value="<?php echo $bang ?>">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Land Area (m<sup>2</sup>)</label><label id="lahans"></label>
                        <input type="text" class="form-control" name="lahan" value="<?php echo $lahan ?>" onkeypress="return hanyaAngka(event, '#lahans')">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Parking Area (m<sup>2</sup>)</label><label id="parkirs"></label>
                        <input type="text" class="form-control" name="parkir" value="<?php echo $parkir ?>" onkeypress="return hanyaAngka(event, '#parkirs')">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Standing Year</label><label id="tahuns"></label>
                        <input type="text" class="form-control" name="tahun" value="<?php echo $tahun ?>" onkeypress="return hanyaAngka(event, '#tahuns')">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Electricity Capacity (kWh)</label><label id="listriks"></label>
                        <input type="text" class="form-control" name="listrik" value="<?php echo $listrik ?>" onkeypress="return hanyaAngka(event, '#listriks')">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Alamat</label>
                        <textarea class="form-control" name="alamat"><?php echo $alamat ?></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="simpan">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    function besarkan() {
        var id=document.getElementById('id').value.toUpperCase();
        document.getElementById('id').value=id;
    }

    function cekid () {
        var id=document.getElementById('id').value
        var ketemu=false;
        <?php 
          $sql = pg_query("SELECT worship_building_id FROM worship_building WHERE worship_building_id NOT LIKE '$id'");
          while ($data = pg_fetch_array($sql))
          {
            $idnya = $data['worship_building_id'];
            echo "if (id == \"".$idnya."\")";
            echo "{
                    ketemu=true;
                    $('#ids').css('color', 'red');
                    $('#ids').html('...This ID is already registered');
                    $('#simpan').prop('disabled', true);
                  }";

          }
        ?>
         if (ketemu==false){
                $('#ids').empty();
                $('#simpan').prop('disabled', false);
            }
    }

    function ceknominal() {
        var rupiah = document.getElementById('penghasilan');
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