(function(){var isValid=false,isTouching=false,isEfec=false,isDestory=false,startX,startY,disY=0,loadingH=0,options={$el:$('body'),$loadingEl:null,autoHide:true,url:undefined,sendData:null,startPX:6,callbacks:{pullStart:null,start:null,success:null,error:null,end:null,}};var getPos=function(event){var pos={x:event.pageX||event.clientX,y:event.pageY||event.clientY}
return pos;}
var reset=function(isAnim){isValid=false,isEfec=false,startX,startY,disY=0;options.$loadingEl.animate({'margin-top':-loadingH},(isAnim==false?0:800),function(){isTouching=false;runCb('end');});}
var touchStart=function(evt){var scrollTop=parseInt(options.$el.scrollTop());if(scrollTop>0)return;if(isDestory)return;if(isTouching)return;isTouching=true;isEfec=true;var touch=evt.touches[0],x=parseInt(touch.pageX),y=parseInt(touch.pageY);startX=x;startY=y;}
var touchMove=function(evt){if(isDestory)return;if(!isTouching)return;if(!isEfec)return;var $loadingEl=options.$loadingEl,touch=evt.touches[0],x=parseInt(touch.pageX),y=parseInt(touch.pageY),t=y-startY;if(!isValid&&t>options.startPX){isValid=true;runCb('pullStart');}
if(!isValid)return;if(evt.preventDefault)evt.preventDefault();if(t<0){$loadingEl.css('margin-top',-loadingH);}
if(t>0&&t<=loadingH){$loadingEl.css('margin-top',-(loadingH-t));$loadingEl.height(loadingH);}
else if(t>loadingH){$loadingEl.css('margin-top',0);$loadingEl.height(t);}
disY=t;}
var runCb=function(name,data){if(options.callbacks[name])options.callbacks[name].call(null,data);}
var touchEnd=function(evt){if(isDestory)return;if(!isValid)return;if(!isTouching)return;if(evt.preventDefault)evt.preventDefault();isValid=false;isEfec=false;disY=0;var $loadingEl=options.$loadingEl,touch=evt.touches[0]||evt.changedTouches[0],x=parseInt(touch.pageX),y=parseInt(touch.pageY),t=y-startY;if(t<=loadingH){$loadingEl.css('margin-top',-(loadingH-t));$loadingEl.height(loadingH);$loadingEl.animate({'margin-top':-loadingH},200,function(){isTouching=false;});}
else if(t>loadingH){if(options.cb)options.cb();$loadingEl.animate({'height':loadingH},200,function(){});}
var sendData=$.isFunction(options.sendData)?options.sendData():options.sendData;if(options.url){runCb('start');$.post(options.url,sendData,function(response,textStatus,xhr){runCb('success',response);if(options.autoHide)reset();}).error(function(){runCb('error');if(options.autoHide)reset();});}else{if(options.callbacks)
reset();}}
var setDestroy=function(destroy){isDestory=destroy||false;}
var initlize=function(){loadingH=options.$loadingEl.height();$el=options.$el;$el[0].addEventListener('touchstart',touchStart,false);$el[0].addEventListener('touchmove',touchMove,false);$el[0].addEventListener('touchend',touchEnd,false);}
var pullDown=function(){initlize();return{reset:reset,setDestroy:setDestroy}}
$.pPullRefresh=function(settings){$.extend(true,options,(settings||{}));options.$el=options.$el||$('body');return pullDown(settings);}
$.fn.pPullRefresh=function(settings){settings.$el=$(this);return $.pPullRefresh(settings);}})();
//检查服务器状态
var $statu = $(".loading-warp .text"),
	pullRefresh = $(".container").pPullRefresh({
		$el: $(".container"),
		$loadingEl: $(".loading-warp"),
		sendData: null,
		url: "/e/extend/status.php",
		callbacks: {
			pullStart: function() {
			$statu.text("松开开始刷新")
			},
			start: function() {
				$statu.text("数据刷新中···");
				window.location.reload()
			},
			success: function(a) {
				$statu.text("数据刷新成功！")
			},
			end: function() {
				$statu.text("下拉刷新结束");
			},
			error: function() {
				$statu.text("找不到请求地址,数据刷新失败")
			}
		}
});