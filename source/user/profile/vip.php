<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<?php global $userlogined,$erduo_in_username; ?>
<?php if(!$userlogined){header("location:".rewrite_mode('user.php/people/login/'));exit();} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>��ͨ��Ա - <?php echo IN_NAME; ?></title>
<meta name="Keywords" content="<?php echo IN_KEYWORDS; ?>" />
<meta name="Description" content="<?php echo IN_DESCRIPTION; ?>" />
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/lib.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/user/js/lib.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/user/js/profile.js"></script>
<script type="text/javascript">
function $(obj) {return document.getElementById(obj);}
var in_path = '<?php echo IN_PATH; ?>';
</script>
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
<li><a href="<?php echo rewrite_mode('user.php/profile/avatar/'); ?>"><span>�ҵ�ͷ��</span></a></li>
<li class="active"><a href="<?php echo rewrite_mode('user.php/profile/credit/'); ?>"><span>�����˻�</span></a></li>
<li><a href="<?php echo rewrite_mode('user.php/profile/oauth/'); ?>"><span>�ʺŰ�</span></a></li>
</ul>
</div>
<div class="l_status c_form">
<a href="<?php echo rewrite_mode('user.php/profile/credit/'); ?>">�ҵĻ���</a><span class="pipe">|</span>
<a href="<?php echo rewrite_mode('user.php/profile/vip/'); ?>" class="active">��ͨ��Ա</a><span class="pipe">|</span>
<a href="<?php echo rewrite_mode('user.php/profile/pay/'); ?>">��ֵ���</a>
</div>
<form method="get" onsubmit="getvip();return false;" class="c_form">
<table cellspacing="0" cellpadding="0" class="formtable">
<tr>��Աÿ���ۼ�Ϊ <span style="font-weight:bold;"><?php echo IN_VIPPOINTS; ?></span> ��ң��ۼƹ���ʱ����360���Զ�ת�긶��</tr>
<tr><th style="width:10em;">��¼����:</th><td><input type="password" id="password" class="t_input" /><br />�ύǰ���������¼���롣</td></tr>
<tr><th style="width:10em;">�û���:</th><td><input type="text" id="uname" value="<?php echo $erduo_in_username; ?>" class="t_input" /><br />�����������ͻ�Ա�����ѡ�</td></tr>
<tr><th style="width:10em;">��������:</th><td>
<select id="vipnum">
<option value="1">1����</option>
<option value="2">2����</option>
<option value="3">3����</option>
<option value="4">4����</option>
<option value="5">5����</option>
<option value="6">6����</option>
<option value="7">7����</option>
<option value="8">8����</option>
<option value="9">9����</option>
<option value="10">10����</option>
<option value="11">11����</option>
<option value="12">12����</option>
</select>
</td></tr>
<tr><th style="width:10em;"></th><td><input type="submit" value="������ͨ" class="submit" /></td></tr>
</table>
</form>
</div>
<div id="bottom"></div>
</div>
<?php include 'source/user/people/bottom.php'; ?>
</body>
</html>