<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<?php global $db,$userlogined,$erduo_in_userid; ?>
<?php if(!$userlogined){header("location:".rewrite_mode('user.php/people/login/'));exit();} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>�ҵ���� - <?php echo IN_NAME; ?></title>
<meta name="Keywords" content="<?php echo IN_KEYWORDS; ?>" />
<meta name="Description" content="<?php echo IN_DESCRIPTION; ?>" />
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/confirm-lib.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/user/js/lib.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/user/js/photo.js"></script>
<script type="text/javascript">
var in_path = '<?php echo IN_PATH; ?>';
layer.use('confirm-ext.js');
function del_msg(_id) {
	$.layer({
		shade: [0],
		area: ['auto', 'auto'],
		dialog: {
			msg: '��ͬʱ�������е���Ƭ��ȷ�ϼ�����',
			btns: 2,
			type: 4,
			btn: ['ȷ��', 'ȡ��'],
			yes: function() {
				delgroup(_id);
			},
			no: function() {
				layer.msg('��ȡ��ɾ��', 1, 0);
			}
		}
	});
}
</script>
<style type="text/css">
@import url(<?php echo IN_PATH; ?>static/user/css/style.css);
@import url(<?php echo IN_PATH; ?>static/user/css/album.css);
</style>
</head>
<body>
<?php include 'source/user/people/top.php'; ?>
<div id="main">
<?php include 'source/user/people/left.php'; ?>
<div id="mainarea">
<h2 class="title"><img src="<?php echo IN_PATH; ?>static/user/images/icon/photo.gif">��Ƭ</h2>
<div class="tabs_header">
<ul class="tabs">
<li><a href="<?php echo rewrite_mode('user.php/photo/index/'); ?>"><span>��ҵ���Ƭ</span></a></li>
<li><a href="<?php echo rewrite_mode('user.php/photo/friend/'); ?>"><span>���ѵ���Ƭ</span></a></li>
<li class="active"><a href="<?php echo rewrite_mode('user.php/photo/me/'); ?>"><span>�ҵ����</span></a></li>
<li><a href="<?php echo rewrite_mode('user.php/photo/add/'); ?>"><span>�½����</span></a></li>
<li class="null"><a href="<?php echo rewrite_mode('user.php/photo/upload/'); ?>">�ϴ���Ƭ</a></li>
</ul>
</div>
<?php
$Arr = getuserpage("select * from ".tname('photo_group')." where in_uid=".$erduo_in_userid." order by in_id desc", 12, 3);
$result = $db->query($Arr[2]);
$count = $db->num_rows($result);
if($count == 0){
?>
<div class="c_form">û�п��������ᡣ</div>
<?php }else{ ?>
<table class="album_list" cellspacing="0" cellpadding="0" width="100%"><tr>
<?php
$start = 0;
while ($row = $db->fetch_array($result)){
$nums = $db->num_rows($db->query("select * from ".tname('photo')." where in_gid=".$row['in_id']));
$start = $start + 1;
?>
<td style="padding-bottom: 20px;">
<div class="album_bg"><a href="<?php echo getlink($row['in_id'], 'photogroup'); ?>"><img src="<?php echo getphoto($row['in_pid']); ?>" /></a></div>
<p><a href="<?php echo getlink($row['in_id'], 'photogroup'); ?>"><?php echo $row['in_title']; ?></a> <span class="gray">(<?php echo $nums; ?>)</span></p>
<p class="gray"><a style="cursor:pointer" onclick="layer.prompt({title:'�޸������'},function(title){editgroup(<?php echo $row['in_id']; ?>, title);});">��</a><span class="pipe">|</span><a style="cursor:pointer" onclick="del_msg(<?php echo $row['in_id']; ?>);">ɾ��</a><span class="pipe">|</span><a href="<?php echo rewrite_mode('user.php/photo/upload/'.$row['in_id'].'/'); ?>">�ϴ���Ƭ</a></p>
</td>
<?php if($start == 4 || $start == 8){echo "</tr><tr>";} ?>
<?php } ?>
</tr></table>
<?php echo $Arr[0]; ?>
<?php } ?>
</div>
<div id="bottom"></div>
</div>
<?php include 'source/user/people/bottom.php'; ?>
</body>
</html>