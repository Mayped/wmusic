<?php
if(!defined('IN_ROOT')){exit('Access denied');}
Administrator(4);
$action=SafeRequest("action","get");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>���ֱ�ǩ</title>
<link href="static/admincp/css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">function $(obj) {return document.getElementById(obj);}</script>
</head>
<body>
<?php
switch($action){
	case 'add':
		adds();
		break;
	case 'edit':
		edits();
		break;
	default:
		main(empty($_GET['type']) ? 0 : intval($_GET['type']));
		break;
	}
?>
</body>
</html>
<?php
function main($type){
	global $db;
	$sql="select * from ".tname('tag')." where in_type=".$type." order by in_id asc";
	$result=$db->query($sql);
	$count=$db->num_rows($result);
?>
<div class="container">
<script type="text/javascript">parent.document.title = 'Ear Music Board �������� - ������� - ���ֱ�ǩ';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='�������&nbsp;&raquo;&nbsp;���ֱ�ǩ';</script>
<div class="floattop"><div class="itemtitle"><h3><?php if($type==1){echo "������";}elseif($type==2){echo "������";}elseif($type==3){echo "������";}elseif($type==4){echo "������";}else{echo "������";} ?></h3><ul class="tab1">
<?php if($type==0){echo "<li class=\"current\">";}else{echo "<li>";} ?><a href="?iframe=tag"><span>������</span></a></li>
<?php if($type==1){echo "<li class=\"current\">";}else{echo "<li>";} ?><a href="?iframe=tag&type=1"><span>������</span></a></li>
<?php if($type==2){echo "<li class=\"current\">";}else{echo "<li>";} ?><a href="?iframe=tag&type=2"><span>������</span></a></li>
<?php if($type==3){echo "<li class=\"current\">";}else{echo "<li>";} ?><a href="?iframe=tag&type=3"><span>������</span></a></li>
<?php if($type==4){echo "<li class=\"current\">";}else{echo "<li>";} ?><a href="?iframe=tag&type=4"><span>������</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th class="partition">�༭��ǩ</th></tr>
</table>
<form name="form" method="post" action="?iframe=tag&action=edit">
<table class="tb tb2">
<tr class="header">
<th>���</th>
<th>��ǩ����</th>
<th>״̬</th>
</tr>
<?php
if($count==0){
?>
<tr><td colspan="2" class="td27">û�б�ǩ</td></tr>
<?php
}
if($result){
while ($row = $db->fetch_array($result)){
?>
<tr class="hover">
<td class="td25"><?php echo $row['in_id']; ?></td>
<td><input type="text" name="in_title<?php echo $row['in_id']; ?>" value="<?php echo $row['in_title']; ?>" class="txt" /></td>
<td class="td25"><input type="hidden" name="in_id[]" id="in_id" value="<?php echo $row['in_id']; ?>"><input type="checkbox" class="checkbox" name="in_checks<?php echo $row['in_id']; ?>" value="1" checked />����</td>
</tr>
<?php
}
}
?>
</table>
<table class="tb tb2">
<tr><td colspan="15"><div class="fixsel"><input type="submit" class="btn" name="edit" value="�ύ�޸�" /></div></td></tr>
</table>
</form>

<table class="tb tb2">
<tr><th class="partition">������ǩ</th></tr>
</table>
<form method="post" action="?iframe=tag&action=add">
<table class="tb tb2">
<tr class="header">
<th>��ǩ����</th>
</tr>
<tr class="hover">
<td><input type="hidden" name="in_type" value="<?php echo $type; ?>"><input type="text" class="txt" size="25" name="in_title"></td>
</tr>
</table>
<table class="tb tb2">
<tr><td colspan="15"><div class="fixsel"><input type="submit" name="add" class="btn" value="����" /></div></td></tr>
</table>
</form>
</div>



<?php
}
	function adds(){
		global $db;
		if(!submitcheck('add')){ShowMessage("����֤�������޷��ύ��",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
		$in_type = SafeRequest("in_type","post");
		$in_title = SafeRequest("in_title","post");
		if(!IsNul($in_title)){ShowMessage("����������ǩ���Ʋ���Ϊ�գ�",$_SERVER['HTTP_REFERER'],"infotitle3",1000,1);}
		$sql="Insert ".tname('tag')." (in_title,in_type) values ('".$in_title."',".$in_type.")";
		if($db->query($sql)){
			ShowMessage("��ϲ������ǩ�����ɹ���",$_SERVER['HTTP_REFERER'],"infotitle2",1000,1);
		}else{
			ShowMessage("����������ǩ����ʧ�ܣ�",$_SERVER['HTTP_REFERER'],"infotitle3",3000,1);
		}
	}

	function edits(){
		global $db;
		if(!submitcheck('edit')){ShowMessage("����֤�������޷��ύ��",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
		$in_id = RequestBox("in_id");
		$ID=explode(",",$in_id);
		for($i=0;$i<count($ID);$i++){
			$in_title=SafeRequest("in_title".$ID[$i],"post");
			$in_checks=SafeRequest("in_checks".$ID[$i],"post");
			if(!IsNul($in_title)){ShowMessage("�޸ĳ�����ǩ���Ʋ���Ϊ�գ�",$_SERVER['HTTP_REFERER'],"infotitle3",1000,1);}
			if($in_checks==1){
				$sql="update ".tname('tag')." set in_title='".$in_title."' where in_id=".intval($ID[$i]);
			}else{
				$sql="delete from ".tname('tag')." where in_id=".intval($ID[$i]);
			}
			$db->query($sql);
		}
		ShowMessage("��ϲ������ǩ�޸ĳɹ���",$_SERVER['HTTP_REFERER'],"infotitle2",1000,1);
	}
?>