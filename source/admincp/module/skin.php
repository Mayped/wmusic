<?php
if(!defined('IN_ROOT')){exit('Access denied');}
Administrator(3);
$action=SafeRequest("action","get");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>">
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>ģ�巽��</title>
<link href="static/admincp/css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="static/pack/layer/confirm-lib.js"></script>
<script type="text/javascript">
function del_msg(href) {
	$.layer({
		shade: [0],
		area: ['auto', 'auto'],
		dialog: {
			msg: 'ж�ز��������棬ȷ�ϼ�����',
			btns: 2,
			type: 4,
			btn: ['ȷ��', 'ȡ��'],
			yes: function() {
				location.href = href;
			},
			no: function() {
				layer.msg('��ȡ��ж��', 1, 0);
			}
		}
	});
}
</script>
</head>
<body>
<?php
switch($action){
	case 'temp':
		Temp();
		break;
	case 'edit':
		Edit();
		break;
	case 'del':
		Del();
		break;
	case 'templist':
		TempList();
		break;
	case 'save':
		Save();
		break;
	case 'delfile':
		DelFile();
		break;
	case 'copyfile':
		CopyFile();
		break;
	default:
		global $develop_auth;
		main($develop_auth);
		break;
	}
?>
</body>
</html>
<?php
function TempList(){
if(is_file(SafeRequest("path","get").SafeRequest("file","get"))){
?>
<div class="container">
<script type="text/javascript">parent.document.title = 'Ear Music Board �������� - ������ - �༭ģ��';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='������&nbsp;&raquo;&nbsp;�༭ģ��';</script>
<div class="floattop"><div class="itemtitle"><h3>�༭ģ��</h3></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th class="partition"><?php echo SafeRequest("tempname","get"); ?></th></tr>
</table>
<table class="tb tb2">
<form action="?iframe=skin&action=save" method="post">
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo SafeRequest("file","get"); ?>" name="file"></td></tr>
<tr class="noborder"><td class="vtop rowform">
<textarea rows="30" name="content" style="width:700px;"><?php echo file_get_contents(SafeRequest("path","get").SafeRequest("file","get")); ?></textarea>
</td><td class="vtop tips2"></td></tr>
<tr><td colspan="15"><div class="fixsel"><input type="hidden" name="path" value="<?php echo SafeRequest("path","get"); ?>"><input name="tempname" type="hidden" value="<?php echo SafeRequest("tempname","get"); ?>"><input name="save" type="submit" class="btn" value="�ύ�޸�" /> &nbsp; <input type="button" class="btn" value="����" onclick="location.href='?iframe=skin&action=templist&tempname=<?php echo SafeRequest("tempname","get"); ?>&path=<?php echo SafeRequest("path","get"); ?>';"></div></td></tr>
</form>
</table>
</div>

<?php
}else{
$dir = SafeRequest("path","get");
$path = !empty($dir) ? $dir : getcwd();
?>
<div class="container">
<script type="text/javascript">parent.document.title = 'Ear Music Board �������� - ������ - ���ģ��';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='������&nbsp;&raquo;&nbsp;���ģ��';</script>
<div class="floattop"><div class="itemtitle"><h3>���ģ��</h3></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th class="partition"><?php echo SafeRequest("tempname","get"); ?></th></tr>
</table>
<table class="tb tb2">
<tr class="header">
<th>ģ������</th>
<th>ģ������</th>
<th>�ļ���С</th>
<th>�޸�ʱ��</th>
<th>�༭����</th>
</tr>
<?php
if(is_dir($path)){
$d = dir($path);
$d->rewind();
while(false !== ($v = $d->read())){
if($v == "." || $v == ".."){
continue;
}
$file = $d->path.$v;
if(is_dir($file)){
continue;
}
if(is_file($file)){
?>
<tr class="hover">
<td><a href="?iframe=skin&action=templist&tempname=<?php echo SafeRequest("tempname","get"); ?>&path=<?php echo $path; ?>&file=<?php echo $v; ?>" class="act"><?php echo $v; ?></a></td>
<td><?php echo getTemplateType($v); ?></td>
<td><?php echo round(filesize($file) / 1204, 2).' KB'; ?></td>
<td><?php echo date('Y-m-d H:i:s', filemtime($file)); ?></td>
<td><a href="?iframe=skin&action=templist&tempname=<?php echo SafeRequest("tempname","get"); ?>&path=<?php echo $path; ?>&file=<?php echo $v; ?>" class="act">�༭</a><a href="?iframe=skin&action=copyfile&tempname=<?php echo SafeRequest("tempname","get"); ?>&path=<?php echo $path; ?>&file=<?php echo $v; ?>" class="act">����</a><a href="?iframe=skin&action=delfile&tempname=<?php echo SafeRequest("tempname","get"); ?>&path=<?php echo $path; ?>&file=<?php echo $v; ?>" class="act">ɾ��</a></td>
</tr>
<?php
}
}
$d->close();
}
?>
</table>
</div>


<?php
}
}
function main($develop_auth){
	global $db;
	$sql="select * from ".tname('template');
	$result=$db->query($sql);
	$count=$db->num_rows($result);
?>
<div class="container">
<script type="text/javascript">parent.document.title = 'Ear Music Board �������� - ������ - ģ�巽��';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='������&nbsp;&raquo;&nbsp;ģ�巽��';</script>
<div class="floattop"><div class="itemtitle"><h3>ģ�巽��</h3></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th class="partition">ģ���б�</th></tr>
</table>
<table class="tb tb2">
<?php
if($count==0){
?>
<tr><td colspan="2" class="td27">û��ģ�巽��</td></tr>
<?php
}else{
if($result){
while ($row = $db->fetch_array($result)){
$temp = substr($row['in_path'], 0, strrpos(str_replace('//', '', $row['in_path'].'/'), '/') + 1);
?>
<form action="?iframe=skin&action=edit" method="post">
<table cellspacing="0" cellpadding="0" style="margin-left: 10px; width: 250px;height: 200px;" class="left">
<tr><th class="partition" colspan="2"><?php echo $row['in_path']; ?></th></tr>
<tr>
<td style="width: 130px;height:170px" valign="top">
<p style="margin-bottom: 12px;"><img width="110" height="120" style="cursor:pointer" onclick="location.href='?iframe=skin&action=templist&tempname=<?php echo $row['in_name']; ?>&path=<?php echo $row['in_path']; ?>';" title="<?php echo $row['in_name']; ?>" onerror="this.src='static/admincp/css/preview.gif'" src="<?php echo $temp; ?>preview.jpg" /></p>
<p style="margin: 2px 0"><input type="hidden" name="in_id" value="<?php echo $row['in_id']; ?>"><input type="text" class="txt" name="in_name" value="<?php echo $row['in_name']; ?>" style="margin:0; width: 104px;"></p>
</td>
<td valign="top">
<p><div class="fixsel"><input type="button" class="btn"<?php if($row['in_default'] == 1){ ?> value="��ΪĬ��" disabled="disabled"<?php }else{ ?> value="��ΪĬ��" onclick="location.href='?iframe=skin&action=temp&in_id=<?php echo $row['in_id']; ?>';"<?php } ?> /></div></p>
<p style="margin: 1px 0"><div class="fixsel"><input type="button" class="btn" value="�ֻ���" onclick="location.href='?iframe=skin&action=templist&tempname=<?php echo $row['in_name']; ?>&path=<?php echo $temp; ?>mobile/html/';" /></div></p>
<p style="margin: 1px 0"><div class="fixsel"><input name="edit" type="submit" class="btn" value="�޸�" /></div></p>
<p style="margin: 8px 0 0 0"><div class="fixsel"><input type="button" class="btn"<?php if($row['in_default'] == 1){ ?> value="����" disabled="disabled"<?php }else{ ?> value="ж��" onclick="del_msg('?iframe=skin&action=del&in_id=<?php echo $row['in_id']; ?>');"<?php } ?> /></div></p>
<p style="margin: 8px 0 2px 0"><?php echo date("Y-m-d",strtotime($row['in_addtime']))==date('Y-m-d') ? '<em class="lightnum">'.date("Y-m-d",strtotime($row['in_addtime'])).'</em>' : date("Y-m-d",strtotime($row['in_addtime'])); ?></p>
</td>
</tr>
</table>
</form>
<?php
}
}
}
?>
</table>
<table class="tb tb2">
<tr><td colspan="15"><div class="fixsel"><a href="<?php echo $develop_auth; ?>">��ȡ������</a></div></td></tr>
</table>
</div>



<?php
}
//����ģ���ļ�
function CopyFile(){
	$tempname = SafeRequest("tempname","get");
	$path = SafeRequest("path","get");
	$file = SafeRequest("file","get");
	if(copy($path.$file, $path."���� ".$file)){
		ShowMessage("��ϲ����ģ���ļ�{".$file."}���Ƴɹ���","?iframe=skin&action=templist&tempname=".$tempname."&path=".$path,"infotitle2",1000,1);
	}
}

