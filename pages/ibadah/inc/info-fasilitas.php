<div class="card">
    <div class="card-body">
        <div class="media mb-5">
            <div class="media-body">

            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambah-fas" style="float: right;">+ Add</button>
            
            <div class="modal fade" id="tambah-fas">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form method="post" action="act/info-tambahfas.php">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Worship Facilities</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <p>Name of Worship Facilities:</p>
                                <select class="form-control" name="fasilitas" style="height: 50px;">
                                <?php
                                    $sql_fas= pg_query("SELECT * FROM worship_building_facilities ORDER BY name_of_facility ASC");
                                    while($row = pg_fetch_assoc($sql_fas))
                                    {
                                        echo"<option value=".$row['facility_id'].">".$row['name_of_facility']."</option>";
                                    }
                                ?>
                                </select>
                                <p>Quantity of facilities:<label id="fass"></label></p>
                                <input type="text" class="form-control" name="total-fas" id="total-fas" placeholder="quantity of facilities.." onkeypress="return hanyaAngka(event, '#fass')" onkeyup="cek_t()">
                                <input type="hidden" name="id" value="<?php echo $id ?>">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary" id="tambahkanfas">+ Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <h5 class="mb-3">Facility</h5>

            <table width="100%" class="table table-striped table-bordered table-hover">
                <thead style="text-align: center;">
                    <th>Name of Facility</th>
                    <th>Qty</th>
                    <th>Action</th>
                </thead>
                <tbody>
                <?php
                $nomor=1;
                $sql=pg_query("SELECT D.worship_building_id, D.facility_id, D.quantity_of_facilities, F.name_of_facility
                    FROM detail_worship_building_facilities AS D 
                    LEFT JOIN worship_building_facilities AS F ON F.facility_id=D.facility_id
                    WHERE D.worship_building_id = '$id'
                    ");
                $cekfas=pg_num_rows($sql);
                if ($cekfas==0) {
                    echo "<tr style='text-align: center;'><td colspan='3'>No facility data</td></tr>";
                }
                while ($data=pg_fetch_assoc($sql)) {
                    //$id_bang=str_replace(' ', '',$data['worship_building_id']);
                    $id_fas=$data['facility_id'];
                    $namafas =$data['name_of_facility'];
                    $qty = $data['quantity_of_facilities'];
                    echo "<tr>";
                    echo "<td>".$namafas."</td>";
                    echo "<td>".$qty."</td>";
                    echo '<td>
                        <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#edit-fas'.$nomor.'"><i class="fa fa-edit"></i> Edit</button>
                        <button class="btn btn-danger btn-xs" title="Hapus" data-toggle="modal" data-target="#delete-fas'.$nomor.'"><i class="fa fa-trash"></i> Delete</button>
                        </td>';
                    echo "</tr>";
                    echo '
                        <div class="modal fade" id="edit-fas'.$nomor.'">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                            <form method="post" action="act/info-editfas.php">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Quantity of <b>'.$namafas.'</b>:<label id="fass2'.$nomor.'"></label></p>
                                        <input type="text" class="form-control" name="total-fas-edit" id="total-fas-edit'.$nomor.'" placeholder="quantity of facilities.." onkeypress="return hanyaAngka(event, '."'".'#fass2'."$nomor'".')" value="'.$qty.'" onkeyup="cek_e'.$nomor.'()">
                                            <input type="hidden" name="id-bang" value="'.$id.'">
                                            <input type="hidden" name="id-fas" value="'.$id_fas.'">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary" name="fas-edit" id="fas-edit'.$nomor.'"><i class="ti-save"></i> Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <script>
                    	function cek_e'.$nomor.'() {
							var e = document.getElementById("total-fas-edit'.$nomor.'").value;
							console.log(e);
							if (e >= 1) {
								$("#fas-edit'.$nomor.'").prop("disabled", false);
							}
							else {
								$("#fas-edit'.$nomor.'").prop("disabled", true);	
							}
						}
                    </script>


                        <div class="modal fade" id="delete-fas'.$nomor.'">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete '.$namafas.' ?</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure to delete "'.$namafas.'" from the list of facilities ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <a href="act/info-deletefas.php?id-bang='.$id.'&&id-fas='.$id_fas.'"><button type="button" class="btn btn-danger">Delete</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ';
                    $nomor=$nomor+1;
                }
            ?>
                    
                </tbody>
            </table>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	$('#tambahkanfas').prop('disabled', true);
	function cek_t() {
		var t = document.getElementById('total-fas').value;
		if (t >= 1) {
			$('#tambahkanfas').prop('disabled', false);
		}
		else {
			$('#tambahkanfas').prop('disabled', true);	
		}
	}

	$("[name='fas-edit']").prop('disabled', true);
</script>