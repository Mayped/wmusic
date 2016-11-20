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
<title>���ֹ���</title>
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
		main("select * from ".tname('singer')." where in_classid=".$in_classid." order by in_addtime desc",20);
		break;
	case 'keyword':
		$key=SafeRequest("key","get");
	        $letter_arr=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
	        $letter_arr1=array(-20319,-20283,-19775,-19218,-18710,-18526,-18239,-17922,-1,-17417,-16474,-16212,-15640,-15165,-14922,-14914,-14630,-14149,-14090,-13318,-1,-1,-12838,-12556,-11847,-11055);
	        $letter_arr2=array(-20284,-19776,-19219,-18711,-18527,-18240,-17923,-17418,-1,-16475,-16213,-15641,-15166,-14923,-14915,-14631,-14150,-14091,-13319,-12839,-1,-1,-12557,-11848,-11056,-2050);
	        if(in_array(strtoupper($key),$letter_arr)){
			$posarr=array_keys($letter_arr,strtoupper($key));
			$pos=$posarr[0];
			main("select * from ".tname('singer')." where UPPER(substring(".convert_using('in_name').",1,1))='".$letter_arr[$pos]."' or ord(substring(".convert_using('in_name').",1,1))-65536>=".$letter_arr1[$pos]." and  ord(substring(".convert_using('in_name').",1,1))-65536<=".$letter_arr2[$pos],20);
	        }else{
			main("select * from ".tname('singer')." where in_name like '%".$key."%' or in_uname like '%".$key."%' order by in_addtime desc",20);
	        }
		break;
	case 'pass':
		main("select * from ".tname('singer')." where in_passed=1 order by in_addtime desc",20);
		break;
	default:
		main("select * from ".tname('singer')." order by in_addtime desc",20);
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
	$in_nick = $Arr[1];
	$in_classid = $Arr[2];
	$in_uname = !IsNul($Arr[3]) && $one ? $_COOKIE['in_adminname'] : $Arr[3];
	$in_cover = $Arr[4];
	$in_intro = $Arr[5];
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
            asyncbox.tips("�������Ʋ���Ϊ�գ�����д��", "wait", 1000);
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
<script type="text/javascript">parent.document.title = 'Ear Music Board �������� - ������� - <?php echo $arrname; ?>����';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='�������&nbsp;&raquo;&nbsp;<?php echo $arrname; ?>����';</script>
<div class="floattop"><div class="itemtitle"><h3><?php echo $arrname; ?>����</h3><ul class="tab1">
<li><a href="?iframe=singer"><span>���и���</span></a></li>
<?php if($action=="add"){echo "<li class=\"current\">";}else{echo "<li>";} ?><a href="?iframe=singer&action=add"><span>��������</span></a></li>
<li><a href="?iframe=singer&action=pass"><span>�������</span></a></li>
<li><a href="?iframe=singer&action=class"><span>������Ŀ</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<form action="<?php echo $url; ?>" method="post" name="form2">
<table class="tb tb2">
<tr>
<td class="td29">�������ƣ�<input type="text" class="txt" value="<?php echo $in_name; ?>" name="in_name" id="in_name"></td>
<td>������Ŀ��<select name="in_classid" id="in_classid">
<option value="0">ѡ����Ŀ</option>
<?php
$sql="select * from ".tname('singer_class')." order by in_id asc";
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
<td>���ֱ�����<input type="text" class="txt" value="<?php echo $in_nick; ?>" name="in_nick" id="in_nick"></td>
<td>������Ա��<input type="text" class="txt" value="<?php echo $in_uname; ?>" name="in_uname" id="in_uname"></td>
</tr>

<tr>
<td class="longtxt">�����ַ��<input type="text" class="txt" value="<?php echo $in_cover; ?>" name="in_cover" id="in_cover"></td><td><div class="rssbutton"><input type="button" value="�ϴ�����" onclick="pop.up('no', '�ϴ�����', 'source/pack/upload/open.php?type=singer_cover&form=form2.in_cover', '406px', '180px', '175px');" /></div></td>
</tr>
</table>

