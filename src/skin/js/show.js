$(window).scroll(function(){
  if($(document).scrollTop()!=0){
    sessionStorage.setItem("offsetTop", $(window).scrollTop());
  }
});
$(function(){
   var offset = sessionStorage.getItem("offsetTop");
  $(document).scrollTop(offset);	
    $('.imgbg,.mask').click(function(){
		if($('.navtop').css("top")=="-50px"){
		   $('.navtop').css('top', '0px');  
		   $(".control_bottom").css('bottom', '0px');
		   $('.showimg h1').hide();
		}else{
		   $('.navtop').css('top', '-50px');
		   $(".control_bottom").css('bottom', '-50px');
		    $('.showimg h1').show();
		}
	})
	$('a.stop').click(function(){
		$('html,body').animate({scrollTop: '0px'}, 300);
		$('.navtop').css('top', '-50px');
		$(".control_bottom").css('bottom', '-50px');
	});
	$('a.sbottom').click(function(){
		$('html,body').animate({scrollTop:$('.bottom').offset().top}, 300);
	});		
	$("#addFavBTN").click(function() {
		$(".addFavBox").fadeIn()
	});
	$(".addFavBox a").click(function() {
		$(".addFavBox").fadeOut()
	});
	$("#needPay .notices a").click(function() {
		$("#needPay").fadeOut()
	});
	$('body').on('click', '#open', function() {
		$('.body').on('touchmove', function(event) {
			event.preventDefault()
		});
		$('.left-nav').css('left', '0px');
		$('.openbg').show();
	});
	$(".openbg,a.close").click(function() {
		$('.body').off('touchmove');
		$('.left-nav').css('left', '-280px');
		$('.openbg').hide();
	})
});
function setCookie(name,value) { 
    var Days = 30; 
    var exp = new Date(); 
    exp.setTime(exp.getTime() + Days*24*60*60*1000); 
    document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString(); 
} 
function getCookie(name) { 
    var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
    if(arr=document.cookie.match(reg)) 
        return unescape(arr[2]); 
    else 
        return null; 
} 
