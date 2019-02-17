
<?php
	include ('../../../inc/koneksi.php');
    $sql=pg_query("SELECT * FROM type_of_msme ORDER BY name_of_type ASC");
    $no=1;
    while ($data=pg_fetch_assoc($sql)) {
        $id=$data['type_id'];
        $jenis=$data['name_of_type'];
        echo "<tr>";
        echo "<td>".$no."</td>";
        echo "<td>".$jenis."</td>";
        echo '<td>
            <button class="btn btn-danger btn-xs" title="Hapus" data-toggle="modal" data-target="#delete'.$id.'"><i class="fa fa-trash"></i> Delete</button>
            </td>';
        echo "</tr>";

        echo '
        	<div class="modal fade" id="delete'.$id.'">
			    <div class="modal-dialog">
			        <div class="modal-content">
			            <div class="modal-header">
			                <h5 class="modal-title">Delete '.$jenis.' ?</h5>
			                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
			            </div>
			            <div class="modal-body">
			                <p>Are you sure to delete '.$jenis.' from data of MSME type ? <br/>
			                There are as many as <b>100</b> MSME that have this type.
			                </p>
			            </div>
			            <div class="modal-footer">
			                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
			                <button type="button" class="btn btn-danger">Delete</button>
			            </div>
			        </div>
			    </div>
			</div>
        ';
        $no++;
    }
?>
