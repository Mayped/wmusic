<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<?php global $userlogined,$erduo_in_userid,$erduo_in_userpassword; ?>
<?php if(!$userlogined){header("location:".rewrite_mode('user.php/people/login/'));exit();} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>�ҵ�ͷ�� - <?php echo IN_NAME; ?></title>
<meta name="Keywords" content="<?php echo IN_KEYWORDS; ?>" />
<meta name="Description" content="<?php echo IN_DESCRIPTION; ?>" />
<style type="text/css">
@import url(<?php echo IN_PATH; ?>static/user/css/style.css);
</style>
</head>
<body>
<?php include 'source/user/people/top.php'; ?>
<div id="main">
<?php include 'source/user/people/left.php'; ?>
<div id="mainarea">
<h2 class="title"><img src="<?php echo IN_PATH; ?>static/user/images/icon/profile.gif">��������</h2>
<div class="tabs_header">
<ul class="tabs">
<li><a href="<?php echo rewrite_mode('user.php/profile/index/'); ?>"><span>��������</span></a></li>
<li class="active"><a href="<?php echo rewrite_mode('user.php/profile/avatar/'); ?>"><span>�ҵ�ͷ��</span></a></li>
<li><a href="<?php echo rewrite_mode('user.php/profile/credit/'); ?>"><span>�����˻�</span></a></li>
<li><a href="<?php echo rewrite_mode('user.php/profile/oauth/'); ?>"><span>�ʺŰ�</span></a></li>
</ul>
</div>
<script type="text/javascript">
function updateavatar() {
	location.reload();
}
</script>
<div class="c_form">
<table cellspacing="0" cellpadding="0" class="formtable">
<caption><h2>��ǰ�ҵ�ͷ��</h2><p>�������û�������Լ���ͷ��ϵͳ����ʾΪĬ��ͷ������Ҫ�Լ��ϴ�һ������Ƭ����Ϊ�Լ��ĸ���ͷ��</p></caption>
<tr><td><img src="<?php echo getavatar($erduo_in_userid, 'big'); ?>"></td></tr>
</table>
<table cellspacing="0" cellpadding="0" class="formtable">
<caption><h2>�����ҵ���ͷ��</h2><p>��ѡ��һ������Ƭ�����ϴ��༭��</p></caption><tr><td>
<?php
if(IN_UPOPEN == 1){
        $script = 'http://'.$_SERVER['HTTP_HOST'].IN_PATH.'source/pack/upload/avatar.php';
}elseif(IN_REMOTE == 1){
        $script = 'http://'.$_SERVER['HTTP_HOST'].IN_PATH.'source/plugin/'.IN_REMOTEPK.'/avatar.php';
        if(!is_file(str_replace('http://'.$_SERVER['HTTP_HOST'].IN_PATH, IN_ROOT, $script))){
                $script = 'http://'.$_SERVER['HTTP_HOST'].IN_PATH.'source/pack/upload/avatar.php';
        }
}else{
        $script = 'http://'.$_SERVER['HTTP_HOST'].IN_PATH.'source/pack/ftp/avatar.php';
}
if(IN_UCOPEN == 1){
	require_once IN_ROOT.'./client/ucenter.php';
	require_once IN_ROOT.'./client/client.php';
	global $erduo_in_username,$erduo_in_ucid;
	$ucid = uc_get_user($erduo_in_username);
	if($erduo_in_ucid > 0 && $erduo_in_ucid == $ucid[0]){
		echo uc_avatar($ucid[0]);
	}else{
		echo "<embed src=\"".IN_PATH."static/pack/upload/camera.swf?ucapi=".urlencode($script)."&input=".urlencode('uid=').$erduo_in_userid.":".$erduo_in_userpassword."\" width=\"450\" height=\"253\" wmode=\"transparent\" type=\"application/x-shockwave-flash\"></embed>";
	}
}else{
	echo "<embed src=\"".IN_PATH."static/pack/upload/camera.swf?ucapi=".urlencode($script)."&input=".urlencode('uid=').$erduo_in_userid.":".$erduo_in_userpassword."\" width=\"450\" height=\"253\" wmode=\"transparent\" type=\"application/x-shockwave-flash\"></embed>";
}
?>
</td></tr><tr><td>��ʾ��ͷ�񱣴����������Ҫˢ��һ�±�ҳ��(��F5��)�����ܲ鿴���µ�ͷ��Ч����</td></tr></table></div>
</div>
<div id="bottom"></div>
</div>
<?php include 'source/user/people/bottom.php'; ?>
</body>
</html>