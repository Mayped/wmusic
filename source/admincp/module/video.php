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
<title>��Ƶ����</title>
<link href="static/admincp/css/main.css" rel="stylesheet" type="text/css" />
<link href="static/pack/asynctips/asynctips.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="static/pack/asynctips/jquery.min.js"></script>
<script type="text/javascript" src="static/pack/asynctips/asyncbox.v1.4.5.js"></script>
<script type="text/javascript" src="static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="static/pack/layer/lib.js"></script>
<script type="text/javascript">
function CheckAll(form, type) {
	for (var i = 0; i < form.elements.length; i++) {
		var e = form.elements[i];
		if (e.name != 'chkall') {
			e.checked = form.chkall.checked;
		}
	}
	if(type==1){
		all_save(form);
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
	case 'alldel':
		AllDel();
		break;
	case 'editpassed':
		EditPassed();
		break;
	case 'class':
		ClassMain();
		break;
	case 'delclass':
		DelClass();
		break;
	case 'edithideclass':
		EditHideClass();
		break;
	case 'editsaveclass':
		EditSaveClass();
		break;
	case 'saveaddclass':
		SaveAddClass();
		break;
	case 'list':
		$in_classid=intval(SafeRequest("in_classid","get"));
		main("select * from ".tname('video')." where in_classid=".$in_classid." order by in_addtime desc",20);
		break;
	case 'singer':
		$in_singerid=intval(SafeRequest("in_singerid","get"));
		main("select * from ".tname('video')." where in_singerid=".$in_singerid." order by in_addtime desc",20);
		break;
	case 'keyword':
		$key=SafeRequest("key","get");
		main("select * from ".tname('video')." where in_name like '%".$key."%' or in_uname like '%".$key."%' order by in_addtime desc",20);
		break;
	case 'pass':
		main("select * from ".tname('video')." where in_passed=1 order by in_addtime desc",20);
		break;
	default:
		main("select * from ".tname('video')." order by in_addtime desc",20);
		break;
	}
?>
</body>
</html>
<?php
function EditBoard($Arr,$url,$arrname){
	global $db,$action;
	$one = $db->getone("select in_userid from ".tname('user')." where in_username='".$_COOKIE['in_adminname']."'");
	$in_name = $Arr[0];
	$in_classid = $Arr[1];
	$in_singerid = $Arr[2];
	$in_uname = !IsNul($Arr[3]) && $one ? $_COOKIE['in_adminname'] : $Arr[3];
	$in_play = $Arr[4];
	$in_cover = $Arr[5];
	$in_intro = $Arr[6];
?>
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
function CheckForm(){
        if(document.form2.in_name.value==""){
            asyncbox.tips("��Ƶ���Ʋ���Ϊ�գ�����д��", "wait", 1000);
            document.form2.in_name.focus();
            return false;
        }
        else if(document.form2.in_classid.value=="0"){
            asyncbox.tips("������Ŀ����Ϊ�գ���ѡ��", "wait", 1000);
            document.form2.in_classid.focus();
            return false;
        }
        else if(document.form2.in_uname.value==""){
            asyncbox.tips("������Ա����Ϊ�գ�����д��", "wait", 1000);
            document.form2.in_uname.focus();
            return false;
        }
        else if(document.form2.in_play.value==""){
            asyncbox.tips("��Ƶ��ַ����Ϊ�գ�����д��", "wait", 1000);
            document.form2.in_play.focus();
            return false;
        }
        else {
            return true;
        }
}
</script>
<div class="container">
<script type="text/javascript">parent.document.title = 'Ear Music Board �������� - ������� - <?php echo $arrname; ?>��Ƶ';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='�������&nbsp;&raquo;&nbsp;<?php echo $arrname; ?>��Ƶ';</script>
<div class="floattop"><div class="itemtitle"><h3><?php echo $arrname; ?>��Ƶ</h3><ul class="tab1">
<li><a href="?iframe=video"><span>������Ƶ</span></a></li>
<?php if($action=="add"){echo "<li class=\"current\">";}else{echo "<li>";} ?><a href="?iframe=video&action=add"><span>������Ƶ</span></a></li>
<li><a href="?iframe=video&action=pass"><span>������Ƶ</span></a></li>
<li><a href="?iframe=video&action=class"><span>��Ƶ��Ŀ</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<form action="<?php echo $url; ?>" method="post" name="form2">
<table class="tb tb2">
<tr>
<td class="td29">��Ƶ���ƣ�<input type="text" class="txt" value="<?php echo $in_name; ?>" name="in_name" id="in_name"></td>
<td>������Ŀ��<select name="in_classid" id="in_classid">
<option value="0">ѡ����Ŀ</option>
<?php
$sql="select * from ".tname('video_class')." order by in_id asc";
$result=$db->query($sql);
if($result){
while ($row = $db->fetch_array($result)){
if($in_classid==$row['in_id']){
echo "<option value=\"".$row['in_id']."\" selected=\"selected\">".$row['in_name']."</option>";
}else{
echo "<option value=\"".$row['in_id']."\">".$row['in_name']."</option>";
}
}
}
?>
</select></td>
</tr>

<tr>
<td>�������֣�<select name="in_singerid" id="in_singerid">
<option value="0">��ѡ��</option>
<?php
$res=$db->query("select * from ".tname('singer')." order by in_addtime desc");
if($res){
        while ($row = $db->fetch_array($res)){
                if($in_singerid==$row['in_id']){
                        echo "<option value=\"".$row['in_id']."\" selected=\"selected\">".getlenth($row['in_name'], 10)."</option>";
                }else{
                        echo "<option value=\"".$row['in_id']."\">".getlenth($row['in_name'], 10)."</option>";
                }
        }
}
?>
</select>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="pop.up('yes', 'ѡ�����', 'source/pack/tag/singer_opt.php?so=form2.in_singerid', '500px', '400px', '65px');" class="addtr">ѡ��</a></td>
<td>������Ա��<input type="text" class="txt" value="<?php echo $in_uname; ?>" name="in_uname" id="in_uname"></td>
</tr>

<tr>
<td class="longtxt">��Ƶ��ַ��<input type="text" class="txt" value="<?php echo $in_play; ?>" name="in_play" id="in_play"></td><td><div class="rssbutton"><input type="button" value="�ϴ���Ƶ" onclick="pop.up('no', '�ϴ���Ƶ', 'source/pack/upload/open.php?type=video_play&form=form2.in_play', '406px', '180px', '175px');" /></div></td>
</tr>

<tr>
<td class="longtxt">�����ַ��<input type="text" class="txt" value="<?php echo $in_cover; ?>" name="in_cover" id="in_cover"></td><td><div class="rssbutton"><input type="button" value="�ϴ�����" onclick="pop.up('no', '�ϴ�����', 'source/pack/upload/open.php?type=video_cover&form=form2.in_cover', '406px', '180px', '175px');" /></div></td>
</tr>
</table>

<table class="tb tb2">
<tr><td><div style="height:100px;line-height:100px;float:left;">��Ƶ���ܣ�</div><textarea rows="6" cols="50" id="in_intro" name="in_intro" style="width:400px;height:100px;"><?php echo $in_intro; ?></textarea></td></tr>
<tr><td><input type="submit" class="btn" name="form2" value="�ύ" onclick="return CheckForm();" /><?php if($_GET['action']=="edit"){ ?><input type="hidden" name="in_addtime" value="<?php echo $Arr[7]; ?>"><input class="checkbox" type="checkbox" name="in_edittime" id="in_edittime" value="1" checked /><label for="in_edittime">����ʱ��</label><?php } ?></td></tr>
</table>
</form>
</div>


<?php
}
function main($sql,$size){
	global $db,$action;
	$Arr=getpagerow($sql,$size);
	$result=$db->query($Arr[2]);
	$count=$db->num_rows($result);
?>
<link href="static/pack/fancybox/jquery.fancybox-1.3.4.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="static/pack/fancybox/jquery.fancybox.min.js"></script>
<script type="text/javascript" src="static/pack/fancybox/jquery.fancybox.pack.js"></script>
<script type="text/javascript">
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
		layer.tips('ɾ����Ƶ�����棬�����������', '#chkall', {
			tips: 3
		});
        }
}
</script>
<div class="container">
<?php if(empty($action)){echo "<script type=\"text/javascript\">parent.document.title = 'Ear Music Board �������� - ������� - ������Ƶ';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='�������&nbsp;&raquo;&nbsp;������Ƶ';</script>";} ?>
<?php if($action=="pass"){echo "<script type=\"text/javascript\">parent.document.title = 'Ear Music Board �������� - ������� - ������Ƶ';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='�������&nbsp;&raquo;&nbsp;������Ƶ';</script>";} ?>
<?php if($action=="keyword"){echo "<script type=\"text/javascript\">parent.document.title = 'Ear Music Board �������� - ������� - ������Ƶ';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='�������&nbsp;&raquo;&nbsp;������Ƶ';</script>";} ?>
<?php if($action=="list"){echo "<script type=\"text/javascript\">parent.document.title = 'Ear Music Board �������� - ������� - ��Ŀ��Ƶ';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='�������&nbsp;&raquo;&nbsp;��Ŀ��Ƶ';</script>";} ?>
<?php if($action=="singer"){echo "<script type=\"text/javascript\">parent.document.title = 'Ear Music Board �������� - ������� - ������Ƶ';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='�������&nbsp;&raquo;&nbsp;������Ƶ';</script>";} ?>
<div class="floattop"><div class="itemtitle"><h3><?php if(empty($action)){echo "������Ƶ";}else if($action=="pass"){echo "������Ƶ";}else if($action=="keyword"){echo "������Ƶ";}else if($action=="list"){echo "��Ŀ��Ƶ";}else if($action=="singer"){echo "������Ƶ";} ?></h3><ul class="tab1">
<?php if(empty($action)){echo "<li class=\"current\">";}else{echo "<li>";} ?><a href="?iframe=video"><span>������Ƶ</span></a></li>
<li><a href="?iframe=video&action=add"><span>������Ƶ</span></a></li>
<?php if($action=="pass"){echo "<li class=\"current\">";}else{echo "<li>";} ?><a href="?iframe=video&action=pass"><span>������Ƶ</span></a></li>
<li><a href="?iframe=video&action=class"><span>��Ƶ��Ŀ</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th class="partition">������ʾ</th></tr>
<tr><td class="tipsblock"><ul>
<?php
if(empty($action)){
echo "<li>���������е���Ƶ</li>";
}elseif($action=="pass"){
echo "<li>��������Ҫ��˵���Ƶ��������ǰ̨��ʾ</li>";
}elseif($action=="keyword"){
echo "<li>������������".SafeRequest("key","get")."������Ƶ</li>";
}elseif($action=="list"){
echo "<li>�����ǰ���Ŀ�鿴����Ƶ</li>";
}elseif($action=="singer"){
echo "<li>�����ǰ����ֲ鿴����Ƶ</li>";
}
?>
<li>����������Ƶ���ơ�������Ա�ȹؼ��ʽ�������</li>
</ul></td></tr>
</table>
<table class="tb tb2">
<form name="btnsearch" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<tr><td>
<input type="hidden" name="iframe" value="video">
<input type="hidden" name="action" value="keyword">
�ؼ��ʣ�<input class="txt" x-webkit-speech type="text" name="key" id="search" value="" />
<select onchange="location.href=this.options[this.selectedIndex].value;">
<option value="?iframe=video">������Ŀ</option>
<?php
$res=$db->query("select * from ".tname('video_class')." order by in_id asc");
if($res){
        while ($row = $db->fetch_array($res)){
                if(SafeRequest("in_classid","get")==$row['in_id']){
                        echo "<option value=\"?iframe=video&action=list&in_classid=".$row['in_id']."\" selected=\"selected\">".$row['in_name']."</option>";
                }else{
                        echo "<option value=\"?iframe=video&action=list&in_classid=".$row['in_id']."\">".$row['in_name']."</option>";
                }
        }
}
?>
</select>
<select onchange="location.href=this.options[this.selectedIndex].value;">
<option value="?iframe=video">���޸���</option>
<?php
$res=$db->query("select * from ".tname('singer')." order by in_addtime desc");
if($res){
        while ($row = $db->fetch_array($res)){
                if(SafeRequest("in_singerid","get")==$row['in_id']){
                        echo "<option value=\"?iframe=video&action=singer&in_singerid=".$row['in_id']."\" selected=\"selected\">".getlenth($row['in_name'], 10)."</option>";
                }else{
                        echo "<option value=\"?iframe=video&action=singer&in_singerid=".$row['in_id']."\">".getlenth($row['in_name'], 10)."</option>";
                }
        }
}
?>
</select>
<input type="button" value="����" class="btn" onclick="s()" />
</td></tr>
</form>
</table>
<form name="form" method="post" action="?iframe=video&action=alldel">
<table class="tb tb2">
<tr class="header">
<th>���</th>
<th>��Ƶ����</th>
<th>��Ƶ����</th>
<th>������Ա</th>
<th>���</th>
<th>����ʱ��</th>
<th>�༭����</th>
</tr>
<?php
if($count==0){
?>
<tr><td colspan="2" class="td27">û����Ƶ</td></tr>
<?php
}
if($result){
while ($row = $db->fetch_array($result)){
?>
<script type="text/javascript">
$(document).ready(function() {
	$("#thumb<?php echo $row['in_id']; ?>").fancybox({
		'overlayColor': '#000',
		'overlayOpacity': 0.1,
		'overlayShow': true,
		'transitionIn': 'elastic',
		'transitionOut': 'elastic'
	});
});
</script>
<tr class="hover">
<td class="td25"><input class="checkbox" type="checkbox" name="in_id[]" id="in_id" value="<?php echo $row['in_id']; ?>"><?php echo $row['in_id']; ?></td>
<td><a href="<?php echo geturl($row['in_cover'], 'cover'); ?>" id="thumb<?php echo $row['in_id']; ?>"><img src="<?php echo geturl($row['in_cover'], 'cover'); ?>" width="25" height="25" /></a></td>
<td><a href="<?php echo getlink($row['in_id'], 'video'); ?>" target="_blank" class="act"><?php echo ReplaceStr($row['in_name'],SafeRequest("key","get"),"<em class=\"lightnum\">".SafeRequest("key","get")."</em>"); ?></a></td>
<td><a href="<?php echo getlink($row['in_uid']); ?>" target="_blank" class="act"><?php echo ReplaceStr($row['in_uname'],SafeRequest("key","get"),"<em class=\"lightnum\">".SafeRequest("key","get")."</em>"); ?></a></td>
<td><?php if($row['in_passed']==1){ ?><a href="?iframe=video&action=editpassed&in_id=<?php echo $row['in_id']; ?>"><img src="static/admincp/css/pass_no.gif" /></a><?php }else{ ?><img src="static/admincp/css/pass_yes.gif" /><?php } ?></td>
<td><?php if(date('Y-m-d',strtotime($row['in_addtime']))==date('Y-m-d')){echo "<em class=\"lightnum\">".date('Y-m-d',strtotime($row['in_addtime']))."</em>";}else{echo date('Y-m-d',strtotime($row['in_addtime']));} ?></td>
<td><a href="?iframe=video&action=edit&in_id=<?php echo $row['in_id']; ?>" class="act">�༭</a></td>
</tr>
<?php
}
}
?>
</table>
<table class="tb tb2">
<tr><td><input type="checkbox" id="chkall" class="checkbox" onclick="CheckAll(this.form, 1);" /><label for="chkall">ȫѡ</label> &nbsp;&nbsp; <input type="submit" name="form" class="btn" value="����ɾ��" /></td></tr>
<?php echo $Arr[0]; ?>
</table>
</form>
</div>


