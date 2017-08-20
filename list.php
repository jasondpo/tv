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
		h11{ /* TV List Header */
			position: relative;
			z-index: 2;
			height: 46px;
			padding-top: 17px;
			box-sizing: border-box;
			background-image: url(images/tv-icon-circle.png);
			background-repeat: no-repeat;
			background-position: 15px center;
			box-shadow: 1px 0px 3px 1px rgba(30, 30, 30, .3);
			font-size: 16px;
			text-indent: 49px;
			display: block;
			color: #333;
		}
		h12{ /* tv show header */
			font-size: 20px;
			font-weight: 600;
		}
		h13{ /* tv show description */
			font-size: 14px;
			line-height: 1.4em;
			color: #666;
		}
		.banner{
			position: fixed;
			top:0px;
			left: 0px;
			right: 0px;
			height: 42px;
			background-color: #333;
			z-index: 2;
		}
		.logo{
			float: left;
			width: 90px;
			height: 42px;
			margin-left: 20px;
			background-image: url(images/ff-logo.png);
		}
		.icon-nav-wrapper{
			width: 84px;
			height: 42px;
			float: right;
			margin-right: 20px;
		}
		.icon-style{
			width: 42px;
			height: 42px;
			cursor: pointer;
			float: left;
			background-position: center top;
		}
		.icon-style:hover{
			background-color: #000;
		}
		.icon-nav-active{
			background-color: #E9EBEE;
			background-position: center bottom;					
		}
		.icon-nav-active:hover{
			background-color: #E9EBEE;
			background-position: center bottom;					
		}
		.list-icon{
			background-image: url(images/list-icon.png);
		}
		.tv-icon{
			background-image: url(images/tv-icon.png);			
		}
		
/* //////////////////////////////////////////////////////////////// */
		.overlay-tv-select{
			z-index: 1;
			position: fixed;
			overflow-x: auto;
			background-color: #333;
			left: 0px;
			right: 0px;
			bottom: 0px;
			top:42px;
			box-sizing: border-box;
			border-left:1px solid #CCC;
			background-color: #E9EBEE;
			transition: margin-left .15s linear;
		}
		.overlay-tv-select-open{
			margin-left: 0%;
		}
		.overlay-tv-select-close{
			margin-left: 100%;
		}
		.wrapper-tv-list{
			background-color: white;
			padding: 6px 6px 0px 6px;
			position: relative;
			max-width: 600px;
			height: 500px;
			margin: 0px auto;
			overflow-x: auto;
			border-bottom: 1px solid #DDDFE2;	
		}
		.wrapper-tv-select{
			overflow: hidden;
			position: relative;
			padding-bottom: 20px;
			background-color: #1D2129;
			max-width: 600px;
			margin: 40px auto 40px;
			background-color: #F6F7F9;
			border-radius: 4px;	
			box-sizing: border-box;
			border: 1px solid #DDDFE2;	
		}
		td{
			cursor: pointer;
			box-sizing: border-box;
			border-bottom:0px solid #fff;
			border-spacing: 0px;
			border-collapse: collapse;
			position: relative; 			
		}
		.td-border{
			border-bottom:6px solid #fff;
		}
		.tv-list-table img{
			display: block;	
		}
		.td-img{
/* 			border-bottom:20px solid #fff; */
		}
		.desc{
			box-sizing: content-box;
			background-color: #F6f6f6;
			padding: 16px 16px 10px 16px;
			transition: background-color .15s linear;
			overflow: hidden;
		}
		.desc:hover{
			background-color: #e6ecf8;
		}

		.tv-list-table tr .summary-wrapper{
			overflow: hidden;
			height: 242px;
		}
		.tv-list-table tr .summary-wrapper:hover{
			height: auto;
		}
		
		.tv-list-table tr:hover .summary-wrapper{
			background-color: #e6ecf8;
		}
		.tv-list-table tr:hover .desc{
			background-color: #e6ecf8;
		}

		.summary-wrapper p{
			margin: 6px auto 0px;
		}
		.tv-selection-comment{
			display: block;
			margin: 10px 10px 0px 55px;
			padding: 10px 10px 6px 14px;
			background-color: white;
			border-radius: 10px;
			min-height: 72px;
			box-sizing: border-box;
			border: 1px solid #DDDFE2;
			background-color: white;
			color: #666;
			line-height: 1.3em;
			font-size: 13px;
		}
		.tv-selection-comment:focus{
			outline: 0;			
		}
		.profile-addReview{
			width: 37px;
			height: 37px;
			margin: 10px 0px 0px 10px;
			border-radius: 100%;
			background-image: url(images/profile-img-add-comment.png);
			background-position: center bottom;
			background-color: white;
			box-sizing: border-box;
			border: 1px solid #DDDFE2;
			float: left;
			cursor: pointer;			
		}
		.search{
			display: block;
			margin: 20px 10px 0px 10px;
			padding: 10px 10px 6px 14px;
			background-color: white;
			border-radius: 20px;
			min-height: 36px;
			box-sizing: border-box;
			border: 1px solid #DDDFE2;
			background-color: white;
			color: #666;
			line-height: 1.3em;
			font-size: 13px;			
		}
		.search:focus{
			outline: 0;
		}
		.arrow-down {
			position: absolute;
			left:50%;
			width: 0; 
			height: 0; 
			margin: -3px 0px 0px -20px;
			border-left: 14px solid transparent;
			border-right: 14px solid transparent;	
			border-top: 13px solid #F6f6f6;
		}

