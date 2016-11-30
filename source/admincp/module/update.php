<?php
if(!defined('IN_ROOT')){exit('Access denied');}
Administrator(6);
$setup=SafeRequest("setup","get");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>">
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>��������</title>
<link href="static/admincp/css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function $(obj) {return document.getElementById(obj);}
var filesize=0;
function setsize(fsize){
        filesize=fsize;
}
function setdown(dlen){
        if(filesize>0){
                var percent=Math.round(dlen*100/filesize);
                document.getElementById("progressbar").style.width=(percent+"%");
                if(percent>0){
                        document.getElementById("progressbar").innerHTML=percent+"%";
                        document.getElementById("progressText").innerHTML="";
                }else{
                        document.getElementById("progressText").innerHTML=percent+"%";
                }
                if(percent>99){
                        document.getElementById("progressbar").innerHTML="���Ե�...";
                        setTimeout("location.href='?iframe=update&setup=replacefile';", 1000);
                }
        }
}
</script>
</head>
<body>
<div class="container">
<script type="text/javascript">parent.document.title = '�������ֻ��� �������� - ��������';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='��������';</script>
<div class="itemtitle"><h3>��������</h3><ul class="tab1" style="margin-right:10px"></ul><ul class="stepstat">
<?php if($setup=="downfile"){echo "<li class=\"current\">";}else{echo "<li>";} ?>1.�����ļ�</li>
<?php if($setup=="replacefile"){echo "<li class=\"current\">";}else{echo "<li>";} ?>2.�����ļ�</li>
<?php if($setup=="changedata"){echo "<li class=\"current\">";}else{echo "<li>";} ?>3.��������</li>
</ul><ul class="tab1"></ul></div>
<table class="tb tb2">
<tr><th class="partition">������ʾ</th></tr>
<tr><td class="tipsblock"><ul>
<li>����ǰ���ȹر�վ�㲢�������ݡ���������ʧ�ܣ�������غ����Ƿ������ļ�Ŀ¼�Ƿ����д��Ȩ�ޣ�</li>
<li>���°��ϴ�ʱ���ܻ�������ػ����������޷���������ǰ���������ز������ֶ����Ǹ��£�</li>
</ul></td></tr>
</table>
<h3>Ear Music ��ʾ</h3>
<?php
switch($setup){
	case 'checkup':
		global $update_api;
		check_up($update_api);
		break;
	case 'downfile':
		down_file();
		break;
	case 'replacefile':
		replace_file();
		break;
	case 'changedata':
		change_data();
		break;
	default:
		start_up();
		break;
	}
?>
</div>
</body>
</html>
<?php
function start_up(){
        echo "<div class=\"infobox\"><br /><p class=\"margintop\"><input type=\"button\" class=\"btn\" value=\"������\" onclick=\"location.href='?iframe=update&setup=checkup';\"></p><br /></div>";
}

function check_up($file){
        $hander_array=get_headers($file);
        if($hander_array[0] == 'HTTP/1.1 200 OK'){
                fwrite(fopen('data/tmp/update.xml', 'w+'), @file_get_contents($file));
		$xml=simplexml_load_file('data/tmp/update.xml');
		$grade=trim($xml->item['grade']);
		$version=trim($xml->item['version']);
		$build=intval(trim($xml->item['build']));
		$log=convert_xmlcharset(trim($xml->log));
                if($grade == 1){
                        if($build > IN_BUILD){
                                echo "<div class=\"infobox\"><br /><h4 class=\"marginbot normal\" style=\"color:#C00\">���ֿ��ø��� [".$version."] [".$build."]<br /><br /><br />".$log."</h4><br /><p class=\"margintop\"><input type=\"button\" class=\"btn\" value=\"��ʼ���ظ���\" onclick=\"location.href='?iframe=update&setup=downfile';\"> &nbsp; <input type=\"button\" class=\"btn\" value=\"ȡ��\" onclick=\"history.go(-1);\"></p><br /></div>";
                        }else{
                                echo "<div class=\"infobox\"><br /><h4 class=\"infotitle2\">�Ѿ������°汾��</h4><br /></div>";
                        }
                }else{
                        echo "<div class=\"infobox\"><br /><h4 class=\"infotitle3\">".detect_encoding(auth_codes('zt63qM2ouf3K2sio0enWpA==', 'de'))."</h4><br /></div>";
                }
        }else{
                echo "<div class=\"infobox\"><br /><p class=\"margintop\"><img src=\"static/admincp/css/loading.gif\" /></p><br /></div>";
        }
}

function down_file(){
        echo "<div class=\"infobox\"><br />";
        echo "<table class=\"tb tb2\" style=\"border:1px solid #09C\">";
        echo "<tr><td><div id=\"progressbar\" style=\"float:left;width:1px;text-align:center;color:#FFFFFF;background-color:#09C\"></div><div id=\"progressText\" style=\"float:left\">0%</div></td></tr>";
        echo "</table>";
        echo "<br /></div>";
        ob_start();
        @set_time_limit(0);
	$xml=simplexml_load_file('data/tmp/update.xml');
	$patch=trim($xml->patch[IN_CHARSET]);
        $file=fopen($patch, 'rb');
        if($file){
                $headers=get_headers($patch, 1);
                if(array_key_exists('Content-Length', $headers)){
                        $filesize=$headers['Content-Length'];
                }else{
                        $filesize=strlen(@file_get_contents($patch));
                }
                echo "<script type=\"text/javascript\">setsize(".$filesize.");</script>";
                $newf=fopen('data/tmp/patch.zip', 'wb');
                $downlen=0;
                if($newf){
                        while(!feof($file)){
                                $data=fread($file, 1024*8);
                                $downlen+=strlen($data);
                                fwrite($newf, $data, 1024*8);
                                echo "<script type=\"text/javascript\">setdown(".$downlen.");</script>";
                                ob_flush();
                                flush();
                        }
                }
                if($file){fclose($file);}
                if($newf){fclose($newf);}
        }
}

