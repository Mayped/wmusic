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
<title>ר������</title>
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
		main("select * from ".tname('special')." where in_classid=".$in_classid." order by in_addtime desc",20);
		break;
	case 'singer':
		$in_singerid=intval(SafeRequest("in_singerid","get"));
		main("select * from ".tname('special')." where in_singerid=".$in_singerid." order by in_addtime desc",20);
		break;
	case 'keyword':
		$key=SafeRequest("key","get");
		main("select * from ".tname('special')." where in_name like '%".$key."%' or in_uname like '%".$key."%' order by in_addtime desc",20);
		break;
	case 'pass':
		main("select * from ".tname('special')." where in_passed=1 order by in_addtime desc",20);
		break;
	default:
		main("select * from ".tname('special')." order by in_addtime desc",20);
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
	$in_cover = $Arr[4];
	$in_intro = $Arr[5];
	$in_firm = $Arr[6];
	$in_lang = $Arr[7];
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
            asyncbox.tips("ר�����Ʋ���Ϊ�գ�����д��", "wait", 1000);
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
        else {
            return true;
        }
}
</script>
<div class="container">
<script type="text/javascript">parent.document.title = '�������ֻ��� �������� - ������� - <?php echo $arrname; ?>ר��';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='�������&nbsp;&raquo;&nbsp;<?php echo $arrname; ?>ר��';</script>
<div class="floattop"><div class="itemtitle"><h3><?php echo $arrname; ?>ר��</h3><ul class="tab1">
<li><a href="?iframe=special"><span>����ר��</span></a></li>
<?php if($action=="add"){echo "<li class=\"current\">";}else{echo "<li>";} ?><a href="?iframe=special&action=add"><span>����ר��</span></a></li>
<li><a href="?iframe=special&action=pass"><span>����ר��</span></a></li>
<li><a href="?iframe=special&action=class"><span>ר����Ŀ</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<form action="<?php echo $url; ?>" method="post" name="form2">
<table class="tb tb2">
<tr>
<td class="td29">ר�����ƣ�<input type="text" class="txt" value="<?php echo $in_name; ?>" name="in_name" id="in_name"></td>
<td>������Ŀ��<select name="in_classid" id="in_classid">
<option value="0">ѡ����Ŀ</option>
<?php
$sql="select * from ".tname('special_class')." order by in_id asc";
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
<td>���й�˾��<input type="text" class="txt" value="<?php echo $in_firm; ?>" name="in_firm" id="in_firm"></td>
<td>�������ԣ�<select name="in_lang" id="in_lang">
<option value="����">����</option>
<option value="����"<?php if($in_lang=="����"){echo " selected";} ?>>����</option>
<option value="����"<?php if($in_lang=="����"){echo " selected";} ?>>����</option>
<option value="����"<?php if($in_lang=="����"){echo " selected";} ?>>����</option>
<option value="Ӣ��"<?php if($in_lang=="Ӣ��"){echo " selected";} ?>>Ӣ��</option>
<option value="����"<?php if($in_lang=="����"){echo " selected";} ?>>����</option>
<option value="����"<?php if($in_lang=="����"){echo " selected";} ?>>����</option>
</select></td>
</tr>

<tr>
<td class="longtxt">�����ַ��<input type="text" class="txt" value="<?php echo $in_cover; ?>" name="in_cover" id="in_cover"></td><td><div class="rssbutton"><input type="button" value="�ϴ�����" onclick="pop.up('no', '�ϴ�����', 'source/pack/upload/open.php?type=special_cover&form=form2.in_cover', '406px', '180px', '175px');" /></div></td>
</tr>
</table>

