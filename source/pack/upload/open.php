<?php
include '../../system/db.class.php';
include '../../system/user.php';
global $db,$userlogined,$erduo_in_userid,$erduo_in_username;
if(SafeRequest("mode","get")==1){
	if(!$userlogined){
		exit(iframe_message("���ȵ�¼�û����ģ�"));
	}
        $uid=$erduo_in_userid;
        $uname=base64_encode($erduo_in_username);
}else{
	if(empty($_COOKIE['in_adminid']) || empty($_COOKIE['in_adminname']) || empty($_COOKIE['in_adminpassword']) || empty($_COOKIE['in_permission']) || empty($_COOKIE['in_adminexpire']) || !getfield('admin', 'in_adminid', 'in_adminid', intval($_COOKIE['in_adminid'])) || md5(getfield('admin', 'in_adminpassword', 'in_adminid', intval($_COOKIE['in_adminid'])))!==$_COOKIE['in_adminpassword']){
		exit(iframe_message("���ȵ�¼�������ģ�"));
	}
        $uid=0;
        $uname=base64_encode('ϵͳ�û�');
}
if(IN_UPOPEN==1){
        $script="uplog.php";
        $data="'type':'".$_GET['type']."','uid':'".$uid."','uname':'".$uname."'";
}elseif(IN_REMOTE==1){
	$row=$db->getrow("select * from ".tname('plugin')." where in_type=3 and in_dir='".IN_REMOTEPK."'");
        $script="../../plugin/".IN_REMOTEPK."/".$row['in_file'].".php";
        $data="'time':'".$_SERVER['HTTP_HOST'].".".date('YmdHis').rand(2,pow(2,24))."'";
        if(!is_file($script)){
                $script="uplog.php";
                $data="'type':'".$_GET['type']."','uid':'".$uid."','uname':'".$uname."'";
        }
}else{
        $script="../ftp/uplog.php";
        $data="'t':'".$_GET['type']."','time':'".date('YmdHis').rand(2,pow(2,24))."'";
}
switch($_GET['type']){
	case 'music_audio':
		$ext=IN_UPOPEN==1 ? IN_UPMUSICEXT : "*.*";
		$size=IN_UPOPEN==0 ? @ini_get('file_uploads') ? intval(ini_get('upload_max_filesize')) : 200 : IN_UPMUSICSIZE;
		$desc=IN_UPOPEN==1 ? "��ѡ��".IN_UPMUSICEXT."�ļ�" : "All Files";
		break;
	case 'music_lyric':
		$ext="*.lrc";
		$size=1;
		$desc="��ѡ��".$ext."�ļ�";
		break;
	case 'music_cover':
		$ext="*.jpg;*.jpeg;*.gif;*.png";
		$size=2;
		$desc="��ѡ��".$ext."�ļ�";
		break;
	case 'special_cover':
		$ext="*.jpg;*.jpeg;*.gif;*.png";
		$size=2;
		$desc="��ѡ��".$ext."�ļ�";
		break;
	case 'singer_cover':
		$ext="*.jpg;*.jpeg;*.gif;*.png";
		$size=2;
		$desc="��ѡ��".$ext."�ļ�";
		break;
	case 'video_play':
		$ext=IN_UPOPEN==1 ? IN_UPVIDEOEXT : "*.*";
		$size=IN_UPOPEN==0 ? @ini_get('file_uploads') ? intval(ini_get('upload_max_filesize')) : 200 : IN_UPVIDEOSIZE;
		$desc=IN_UPOPEN==1 ? "��ѡ��".IN_UPVIDEOEXT."�ļ�" : "All Files";
		break;
	case 'video_cover':
		$ext="*.jpg;*.jpeg;*.gif;*.png";
		$size=2;
		$desc="��ѡ��".$ext."�ļ�";
		break;
	case 'link_cover':
		$ext="*.jpg;*.jpeg;*.gif;*.png";
		$size=2;
		$desc="��ѡ��".$ext."�ļ�";
		break;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<title>�ļ��ϴ�</title>
<link href="../../../static/pack/upload/uploadify.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../../static/pack/upload/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="../../../static/pack/upload/swfobject.js"></script>
<script type="text/javascript" src="../../../static/pack/upload/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("#uploadify").uploadify({
		'uploader' : '../../../static/pack/upload/uploadify.swf',
		'script' : '<?php echo $script; ?>',
		'cancelImg' : '../../../static/pack/upload/cancel.png',
		'folder' : 'UploadFile',
		'method' : 'GET',
		'scriptData' : {<?php echo $data; ?>},
		'buttonText' : 'Upload',
		'buttonImg' : '../../../static/pack/upload/up.png',
		'width' : '110',
		'height' : '30',
		'queueID' : 'fileQueue',
		'auto' : true,
		'multi' : false,
		'fileExt' : '<?php echo $ext; ?>',
		'fileDesc' : '<?php echo $desc; ?>',
		'sizeLimit' : <?php echo ($size*1024*1024); ?>,
		'onError' : function (a, b, c, d) {
			if (d.status == 404){
				ReturnError("�ϴ��쳣�������ԣ�");
			}else if (d.type === "HTTP"){
				ReturnError("error "+d.type+" : "+d.status);
			}else if (d.type === "File Size"){
				ReturnError("�ϴ�ʧ�ܣ���С���ܳ���<?php echo $size; ?>MB��");
			}else{
				ReturnError("error "+d.type+" : "+d.text);
			}
		},
		'onComplete' : function (event, queueID, fileObj, response, data) {
			if (response == 0){
				ReturnError("�ϴ����������ԣ�");
			}else if (response == -1){
				ReturnError("�ϴ�ʧ�ܣ����ʲ��ܵ���<?php echo IN_UPMP3KBPS; ?>Kbps��");
			}else{
				ReturnValue(response);
			}
		}
	});
});
</script>
<script type="text/javascript">
function ReturnValue(reimg){
	this.parent.document.<?php echo $_GET['form']; ?>.value=reimg;
	this.parent.asyncbox.tips("��ϲ���ļ��ϴ��ɹ���", "success", 1000);
	this.parent.layer.closeAll();
}
function ReturnError(msg){
	this.parent.asyncbox.tips(msg, "error", 3000);
	this.parent.layer.closeAll();
}
</script>
</head>
<body>
<div id="fileQueue"></div>
<input type="file" name="uploadify" id="uploadify" />
</body>
</html>