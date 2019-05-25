Village:
<select class="form-control" name="kampung2" required style="font-size: 81%; font-weight: bold">
    <?php         
    	include('../../../inc/koneksi.php');         
        $sql_v=pg_query("SELECT * FROM village ORDER BY village_name");
        while($row = pg_fetch_assoc($sql_v))
        {
            echo"<option value=".$row['village_id'].">".$row['village_name']."</option>";
        }
    ?>
</select>