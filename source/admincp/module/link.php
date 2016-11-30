<?php
if(!defined('IN_ROOT')){exit('Access denied');}
Administrator(7);
$action=SafeRequest("action","get");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>��������</title>
<link href="static/admincp/css/main.css" rel="stylesheet" type="text/css" />
<link href="static/pack/asynctips/asynctips.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="static/pack/asynctips/jquery.min.js"></script>
<script type="text/javascript" src="static/pack/asynctips/asyncbox.v1.4.5.js"></script>
<script type="text/javascript" src="static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="static/pack/layer/lib.js"></script>
<script type="text/javascript">
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
function CheckAll(form) {
	for (var i = 0; i < form.elements.length; i++) {
		var e = form.elements[i];
		if (e.name != 'chkall') {
			e.checked = form.chkall.checked;
		}
	}
}
function exchange_type(theForm){
	if (theForm.in_type.value =='2'){
		layer.tips('����д����ͼƬ��', '#in_cover', {
			tips: [3, '#3595CC'],
			time: 3000
		});
		theForm.in_cover.focus();
		return false;
	}
}
function CheckForm(){
        if(document.form1.in_name.value==""){
            asyncbox.tips("վ�����Ʋ���Ϊ�գ�����д��", "wait", 1000);
            document.form1.in_name.focus();
            return false;
        }
        else if(document.form1.in_url.value==""){
            asyncbox.tips("���ӵ�ַ����Ϊ�գ�����д��", "wait", 1000);
            document.form1.in_url.focus();
            return false;
        }
        else {
            return true;
        }
}
</script>
</head>
<body>
<?php
switch($action){
	case 'add':
		Add();
		break;
	case 'saveadd':
		SaveAdd();
		break;
	case 'edit':
		Edit();
		break;
	case 'saveedit':
		SaveEdit();
		break;
	case 'del':
		Del();
		break;
	case 'editisindex':
		editisindex();
		break;
	case 'alleditsave':
		alleditsave();
		break;
	default:
		main("select * from ".tname('link')." order by in_order asc",20);
		break;
	}
