<?php
include '../../system/db.class.php';
global $db;
$array='';
$result=$db->query("select * from ".tname('tag')." where in_type=0 order by in_id asc");
$count=$db->num_rows($result);
if($count>0){
        $array='Array("������",';
        while($row=$db->fetch_array($result)){
                $array=$array.'"'.$row['in_title'].'",';
        }
        $array=str_replace(',]', '),', $array.']');
}
$result=$db->query("select * from ".tname('tag')." where in_type=1 order by in_id asc");
$count=$db->num_rows($result);
if($count>0){
        $array=$array.'Array("������",';
        while($row=$db->fetch_array($result)){
                $array=$array.'"'.$row['in_title'].'",';
        }
        $array=str_replace(',]', '),', $array.']');
}
$result=$db->query("select * from ".tname('tag')." where in_type=2 order by in_id asc");
$count=$db->num_rows($result);
if($count>0){
        $array=$array.'Array("������",';
        while($row=$db->fetch_array($result)){
                $array=$array.'"'.$row['in_title'].'",';
        }
        $array=str_replace(',]', '),', $array.']');
}
$result=$db->query("select * from ".tname('tag')." where in_type=3 order by in_id asc");
$count=$db->num_rows($result);
if($count>0){
        $array=$array.'Array("������",';
        while($row=$db->fetch_array($result)){
                $array=$array.'"'.$row['in_title'].'",';
        }
        $array=str_replace(',]', '),', $array.']');
}
$result=$db->query("select * from ".tname('tag')." where in_type=4 order by in_id asc");
$count=$db->num_rows($result);
if($count>0){
        $array=$array.'Array("������",';
        while($row=$db->fetch_array($result)){
                $array=$array.'"'.$row['in_title'].'",';
        }
        $array=str_replace(',]', '),', $array.']');
}
        $array=str_replace(',]', '', $array.']');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<title>��ǩ���</title>
<link href="../../../static/pack/tag/tag.css" rel="stylesheet" type="text/css" />
<link href="../../../static/pack/asynctips/asynctips.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../../static/pack/tag/jquery.js"></script>
<script type="text/javascript" src="../../../static/pack/tag/tag.js"></script>
<script type="text/javascript" src="../../../static/pack/asynctips/jquery.min.js"></script>
<script type="text/javascript" src="../../../static/pack/asynctips/asyncbox.v1.4.5.js"></script>
</head>
<body>
<script type="text/javascript">
var tagarray = Array(<?php echo $array; ?>);
var html = '<div class="popDiyTags-form form-box"><div class="popDiyTags-title"><div class="fl"><h4 class="selected-index">���Ѿ�ѡ���� <span class="red">0</span> ����ǩ<em>�����ѡ��5����</em></h4><ul class="selected-list selected-list01"></ul></div><a class="btn btnTure" href="javascript:void(0);"><span class="btn-wrap"><span class="btn-inner"><span class="btn-txt">��Ӳ�����</span></span></span></a></div>';
for (var i = 0; i < tagarray.length; i++) {
	html += '<dl class="popDiyTags-list clearfix">';
	html += '<dt>' + tagarray[i][0] + '</dt>';
	for (var j = 1; j < tagarray[i].length; j++) {
		html += '<dd><a href="#">' + tagarray[i][j] + '</a></dd>';
	}
	html += "</dl>";
}
html += '<div class="popDiyTags-title"><div class="fl"><h4 class="selected-index">���Ѿ�ѡ���� <span class="red">0</span> ����ǩ<em>�����ѡ��5����</em></h4><ul class="selected-list selected-list02"></ul></div><a class="btn btnTure" href="javascript:void(0);"><span class="btn-wrap"><span class="btn-inner"><span class="btn-txt">��Ӳ�����</span></span></span></a></div></div>';
document.writeln(html);
function ReturnValue(reimg){
        this.parent.document.<?php echo $_GET['form']; ?>.value=reimg;
        this.parent.asyncbox.tips("��ϲ����ǩ��ӳɹ���", "success", 1000);
        this.parent.layer.closeAll();
}
</script>
</body>
</html>