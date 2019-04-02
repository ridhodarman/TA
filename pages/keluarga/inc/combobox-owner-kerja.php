Job: 
<select class="form-control" name="kerja" required style="font-size: 81%; font-weight: bold">
    <?php         
    	include('../../../inc/koneksi.php');        
        $sql_k=pg_query("SELECT * FROM job ORDER BY job_name");
        while($row = pg_fetch_assoc($sql_k))
        {
            echo"<option value=".$row['job_id'].">".$row['job_name']."</option>";
        }
    ?>
</select>