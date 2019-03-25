<label>Tribe:</label>
<select class="form-control" name="suku" id="daftarsuku" required>
    <?php               
    	include('../../../inc/koneksi.php');  
        $sql_suku=pg_query("SELECT * FROM tribe ORDER BY name_of_tribe");
        while($row = pg_fetch_assoc($sql_suku))
        {
            echo"<option value=".$row['tribe_id'].">".$row['name_of_tribe']."</option>";
        }
    ?>
</select>