/* //////////////////////////////////////////////////////////////// */		
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
			margin-left: 45px;
			padding: 10px 10px 6px 14px;
			background-color: white;
			border-radius: 20px;
			min-height: 36px;
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
		.profile-addComment{
			width: 37px;
			height: 37px;
			border-radius: 100%;
			background-image: url(images/profile-img-add-comment.png);
			background-position: center bottom;
			background-color: white;
			box-sizing: border-box;
			border: 1px solid #DDDFE2;
			float: left;
			cursor: pointer;
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
					<table class="tv-list-table" width="100%">
						<tbody class="shows">
						</tbody> 
					</table>
				</div>
						
				<div contentEditable='true' class="search">Search by person or title...</div>
				<div class='profile-addReview'></div>
				<div contentEditable='true' class="tv-selection-comment">Write a review...</div>
			</div>
			
			
				<form action="list.php" method="post"  class="reviewForm" autocomplete='off'>
	
					 
					<select name="myColors">
						<option value="purple">purple</option>
						<option value="red">red</option>
						<option value="blue">blue</option>
						<option value="green">green</option>
					</select> 
					
					<input type="text" id="title" name="title"/>
					
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
					
			<!-- This form starts a conversation -->
						
			<!-- This form adds feedback to conversation-->
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
				
				$(".tv-selection-comment").focus(function(){
					if($(this).text()=='Write a review...'){$(this).text('')};
				});
				
				$(".tv-selection-comment").blur(function(){
					if($(this).text()==''){$(this).text('Write a review...')};
				});
				
				$(".search").focus(function(){
					if($(this).text()=='Search by person or title...'){$(this).text('')};
				});
				
				$(".search").blur(function(){
					if($(this).text()==''){$(this).text('Search by person or title...')};
				});
							
				$(".enterCommentBox").keypress(function (e) {
					var key = e.which;
					if(key == 13 && !e.shiftKey)  // the enter key code
					{
						e.preventDefault();
						$ans=$(this).parent("div").attr('class').split(' ')[0];
						$('.myColors').val($ans);
						$ans2=$(this).text();
						$('.title').val($ans2); //ads info to input field
						$('.addToList').click(); //simulates click
					}
				});
				
				$('h10').click(function(){ //Feedback delete button
					$fVal=$(this).attr('data-id');
					$('.feedback-id').val($fVal);//ads id to input field
					$('.deletFdback').click(); //simulates click
				});
				
				$('.list-icon').click(function(){
					$('.list-icon').addClass('icon-nav-active');
					$('.tv-icon').removeClass('icon-nav-active');
					$('.overlay-tv-select').removeClass('overlay-tv-select-open');
					$('.overlay-tv-select').addClass('overlay-tv-select-close');
					$('html, body').css('overflow', 'auto'); 
				});
				$('.tv-icon').click(function(){
					$('.list-icon').removeClass('icon-nav-active');
					$('.tv-icon').addClass('icon-nav-active');
					$('.overlay-tv-select').removeClass('overlay-tv-select-close');
					$('.overlay-tv-select').addClass('overlay-tv-select-open');
					$('html, body').css('overflow', 'hidden'); 
				});
				
// 				TV MAZE API STARTS
			  	$.getJSON("http://api.tvmaze.com/shows", function(obj){
			        
			        obj.sort(function(a, b) {  // Arranges in alphabetical order 
					    return a.name.localeCompare(b.name);
					});
		
		            $.each(obj, function(i, value){  //gets the index?
//  		               $(".shows").append("<tr><td class='desc' valign='top'><h12>"+obj[i].name+"</h12><h13><div class='summary-wrapper'>"+obj[i].summary+"</div></h13></td></tr><tr><td><div class='arrow-down'></div><img class='td-img' src='"+obj[i].image.original+"' width='100%'></td></h13></td></tr>"); 
					 $(".shows").append("<tr class='tr-row'><td class='td-border' valign='top'><div></div><img class='td-img' src='"+obj[i].image.original+"' width='200'></td><td class='desc td-border' valign='top'><h12>"+obj[i].name+"</h12><h13><div class='summary-wrapper'>"+obj[i].summary+"</div></h13></td></tr>");     
		            });           
		
		        });
// 				TV MAZE API ENDS
			})
		</script>	

	</body>
	
</html>