<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>�û�ע�� - <?php echo IN_NAME; ?></title>
<meta name="Keywords" content="<?php echo IN_KEYWORDS; ?>" />
<meta name="Description" content="<?php echo IN_DESCRIPTION; ?>" />
<link href="<?php echo IN_PATH; ?>static/pack/asynctips/asynctips.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/asynctips/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/asynctips/asyncbox.v1.4.5.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/user/js/lib.js"></script>
<script type="text/javascript">
function $(obj) {return document.getElementById(obj);}
var in_path = '<?php echo IN_PATH; ?>';
var guide_url = '<?php echo rewrite_mode('user.php/people/home/'); ?>';
function update_seccode(){
	$('img_seccode').src = '<?php echo rewrite_mode('user.php/people/seccode/\' + Math.random() + \'/'); ?>';
}
</script>
<style type="text/css">
@import url(<?php echo IN_PATH; ?>static/user/css/style.css);
</style>
</head>
<body>
<?php include 'source/user/people/top.php'; ?>
<?php if(IN_REGOPEN == 0){ ?>
<div class="showmessage">
<div class="ye_r_t"><div class="ye_l_t"><div class="ye_r_b"><div class="ye_l_b">
<caption>
<h2>��Ϣ��ʾ</h2>
</caption>
<p><a href="<?php echo IN_PATH; ?>user.php">��վ��δ����ע�ᣬ���Ժ����ԣ�</a><script type="text/javascript">setTimeout("location.href='<?php echo IN_PATH; ?>user.php';", 3000);</script></p>
<p class="op"><a href="<?php echo IN_PATH; ?>user.php">ҳ����ת��...</a></p>
</div></div></div></div>
</div>
<?php }else{ ?>
<form method="get" onsubmit="register();return false;" class="c_form">
<table cellpadding="0" cellspacing="0" class="formtable">
<caption>
<h2>�û�ע��</h2>
<p>��������д������Ϣ����ע�ᡣ<br />ע����ɺ󣬸��ʺŽ���Ϊ���ڱ�վ��ͨ���ʺţ����������ܱ�վ�ṩ�ĸ��ַ���</p>
</caption>
<tr><th width="100">�û���</th><td><input type="text" id="username" class="t_input" /><span id="username_tips" style="color:red"></span><br />�� 3 �� 15 ���ַ���ɣ������пո�� < > ' " / \ ���ַ���</td></tr>
<tr><th width="100">ע������</th><td><input type="password" id="password" class="t_input" /><span id="password_tips" style="color:red"></span><br />��С����Ϊ 6 ���ַ���</td></tr>
<tr><th width="100">�ٴ���������</th><td><input type="password" id="password1" class="t_input" /><span id="password1_tips" style="color:red"></span></td></tr>
<tr><th width="100">����</th><td><input type="text" id="mail" class="t_input" /><span id="mail_tips" style="color:red"></span><br />��׼ȷ�����������䣬����������ʱ���ʼ������͵������䡣</td></tr>
<tr><th width="100">��֤��</th><td><input type="text" id="seccode" class="t_input" style="width:45px;" maxlength="4" />&nbsp;<img id="img_seccode" src="<?php echo rewrite_mode('user.php/people/seccode/'); ?>" align="absmiddle" />&nbsp;<a href="javascript:update_seccode()">����</a><span id="seccode_tips" style="color:red"></span></td></tr>
<tr><th width="100">&nbsp;</th><td><input type="submit" value="ע��" class="submit" /></td></tr>
<tr><th>&nbsp;</th><td></td></tr>
</table>
</form>
<?php } ?>
<?php include 'source/user/people/bottom.php'; ?>
</body>
</html>