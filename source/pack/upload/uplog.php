<?php
include '../../system/db.class.php';
switch($_GET['type']){
	case 'music_audio':
		$dir="../../../data/tmp/";
		creatdir($dir);
		$file=$dir.date('YmdHis').rand(2,pow(2,24)).".".fileext($_FILES['Filedata']['name']);
		$ext=IN_UPMUSICEXT;
		$text="��Ƶ�ļ�";
		break;
	case 'music_lyric':
		$dir="../../../data/tmp/";
		creatdir($dir);
		$file=$dir.date('YmdHis').rand(2,pow(2,24)).".".fileext($_FILES['Filedata']['name']);
		$ext="*.lrc";
		$text="����ļ�";
		break;
	case 'music_cover':
		$dir="../../../data/tmp/";
		creatdir($dir);
		$file=$dir.date('YmdHis').rand(2,pow(2,24)).".".fileext($_FILES['Filedata']['name']);
		$ext="*.jpg;*.jpeg;*.gif;*.png";
		$text="���ַ���";
		break;
	case 'special_cover':
		$dir="../../../data/tmp/";
		creatdir($dir);
		$file=$dir.date('YmdHis').rand(2,pow(2,24)).".".fileext($_FILES['Filedata']['name']);
		$ext="*.jpg;*.jpeg;*.gif;*.png";
		$text="ר������";
		break;
	case 'singer_cover':
		$dir="../../../data/tmp/";
		creatdir($dir);
		$file=$dir.date('YmdHis').rand(2,pow(2,24)).".".fileext($_FILES['Filedata']['name']);
		$ext="*.jpg;*.jpeg;*.gif;*.png";
		$text="���ַ���";
		break;
	case 'video_play':
		$dir="../../../data/tmp/";
		creatdir($dir);
		$file=$dir.date('YmdHis').rand(2,pow(2,24)).".".fileext($_FILES['Filedata']['name']);
		$ext=IN_UPVIDEOEXT;
		$text="��Ƶ�ļ�";
		break;
	case 'video_cover':
		$dir="../../../data/tmp/";
		creatdir($dir);
		$file=$dir.date('YmdHis').rand(2,pow(2,24)).".".fileext($_FILES['Filedata']['name']);
		$ext="*.jpg;*.jpeg;*.gif;*.png";
		$text="��Ƶ����";
		break;
	case 'link_cover':
		$dir="../../../data/tmp/";
		creatdir($dir);
		$file=$dir.date('YmdHis').rand(2,pow(2,24)).".".fileext($_FILES['Filedata']['name']);
		$ext="*.jpg;*.jpeg;*.gif;*.png";
		$text="����ͼƬ";
		break;
}
if(!empty($_FILES)){
	$fileext=str_replace(array('*.', ';'), array('', '|'), $ext);
	$filearray=preg_split('/\|/', $fileext);
	$filepart=pathinfo($_FILES['Filedata']['name']);
	if(in_array(strtolower($filepart['extension']), $filearray)){
		move_uploaded_file($_FILES['Filedata']['tmp_name'], $file);
		if(substr($file, -3) == 'mp3' && IN_UPMP3KBPS > 0){
			include_once '../mp3/class.mp3.php';
			$Kbps = @MP3::Bitrate($file);
			if($Kbps < IN_UPMP3KBPS){
				@unlink($file);
				exit('-1');
			}
		}
		$setarr = array(
			'in_uid' => SafeRequest("uid","get"),
			'in_uname' => SafeSql(base64_decode(SafeRequest("uname","get"))),
			'in_title' => str_replace($dir, '', $file),
			'in_type' => $text,
			'in_size' => $_FILES['Filedata']['size'],
			'in_url' => str_replace('../../../', '', $file),
			'in_addtime' => date('Y-m-d H:i:s')
		);
		inserttable('uplog', $setarr, 1);
		echo str_replace('../../../', '', $file);
	}else{
	 	echo '0';
	}
}
?>