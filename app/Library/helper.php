<?php

//发送短信的方法
function sendphone ($phone)
{
	//Account Sid
	$options['accountsid']='0bf924ac5246c6f6f17f482d3b45ecb3';

	//Auth Token
	$options['token']='0e3477be626a897215c607c968877979';

	//初始化 $options必填
	$ucpass = new Ucpaas($options);

	//应用的ID
	$appid = "3e8ed8ba47574ea2baf0b7810f564926";	

	//短信模板
	$templateid = "387051";    

	//验证码
	$param = substr(strval(rand(10000,19999)),1,4);

	\Cookie::queue('message',$param,10);

	//手机号
	$mobile = $phone;

	$uid = "";

	//70字内（含70字）计一条，超过70字，按67字/条计费，超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。
	echo  $ucpass->SendSms($appid,$templateid,$param,$mobile,$uid);

}

	
	