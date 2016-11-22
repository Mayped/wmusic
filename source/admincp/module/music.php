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
	case 'list':
		$in_classid=intval(SafeRequest("in_classid","get"));
		main("select * from ".tname('music')." where in_classid=".$in_classid." order by in_addtime desc",20);
		break;
	case 'special':
		$in_specialid=intval(SafeRequest("in_specialid","get"));
		main("select * from ".tname('music')." where in_specialid=".$in_specialid." order by in_addtime desc",20);
		break;
	case 'singer':
		$in_singerid=intval(SafeRequest("in_singerid","get"));
		main("select * from ".tname('music')." where in_singerid=".$in_singerid." order by in_addtime desc",20);
		break;
	case 'keyword':
		$key=SafeRequest("key","get");
		main("select * from ".tname('music')." where in_name like '%".$key."%' or in_uname like '%".$key."%' order by in_addtime desc",20);
		break;
	case 'pass':
		main("select * from ".tname('music')." where in_passed=1 order by in_addtime desc",20);
		break;
	case 'wrong':
		main("select * from ".tname('music')." where in_wrong=1 order by in_addtime desc",20);
		break;
	default:
		main("select * from ".tname('music')." order by in_addtime desc",20);
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
	$in_specialid = $Arr[2];
	$in_singerid = $Arr[3];
	$in_uname = !IsNul($Arr[4]) && $one ? $_COOKIE['in_adminname'] : $Arr[4];
	$in_audio = $Arr[5];
	$in_lyric = $Arr[6];
	$in_text = $Arr[7];
	$in_cover = $Arr[8];
	$in_tag = $Arr[9];
	$in_color = $Arr[10];
	$in_points = !IsNum($Arr[11]) ? 0 : $Arr[11];
	$in_grade = $Arr[12];
	$in_best = $Arr[13];
	if(IN_UPOPEN == 1){
        	$script = 'source/pack/upload/save.php';
	}elseif(IN_REMOTE == 1){
        	$script = 'source/plugin/'.IN_REMOTEPK.'/save.php';
        	if(!is_file($script)){
                	$script = 'source/pack/upload/save.php';
        	}
	}else{
        	$script = 'source/pack/ftp/save.php';
	}
