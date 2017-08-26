<?php include 'functions.php';?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title> FriendFlix </title> 
		
		<!-- Normalize CSS Stylesheet -->
		<link rel="stylesheet" src="//normalize-css.googlecode.com/svn/trunk/normalize.css" />

		
		<!-- Custom Stylesheet -->
		<link rel="stylesheet" href="style/tv-list.css">
		
		<!-- jQuery Library-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

	</head>
	
	
	
	<body>	
		
		<div class="banner">
			<div class="logo"></div>
			<div class="icon-nav-wrapper">
				<div class="list-icon icon-style icon-nav-active"></div>
				<div class="tv-icon icon-style"></div>
			</div>
		</div>
		
<!-- TV Show Select page STARTS -->		
		<div class="overlay-tv-select overlay-tv-select-close">
			<div class="wrapper-tv-select">
				<h11>Show Selection</h11>
				<div class="wrapper-tv-list">
					<table class="tv-list-table" id="tv-list-table" width="100%" cellspacing="0">
						<tbody class="shows">
						</tbody> 
					</table>
				</div>
						
				<div contentEditable='true' class="search">Search by person or title...</div>
				<div class='profile-addReview'></div>
				<div contentEditable='true' class="tv-selection-comment">Write a review...</div>
			</div>
			
			<!-- This form stores TV Data after it is clicked AND the review-->
			<form action="list.php" method="post" class="storeForm" style="display:block" >
				<input type="text" class="tvID" name="tvID"/>
				<input type="text" class="tvTitle" name="tvTitle"/>
				<input type="text" class="tvSummary" name="tvSummary"/>
				<input type="text" class="userReview" name="userReview"/>
				<input type="text" class="tvflyer" name="tvflyer"/>		
				<input type="submit" class="addReview" name="addReview" value="submit">		
			</form> 
						
			
		</div>
<!-- TV Show Select page ENDS -->		
		
		<div class="wrapper">
			
			<!-- Delete single feedback -->
			<form action="list.php" method="post"  class="deleteForm" autocomplete='off' style="display:none">
				
				<input type="text" id="feedback-id" name="feedback-id" class="feedback-id"/>
				
				<input type="submit" class="deletFdback" name="deletFdback" value="submit">	
								
			</form> 
					
						
			<!-- This form adds feedback to conversation-->
			<form action="list.php" method="post" class="listForm" autocomplete='off' style="display:none">

				response: 
				
				<input type="text" id="myColors" class="myColors" name="myColors"/>
				
				<input type="text" id="title" class="title" name="title"/>
				
				<input type="submit" class="addToList" name="addToList" value="submit">	
								
			</form> 
						
			
			<div class="listColumn"><?php displayTVList();?></div>
					
		</div>
		
		<script src="js/tv-list.js"></script>	

	</body>
	
</html>