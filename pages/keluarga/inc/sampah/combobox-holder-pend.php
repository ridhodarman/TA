Education Level:
<select class="form-control" name="pend2" required style="font-size: 81%; font-weight: bold">
    <?php           
    	include('../../../inc/koneksi.php');     
        $sql_p=pg_query("SELECT * FROM education ORDER BY educational_level");
        while($row = pg_fetch_assoc($sql_p))
        {
            echo"<option value=".$row['education_id'].">".$row['educational_level']."</option>";
        }
    ?>
</select>