<?php
include '../../system/db.class.php';
include '../../system/user.php';
global $db,$userlogined,$erduo_in_userid,$erduo_in_userpassword;
$userid = $userlogined ? $erduo_in_userid : 0;
$userpassword = $userlogined ? $erduo_in_userpassword : NULL;
$in_userid = isset($_POST['uid']) ? intval($_POST['uid']) : 0;
$in_userpassword = isset($_POST['hash']) ? SafeSql($_POST['hash']) : NULL;
if($db->getone("select in_userid from ".tname('user')." where in_islock=0 and in_userid=".$in_userid." and in_userpassword='".$in_userpassword."'")){
	$uid = $in_userid;
}else{
	$uid = 0;
}
if($uid && !empty($_FILES) && $_POST['uid']){
	$uname = $db->getone("select in_username from ".tname('user')." where in_userid=".$uid);
	preg_match("/^new\:(.+)$/i", $_POST['albumid'], $matchs);
	if(!empty($matchs[1])){
		$albumname = convert_xmlcharset(trim($matchs[1]));
		$albumname = empty($albumname) ? date('Ymd') : SafeSql($albumname);
		if(!$db->getone("select in_id from ".tname('photo_group')." where in_title='".$albumname."' and in_uid=".$uid)){
		        $setarr = array(
			        'in_pid' => 0,
			        'in_title' => $albumname,
			        'in_uid' => $uid,
			        'in_uname' => $uname
		        );
		        inserttable('photo_group', $setarr, 1);
		}
		$albumid = $db->getone("select in_id from ".tname('photo_group')." where in_title='".$albumname."' and in_uid=".$uid);
	}else{
		$albumid = intval($_POST['albumid']);
		if(!$db->getone("select in_id from ".tname('photo_group')." where in_uid=".$uid." and in_id=".$albumid)){
			$albumname = date('Ymd');
			if(!$db->getone("select in_id from ".tname('photo_group')." where in_title='".$albumname."' and in_uid=".$uid)){
		                $setarr = array(
			                'in_pid' => 0,
			                'in_title' => $albumname,
			                'in_uid' => $uid,
			                'in_uname' => $uname
		                );
		                inserttable('photo_group', $setarr, 1);
			}
			$albumid = $db->getone("select in_id from ".tname('photo_group')." where in_title='".$albumname."' and in_uid=".$uid);
		}
	}
        $filepart = pathinfo($_FILES['Filedata']['name']);
        $filearray = array('jpg', 'jpeg', 'gif', 'png');
        if(!$_FILES['Filedata']['error'] && in_array(strtolower($filepart['extension']), $filearray)){
	        $dir = '../../../data/attachment/photo/';
	        creatdir($dir);
	        $tmp_name = $_FILES['Filedata']['tmp_name'];
	        $new_name = $dir.$uid.'.'.date('YmdHis').rand(2,pow(2,24)).".".fileext($_FILES['Filedata']['name']);
	        move_uploaded_file($tmp_name, $new_name);
		$setarr = array(
			'in_gid' => $albumid,
			'in_uid' => $uid,
			'in_uname' => $uname,
			'in_title' => SafeSql(convert_xmlcharset(trim(urldecode($_POST['title'])))),
			'in_url' => str_replace('../../../', '', $new_name),
			'in_hits' => 0,
			'in_egg' => 0,
			'in_flower' => 0,
			'in_scary' => 0,
			'in_cool' => 0,
			'in_beautiful' => 0,
			'in_addtime' => date('Y-m-d H:i:s')
		);
		inserttable('photo', $setarr, 1);
	        $groupid = $setarr['in_gid'];
        }
}
@header("Expires: -1");
@header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0", FALSE);
@header("Pragma: no-cache");
@header("Content-type: application/xml;charset=".IN_CHARSET);
echo '<?xml version="1.0" encoding="utf-8" ?>';
?>
<?php if(isset($groupid)): ?>
<uploadResponse>
	<status>success</status>
	<albumid><?php echo $groupid; ?></albumid>
</uploadResponse>
<?php else: ?>
<parameter>
	<allowsExtend>
		<extend depict="All Image File(*.jpg,*.jpeg,*.gif,*.png)">*.jpg,*.gif,*.png,*.jpeg</extend>
	</allowsExtend>
	<language>
		<create><?php echo convert_xmlcharset('����', 2); ?></create>
		<notCreate><?php echo convert_xmlcharset('ȡ��', 2); ?></notCreate>
		<albumName><?php echo convert_xmlcharset('�����', 2); ?></albumName>
		<createTitle><?php echo convert_xmlcharset('���������', 2); ?></createTitle>
		<okbtn><?php echo convert_xmlcharset('����', 2); ?></okbtn>
		<cancelbtn><?php echo convert_xmlcharset('�鿴', 2); ?></cancelbtn>
		<fileName><?php echo convert_xmlcharset('�ļ���', 2); ?></fileName>
		<depict><?php echo convert_xmlcharset('����(�����޸�)', 2); ?></depict>
		<size><?php echo convert_xmlcharset('�ļ���С', 2); ?></size>
		<stat><?php echo convert_xmlcharset('�ϴ�����', 2); ?></stat>
		<aimAlbum><?php echo convert_xmlcharset('�ϴ���:', 2); ?></aimAlbum>
		<browser><?php echo convert_xmlcharset('���', 2); ?></browser>
		<delete><?php echo convert_xmlcharset('ɾ��', 2); ?></delete>
		<upload><?php echo convert_xmlcharset('�ϴ�', 2); ?></upload>
		<okTitle><?php echo convert_xmlcharset('�ϴ����', 2); ?></okTitle>
		<okMsg><?php echo convert_xmlcharset('�����ļ��ϴ����!', 2); ?></okMsg>
		<uploadTitle><?php echo convert_xmlcharset('�����ϴ�', 2); ?></uploadTitle>
		<uploadMsg1><?php echo convert_xmlcharset('�ܹ���', 2); ?></uploadMsg1>
		<uploadMsg2><?php echo convert_xmlcharset('���ļ��ȴ��ϴ�,�����ϴ���', 2); ?></uploadMsg2>
		<uploadMsg3><?php echo convert_xmlcharset('���ļ�', 2); ?></uploadMsg3>
		<bigFile><?php echo convert_xmlcharset('�ļ�����', 2); ?></bigFile>
		<uploaderror><?php echo convert_xmlcharset('�ϴ�ʧ��', 2); ?></uploaderror>
	</language>
	<config>
		<userid><?php echo $userid; ?></userid>
		<hash><?php echo $userpassword; ?></hash>
		<maxupload>2097152</maxupload>
	</config>
	<albums>
<?php
	$group = '<album id="-1">'.convert_xmlcharset('��ѡ�����', 2).'</album>';
	$query = $db->query("select in_id,in_title from ".tname('photo_group')." where in_uid=".$userid);
	while ($row = $db->fetch_array($query)) {
		$group .= '<album id="'.$row['in_id'].'">'.convert_xmlcharset($row['in_title'], 2).'</album>';
	}
	echo $group.'<album id="add">'.convert_xmlcharset('+�½����', 2).'</album>';
?>
	</albums>
</parameter>
<?php endif; ?>