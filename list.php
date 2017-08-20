<?php include 'functions.php';?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title> TV List </title> 
		
		<!-- Normalize CSS Stylesheet -->
		<link rel="stylesheet" src="//normalize-css.googlecode.com/svn/trunk/normalize.css" />
		
		<!-- Custom Stylesheet -->
		<link rel="stylesheet" href="assets/css/.css">
		
		<!-- jQuery Library-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

	</head>
	
	<style>
		html, bod{
			font-family:sans-serif;
			background-color: #E9EBEE;
		}
		.clearfix:after {
			visibility: hidden;
			display: block;
			font-size: 0;
			content: " ";
			clear: both;
			height: 0;
			}
		* html .clearfix             { zoom: 1; } /* IE6 */
		*:first-child+html .clearfix { zoom: 1; } /* IE7 */
		h10{ /* Delete feedback */
			font-size: 12px;
			color: #BBB;		
		}
		.wrapper{
			position: relative;
			max-width: 600px;
			margin: 100px auto 0px;
		}
		.listForm{
			margin-bottom: 20px;
		}
		.box{
			width: 100%;
			min-height: 30px;
			font-family: sans-serif;
			box-sizing: border-box;
			padding: 7px;
			color: #1D2129;
			margin-bottom: 10px;
			font-size: 13px;
		}
		.purple, .red, .blue, .green{
/* 			background-color: #DDD; */
		}
		.greyBar{
			position: relative;
			font-family: sans-serif;
			box-sizing: border-box;
			padding: 7px;
			color: white;
			margin-bottom: 10px;
			background-color: #F6F7F9;
			border-radius: 4px;	
			box-sizing: border-box;
			border: 1px solid #DDDFE2;		
		}
		.enterCommentBox{
			display: block;
			margin-left: 50px;
			padding: 10px 10px 10px 14px;
			background-color: white;
			border-radius: 20px;
			min-height: 39px;
			box-sizing: border-box;
			border: 1px solid #DDDFE2;
			background-color: white;
			color: #666;
			line-height: 1.3em;
			font-size: 13px;
		}
		.enterCommentBox:focus{
			outline: 0;
		}
		.deleteFdback-wrapper{
			display: block;
			margin-top: 6px;
			text-align: right;
			cursor: pointer;
		}
		.deleteFdback-wrapper h10:hover{
			color: #666;
		}
		
	</style>
	
	
	<body>	
		

		<div class="wrapper">
			
			<form action="list.php" method="post"  class="reviewForm" autocomplete='off'>

				Initial Critic: 
				<select name="myColors">
					<option value="purple">purple</option>
					<option value="red">red</option>
					<option value="blue">blue</option>
					<option value="green">green</option>
				</select> 
				
				<input type="text" id="title" name="title"/>
				
				<input type="submit" class="addReview" name="addReview" value="submit">	
								
			</form> 
			
			<br/>
			<br/>
			
			<form action="list.php" method="post" class="listForm" autocomplete='off' style="display:none">

				response: 
				
				<input type="text" id="myColors" class="myColors" name="myColors"/>
				
				<input type="text" id="title" class="title" name="title"/>
				
				<input type="submit" class="addToList" name="addToList" value="submit">	
								
			</form> 
						
			
			<div class="listColumn"><?php displayTVList();?></div>
					
		</div>
		
		<script>
			$(function(){
				$(".enterCommentBox").focus(function(){
					if($(this).text()=='Write a comment...'){$(this).text('')};
				});
				
				$(".enterCommentBox").blur(function(){
					if($(this).text()==''){$(this).text('Write a comment...')};
				});
							
				$(".enterCommentBox").keypress(function (e) {
					var key = e.which;
					if(key == 13 && !e.shiftKey)  // the enter key code
					{
						e.preventDefault();
						$ans=$(this).prev("div").attr('class').split(' ')[0];
						$('.myColors').val($ans);
						$ans2=$(this).text();
						$('.title').val($ans2);
						$('.addToList').click();
					}
				});
			})
		</script>	

	</body>
	
</html>