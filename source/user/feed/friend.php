<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<?php global $db,$userlogined,$erduo_in_userid; ?>
<?php if(!$userlogined){header("location:".rewrite_mode('user.php/people/login/'));exit();} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>������˵ - <?php echo IN_NAME; ?></title>
<meta name="Keywords" content="<?php echo IN_KEYWORDS; ?>" />
<meta name="Description" content="<?php echo IN_DESCRIPTION; ?>" />
<link href="<?php echo IN_PATH; ?>static/pack/asynctips/asynctips.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/asynctips/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/asynctips/asyncbox.v1.4.5.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/lib.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/user/js/lib.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/user/js/doing.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/user/js/face.js"></script>
<script type="text/javascript">
function $(obj) {return document.getElementById(obj);}
var in_path = '<?php echo IN_PATH; ?>';
var guide_url = '<?php echo rewrite_mode('user.php/feed/me/'); ?>';
</script>
<style type="text/css">
@import url(<?php echo IN_PATH; ?>static/user/css/style.css);
@import url(<?php echo IN_PATH; ?>static/user/css/doing.css);
</style>
</head>
<body>
<?php include 'source/user/people/top.php'; ?>
<div id="main">
<?php include 'source/user/people/left.php'; ?>
<div id="mainarea">
<h2 class="title"><img src="<?php echo IN_PATH; ?>static/user/images/icon/feed.gif">˵˵</h2>
<div class="tabs_header">
<ul class="tabs">
<li><a href="<?php echo rewrite_mode('user.php/feed/index/'); ?>"><span>�����˵</span></a></li>
<li class="active"><a href="<?php echo rewrite_mode('user.php/feed/friend/'); ?>"><span>������˵</span></a></li>
<li><a href="<?php echo rewrite_mode('user.php/feed/me/'); ?>"><span>�ҵ�˵˵</span></a></li>
</ul>
</div>
<div id="content">
<form method="get" onsubmit="doing();return false;" class="post_doing">
<div class="r_option">�������� <strong id="maxlimit">200</strong> ���ַ�</div>
<a href="javascript:void(0)" id="doingface" onclick="showFace(this.id, 'message');return false;"><img src="<?php echo IN_PATH; ?>static/user/images/facelist.gif" align="absmiddle" /></a>
<br />
<textarea id="message" onkeyup="textCounter(this, 'maxlimit', 200);" onkeydown="ctrlEnter(event, 'add');" rows="4" style="width:438px; height: 72px;"></textarea>
<button type="submit" id="add" class="post_button">����</button>
</form>
<br />
<?php
$id = '';
$query = $db->query("select in_uids from ".tname('friend')." where in_uid=".$erduo_in_userid);
while ($rows = $db->fetch_array($query)) {
$id .= $rows['in_uids'].',';
}
$id = str_replace(',0', '', $id.'0');
$me = explode('/', $_SERVER['PATH_INFO']);
$sort = isset($me[3]) ? $me[3] : NULL;
if($sort == 'asc'){
        $Arr = getuserpage("select * from ".tname('feed')." where in_uid in ($id) and in_type=0 order by in_addtime asc", 20, 4);
}else{
        $Arr = getuserpage("select * from ".tname('feed')." where in_uid in ($id) and in_type=0 order by in_addtime desc", 20, 3);
}
$result = $db->query($Arr[2]);
$count = $db->num_rows($result);
if($count == 0){
?>
<div class="c_form">���ڻ�û��˵˵���������һ�仰˵����һ������ʲô��</div>
<?php }else{ ?>
<div class="doing_list">
<ol>
<?php
while ($row = $db->fetch_array($result)){
$content = preg_replace('/\[em:(\d+)]/is', '<img src="'.IN_PATH.'static/user/images/face/\1.gif" class="face">', $row['in_content']);
?>
<li>
<div class="avatar48"><a href="<?php echo getlink($row['in_uid']); ?>"><img src="<?php echo getavatar($row['in_uid']); ?>"></a></div>
<div class="doing">
<div class="doingcontent"><a href="<?php echo getlink($row['in_uid']); ?>"><?php echo $row['in_uname']; ?></a>: <span><?php echo $content; ?></span>&nbsp;<span class="gray">(<?php echo datetime($row['in_addtime']); ?>)</span>&nbsp;<a href="javascript:void(0)" onclick="docomment_form(<?php echo $row['in_id']; ?>);">�ظ�</a></div>
<div id="doreply<?php echo $row['in_id']; ?>"><script type="text/javascript">getreply(<?php echo $row['in_id']; ?>);</script></div>
</div>
</li>
<?php } ?>
</ol>
<?php echo $Arr[0]; ?>
</div>
<?php } ?>
</div>
<div id="sidebar" style="width:150px;"><div class="cat">
<h3>˵˵����</h3>
<ul class="post_list line_list"><li>����ʽ:<br /><select onchange="location.href=this.options[this.selectedIndex].value;">
<option value="<?php echo rewrite_mode('user.php/feed/friend/'); ?>">ʱ�䵹��</option>
<option value="<?php echo rewrite_mode('user.php/feed/friend/asc/'); ?>"<?php if($sort == 'asc'){echo " selected";} ?>>ʱ������</option>
</select></li></ul>
</div></div>
</div>
<div id="bottom"></div>
</div>
<?php include 'source/user/people/bottom.php'; ?>
</body>
</html>