<?php 
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$link=connect();
include_once 'inc/is_manage_login.inc.php';//验证管理员是否登录


$query="select * from cfc_manage where id={$_SESSION['manage']['id']}";
$result_manage=execute($link, $query);
$data_manage=mysqli_fetch_assoc($result_manage);

$query="select count(*) from cfc_father_module";
$count_father_module=num($link,$query);

$query="select count(*) from cfc_son_module";
$count_son_module=num($link,$query);

$query="select count(*) from cfc_content";
$count_content=num($link,$query);

$query="select count(*) from cfc_reply";
$count_reply=num($link,$query);

$query="select count(*) from cfc_member";
$count_member=num($link,$query);

$query="select count(*) from cfc_manage";
$count_manage=num($link,$query);

if($data_manage['level']=='0'){
	$data_manage['level']='超级管理员';
}else{
	$data_manage['level']='普通管理员';
}
$template['title']='系统信息';
$template['css']=array('style/public.css');
?>
<?php include 'inc/header.inc.php'?>
<div id="main">
	<div class="title">系统信息</div>
	<div class="explain">
		<ul>
			<li>|- 您好，<?php echo $data_manage['name']?></li>
			<li>|- 所属角色：<?php echo $data_manage['level']?> </li>
			<li>|- 创建时间：<?php echo $data_manage['create_time']?></li>
		</ul>
	</div>
	<div class="explain">
		<ul>
			<li>|- 父版块(<?php echo $count_father_module?>)
			                 子版块(<?php echo $count_son_module?>)
			                 帖子(<?php echo $count_content?>)
			                 回复(<?php echo $count_reply?>)
			                 会员(<?php echo $count_member?>)
			                 管理员(<?php echo $count_manage?>)
			</li>
		</ul>
	</div>

	<div class="explain">
		<ul>
			<li>|- 程序作者：刘芝琦 :))</li>
			<li>|- 网站：<a target="_blank" href="http://www.crazyforcode.org">www.crazyforcode.org</a></li>
		</ul>
	</div>
</div>
<?php include 'inc/footer.inc.php'?>