?>
</body>
</html>
<?php
function EditBoard($Arr,$url,$arrname){
	$in_name = $Arr[0];
	$in_url = $Arr[1];
	$in_cover = $Arr[2];
	$in_type = !IsNum($Arr[3]) ? 1 : $Arr[3];
	$in_hide = !IsNum($Arr[4]) ? 0 : $Arr[4];
?>
<div class="container">
<script type="text/javascript">parent.document.title = '�������ֻ��� �������� - ϵͳ - <?php echo $arrname; ?>����';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='ϵͳ&nbsp;&raquo;&nbsp;<?php echo $arrname; ?>����';</script>
<div class="floattop"><div class="itemtitle"><h3><?php echo $arrname; ?>����</h3><ul class="tab1">
<li><a href="?iframe=link"><span>��������</span></a></li>
<?php if($_GET['action']=="add"){echo "<li class=\"current\">";}else{echo "<li>";} ?><a href="?iframe=link&action=add"><span>��������</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<form action="<?php echo $url; ?>" method="post" name="form1">
<tr><th colspan="15" class="partition"><?php echo $arrname; ?>����</th></tr>
<tr><td colspan="2" class="td27">վ������:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo $in_name; ?>" name="in_name" id="in_name"></td><td class="vtop tips2"></td></tr>
<tr><td colspan="2" class="td27">���ӵ�ַ:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo $in_url; ?>" name="in_url" id="in_url"></td><td class="vtop tips2">�����ԡ�http://����ͷ</td></tr>
<tr><td colspan="2" class="td27">��������:</td></tr>
<tr class="noborder"><td class="vtop rowform"><select name="in_type" id="in_type" onchange="exchange_type(this.form);" class="ps">
<option value="1"<?php if($in_type==1){echo " selected";} ?>>����</option>
<option value="2"<?php if($in_type==2){echo " selected";} ?>>ͼƬ</option>
</select></td><td class="vtop tips2"></td></tr>
<tr><td colspan="2" class="td27">����ͼƬ:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo $in_cover; ?>" name="in_cover" id="in_cover"></td><td class="vtop"><a href="javascript:void(0)" onclick="pop.up('no', '�ϴ�ͼƬ', 'source/pack/upload/open.php?type=link_cover&form=form1.in_cover', '406px', '180px', '175px');" class="addtr">�ϴ�ͼƬ</a></td></tr>
<tr><td colspan="2" class="td27">����״̬:</td></tr>
<tr class="noborder"><td class="vtop rowform"><select name="in_hide" class="ps">
<option value="0"<?php if($in_hide==0){echo " selected";} ?>>��ʾ</option>
<option value="1"<?php if($in_hide==1){echo " selected";} ?>>����</option>
</select></td><td class="vtop tips2"></td></tr>
<tr><td colspan="15"><div class="fixsel"><input type="submit" class="btn" name="link" onclick="return CheckForm();" value="�ύ" /></div></td></tr>
</form>
</table>
</div>


<?php
}
function main($sql,$size){
	global $db;
	$Arr=getpagerow($sql,$size);
	$result=$db->query($Arr[2]);
	$count=$db->num_rows($result);
?>
<div class="container">
<script type="text/javascript">parent.document.title = '�������ֻ��� �������� - ϵͳ - ��������';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='ϵͳ&nbsp;&raquo;&nbsp;��������';</script>
<div class="floattop"><div class="itemtitle"><h3>��������</h3><ul class="tab1">
<li class="current"><a href="?iframe=link"><span>��������</span></a></li>
<li><a href="?iframe=link&action=add"><span>��������</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<form name="form" method="post" action="?iframe=link&action=alleditsave">
<table class="tb tb2">
<tr><th class="partition">�����б�</th></tr>
</table>
<table class="tb tb2">
<tr class="header">
<th>���</th>
<th>վ������</th>
<th>���ӵ�ַ</th>
<th>����</th>
<th>����</th>
<th>״̬</th>
<th>�༭����</th>
</tr>
<?php
if($count==0){
?>
<tr><td colspan="2" class="td27">û����������</td></tr>
<?php
}
if($result){
while ($row = $db->fetch_array($result)){
?>
<tr class="hover">
<td class="td25"><input class="checkbox" type="checkbox" name="in_id[]" id="in_id" value="<?php echo $row['in_id']; ?>"><?php echo $row['in_id']; ?></td>
<td><input type="text" class="txt" name="in_name<?php echo $row['in_id']; ?>" value="<?php echo $row['in_name']; ?>"></td>
<td class="td26"><input type="text" class="txt" name="in_url<?php echo $row['in_id']; ?>" value="<?php echo $row['in_url']; ?>"></td>
<td class="td28"><input type="text" class="txt" name="in_order<?php echo $row['in_id']; ?>" value="<?php echo $row['in_order']; ?>" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td>
<td><?php if($row['in_type']==1){echo "����";}else{echo "<em class=\"lightnum\">ͼƬ</em>";} ?></td>
<td><?php if($row['in_hide']==1){ ?><a href="?iframe=link&action=editisindex&in_hide=0&in_id=<?php echo $row['in_id']; ?>"><img src="static/admincp/css/show_no.gif" /></a><?php }else{ ?><a href="?iframe=link&action=editisindex&in_hide=1&in_id=<?php echo $row['in_id']; ?>"><img src="static/admincp/css/show_yes.gif" /></a><?php } ?></td>
<td><a href="?iframe=link&action=edit&in_id=<?php echo $row['in_id']; ?>" class="act">�༭</a><a href="?iframe=link&action=del&in_id=<?php echo $row['in_id']; ?>" class="act">ɾ��</a></td>
</tr>
<?php
}
}
?>
</table>
<table class="tb tb2">
<tr><td><input type="checkbox" id="chkall" class="checkbox" onclick="CheckAll(this.form);" /><label for="chkall">ȫѡ</label> &nbsp;&nbsp; <input type="submit" name="form" class="btn" value="�ύ�޸�" /></td></tr>
<?php echo $Arr[0]; ?>
</table>
</form>
</div>



<?php
}
	//ɾ��
	function Del(){
		global $db;
		$in_id=intval(SafeRequest("in_id","get"));
		SafeDel('link', 'in_cover', $in_id);
		$sql="delete from ".tname('link')." where in_id=".$in_id;
		if($db->query($sql)){
			ShowMessage("��ϲ������������ɾ���ɹ���","?iframe=link","infotitle2",1000,1);
		}
	}

	//�༭
	function Edit(){
		global $db;
		$in_id=intval(SafeRequest("in_id","get"));
		$sql="select * from ".tname('link')." where in_id=".$in_id;
		if($row=$db->getrow($sql)){
			$Arr=array($row['in_name'],$row['in_url'],$row['in_cover'],$row['in_type'],$row['in_hide']);
		}
		EditBoard($Arr,"?iframe=link&action=saveedit&in_id=".$in_id,"�༭");
	}

	//�������
	function Add(){
		$Arr=array("","","","","");
		EditBoard($Arr,"?iframe=link&action=saveadd","����");
	}

	//ִ�б���
	function SaveAdd(){
		if(!submitcheck('link')){ShowMessage("����֤�������޷��ύ��",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
		$in_name = SafeRequest("in_name","post");
		$in_url = SafeRequest("in_url","post");
		$in_cover = checkrename(SafeRequest("in_cover","post"), 'attachment/link/cover');
		$in_type = SafeRequest("in_type","post");
		$in_hide = SafeRequest("in_hide","post");
		$setarr = array(
			'in_name' => $in_name,
			'in_url' => $in_url,
			'in_cover' => $in_cover,
			'in_type' => $in_type,
			'in_hide' => $in_hide,
			'in_order' => 0
		);
		inserttable('link', $setarr, 1);
		ShowMessage("��ϲ�����������������ɹ���","?iframe=link","infotitle2",1000,1);
	}

	//����༭
	function SaveEdit(){
		if(!submitcheck('link')){ShowMessage("����֤�������޷��ύ��",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
		$in_id = SafeRequest("in_id","get");
		$in_name = SafeRequest("in_name","post");
		$in_url = SafeRequest("in_url","post");
		$in_cover = checkrename(SafeRequest("in_cover","post"), 'attachment/link/cover', getfield('link', 'in_cover', 'in_id', $in_id), 'edit', 'link', 'in_cover', $in_id);
		$in_type = SafeRequest("in_type","post");
		$in_hide = SafeRequest("in_hide","post");
		$setarr = array(
			'in_name' => $in_name,
			'in_url' => $in_url,
			'in_cover' => $in_cover,
			'in_type' => $in_type,
			'in_hide' => $in_hide
		);
		updatetable('link', $setarr, array('in_id'=>$in_id));
		ShowMessage("��ϲ�����������ӱ༭�ɹ���",$_SERVER['HTTP_REFERER'],"infotitle2",1000,1);
	}

	function editisindex(){
		global $db;
		$in_id = intval(SafeRequest("in_id","get"));
		$in_hide = intval(SafeRequest("in_hide","get"));
		$sql="update ".tname('link')." set in_hide=".$in_hide." where in_id=".$in_id;
		if($db->query($sql)){
			ShowMessage("��ϲ����״̬�л��ɹ���","?iframe=link","infotitle2",1000,1);
		}
	}

	function alleditsave(){
		if(!submitcheck('form')){ShowMessage("����֤�������޷��ύ��",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
		$in_id = RequestBox("in_id");
		if($in_id==0){
			ShowMessage("�޸�ʧ�ܣ����ȹ�ѡҪ�༭���������ӣ�","?iframe=link","infotitle3",3000,1);
		}else{
			$ID=explode(",",$in_id);
			for($i=0;$i<count($ID);$i++){
				$in_name=SafeRequest("in_name".$ID[$i],"post");
				$in_url=SafeRequest("in_url".$ID[$i],"post");
				$in_order=SafeRequest("in_order".$ID[$i],"post");
				if(!IsNul($in_name)){ShowMessage("�޸ĳ���վ�����Ʋ���Ϊ�գ�","?iframe=link","infotitle3",1000,1);}
				if(!IsNul($in_url)){ShowMessage("�޸ĳ������ӵ�ַ����Ϊ�գ�","?iframe=link","infotitle3",1000,1);}
				if(!IsNum($in_order)){ShowMessage("�޸ĳ���������Ϊ�գ�","?iframe=link","infotitle3",1000,1);}
				$setarr = array(
					'in_name' => $in_name,
					'in_url' => $in_url,
					'in_order' => $in_order
				);
				updatetable('link', $setarr, array('in_id'=>$ID[$i]));
			}
			ShowMessage("��ϲ�������������޸ĳɹ���","?iframe=link","infotitle2",1000,1);
		}
	}
?>