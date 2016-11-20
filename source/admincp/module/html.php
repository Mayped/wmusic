<?php
if(!defined('IN_ROOT')){exit('Access denied');}
Administrator(6);
$action=SafeRequest("action","get");
switch($action){
	case 'video':
		html_top();
		html_video();
		html_bottom();
		break;
	case 'singer':
		html_top();
		html_singer();
		html_bottom();
		break;
	case 'special':
		html_top();
		html_special();
		html_bottom();
		break;
	case 'music':
		html_top();
		html_music();
		html_bottom();
		break;
	case 'mainjump':
		mainjump();
		break;
	default:
		html_top();
		html_index();
		html_bottom();
		break;
} function html_top(){
        global $action;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>��̬����</title>
<link href="static/admincp/css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">function $(obj) {return document.getElementById(obj);}</script>
</head>
<body>
<div class="container">
<?php if($action==""){echo "<script type=\"text/javascript\">parent.document.title = 'Ear Music Board �������� - ��̬���� - ������ҳ';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='��̬����&nbsp;&raquo;&nbsp;������ҳ';</script>";} ?>
<?php if($action=="music"){echo "<script type=\"text/javascript\">parent.document.title = 'Ear Music Board �������� - ��̬���� - ��������';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='��̬����&nbsp;&raquo;&nbsp;��������';</script>";} ?>
<?php if($action=="special"){echo "<script type=\"text/javascript\">parent.document.title = 'Ear Music Board �������� - ��̬���� - ����ר��';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='��̬����&nbsp;&raquo;&nbsp;����ר��';</script>";} ?>
<?php if($action=="singer"){echo "<script type=\"text/javascript\">parent.document.title = 'Ear Music Board �������� - ��̬���� - ���ɸ���';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='��̬����&nbsp;&raquo;&nbsp;���ɸ���';</script>";} ?>
<?php if($action=="video"){echo "<script type=\"text/javascript\">parent.document.title = 'Ear Music Board �������� - ��̬���� - ������Ƶ';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='��̬����&nbsp;&raquo;&nbsp;������Ƶ';</script>";} ?>
<div class="floattop"><div class="itemtitle"><h3><?php if($action=="music"){echo "��������";}else if($action=="special"){echo "����ר��";}else if($action=="singer"){echo "���ɸ���";}else if($action=="video"){echo "������Ƶ";}else{echo "������ҳ";} ?></h3><ul class="tab1">
<?php if($action==""){echo "<li class=\"current\">";}else{echo "<li>";} ?><a href="?iframe=html"><span>������ҳ</span></a></li>
<?php if($action=="music"){echo "<li class=\"current\">";}else{echo "<li>";} ?><a href="?iframe=html&action=music"><span>��������</span></a></li>
<?php if($action=="special"){echo "<li class=\"current\">";}else{echo "<li>";} ?><a href="?iframe=html&action=special"><span>����ר��</span></a></li>
<?php if($action=="singer"){echo "<li class=\"current\">";}else{echo "<li>";} ?><a href="?iframe=html&action=singer"><span>���ɸ���</span></a></li>
<?php if($action=="video"){echo "<li class=\"current\">";}else{echo "<li>";} ?><a href="?iframe=html&action=video"><span>������Ƶ</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<?php } function html_index(){ ?>
<form method="post" name="form" target="iframe">
<table class="tb tb2">
<tr><th class="partition">������ҳ</th></tr>
</table>
<table class="tb tb2">
<tr>
<td><input type="submit" class="btn" value="������ҳ" onclick="form.action='?iframe=html_index'" /></td>
</tr>
</table>
</form>
<?php } function html_music(){ ?>
<form method="post" name="form" target="iframe">
<table class="tb tb2">
<tr><th class="partition">��������</th></tr>
</table>
<table class="tb tb2">
<tr>
<td><select name="listid">
<option value="0">������Ŀ</option>
<?php
global $db;
$sql="select * from ".tname('class')." order by in_id asc";
$result=$db->query($sql);
if($result){
	while ($row=$db->fetch_array($result)){
		echo "<option value=\"".$row['in_id']."\">".$row['in_name']."</option>";
	}
}
?>
</select></td>
<td><input type="submit" class="btn" value="������Ŀ" onclick="form.action='?iframe=html_list&table=class'" /></td>
</tr>
<tr>
<td><select name="classid">
<option value="0">��������</option>
<?php
$sql="select * from ".tname('class')." order by in_id asc";
$result=$db->query($sql);
if($result){
	while ($row=$db->fetch_array($result)){
		echo "<option value=\"".$row['in_id']."\">".$row['in_name']."</option>";
	}
}
?>
</select></td>
<td><input type="submit" class="btn" value="��������" onclick="form.action='?iframe=html_info&table=music&ac=class'" /></td>
</tr>
<tr>
<td><select name="dayid">
<option value="0">�������</option>
<option value="1">�������</option>
<option value="2">ǰ�����</option>
</select></td>
<td><input type="submit" class="btn" value="��������" onclick="form.action='?iframe=html_info&table=music&ac=day'" /></td>
</tr>
</table>
</form>
<?php } function html_special(){ ?>
<form method="post" name="form" target="iframe">
<table class="tb tb2">
<tr><th class="partition">����ר��</th></tr>
</table>
<table class="tb tb2">
<tr>
<td><select name="listid">
<option value="0">������Ŀ</option>
<?php
global $db;
$sql="select * from ".tname('special_class')." order by in_id asc";
$result=$db->query($sql);
if($result){
	while ($row=$db->fetch_array($result)){
		echo "<option value=\"".$row['in_id']."\">".$row['in_name']."</option>";
	}
}
?>
</select></td>
<td><input type="submit" class="btn" value="������Ŀ" onclick="form.action='?iframe=html_list&table=special_class'" /></td>
</tr>
<tr>
<td><select name="classid">
<option value="0">����ר��</option>
<?php
$sql="select * from ".tname('special_class')." order by in_id asc";
$result=$db->query($sql);
if($result){
	while ($row=$db->fetch_array($result)){
		echo "<option value=\"".$row['in_id']."\">".$row['in_name']."</option>";
	}
}
?>
</select></td>
<td><input type="submit" class="btn" value="����ר��" onclick="form.action='?iframe=html_info&table=special&ac=class'" /></td>
</tr>
<tr>
<td><select name="dayid">
<option value="0">�������</option>
<option value="1">�������</option>
<option value="2">ǰ�����</option>
</select></td>
<td><input type="submit" class="btn" value="����ר��" onclick="form.action='?iframe=html_info&table=special&ac=day'" /></td>
</tr>
</table>
</form>
<?php } function html_singer(){ ?>
<form method="post" name="form" target="iframe">
<table class="tb tb2">
<tr><th class="partition">���ɸ���</th></tr>
</table>
<table class="tb tb2">
<tr>
<td><select name="listid">
<option value="0">������Ŀ</option>
<?php
global $db;
$sql="select * from ".tname('singer_class')." order by in_id asc";
$result=$db->query($sql);
if($result){
	while ($row=$db->fetch_array($result)){
		echo "<option value=\"".$row['in_id']."\">".$row['in_name']."</option>";
	}
}
?>
</select></td>
<td><input type="submit" class="btn" value="������Ŀ" onclick="form.action='?iframe=html_list&table=singer_class'" /></td>
</tr>
<tr>
<td><select name="classid">
<option value="0">���и���</option>
<?php
$sql="select * from ".tname('singer_class')." order by in_id asc";
$result=$db->query($sql);
if($result){
	while ($row=$db->fetch_array($result)){
		echo "<option value=\"".$row['in_id']."\">".$row['in_name']."</option>";
	}
}
?>
</select></td>
<td><input type="submit" class="btn" value="���ɸ���" onclick="form.action='?iframe=html_info&table=singer&ac=class'" /></td>
</tr>
<tr>
<td><select name="dayid">
<option value="0">�������</option>
<option value="1">�������</option>
<option value="2">ǰ�����</option>
</select></td>
<td><input type="submit" class="btn" value="���ɸ���" onclick="form.action='?iframe=html_info&table=singer&ac=day'" /></td>
</tr>
</table>
</form>
<?php } function html_video(){ ?>
<form method="post" name="form" target="iframe">
<table class="tb tb2">
<tr><th class="partition">������Ƶ</th></tr>
</table>
<table class="tb tb2">
<tr>
<td><select name="listid">
<option value="0">������Ŀ</option>
<?php
global $db;
$sql="select * from ".tname('video_class')." order by in_id asc";
$result=$db->query($sql);
if($result){
	while ($row=$db->fetch_array($result)){
		echo "<option value=\"".$row['in_id']."\">".$row['in_name']."</option>";
	}
}
?>
</select></td>
<td><input type="submit" class="btn" value="������Ŀ" onclick="form.action='?iframe=html_list&table=video_class'" /></td>
</tr>
<tr>
<td><select name="classid">
<option value="0">������Ƶ</option>
<?php
$sql="select * from ".tname('video_class')." order by in_id asc";
$result=$db->query($sql);
if($result){
	while ($row=$db->fetch_array($result)){
		echo "<option value=\"".$row['in_id']."\">".$row['in_name']."</option>";
	}
}
?>
</select></td>
<td><input type="submit" class="btn" value="������Ƶ" onclick="form.action='?iframe=html_info&table=video&ac=class'" /></td>
</tr>
<tr>
<td><select name="dayid">
<option value="0">�������</option>
<option value="1">�������</option>
<option value="2">ǰ�����</option>
</select></td>
<td><input type="submit" class="btn" value="������Ƶ" onclick="form.action='?iframe=html_info&table=video&ac=day'" /></td>
</tr>
</table>
</form>
<?php } function html_bottom(){ ?>
	<h3>Ear Music ��ʾ</h3>
        <div class="infobox"><iframe name="iframe" frameborder="0" width="100%" height="100%" src="?iframe=html&action=mainjump"></iframe></div>
        </div>
        </body>
        </html>
<?php } ?>