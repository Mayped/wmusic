<?php
if(!defined('IN_ROOT')){exit('Access denied');}
Administrator(8);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>����Ӧ��</title>
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
$action=SafeRequest("ac","get");
if($action=="uninst"){del_plugin($_GET['id'],$_GET['dir']);}elseif($action=="status"){cut_plugin($_GET['id'],$_GET['is']);}
?>
<div class="container">
<script type="text/javascript">parent.document.title = '�������ֻ��� �������� - ��ƽ̨';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='��ƽ̨';</script>
<div class="floattop"><div class="itemtitle"><h3>����Ӧ��</h3></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th class="partition">����б�</th></tr>
</table>
<table class="tb tb2">
<?php
global $db,$develop_auth;
$query = $db->query("select * from ".tname('plugin')." where in_type<3 order by in_addtime desc");
$count=$db->num_rows($query);
if($count==0){
        echo "<tr><td colspan=\"2\" class=\"td27\">���޲��</td></tr>";
}else{
        while ($row = $db->fetch_array($query)) {
                $in_isindex = NULL;
                if($row['in_type']==2 && $row['in_isindex']==1){
                        $in_isindex="<img src=\"static/admincp/css/show_yes.gif\" style=\"cursor:pointer\" onclick=\"location.href='?iframe=module&ac=status&id=".$row['in_id']."&is=0';\" title=\"ǰ̨����\" />&nbsp;&nbsp;";
                }elseif($row['in_type']==2 && $row['in_isindex']==0){
                        $in_isindex="<img src=\"static/admincp/css/show_no.gif\" style=\"cursor:pointer\" onclick=\"location.href='?iframe=module&ac=status&id=".$row['in_id']."&is=1';\" title=\"ǰ̨��ʾ\" />&nbsp;&nbsp;";
                }
                echo "<tr class=\"hover hover\">";
                echo "<td valign=\"top\" style=\"width:45px\"><img src=\"source/plugin/".$row['in_dir']."/preview.jpg\" onerror=\"this.src='static/admincp/css/preview.png'\" style=\"cursor:pointer\" onclick=\"location.href='plugin.php/".$row['in_dir']."/".$row['in_file']."/';\" width=\"40\" height=\"40\" align=\"left\" /></td>";
                echo "<td class=\"light\" valign=\"top\" style=\"width:200px\">".$row['in_name']."<br /><span class=\"sml\">".$row['in_dir']."</span><br /></td>";
                echo "<td valign=\"bottom\"><span class=\"light\">����: ".$row['in_author']."</span><div class=\"psetting\"><a href=\"".$row['in_address']."\" target=\"_blank\">�鿴</a></div></td>";
                echo "<td align=\"right\" valign=\"bottom\" style=\"width:160px\">".(date("Y-m-d",strtotime($row['in_addtime']))==date('Y-m-d') ? '<em class="lightnum">'.date("Y-m-d",strtotime($row['in_addtime'])).'</em>' : date("Y-m-d",strtotime($row['in_addtime'])))."<br /><br />".$in_isindex."<a style=\"cursor:pointer\" onclick=\"del_msg('?iframe=module&ac=uninst&id=".$row['in_id']."&dir=".$row['in_dir']."');\">ж��</a>&nbsp;&nbsp;</td>";
                echo "</tr>";
        }
}
?>
</table>
<table class="tb tb2">
<tr><th class="partition">��չ�б�</th></tr>
</table>
<table class="tb tb2">
<?php
$query = $db->query("select * from ".tname('plugin')." where in_type>2 order by in_addtime desc");
$count=$db->num_rows($query);
if($count==0){
        echo "<tr><td colspan=\"2\" class=\"td27\">������չ</td></tr>";
}else{
        while ($row = $db->fetch_array($query)) {
                echo "<tr class=\"hover hover\">";
                echo "<td valign=\"top\" style=\"width:45px\"><img src=\"source/plugin/".$row['in_dir']."/preview.jpg\" onerror=\"this.src='static/admincp/css/preview.png'\" width=\"40\" height=\"40\" align=\"left\" /></td>";
                echo "<td class=\"light\" valign=\"top\" style=\"width:200px\">".$row['in_name']."<br /><span class=\"sml\">".$row['in_dir']."</span><br /></td>";
                echo "<td valign=\"bottom\"><span class=\"light\">����: ".$row['in_author']."</span><div class=\"psetting\"><a href=\"".$row['in_address']."\" target=\"_blank\">�鿴</a></div></td>";
                echo "<td align=\"right\" valign=\"bottom\" style=\"width:160px\">".(date("Y-m-d",strtotime($row['in_addtime']))==date('Y-m-d') ? '<em class="lightnum">'.date("Y-m-d",strtotime($row['in_addtime'])).'</em>' : date("Y-m-d",strtotime($row['in_addtime'])))."<br /><br /><a style=\"cursor:pointer\" onclick=\"del_msg('?iframe=module&ac=uninst&id=".$row['in_id']."&dir=".$row['in_dir']."');\">ж��</a>&nbsp;&nbsp;</td>";
                echo "</tr>";
        }
}
?>
</table>
<table class="tb tb2">
<tr><td colspan="15"><div class="fixsel"><a href="<?php echo $develop_auth; ?>">��ȡ����Ӧ��</a></div></td></tr>
</table>
</div>
</body>
</html>
<?php
function del_plugin($id,$dir){
	global $db;
        if(@include_once('source/plugin/'.$dir.'/function.php')){
		plugin_uninstall();
        }
	$sql="delete from ".tname('plugin')." where in_id=".intval($id);
	if($db->query($sql)){
		echo "<script type=\"text/javascript\">parent.$('menu_app').innerHTML='".Menu_App()."';</script>";
		destroyDir('source/plugin/'.$dir.'/');
		ShowMessage("��ϲ����Ӧ��ж�سɹ���","?iframe=module","infotitle2",3000,1);
	}
}
function cut_plugin($id,$is){
	global $db;
	$sql="update ".tname('plugin')." set in_isindex=".$is." where in_id=".intval($id);
	if($db->query($sql)){
		ShowMessage("��ϲ����״̬�л��ɹ���","?iframe=module","infotitle2",1000,1);
	}
}
?>