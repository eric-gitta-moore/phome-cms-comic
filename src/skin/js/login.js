function space(str) {
	return str.replace(/\s+/g, "");
}
//会员登录
$(function() {
	$("#login-sub").click(function() {
		var user = $("#logusername").val();
		var pass = $("#logpassword").val();
		var key = $("#logkey").val();
		if (key == "") {
			$('#errmsg').show().html("验证码不能为空！");
			$("#logkey").focus();
			return false
		};
		$.ajax({
			type: "POST",
			url: "/e/member/doaction.php",
			dataType: "html",
			data: {
				'ajax': '1',
				'enews': 'login',
				'username': user,
				'password': pass,
				'key': key,
				'lifetime': 315360000
			},
			beforeSend: function() {
				$('#errmsg').html('<div class="spinner"><div class="double-bounce1"></div><div class="double-bounce2"></div></div>')
			},
			success: function(data) {
				if (data == '1') {
					$('#errmsg').html('用户名和密码不能为空')
				} else if (data == '2' || data == '3') {
					$('#errmsg').html('用户名或密码有误')
				} else if (data == '4') {
					alert('你的账号还没有激活');
					self.location = '/e/member/register/regsend.php'
				} else if (data == '5') {
					$('#errmsg').html('您的帐号还未通过审核')
				} else if (data == '6') {
					$('#errmsg').html('登录不成功，请确认您的cookie是否已开启!')
				} else if (data == '98') {
					$('#errmsg').html('验证码已过期，请点击图片刷新')
				} else if (data == '99') {
					$('#errmsg').html('验证码填写错误')
				} else if (data == '200') {
					self.location = '/my'
				} else {
					alert('系统错误，请联系管理员');
				}
			}
		})
	})
});
//注册会员
$(function() {
	var username =
	$("#reg-sub").click(function() {
		$('#errmsg').hide();
		var regname = $("#regname").val();
		var regpass = $("#regpass").val();
		var regfrom = $("#regfrom").val();
		var regemail = $("#regemail").val();
		var key = $("#regkey").val();
		if (key == "") {
			$('#errmsg').show().html("验证码不能为空！");
			$("#regkey").focus();
			return false
		};
		$.ajax({
			type: "POST",
			url: "/e/member/doaction.php",
			dataType: "html",
			data: {
				'ajax': '1',
				'enews': 'register',
				'groupid': '1',
				'edit': '1',
				'username': space(regname),
				'password': space(regpass),
				'fromadd': space(regfrom),
				//'email': space(regemail), 
				'key': key
			},
			beforeSend: function() {
				$('#errmsg').show().html('<div class="spinner"><div class="double-bounce1"></div><div class="double-bounce2"></div></div>')
			},
			success: function(data) {
				if (data == '1') {
					$('#errmsg').show().html('同一IP不能重复注册');
				} else if (data == '2') {
					$('#errmsg').show().html('管理员已关闭注册');
				} else if (data == '3') {
					$('#errmsg').show().html('您已登录，不能注册帐号');
				} else if (data == '4') {
					$('#errmsg').show().html('用户名，密码与邮箱不能为空');
				} else if (data == '5') {
					$('#errmsg').show().html('用户名长度有误');
				} else if (data == '6') {
					$('#errmsg').show().html('密码位数不够或过长');
				}else if (data == '7') {
					$('#errmsg').show().html('二次密码不一致');
				} else if (data == '8') {
					$('#errmsg').show().html('您输入的邮箱有误');
				} else if (data == '9') {
					$('#errmsg').show().html('用户名不能包含特殊字符');
				} else if (data == '10') {
					$('#errmsg').show().html('此用户名已被注册，请重填');
				} else if (data == '11') {
					$('#errmsg').show().html('此邮箱已被注册');
				}  else if (data == '12') {
					alert('注册成功，请等待审核');
					self.location = '/';
				} else if (data == '13' || data == '200') {			
					self.location = '/my';
				} else if (data == '14') {
					$('#errmsg').show().html('数据库出错');
				} else if (data == '15') {
					alert('激活帐号邮件已发送');
					self.location = '/user/';
				} else if (data == '98') {
					$('#errmsg').show().html('验证码已过期，请点击图片刷新')
				} else if (data == '99') {
					$('#errmsg').show().html('验证码填写错误')
				}else {
					alert('系统错误，请联系管理员');
				}
			}
		})
	});
});
//一键注册
$(function() {
	$("#reg-sub-zd").click(function() {
		$('#errmsg').hide();
		var regname = $("#regname").val();
		var regpass = $("#regpass").val();
		var regfrom = $("#regfrom").val();
		$.ajax({
			type: "POST",
			url: "/e/member/doaction.php",
			dataType: "html",
			data: {
				'ajax': '1',
				'enews': 'register',
				'groupid': '1',
				'edit': '0',
				'username': space(regname),
				'password': space(regpass),
				'startpass': space(regpass),
				'fromadd': space(regfrom),
			},
			beforeSend: function() {
				$(".spinner").show()
			},
			complete: function() {
				$(".spinner").hide()
			},
			success: function(data) {
				if (data == '13' || data == '200') {			
					self.location = '/my';
				} else if(data == '3') {
					alert('请先退出账号再注册');
				} else {
					alert('系统错误，请联系管理员');
				}
			}
		})
	});
});
//找回密码
$(function() {
	$("#pass-sub").click(function() {
		$('#errmsg').hide();
		var user = $("#getusername").val();
		var email = $("#getemail").val();
		var key = $("#getkey").val();
		if (user == "") {
			$('#errmsg').show().html("用户名不能为空！");
			$("#getusername").focus();
			return false
		};
		if (email == "") {
			$('#errmsg').show().html("邮箱不能为空！");
			$("#getemail").focus();
			return false
		};
		if (key == "") {
			$('#errmsg').show().html("验证码不能为空！");
			$("#getkey").focus();
			return false
		};
		$.ajax({
			type: "POST",
			url: "/e/member/doaction.php",
			dataType: "html",
			data: {
				'ajax': '1',
				'username': user,
				'email': space(email),
				'key': key,
				enews: 'SendPassword'
			},
			beforeSend: function() {
				$('#errmsg').show().html('<div class="spinner"><div class="double-bounce1"></div><div class="double-bounce2"></div></div>')
			},
			success: function(data, status) {
				if (data == '1') {
					$('#errmsg').show().html('请输入用户名和邮箱')
				} else if (data == '2') {
					$('#errmsg').show().html('您输入的邮箱有误!')
				} else if (data == '3') {
					$('#errmsg').show().html('用户名或邮箱不正确')
				} else if (data == '98') {
					$('#errmsg').show().html('验证码已过期，请点击图片刷新')
				} else if (data == '99') {
					$('#errmsg').show().html('验证码填写错误')
				} else if (data == '4') {
					alert('网站已关闭取回密码功能，请联系管理员');
				} else if (data == '5') {
					$('#errmsg').show().html('<div class="spinner"><div class="double-bounce1"></div><div class="double-bounce2"></div></div>');
					alert('提交成功，请留意查看邮箱');
					self.location = '/user/';
				} else {
					alert('系统错误，请联系管理员');
				}
			}
		})
	});
});
//取回账号密码
$(function() {
	$("#pass-edit").click(function() {
		$('#errmsg').hide();
		var newpassword = $("#newpassword").val();
		var renewpassword = $("#renewpassword").val();
		var id = $("#id").val();
		var tt = $("#tt").val();
		var cc = $("#cc").val();
		if (newpassword == "") {
			$('#errmsg').show().html("新密码不能为空");
			$("#newpassword").focus();
			return false
		};
		if (renewpassword == "") {
			$('#errmsg').show().html("二次密码不一致");
			$("#renewpassword").focus();
			return false
		};
		$.ajax({
			type: "POST",
			url: "/e/member/doaction.php",
			dataType: "html",
			data: {
				'ajax': '1',
				'newpassword': space(newpassword),
				'renewpassword': space(renewpassword),
				'id': id,
				'tt': tt,
				'cc': cc,
				enews: 'DoGetPassword'
			},
			beforeSend: function() {
				$('#errmsg').show().html('<div class="spinner"><div class="double-bounce1"></div><div class="double-bounce2"></div></div>')
			},
			success: function(data, status) {
				if (data == '1') {
					$('#errmsg').show().html('网站已关闭取回密码功能');
				} else if (data == '2') {
					$('#errmsg').show().html('二次密码不一致');
				} else if (data == '200') {
					$('#errmsg').show().html('<div class="spinner"><div class="double-bounce1"></div><div class="double-bounce2"></div></div>');
					alert('密码修改成功');
					self.location = '/user/';
				} else {
					alert('系统错误，请联系管理员');
				}
			}
		})
	});
});
//重新激活
$(function() {
	$("#jihuo-sub").click(function() {
		$('#errmsg').hide();
		var user = $("#jhusername").val();
		var pass = $("#jhpassword").val();
		var email = $("#jhemail").val();
		var newemail = $("#newemail").val();
		var key = $("#jhkey").val();
		if (key == "") {
			$('#errmsg').show().html("验证码不能为空！");
			$("#jhkey").focus();
			return false
		};
		if (user == "") {
			$('#errmsg').show().html("用户名不能为空！");
			$("#jhusername").focus();
			return false
		};
		if (pass == "") {
			$('#errmsg').show().html("密码不能为空！");
			$("#jhpassword").focus();
			return false
		};
		if (email == "") {
			$('#errmsg').show().html("邮箱不能为空！");
			$("#jhemail").focus();
			return false
		};
		if (key == "") {
			$('#errmsg').show().html("验证码不能为空！");
			$("#jhkey").focus();
			return false
		};
		$.ajax({
			type: "POST",
			url: "/e/member/doaction.php",
			dataType: "html",
			data: {
				'ajax': '1',
				'username': space(user),
				'password': space(pass),
				'email': space(email),
				'newemail': space(newemail),
				'key': key,
				enews: 'RegSend'
			},
			beforeSend: function() {
				$('#errmsg').show().html('<div class="spinner"><div class="double-bounce1"></div><div class="double-bounce2"></div></div>')
			},
			success: function(data, status) {
				if (data == '1') {
					$('#errmsg').show().html('网站没有启用邮件激活帐号方')
				} else if (data == '2') {
					$('#errmsg').show().html('请输入用户名、密码和邮箱')
				} else if (data == '3') {
					$('#errmsg').show().html('您输入的邮箱有误!')
				} else if (data == '4') {
					$('#errmsg').show().html('用户名不正确')
				} else if (data == '5') {
					$('#errmsg').show().html('密码不正确')
				} else if (data == '6') {
					$('#errmsg').show().html('邮箱不正确')
				} else if (data == '7') {
					$('#errmsg').show().html('此帐号已激活过')
				} else if (data == '15') {
					alert('激活帐号邮件已发送');
					self.location = '/user/';
				} else if (data == '98') {
					$('#errmsg').show().html('验证码已过期，请点击图片刷新')
				} else if (data == '99') {
					$('#errmsg').show().html('验证码填写错误')
				} else if (data == '200') {
					$('#errmsg').show().html('<img src="/style/img/loading.gif" /> 正在提交...');
					alert('激活帐号邮件已发送，请留意查看邮箱');
					self.location = '/user/';
				}
			}
		})
	});
});