<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<?php global $db; ?>
<div id="space_page">
<div id="ubar">
<div id="space_avatar"><div><img src="<?php echo getavatar($ear['in_userid'], 'big'); ?>"></div></div>
<div class="borderbox">
<ul class="spacemenu_list" style="width:100%; overflow:hidden;">
<li><img src="<?php echo IN_PATH; ?>static/user/images/icon/message.gif"><a href="javascript:void(0)" onclick="layer.prompt({title:'����<?php echo $ear['in_username']; ?>��������Ϣ',type:3},function(msg){sendmessage('<?php echo $ear['in_username']; ?>', msg);});">������Ϣ</a></li>
<li><img src="<?php echo IN_PATH; ?>static/user/images/icon/friend.gif"><a href="javascript:void(0)" onclick="pop.friend('<?php echo $ear['in_username']; ?>');">��Ϊ����</a></li>
</ul>
</div><br />
<div id="space_mymenu">
<h2>���˲˵�</h2>
<ul class="line_list">
<li><img src="<?php echo IN_PATH; ?>static/user/images/icon/space.gif"><a href="<?php echo getlink($ear['in_userid']); ?>">������ҳ</a></li>
<li><img src="<?php echo IN_PATH; ?>static/user/images/icon/feed.gif"><a href="<?php echo getlink($ear['in_userid'], 's_feed'); ?>">˵˵</a><em>(<?php echo $db->num_rows($db->query("select * from ".tname('feed')." where in_type=0 and in_uid=".$ear['in_userid'])); ?>)</em></li>
<li><img src="<?php echo IN_PATH; ?>static/user/images/icon/music.gif"><a href="<?php echo getlink($ear['in_userid'], 's_music'); ?>">����</a></li>
<li><img src="<?php echo IN_PATH; ?>static/user/images/icon/special.gif"><a href="<?php echo getlink($ear['in_userid'], 's_special'); ?>">ר��</a></li>
<li><img src="<?php echo IN_PATH; ?>static/user/images/icon/singer.gif"><a href="<?php echo getlink($ear['in_userid'], 's_singer'); ?>">����</a></li>
<li><img src="<?php echo IN_PATH; ?>static/user/images/icon/video.gif"><a href="<?php echo getlink($ear['in_userid'], 's_video'); ?>">��Ƶ</a></li>
<li><img src="<?php echo IN_PATH; ?>static/user/images/icon/photo.gif"><a href="<?php echo getlink($ear['in_userid'], 's_photo'); ?>">���</a></li>
<li><img src="<?php echo IN_PATH; ?>static/user/images/icon/blog.gif"><a href="<?php echo getlink($ear['in_userid'], 's_blog'); ?>">��־</a></li>
</ul>
</div>
</div>