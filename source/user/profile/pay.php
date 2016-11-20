<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<?php global $db,$userlogined,$erduo_in_userid; ?>
<?php if(!$userlogined){header("location:".rewrite_mode('user.php/people/login/'));exit();} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>��ֵ��� - <?php echo IN_NAME; ?></title>
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
<a href="<?php echo rewrite_mode('user.php/profile/vip/'); ?>">��ͨ����</a><span class="pipe">|</span>
<a href="<?php echo rewrite_mode('user.php/profile/pay/'); ?>" class="active">��ֵ���</a>
</div>
<form method="get" onsubmit="getpay();return false;" class="c_form">
<table cellspacing="0" cellpadding="0" class="formtable">
<tr><th style="width:10em;">��ֵ���:</th><td><input type="text" id="_rmb" class="t_input" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" /><br />��λ��Ԫ����ֵ1ԪRMB���Ի�� <span style="font-weight:bold;"><?php echo IN_RMBPOINTS; ?></span> ��ҡ�</td></tr>
<tr><th style="width:10em;">��ֵ��ʽ:</th><td>
<select id="_type">
<option value="alipay">֧����</option>
</select>
</td></tr>
<tr><th style="width:10em;"></th><td><input type="submit" value="�ύ����" class="submit" /></td></tr>
</table>
<br />
<table cellspacing="0" cellpadding="0" class="listtable">
<thead>
<tr class="title">
<td>������</td>
<td align="center">���</td>
<td align="center">���</td>
<td align="center">״̬</td>
<td align="center">֧��ʱ��</td>
</tr>
</thead>
<tr class="line"></tr>
<?php
$Arr = getuserpage("select * from ".tname('paylog')." where in_uid=".$erduo_in_userid." order by in_addtime desc", 20, 3);
$result = $db->query($Arr[2]);
$count = $db->num_rows($result);
?>
<?php
if($count == 0){
?>
<tr><td>���޶���</td></tr>
<?php
}
if($result){
while ($row = $db->fetch_array($result)){
?>
<tr>
<td><?php echo $row['in_title']; ?></td>
<td align="center"><?php echo $row['in_money']; ?></td>
<td align="center"><?php echo $row['in_points']; ?></td>
<td align="center"><?php if($row['in_lock']==0){echo "�ɹ�";}else{echo "<font color=\"red\">ʧ��</font>";} ?></td>
<td align="center"><?php echo $row['in_addtime']; ?></td>
</tr>
<?php
}
}
?>
</table>
</form>
<?php echo $Arr[0]; ?>
</div>
<div id="bottom"></div>
</div>
<?php include 'source/user/people/bottom.php'; ?>
</body>
</html>