?>
<script type="text/javascript" src="static/pack/layer/confirm-html.js"></script>
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
	},
	record: function() {
		$.flayer({
			type: 1,
			title: '¼����Ƶ',
			area: ['auto', 'auto'],
			page: {html: '<object id="as_js" type="application/x-shockwave-flash" width="811" height="140"><param name="movie" value="static/pack/upload/record.swf" /><param name="wmode" value="transparent" /></object>'}
		});
	}
}
function f_getURL() {
	return '<?php echo $script; ?>';
}
function f_getMAX() {
	return 3600;
}
function f_getMIN() {
	return 10;
}
function f_complete(filename) {
	if (filename == 'error'){
		asyncbox.tips("������������ԣ�", "error", 3000);
	}else{
		document.form2.in_audio.value = filename;
		asyncbox.tips("��ϲ���ļ�¼�Ƴɹ���", "success", 1000);
	}
	flayer.closeAll();
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
        else if(document.form2.in_audio.value==""){
            asyncbox.tips("��Ƶ��ַ����Ϊ�գ�����д��", "wait", 1000);
            document.form2.in_audio.focus();
            return false;
        }
        else if(document.form2.in_points.value==""){
            asyncbox.tips("���ؿ۵㲻��Ϊ�գ�����д��", "wait", 1000);
            document.form2.in_points.focus();
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
<li><a href="?iframe=music"><span>��������</span></a></li>
<?php if($action=="add"){echo "<li class=\"current\">";}else{echo "<li>";} ?><a href="?iframe=music&action=add"><span>��������</span></a></li>
<li><a href="?iframe=music&action=pass"><span>��������</span></a></li>
<li><a href="?iframe=music&action=wrong"><span>��������</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<form action="<?php echo $url; ?>" method="post" name="form2">
<table class="tb tb2">
<tr>
<td class="td29 lightnum">�������ƣ�<input type="text" class="txt" value="<?php echo $in_name; ?>" name="in_name" id="in_name">
<select name="in_color">
<option value="">��ɫ</option>
<option style="background-color:#88b3e6;color:#88b3e6" value="#88b3e6"<?php if($in_color=="#88b3e6"){echo " selected";} ?>>����</option>
<option style="background-color:#0C87CD;color:#0C87CD" value="#0C87CD"<?php if($in_color=="#0C87CD"){echo " selected";} ?>>����</option>
<option style="background-color:#FF6969;color:#FF6969" value="#FF6969"<?php if($in_color=="#FF6969"){echo " selected";} ?>>�ۺ�</option>
<option style="background-color:#F34F34;color:#F34F34" value="#F34F34"<?php if($in_color=="#F34F34"){echo " selected";} ?>>���</option>
<option style="background-color:#93C366;color:#93C366" value="#93C366"<?php if($in_color=="#93C366"){echo " selected";} ?>>����</option>
<option style="background-color:#FA7A19;color:#FA7A19" value="#FA7A19"<?php if($in_color=="#FA7A19"){echo " selected";} ?>>��ɫ</option>
</select></td>
<td class="lightnum">������Ŀ��<select name="in_classid" id="in_classid">
<option value="0">ѡ����Ŀ</option>
<?php
$sql="select * from ".tname('class')." order by in_id asc";
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
<td>����ר����<select name="in_specialid" id="in_specialid">
<option value="0">��ѡ��</option>
<?php
$res=$db->query("select * from ".tname('special')." order by in_addtime desc");
if($res){
        while ($row = $db->fetch_array($res)){
                if($in_specialid==$row['in_id']){
                        echo "<option value=\"".$row['in_id']."\" selected=\"selected\">".getlenth($row['in_name'], 10)."</option>";
                }else{
                        echo "<option value=\"".$row['in_id']."\">".getlenth($row['in_name'], 10)."</option>";
                }
        }
}
?>
</select>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="pop.up('yes', 'ѡ��ר��', 'source/pack/tag/special_opt.php?so=form2.in_specialid', '500px', '400px', '65px');" class="addtr">ѡ��</a></td>
<td>������Ա��<input type="text" class="txt" value="<?php echo $in_uname; ?>" name="in_uname" id="in_uname"></td>
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
<td>�Ƽ��Ǽ���<select name="in_best" id="in_best">
<option value="0">���Ƽ�</option>
<option value="1"<?php if($in_best==1){echo " selected";} ?>>һ��</option>
<option value="2"<?php if($in_best==2){echo " selected";} ?>>����</option>
<option value="3"<?php if($in_best==3){echo " selected";} ?>>����</option>
<option value="4"<?php if($in_best==4){echo " selected";} ?>>����</option>
<option value="5"<?php if($in_best==5){echo " selected";} ?>>����</option>
</select></td>
</tr>

<tr>
<td>����Ȩ�ޣ�<select name="in_grade" id="in_grade">
<option value="3">�ο�����</option>
<option value="2"<?php if($in_grade==2){echo " selected";} ?>>��ͨ�û�</option>
<option value="1"<?php if($in_grade==1){echo " selected";} ?>>��Ա</option>
</select></td>
<td>���ؿ۵㣺<input type="text" class="txt" value="<?php echo $in_points; ?>" name="in_points" id="in_points" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td>
</tr>

<tr>
<td class="td29">���ֱ�ǩ��<input type="text" class="txt" value="<?php echo $in_tag; ?>" name="in_tag" id="in_tag"><a href="javascript:void(0)" onclick="pop.up('yes', '��ӱ�ǩ', 'source/pack/tag/open.php?form=form2.in_tag', '540px', '400px', '65px');" class="addtr">���</a></td>
</tr>

<tr>
<td class="longtxt lightnum">��Ƶ��ַ��<input type="text" class="txt" value="<?php echo $in_audio; ?>" name="in_audio" id="in_audio"></td><td><div class="rssbutton"><input type="button" value="�ϴ���Ƶ" onclick="pop.up('no', '�ϴ���Ƶ', 'source/pack/upload/open.php?type=music_audio&form=form2.in_audio', '406px', '180px', '175px');" /></div>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="pop.record();" class="addtr">¼����Ƶ</a></td>
</tr>

<tr>
<td class="longtxt">�����ַ��<input type="text" class="txt" value="<?php echo $in_cover; ?>" name="in_cover" id="in_cover"></td><td><div class="rssbutton"><input type="button" value="�ϴ�����" onclick="pop.up('no', '�ϴ�����', 'source/pack/upload/open.php?type=music_cover&form=form2.in_cover', '406px', '180px', '175px');" /></div></td>
</tr>

<tr>
<td class="longtxt">��ʵ�ַ��<input type="text" class="txt" value="<?php echo $in_lyric; ?>" name="in_lyric" id="in_lyric"></td><td><div class="rssbutton"><input type="button" value="�ϴ����" onclick="pop.up('no', '�ϴ����', 'source/pack/upload/open.php?type=music_lyric&form=form2.in_lyric', '406px', '180px', '175px');" /></div></td>
</tr>
</table>

<table class="tb tb2">
<tr><td><div style="height:100px;line-height:100px;float:left;">�ı���ʣ�</div><textarea rows="6" cols="50" id="in_text" name="in_text" style="width:400px;height:100px;"><?php echo $in_text; ?></textarea></td></tr>
<tr><td><input type="submit" class="btn" name="form2" value="�ύ" onclick="return CheckForm();" /><?php if($_GET['action']=="edit"){ ?><input type="hidden" name="in_addtime" value="<?php echo $Arr[14]; ?>"><input class="checkbox" type="checkbox" name="in_edittime" id="in_edittime" value="1" checked /><label for="in_edittime">����ʱ��</label><?php } ?></td></tr>
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
<script type="text/javascript" src="static/admincp/js/ajax.js"></script>
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
		layer.tips('ɾ�����ֲ����棬�����������', '#chkall', {
			tips: 3
		});
        }
}
</script>
<div class="container">
<?php if(empty($action)){echo "<script type=\"text/javascript\">parent.document.title = 'Ear Music Board �������� - ������� - ��������';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='�������&nbsp;&raquo;&nbsp;��������';</script>";} ?>
<?php if($action=="pass"){echo "<script type=\"text/javascript\">parent.document.title = 'Ear Music Board �������� - ������� - ��������';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='�������&nbsp;&raquo;&nbsp;��������';</script>";} ?>
<?php if($action=="wrong"){echo "<script type=\"text/javascript\">parent.document.title = 'Ear Music Board �������� - ������� - ��������';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='�������&nbsp;&raquo;&nbsp;��������';</script>";} ?>
<?php if($action=="keyword"){echo "<script type=\"text/javascript\">parent.document.title = 'Ear Music Board �������� - ������� - ��������';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='�������&nbsp;&raquo;&nbsp;��������';</script>";} ?>
<?php if($action=="list"){echo "<script type=\"text/javascript\">parent.document.title = 'Ear Music Board �������� - ������� - ��Ŀ����';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='�������&nbsp;&raquo;&nbsp;��Ŀ����';</script>";} ?>
<?php if($action=="special"){echo "<script type=\"text/javascript\">parent.document.title = 'Ear Music Board �������� - ������� - ר������';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='�������&nbsp;&raquo;&nbsp;ר������';</script>";} ?>
<?php if($action=="singer"){echo "<script type=\"text/javascript\">parent.document.title = 'Ear Music Board �������� - ������� - ��������';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='�������&nbsp;&raquo;&nbsp;��������';</script>";} ?>
<div class="floattop"><div class="itemtitle"><h3><?php if(empty($action)){echo "��������";}else if($action=="pass"){echo "��������";}else if($action=="wrong"){echo "��������";}else if($action=="keyword"){echo "��������";}else if($action=="list"){echo "��Ŀ����";}else if($action=="special"){echo "ר������";}else if($action=="singer"){echo "��������";} ?></h3><ul class="tab1">
<?php if(empty($action)){echo "<li class=\"current\">";}else{echo "<li>";} ?><a href="?iframe=music"><span>��������</span></a></li>
<li><a href="?iframe=music&action=add"><span>��������</span></a></li>
<?php if($action=="pass"){echo "<li class=\"current\">";}else{echo "<li>";} ?><a href="?iframe=music&action=pass"><span>��������</span></a></li>
<?php if($action=="wrong"){echo "<li class=\"current\">";}else{echo "<li>";} ?><a href="?iframe=music&action=wrong"><span>��������</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th class="partition">������ʾ</th></tr>
<tr><td class="tipsblock"><ul>
<?php
if(empty($action)){
echo "<li>���������е�����</li>";
}elseif($action=="pass"){
echo "<li>��������Ҫ��˵����֣�������ǰ̨��ʾ</li>";
}elseif($action=="wrong"){
echo "<li>�����Ǳ���������֣����±༭����������״̬</li>";
}elseif($action=="keyword"){
echo "<li>������������".SafeRequest("key","get")."��������</li>";
}elseif($action=="list"){
echo "<li>�����ǰ���Ŀ�鿴������</li>";
}elseif($action=="special"){
echo "<li>�����ǰ�ר���鿴������</li>";
}elseif($action=="singer"){
echo "<li>�����ǰ����ֲ鿴������</li>";
}
?>
<li>���������������ơ�������Ա�ȹؼ��ʽ�������</li>
</ul></td></tr>
</table>
<table class="tb tb2">
<form name="btnsearch" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<tr><td>
<input type="hidden" name="iframe" value="music">
<input type="hidden" name="action" value="keyword">
�ؼ��ʣ�<input class="txt" x-webkit-speech type="text" name="key" id="search" value="" />
<select onchange="location.href=this.options[this.selectedIndex].value;">
<option value="?iframe=music">������Ŀ</option>
<?php
$res=$db->query("select * from ".tname('class')." order by in_id asc");
if($res){
        while ($row = $db->fetch_array($res)){
                if(SafeRequest("in_classid","get")==$row['in_id']){
                        echo "<option value=\"?iframe=music&action=list&in_classid=".$row['in_id']."\" selected=\"selected\">".$row['in_name']."</option>";
                }else{
                        echo "<option value=\"?iframe=music&action=list&in_classid=".$row['in_id']."\">".$row['in_name']."</option>";
                }
        }
}
?>
</select>
<select onchange="location.href=this.options[this.selectedIndex].value;">
<option value="?iframe=music">����ר��</option>
<?php
$res=$db->query("select * from ".tname('special')." order by in_addtime desc");
if($res){
        while ($row = $db->fetch_array($res)){
                if(SafeRequest("in_specialid","get")==$row['in_id']){
                        echo "<option value=\"?iframe=music&action=special&in_specialid=".$row['in_id']."\" selected=\"selected\">".getlenth($row['in_name'], 10)."</option>";
                }else{
                        echo "<option value=\"?iframe=music&action=special&in_specialid=".$row['in_id']."\">".getlenth($row['in_name'], 10)."</option>";
                }
        }
}
?>
</select>
<select onchange="location.href=this.options[this.selectedIndex].value;">
<option value="?iframe=music">���޸���</option>
<?php
$res=$db->query("select * from ".tname('singer')." order by in_addtime desc");
if($res){
        while ($row = $db->fetch_array($res)){
                if(SafeRequest("in_singerid","get")==$row['in_id']){
                        echo "<option value=\"?iframe=music&action=singer&in_singerid=".$row['in_id']."\" selected=\"selected\">".getlenth($row['in_name'], 10)."</option>";
                }else{
                        echo "<option value=\"?iframe=music&action=singer&in_singerid=".$row['in_id']."\">".getlenth($row['in_name'], 10)."</option>";
                }
        }
}
?>
</select>
<input type="button" value="����" class="btn" onclick="s()" />
</td></tr>
</form>
</table>
<form name="form" method="post" action="?iframe=music&action=alldel">
<table class="tb tb2">
<tr class="header">
<th>���</th>
<th>��������</th>
<th>������Ա</th>
<th>�Ƽ��Ǽ�</th>
<th>���</th>
<th>����ʱ��</th>
<th>�༭����</th>
</tr>
<?php
if($count==0){
?>
<tr><td colspan="2" class="td27">û������</td></tr>
<?php
}
if($result){
while ($row = $db->fetch_array($result)){
?>
<tr class="hover">
<td class="td25"><input class="checkbox" type="checkbox" name="in_id[]" id="in_id" value="<?php echo $row['in_id']; ?>"><?php echo $row['in_id']; ?></td>
<td><a href="<?php echo getlink($row['in_id'], 'music'); ?>" target="_blank" class="act"><?php echo ReplaceStr($row['in_name'],SafeRequest("key","get"),"<em class=\"lightnum\">".SafeRequest("key","get")."</em>"); ?></a></td>
<td><a href="<?php echo getlink($row['in_uid']); ?>" target="_blank" class="act"><?php echo ReplaceStr($row['in_uname'],SafeRequest("key","get"),"<em class=\"lightnum\">".SafeRequest("key","get")."</em>"); ?></a></td>
<td id="in_best<?php echo $row['in_id']; ?>"><script type="text/javascript">ShowStar(<?php echo $row['in_best']; ?>, <?php echo $row['in_id']; ?>);</script></td>
<td><?php if($row['in_passed']==1){ ?><a href="?iframe=music&action=editpassed&in_id=<?php echo $row['in_id']; ?>"><img src="static/admincp/css/pass_no.gif" /></a><?php }else{ ?><img src="static/admincp/css/pass_yes.gif" /><?php } ?></td>
<td><?php if(date('Y-m-d',strtotime($row['in_addtime']))==date('Y-m-d')){echo "<em class=\"lightnum\">".date('Y-m-d',strtotime($row['in_addtime']))."</em>";}else{echo date('Y-m-d',strtotime($row['in_addtime']));} ?></td>
<td><a href="?iframe=music&action=edit&in_id=<?php echo $row['in_id']; ?>" class="act">�༭</a></td>
</tr>
<?php
}
}
?>
</table>
<table class="tb tb2">
<tr><td><input type="checkbox" id="chkall" class="checkbox" onclick="CheckAll(this.form);" /><label for="chkall">ȫѡ</label> &nbsp;&nbsp; <input type="submit" name="form" class="btn" value="����ɾ��" /></td></tr>
<?php echo $Arr[0]; ?>
</table>
</form>
</div>



