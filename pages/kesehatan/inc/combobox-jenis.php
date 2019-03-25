<label><span style="color:red">*</span>Type of Health Building</label>
<select name="j-kes" class="form-control" style="font-size: 85%">
    <?php                
    	include('../../../inc/koneksi.php');
        $sql_j=pg_query("SELECT * FROM type_of_health_building ORDER BY name_of_type");
        while($row = pg_fetch_assoc($sql_j))
        {
            echo"<option value=".$row['type_id'].">".$row['name_of_type']."</option>";
        }
    ?>
</select>