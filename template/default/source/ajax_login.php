<?php
include '../../../source/system/db.class.php';
include '../../../source/system/user.php';
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: text/html;charset=".IN_CHARSET);
global $userlogined,$erduo_in_userid,$erduo_in_username,$erduo_in_grade,$erduo_in_vipgrade;
if($userlogined){
	if($erduo_in_grade == 1){
		$showstr = '<li class="nav_musicvip"><span class="musicvip_text"><img src="'.get_template(1).'css/svipe.png"><a href="'.rewrite_mode('user.php/profile/credit/').'" target="_blank"><span>'.($erduo_in_vipgrade == 1 ? '�¸�����' : '�긶����').'</span></a></span></li>';
		$showstr = $showstr.'<li class="nav_musicbag"><span class="line">&nbsp;</span><span class="musicbag_text"><a><img src="'.get_template(1).'css/sui.png"><span>��ֵ���</span></a></span><a href="'.rewrite_mode('user.php/profile/pay/').'" target="_blank" class="btn_open_musicbag">��ֵ</a></li>';
		$showstr = $showstr.'<li class="nav_software"><span class="line">&nbsp;</span><a href="'.rewrite_mode('user.php/profile/index/').'" target="_blank"><span>��������</span></a></li>';
		$showstr = $showstr.'<li class="mod_user"><p class="top_info logined"><span onclick="window.open(\''.getlink($erduo_in_userid).'\');">'.$erduo_in_username.'</span><a class="exit" href="javascript:void(0)" onclick="logout();">�˳�</a></p></li>';
	}else{
		$showstr = '<li class="nav_musicvip"><span class="musicvip_text"><img src="'.get_template(1).'css/svip.png"><a><span>��ͨ����</span></a></span><a href="'.rewrite_mode('user.php/profile/vip/').'" target="_blank" class="btn_open_vip">��ͨ</a></li>';
		$showstr = $showstr.'<li class="nav_musicbag"><span class="line">&nbsp;</span><span class="musicbag_text"><a><img src="'.get_template(1).'css/sui.png"><span>��ֵ���</span></a></span><a href="'.rewrite_mode('user.php/profile/pay/').'" target="_blank" class="btn_open_musicbag">��ֵ</a></li>';
		$showstr = $showstr.'<li class="nav_software"><span class="line">&nbsp;</span><a href="'.rewrite_mode('user.php/profile/index/').'" target="_blank"><span>��������</span></a></li>';
		$showstr = $showstr.'<li class="mod_user"><p class="top_info logined"><span onclick="window.open(\''.getlink($erduo_in_userid).'\');">'.$erduo_in_username.'</span><a class="exit" href="javascript:void(0)" onclick="logout();">�˳�</a></p></li>';
	}
}else{
	$showstr = '<li class="mod_user"><p class="top_info unlogined">����δ��¼��<a href="'.rewrite_mode('index.php/page/login/').'">���ϵ�¼</a></p></li>';
	$showstr = $showstr.'<li class="nav_musicbag"><span class="line">&nbsp;</span><span class="musicbag_text"><a href="'.rewrite_mode('index.php/page/register/').'"><span>ע���ʺ�</span></a></span></li>';
}
	echo $showstr;
?>