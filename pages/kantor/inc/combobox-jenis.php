<label><span style="color:red">*</span>Type of Office</label>
<select name="jenis" class="form-control" style="height: 43px">
    <?php                
    	include('../../../inc/koneksi.php');
        $sql_j=pg_query("SELECT * FROM type_of_office ORDER BY name_of_type");
        while($row = pg_fetch_assoc($sql_j))
        {
            echo"<option value=".$row['type_id'].">".$row['name_of_type']."</option>";
        }
    ?>
</select>