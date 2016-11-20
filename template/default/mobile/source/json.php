<?php
include '../../../../source/system/db.class.php';
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: text/html;charset=".IN_CHARSET);
close_browse();
$type = SafeRequest("type","get");
if($type == 'jplayer'){
        global $db;
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