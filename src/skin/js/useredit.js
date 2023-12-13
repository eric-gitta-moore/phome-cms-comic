function space(str) {
	return str.replace(/\s+/g, "");
}
$("#safe-sub").unbind('click').click(function() {
	var oldpassword = $("#oldpassword").val();
	var newpassword = $("#password").val();
	if(newpassword===''){
          myTips('新密码不能为空');
		   return false;
     }
	$.ajax({
		type: 'POST',
		url: '/e/member/doaction.php',
		data: 'enews=EditSafeInfo&mail=no&oldpassword=' + oldpassword + '&password=' + space(newpassword) + '&repassword=' + space(newpassword) + '&ajax=1',
		success: function(data, status) {
			if (data == '1') {
				myTips('Email邮箱不能为空');
			} else if (data == '2') {
				myTips('原密码不能为空');
			} else if (data == '3') {
				myTips('原密码错误，无法修改');
			} else if (data == '4') {
				myTips('密码长度应该为6~40个字符');
			} else if (data == '5') {
				myTips('二次密码不一致');
			}else if (data == '6') {
				myTips('此邮箱已被注册');
			}  else if (data == '7') {
				myTips('修改成功');
				setTimeout(function(){
				    self.location = '/my';
				},1000);
			} else if (data == '99') {
				myTips('未知错误，修改失败');
			} else {
				myTips('系统错误，请联系管理员处理');
			}
		}
	});
	return false;
});
$("#edit-sub").unbind('click').click(function() {
	var phone = $("#phone").val();
	var oicq = $("#oicq").val();
	var email = $("#email").val();
	var regphone = /^1[0-9]{10}$/;
	var strPhone=regphone.test(phone);
	if(strPhone){
	}else{
	     myTips('手机格式不正确');
		 return false;
	}
	var regqq = /^[1-9]\d{4,13}$/;
	var strQQ=regqq.test(oicq);
	if(strQQ){
	}else{
	     myTips('QQ号格式不正确');
		 return false;
	}
	var regmail = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
	var strEmail=regmail.test(email);
	if(strEmail){}else{
	   myTips('邮箱格式不正确');
	   return false;
	}
	$.ajax({
		type: 'POST',
		url: '/e/member/doaction.php?',
		data: 'enews=EditInfo&phone=' + space(phone) + '&oicq=' + space(oicq) + '&email=' + space(email) + '&ajax=1',
		success: function(data, status) {
			if (data == '1') {
				myTips('修改信息成功！');
				setTimeout(function(){
				    self.location = '/my';
				},1000);				
			} else if (data == '2') {
				myTips('必填项不能留空');
			} else if (data == '3') {
				myTips('此邮箱已被注册');
			}else if (data == '4') {
				myTips('未知错误，修改失败');
			} else {
				myTips('系统错误，请联系管理员处理');
			}
		}
	});
	return false;
});