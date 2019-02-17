
<html>
	<head>
		<style>
			body{
				width:610px;
			}
			#frmCheclAll {
				border-top:#ffffff 2px solid;background:#FFC0CB;padding:10px;
			}
			#divCheckAll{
				background-color:#C0C0C0;border:#A9A9A9 1px solid;margin-bottom:15px;width:6em;padding:4px 10px;
			}
			#divCheckboxList{
				border-top:#A9A9A9 1px solid;
			}
			.divCheckboxItem{
				padding:6px 10px;
			}
		</style>
	</head>
	<body>
		<h1>Check & Uncheck All jhackofranklin.com</h1>
		<div id="frmCheclAll">
			<div id="divCheckAll"><input type="checkbox" name="checkall" id="checkall" onClick="check_uncheck_checkbox(this.checked);" />Check All</div>
				<div id="divCheckboxList">
					<div class="divCheckboxItem"><input type="checkbox" name="language" id="language1" value="Indonesia" />Indonesia</div>
					<div class="divCheckboxItem"><input type="checkbox" name="language" id="language1" value="English" />English</div>
					<div class="divCheckboxItem"><input type="checkbox" name="language" id="language2" value="French" />French</div>
					<div class="divCheckboxItem"><input type="checkbox" name="language" id="language3" value="German" />German</div>
					<div class="divCheckboxItem"><input type="checkbox" name="language" id="language4" value="Latin" />Latin</div>
				</div>
		</div>
	</body>
</html>

<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
		<script>
		function check_uncheck_checkbox(isChecked) {
			if(isChecked) {
				$('input[name="language"]').each(function() { 
					this.checked = true; 
				});
			} else {
				$('input[name="language"]').each(function() {
					this.checked = false;
				});
			}
		}
		</script>