<table class="tb tb2">
<tr><td><div style="height:100px;line-height:100px;float:left;">���ֽ��ܣ�</div><textarea rows="6" cols="50" id="in_intro" name="in_intro" style="width:400px;height:100px;"><?php echo $in_intro; ?></textarea></td></tr>
<tr><td><input type="submit" class="btn" name="form2" value="�ύ" onclick="return CheckForm();" /><?php if($_GET['action']=="edit"){ ?><input type="hidden" name="in_addtime" value="<?php echo $Arr[6]; ?>"><input class="checkbox" type="checkbox" name="in_edittime" id="in_edittime" value="1" checked /><label for="in_edittime">����ʱ��</label><?php } ?></td></tr>
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
		layer.tips('ɾ�����ֲ����棬�����������', '#chkall', {
			tips: 3
		});
        }
}
</script>
<div class="container">
<?php if(empty($action)){echo "<script type=\"text/javascript\">parent.document.title = 'Ear Music Board �������� - ������� - ���и���';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='�������&nbsp;&raquo;&nbsp;���и���';</script>";} ?>
<?php if($action=="pass"){echo "<script type=\"text/javascript\">parent.document.title = 'Ear Music Board �������� - ������� - �������';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='�������&nbsp;&raquo;&nbsp;�������';</script>";} ?>
<?php if($action=="keyword"){echo "<script type=\"text/javascript\">parent.document.title = 'Ear Music Board �������� - ������� - ��������';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='�������&nbsp;&raquo;&nbsp;��������';</script>";} ?>
<?php if($action=="list"){echo "<script type=\"text/javascript\">parent.document.title = 'Ear Music Board �������� - ������� - ��Ŀ����';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='�������&nbsp;&raquo;&nbsp;��Ŀ����';</script>";} ?>
<div class="floattop"><div class="itemtitle"><h3><?php if(empty($action)){echo "���и���";}else if($action=="pass"){echo "�������";}else if($action=="keyword"){echo "��������";}else if($action=="list"){echo "��Ŀ����";} ?></h3><ul class="tab1">
<?php if(empty($action)){echo "<li class=\"current\">";}else{echo "<li>";} ?><a href="?iframe=singer"><span>���и���</span></a></li>
<li><a href="?iframe=singer&action=add"><span>��������</span></a></li>
<?php if($action=="pass"){echo "<li class=\"current\">";}else{echo "<li>";} ?><a href="?iframe=singer&action=pass"><span>�������</span></a></li>
<li><a href="?iframe=singer&action=class"><span>������Ŀ</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th class="partition">������ʾ</th></tr>
<tr><td class="tipsblock"><ul>
<?php
if(empty($action)){
echo "<li>���������еĸ���</li>";
}elseif($action=="pass"){
echo "<li>��������Ҫ��˵ĸ��֣�������ǰ̨��ʾ</li>";
}elseif($action=="keyword"){
echo "<li>������������".SafeRequest("key","get")."���ĸ���</li>";
}elseif($action=="list"){
echo "<li>�����ǰ���Ŀ�鿴�ĸ���</li>";
}
?>
<li>��������������ơ�������Ա�ȹؼ��ʽ�������</li>
</ul></td></tr>
</table>
<table class="tb tb2">
<form name="btnsearch" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<tr><td>
<input type="hidden" name="iframe" value="singer">
<input type="hidden" name="action" value="keyword">
�ؼ��ʣ�<input class="txt" x-webkit-speech type="text" name="key" id="search" value="" />
<select onchange="location.href=this.options[this.selectedIndex].value;">
<option value="?iframe=singer">������Ŀ</option>
<?php
$res=$db->query("select * from ".tname('singer_class')." order by in_id asc");
if($res){
        while ($row = $db->fetch_array($res)){
                if(SafeRequest("in_classid","get")==$row['in_id']){
                        echo "<option value=\"?iframe=singer&action=list&in_classid=".$row['in_id']."\" selected=\"selected\">".$row['in_name']."</option>";
                }else{
                        echo "<option value=\"?iframe=singer&action=list&in_classid=".$row['in_id']."\">".$row['in_name']."</option>";
                }
        }
}
?>
</select>
<select onchange="location.href=this.options[this.selectedIndex].value;">
<option value="?iframe=singer">������ĸ</option>
<option value="?iframe=singer&action=keyword&key=A"<?php if(strtoupper(SafeRequest("key","get"))=="A"){echo " selected";} ?>>A</option>
<option value="?iframe=singer&action=keyword&key=B"<?php if(strtoupper(SafeRequest("key","get"))=="B"){echo " selected";} ?>>B</option>
<option value="?iframe=singer&action=keyword&key=C"<?php if(strtoupper(SafeRequest("key","get"))=="C"){echo " selected";} ?>>C</option>
<option value="?iframe=singer&action=keyword&key=D"<?php if(strtoupper(SafeRequest("key","get"))=="D"){echo " selected";} ?>>D</option>
<option value="?iframe=singer&action=keyword&key=E"<?php if(strtoupper(SafeRequest("key","get"))=="E"){echo " selected";} ?>>E</option>
<option value="?iframe=singer&action=keyword&key=F"<?php if(strtoupper(SafeRequest("key","get"))=="F"){echo " selected";} ?>>F</option>
<option value="?iframe=singer&action=keyword&key=G"<?php if(strtoupper(SafeRequest("key","get"))=="G"){echo " selected";} ?>>G</option>
<option value="?iframe=singer&action=keyword&key=H"<?php if(strtoupper(SafeRequest("key","get"))=="H"){echo " selected";} ?>>H</option>
<option value="?iframe=singer&action=keyword&key=I"<?php if(strtoupper(SafeRequest("key","get"))=="I"){echo " selected";} ?>>I</option>
<option value="?iframe=singer&action=keyword&key=J"<?php if(strtoupper(SafeRequest("key","get"))=="J"){echo " selected";} ?>>J</option>
<option value="?iframe=singer&action=keyword&key=K"<?php if(strtoupper(SafeRequest("key","get"))=="K"){echo " selected";} ?>>K</option>
<option value="?iframe=singer&action=keyword&key=L"<?php if(strtoupper(SafeRequest("key","get"))=="L"){echo " selected";} ?>>L</option>
<option value="?iframe=singer&action=keyword&key=M"<?php if(strtoupper(SafeRequest("key","get"))=="M"){echo " selected";} ?>>M</option>
<option value="?iframe=singer&action=keyword&key=N"<?php if(strtoupper(SafeRequest("key","get"))=="N"){echo " selected";} ?>>N</option>
<option value="?iframe=singer&action=keyword&key=O"<?php if(strtoupper(SafeRequest("key","get"))=="O"){echo " selected";} ?>>O</option>
<option value="?iframe=singer&action=keyword&key=P"<?php if(strtoupper(SafeRequest("key","get"))=="P"){echo " selected";} ?>>P</option>
<option value="?iframe=singer&action=keyword&key=Q"<?php if(strtoupper(SafeRequest("key","get"))=="Q"){echo " selected";} ?>>Q</option>
<option value="?iframe=singer&action=keyword&key=R"<?php if(strtoupper(SafeRequest("key","get"))=="R"){echo " selected";} ?>>R</option>
<option value="?iframe=singer&action=keyword&key=S"<?php if(strtoupper(SafeRequest("key","get"))=="S"){echo " selected";} ?>>S</option>
<option value="?iframe=singer&action=keyword&key=T"<?php if(strtoupper(SafeRequest("key","get"))=="T"){echo " selected";} ?>>T</option>
<option value="?iframe=singer&action=keyword&key=U"<?php if(strtoupper(SafeRequest("key","get"))=="U"){echo " selected";} ?>>U</option>
<option value="?iframe=singer&action=keyword&key=V"<?php if(strtoupper(SafeRequest("key","get"))=="V"){echo " selected";} ?>>V</option>
<option value="?iframe=singer&action=keyword&key=W"<?php if(strtoupper(SafeRequest("key","get"))=="W"){echo " selected";} ?>>W</option>
<option value="?iframe=singer&action=keyword&key=X"<?php if(strtoupper(SafeRequest("key","get"))=="X"){echo " selected";} ?>>X</option>
<option value="?iframe=singer&action=keyword&key=Y"<?php if(strtoupper(SafeRequest("key","get"))=="Y"){echo " selected";} ?>>Y</option>
<option value="?iframe=singer&action=keyword&key=Z"<?php if(strtoupper(SafeRequest("key","get"))=="Z"){echo " selected";} ?>>Z</option>
</select>
<input type="button" value="����" class="btn" onclick="s()" />
</td></tr>
</form>
</table>
<form name="form" method="post" action="?iframe=singer&action=alldel">
<table class="tb tb2">
<tr class="header">
<th>���</th>
<th>���ַ���</th>
<th>��������</th>
<th>������Ա</th>
<th>���</th>
<th>����ʱ��</th>
<th>�༭����</th>
</tr>
<?php
if($count==0){
?>
<tr><td colspan="2" class="td27">û�и���</td></tr>
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
<td><a href="<?php echo getlink($row['in_id'], 'singer'); ?>" target="_blank" class="act"><?php echo ReplaceStr($row['in_name'],SafeRequest("key","get"),"<em class=\"lightnum\">".SafeRequest("key","get")."</em>"); ?></a></td>
<td><a href="<?php echo getlink($row['in_uid']); ?>" target="_blank" class="act"><?php echo ReplaceStr($row['in_uname'],SafeRequest("key","get"),"<em class=\"lightnum\">".SafeRequest("key","get")."</em>"); ?></a></td>
<td><?php if($row['in_passed']==1){ ?><a href="?iframe=singer&action=editpassed&in_id=<?php echo $row['in_id']; ?>"><img src="static/admincp/css/pass_no.gif" /></a><?php }else{ ?><img src="static/admincp/css/pass_yes.gif" /><?php } ?></td>
<td><?php if(date('Y-m-d',strtotime($row['in_addtime']))==date('Y-m-d')){echo "<em class=\"lightnum\">".date('Y-m-d',strtotime($row['in_addtime']))."</em>";}else{echo date('Y-m-d',strtotime($row['in_addtime']));} ?></td>
<td><a href="?iframe=singer&action=edit&in_id=<?php echo $row['in_id']; ?>" class="act">�༭</a></td>
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
	$sql="select * from ".tname('singer_class')." order by in_id asc";
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
<script type="text/javascript">parent.document.title = 'Ear Music Board �������� - ������� - ������Ŀ';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='�������&nbsp;&raquo;&nbsp;������Ŀ';</script>
<div class="floattop"><div class="itemtitle"><h3>������Ŀ</h3><ul class="tab1">
<li><a href="?iframe=singer"><span>���и���</span></a></li>
<li><a href="?iframe=singer&action=add"><span>��������</span></a></li>
<li><a href="?iframe=singer&action=pass"><span>�������</span></a></li>
<li class="current"><a href="?iframe=singer&action=class"><span>������Ŀ</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th class="partition">��Ŀ����</th></tr>
</table>
<form name="form" method="post" action="?iframe=singer&action=editsaveclass">
<table class="tb tb2">
<tr class="header">
<th>���</th>
<th>��Ŀ����</th>
<th>����ͳ��</th>
<th>����</th>
<th>״̬</th>
<th>�༭����</th>
</tr>
<?php
if($count==0){
?>
<tr><td colspan="2" class="td27">û�и�����Ŀ</td></tr>
<?php
}
if($result){
while ($row = $db->fetch_array($result)){
?>
<tr class="hover">
<td class="td25"><input class="checkbox" type="checkbox" name="in_id[]" id="in_id" value="<?php echo $row['in_id']; ?>"><?php echo $row['in_id']; ?></td>
<td><div class="parentboard"><input type="text" name="in_name<?php echo $row['in_id']; ?>" value="<?php echo $row['in_name']; ?>" class="txt" /></div></td>
<td><a href="?iframe=singer&action=list&in_classid=<?php echo $row['in_id']; ?>" class="act">
<?php
$sqlstr="select * from ".tname('singer')." where in_classid=".$row['in_id'];
$res=$db->query($sqlstr);
$nums=$db->num_rows($res);
echo $nums;
?>
</a></td>
<td class="td25"><input type="text" name="in_order<?php echo $row['in_id']; ?>" value="<?php echo $row['in_order']; ?>" class="txt" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" /></td>
<td>
<?php if($row['in_hide']==1){ ?>
<a href="?iframe=singer&action=edithideclass&in_id=<?php echo $row['in_id']; ?>&in_hide=0"><img src="static/admincp/css/show_no.gif" /></a>
<?php }else{ ?>
<a href="?iframe=singer&action=edithideclass&in_id=<?php echo $row['in_id']; ?>&in_hide=1"><img src="static/admincp/css/show_yes.gif" /></a>
<?php } ?>
</td>
<td><input type="button" class="btn" value="ɾ��" onclick="location.href='?iframe=singer&action=delclass&in_id=<?php echo $row['in_id']; ?>';" /></td>
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
<form name="form1" method="post" action="?iframe=singer&action=saveaddclass">
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
		$row = $db->getrow("select * from ".tname('singer')." where in_id=".$in_id);
		$db->query("update ".tname('user')." set in_points=in_points+".IN_SINGERINPOINTS.",in_rank=in_rank+".IN_SINGERINRANK." where in_userid=".$row['in_uid']);
		$setarrs = array(
			'in_uid' => 0,
			'in_uname' => 'ϵͳ�û�',
			'in_uids' => $row['in_uid'],
			'in_unames' => $row['in_uname'],
			'in_content' => '��ϲ���������ĸ��֡�'.$row['in_name'].'����ͨ����ˣ�[���+'.IN_SINGERINPOINTS.'][����+'.IN_SINGERINRANK.']',
			'in_isread' => 0,
			'in_addtime' => date('Y-m-d H:i:s')
		);
		inserttable('message', $setarrs, 1);
		$sql="update ".tname('singer')." set in_passed=0 where in_id=".$row['in_id'];
		if($db->query($sql)){
			ShowMessage("��ϲ����������˳ɹ���",$_SERVER['HTTP_REFERER'],"infotitle2",1000,1);
		}
	}

	//����ɾ��
	function AllDel(){
		global $db;
		if(!submitcheck('form')){ShowMessage("����֤�������޷��ύ��",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
		$in_id=RequestBox("in_id");
		if($in_id==0){
			ShowMessage("����ɾ��ʧ�ܣ����ȹ�ѡҪɾ���ĸ��֣�",$_SERVER['HTTP_REFERER'],"infotitle3",3000,1);
		}else{
			$query = $db->query("select * from ".tname('singer')." where in_id in ($in_id)");
			while ($row = $db->fetch_array($query)) {
				SafeDel('singer', 'in_cover', $row['in_id']);
				$db->query("delete from ".tname('comment')." where in_table='singer' and in_tid=".$row['in_id']);
				$db->query("delete from ".tname('feed')." where in_icon='singer' and in_tid=".$row['in_id']);
				$content='��Ǹ���������ĸ��֡�'.$row['in_name'].'��δͨ����˲���ɾ����';
				if($row['in_passed']==0){
		                        $db->query("update ".tname('user')." set in_points=in_points-".IN_SINGEROUTPOINTS.",in_rank=in_rank-".IN_SINGEROUTRANK." where in_userid=".$row['in_uid']);
		                        $content='��Ǹ���������ĸ��֡�'.$row['in_name'].'����ɾ����[���-'.IN_SINGEROUTPOINTS.'][����-'.IN_SINGEROUTRANK.']';
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
			$sql="delete from ".tname('singer')." where in_id in ($in_id)";
			if($db->query($sql)){
				ShowMessage("��ϲ������������ɾ���ɹ���",$_SERVER['HTTP_REFERER'],"infotitle2",3000,1);
			}
		}
	}

	//�༭
	function Edit(){
		global $db;
		$in_id=intval(SafeRequest("in_id","get"));
		$sql="select * from ".tname('singer')." where in_id=".$in_id;
		if($row=$db->getrow($sql)){
			$Arr=array($row['in_name'],$row['in_nick'],$row['in_classid'],$row['in_uname'],$row['in_cover'],$row['in_intro'],$row['in_addtime']);
		}
		EditBoard($Arr,"?iframe=singer&action=saveedit&in_id=".$in_id,"�༭");
	}

	//�������
	function Add(){
		$Arr=array("","","","","","","");
		EditBoard($Arr,"?iframe=singer&action=saveadd","����");
	}

	//�����������
	function SaveAdd(){
		global $db;
		if(!submitcheck('form2')){ShowMessage("����֤�������޷��ύ��",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
		$in_name = SafeRequest("in_name","post");
		$in_nick = SafeRequest("in_nick","post");
		$in_classid = SafeRequest("in_classid","post");
		$in_uname = SafeRequest("in_uname","post");
		$in_cover = checkrename(SafeRequest("in_cover","post"), 'attachment/singer/cover');
		$in_intro = SafeRequest("in_intro","post");
		$result=$db->query("select * from ".tname('user')." where in_username='".$in_uname."'");
		if($row=$db->fetch_array($result)){
			$db->query("Insert ".tname('singer')." (in_name,in_nick,in_classid,in_uid,in_uname,in_cover,in_intro,in_hits,in_passed,in_addtime) values ('".$in_name."','".$in_nick."',".$in_classid.",".$row['in_userid'].",'".$row['in_username']."','".$in_cover."','".$in_intro."',0,0,'".date('Y-m-d H:i:s')."')");
			$db->query("update ".tname('user')." set in_points=in_points+".IN_SINGERINPOINTS.",in_rank=in_rank+".IN_SINGERINRANK." where in_userid=".$row['in_userid']);
			ShowMessage("��ϲ�������������ɹ���","?iframe=singer","infotitle2",1000,1);
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
		$in_nick = SafeRequest("in_nick","post");
		$in_classid = SafeRequest("in_classid","post");
		$in_uname = SafeRequest("in_uname","post");
		$in_cover = checkrename(SafeRequest("in_cover","post"), 'attachment/singer/cover', getfield('singer', 'in_cover', 'in_id', $in_id), 'edit', 'singer', 'in_cover', $in_id);
		$in_intro = SafeRequest("in_intro","post");
		$datetime = SafeRequest("in_edittime","post")==1 ? date('Y-m-d H:i:s') : SafeRequest("in_addtime","post");
		$old=$db->getrow("select * from ".tname('singer')." where in_id=".$in_id);
		$result=$db->query("select * from ".tname('user')." where in_username='".$in_uname."'");
		if($row=$db->fetch_array($result)){
			if($old['in_passed']==0 && $old['in_uid']!==$row['in_userid']){
			        $db->query("update ".tname('user')." set in_points=in_points+".IN_SINGERINPOINTS.",in_rank=in_rank+".IN_SINGERINRANK." where in_userid=".$row['in_userid']);
			        $db->query("update ".tname('user')." set in_points=in_points-".IN_SINGEROUTPOINTS.",in_rank=in_rank-".IN_SINGEROUTRANK." where in_userid=".$old['in_uid']);
			}
			$db->query("update ".tname('singer')." set in_name='".$in_name."',in_nick='".$in_nick."',in_classid=".$in_classid.",in_uid=".$row['in_userid'].",in_uname='".$row['in_username']."',in_cover='".$in_cover."',in_intro='".$in_intro."',in_addtime='".$datetime."' where in_id=".$in_id);
			ShowMessage("��ϲ�������ֱ༭�ɹ���",$_SERVER['HTTP_REFERER'],"infotitle2",1000,1);
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
		$sql="Insert ".tname('singer_class')." (in_name,in_hide,in_order) values ('".$in_name."',0,".$in_order.")";
		if($db->query($sql)){
			ShowMessage("��ϲ����������Ŀ�����ɹ���","?iframe=singer&action=class","infotitle2",1000,1);
		}
	}

	//�༭��Ŀ
	function EditSaveClass(){
		global $db;
		if(!submitcheck('form')){ShowMessage("����֤�������޷��ύ��",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
		$in_id=RequestBox("in_id");
		if($in_id==0){
			ShowMessage("�޸�ʧ�ܣ����ȹ�ѡҪ�༭����Ŀ��","?iframe=singer&action=class","infotitle3",3000,1);
		}else{
			$ID=explode(",",$in_id);
			for($i=0;$i<count($ID);$i++){
				$in_name=SafeRequest("in_name".$ID[$i],"post");
				$in_order=SafeRequest("in_order".$ID[$i],"post");
				if(!IsNul($in_name)){ShowMessage("�޸ĳ�����Ŀ���Ʋ���Ϊ�գ�","?iframe=singer&action=class","infotitle3",1000,1);}
				if(!IsNum($in_order)){ShowMessage("�޸ĳ���������Ϊ�գ�","?iframe=singer&action=class","infotitle3",1000,1);}
				$sql="update ".tname('singer_class')." set in_name='".$in_name."',in_order=".intval($in_order)." where in_id=".intval($ID[$i]);
				$db->query($sql);
			}
			ShowMessage("��ϲ����������Ŀ�޸ĳɹ���","?iframe=singer&action=class","infotitle2",3000,1);
		}
	}

	//��Ŀ״̬
	function EditHideClass(){
		global $db;
		$in_id=intval(SafeRequest("in_id","get"));
		$in_hide=intval(SafeRequest("in_hide","get"));
		$sql="update ".tname('singer_class')." set in_hide=".$in_hide." where in_id=".$in_id;
		if($db->query($sql)){
			ShowMessage("��ϲ����״̬�л��ɹ���","?iframe=singer&action=class","infotitle2",1000,1);
		}
	}

	//ɾ����Ŀ
	function DelClass(){
		global $db;
		$in_id=intval(SafeRequest("in_id","get"));
		$sql="delete from ".tname('singer_class')." where in_id=".$in_id;
		if($db->query($sql)){
			ShowMessage("��ϲ����������Ŀɾ���ɹ���","?iframe=singer&action=class","infotitle2",3000,1);
		}
	}
?>