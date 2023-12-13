// JavaScript Document
function chengstate(typeid,save)
{											//切换节点的开放/关闭
	typeobj	= eval("item"+typeid);
	obj		= eval("pr"+typeid);
	
	if(typeobj.style.display == '')
	{
		typeobj.style.display	= 'none';
	}else{
		typeobj.style.display	= '';
	}//end if
	switch (obj.className)
	{
		case "type1":
			obj.className	= "type2";
			break;
		case "type2":
			obj.className	= "type1";
			break;
		case "type3":
			obj.className	= "type4";
			break;
		case "type4":
			obj.className	= "type3";
			break;
	}//end switch
	if(save!=false)
	{
		setupcookie(typeid);			//保存状态
	}//end if
}//end funciton chengstaut

function setupcookie(typeid)
{										//存入cookie  保存节点状态
	var type	= new Array();
	var typestr	= new String();
	typeOpen	= false;
	if(checkCookieExist("type"))
	{									//判断是否是是否已经保存过cookie
		typestr		= getCookie("type");
		//alert(typestr);
		if(typestr.length>0)
		{								//判断type是否为空，，，否则分解为数组
			type	= typestr.split(",");
			for(i=0;i<type.length;i++)
			{
				if(type[i]==typeid)
				{						//如果是打开状态，，，删除记录
					type[i]='';
					typeOpen	= true;
				}//end if
			}//end for
			if(typeOpen==false)type[i] = typeid;
		}else{
			type[0]	= typeid;
		}//end if
	}else{
		type[0]	= typeid;
	}//end if
	typestr	= type.join(",");
	typestr	= typestr.replace(",,",",");
	if(typestr.substr(typestr.length-1,1)==',')typestr = typestr.substr(0,typestr.length-1);		//去掉最后的 ","
	if(typestr.substr(0,1)==',')typestr = typestr.substr(1,typestr.length-1);		//去掉开始的 ","
	saveCookie("type",typestr,1000);
	//alert(typestr);
	//deleteCookie("type");
}//end function setupcookie

function initialize()
{											//取得cookie  设置节点的缩放,,初始化菜单状态
	var type	= new Array();
	var typestr	= new String();
	
	if(checkCookieExist("type"))
	{									//判断是否是是否已经保存过cookie
		typestr		= getCookie("type");
		if(typestr.length>0)
		{								//判断长度是否合法
			type	= typestr.split(",");
			for(i=0;i<type.length;i++)
			{
				if(objExists(type[i]))			
				{						//验证对象是否存在
					chengstate(type[i],false);
				}//end if
			}//end for
			objExists(99);
		}//end if
	}//end if
}//end funciton setupstate

function objExists(objid)
{											//验证对象是否存在
	try
	{
		obj = eval("item"+objid);
	}//end try
	catch(obj)
	{
		return false;
	}//end catch
	
	if(typeof(obj)=="object")
	{
		return true;
	}//end if
	return false;
}//end function objExists
//--------------------------------------------------↓↓↓↓↓↓↓↓↓↓↓↓  执行Cookie 操作
function saveCookie(name, value, expires, path, domain, secure)
{											// 保存Cookie
  var strCookie = name + "=" + value;
  if (expires)
  {											// 计算Cookie的期限, 参数为天数
     var curTime = new Date();
     curTime.setTime(curTime.getTime() + expires*24*60*60*1000);
     strCookie += "; expires=" + curTime.toGMTString();
  }//end if
  // Cookie的路径
  strCookie +=  (path) ? "; path=" + path : ""; 
  // Cookie的Domain
  strCookie +=  (domain) ? "; domain=" + domain : "";
  // 是否需要保密传送,为一个布尔值
  strCookie +=  (secure) ? "; secure" : "";
  document.cookie = strCookie;
}//end funciton saveCookie

function getCookie(name)
{											// 使用名称参数取得Cookie值, null表示Cookie不存在
  var strCookies = document.cookie;
  var cookieName = name + "=";  // Cookie名称
  var valueBegin, valueEnd, value;
  // 寻找是否有此Cookie名称
  valueBegin = strCookies.indexOf(cookieName);
  if (valueBegin == -1) return null;  // 没有此Cookie
  // 取得值的结尾位置
  valueEnd = strCookies.indexOf(";", valueBegin);
  if (valueEnd == -1)
      valueEnd = strCookies.length;  // 最后一个Cookie
  // 取得Cookie值
  value = strCookies.substring(valueBegin+cookieName.length,valueEnd);
  return value;
}//end function getCookie

function checkCookieExist(name)
{											// 检查Cookie是否存在
  if (getCookie(name))
      return true;
  else
      return false;
}//end function checkCookieExist

function deleteCookie(name, path, domain)
{											// 删除Cookie
  var strCookie;
  // 检查Cookie是否存在
  if (checkCookieExist(name))
  {										    // 设置Cookie的期限为己过期
    strCookie = name + "="; 
    strCookie += (path) ? "; path=" + path : "";
    strCookie += (domain) ? "; domain=" + domain : "";
    strCookie += "; expires=Thu, 01-Jan-70 00:00:01 GMT";
    document.cookie = strCookie;
  }//end if
}//end function deleteCookie