<?php
}
	//���
	function EditPassed(){
		global $db;
		$in_id = intval(SafeRequest("in_id","get"));
		$row = $db->getrow("select * from ".tname('music')." where in_id=".$in_id);
		$db->query("update ".tname('user')." set in_points=in_points+".IN_MUSICINPOINTS.",in_rank=in_rank+".IN_MUSICINRANK." where in_userid=".$row['in_uid']);
		$setarrs = array(
			'in_uid' => 0,
			'in_uname' => 'ϵͳ�û�',
			'in_uids' => $row['in_uid'],
			'in_unames' => $row['in_uname'],
			'in_content' => '��ϲ������������֡�'.$row['in_name'].'����ͨ����ˣ�[���+'.IN_MUSICINPOINTS.'][����+'.IN_MUSICINRANK.']',
			'in_isread' => 0,
			'in_addtime' => date('Y-m-d H:i:s')
		);
		inserttable('message', $setarrs, 1);
		$sql="update ".tname('music')." set in_passed=0 where in_id=".$row['in_id'];
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
			ShowMessage("����ɾ��ʧ�ܣ����ȹ�ѡҪɾ�������֣�",$_SERVER['HTTP_REFERER'],"infotitle3",3000,1);
		}else{
			$query = $db->query("select * from ".tname('music')." where in_id in ($in_id)");
			while ($row = $db->fetch_array($query)) {
				SafeDel('music', 'in_audio', $row['in_id']);
				SafeDel('music', 'in_lyric', $row['in_id']);
				SafeDel('music', 'in_cover', $row['in_id']);
				$db->query("delete from ".tname('favorites')." where in_mid=".$row['in_id']);
				$db->query("delete from ".tname('listen')." where in_mid=".$row['in_id']);
				$db->query("delete from ".tname('comment')." where in_table='music' and in_tid=".$row['in_id']);
				$db->query("delete from ".tname('feed')." where in_icon='music' and in_tid=".$row['in_id']);
				$content='��Ǹ������������֡�'.$row['in_name'].'��δͨ����˲���ɾ����';
				if($row['in_passed']==0){
		                        $db->query("update ".tname('user')." set in_points=in_points-".IN_MUSICOUTPOINTS.",in_rank=in_rank-".IN_MUSICOUTRANK." where in_userid=".$row['in_uid']);
		                        $content='��Ǹ������������֡�'.$row['in_name'].'����ɾ����[���-'.IN_MUSICOUTPOINTS.'][����-'.IN_MUSICOUTRANK.']';
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
			$sql="delete from ".tname('music')." where in_id in ($in_id)";
			if($db->query($sql)){
				ShowMessage("��ϲ������������ɾ���ɹ���",$_SERVER['HTTP_REFERER'],"infotitle2",3000,1);
			}
		}
	}

	//�༭
	function Edit(){
		global $db;
		$in_id=intval(SafeRequest("in_id","get"));
		$sql="select * from ".tname('music')." where in_id=".$in_id;
		if($row=$db->getrow($sql)){
			$Arr=array($row['in_name'],$row['in_classid'],$row['in_specialid'],$row['in_singerid'],$row['in_uname'],$row['in_audio'],$row['in_lyric'],$row['in_text'],$row['in_cover'],$row['in_tag'],$row['in_color'],$row['in_points'],$row['in_grade'],$row['in_best'],$row['in_addtime']);
		}
		EditBoard($Arr,"?iframe=music&action=saveedit&in_id=".$in_id,"�༭");
	}

	//�������
	function Add(){
		$Arr=array("","","","","","","","","","","","","","","");
		EditBoard($Arr,"?iframe=music&action=saveadd","����");
	}

	//�����������
	function SaveAdd(){
		global $db;
		if(!submitcheck('form2')){ShowMessage("����֤�������޷��ύ��",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
		$in_name = SafeRequest("in_name","post");
		$in_classid = SafeRequest("in_classid","post");
		$in_specialid = SafeRequest("in_specialid","post");
		$in_singerid = SafeRequest("in_singerid","post");
		$in_uname = SafeRequest("in_uname","post");
		$in_audio = checkrename(SafeRequest("in_audio","post"), 'attachment/music/audio');
		$in_lyric = checkrename(SafeRequest("in_lyric","post"), 'attachment/music/lyric');
		$in_text = SafeRequest("in_text","post");
		$in_cover = checkrename(SafeRequest("in_cover","post"), 'attachment/music/cover');
		$in_tag = SafeRequest("in_tag","post");
		$in_color = SafeRequest("in_color","post");
		$in_points = SafeRequest("in_points","post");
		$in_grade = SafeRequest("in_grade","post");
		$in_best = SafeRequest("in_best","post");
		$result=$db->query("select * from ".tname('user')." where in_username='".$in_uname."'");
		if($row=$db->fetch_array($result)){
			$db->query("Insert ".tname('music')." (in_name,in_classid,in_specialid,in_singerid,in_uid,in_uname,in_audio,in_lyric,in_text,in_cover,in_tag,in_color,in_hits,in_downhits,in_favhits,in_goodhits,in_badhits,in_points,in_grade,in_best,in_passed,in_wrong,in_addtime) values ('".$in_name."',".$in_classid.",".$in_specialid.",".$in_singerid.",".$row['in_userid'].",'".$row['in_username']."','".$in_audio."','".$in_lyric."','".$in_text."','".$in_cover."','".$in_tag."','".$in_color."',0,0,0,0,0,".$in_points.",".$in_grade.",".$in_best.",0,0,'".date('Y-m-d H:i:s')."')");
			$db->query("update ".tname('user')." set in_points=in_points+".IN_MUSICINPOINTS.",in_rank=in_rank+".IN_MUSICINRANK." where in_userid=".$row['in_userid']);
			ShowMessage("��ϲ�������������ɹ���","?iframe=music","infotitle2",1000,1);
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
		$in_specialid = SafeRequest("in_specialid","post");
		$in_singerid = SafeRequest("in_singerid","post");
		$in_uname = SafeRequest("in_uname","post");
		$in_audio = checkrename(SafeRequest("in_audio","post"), 'attachment/music/audio', getfield('music', 'in_audio', 'in_id', $in_id), 'edit', 'music', 'in_audio', $in_id);
		$in_lyric = checkrename(SafeRequest("in_lyric","post"), 'attachment/music/lyric', getfield('music', 'in_lyric', 'in_id', $in_id), 'edit', 'music', 'in_lyric', $in_id);
		$in_text = SafeRequest("in_text","post");
		$in_cover = checkrename(SafeRequest("in_cover","post"), 'attachment/music/cover', getfield('music', 'in_cover', 'in_id', $in_id), 'edit', 'music', 'in_cover', $in_id);
		$in_tag = SafeRequest("in_tag","post");
		$in_color = SafeRequest("in_color","post");
		$in_points = SafeRequest("in_points","post");
		$in_grade = SafeRequest("in_grade","post");
		$in_best = SafeRequest("in_best","post");
		$datetime = SafeRequest("in_edittime","post")==1 ? date('Y-m-d H:i:s') : SafeRequest("in_addtime","post");
		$old=$db->getrow("select * from ".tname('music')." where in_id=".$in_id);
		$result=$db->query("select * from ".tname('user')." where in_username='".$in_uname."'");
		if($row=$db->fetch_array($result)){
			if($old['in_passed']==0 && $old['in_uid']!==$row['in_userid']){
			        $db->query("update ".tname('user')." set in_points=in_points+".IN_MUSICINPOINTS.",in_rank=in_rank+".IN_MUSICINRANK." where in_userid=".$row['in_userid']);
			        $db->query("update ".tname('user')." set in_points=in_points-".IN_MUSICOUTPOINTS.",in_rank=in_rank-".IN_MUSICOUTRANK." where in_userid=".$old['in_uid']);
			}
			$db->query("update ".tname('music')." set in_name='".$in_name."',in_classid=".$in_classid.",in_specialid=".$in_specialid.",in_singerid=".$in_singerid.",in_uid=".$row['in_userid'].",in_uname='".$row['in_username']."',in_audio='".$in_audio."',in_lyric='".$in_lyric."',in_text='".$in_text."',in_cover='".$in_cover."',in_tag='".$in_tag."',in_color='".$in_color."',in_points=".$in_points.",in_grade=".$in_grade.",in_best=".$in_best.",in_wrong=0,in_addtime='".$datetime."' where in_id=".$in_id);
			ShowMessage("��ϲ�������ֱ༭�ɹ���",$_SERVER['HTTP_REFERER'],"infotitle2",1000,1);
		}else{
			ShowMessage("�༭ʧ�ܣ�������Ա�����ڣ�","history.back(1);","infotitle3",3000,2);
		}
	}
?>