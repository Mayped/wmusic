<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<?php global $db,$userlogined,$erduo_in_userid,$erduo_in_isstar; ?>
<?php if(!$userlogined){header("location:".rewrite_mode('user.php/people/login/'));exit();} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>������֤ - <?php echo IN_NAME; ?></title>
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
<li class="active"><a href="<?php echo rewrite_mode('user.php/profile/index/'); ?>"><span>��������</span></a></li>
<li><a href="<?php echo rewrite_mode('user.php/profile/avatar/'); ?>"><span>�ҵ�ͷ��</span></a></li>
<li><a href="<?php echo rewrite_mode('user.php/profile/credit/'); ?>"><span>�����˻�</span></a></li>
<li><a href="<?php echo rewrite_mode('user.php/profile/oauth/'); ?>"><span>�ʺŰ�</span></a></li>
</ul>
</div>
<div class="l_status c_form">
<a href="<?php echo rewrite_mode('user.php/profile/index/'); ?>">��������</a><span class="pipe">|</span>
<a href="<?php echo rewrite_mode('user.php/profile/password/'); ?>">�޸�����</a><span class="pipe">|</span>
<a href="<?php echo rewrite_mode('user.php/profile/mail/'); ?>">�ܱ�����</a><span class="pipe">|</span>
<a href="<?php echo rewrite_mode('user.php/profile/verify/'); ?>" class="active">������֤</a>
</div>
<form method="get" onsubmit="editverify();return false;" class="c_form">
<table cellspacing="0" cellpadding="0" class="formtable">
<tr>[<?php if($erduo_in_isstar == 1){echo "<span style=\"font-weight:bold;color:red;\">����֤</span>";}elseif($erduo_in_isstar == 2){echo "<font color=\"red\">�����</font>";}else{echo "<span style=\"font-weight:bold;\">δ��֤</span>";} ?>] �޸���֤���ϻ������ύ��ˣ���վ��ŵ����й©�û�����˽���ϡ�</tr>
<tr><th style="width:10em;">��¼����:</th><td><input type="password" id="password" class="t_input" /><br />�ύǰ���������¼���롣</td></tr>
<?php $row = $db->getrow("select * from ".tname('verify')." where in_uid=".$erduo_in_userid); ?>
<tr><th style="width:10em;">��ʵ����:</th><td><input type="text" id="_name" value="<?php echo $row['in_name']; ?>" class="t_input" /><br />�������ͨ���󣬸����չ�������ĸ�����ҳ��</td></tr>
<tr><th style="width:10em;">֤������:</th><td>
<select id="_cardtype">
<option value="���֤">���֤</option>
<option value="����"<?php if($row['in_cardtype'] == '����'){echo " selected";} ?>>����</option>
<option value="��ʻ֤"<?php if($row['in_cardtype'] == '��ʻ֤'){echo " selected";} ?>>��ʻ֤</option>
</select>
</td></tr>
<tr><th style="width:10em;">֤������:</th><td><input type="text" id="_cardnum" value="<?php echo empty($row['in_cardnum']) ? NULL : substr($row['in_cardnum'], 0, 6).'************'; ?>" class="t_input" /><?php echo empty($row['in_cardnum']) ? NULL : '<br />�����粻�����뱣��ԭ����'; ?></td></tr>
<tr><th style="width:10em;">��ϵ��ַ:</th><td><input type="text" id="_address" value="<?php echo $row['in_address']; ?>" class="t_input" /></td></tr>
<tr><th style="width:10em;">�ֻ�����:</th><td><input type="text" id="_mobile" value="<?php echo $row['in_mobile']; ?>" class="t_input" /></td></tr>
<tr><th style="width:10em;"></th><td><input type="submit" value="�ύ���" class="submit" /></td></tr>
</table>
</form>
</div>
<div id="bottom"></div>
</div>
<?php include 'source/user/people/bottom.php'; ?>
</body>
</html>