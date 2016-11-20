<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<?php global $db,$userlogined,$erduo_in_userid,$erduo_in_username,$erduo_in_mail,$erduo_in_isstar,$erduo_in_sex,$erduo_in_address,$erduo_in_birthday,$erduo_in_introduce; ?>
<?php if(!$userlogined){header("location:".rewrite_mode('user.php/people/login/'));exit();} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>�������� - <?php echo IN_NAME; ?></title>
<meta name="Keywords" content="<?php echo IN_KEYWORDS; ?>" />
<meta name="Description" content="<?php echo IN_DESCRIPTION; ?>" />
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/lib.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/city/city.js"></script>
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
<a href="<?php echo rewrite_mode('user.php/profile/index/'); ?>" class="active">��������</a><span class="pipe">|</span>
<a href="<?php echo rewrite_mode('user.php/profile/password/'); ?>">�޸�����</a><span class="pipe">|</span>
<a href="<?php echo rewrite_mode('user.php/profile/mail/'); ?>">�ܱ�����</a><span class="pipe">|</span>
<a href="<?php echo rewrite_mode('user.php/profile/verify/'); ?>">������֤</a>
</div>
<form method="get" onsubmit="editprofile();return false;" class="c_form">
<table cellspacing="0" cellpadding="0" class="formtable">
<tr><th style="width:10em;">�û���:</th><td><?php echo $erduo_in_username; ?></td></tr>
<tr><th style="width:10em;">����:</th><td><?php echo $erduo_in_mail; ?> (<a href="<?php echo rewrite_mode('user.php/profile/mail/'); ?>">�޸�����</a>)</td></tr>
<tr><th style="width:10em;">��ʵ����:</th><td>
<?php
$row = $db->getrow("select * from ".tname('verify')." where in_uid=".$erduo_in_userid);
if($erduo_in_isstar == 1){
        echo "<span style=\"font-weight:bold;\">".$row['in_name']."</span>[<font color=\"red\">����֤</font>]";
}elseif($erduo_in_isstar == 2){
        echo "<span style=\"font-weight:bold;\">".$row['in_name']."</span>[<font color=\"red\">�����</font>]";
}else{
        echo "<span style=\"font-weight:bold;\">".$row['in_name']."</span>[<a href=\"".rewrite_mode('user.php/profile/verify/')."\">δ��֤</a>]";
}
?>
</td></tr>
<tr><th style="width:10em;">�Ա�:</th><td>
<select id="sex">
<option value="0">˧��</option>
<option value="1"<?php if($erduo_in_sex == 1){echo " selected";} ?>>��Ů</option>
</select>
</td></tr>
<?php
$address = explode("-", $erduo_in_address);
$province = isset($address[0]) ? $address[0] : NULL;
$city = isset($address[1]) ? $address[1] : NULL;
?>
<tr><th>����:</th><td>
<select onchange="javascript:gettown(this.options[this.selectedIndex].value,&quot;&quot;,&quot;city&quot;)" id="province"><option value="">ʡ</option></select>
<select id="city"><option value="">��</option></select>
</td></tr>
<script type="text/javascript">getcity('<?php echo $province; ?>', 'province', '<?php echo $city; ?>', 'city');</script>
<?php
$birthday = explode("-", $erduo_in_birthday);
$year = isset($birthday[0]) ? $birthday[0] : NULL;
$month = isset($birthday[1]) ? $birthday[1] : NULL;
$day = isset($birthday[2]) ? $birthday[2] : NULL;
?>
<tr><th>����:</th><td>
<select id="year">
<option value="">��</option>
<?php
for($i=0;$i<100;$i++){
        $they=date('Y')-$i;
        if($they>=1970){
                if($year==$they){
                        echo "<option value=\"".$they."\" selected>".$they."</option>";
                }else{
                        echo "<option value=\"".$they."\">".$they."</option>";
                }
        }
}
?>
</select>
<select id="month">
<option value="">��</option>
<?php
for($i=1;$i<13;$i++){
        if($i<=9){
                $m="0".$i;
        }else{
                $m=$i;
        }
        if($month==$m){
                echo "<option value=\"".$m."\" selected>".$m."</option>";
        }else{
                echo "<option value=\"".$m."\">".$m."</option>";
        }
}
?>
</select>
<select id="day">
<option value="">��</option>
<?php
for($i=1;$i<32;$i++){
        if($i<=9){
                $d="0".$i;
        }else{
                $d=$i;
        }
        if($day==$d){
                echo "<option value=\"".$d."\" selected>".$d."</option>";
        }else{
                echo "<option value=\"".$d."\">".$d."</option>";
        }
}
?>
</select>
</td></tr>
<tr><th>���˽���:</th><td><textarea id="introduce" rows="3" cols="50"><?php echo $erduo_in_introduce; ?></textarea></td></tr>
<tr><th style="width:10em;"></th><td><input type="submit" value="��������" class="submit" /></td></tr>
</table>
</form>
</div>
<div id="bottom"></div>
</div>
<?php include 'source/user/people/bottom.php'; ?>
</body>
</html>