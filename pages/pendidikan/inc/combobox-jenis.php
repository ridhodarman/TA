<label><span style="color:red">*</span>Level of Education</label>
<select name="level" class="form-control" style="font-size: 85%">
    <?php                
    include('../../../inc/koneksi.php');
        $sql_j=pg_query("SELECT * FROM level_of_education ORDER BY name_of_level");
        while($row = pg_fetch_assoc($sql_j))
        {
            echo"<option value=".$row['level_id'].">".$row['name_of_level']."</option>";
        }
    ?>
</select>