function replace_file(){
        include_once 'source/pack/zip/zip.php';
        $unzip="data/tmp/patch.zip";
        if(is_file($unzip)){
                $zip=new PclZip($unzip);
                if(($list=$zip->listContent())==0){
                        exit("<div class=\"infobox\"><br /><h4 class=\"marginbot normal\" style=\"color:#C00\">".$zip->errorInfo(true)."</h4><br /><p class=\"margintop\"><input type=\"button\" class=\"btn\" value=\"��������\" onclick=\"history.back(1);\"></p><br /></div></div></body></html>");
                }
                $zip->extract(PCLZIP_OPT_PATH, IN_ROOT, PCLZIP_OPT_REPLACE_NEWER);
                echo "<div class=\"infobox\"><h4 class=\"infotitle1\">������ʼ�������ݣ����Ժ�......</h4><img src=\"static/admincp/css/loader.gif\" class=\"marginbot\" /></div>";
                echo "<script type=\"text/javascript\">setTimeout(\"location.href='?iframe=update&setup=changedata';\", 1000);</script>";
        }
}

function change_data(){
        @unlink("data/tmp/patch.zip");
	$xml=simplexml_load_file('data/tmp/update.xml');
	$version=trim($xml->item['version']);
	$build=intval(trim($xml->item['build']));
	$config=file_get_contents("source/system/config.inc.php");
	$config=preg_replace("/'IN_VERSION', '(.*?)'/", "'IN_VERSION', '".$version."'", $config);
	$config=preg_replace("/'IN_BUILD', '(.*?)'/", "'IN_BUILD', '".$build."'", $config);
	/******** ����Ƭ�� ********/
	if(preg_match("/date_default_timezone_set\('PRC'\);/", $config)){
	        $config = preg_replace("/date_default_timezone_set\('PRC'\);/", "ini_set('date.timezone', 'PRC');", $config);
	}elseif(!preg_match("/ini_set\('date.timezone', 'PRC'\);/", $config)){
	        $top = "ini_set('date.timezone', 'PRC');\r\n";
	        $top = $top."define('IN_ROOT'";
	        $middle = "define('IN_REMOTEPK', '".IN_REMOTE."');\r\n";
	        $middle = $middle."define('IN_REMOTEBK'";
	        $bottom = "define('IN_REMOTEHOST', '');\r\n";
	        $bottom = $bottom."define('IN_REMOTEPORT', '21');\r\n";
	        $bottom = $bottom."define('IN_REMOTEUSER', '');\r\n";
	        $bottom = $bottom."define('IN_REMOTEPW', '');\r\n";
	        $bottom = $bottom."define('IN_REMOTEPASV', '0');\r\n";
	        $bottom = $bottom."define('IN_REMOTEDIR', '.');\r\n";
	        $bottom = $bottom."define('IN_REMOTEURL', '');\r\n";
	        $bottom = $bottom."define('IN_REMOTEOUT', '300');\r\n";
	        $bottom = $bottom."define('IN_ALIPAYID'";
	        $config = preg_replace("/define\('IN_ROOT'/", $top, $config);
	        $config = preg_replace("/define\('IN_REMOTEBK'/", $middle, $config);
	        $config = preg_replace("/define\('IN_ALIPAYID'/", $bottom, $config);
	        $config = preg_replace("/'IN_REMOTE', '(.*?)'/", "'IN_REMOTE', '1'", $config);
	}
	if(!preg_match("/ini_set\('default_charset', '".IN_CHARSET."'\);/", $config)){
	        $replace = "ini_set('default_charset', '".IN_CHARSET."');\r\n";
	        $replace = $replace."define('IN_ROOT'";
	        $config = preg_replace("/define\('IN_ROOT'/", $replace, $config);
	}
	if(!preg_match("/define\('IN_UPMP3KBPS'/", $config)){
	        $replace = "define('IN_UPMP3KBPS', '0');\r\n";
	        $replace = $replace."define('IN_UPMUSICSIZE'";
	        $config = preg_replace("/define\('IN_UPMUSICSIZE'/", $replace, $config);
	}
	if(!preg_match("/define\('IN_SIGNDAYPOINTS'/", $config)){
	        $replace = "define('IN_SIGNDAYPOINTS', '5');\r\n";
	        $replace = $replace."define('IN_SIGNDAYRANK', '5');\r\n";
	        $replace = $replace."define('IN_SIGNVIPOPEN', '1');\r\n";
	        $replace = $replace."define('IN_AVATARPOINTS'";
	        $config = preg_replace("/define\('IN_AVATARPOINTS'/", $replace, $config);
	        mysql_query("ALTER TABLE `".IN_DBTABLE."user` ADD `in_sign` int(11) NOT NULL");
	        mysql_query("ALTER TABLE `".IN_DBTABLE."user` ADD `in_signtime` datetime DEFAULT NULL");
	}
	/******** ������� ********/
	$ifile=new iFile('source/system/config.inc.php', 'w');
	$ifile->WriteFile($config, 3);
        echo "<div class=\"infobox\"><br /><h4 class=\"infotitle2\">��ϲ��Ear Music ˳��������ɣ�</h4><br /><p class=\"margintop\"><input type=\"button\" class=\"btn\" value=\"���\" onclick=\"parent.location.href='?iframe=index';\"></p><br /></div>";
}
?>