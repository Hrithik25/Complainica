<?php
	function printError($errMsg,$loc){
		?>
		<script>
			alert('<?php echo $errMsg; ?>');
			document.location="<?php echo $loc; ?>";
		</script>
		<?php
		exit();
	}



?>