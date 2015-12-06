<?php 
function skip($url,$pic,$message){
$html=<<<A
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8" />
<meta http-equiv="refresh" content="3;URL={$url}" />
<title>正在跳转中</title>
<link rel="stylesheet" type="text/css" href="style/remind.css" />
</head>
<body>
<div class="notice"><span class="pic {$pic}"></span> {$message}3秒后自动跳转中! <a href="{$url}">直接跳转</a></div>
</body>
</html>
A;
echo $html;
exit();
}
//验证前台用户是否登录
function is_login($link){
	if(isset($_COOKIE['cfc']['name']) && isset($_COOKIE['cfc']['pw'])){
		$query="select * from cfc_member where name='{$_COOKIE['cfc']['name']}' and sha1(pw)='{$_COOKIE['cfc']['pw']}'";
		$result=execute($link,$query);
		if(mysqli_num_rows($result)==1){
			$data=mysqli_fetch_assoc($result);
			return $data['id'];
		}else{
			return false;
		}
	}else{
		return false;
	}
}
function check_user($member_id,$content_member_id,$is_manage_login){
	if($member_id==$content_member_id || $is_manage_login){
		return true;
	}else{
		return false;
	}
}
//验证后台管理员是否登录
function is_manage_login($link){
	if(isset($_SESSION['manage']['name']) && isset($_SESSION['manage']['pw'])){
		$query="select * from cfc_manage where name='{$_SESSION['manage']['name']}' and sha1(pw)='{$_SESSION['manage']['pw']}'";
		$result=execute($link,$query);
		if(mysqli_num_rows($result)==1){
			return true;
		}else{
			return false;
		}
	}else{
		return false;
	}
}
?>