<?php
}
function ClassMain(){
	global $db;
	$sql="select * from ".tname('video_class')." order by in_id asc";
	$result=$db->query($sql);
	$count=$db->num_rows($result);
?>
<script type="text/javascript">
function CheckForm(){
        if(document.form1.in_name.value==""){
            asyncbox.tips("��Ŀ���Ʋ���Ϊ�գ�����д��", "wait", 1000);
            document.form1.in_name.focus();
            return false;
        }
        else if(document.form1.in_order.value==""){
            asyncbox.tips("������Ϊ�գ�����д��", "wait", 1000);
            document.form1.in_order.focus();
            return false;
        }
        else {
            return true;
        }
}
</script>
<div class="container">
<script type="text/javascript">parent.document.title = 'Ear Music Board �������� - ������� - ��Ƶ��Ŀ';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='�������&nbsp;&raquo;&nbsp;��Ƶ��Ŀ';</script>
<div class="floattop"><div class="itemtitle"><h3>��Ƶ��Ŀ</h3><ul class="tab1">
<li><a href="?iframe=video"><span>������Ƶ</span></a></li>
<li><a href="?iframe=video&action=add"><span>������Ƶ</span></a></li>
<li><a href="?iframe=video&action=pass"><span>������Ƶ</span></a></li>
<li class="current"><a href="?iframe=video&action=class"><span>��Ƶ��Ŀ</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th class="partition">��Ŀ����</th></tr>
</table>
<form name="form" method="post" action="?iframe=video&action=editsaveclass">
<table class="tb tb2">
<tr class="header">
<th>���</th>
<th>��Ŀ����</th>
<th>��Ƶͳ��</th>
<th>����</th>
<th>״̬</th>
<th>�༭����</th>
</tr>
<?php
if($count==0){
?>
<tr><td colspan="2" class="td27">û����Ƶ��Ŀ</td></tr>
<?php
}
if($result){
while ($row = $db->fetch_array($result)){
?>
<tr class="hover">
<td class="td25"><input class="checkbox" type="checkbox" name="in_id[]" id="in_id" value="<?php echo $row['in_id']; ?>"><?php echo $row['in_id']; ?></td>
<td><div class="parentboard"><input type="text" name="in_name<?php echo $row['in_id']; ?>" value="<?php echo $row['in_name']; ?>" class="txt" /></div></td>
<td><a href="?iframe=video&action=list&in_classid=<?php echo $row['in_id']; ?>" class="act">
<?php
$sqlstr="select * from ".tname('video')." where in_classid=".$row['in_id'];
$res=$db->query($sqlstr);
$nums=$db->num_rows($res);
echo $nums;
?>
</a></td>
<td class="td25"><input type="text" name="in_order<?php echo $row['in_id']; ?>" value="<?php echo $row['in_order']; ?>" class="txt" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" /></td>
<td>
<?php if($row['in_hide']==1){ ?>
<a href="?iframe=video&action=edithideclass&in_id=<?php echo $row['in_id']; ?>&in_hide=0"><img src="static/admincp/css/show_no.gif" /></a>
<?php }else{ ?>
<a href="?iframe=video&action=edithideclass&in_id=<?php echo $row['in_id']; ?>&in_hide=1"><img src="static/admincp/css/show_yes.gif" /></a>
<?php } ?>
</td>
<td><input type="button" class="btn" value="ɾ��" onclick="location.href='?iframe=video&action=delclass&in_id=<?php echo $row['in_id']; ?>';" /></td>
</tr>
<?php
}
}
?>
</table>
<table class="tb tb2">
<tr><td class="td25"><input type="checkbox" id="chkall" class="checkbox" onclick="CheckAll(this.form, 0);" /><label for="chkall">ȫѡ</label></td><td colspan="15"><div class="fixsel"><input type="submit" class="btn" name="form" value="�ύ�޸�" /></div></td></tr>
</table>
</form>

<table class="tb tb2">
<tr><th class="partition">������Ŀ</th></tr>
</table>
<form name="form1" method="post" action="?iframe=video&action=saveaddclass">
<table class="tb tb2">
<tr>
<td>��Ŀ����</td>
<td><input type="text" class="txt" name="in_name" id="in_name" size="18" style="margin:0; width: 140px;"></td>
<td>����</td>
<td><input type="text" class="txt" name="in_order" id="in_order" style="margin:0; width: 104px;" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td>
</tr>
<tr><td colspan="15"><div class="fixsel"><input type="submit" name="form1" class="btn" onclick="return CheckForm();" value="����" /></div></td></tr>
</table>
</form>
</div>



<?php
}
	//���
	function EditPassed(){
		global $db;
		$in_id = intval(SafeRequest("in_id","get"));
		$row = $db->getrow("select * from ".tname('video')." where in_id=".$in_id);
		$db->query("update ".tname('user')." set in_points=in_points+".IN_VIDEOINPOINTS.",in_rank=in_rank+".IN_VIDEOINRANK." where in_userid=".$row['in_uid']);
		$setarrs = array(
			'in_uid' => 0,
			'in_uname' => 'ϵͳ�û�',
			'in_uids' => $row['in_uid'],
			'in_unames' => $row['in_uname'],
			'in_content' => '��ϲ������������Ƶ��'.$row['in_name'].'����ͨ����ˣ�[���+'.IN_VIDEOINPOINTS.'][����+'.IN_VIDEOINRANK.']',
			'in_isread' => 0,
			'in_addtime' => date('Y-m-d H:i:s')
		);
		inserttable('message', $setarrs, 1);
		$sql="update ".tname('video')." set in_passed=0 where in_id=".$row['in_id'];
		if($db->query($sql)){
			ShowMessage("��ϲ������Ƶ��˳ɹ���",$_SERVER['HTTP_REFERER'],"infotitle2",1000,1);
		}
	}

	//����ɾ��
	function AllDel(){
		global $db;
		if(!submitcheck('form')){ShowMessage("����֤�������޷��ύ��",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
		$in_id=RequestBox("in_id");
		if($in_id==0){
			ShowMessage("����ɾ��ʧ�ܣ����ȹ�ѡҪɾ������Ƶ��",$_SERVER['HTTP_REFERER'],"infotitle3",3000,1);
		}else{
			$query = $db->query("select * from ".tname('video')." where in_id in ($in_id)");
			while ($row = $db->fetch_array($query)) {
				SafeDel('video', 'in_play', $row['in_id']);
				SafeDel('video', 'in_cover', $row['in_id']);
				$db->query("delete from ".tname('comment')." where in_table='video' and in_tid=".$row['in_id']);
				$db->query("delete from ".tname('feed')." where in_icon='video' and in_tid=".$row['in_id']);
				$content='��Ǹ������������Ƶ��'.$row['in_name'].'��δͨ����˲���ɾ����';
				if($row['in_passed']==0){
		                        $db->query("update ".tname('user')." set in_points=in_points-".IN_VIDEOOUTPOINTS.",in_rank=in_rank-".IN_VIDEOOUTRANK." where in_userid=".$row['in_uid']);
		                        $content='��Ǹ������������Ƶ��'.$row['in_name'].'����ɾ����[���-'.IN_VIDEOOUTPOINTS.'][����-'.IN_VIDEOOUTRANK.']';
				}
				$setarrs = array(
		                        'in_uid' => 0,
		                        'in_uname' => 'ϵͳ�û�',
		                        'in_uids' => $row['in_uid'],
		                        'in_unames' => $row['in_uname'],
		                        'in_content' => $content,
		                        'in_isread' => 0,
		                        'in_addtime' => date('Y-m-d H:i:s')
				);
				inserttable('message', $setarrs, 1);
			}
			$sql="delete from ".tname('video')." where in_id in ($in_id)";
			if($db->query($sql)){
				ShowMessage("��ϲ������Ƶ����ɾ���ɹ���",$_SERVER['HTTP_REFERER'],"infotitle2",3000,1);
			}
		}
	}

	//�༭
	function Edit(){
		global $db;
		$in_id=intval(SafeRequest("in_id","get"));
		$sql="select * from ".tname('video')." where in_id=".$in_id;
		if($row=$db->getrow($sql)){
			$Arr=array($row['in_name'],$row['in_classid'],$row['in_singerid'],$row['in_uname'],$row['in_play'],$row['in_cover'],$row['in_intro'],$row['in_addtime']);
		}
		EditBoard($Arr,"?iframe=video&action=saveedit&in_id=".$in_id,"�༭");
	}

	//�������
	function Add(){
		$Arr=array("","","","","","","","");
		EditBoard($Arr,"?iframe=video&action=saveadd","����");
	}

	//�����������
	function SaveAdd(){
		global $db;
		if(!submitcheck('form2')){ShowMessage("����֤�������޷��ύ��",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
		$in_name = SafeRequest("in_name","post");
		$in_classid = SafeRequest("in_classid","post");
		$in_singerid = SafeRequest("in_singerid","post");
		$in_uname = SafeRequest("in_uname","post");
		$in_play = checkrename(SafeRequest("in_play","post"), 'attachment/video/play');
		$in_cover = checkrename(SafeRequest("in_cover","post"), 'attachment/video/cover');
		$in_intro = SafeRequest("in_intro","post");
		$result=$db->query("select * from ".tname('user')." where in_username='".$in_uname."'");
		if($row=$db->fetch_array($result)){
			$db->query("Insert ".tname('video')." (in_name,in_classid,in_singerid,in_uid,in_uname,in_play,in_cover,in_intro,in_hits,in_passed,in_addtime) values ('".$in_name."',".$in_classid.",".$in_singerid.",".$row['in_userid'].",'".$row['in_username']."','".$in_play."','".$in_cover."','".$in_intro."',0,0,'".date('Y-m-d H:i:s')."')");
			$db->query("update ".tname('user')." set in_points=in_points+".IN_VIDEOINPOINTS.",in_rank=in_rank+".IN_VIDEOINRANK." where in_userid=".$row['in_userid']);
			ShowMessage("��ϲ������Ƶ�����ɹ���","?iframe=video","infotitle2",1000,1);
		}else{
			ShowMessage("����ʧ�ܣ�������Ա�����ڣ�","history.back(1);","infotitle3",3000,2);
		}
	}

	//����༭����
	function SaveEdit(){
		global $db;
		if(!submitcheck('form2')){ShowMessage("����֤�������޷��ύ��",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
		$in_id = intval(SafeRequest("in_id","get"));
		$in_name = SafeRequest("in_name","post");
		$in_classid = SafeRequest("in_classid","post");
		$in_singerid = SafeRequest("in_singerid","post");
		$in_uname = SafeRequest("in_uname","post");
		$in_play = checkrename(SafeRequest("in_play","post"), 'attachment/video/play', getfield('video', 'in_play', 'in_id', $in_id), 'edit', 'video', 'in_play', $in_id);
		$in_cover = checkrename(SafeRequest("in_cover","post"), 'attachment/video/cover', getfield('video', 'in_cover', 'in_id', $in_id), 'edit', 'video', 'in_cover', $in_id);
		$in_intro = SafeRequest("in_intro","post");
		$datetime = SafeRequest("in_edittime","post")==1 ? date('Y-m-d H:i:s') : SafeRequest("in_addtime","post");
		$old=$db->getrow("select * from ".tname('video')." where in_id=".$in_id);
		$result=$db->query("select * from ".tname('user')." where in_username='".$in_uname."'");
		if($row=$db->fetch_array($result)){
			if($old['in_passed']==0 && $old['in_uid']!==$row['in_userid']){
			        $db->query("update ".tname('user')." set in_points=in_points+".IN_VIDEOINPOINTS.",in_rank=in_rank+".IN_VIDEOINRANK." where in_userid=".$row['in_userid']);
			        $db->query("update ".tname('user')." set in_points=in_points-".IN_VIDEOOUTPOINTS.",in_rank=in_rank-".IN_VIDEOOUTRANK." where in_userid=".$old['in_uid']);
			}
			$db->query("update ".tname('video')." set in_name='".$in_name."',in_classid=".$in_classid.",in_singerid=".$in_singerid.",in_uid=".$row['in_userid'].",in_uname='".$row['in_username']."',in_play='".$in_play."',in_cover='".$in_cover."',in_intro='".$in_intro."',in_addtime='".$datetime."' where in_id=".$in_id);
			ShowMessage("��ϲ������Ƶ�༭�ɹ���",$_SERVER['HTTP_REFERER'],"infotitle2",1000,1);
		}else{
			ShowMessage("�༭ʧ�ܣ�������Ա�����ڣ�","history.back(1);","infotitle3",3000,2);
		}
	}

	//�����Ŀ
	function SaveAddClass(){
		global $db;
		if(!submitcheck('form1')){ShowMessage("����֤�������޷��ύ��",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
		$in_name=SafeRequest("in_name","post");
		$in_order=SafeRequest("in_order","post");
		$sql="Insert ".tname('video_class')." (in_name,in_hide,in_order) values ('".$in_name."',0,".$in_order.")";
		if($db->query($sql)){
			ShowMessage("��ϲ������Ƶ��Ŀ�����ɹ���","?iframe=video&action=class","infotitle2",1000,1);
		}
	}

	//�༭��Ŀ
	function EditSaveClass(){
		global $db;
		if(!submitcheck('form')){ShowMessage("����֤�������޷��ύ��",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
		$in_id=RequestBox("in_id");
		if($in_id==0){
			ShowMessage("�޸�ʧ�ܣ����ȹ�ѡҪ�༭����Ŀ��","?iframe=video&action=class","infotitle3",3000,1);
		}else{
			$ID=explode(",",$in_id);
			for($i=0;$i<count($ID);$i++){
				$in_name=SafeRequest("in_name".$ID[$i],"post");
				$in_order=SafeRequest("in_order".$ID[$i],"post");
				if(!IsNul($in_name)){ShowMessage("�޸ĳ�����Ŀ���Ʋ���Ϊ�գ�","?iframe=video&action=class","infotitle3",1000,1);}
				if(!IsNum($in_order)){ShowMessage("�޸ĳ���������Ϊ�գ�","?iframe=video&action=class","infotitle3",1000,1);}
				$sql="update ".tname('video_class')." set in_name='".$in_name."',in_order=".intval($in_order)." where in_id=".intval($ID[$i]);
				$db->query($sql);
			}
			ShowMessage("��ϲ������Ƶ��Ŀ�޸ĳɹ���","?iframe=video&action=class","infotitle2",3000,1);
		}
	}

	//��Ŀ״̬
	function EditHideClass(){
		global $db;
		$in_id=intval(SafeRequest("in_id","get"));
		$in_hide=intval(SafeRequest("in_hide","get"));
		$sql="update ".tname('video_class')." set in_hide=".$in_hide." where in_id=".$in_id;
		if($db->query($sql)){
			ShowMessage("��ϲ����״̬�л��ɹ���","?iframe=video&action=class","infotitle2",1000,1);
		}
	}

	//ɾ����Ŀ
	function DelClass(){
		global $db;
		$in_id=intval(SafeRequest("in_id","get"));
		$sql="delete from ".tname('video_class')." where in_id=".$in_id;
		if($db->query($sql)){
			ShowMessage("��ϲ������Ƶ��Ŀɾ���ɹ���","?iframe=video&action=class","infotitle2",3000,1);
		}
	}
?>