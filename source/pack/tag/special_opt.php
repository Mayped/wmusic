<?php
include '../../system/db.class.php';
$action=SafeRequest("action","get");
$so=SafeRequest("so","get");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>ר��ѡ��</title>
<link href="../../../static/admincp/css/main.css" rel="stylesheet" type="text/css" />
<link href="../../../static/pack/asynctips/asynctips.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../../static/pack/asynctips/jquery.min.js"></script>
<script type="text/javascript" src="../../../static/pack/asynctips/asyncbox.v1.4.5.js"></script>
<script type="text/javascript">
function ReturnValue(reimg){
        this.parent.document.<?php echo $so; ?>.value=reimg;
        this.parent.asyncbox.tips("��ϲ��ר��ѡ��ɹ���", "success", 1000);
        this.parent.layer.closeAll();
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
</script>
</head>
<body>
<?php
switch($action){
	case 'keyword':
		$key=SafeRequest("key","get");
		main("select * from ".tname('special')." where in_name like '%".$key."%' or in_uname like '%".$key."%' order by in_addtime desc",20);
		break;
	default:
		main("select * from ".tname('special')." order by in_addtime desc",20);
		break;
	}
?>
</body>
</html>
<?php
function main($sql,$size){
	global $db,$so;
	$Arr=getpagerow($sql,$size);
	$result=$db->query($Arr[2]);
	$count=$db->num_rows($result);
?>
<div class="container">
<table class="tb tb2">
<form name="btnsearch" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<tr><td>
<input type="hidden" name="action" value="keyword">
<input type="hidden" name="so" value="<?php echo $so; ?>">
�ؼ��ʣ�<input class="txt" x-webkit-speech type="text" name="key" id="search" value="" />
<input type="button" value="����" class="btn" onclick="s()" />
</td></tr>
</form>
</table>
<table class="tb tb2">
<tr class="header">
<th>ר������</th>
<th>������Ա</th>
<th>����ʱ��</th>
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
<tr class="hover">
<td><a href="javascript:ReturnValue(<?php echo $row['in_id']; ?>);" class="act"><?php echo ReplaceStr($row['in_name'],SafeRequest("key","get"),"<em class=\"lightnum\">".SafeRequest("key","get")."</em>"); ?></a></td>
<td><?php echo ReplaceStr($row['in_uname'],SafeRequest("key","get"),"<em class=\"lightnum\">".SafeRequest("key","get")."</em>"); ?></td>
<td><?php echo $row['in_addtime']; ?></td>
</tr>
<?php
}
}
?>
</table>
<table class="tb tb2">
<?php echo $Arr[0]; ?>
</table>
</div>
<?php } ?>