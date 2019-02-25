<?php
if (isset($_POST['username'])) {
	include '../inc/koneksi.php';
	$user = $_POST['username'];
	$pass = md5($_POST['password']);

	$sql = pg_query("SELECT * FROM user_account where username='$user' and password='$pass'")or die(mysql_error());
	$row= pg_fetch_array($sql);
	if($row!=0){
		session_start();
	  	$_SESSION['username'] = $row['username'];
	  	$_SESSION['password'] = $row['password'];
	  	$_SESSION['role'] = $row['role'];
		
		header("location: ../");
		
	}
	else { ?>
				<style type="text/css">
					.salah {
						animation: blink-animation 1s steps(5, start) infinite;
						-webkit-animation: blink-animation 1s steps(5, start) infinite;
					}
					@keyframes blink-animation {
						to {
						visibility: hidden;
						}
					}
					@-webkit-keyframes blink-animation {
						to {
						visibility: hidden;
						}
					}
				</style>
                <center>
                	<p><h1 style="color: red" class="salah">Incorrect username or password !</h1></p>
                    <a href="../"><img src="back.png" width="200px" /></a>
                    <p>You will be directed to the main page automatically in <font id="waktu"></font> seconds</p>
                </center>
                
                <script type="text/javascript">
					var waktu = 4;
					setInterval(function() {
					waktu--;
					if(waktu < 0) {
					window.location.href = '../';
					}else{
					document.getElementById("waktu").innerHTML = waktu;
					}
					}, 1000);
				</script>
			
		';

	<?php }
}
else {
	header("location: ../assets/403");
}
?>