<label><span style="color:red">*</span>Worship Building Type</label>
<select name="j-ibadah" class="form-control" style="font-size: 85%">
    <?php                
    	include('../../../inc/koneksi.php');
        $sql_jibadah=pg_query("SELECT * FROM type_of_worship ORDER BY name_of_type");
        while($row = pg_fetch_assoc($sql_jibadah))
        {
            echo"<option value=".$row['type_id'].">".$row['name_of_type']."</option>";
        }
    ?>
</select>