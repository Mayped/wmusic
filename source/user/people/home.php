<?php
if(!defined('IN_ROOT')){exit('Access denied');}
global $db,$userlogined,$erduo_in_userid,$erduo_in_username,$erduo_in_ismail,$erduo_in_isstar,$erduo_in_hits,$erduo_in_points,$erduo_in_rank,$erduo_in_grade,$erduo_in_sign,$erduo_in_signtime,$erduo_in_ucid,$erduo_in_qqopen,$erduo_in_avatar;
if(!$userlogined){header("location:".rewrite_mode('user.php/people/login/'));exit();}
if($erduo_in_sign > 0 && DateDiff(date('Y-m-d', strtotime($erduo_in_signtime)), date('Y-m-d')) !== 0 && DateDiff(date('Y-m-d', strtotime($erduo_in_signtime)), date('Y-m-d', strtotime('-1 days'))) !== 0 || $erduo_in_sign > 0 && DateDiff(date('Y-m-d', strtotime($erduo_in_signtime)), date('Y-m-d')) !== 0 && intval(date('d')) == 1){
        $erduo_in_sign = 0;
        $db->query("update ".tname('user')." set in_sign=0 where in_userid=".$erduo_in_userid);
}
$invisible = $db->getone("select in_invisible from ".tname('session')." where in_uid=".$erduo_in_userid);
$last_doing = '';
$query = $db->query("select * from ".tname('feed')." where in_uid=".$erduo_in_userid." and in_type=0 order by in_addtime desc LIMIT 0,1");
while ($row = $db->fetch_array($query)){
$last_doing = preg_replace('/\[em:(\d+)]/is', '<img src="'.IN_PATH.'static/user/images/face/\1.gif" class="face">', $row['in_content']);
}
$id = '';
$query = $db->query("select in_uids from ".tname('friend')." where in_uid=".$erduo_in_userid);
while ($rows = $db->fetch_array($query)) {
$id .= $rows['in_uids'].',';
}
$id = str_replace(',0', '', $id.'0');
$home = explode('/', $_SERVER['PATH_INFO']);
$we = isset($home[3]) ? $home[3] : NULL;
if($we == 'friend'){
        $Arr = getuserpage("select * from ".tname('feed')." where in_uid in ($id) order by in_addtime desc", 20, 4);
}elseif($we == 'me'){
        $Arr = getuserpage("select * from ".tname('feed')." where in_uid=".$erduo_in_userid." order by in_addtime desc", 20, 4);
}else{
        $Arr = getuserpage("select * from ".tname('feed')." order by in_addtime desc", 20, 3);
}
$result = $db->query($Arr[2]);
$count = $db->num_rows($result);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>��ҳ - <?php echo IN_NAME; ?></title>
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
var in_points = '<?php echo ($erduo_in_sign + 1) * IN_SIGNDAYPOINTS; ?>';
var in_rank = '<?php echo ($erduo_in_sign + 1) * IN_SIGNDAYRANK; ?>';
var guide_url = '<?php echo rewrite_mode('user.php/people/home/me/'); ?>';
function search_user() {
	var keyword = $('keyword').value.replace(/\//g, '');
	keyword = keyword.replace(/\\/g, '');
	keyword = keyword.replace(/\?/g, '');
	keyword = keyword.replace(/\+/g, '');
	if (keyword == '') {
		$('keyword').focus();
		return;
	} else {
		location.href = '<?php echo rewrite_mode('user.php/misc/search/\' + keyword + \'/'); ?>';
	}
}
</script>
<style type="text/css">
@import url(<?php echo IN_PATH; ?>static/user/css/style.css);
@import url(<?php echo IN_PATH; ?>static/user/css/sign.css);
</style>
</head>
<body>
<?php include 'source/user/people/top.php'; ?>
<div id="main">
<?php include 'source/user/people/left.php'; ?>
<div id="mainarea">
<div id="content">
<table cellpadding="0" cellspacing="0" border="0" width="100%"><tr>
<td valign="top" width="150">
<div class="ar_r_t"><div class="ar_l_t"><div class="ar_r_b"><div class="ar_l_b"><img src="<?php echo getavatar($erduo_in_userid, 'middle'); ?>" width="120" height="120"></div></div></div></div>
<ul class="u_setting">
<li class="dropmenu"><a href="<?php echo rewrite_mode('user.php/profile/avatar/'); ?>">������ͷ�� <img src="<?php echo IN_PATH; ?>static/user/images/more.gif" align="absmiddle"></a></li>
</ul>
</td>
<td valign="top">
<h3 class="index_name">
<?php if($invisible == 0){ ?>
<div class="r_option">��ǰ���� <img src="<?php echo IN_PATH; ?>static/user/images/invisible.gif" class="magicicon"><a href="javascript:void(0)" onclick="invisible(1);" class="gray">��Ҫ����</a></div>
<?php }else{ ?>
<div class="r_option">��ǰ���� <img src="<?php echo IN_PATH; ?>static/user/images/invisible.gif" class="magicicon"><a href="javascript:void(0)" onclick="invisible(0);" class="gray">��Ҫ����</a></div>
<?php } ?>
<a href="<?php echo getlink($erduo_in_userid); ?>"><?php echo $erduo_in_username; ?></a>
<?php if($erduo_in_grade == 1){ ?>
<a href="<?php echo rewrite_mode('user.php/profile/credit/'); ?>" title="�����ǻ�Ա������鿴"><img src="<?php echo IN_PATH; ?>static/user/images/vip/vip.gif" align="absmiddle" /></a>
<?php }else{ ?>
<a href="<?php echo rewrite_mode('user.php/profile/vip/'); ?>" title="����δ��ͨ��Ա�������ͨ"><img src="<?php echo IN_PATH; ?>static/user/images/vip/novip.png" align="absmiddle" /></a>
<?php } ?>
<?php if($erduo_in_isstar == 1){ ?>
<a href="<?php echo rewrite_mode('user.php/profile/verify/'); ?>" title="������֤"><img src="<?php echo IN_PATH; ?>static/user/images/star.png" align="absmiddle" /></a>
<?php } ?>
<?php echo getlevel($erduo_in_rank, 1); ?>
</h3>
<div class="index_note">���� <?php echo $erduo_in_hits; ?> ������, <?php echo $erduo_in_points; ?> �����, <?php echo $erduo_in_rank; ?> ������</div>
<div id="mood_mystatus"><?php echo $last_doing; ?></div>
<div id="mood_form">
<form method="get" onsubmit="doing();return false;">
<div id="mood_statusinput" class="statusinput">
<textarea id="message" onclick="showFace(this.id, 'message');return false;" ></textarea>
</div>
<div class="statussubmit">
<input type="submit" value="����" class="submit" />
</div>
</form>
</div>
</td>
</tr></table>
<?php if(IN_UCOPEN == 0 && empty($erduo_in_avatar) && empty($erduo_in_qqopen) || $erduo_in_ucid == 0 && empty($erduo_in_avatar) && empty($erduo_in_qqopen)){ ?>
<div class="ye_r_t"><div class="ye_l_t"><div class="ye_r_b"><div class="ye_l_b">
<div class="task_notice">
<div class="task_notice_body">
<div class="notice">����û���ϴ�ͷ�����ͷ��������Ի�ý�ң��Ͽ����μӰ�</div>
<img src="<?php echo IN_PATH; ?>static/user/images/avatar.gif" class="icon" />
<h3><a href="<?php echo rewrite_mode('user.php/profile/avatar/'); ?>">����һ���Լ���ͷ��</a></h3>
<p>�ɻ�� <span class="num"><?php echo IN_AVATARPOINTS; ?></span> ���</p>
</div>
</div>
</div></div></div></div><br />
<?php }elseif($erduo_in_ismail == 0){ ?>
<div class="ye_r_t"><div class="ye_l_t"><div class="ye_r_b"><div class="ye_l_b">
<div class="task_notice">
<div class="task_notice_body">
<div class="notice">����û�м������䣬�������������Ի�ý�ң��Ͽ����μӰ�</div>
<img src="<?php echo IN_PATH; ?>static/user/images/mail.gif" class="icon" />
<h3><a href="<?php echo rewrite_mode('user.php/profile/mail/'); ?>">��֤�����Լ�������</a></h3>
<p>�ɻ�� <span class="num"><?php echo IN_MAILPOINTS; ?></span> ���</p>
</div>
</div>
</div></div></div></div><br />
<?php } ?>
<div class="tabs_header" style="padding-top:10px;">
<ul class="tabs">
<li<?php if($we !== 'friend' && $we !== 'me'){echo ' class="active"';} ?>><a href="<?php echo rewrite_mode('user.php/people/home/'); ?>"><span>ȫվ��̬</span></a></li>
<li<?php if($we == 'friend'){echo ' class="active"';} ?>><a href="<?php echo rewrite_mode('user.php/people/home/friend/'); ?>"><span>���Ѷ�̬</span></a></li>
<li<?php if($we == 'me'){echo ' class="active"';} ?>><a href="<?php echo rewrite_mode('user.php/people/home/me/'); ?>"><span>�ҵĶ�̬</span></a></li>
</ul>
</div>
<div class="feed"><div class="enter-content">
<?php if($count == 0){ ?>
<ul><li>û����ض�̬</li></ul>
<?php }else{ ?>
<ul>
<?php
while ($row = $db->fetch_array($result)){
if($row['in_type'] == 0){
$content = preg_replace('/\[em:(\d+)]/is', '<img src="'.IN_PATH.'static/user/images/face/\1.gif" class="face">', $row['in_content']);
$del = $row['in_uid'] == $erduo_in_userid ? '&nbsp;<a href="javascript:void(0)" onclick="deldoing('.$row['in_id'].');" class="re gray">ɾ��</a>' : '';
?>
<li class="s_clear">
<div style="width:100%;overflow:hidden;" >
<img src="<?php echo IN_PATH; ?>static/user/images/icon/feed.gif" />&nbsp;<a target="_blank" href="<?php echo getlink($row['in_uid']); ?>"><?php echo $row['in_uname']; ?></a>&nbsp;<?php echo $row['in_title']; ?>&nbsp;<span class="gray"><?php echo datetime($row['in_addtime']); ?></span><?php echo $del; ?>&nbsp;(<a href="javascript:void(0)" onclick="docomment_form(<?php echo $row['in_id']; ?>);">�ظ�</a>)<div class="feed_content"><div class="quote"><span class="q"><?php echo $content; ?></span></div></div>
</div>
<div id="doreply<?php echo $row['in_id']; ?>"><script type="text/javascript">getreply(<?php echo $row['in_id']; ?>);</script></div>
</li>
<?php }elseif($row['in_icon'] == 'space'){ ?>
<li class="s_clear">
<div style="width:100%;overflow:hidden;" >
<img src="<?php echo IN_PATH; ?>static/user/images/icon/space.gif" />&nbsp;<a target="_blank" href="<?php echo getlink($row['in_uid']); ?>"><?php echo $row['in_uname']; ?></a>&nbsp;<?php echo $row['in_title']; ?>&nbsp;<span class="gray"><?php echo datetime($row['in_addtime']); ?></span>
<div class="feed_content">
<a href="<?php echo getlink($row['in_tid']); ?>" target="_blank"><img src="<?php echo getavatar($row['in_tid'], 'middle'); ?>" class="summaryimg"></a>
<div class="detail"><b><a target="_blank" href="<?php echo getlink($row['in_tid']); ?>"><?php echo getfield('user', 'in_username', 'in_userid', $row['in_tid']); ?></a></b></div>
<div class="quote"><span class="q"><?php echo $row['in_content']; ?></span></div>
</div>
</div>
</li>
<?php
}elseif($row['in_icon'] == 'share'){
$share = explode('[/flash]', $row['in_content']);
$intro = isset($share[1]) ? $share[1] : NULL;
$swf = isset($share[0]) ? str_replace('[flash]', '', $share[0]) : NULL;
$play = '<embed src="'.$swf.'" width="270" height="210" allowfullscreen="true" allowscriptaccess="always" wmode="transparent" type="application/x-shockwave-flash"></embed>';
?>
<li class="s_clear">
<div style="width:100%;overflow:hidden;" >
<img src="<?php echo IN_PATH; ?>static/user/images/icon/share.gif" />&nbsp;<a target="_blank" href="<?php echo getlink($row['in_uid']); ?>"><?php echo $row['in_uname']; ?></a>&nbsp;<?php echo $row['in_title']; ?>&nbsp;<span class="gray"><?php echo datetime($row['in_addtime']); ?></span>
<div class="feed_content">
<div class="detail"><?php echo $play; ?></div>
<div class="quote"><span class="q"><?php echo $intro; ?></span></div>
</div>
</div>
</li>
<?php }elseif($row['in_icon'] == 'blog'){ ?>
<li class="s_clear">
<div style="width:100%;overflow:hidden;" >
<img src="<?php echo IN_PATH; ?>static/user/images/icon/blog.gif" />&nbsp;<a target="_blank" href="<?php echo getlink($row['in_uid']); ?>"><?php echo $row['in_uname']; ?></a>&nbsp;<?php echo $row['in_title']; ?>&nbsp;<span class="gray"><?php echo datetime($row['in_addtime']); ?></span>
<div class="feed_content"><div class="detail"><b><a target="_blank" href="<?php echo getlink($row['in_tid'], 'blog'); ?>"><?php echo getfield('blog', 'in_title', 'in_id', $row['in_tid']); ?></a></b><br /><?php echo $row['in_content']; ?></div></div>
</div>
</li>
<?php }elseif($row['in_icon'] == 'photo'){ ?>
<li class="s_clear">
<div style="width:100%;overflow:hidden;" >
<img src="<?php echo IN_PATH; ?>static/user/images/icon/photo.gif" />&nbsp;<a target="_blank" href="<?php echo getlink($row['in_uid']); ?>"><?php echo $row['in_uname']; ?></a>&nbsp;<?php echo $row['in_title']; ?>&nbsp;<span class="gray"><?php echo datetime($row['in_addtime']); ?></span>
<div class="feed_content">
<a href="<?php echo getlink($row['in_tid'], 'photogroup'); ?>" target="_blank"><img src="<?php echo getphoto(getfield('photo_group', 'in_pid', 'in_id', $row['in_tid'])); ?>" class="summaryimg"></a>
<div class="detail"><b><a target="_blank" href="<?php echo getlink($row['in_tid'], 'photogroup'); ?>"><?php echo getfield('photo_group', 'in_title', 'in_id', $row['in_tid']); ?></a></b><br /><?php echo $row['in_content']; ?></div>
</div>
</div>
</li>
<?php }else{ ?>
<li class="s_clear">
<div style="width:100%;overflow:hidden;" >
<img src="<?php echo IN_PATH; ?>static/user/images/icon/<?php echo $row['in_icon']; ?>.gif" />&nbsp;<a target="_blank" href="<?php echo getlink($row['in_uid']); ?>"><?php echo $row['in_uname']; ?></a>&nbsp;<?php echo $row['in_title']; ?>&nbsp;<span class="gray"><?php echo datetime($row['in_addtime']); ?></span>
<div class="feed_content">
<a href="<?php echo getlink($row['in_tid'], $row['in_icon']); ?>" target="_blank"><img src="<?php echo geturl(getfield($row['in_icon'], 'in_cover', 'in_id', $row['in_tid']), 'cover'); ?>" class="summaryimg"></a>
<div class="detail"><b><a target="_blank" href="<?php echo getlink($row['in_tid'], $row['in_icon']); ?>"><?php echo getfield($row['in_icon'], 'in_name', 'in_id', $row['in_tid']); ?></a></b></div>
<div class="quote"><span class="q"><?php echo $row['in_content']; ?></span></div>
</div>
</div>
</li>
<?php } ?>
<?php } ?>
</ul>
<?php echo $Arr[0]; ?>
<?php } ?>
</div></div>
</div>
<div id="sidebar">
<div class="sidebox">
<div class="user_sign">
<span class="date"><?php echo date('m').'.'.date('d'); ?></span>
<span class="week"><script type="text/javascript">document.write(get_week());</script></span>
<span class="time_tip">DAY</span>
<strong class="time" id="in_sign"><?php echo $erduo_in_sign; ?></strong>
<button class="user_sign_but" onclick="clock_sign();"></button>
</div>
<div class="calendarbox">
<ul><?php echo getsign($erduo_in_sign, $erduo_in_signtime); ?></ul>
</div>
</div>
<div class="sidebox">
<h2 class="title"><p class="r_option"><a href="<?php echo rewrite_mode('user.php/misc/rank/join/'); ?>">����</a></p>���һ�ӭ�³�Ա</h2>
<ul class="avatar_list">
<?php
$query = $db->query("select * from ".tname('user')." order by in_regdate desc LIMIT 0,6");
while ($row = $db->fetch_array($query)){
$invisible = $db->getone("select in_invisible from ".tname('session')." where in_uid=".$row['in_userid']);
$online = is_numeric($invisible) && $invisible == 0 ? '<p class="online_icon_p">' : '<p>';
?>
<li>
<div class="avatar48"><a href="<?php echo getlink($row['in_userid']); ?>"><img src="<?php echo getavatar($row['in_userid']); ?>" /></a></div>
<?php echo $online; ?><a href="<?php echo getlink($row['in_userid']); ?>" title="<?php echo $row['in_username']; ?>"><?php echo $row['in_username']; ?></a></p>
<p class="gray"><?php echo datetime($row['in_regdate']); ?></p>
</li>
<?php } ?>
</ul>
</div>
<div class="sidebox">
<h2 class="title"><p class="r_option"><a href="<?php echo rewrite_mode('user.php/friend/visitor/'); ?>">ȫ��</a></p>�������</h2>
<ul class="avatar_list">
<?php
$query = $db->query("select * from ".tname('footprint')." where in_uids=".$erduo_in_userid." order by in_addtime desc LIMIT 0,6");
while ($row = $db->fetch_array($query)){
$invisible = $db->getone("select in_invisible from ".tname('session')." where in_uid=".$row['in_uid']);
$online = is_numeric($invisible) && $invisible == 0 ? '<p class="online_icon_p">' : '<p>';
?>
<li>
<div class="avatar48"><a href="<?php echo getlink($row['in_uid']); ?>"><img src="<?php echo getavatar($row['in_uid']); ?>" /></a></div>
<?php echo $online; ?><a href="<?php echo getlink($row['in_uid']); ?>" title="<?php echo $row['in_uname']; ?>"><?php echo $row['in_uname']; ?></a></p>
<p class="gray"><?php echo datetime($row['in_addtime']); ?></p>
</li>
<?php } ?>
</ul>
</div>
<div class="sidebox">
<h2 class="title"><p class="r_option"><a href="<?php echo rewrite_mode('user.php/friend/index/'); ?>">ȫ��</a></p>���º���</h2>
<ul class="avatar_list">
<?php
$query = $db->query("select * from ".tname('friend')." where in_uid=".$erduo_in_userid." order by in_addtime desc LIMIT 0,6");
while ($row = $db->fetch_array($query)){
$invisible = $db->getone("select in_invisible from ".tname('session')." where in_uid=".$row['in_uids']);
$online = is_numeric($invisible) && $invisible == 0 ? '<p class="online_icon_p">' : '<p>';
?>
<li>
<div class="avatar48"><a href="<?php echo getlink($row['in_uids']); ?>"><img src="<?php echo getavatar($row['in_uids']); ?>" /></a></div>
<?php echo $online; ?><a href="<?php echo getlink($row['in_uids']); ?>" title="<?php echo $row['in_unames']; ?>"><?php echo $row['in_unames']; ?></a></p>
<p class="gray"><?php echo datetime($row['in_addtime']); ?></p>
</li>
<?php } ?>
</ul>
</div>
<div class="searchfriend">
<div class="ye_r_t"><div class="ye_l_t"><div class="ye_r_b"><div class="ye_l_b">
<h3>�����û�</h3>
<form method="get" onsubmit="search_user();return false;" style="padding:10px 0 5px 0;">
<input id="keyword" size="20" class="t_input" type="text">
<input value="����" class="submit" type="submit">
</form>
<p>
<a href="<?php echo rewrite_mode('user.php/misc/search/'); ?>">�߼�����</a><span class="pipe">|</span>
<a href="<?php echo rewrite_mode('user.php/misc/rank/'); ?>">���а�</a>
</p>
</div></div></div></div>
</div>
<div class="ye_r_t"><div class="ye_l_t"><div class="ye_r_b"><div class="ye_l_b">
<form method="get" onsubmit="share_flash();return false;">
<table cellspacing="2" cellpadding="2" width="100%">
<tr><td><strong>����Flash:</strong></td></tr>
<tr><td><input type="text" class="t_input" id="share_play" onfocus="javascript:if('http://'==this.value)this.value=''" onblur="javascript:if(''==this.value)this.value='http://'" style="width:98%;" value="http://" /></td></tr>
<tr><td><strong>����:</strong></td></tr>
<tr><td><textarea id="share_intro" style="width:98%;" rows="3"></textarea></td></tr>
<tr><td><input type="submit" value="����" class="submit" /></td></tr>
</table>
</form>
</div></div></div></div>
</div>
</div>
<div id="bottom"></div>
</div>
<?php include 'source/user/people/bottom.php'; ?>
</body>
</html>