<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>�û���¼ - <?php echo IN_NAME; ?></title>
<meta name="Keywords" content="<?php echo IN_KEYWORDS; ?>" />
<meta name="Description" content="<?php echo IN_DESCRIPTION; ?>" />
<link href="<?php echo IN_PATH; ?>static/pack/asynctips/asynctips.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/asynctips/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/asynctips/asyncbox.v1.4.5.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/lib.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/user/js/lib.js"></script>
<script type="text/javascript">
function $(obj) {return document.getElementById(obj);}
var in_path = '<?php echo IN_PATH; ?>';
var guide_url = '<?php echo rewrite_mode('user.php/people/home/'); ?>';
var pop = {
	up: function(scrolling, text, url, width, height, top) {
		layer.open({
			type: 2,
			maxmin: true,
			title: text,
			content: [url, scrolling],
			area: [width, height],
			offset: top,
			shade: false
		});
	}
}
function qzone_return(type){
        layer.closeAll();
        if(type==1){
            uc_syn('login');
            location.href = guide_url;
        }else{
            location.href = '<?php echo rewrite_mode('user.php/people/connect/'); ?>';
        }
}
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
<form method="get" onsubmit="login(0);return false;" class="c_form">
<table cellpadding="0" cellspacing="0" class="formtable">
<caption>
<h2>�û���¼</h2>
<p>������ڱ�վ��ӵ���ʺţ���ʹ�����е��ʺ���Ϣֱ�ӽ��е�¼���ɣ������ظ�ע�ᡣ</p>
</caption>
<tbody>
<tr><th width="100">�û���</th><td><input type="text" id="username" class="t_input" /><span id="username_tips" style="color:red"></span></td></tr>
<tr><th width="100">�ܡ���</th><td><input type="password" id="password" class="t_input" /><span id="password_tips" style="color:red"></span></td></tr>
<tr><th width="100">��֤��</th><td><input type="text" id="seccode" class="t_input" style="width:45px;" maxlength="4" />&nbsp;<img id="img_seccode" src="<?php echo rewrite_mode('user.php/people/seccode/'); ?>" align="absmiddle" />&nbsp;<a href="javascript:update_seccode()">����</a><span id="seccode_tips" style="color:red"></span></td></tr>
</tbody>
<tr><th width="100">&nbsp;</th><td>
<input type="submit" value="��¼" class="submit" />
<a href="<?php echo rewrite_mode('user.php/people/lostpasswd/'); ?>">��������?</a>
</td></tr>
<tr><th width="100">&nbsp;</th><td>
<a href="javascript:void(0)" onclick="pop.up('no', 'QQ��¼', in_path+'source/pack/connect/login.php', '700px', '430px', '100px');"><img src="<?php echo IN_PATH; ?>static/user/images/connect.gif" /></a>
</td></tr>
</table>
</form>
<div class="c_form">
<table cellpadding="0" cellspacing="0" class="formtable">
<caption>
<h2>��û��ע����</h2>
<p>�����û�б�վ��ͨ���ʺţ�����ע��һ�������Լ����ʺŰɡ�</p>
</caption>
<tr><td>
<a href="<?php echo rewrite_mode('user.php/people/register/'); ?>" style="display:block;margin:0 110px 2em;width:100px;border:1px solid #486B26;background:#76A14F;line-height:30px;font-size:14px;text-align:center;text-decoration:none;"><strong style="display:block;border-top:1px solid #9EBC84;color:#FFF;padding:0 0.5em;">����ע��</strong></a>
</td></tr>
</table>
</div>
<?php include 'source/user/people/bottom.php'; ?>
</body>
</html>