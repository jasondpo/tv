
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
	
//////////// TV MAZE API STARTS ////////////

	var pageNo=Math.floor((Math.random() * 10) + 1);
  	$.getJSON("http://api.tvmaze.com/shows?page="+pageNo+"", function(obj){
        
        obj.sort(function(a, b) {  // Arranges in alphabetical order 
		    return a.name.localeCompare(b.name);
		});
		x=0
        $.each(obj, function(i, value){  //gets the index?       
		 $(".shows").append("<tr data-tvid='"+obj[i].id+"' class='tr-row'><td class='td-border' valign='top'><div></div><img class='td-img' src='"+obj[i].image.medium+"' width='200'></td><td class='desc td-border' valign='top'><h12>"+obj[i].name+"</h12><h13><div class='summary-wrapper'>"+obj[i].summary+"</div></h13></td></tr>");     
        });           

    });
    
//////////// TV MAZE API ENDS ////////////

// 	This collects all the info from the selected tv show 
	$(document).on("click", ".tv-list-table .shows tr", function(e) {
    	tvID=$(this).attr('data-tvid');
    	tvflyer=$(this).find('td:first img').attr('src');
    	tvTitle=$(this).find('td:last h12').text();
    	tvSummary=$(this).find('td:last div').text();
    	$('.tvID').val(tvID);
    	$('.tvflyer').val(tvflyer);
    	$('.tvTitle').val(tvTitle);
    	$('.tvSummary').val(tvSummary);
	});
	
	$(".tv-selection-comment").keypress(function(e) {
		var key = e.which;
		if(key == 13 && !e.shiftKey)  // the enter key code
		{
			$review=$('.tv-selection-comment').text();
			$('.userReview').val($review);
		}
	});
	
	
	
});
