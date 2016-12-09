<?php
include '../../../../source/system/db.class.php';
include '../../../../source/system/user.php';
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: text/html;charset=".IN_CHARSET);
close_browse();
global $db,$userlogined,$erduo_in_userid,$erduo_in_username;
$type = SafeRequest("type","get");
if($type == 'getfav'){
	$id = intval(SafeRequest("id","get"));
	if($userlogined){
		echo '<div class="operate operate--right">
			<a class="operate__item" href="javascript:$(\'.actionsheet\').css(\'-webkit-transform\', \'translateY(0px)\')">
				<i class="icon_bgmusic icon_bgmusic--active">�ղض���</i>
			</a>
			<a class="operate__item" href="javascript:putfav()">';
			if($db->getone("select in_id from ".tname('favorites')." where in_uid=".$erduo_in_userid." and in_mid=".$id)){
			        echo '<i class="icon_like icon_like--active">���ղ�</i>';
			}else{
			        echo '<i class="icon_like">�ղ�</i>';
			}
			echo '</a>
		</div>
		<div class="actionsheet" style="transform: translateY(0px);">
			<div class="mod_list_box">
				<h6 class="list_box__tit">�ղض���<span class="list_box__count">('.$db->num_rows($db->query("select * from ".tname('favorites')." where in_uid=".$erduo_in_userid)).'��)</span></h6>
				<div class="list_box__cont">
					<ul class="mod_play_list" style="transition-property: -webkit-transform; transform-origin: 0px 0px 0px; transition-timing-function: cubic-bezier(0.33, 0.66, 0.66, 1); transform: translate3d(0px, 0px, 0px);">';
					$query = $db->query("select * from ".tname('favorites')." where in_uid=".$erduo_in_userid);
					while($row = $db->fetch_array($query)){
					        if($row['in_mid'] == $id){
						        echo '<li class="play_list__item--current" onclick="location.href=\''.getlink($row['in_mid'], 'music').'\'"><span class="play_list__song ">'.getfield('music', 'in_name', 'in_id', $row['in_mid']).'</span><b class="play_list__line">-</b><span class="play_list__singer">'.getfield('singer', 'in_name', 'in_id', getfield('music', 'in_singerid', 'in_id', $row['in_mid']), 'δ֪����').'</span><span class="ani_playing"><b><i></i><i></i><i></i><i></i></b></span></li>';
					        }else{
						        echo '<li onclick="location.href=\''.getlink($row['in_mid'], 'music').'\'"><span class="play_list__song ">'.getfield('music', 'in_name', 'in_id', $row['in_mid']).'</span><b class="play_list__line">-</b><span class="play_list__singer">'.getfield('singer', 'in_name', 'in_id', getfield('music', 'in_singerid', 'in_id', $row['in_mid']), 'δ֪����').'</span></li>';
					        }
					}
					echo '</ul>
				</div>
				<a class="list_box__close" href="javascript:$(\'.actionsheet\').css(\'-webkit-transform\', \'translateY(380px)\')">�ر�</a>
			</div>
		</div>';
	}else{
		echo '<div class="operate operate--right">
			<a class="operate__item" href="javascript:$(\'.mod_dialog\').show()">
				<i class="icon_bgmusic">�ղض���</i>
			</a>
			<a class="operate__item" href="javascript:$(\'.mod_dialog\').show()">
				<i class="icon_like">�ղ�</i>
			</a>
		</div>
		<div class="mod_dialog">
			<div class="dialog_mask">
				<div class="dialog_body">
					<h3 class="dialog_tit">��ܰ����</h3>
					<div class="dialog_cont">
						<p class="dialog_txt">
							����Ҫ�ȵ�¼!
						</p>
					</div>
					<div class="dialog_operate">
						<a class="dialog_btn dialog_btn_strong" href="javascript:$(\'.mod_dialog\').hide()"><span>ȡ��</span></a><a class="dialog_btn dialog_btn_strong" href="javascript:location.href=\''.rewrite_mode('index.php/page/login/').'\'"><span>ȷ��</span></a>
					</div>
				</div>
			</div>
		</div>';
	}
}elseif($type == 'putfav'){
	$id = intval(SafeRequest("id","get"));
	$userlogined or exit('0');
	if(!$db->getone("select in_id from ".tname('music')." where in_id=".$id)){
		echo '-2';
	}else{
		if($fid = $db->getone("select in_id from ".tname('favorites')." where in_uid=".$erduo_in_userid." and in_mid=".$id)){
			$db->query("delete from ".tname('favorites')." where in_id=".$fid);
			echo '-1';
		}else{
			$setarr = array(
			        'in_uid' => $erduo_in_userid,
			        'in_uname' => $erduo_in_username,
			        'in_mid' => $id,
			        'in_addtime' => date('Y-m-d H:i:s')
			);
			inserttable('favorites', $setarr, 1);
			$db->query("update ".tname('music')." set in_favhits=in_favhits+1 where in_id=".$id);
			echo '1';
		}
	}
}elseif($type == 'jplayer'){
        $ids = SafeRequest("ids","get");
        $str = '[';
        $query = $db->query("select * from ".tname('music')." where in_id in (".SafeSql($ids, 1).") order by in_addtime desc");
        while($row = $db->fetch_array($query)){
	        $str .= '{"song_name":"'.getlenth($row['in_name'], 8).'","song_path":"'.geturl($row['in_audio']).'"},';
        }
        echo str_replace(',]', ']', $str.']');
}else{
        $id = SafeRequest("id","get");
        $audio = geturl(getfield('music', 'in_audio', 'in_id', $id));
        $lyric = geturl(getfield('music', 'in_lyric', 'in_id', $id), 'lyric');
        preg_match_all("/\[(\d{2}):(\d{2}).\d{2}\](.*\n|.*)/", @file_get_contents($lyric), $arr);
        if(!empty($arr)){
		$lrc = 'lrclist:[';
		for($i = 0; $i < count($arr[0]); $i++){
			$timeId = intval($arr[1][$i]) * 60 + intval($arr[2][$i]) + 1;
			$text = trim(detect_encoding($arr[3][$i]));
			$lrc .= !empty($text) ? "{'timeId':'".$timeId."','text':'".$text."'}," : "";
		}
		$lrc = str_replace(',]', ']', $lrc.']');
        }else{
		$lrc = "lrclist:[]";
        }
        echo "{audio:['".$audio."'],".$lrc."}";
}
?>