<?php
include '../../../system/db.class.php';
include '../../../system/user.php';
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: text/html;charset=".IN_CHARSET);
global $db,$userlogined,$erduo_in_userid,$erduo_in_username;
$ac = SafeRequest("ac","get");
if($ac == 'group'){
        $userlogined or exit("{group:-1}");
        $num = intval(SafeRequest("num","get"));
        $nums = intval(SafeRequest("nums","get"));
        $count = $db->num_rows($db->query("select * from ".tname('message')." where in_uids=0"));
        $start = empty($num) ? $count > $nums ? ($count - $nums) : 0 : $num;
        $end = empty($num) ? $nums : ($count - $num);
        $msg = '';
        $sid = 0;
        $mid = $db->query("select * from ".tname('message')." where in_uids=0 and in_content like '%[event:shake]%' order by in_addtime desc LIMIT 0,1");
        while($row = $db->fetch_array($mid)){
                $sid = $row['in_id'];
        }
        $query = $db->query("select * from ".tname('message')." where in_uids=0 order by in_addtime asc LIMIT ".$start.",".$end);
        while($row = $db->fetch_array($query)){
                $content = preg_replace('/\[emoji:(\d+)]/is', '<img src="'.IN_PATH.'source/plugin/webim/api/emo_\1.gif">', $row['in_content']);
                $content = preg_replace('/\[record:(\d+)]/is', '<embed src="'.IN_PATH.'source/plugin/webim/api/record.swf?url='.IN_PATH.'data/tmp/\1.mp3&autoplay=0" wmode="opaque" width="261" height="23" type="application/x-shockwave-flash">', $content);
                $content = preg_replace('/\[img](.*?)\[\/img]/is', '<img src="\1">', $content);
                $content = preg_replace('/\[flash](.*?)\[\/flash]/is', '<embed src="\1" width="100%" height="100%" allowfullscreen="true" allowscriptaccess="always" wmode="transparent" type="application/x-shockwave-flash">', $content);
                $content = $row['in_id'] == $sid ? preg_replace('/\[event:shake]/is', '<script type="text/javascript">lib.shake(40, 16, "content", 56);</script><img src="'.IN_PATH.'source/plugin/webim/api/shake.png">', $content, 1) : preg_replace('/\[event:shake]/is', '<img src="'.IN_PATH.'source/plugin/webim/api/shake.png">', $content);
                $content = preg_replace('/\[event:shake]/is', '<img src="'.IN_PATH.'source/plugin/webim/api/shake.png">', $content);
                $msg .= '<div class="message clearfix"><div class="user-logo"><img src="'.getavatar($row['in_uid']).'" width="50" height="50"></div><div class="wrap-text"><h5 class="clearfix" style="'.($row['in_uid'] == $erduo_in_userid ? 'color:#369' : 'color:#8EB37D').'">'.$row['in_uname'].'</h5><div style="'.($row['in_uid'] == $erduo_in_userid ? 'background:#2A3651;color:#FFEA76' : 'background:#CDD7E2;color:#252424').'">'.$content.'</div></div><div class="wrap-ri"><div clsss="clearfix"><span>'.$row['in_addtime'].'</span></div></div><div style="clear:both;"></div></div>';
        }
        echo "{group:'".$msg."',num:'".$count."'}";
}elseif($ac == 'start'){
        $userlogined or exit("{start:-1}");
        $type = SafeRequest("type","get");
        $do = SafeRequest("do","get");
        $uid = intval(SafeRequest("uid","get"));
        $sec = intval(SafeRequest("sec","get"));
        $num = $db->num_rows($db->query("select * from ".tname('message')." where in_isread=0 and in_uid=".$uid." and in_uids=".$erduo_in_userid));
        if($type == 'num'){
                $status = getfield('session', 'in_id', 'in_uid', $uid) ? 1 : 0;
                echo "{start:'".$num."',status:".$status."}";
        }elseif($do || $num > 0){
                $msg = '';
                $sid = 0;
                $mid = $db->query("select * from ".tname('message')." where in_isread=0 and in_uid=".$uid." and in_uids=".$erduo_in_userid." and in_content like '%[event:shake]%' order by in_addtime desc LIMIT 0,1");
                while($row = $db->fetch_array($mid)){
                        $sid = $row['in_id'];
                }
                $where = $do == 2 ? 'in_uid='.$uid.' and in_uids='.$erduo_in_userid.' or in_uid='.$erduo_in_userid.' and in_uids='.$uid : 'in_isread=0 and in_uid='.$uid.' and in_uids='.$erduo_in_userid;
                $query = $db->query("select * from ".tname('message')." where ".$where." order by in_addtime asc");
                while($row = $db->fetch_array($query)){
                        $content = preg_replace('/\[emoji:(\d+)]/is', '<img src="'.IN_PATH.'source/plugin/webim/api/emo_\1.gif">', $row['in_content']);
                        $content = preg_replace('/\[record:(\d+)]/is', '<embed src="'.IN_PATH.'source/plugin/webim/api/record.swf?url='.IN_PATH.'data/tmp/\1.mp3&autoplay=0" wmode="opaque" width="261" height="23" type="application/x-shockwave-flash">', $content);
                        $content = preg_replace('/\[img](.*?)\[\/img]/is', '<img src="\1">', $content);
                        $content = preg_replace('/\[flash](.*?)\[\/flash]/is', '<embed src="\1" width="100%" height="100%" allowfullscreen="true" allowscriptaccess="always" wmode="transparent" type="application/x-shockwave-flash">', $content);
                        $content = $row['in_id'] == $sid ? preg_replace('/\[event:shake]/is', '<script type="text/javascript">lib.shake(40, 16, "content", 56);</script><img src="'.IN_PATH.'source/plugin/webim/api/shake.png">', $content, 1) : preg_replace('/\[event:shake]/is', '<img src="'.IN_PATH.'source/plugin/webim/api/shake.png">', $content);
                        $content = preg_replace('/\[event:shake]/is', '<img src="'.IN_PATH.'source/plugin/webim/api/shake.png">', $content);
                        $msg .= '<div class="message clearfix"><div class="user-logo"><img src="'.getavatar($row['in_uid']).'" width="50" height="50"></div><div class="wrap-text"><h5 class="clearfix" style="'.($row['in_uid'] == $erduo_in_userid ? 'color:#369' : 'color:#8EB37D').'">'.$row['in_uname'].'</h5><div style="'.($row['in_uid'] == $erduo_in_userid ? 'background:#2A3651;color:#FFEA76' : 'background:#CDD7E2;color:#252424').'">'.$content.'</div></div><div class="wrap-ri"><div clsss="clearfix"><span>'.$row['in_addtime'].'</span></div></div><div style="clear:both;"></div></div>';
                }
                $me = $db->query("select * from ".tname('message')." where in_uid=".$erduo_in_userid." and in_uids=".$uid." order by in_addtime desc LIMIT 0,1");
                while($row = $db->fetch_array($me)){
                        $content = preg_replace('/\[emoji:(\d+)]/is', '<img src="'.IN_PATH.'source/plugin/webim/api/emo_\1.gif">', $row['in_content']);
                        $content = preg_replace('/\[record:(\d+)]/is', '<embed src="'.IN_PATH.'source/plugin/webim/api/record.swf?url='.IN_PATH.'data/tmp/\1.mp3&autoplay=0" wmode="opaque" width="261" height="23" type="application/x-shockwave-flash">', $content);
                        $content = preg_replace('/\[img](.*?)\[\/img]/is', '<img src="\1">', $content);
                        $content = preg_replace('/\[flash](.*?)\[\/flash]/is', '<embed src="\1" width="100%" height="100%" allowfullscreen="true" allowscriptaccess="always" wmode="transparent" type="application/x-shockwave-flash">', $content);
                        $content = preg_replace('/\[event:shake]/is', '<img src="'.IN_PATH.'source/plugin/webim/api/shake.png">', $content);
                        $msg .= $do == 1 ? '<div class="message clearfix"><div class="user-logo"><img src="'.getavatar($row['in_uid']).'" width="50" height="50"></div><div class="wrap-text"><h5 class="clearfix" style="color:#369">'.$row['in_uname'].'</h5><div style="background:#2A3651;color:#FFEA76">'.$content.'</div></div><div class="wrap-ri"><div clsss="clearfix"><span>'.$row['in_addtime'].'</span></div></div><div style="clear:both;"></div></div>' : '';
                }
                $db->query("update ".tname('message')." set in_isread=1 where in_uid=".$uid." and in_uids=".$erduo_in_userid);
                $db->query("delete from ".tname('message')." where in_uid=".$uid." and in_uids=".$erduo_in_userid." and UNIX_TIMESTAMP(in_addtime)<=".strtotime('-'.$sec.' seconds')." or in_isread=1 and in_uid=".$erduo_in_userid." and in_uids=".$uid." and UNIX_TIMESTAMP(in_addtime)<=".strtotime('-'.$sec.' seconds'));
                echo "{start:'".$msg."'}";
        }else{
                echo "{start:''}";
        }
}elseif($ac == 'list'){
        $uid = SafeRequest("uid","get");
	$str = '<ul>';
	$query = $db->query("select * from ".tname('user')." where in_islock=0 order by in_logintime desc");
	while($row = $db->fetch_array($query)){
		$class = getfield('session', 'in_id', 'in_uid', $row['in_userid']) ? 'online' : 'offline';
		$style = $uid == $row['in_userid'] ? 'color:#369' : 'color:#8EB37D';
		$str .= '<li style="cursor:pointer" id="uid_'.$row['in_userid'].'"><b></b><label class="'.$class.'"></label><img src="'.getavatar($row['in_userid']).'"><span class="chat03_name" style="'.$style.'" uid="'.$row['in_userid'].'">'.$row['in_username'].'</span></li><script type="text/javascript">listenMsg.start('.$row['in_userid'].', "num", 0);</script>';
	}
	echo "{list:'".$str."</ul>'}";
}elseif($ac == 'send'){
        $userlogined or exit("{send:-1}");
        $text = unescape(SafeRequest("text","get"));
        $uname = unescape(SafeRequest("uname","get"));
        $uid = SafeRequest("uid","get");
	$setarr = array(
		'in_uid' => $erduo_in_userid,
		'in_uname' => $erduo_in_username,
		'in_uids' => $uid,
		'in_unames' => $uname,
		'in_content' => preg_replace('/.php\?/i', '', $text),
		'in_isread' => 0,
		'in_addtime' => date('Y-m-d H:i:s')
	);
	inserttable('message', $setarr, 1);
	echo "{send:1}";
}
?>