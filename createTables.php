<?php include 'functions.php';?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title> Create Tables </title> 
		
		<!-- Normalize CSS Stylesheet -->
		<link rel="stylesheet" src="//normalize-css.googlecode.com/svn/trunk/normalize.css" />
		
		<!-- Custom Stylesheet -->
		<link rel="stylesheet" href="assets/css/.css">
		
		<!-- jQuery Library-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

	</head>
	
	
	<body>	
		<?php	
			if(isset($_POST['createTables'])){
		  		$db = createTables();
		 	}  	
		?>

		<div class="login-wrapper">
			
			<div class="v-centered">
				<form action="createTables.php" method="post"  autocomplete='off'>

					<input type="submit" class="button" name="createTables" value="Create Tables">	
								
				</form> 
			</div>	
			
		</div>

	</body>
	
</html>