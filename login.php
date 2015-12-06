<?php 
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
$link=connect();
$member_id=is_login($link);
if($member_id){
	skip('index.php','error','你已经登录，请不要重复登录！');
}
if(isset($_POST['submit'])){
	include 'inc/check_login.inc.php';
	escape($link,$_POST);
	$query="select * from cfc_member where name='{$_POST['name']}' and pw=md5('{$_POST['pw']}')";
	$result=execute($link, $query);
	if(mysqli_num_rows($result)==1){
		setcookie('cfc[name]',$_POST['name'],time()+3600);
		setcookie('cfc[pw]',sha1(md5($_POST['pw'])),time()+3600);
		//设置这个登录的会员对于的last_time这个字段为now()
		skip('index.php','ok','登录成功！');
	}else{
		skip('login.php', 'error', '用户名或密码填写错误！');
	}
}
$template['title']='欢迎登录';
$template['css']=array('style/public.css','style/register.css');
?>
<?php include 'inc/header.inc.php'?>
	<div id="register" class="auto">
		<h2>请登录</h2>
		<form method="post">
			<label>用户名：<input type="text" name="name"  /><span></span></label>
			<label>密码：<input type="password" name="pw"  /><span></span></label>
			<label>验证码：<input name="vcode" type="text"  /><span>*请输入下方验证码</span></label>
			<img class="vcode" src="show_code.php" />
			<div style="clear:both;"></div>
			<input class="btn" type="submit" name="submit" value="登录" />
		</form>
	</div>
<?php include 'inc/footer.inc.php'?>