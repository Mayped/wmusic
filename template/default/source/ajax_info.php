<?php
include '../../../source/system/db.class.php';
include '../../../source/system/user.php';
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: text/html;charset=".IN_CHARSET);
global $db,$userlogined,$erduo_in_userid,$erduo_in_username,$erduo_in_grade,$erduo_in_vipgrade,$erduo_in_vipenddate;
if($userlogined){
	$music = $db->num_rows($db->query("select * from ".tname('music')." where in_passed=0 and in_uid=".$erduo_in_userid));
	$favorites = $db->num_rows($db->query("select * from ".tname('favorites')." where in_uid=".$erduo_in_userid));
	$listen = $db->num_rows($db->query("select * from ".tname('listen')." where in_uid=".$erduo_in_userid));
	$showstr = '<div class="mod_user"><div class="mod_content">';
	$showstr = $showstr.'<div class="mod_user_info">';
	$showstr = $showstr.'<a href="'.getlink($erduo_in_userid).'" target="_blank" class="mod_user_photo"><img src="'.getavatar($erduo_in_userid).'" width="50" height="50"></a>';
	$showstr = $showstr.'<p class="mod_user_name"><a href="'.getlink($erduo_in_userid).'" target="_blank">'.$erduo_in_username.'</a></p>';
	if($erduo_in_grade == 1){
		$showstr = $showstr.'<p onmouseover="$(\'#speed_tips\').show()" onmouseout="$(\'#speed_tips\').hide()"><a href="'.rewrite_mode('user.php/profile/credit/').'" target="_blank"><img src="'.get_template(1).'css/svip.png"></a></p>';
		$showstr = $showstr.'</div>';
		$showstr = $showstr.'<div class="mod_tips" id="speed_tips" style="display: none;"><i class="icon_arrow_top"></i><p><strong>'.($erduo_in_vipgrade == 1 ? '�¸�����' : '�긶����').'</strong><br />�������ʣ <strong>'.floor(DateDiff(date('Y-m-d H:i:s'), $erduo_in_vipenddate) / 3600 / 24).'</strong> ��</p></div>';
	}else{
		$showstr = $showstr.'<p onmouseover="$(\'#speed_tips\').show()" onmouseout="$(\'#speed_tips\').hide()"><a href="'.rewrite_mode('user.php/profile/vip/').'" target="_blank"><img src="'.get_template(1).'css/evip.png"></a></p>';
		$showstr = $showstr.'</div>';
		$showstr = $showstr.'<div class="mod_tips" id="speed_tips" style="display: none;"><i class="icon_arrow_top"></i><p>��ͨ�û�<br />�ۼƿ�ͨ�� <strong>360</strong> ���Զ�ת�긶</p></div>';
	}
	$showstr = $showstr.'<ul class="mod_user_statistic">';
	$showstr = $showstr.'<li><a href="'.rewrite_mode('user.php/music/index/').'" target="_blank"><strong>'.$music.'</strong><span>����</span></a></li>';
	$showstr = $showstr.'<li><a href="'.rewrite_mode('user.php/music/song/').'" target="_blank"><strong>'.$favorites.'</strong><span>�ղ�</span></a></li>';
	$showstr = $showstr.'<li><a href="'.rewrite_mode('user.php/music/song/listen/').'" target="_blank"><strong>'.$listen.'</strong><span>����</span></a></li>';
	$showstr = $showstr.'</ul>';
	$showstr = $showstr.'<div class="normal_info"><p><a href="'.rewrite_mode('user.php/music/add/').'" target="_blank" class="openv_btn">�ϴ�����</a></p></div></div></div>';
}else{
	$showstr = '<div class="mod_login"><a href="'.rewrite_mode('index.php/page/login/').'" class="btn_login">�û���¼</a></div>';
}
	echo $showstr;
?>