<?php
if(!defined('IN_ROOT')){exit('Access denied');}
Administrator(5);
$action=SafeRequest("action","get");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>���۹���</title>
<link href="static/admincp/css/main.css" rel="stylesheet" type="text/css" />
<link href="static/pack/asynctips/asynctips.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="static/pack/asynctips/jquery.min.js"></script>
<script type="text/javascript" src="static/pack/asynctips/asyncbox.v1.4.5.js"></script>
<script type="text/javascript" src="static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="static/pack/layer/lib.js"></script>
<script type="text/javascript">
function CheckAll(form) {
	for (var i = 0; i < form.elements.length; i++) {
		var e = form.elements[i];
		if (e.name != 'chkall') {
			e.checked = form.chkall.checked;
		}
	}
        all_save(form);
}
function s(){
        var k=document.getElementById("search").value;
        if(k==""){
                asyncbox.tips("������Ҫ��ѯ�Ĺؼ��ʣ�", "wait", 1000);
                document.getElementById("search").focus();
                return false;
        }else{
                document.btnsearch.submit();
        }
}
function all_save(form){
        if(form.chkall.checked){
		layer.tips('ɾ�����۲����棬�����������', '#chkall', {
			tips: 3
		});
        }
}
</script>
</head>
<body>
<?php
switch($action){
	case 'alldel':
		alldel();
		break;
	case 'keyword':
		$key=SafeRequest("key","get");
		main("select * from ".tname('comment')." where in_content like '%".$key."%' or in_uname like '%".$key."%' order by in_addtime desc",20);
		break;
	default:
		main("select * from ".tname('comment')." order by in_addtime desc",20);
		break;
	}
?>
</body>
</html>
<?php
function main($sql,$size){
	global $db;
	$Arr=getpagerow($sql,$size);
	$result=$db->query($Arr[2]);
	$count=$db->num_rows($result);
?>
<div class="container">
<script type="text/javascript">parent.document.title = '�������ֻ��� �������� - �û����� - ��������';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='�û�����&nbsp;&raquo;&nbsp;��������';</script>
<div class="floattop"><div class="itemtitle"><h3>��������</h3></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th class="partition">������ʾ</th></tr>
<tr><td class="tipsblock"><ul>
<li>���������������ݡ�������Ա�ȹؼ��ʽ�������</li>
</ul></td></tr>
</table>
<table class="tb tb2">
<form name="btnsearch" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<tr><td>
<input type="hidden" name="iframe" value="comment">
<input type="hidden" name="action" value="keyword">
�ؼ��ʣ�<input class="txt" x-webkit-speech type="text" name="key" id="search" value="" />
<input type="button" value="����" class="btn" onclick="s()" />
</td></tr>
</form>
</table>
<form name="form" method="post" action="?iframe=comment&action=alldel">
<table class="tb tb2">
<tr class="header">
<th>���</th>
<th>����</th>
<th>��������</th>
<th>������Ա</th>
<th>����ʱ��</th>
</tr>
<?php
if($count==0){
?>
<tr><td colspan="2" class="td27">û������</td></tr>
<?php
}
if($result){
while ($row = $db->fetch_array($result)){
$content = preg_replace('/\[em:(\d+)]/is', '<img src="static/user/images/face/\1.gif" class="face">', $row['in_content']);
$content = str_replace('class="face"', '/', $content);
$array = array('music', 'special', 'singer', 'video', 'photo', 'blog');
$blank = in_array($row['in_table'], $array) ? 'window.open(\''.getlink($row['in_tid'], $row['in_table']).'\');' : 'layer.tips(\'����ΪӦ�õ�������ʱ��֧�ִ��������鿴��\', this, {tips : [1, \'#000000\']});';
$type = in_array($row['in_table'], $array) ? str_replace($array, array('����', 'ר��', '����', '��Ƶ', '��Ƭ', '��־'), $row['in_table']) : 'Ӧ��';
?>
<tr class="hover">
<td class="td25"><input class="checkbox" type="checkbox" name="in_id[]" id="in_id" value="<?php echo $row['in_id']; ?>"><?php echo $row['in_id']; ?></td>
<td><?php echo $type; ?></td>
<td><a onclick="<?php echo $blank; ?>" class="act" style="cursor:pointer"><?php echo $content; ?></a></td>
<td><a href="<?php echo getlink($row['in_uid']); ?>" target="_blank" class="act"><?php echo ReplaceStr($row['in_uname'],SafeRequest("key","get"),"<em class=\"lightnum\">".SafeRequest("key","get")."</em>"); ?></a></td>
<td><?php if(date("Y-m-d",strtotime($row['in_addtime']))==date('Y-m-d')){echo "<em class=\"lightnum\">".$row['in_addtime']."</em>";}else{echo $row['in_addtime'];} ?></td>
</tr>
<?php
}
}
?>
</table>
<table class="tb tb2">
<tr><td><input type="checkbox" id="chkall" class="checkbox" onclick="CheckAll(this.form);" /><label for="chkall">ȫѡ</label> &nbsp;&nbsp; <input type="submit" name="alldel" class="btn" value="����ɾ��" /></td></tr>
<?php echo $Arr[0]; ?>
</table>
</form>
</div>



<?php
}
	//����ɾ��
	function alldel(){
		global $db;
		if(!submitcheck('alldel')){ShowMessage("����֤�������޷��ύ��",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
		$in_id = RequestBox("in_id");
		if($in_id==0){
			ShowMessage("����ɾ��ʧ�ܣ����ȹ�ѡҪɾ�������ۣ�","?iframe=comment","infotitle3",3000,1);
		}else{
			$db->query("delete from ".tname('comment')." where in_id in ($in_id)");
			ShowMessage("��ϲ������������ɾ���ɹ���","?iframe=comment","infotitle2",3000,1);
		}
	}
?>