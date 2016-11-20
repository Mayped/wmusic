<?php
include '../../system/db.class.php';
include '../../system/user.php';
require_once 'conf.inc.php';
require_once 'sdk.class.php';
global $db,$userlogined,$erduo_in_userid,$erduo_in_username;
$src = preg_match('/^data\/tmp/', $_GET['path']) ? IN_ROOT.str_replace('../', '', $_GET['path']) : NULL;
if($userlogined){
	$oss_sdk_service = new ALIOSS();
	$object = $_SERVER['HTTP_HOST'].'.'.date('YmdHis').rand(2,pow(2,24)).'.jpg';
	$content = '';
	$length = 0;
	$fp = fopen($src, 'r');
	if($fp){
		$f = fstat($fp);
		$length = $f['size'];
		while(!feof($fp)){
			$content .= fgets($fp);
		}
	}
	fclose($fp);
	$upload_file_options = array('content' => $content, 'length' => $length);
	$upload_file_by_content = $oss_sdk_service->upload_file_by_content(OSS_BUCKET, $object, $upload_file_options);
	$url = OSS_DLINK.OSS_BUCKET.'/'.$object;
	@unlink($src);
	$albumid = intval($_COOKIE['in_oss_doodle_albumid']);
	if(!$db->getone("select in_id from ".tname('photo_group')." where in_uid=".$erduo_in_userid." and in_id=".$albumid)){
		$albumname = date('Ymd');
		if(!$db->getone("select in_id from ".tname('photo_group')." where in_title='".$albumname."' and in_uid=".$erduo_in_userid)){
			$setarr = array(
			        'in_pid' => 0,
			        'in_title' => $albumname,
			        'in_uid' => $erduo_in_userid,
			        'in_uname' => $erduo_in_username
			);
			inserttable('photo_group', $setarr, 1);
		}
		$albumid = $db->getone("select in_id from ".tname('photo_group')." where in_title='".$albumname."' and in_uid=".$erduo_in_userid);
	}
	$setarr = array(
		'in_gid' => $albumid,
		'in_uid' => $erduo_in_userid,
		'in_uname' => $erduo_in_username,
		'in_title' => 'doodle',
		'in_url' => $url,
		'in_hits' => 0,
		'in_egg' => 0,
		'in_flower' => 0,
		'in_scary' => 0,
		'in_cool' => 0,
		'in_beautiful' => 0,
		'in_addtime' => date('Y-m-d H:i:s')
	);
	inserttable('photo', $setarr, 1);
	echo $url;
}
?>