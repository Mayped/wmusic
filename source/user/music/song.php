<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<?php global $db,$userlogined,$erduo_in_userid; ?>
<?php if(!$userlogined){header("location:".rewrite_mode('user.php/people/login/'));exit();} ?>
<?php
$song = explode("/", $_SERVER['PATH_INFO']);
if($song[3] == 'listen'){
$table = 'listen';
$text = '����';
$Arr = getuserpage("select * from ".tname('listen')." where in_uid=".$erduo_in_userid." order by in_addtime desc", 20, 4);
}else{
$table = 'favorites';
$text = '�ղ�';
$Arr = getuserpage("select * from ".tname('favorites')." where in_uid=".$erduo_in_userid." order by in_addtime desc", 20, 3);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>�ҵĸ赥 - <?php echo IN_NAME; ?></title>
<meta name="Keywords" content="<?php echo IN_KEYWORDS; ?>" />
<meta name="Description" content="<?php echo IN_DESCRIPTION; ?>" />
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/lib.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/user/js/lib.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/user/js/music.js"></script>
<script type="text/javascript">
var in_path = '<?php echo IN_PATH; ?>';
</script>
<style type="text/css">
@import url(<?php echo IN_PATH; ?>static/user/css/style.css);
.float_delsong{
	width:13px;
	height:14px;
	background:url(<?php echo IN_PATH; ?>static/user/images/delete.gif) no-repeat 0 0;
	top:0.5em;
	right:5px;
	text-indent:-999em;
	overflow:hidden;
	display:block
}
.float_delsong:hover{
	background-position:0 -14px
}
</style>
</head>
<body>
<?php include 'source/user/people/top.php'; ?>
<div id="main">
<?php include 'source/user/people/left.php'; ?>
<div id="mainarea">
<h2 class="title"><img src="<?php echo IN_PATH; ?>static/user/images/icon/music.gif">����</h2>
<div class="tabs_header">
<ul class="tabs">
<li><a href="<?php echo rewrite_mode('user.php/music/index/'); ?>"><span>��������</span></a></li>
<li><a href="<?php echo rewrite_mode('user.php/music/passed/'); ?>"><span>��������</span></a></li>
<li class="active"><a href="<?php echo rewrite_mode('user.php/music/song/'); ?>"><span>�ҵĸ赥</span></a></li>
<li class="null"><a href="<?php echo rewrite_mode('user.php/music/add/'); ?>">�ϴ�����</a></li>
</ul>
</div>
<div id="content" style="width:100%;">
<div class="l_status"><a href="<?php echo rewrite_mode('user.php/music/song/'); ?>"<?php if($song[3] !== 'listen'){echo ' class="active"';} ?>>�ղؼ�¼</a><span class="pipe">|</span><a href="<?php echo rewrite_mode('user.php/music/song/listen/'); ?>"<?php if($song[3] == 'listen'){echo ' class="active"';} ?>>������¼</a></div>
<?php
$result = $db->query($Arr[2]);
$count = $db->num_rows($result);
if($count == 0){
?>
<div class="c_form">û��<?php echo $text; ?>��¼��</div>
<?php }else{ ?>
<div class="space_list">
<table cellspacing="0" cellpadding="0" width="100%">
<thead><tr>
<td>����</td>
<td align="center">����</td>
<td align="center"><?php echo $text; ?></td>
<td align="center">����</td>
</tr></thead>
<?php
while ($row = $db->fetch_array($result)){
?>
<tr>
<td><a href="<?php echo getlink($row['in_mid'], 'music'); ?>" target="_blank"><?php echo getfield('music', 'in_name', 'in_id', $row['in_mid']); ?></a></td>
<td align="center"><a href="<?php echo getlink(getfield('music', 'in_classid', 'in_id', $row['in_mid']), 'class'); ?>" target="_blank"><?php echo getfield('class', 'in_name', 'in_id', getfield('music', 'in_classid', 'in_id', $row['in_mid'])); ?></a></td>
<td align="center"><?php echo datetime($row['in_addtime']); ?></td>
<td align="center"><a class="float_delsong" style="cursor:pointer" onclick="delsong(<?php echo $row['in_id']; ?>, '<?php echo $table; ?>');">ɾ��</a></td>
</tr>
<?php } ?>
</table>
<?php echo $Arr[0]; ?>
</div>
<?php } ?>
</div>
</div>
<div id="bottom"></div>
</div>
<?php include 'source/user/people/bottom.php'; ?>
</body>
</html>