<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<?php global $db,$userlogined,$erduo_in_userid; ?>
<?php if(!$userlogined){header("location:".rewrite_mode('user.php/people/login/'));exit();} ?>
<?php
$passed = explode('/', $_SERVER['PATH_INFO']);
$cid = isset($passed[3]) ? $passed[3] : NULL;
if(IsNum($cid)){
$get = $db->getone("select in_id from ".tname('special_class')." where in_id=".$cid);
$Arr = getuserpage("select * from ".tname('special')." where in_uid=".$erduo_in_userid." and in_passed=1 and in_classid=".$cid." order by in_addtime desc", 10, 4);
}else{
$get = true;
$Arr = getuserpage("select * from ".tname('special')." where in_uid=".$erduo_in_userid." and in_passed=1 order by in_addtime desc", 10, 3);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>����ר�� - <?php echo IN_NAME; ?></title>
<meta name="Keywords" content="<?php echo IN_KEYWORDS; ?>" />
<meta name="Description" content="<?php echo IN_DESCRIPTION; ?>" />
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/lib.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/user/js/lib.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/user/js/special.js"></script>
<script type="text/javascript">
var in_path = '<?php echo IN_PATH; ?>';
</script>
<style type="text/css">
@import url(<?php echo IN_PATH; ?>static/user/css/style.css);
@import url(<?php echo IN_PATH; ?>static/user/css/event.css);
.float_delspecial{
	width:13px;
	height:14px;
	background:url(<?php echo IN_PATH; ?>static/user/images/delete.gif) no-repeat 0 0;
	top:0.5em;
	right:5px;
	text-indent:-999em;
	overflow:hidden;
	display:block
}
.float_delspecial:hover{
	background-position:0 -14px
}
.float_editspecial{
	float:left;
	width:13px;
	height:14px;
	background:url(<?php echo IN_PATH; ?>static/user/images/edit.gif) no-repeat 0 0;
	top:0.5em;
	right:5px;
	text-indent:-999em;
	overflow:hidden;
	display:block
}
.float_editspecial:hover{
	background-position:0 -14px
}
.float_setspecial{
	float:left;
	margin-right:4px;
	padding:0 18px 0 5px;
	width:25px;
	height:15px;
	border:1px solid #7F93BC;
	background:#FFF none no-repeat scroll right top;
	line-height:15px;
	overflow:hidden;
	display:inline;
	background-image:url(<?php echo IN_PATH; ?>static/user/images/share.gif)
}
.float_setspecial:hover{
	background-color:#576EA5;
	background-position:100% -20px;
	color:#FFF;
	text-decoration:none
}
</style>
</head>
<body>
<?php include 'source/user/people/top.php'; ?>
<div id="main">
<?php include 'source/user/people/left.php'; ?>
<div id="mainarea">
<h2 class="title"><img src="<?php echo IN_PATH; ?>static/user/images/icon/special.gif">ר��</h2>
<div class="tabs_header">
<ul class="tabs">
<li><a href="<?php echo rewrite_mode('user.php/special/index/'); ?>"><span>����ר��</span></a></li>
<li class="active"><a href="<?php echo rewrite_mode('user.php/special/passed/'); ?>"><span>����ר��</span></a></li>
<li class="null"><a href="<?php echo rewrite_mode('user.php/special/add/'); ?>">����ר��</a></li>
</ul>
</div>
<div id="content" style="width:640px;">
<?php if($get){ ?>
<div class="c_mgs"><div class="ye_r_t"><div class="ye_l_t"><div class="ye_r_b"><div class="ye_l_b">��������������δͨ����˵�ר���б�</div></div></div></div></div>
<?php
$result = $db->query($Arr[2]);
$count = $db->num_rows($result);
if($count == 0){
?>
<div class="c_form">û����ش���ר����</div>
<?php }else{ ?>
<div class="event_list"><ol>
<?php
while ($row = $db->fetch_array($result)){
?>
<li>
<div class="event_icon"><a href="<?php echo getlink($row['in_id'], 'special'); ?>" target="_blank"><img class="poster_pre" src="<?php echo geturl($row['in_cover'], 'cover'); ?>"></a></div>
<div class="event_content">
<h4 class="event_title"><a href="<?php echo getlink($row['in_id'], 'special'); ?>" target="_blank"><?php echo $row['in_name']; ?></a></h4>
<ul>
<li><span class="gray">����:</span> <?php echo $row['in_hits']; ?></li>
<li><span class="gray">����:</span> <?php echo datetime($row['in_addtime']); ?></li>
<li><span class="gray">����:</span> <a href="<?php echo getlink($row['in_classid'], 'specialclass'); ?>" target="_blank"><?php echo getfield('special_class', 'in_name', 'in_id', $row['in_classid']); ?></a></li>
<li style="margin: 5px 0 0;"><a href="<?php echo rewrite_mode('user.php/special/set/'.$row['in_id'].'/'); ?>" class="float_setspecial">�Ը�</a><a href="<?php echo rewrite_mode('user.php/special/edit/'.$row['in_id'].'/'); ?>" class="float_editspecial">�༭</a><a class="float_delspecial" style="cursor:pointer" onclick="delspecial(<?php echo $row['in_id']; ?>);">ɾ��</a></li>
</ul>
</div>
</li>
<?php } ?>
</ol>
<?php echo $Arr[0]; ?>
</div>
<?php } ?>
<?php }else{ ?>
<div class="c_form">���಻���ڻ��ѱ�ɾ����</div>
<?php } ?>
</div>
<div id="sidebar" style="width:150px;">
<div class="cat">
<h3>ר������</h3>
<ul class="post_list line_list">
<?php
if(!IsNum($cid)){
        echo "<li class=\"current\"><a href=\"".rewrite_mode('user.php/special/passed/')."\">���޷���</a></li>";
}else{
        echo "<li><a href=\"".rewrite_mode('user.php/special/passed/')."\">���޷���</a></li>";
}
$res=$db->query("select * from ".tname('special_class')." order by in_id asc");
if($res){
        while ($rows = $db->fetch_array($res)){
                if($cid == $rows['in_id']){
                        echo "<li class=\"current\"><a href=\"".rewrite_mode('user.php/special/passed/'.$rows['in_id'].'/')."\">".$rows['in_name']."</a></li>";
                }else{
                        echo "<li><a href=\"".rewrite_mode('user.php/special/passed/'.$rows['in_id'].'/')."\">".$rows['in_name']."</a></li>";
                }
        }
}
?>
</ul>
</div>
</div>
</div>
<div id="bottom"></div>
</div>
<?php include 'source/user/people/bottom.php'; ?>
</body>
</html>