<table class="tb tb2">
<tr><td><div style="height:100px;line-height:100px;float:left;">ר�����ܣ�</div><textarea rows="6" cols="50" id="in_intro" name="in_intro" style="width:400px;height:100px;"><?php echo $in_intro; ?></textarea></td></tr>
<tr><td><input type="submit" class="btn" name="form2" value="�ύ" onclick="return CheckForm();" /><?php if($_GET['action']=="edit"){ ?><input type="hidden" name="in_addtime" value="<?php echo $Arr[8]; ?>"><input class="checkbox" type="checkbox" name="in_edittime" id="in_edittime" value="1" checked /><label for="in_edittime">����ʱ��</label><?php } ?></td></tr>
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
		layer.tips('ɾ��ר�������棬�����������', '#chkall', {
			tips: 3
		});
        }
}
</script>
<div class="container">
<?php if(empty($action)){echo "<script type=\"text/javascript\">parent.document.title = '�������ֻ��� �������� - ������� - ����ר��';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='�������&nbsp;&raquo;&nbsp;����ר��';</script>";} ?>
<?php if($action=="pass"){echo "<script type=\"text/javascript\">parent.document.title = '�������ֻ��� �������� - ������� - ����ר��';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='�������&nbsp;&raquo;&nbsp;����ר��';</script>";} ?>
<?php if($action=="keyword"){echo "<script type=\"text/javascript\">parent.document.title = '�������ֻ��� �������� - ������� - ����ר��';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='�������&nbsp;&raquo;&nbsp;����ר��';</script>";} ?>
<?php if($action=="list"){echo "<script type=\"text/javascript\">parent.document.title = '�������ֻ��� �������� - ������� - ��Ŀר��';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='�������&nbsp;&raquo;&nbsp;��Ŀר��';</script>";} ?>
<?php if($action=="singer"){echo "<script type=\"text/javascript\">parent.document.title = '�������ֻ��� �������� - ������� - ����ר��';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='�������&nbsp;&raquo;&nbsp;����ר��';</script>";} ?>
<div class="floattop"><div class="itemtitle"><h3><?php if(empty($action)){echo "����ר��";}else if($action=="pass"){echo "����ר��";}else if($action=="keyword"){echo "����ר��";}else if($action=="list"){echo "��Ŀר��";}else if($action=="singer"){echo "����ר��";} ?></h3><ul class="tab1">
<?php if(empty($action)){echo "<li class=\"current\">";}else{echo "<li>";} ?><a href="?iframe=special"><span>����ר��</span></a></li>
<li><a href="?iframe=special&action=add"><span>����ר��</span></a></li>
<?php if($action=="pass"){echo "<li class=\"current\">";}else{echo "<li>";} ?><a href="?iframe=special&action=pass"><span>����ר��</span></a></li>
<li><a href="?iframe=special&action=class"><span>ר����Ŀ</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th class="partition">������ʾ</th></tr>
<tr><td class="tipsblock"><ul>
<?php
if(empty($action)){
echo "<li>���������е�ר��</li>";
}elseif($action=="pass"){
echo "<li>��������Ҫ��˵�ר����������ǰ̨��ʾ</li>";
}elseif($action=="keyword"){
echo "<li>������������".SafeRequest("key","get")."����ר��</li>";
}elseif($action=="list"){
echo "<li>�����ǰ���Ŀ�鿴��ר��</li>";
}elseif($action=="singer"){
echo "<li>�����ǰ����ֲ鿴��ר��</li>";
}
?>
<li>��������ר�����ơ�������Ա�ȹؼ��ʽ�������</li>
</ul></td></tr>
</table>
<table class="tb tb2">
<form name="btnsearch" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<tr><td>
<input type="hidden" name="iframe" value="special">
<input type="hidden" name="action" value="keyword">
�ؼ��ʣ�<input class="txt" x-webkit-speech type="text" name="key" id="search" value="" />
<select onchange="location.href=this.options[this.selectedIndex].value;">
<option value="?iframe=special">������Ŀ</option>
<?php
$res=$db->query("select * from ".tname('special_class')." order by in_id asc");
if($res){
        while ($row = $db->fetch_array($res)){
                if(SafeRequest("in_classid","get")==$row['in_id']){
                        echo "<option value=\"?iframe=special&action=list&in_classid=".$row['in_id']."\" selected=\"selected\">".$row['in_name']."</option>";
                }else{
                        echo "<option value=\"?iframe=special&action=list&in_classid=".$row['in_id']."\">".$row['in_name']."</option>";
                }
        }
}
?>
</select>
<select onchange="location.href=this.options[this.selectedIndex].value;">
<option value="?iframe=special">���޸���</option>
<?php
$res=$db->query("select * from ".tname('singer')." order by in_addtime desc");
if($res){
        while ($row = $db->fetch_array($res)){
                if(SafeRequest("in_singerid","get")==$row['in_id']){
                        echo "<option value=\"?iframe=special&action=singer&in_singerid=".$row['in_id']."\" selected=\"selected\">".getlenth($row['in_name'], 10)."</option>";
                }else{
                        echo "<option value=\"?iframe=special&action=singer&in_singerid=".$row['in_id']."\">".getlenth($row['in_name'], 10)."</option>";
                }
        }
}
?>
</select>
<input type="button" value="����" class="btn" onclick="s()" />
</td></tr>
</form>
</table>
<form name="form" method="post" action="?iframe=special&action=alldel">
<table class="tb tb2">
<tr class="header">
<th>���</th>
<th>ר������</th>
<th>ר������</th>
<th>������Ա</th>
<th>���</th>
<th>����ʱ��</th>
<th>�༭����</th>
</tr>
<?php
if($count==0){
?>
<tr><td colspan="2" class="td27">û��ר��</td></tr>
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
<td><a href="<?php echo getlink($row['in_id'], 'special'); ?>" target="_blank" class="act"><?php echo ReplaceStr($row['in_name'],SafeRequest("key","get"),"<em class=\"lightnum\">".SafeRequest("key","get")."</em>"); ?></a></td>
<td><a href="<?php echo getlink($row['in_uid']); ?>" target="_blank" class="act"><?php echo ReplaceStr($row['in_uname'],SafeRequest("key","get"),"<em class=\"lightnum\">".SafeRequest("key","get")."</em>"); ?></a></td>
<td><?php if($row['in_passed']==1){ ?><a href="?iframe=special&action=editpassed&in_id=<?php echo $row['in_id']; ?>"><img src="static/admincp/css/pass_no.gif" /></a><?php }else{ ?><img src="static/admincp/css/pass_yes.gif" /><?php } ?></td>
<td><?php if(date('Y-m-d',strtotime($row['in_addtime']))==date('Y-m-d')){echo "<em class=\"lightnum\">".date('Y-m-d',strtotime($row['in_addtime']))."</em>";}else{echo date('Y-m-d',strtotime($row['in_addtime']));} ?></td>
<td><a href="?iframe=special&action=edit&in_id=<?php echo $row['in_id']; ?>" class="act">�༭</a></td>
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
	$sql="select * from ".tname('special_class')." order by in_id asc";
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
<script type="text/javascript">parent.document.title = '�������ֻ��� �������� - ������� - ר����Ŀ';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='�������&nbsp;&raquo;&nbsp;ר����Ŀ';</script>
<div class="floattop"><div class="itemtitle"><h3>ר����Ŀ</h3><ul class="tab1">
<li><a href="?iframe=special"><span>����ר��</span></a></li>
<li><a href="?iframe=special&action=add"><span>����ר��</span></a></li>
<li><a href="?iframe=special&action=pass"><span>����ר��</span></a></li>
<li class="current"><a href="?iframe=special&action=class"><span>ר����Ŀ</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th class="partition">��Ŀ����</th></tr>
</table>
<form name="form" method="post" action="?iframe=special&action=editsaveclass">
<table class="tb tb2">
<tr class="header">
<th>���</th>
<th>��Ŀ����</th>
<th>ר��ͳ��</th>
<th>����</th>
<th>״̬</th>
<th>�༭����</th>
</tr>
<?php
if($count==0){
?>
<tr><td colspan="2" class="td27">û��ר����Ŀ</td></tr>
<?php
}
if($result){
while ($row = $db->fetch_array($result)){
?>
<tr class="hover">
<td class="td25"><input class="checkbox" type="checkbox" name="in_id[]" id="in_id" value="<?php echo $row['in_id']; ?>"><?php echo $row['in_id']; ?></td>
<td><div class="parentboard"><input type="text" name="in_name<?php echo $row['in_id']; ?>" value="<?php echo $row['in_name']; ?>" class="txt" /></div></td>
<td><a href="?iframe=special&action=list&in_classid=<?php echo $row['in_id']; ?>" class="act">
<?php
$sqlstr="select * from ".tname('special')." where in_classid=".$row['in_id'];
$res=$db->query($sqlstr);
$nums=$db->num_rows($res);
echo $nums;
?>
</a></td>
<td class="td25"><input type="text" name="in_order<?php echo $row['in_id']; ?>" value="<?php echo $row['in_order']; ?>" class="txt" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" /></td>
<td>
<?php if($row['in_hide']==1){ ?>
<a href="?iframe=special&action=edithideclass&in_id=<?php echo $row['in_id']; ?>&in_hide=0"><img src="static/admincp/css/show_no.gif" /></a>
<?php }else{ ?>
<a href="?iframe=special&action=edithideclass&in_id=<?php echo $row['in_id']; ?>&in_hide=1"><img src="static/admincp/css/show_yes.gif" /></a>
<?php } ?>
</td>
<td><input type="button" class="btn" value="ɾ��" onclick="location.href='?iframe=special&action=delclass&in_id=<?php echo $row['in_id']; ?>';" /></td>
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
<form name="form1" method="post" action="?iframe=special&action=saveaddclass">
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
		$row = $db->getrow("select * from ".tname('special')." where in_id=".$in_id);
		$db->query("update ".tname('user')." set in_points=in_points+".IN_SPECIALINPOINTS.",in_rank=in_rank+".IN_SPECIALINRANK." where in_userid=".$row['in_uid']);
		$setarrs = array(
			'in_uid' => 0,
			'in_uname' => 'ϵͳ�û�',
			'in_uids' => $row['in_uid'],
			'in_unames' => $row['in_uname'],
			'in_content' => '��ϲ����������ר����'.$row['in_name'].'����ͨ����ˣ�[���+'.IN_SPECIALINPOINTS.'][����+'.IN_SPECIALINRANK.']',
			'in_isread' => 0,
			'in_addtime' => date('Y-m-d H:i:s')
		);
		inserttable('message', $setarrs, 1);
		$sql="update ".tname('special')." set in_passed=0 where in_id=".$row['in_id'];
		if($db->query($sql)){
			ShowMessage("��ϲ����ר����˳ɹ���",$_SERVER['HTTP_REFERER'],"infotitle2",1000,1);
		}
	}

	//����ɾ��
	function AllDel(){
		global $db;
		if(!submitcheck('form')){ShowMessage("����֤�������޷��ύ��",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
		$in_id=RequestBox("in_id");
		if($in_id==0){
			ShowMessage("����ɾ��ʧ�ܣ����ȹ�ѡҪɾ����ר����",$_SERVER['HTTP_REFERER'],"infotitle3",3000,1);
		}else{
			$query = $db->query("select * from ".tname('special')." where in_id in ($in_id)");
			while ($row = $db->fetch_array($query)) {
				SafeDel('special', 'in_cover', $row['in_id']);
				$db->query("delete from ".tname('comment')." where in_table='special' and in_tid=".$row['in_id']);
				$db->query("delete from ".tname('feed')." where in_icon='special' and in_tid=".$row['in_id']);
				$content='��Ǹ����������ר����'.$row['in_name'].'��δͨ����˲���ɾ����';
				if($row['in_passed']==0){
		                        $db->query("update ".tname('user')." set in_points=in_points-".IN_SPECIALOUTPOINTS.",in_rank=in_rank-".IN_SPECIALOUTRANK." where in_userid=".$row['in_uid']);
		                        $content='��Ǹ����������ר����'.$row['in_name'].'����ɾ����[���-'.IN_SPECIALOUTPOINTS.'][����-'.IN_SPECIALOUTRANK.']';
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
			$sql="delete from ".tname('special')." where in_id in ($in_id)";
			if($db->query($sql)){
				ShowMessage("��ϲ����ר������ɾ���ɹ���",$_SERVER['HTTP_REFERER'],"infotitle2",3000,1);
			}
		}
	}

	//�༭
	function Edit(){
		global $db;
		$in_id=intval(SafeRequest("in_id","get"));
		$sql="select * from ".tname('special')." where in_id=".$in_id;
		if($row=$db->getrow($sql)){
			$Arr=array($row['in_name'],$row['in_classid'],$row['in_singerid'],$row['in_uname'],$row['in_cover'],$row['in_intro'],$row['in_firm'],$row['in_lang'],$row['in_addtime']);
		}
		EditBoard($Arr,"?iframe=special&action=saveedit&in_id=".$in_id,"�༭");
	}

	//�������
	function Add(){
		$Arr=array("","","","","","","","","");
		EditBoard($Arr,"?iframe=special&action=saveadd","����");
	}

	//�����������
	function SaveAdd(){
		global $db;
		if(!submitcheck('form2')){ShowMessage("����֤�������޷��ύ��",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
		$in_name = SafeRequest("in_name","post");
		$in_classid = SafeRequest("in_classid","post");
		$in_singerid = SafeRequest("in_singerid","post");
		$in_uname = SafeRequest("in_uname","post");
		$in_cover = checkrename(SafeRequest("in_cover","post"), 'attachment/special/cover');
		$in_intro = SafeRequest("in_intro","post");
		$in_firm = SafeRequest("in_firm","post");
		$in_lang = SafeRequest("in_lang","post");
		$result=$db->query("select * from ".tname('user')." where in_username='".$in_uname."'");
		if($row=$db->fetch_array($result)){
			$db->query("Insert ".tname('special')." (in_name,in_classid,in_singerid,in_uid,in_uname,in_cover,in_intro,in_firm,in_lang,in_hits,in_passed,in_addtime) values ('".$in_name."',".$in_classid.",".$in_singerid.",".$row['in_userid'].",'".$row['in_username']."','".$in_cover."','".$in_intro."','".$in_firm."','".$in_lang."',0,0,'".date('Y-m-d H:i:s')."')");
			$db->query("update ".tname('user')." set in_points=in_points+".IN_SPECIALINPOINTS.",in_rank=in_rank+".IN_SPECIALINRANK." where in_userid=".$row['in_userid']);
			ShowMessage("��ϲ����ר�������ɹ���","?iframe=special","infotitle2",1000,1);
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
		$in_cover = checkrename(SafeRequest("in_cover","post"), 'attachment/special/cover', getfield('special', 'in_cover', 'in_id', $in_id), 'edit', 'special', 'in_cover', $in_id);
		$in_intro = SafeRequest("in_intro","post");
		$in_firm = SafeRequest("in_firm","post");
		$in_lang = SafeRequest("in_lang","post");
		$datetime = SafeRequest("in_edittime","post")==1 ? date('Y-m-d H:i:s') : SafeRequest("in_addtime","post");
		$old=$db->getrow("select * from ".tname('special')." where in_id=".$in_id);
		$result=$db->query("select * from ".tname('user')." where in_username='".$in_uname."'");
		if($row=$db->fetch_array($result)){
			if($old['in_passed']==0 && $old['in_uid']!==$row['in_userid']){
			        $db->query("update ".tname('user')." set in_points=in_points+".IN_SPECIALINPOINTS.",in_rank=in_rank+".IN_SPECIALINRANK." where in_userid=".$row['in_userid']);
			        $db->query("update ".tname('user')." set in_points=in_points-".IN_SPECIALOUTPOINTS.",in_rank=in_rank-".IN_SPECIALOUTRANK." where in_userid=".$old['in_uid']);
			}
			$db->query("update ".tname('special')." set in_name='".$in_name."',in_classid=".$in_classid.",in_singerid=".$in_singerid.",in_uid=".$row['in_userid'].",in_uname='".$row['in_username']."',in_cover='".$in_cover."',in_intro='".$in_intro."',in_firm='".$in_firm."',in_lang='".$in_lang."',in_addtime='".$datetime."' where in_id=".$in_id);
			ShowMessage("��ϲ����ר���༭�ɹ���",$_SERVER['HTTP_REFERER'],"infotitle2",1000,1);
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
		$sql="Insert ".tname('special_class')." (in_name,in_hide,in_order) values ('".$in_name."',0,".$in_order.")";
		if($db->query($sql)){
			ShowMessage("��ϲ����ר����Ŀ�����ɹ���","?iframe=special&action=class","infotitle2",1000,1);
		}
	}

	//�༭��Ŀ
	function EditSaveClass(){
		global $db;
		if(!submitcheck('form')){ShowMessage("����֤�������޷��ύ��",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
		$in_id=RequestBox("in_id");
		if($in_id==0){
			ShowMessage("�޸�ʧ�ܣ����ȹ�ѡҪ�༭����Ŀ��","?iframe=special&action=class","infotitle3",3000,1);
		}else{
			$ID=explode(",",$in_id);
			for($i=0;$i<count($ID);$i++){
				$in_name=SafeRequest("in_name".$ID[$i],"post");
				$in_order=SafeRequest("in_order".$ID[$i],"post");
				if(!IsNul($in_name)){ShowMessage("�޸ĳ�����Ŀ���Ʋ���Ϊ�գ�","?iframe=special&action=class","infotitle3",1000,1);}
				if(!IsNum($in_order)){ShowMessage("�޸ĳ���������Ϊ�գ�","?iframe=special&action=class","infotitle3",1000,1);}
				$sql="update ".tname('special_class')." set in_name='".$in_name."',in_order=".intval($in_order)." where in_id=".intval($ID[$i]);
				$db->query($sql);
			}
			ShowMessage("��ϲ����ר����Ŀ�޸ĳɹ���","?iframe=special&action=class","infotitle2",3000,1);
		}
	}

	//��Ŀ״̬
	function EditHideClass(){
		global $db;
		$in_id=intval(SafeRequest("in_id","get"));
		$in_hide=intval(SafeRequest("in_hide","get"));
		$sql="update ".tname('special_class')." set in_hide=".$in_hide." where in_id=".$in_id;
		if($db->query($sql)){
			ShowMessage("��ϲ����״̬�л��ɹ���","?iframe=special&action=class","infotitle2",1000,1);
		}
	}

	//ɾ����Ŀ
	function DelClass(){
		global $db;
		$in_id=intval(SafeRequest("in_id","get"));
		$sql="delete from ".tname('special_class')." where in_id=".$in_id;
		if($db->query($sql)){
			ShowMessage("��ϲ����ר����Ŀɾ���ɹ���","?iframe=special&action=class","infotitle2",3000,1);
		}
	}
?>