//ɾ��ģ���ļ�
function DelFile(){
	$tempname = SafeRequest("tempname","get");
	$path = SafeRequest("path","get");
	$file = SafeRequest("file","get");
	if(file_exists($path.$file)){
		unlink($path.$file);
		ShowMessage("��ϲ����ģ���ļ�ɾ���ɹ���","?iframe=skin&action=templist&tempname=".$tempname."&path=".$path,"infotitle2",1000,1);
	}else{
		ShowMessage("ɾ��ʧ�ܣ�ģ���ļ������ڣ�","?iframe=skin&action=templist&tempname=".$tempname."&path=".$path,"infotitle3",3000,1);
	}
}

//�༭ģ���ļ�
function Save(){
	if(!submitcheck('save')){ShowMessage("����֤�������޷��ύ��",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
	$file = SafeRequest("file","post");
	$path = SafeRequest("path","post");
	$tempname = SafeRequest("tempname","post");
	$content = stripslashes(SafeRequest("content","post",1));
	if(strtolower(substr(strrchr($file, '.'), 1)) == "html"){
		if(!$fp = fopen($path.$file, 'w')){
			ShowMessage("�޸�ʧ�ܣ�ģ���ļ�{".$path.$file."}û��д��Ȩ�ޣ�","?iframe=skin&action=templist&tempname=".$tempname."&path=".$path,"infotitle3",3000,1);
		}
		$ifile = new iFile($path.$file, 'w');
		$ifile->WriteFile($content, 3);
		ShowMessage("��ϲ����ģ���ļ��޸ĳɹ���","?iframe=skin&action=templist&tempname=".$tempname."&path=".$path,"infotitle2",1000,1);
	}else{
		ShowMessage("�������ģ���ļ���չ�����淶��","?iframe=skin&action=templist&tempname=".$tempname."&path=".$path,"infotitle3",3000,1);
	}
}

//ɾ��ģ�巽��
function Del(){
	global $db;
	$in_id = intval(SafeRequest("in_id","get"));
	$row = $db->getrow("select * from ".tname('template')." where in_id=".$in_id);
	$template = substr($row['in_path'], 0, strrpos(str_replace('//', '', $row['in_path'].'/'), '/') + 1);
        if(@include_once($template.'function.php')){
		style_uninstall();
        }
	$sql="delete from ".tname('template')." where in_id=".$in_id;
	if($db->query($sql)){
		destroyDir($template);
		ShowMessage("��ϲ����ģ�巽��ж�سɹ���","?iframe=skin","infotitle2",1000,1);
	}
}

//�༭ģ�巽��
function Edit(){
	global $db;
	if(!submitcheck('edit')){ShowMessage("����֤�������޷��ύ��",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
	$in_id = intval(SafeRequest("in_id","post"));
	$in_name = SafeRequest("in_name","post");
	$sql = "update ".tname('template')." set in_name='".$in_name."' where in_id=".$in_id;
	if(!IsNul($in_name)){
		ShowMessage("�޸ĳ����������Ʋ���Ϊ�գ�","?iframe=skin","infotitle3",3000,1);
	}elseif($db->query($sql)){
		ShowMessage("��ϲ����ģ�巽���޸ĳɹ���","?iframe=skin","infotitle2",1000,1);
	}
}

//�л�ģ�巽��
function Temp(){
	global $db;
	$in_id = intval(SafeRequest("in_id","get"));
	if($db->query("update ".tname('template')." set in_default=0")){
		$db->query("update ".tname('template')." set in_default=1 where in_id=".$in_id);
		ShowMessage("��ϲ����ģ�巽����ΪĬ�ϳɹ���","?iframe=skin","infotitle2",1000,1);
	}
}

function getTemplateType($filename){
	switch(strtolower($filename)){
		case 'index.html':
			$Type="��ҳ�ļ�";
			break;
		case "search.html":
			$Type="��������";
			break;
		case "special_search.html":
			$Type="ר������";
			break;
		case "singer_search.html":
			$Type="��������";
			break;
		case "video_search.html":
			$Type="��Ƶ����";
			break;
		case "class.html":
			$Type="������Ŀ";
			break;
		case "special_class.html":
			$Type="ר����Ŀ";
			break;
		case "singer_class.html":
			$Type="������Ŀ";
			break;
		case "video_class.html":
			$Type="��Ƶ��Ŀ";
			break;
		case "music.html":
			$Type="��������";
			break;
		case "special.html":
			$Type="ר������";
			break;
		case "singer.html":
			$Type="��������";
			break;
		case "video.html":
			$Type="��Ƶ����";
			break;
		default:
			if(stristr($filename, '.html')){
				$Type="ģ����չ";
			}else{
				$Type="�����ļ�";
			}
	}
	return $Type;
}
?>