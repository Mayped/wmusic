<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<?php global $db,$userlogined,$erduo_in_userid; ?>
<?php if(!$userlogined){header("location:".rewrite_mode('user.php/people/login/'));exit();} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>�ҵ��㼣 - <?php echo IN_NAME; ?></title>
<meta name="Keywords" content="<?php echo IN_KEYWORDS; ?>" />
<meta name="Description" content="<?php echo IN_DESCRIPTION; ?>" />
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/confirm-lib.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/user/js/lib.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/user/js/friend.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/user/js/message.js"></script>
<script type="text/javascript">
var in_path = '<?php echo IN_PATH; ?>';
var friend_group = '<select id="groupid" onchange="ongroup(this.value);"><option value="0">ѡ�����</option>'
<?php
$query = $db->query("select * from ".tname('friend_group')." where in_uid=".$erduo_in_userid." order by in_id desc");
while ($row = $db->fetch_array($query)){
        echo " + '<option value=\"".$row['in_id']."\">".$row['in_title']."</option>'";
}
?>
+ '<option value="-1" style="color:red;">+�½�����</option></select>';
var pop = {
	friend: function(username) {
		$.layer({
			type: 1,
			title: '���ӡ�' + username + '��Ϊ����',
			page: {html: '<form method="get" onsubmit="addfriend(\'' + username + '\');return false;" class="c_form"><table cellspacing="0" cellpadding="0" class="formtable"><tr><th style="width:4em;">����:</th><td><input type="text" id="message" class="t_input"  /></td></tr><tr><th style="width:4em;">����:</th><td>' + friend_group + '</td></tr><tr><th style="width:4em;"></th><td><input type="submit" value="ȷ��" class="submit" /></td></tr></table></form>'}
		});
	}
}
layer.use('confirm-ext.js');
function ongroup(_id) {
        if (_id < 0) {
		layer.closeAll();
		layer.prompt({title:'�����·���'},function(title){addgroup(title);});
	}
}
</script>
<style type="text/css">
@import url(<?php echo IN_PATH; ?>static/user/css/style.css);
</style>
</head>
<body>
<?php include 'source/user/people/top.php'; ?>
<div id="main">
<?php include 'source/user/people/left.php'; ?>
<div id="mainarea">
<h2 class="title"><img src="<?php echo IN_PATH; ?>static/user/images/icon/friend.gif">����</h2>
<div class="tabs_header">
<ul class="tabs">
<li><a href="<?php echo rewrite_mode('user.php/friend/index/'); ?>"><span>�ҵĺ���</span></a></li>
<li><a href="<?php echo rewrite_mode('user.php/friend/stranger/'); ?>"><span>İ����</span></a></li>
<li class="active"><a href="<?php echo rewrite_mode('user.php/friend/trace/'); ?>"><span>�ҵ��㼣</span></a></li>
<li><a href="<?php echo rewrite_mode('user.php/friend/visitor/'); ?>"><span>�ҵķÿ�</span></a></li>
</ul>
</div>
<div id="content" style="width:640px;">
<div class="c_mgs"><div class="ye_r_t"><div class="ye_l_t"><div class="ye_r_b"><div class="ye_l_b">�������ݷù����û��б�</div></div></div></div></div>
<?php
$Arr = getuserpage("select * from ".tname('footprint')." where in_uid=".$erduo_in_userid." order by in_addtime desc", 10, 3);
$result = $db->query($Arr[2]);
$count = $db->num_rows($result);
if($count == 0){
?>
<div class="c_form">û������û��б���</div>
<?php }else{ ?>
<div class="thumb_list"><ul>
<?php
while ($row = $db->fetch_array($result)){
$invisible = $db->getone("select in_invisible from ".tname('session')." where in_uid=".$row['in_uids']);
$online = is_numeric($invisible) && $invisible == 0 ? '<p class="online_icon_p">' : '<p>';
?>
<li>
<div class="avatar48"><a href="<?php echo getlink($row['in_uids']); ?>"><img src="<?php echo getavatar($row['in_uids']); ?>"></a></div>
<div class="thumbTitle"><?php echo $online; ?><a href="<?php echo getlink($row['in_uids']); ?>"><?php echo $row['in_unames']; ?></a></p></div>
<div class="gray"><?php echo datetime($row['in_addtime']); ?></div>
<div class="gray">
<a href="javascript:void(0)" onclick="pop.friend('<?php echo $row['in_unames']; ?>');">����</a><span class="pipe">|</span>
<a href="javascript:void(0)" onclick="layer.prompt({title:'����<?php echo $row['in_unames']; ?>��������Ϣ',type:3},function(msg){sendmessage('<?php echo $row['in_unames']; ?>', msg);});">˽��</a>
</div>
</li>
<?php } ?>
</ul></div>
<?php echo $Arr[0]; ?>
<?php } ?>
</div>
</div>
<div id="bottom"></div>
</div>
<?php include 'source/user/people/bottom.php'; ?>
</body>
</html>