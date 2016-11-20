<?php
include 'source/system/config.inc.php';
include 'source/system/function_common.php';

$step = empty($_GET['step']) ? 0 : intval($_GET['step']);
$version = IN_VERSION;
$charset = strtoupper(IN_CHARSET);
$build = IN_BUILD;
$year = date('Y');

$lock = IN_ROOT.'./data/install.txt';
if(file_exists($lock)) {
	show_msg('���棡���Ѿ���װ��Ear Music��<br>Ϊ�˱�֤���ݰ�ȫ��������ɾ��{install.php}�ļ���<br>����������°�װEar Music����ɾ��{data/install.txt}�ļ���', 999);
}
$sql = IN_ROOT.'./static/install/table.sql';
if(!file_exists($sql)) {
	show_msg('ȱ��{static/install/table.sql}���ݿ�ṹ�ļ������飡', 999);
}
$config = IN_ROOT.'./source/system/config.inc.php';
if(!@$fp = fopen($config, 'a')) {
	show_msg('�ļ�{source/system/config.inc.php}��дȨ�����ô�����������Ϊ��д��', 999);
} else {
	@fclose($fp);
}

if(empty($step)) {
	$phpos = PHP_OS;
	$phpversion = PHP_VERSION;
	$attachmentupload = @ini_get('file_uploads') ? '<td class="w pdleft1">'.ini_get('upload_max_filesize').'</td>' : '<td class="nw pdleft1">unknow</td>';
	if(function_exists('disk_free_space')) {
		$diskspace = '<td class="w pdleft1">'.floor(disk_free_space(IN_ROOT) / (1024*1024)).'M</td>';
	} else {
		$diskspace = '<td class="nw pdleft1">unknow</td>';
	}
	$checkok = true;
	$perms = array();
	if(!checkfdperm(IN_ROOT.'./client/ucenter.php', 1)) {
		$perms['ucenter'] = '<td class="nw pdleft1">����д</td>';
		$checkok = false;
	} else {
		$perms['ucenter'] = '<td class="w pdleft1">��д</td>';
	}
	if(!checkfdperm(IN_ROOT.'./client/data/')) {
		$perms['ucdata'] = '<td class="nw pdleft1">����д</td>';
		$checkok = false;
	} else {
		$perms['ucdata'] = '<td class="w pdleft1">��д</td>';
	}
	if(!checkfdperm(IN_ROOT.'./data/')) {
		$perms['data'] = '<td class="nw pdleft1">����д</td>';
		$checkok = false;
	} else {
		$perms['data'] = '<td class="w pdleft1">��д</td>';
	}
	if(!checkfdperm(IN_ROOT.'./source/system/config.inc.php', 1)) {
		$perms['config'] = '<td class="nw pdleft1">����д</td>';
		$checkok = false;
	} else {
		$perms['config'] = '<td class="w pdleft1">��д</td>';
	}
	if(!checkfdperm(IN_ROOT.'./source/plugin/')) {
		$perms['plugin'] = '<td class="nw pdleft1">����д</td>';
		$checkok = false;
	} else {
		$perms['plugin'] = '<td class="w pdleft1">��д</td>';
	}
	if(!checkfdperm(IN_ROOT.'./template/')) {
		$perms['template'] = '<td class="nw pdleft1">����д</td>';
		$checkok = false;
	} else {
		$perms['template'] = '<td class="w pdleft1">��д</td>';
	}
	$check_mysql_connect = function_exists('mysql_connect') ? '<td class="w pdleft1">֧��</td>' : '<td class="nw pdleft1">��֧��</td>';
	$check_file_get_contents = function_exists('file_get_contents') ? '<td class="w pdleft1">֧��</td>' : '<td class="nw pdleft1">��֧��</td>';
	show_header();
	print<<<END
	<div class="setup step1">
	<h2>��ʼ��װ</h2>
	<p>�����Լ��ļ�Ŀ¼Ȩ�޼��</p>
	</div>
	<div class="stepstat">
	<ul>
	<li class="current">��鰲װ����</li>
	<li class="unactivated">�������ݿ�</li>
	<li class="unactivated">���ú�̨����Ա</li>
	<li class="unactivated last">��װ</li>
	</ul>
	<div class="stepstatbg stepstat1"></div>
	</div>
	</div>
	<div class="main">
	<div class="licenseblock">
	<div class="license">
	<h1>��Ʒ��ȨЭ�� �����������û�</h1>

	<p>��Ȩ���� (c) 2011-$year �������ֱ�������Ȩ����</p>

	<p>ǰ��������4.0����ʽ����Ϊ�������֣�������Ear Music��������������һ��������Discuz��̨��ʽ��UCHome�û�������ʽ���ϡ��ں��ɸ���ģ�������뻺����Ƶȿ�ܲ����PHP����ϵͳ��</p>

	<p>�û���֪����Э���������������֮�������ʹ�ö��������ṩ��������Ʒ������ķ���Э�顣�������Ǹ��˻���֯��ӯ�������;��Σ�������ѧϰ���о�ΪĿ�ģ���������ϸ�Ķ���Э�飬��������������ƶ������ֵ��������������Ȩ�����ơ��������Ĳ����ܻ򲻽��ܱ��������������ͬ�Ȿ�������/�����������ʱ������޸ģ���Ӧ��ʹ�û�����ȡ�����������ṩ�Ĳ�Ʒ�����������κζԶ������ֲ�Ʒ�е���ط����ע�ᡢ��½�����ء��鿴��ʹ����Ϊ������Ϊ���Ա���������ȫ������ȫ���ܣ��������ܶ������ֶԷ���������ʱ�������κ��޸ġ�</p>

	<p>����������һ���������, �������ֽ�����ҳ�Ϲ����޸����ݡ��޸ĺ�ķ�������һ������ҳ�Ϲ�������Ч����ԭ���ķ������������ʱ��½�������ֹٷ���ַ�������°������������ѡ����ܱ��������ʾ��ͬ�����Э�����������Լ�����������ͬ�Ȿ����������ܻ��ʹ�ñ������Ȩ����������Υ��������涨������������Ȩ��ʱ��ֹ����ֹ���Զ������ֲ�Ʒ��ʹ���ʸ񲢱���׷����ط������ε�Ȩ����</p>

	<p>�����⡢ͬ�⡢�����ر�Э���ȫ������󣬷��ɿ�ʼʹ�ö������ֲ�Ʒ�����������������ֱ��ǩ����һ����Э�飬�Բ������ȡ����Э���ȫ�������κβ��֡�</p>

	<p>��������ӵ�б�������ȫ��֪ʶ��Ȩ��������ֻ������Э�飬���ǳ��ۡ���������ֻ�����������ر�Э��������������¸��ơ����ء���װ��ʹ�û�����������ʽ�����ڱ������Ĺ��ܻ���֪ʶ��Ȩ��</p>

	<h3>I. Э�����ɵ�Ȩ��</h3>
	<ol>
	&nbsp;  <li>����������ȫ���ر�����Э��Ļ����ϣ���������Ӧ���ڷ���ҵ��;��������֧��������Ȩ���ɷ��á�</li>
	&nbsp;  <li>��������Э��涨��Լ�������Ʒ�Χ���޸Ķ������ֲ�ƷԴ����(������ṩ�Ļ�)�����������Ӧ������վҪ��</li>
	&nbsp;  <li>��ӵ��ʹ�ñ�������������վ��ȫ����Ա���ϡ����¼������Ϣ������Ȩ���������е���ʹ�ñ�������������վ���ݵ���ˡ�ע������ȷ���䲻�ַ��κ��˵ĺϷ�Ȩ�棬�����е���ʹ�ö������������ͷ��������ȫ�����Σ�����ɶ������ֻ��û���ʧ�ģ���Ӧ����ȫ���⳥��</li>
	&nbsp;  <li>�����轫������������������û���ҵ��;���������л�ö������ֵ��������ɣ����ڻ����ҵ��Ȩ֮�������Խ�������Ӧ������ҵ��;��ͬʱ�������������Ȩ������ȷ���ļ���֧�����ޡ�����֧�ַ�ʽ�ͼ���֧�����ݣ��Թ���ʱ�����ڼ���֧��������ӵ��ͨ��ָ���ķ�ʽ���ָ����Χ�ڵļ���֧�ַ�����ҵ��Ȩ�û����з�ӳ����������Ȩ����������������Ϊ��Ҫ���ǣ���û��һ�������ɵĳ�ŵ��֤��</li>
	&nbsp;  <li>�����ԴӶ��������ṩ��Ӧ�����ķ����������ʺ�����վ��Ӧ�ó��򣬵�Ӧ��Ӧ�ó��򿪷���/������֧����Ӧ�ķ��á�</li>
	</ol>

	<h3>II. Э��涨��Լ��������</h3>
	<ol>
	&nbsp;  <li>δ���������������ҵ��Ȩ֮ǰ�����ý�������������ҵ��;����������������ҵ��վ����Ӫ����վ����Ӫ��ΪĿ��ʵ��ӯ������վ����������ҵ��Ȩ���½www.earcms.com�ο����˵����Ҳ���Է����ʼ���web@earcms.com�˽����顣</li>
	&nbsp;  <li>���öԱ���������֮��������ҵ��Ȩ���г��⡢���ۡ���Ѻ�򷢷�������֤��</li>
	&nbsp;  <li>������Σ���������;��Ρ��Ƿ񾭹��޸Ļ��������޸ĳ̶���Σ�ֻҪʹ�ö������ֲ�Ʒ��������κβ��֣�δ���������ɣ�ҳ��ҳ�Ŵ��Ķ������ֲ�Ʒ���ƺͶ�������������վ��www.earcms.com���� www.erduo.in�� �����Ӷ����뱣����������������޸ġ�</li>
	&nbsp;  <li>��ֹ�ڶ������ֲ�Ʒ��������κβ��ֻ������Է�չ�κ������汾���޸İ汾��������汾�������·ַ���</li>
	&nbsp;  <li>����Ӧ���������ص�Ӧ�ó���δ��Ӧ�ó��򿪷���/�����ߵ��������ɣ����ö�����з��򹤳̡������ࡢ�������ȣ��������Ը��ơ��޸ġ����ӡ�ת�ء���ࡢ���������桢��չ��֮�йص�������Ʒ����Ʒ�ȡ�</li>
	&nbsp;  <li>�����δ�����ر�Э������������Ȩ������ֹ�������ɵ�Ȩ�������ջأ�ͬʱ��Ӧ�е���Ӧ�������Ρ�</li>
	</ol>

	<h3>III. ���޵�������������</h3>
	<ol>
	&nbsp;  <li>�����������������ļ�����Ϊ���ṩ�κ���ȷ�Ļ��������⳥�򵣱�����ʽ�ṩ�ġ�</li>
	&nbsp;  <li>�û�������Ը��ʹ�ñ��������������˽�ʹ�ñ������ķ��գ�����δ�����Ʒ��������֮ǰ�����ǲ���ŵ�ṩ�κ���ʽ�ļ���֧�֡�ʹ�õ�����Ҳ���е��κ���ʹ�ñ����������������������Ρ�</li>
	&nbsp;  <li>�������ֲ���ʹ�ñ�������������վ�е����»���Ϣ�е����Σ�ȫ�������������ге���</li>
	&nbsp;  <li>���������޷�ȫ�����ɵ������ϴ���Ӧ�����ĵ�Ӧ�ó�����˲���֤Ӧ�ó���ĺϷ��ԡ���ȫ�ԡ������ԡ���ʵ�Ի�Ʒ�ʵȣ�����Ӧ����������Ӧ�ó���ʱ��ͬ�������жϲ��е����з��գ����������ڶ������֡������κ�����£�����������Ȩ����ֹͣӦ�����ķ��񲢲�ȡ��Ӧ�ж��������������ڶ������Ӧ�ó������ж�أ���ͣ�����ȫ���򲿷֣������йؼ�¼�������йػ��ر��档�ɴ˶����������˿�����ɵ���ʧ���������ֲ��е��κ�ֱ�ӡ���ӻ������������Ρ�</li>
	&nbsp;  <li>�������ֶ����ṩ�������ͷ���֮��ʱ�ԡ���ȫ�ԡ�׼ȷ�Բ������������ڲ��ɿ������ء����������޷����Ƶ����أ������ڿ͹�����ͣ�ϵ�ȣ����������ʹ�úͷ�����ֹ����ֹ�������������ʧ�ģ���ͬ�����׷�������������ε�ȫ��Ȩ����</li>
	&nbsp;  <li>���������ر�������ע�⣬��������Ϊ�˱��Ϲ�˾ҵ��չ�͵���������Ȩ����������ӵ����ʱ����δ������֪ͨ���޸ķ������ݡ���ֹ����ֹ���ֻ�ȫ������ʹ�úͷ����Ȩ�����޸Ļṫ���ڶ���������վ���ҳ���ϣ�һ��������Ϊ֪ͨ�� ����������ʹ�޸Ļ���ֹ����ֹ���ֻ�ȫ������ʹ�úͷ����Ȩ���������ʧ�ģ��������ֲ���������κε���������</li>
	</ol>

	<p>�йض������ֲ�Ʒ�����û���ȨЭ�顢��ҵ��Ȩ�뼼���������ϸ���ݣ����ɶ������ֶ����ṩ����������ӵ���ڲ�����֪ͨ������£��޸���ȨЭ��ͷ����Ŀ����Ȩ�����޸ĺ��Э����Ŀ�����Ըı�֮���������Ȩ�û���Ч��</p>

	<p>һ������ʼ��װ�������ֲ�Ʒ��������Ϊ��ȫ���Ⲣ���ܱ�Э��ĸ�������������������������Ȩ����ͬʱ���ܵ���ص�Լ�������ơ�Э�����ɷ�Χ�������Ϊ����ֱ��Υ������ȨЭ�鲢������Ȩ��������Ȩ��ʱ��ֹ��Ȩ������ֹͣ�𺦣�������׷��������ε�Ȩ����</p>

	<p>������Э������Ľ��ͣ�Ч�������׵Ľ�����������л����񹲺͹���½���ɡ�</p>

	<p>�����Ͷ�������֮�䷢���κξ��׻����飬����Ӧ�Ѻ�Э�̽����Э�̲��ɵģ����ڴ���ȫͬ�⽫���׻������ύ�����������ڵ�����Ժ��Ͻ����������ӵ�ж����ϸ����������ݵĽ���Ȩ���޸�Ȩ��</p>

	<p>�������꣩</p>

	<p align="right">��������</p>
	</div>
	</div>
	<h2 class="title">�������</h2>
	<table class="tb" style="margin:20px 0 20px 55px;">
	<tr>
	<th>��Ŀ</th>
	<th class="padleft">��������</th>
	<th class="padleft">�������</th>
	<th class="padleft">��ǰ״̬</th>
	</tr>
	<tr>
	<td>����ϵͳ</td>
	<td class="padleft">������</td>
	<td class="padleft">��Unix</td>
	<td class="w pdleft1">$phpos</td>
	</tr>
	<tr>
	<td>PHP �汾</td>
	<td class="padleft">4.3.0+</td>
	<td class="padleft">5.0.0+</td>
	<td class="w pdleft1">$phpversion</td>
	</tr>
	<tr>
	<td>�����ϴ�</td>
	<td class="padleft">����</td>
	<td class="padleft">����</td>
	$attachmentupload
	</tr>
	<tr>
	<td>���̿ռ�</td>
	<td class="padleft">������</td>
	<td class="padleft">������</td>
	$diskspace
	</tr>
	</table>
	<h2 class="title">Ŀ¼���ļ�Ȩ�޼��</h2>
	<table class="tb" style="margin:20px 0 20px 55px;width:90%;">
	<tr><th>Ŀ¼�ļ�</th><th class="padleft">����״̬</th><th class="padleft">��ǰ״̬</th></tr>
	<tr><td>./client/ucenter.php</td><td class="w pdleft1">��д</td>$perms[ucenter]</tr>
	<tr><td>./client/data/</td><td class="w pdleft1">��д</td>$perms[ucdata]</tr>
	<tr><td>./data/</td><td class="w pdleft1">��д</td>$perms[data]</tr>
	<tr><td>./source/system/config.inc.php</td><td class="w pdleft1">��д</td>$perms[config]</tr>
	<tr><td>./source/plugin/</td><td class="w pdleft1">��д</td>$perms[plugin]</tr>
	<tr><td>./template/</td><td class="w pdleft1">��д</td>$perms[template]</tr>
	</table>
	<h2 class="title">���������Լ��</h2>
	<table class="tb" style="margin:20px 0 20px 55px;width:90%;">
	<tr>
	<th>��������</th>
	<th class="padleft">�����</th>
	<th class="padleft">����</th>
	</tr>
	<tr>
	<td>mysql_connect()</td>
	$check_mysql_connect
	<td class="padleft">��</td>
	</tr>
	<tr>
	<td>file_get_contents()</td>
	$check_file_get_contents
	<td class="padleft">��</td>
	</tr>
	</table>
END;
	if(!$checkok) {
		echo "<div class=\"btnbox marginbot\"><form method=\"post\" action=\"install.php?step=1\"><input type=\"submit\" value=\"ǿ�Ƽ���\"><input type=\"button\" value=\"�ر�\" onclick=\"windowclose();\"></form></div>";
	} else {
		print <<<END
		<div class="btnbox marginbot">
		<form method="post" action="install.php?step=1">
		<input type="submit" value="ͬ�Ⲣ��װ">
		<input type="button" value="��ͬ��" onclick="windowclose();">
		</form>
		</div>
END;
	}
	show_footer();

} elseif ($step == 1) {
	show_header();
	print<<<END
	<div class="setup step2">
	<h2>��װ���ݿ�</h2>
	<p>����ִ�����ݿⰲװ</p>
	</div>
	<div class="stepstat">
	<ul>
	<li class="unactivated">��鰲װ����</li>
	<li class="current">�������ݿ�</li>
	<li class="unactivated">���ú�̨����Ա</li>
	<li class="unactivated last">��װ</li>
	</ul>
	<div class="stepstatbg stepstat1"></div>
	</div>
	</div>
	<div class="main">
	<form name="themysql" method="post" action="install.php?step=2">
	<div class="desc"><b>��д���ݿ���Ϣ</b></div>
	<table class="tb2">
	<tr><th class="tbopt" align="left">&nbsp;���ݿ�����:</th>
	<td><input type="text" name="dbhost" value="localhost" size="35" class="txt"></td>
	<td>���ݿ��������ַ��һ��Ϊ localhost</td>
	</tr>
	<tr><th class="tbopt" align="left">&nbsp;���ݿ�����:</th>
	<td><input type="text" name="dbname" value="test" size="35" class="txt"></td>
	<td>��������ڣ���᳢���Զ�����</td>
	</tr>
	<tr><th class="tbopt" align="left">&nbsp;���ݿ��û���:</th>
	<td><input type="text" name="dbuser" value="root" size="35" class="txt"></td>
	<td></td>
	</tr>
	<tr><th class="tbopt" align="left">&nbsp;���ݿ�����:</th>
	<td><input type="password" name="dbpw" value="" size="35" class="txt"></td>
	<td></td>
	</tr>
	</table>
	<div class="desc"><b>������ѡ������</b></div>
	<table class="tb2">
	<tr><th class="tbopt" align="left">&nbsp;���ݿ��ǰ׺:</th>
	<td><input type="text" name="dbtablepre" value="prefix_" size="35" class="txt"></td>
	<td>����Ϊ�գ�Ĭ��Ϊprefix_</td>
	</tr>
	</table>
	<table class="tb2">
	<tr><th class="tbopt" align="left">&nbsp;</th>
	<td><input type="submit" name="submitmysql" value="�������ݿ�" onclick="return checkmysql();" class="btn"></td>
	<td></td>
	</tr>
	</table>
	</form>
END;
	show_footer();

} elseif ($step == 2) {
	if(!submitcheck('submitmysql')){show_msg('������֤�������޷��ύ��', 999);}
	$path=$_SERVER['PHP_SELF'];
	$path=str_replace('install.php', '', strtolower($path));
	$host=SafeRequest("dbhost","post");
	$name=SafeRequest("dbname","post");
	$user=SafeRequest("dbuser","post");
	$pw=SafeRequest("dbpw","post");
	$tablepre=SafeRequest("dbtablepre","post");
	$havedata = false;
	if(!@mysql_connect($host, $user, $pw)) {
		show_msg('���ݿ���Ϣ��д��������ģ�');
	}
	$config=file_get_contents("source/system/config.inc.php");
	$config=preg_replace("/'IN_DBHOST', '(.*?)'/", "'IN_DBHOST', '".$host."'", $config);
	$config=preg_replace("/'IN_DBNAME', '(.*?)'/", "'IN_DBNAME', '".$name."'", $config);
	$config=preg_replace("/'IN_DBUSER', '(.*?)'/", "'IN_DBUSER', '".$user."'", $config);
	$config=preg_replace("/'IN_DBPW', '(.*?)'/", "'IN_DBPW', '".$pw."'", $config);
	$config=preg_replace("/'IN_DBTABLE', '(.*?)'/", "'IN_DBTABLE', '".$tablepre."'", $config);
	$config=preg_replace("/'IN_PATH', '(.*?)'/", "'IN_PATH', '".$path."'", $config);
	$ifile=new iFile('source/system/config.inc.php', 'w');
	$ifile->WriteFile($config, 3);
	if(@mysql_select_db($name)) {
		if(mysql_query("SELECT COUNT(*) FROM ".$tablepre."admin")) {
			$havedata = true;
		}
	} else {
		if(!mysql_query("CREATE DATABASE `".$name."`")) {
			show_msg('�趨�����ݿ���Ȩ�޲����������ֹ��½�����ִ�а�װ����');
		}
	}
	if($havedata) {
		show_msg('Σ�գ�ָ�������ݿ��������ݣ���������������ԭ�����ݣ�', ($step+1));
	} else {
		show_msg('���ݿ���Ϣ���óɹ���������ʼ��װ����...', ($step+1), 1);
	}

} elseif ($step == 3) {
	$lnk=@mysql_connect(IN_DBHOST, IN_DBUSER, IN_DBPW) or show_msg('���ݿ������쳣���޷�ִ�У�', 999);
	@mysql_select_db(IN_DBNAME, $lnk) or show_msg('���ݿ������쳣���޷�ִ�У�', 999);
	mysql_query("SET NAMES ".IN_DBCHARSET, $lnk);
	$table=file_get_contents("static/install/table.sql");
	$table=str_replace('prefix_', IN_DBTABLE, $table);
	$table=str_replace('{charset}', IN_DBCHARSET, $table);
	$tablearr=explode(";",$table);
	$data=file_get_contents("static/install/data.sql");
	$data=str_replace(array('prefix_', '{host}', '{path}'), array(IN_DBTABLE, $_SERVER['HTTP_HOST'], IN_PATH), $data);
	$dataarr=explode("--preset--",$data);
	$sqlarr=explode("{jie}{gou}*/",$table);
	$str="<p>���ڰ�װ����...</p>{replace}";
	for($i=0;$i<count($tablearr)-1;$i++){
		mysql_query($tablearr[$i]);
	}
	for($i=0;$i<count($dataarr);$i++){
		mysql_query($dataarr[$i]);
	}
	for($i=0;$i<count($sqlarr)-1;$i++){
		$strsql=explode("/*{shu}{ju}",$sqlarr[$i]);
		$str.=$strsql[1];
	}
	$str=str_replace('{biao} `', '<p>�������ݱ� ', $str);
	$str=str_replace('` {de}', ' ... �ɹ�</p>{replace}', $str);
	$str=$str."<p>��װ�������� ... �ɹ�</p>{replace}";
	show_header();
	print<<<END
	<div class="setup step2">
	<h2>��װ���ݿ�</h2>
	<p>����ִ�����ݿⰲװ</p>
	</div>
	<div class="stepstat">
	<ul>
	<li class="unactivated">��鰲װ����</li>
	<li class="current">�������ݿ�</li>
	<li class="unactivated">���ú�̨����Ա</li>
	<li class="unactivated last">��װ</li>
	</ul>
	<div class="stepstatbg stepstat1"></div>
	</div>
	</div>
	<div class="main">
	<div class="notice" id="log">
	<div class="license" id="loginner">
	</div>
	</div>
	<div class="btnbox margintop marginbot">
	<input type="button" value="���ڰ�װ..." disabled="disabled">
	</div>
	<script type="text/javascript">
	var log = "$str";
	var n = 0;
	var timer = 0;
	log = log.split('{replace}');
	function GoPlay() {
		if (n > log.length-1) {
		        n=-1;
		        clearIntervals();
		}
		if (n > -1) {
		        postcheck(n);
		        n++;
		}
	}
	function postcheck(n) {
		document.getElementById('loginner').innerHTML += log[n];
		document.getElementById('log').scrollTop = document.getElementById('log').scrollHeight;
	}
	function setIntervals() {
		timer = setInterval('GoPlay()', 100);
	}
	function clearIntervals() {
		clearInterval(timer);
		location.href = "install.php?step=4";
	}
	setTimeout(setIntervals, 25);
	</script>
END;
	show_footer();

} elseif ($step == 4) {
	show_header();
	print<<<END
	<div class="setup step3">
	<h2>��������Ա</h2>
	<p>�������ú�̨�����ʺ�</p>
	</div>
	<div class="stepstat">
	<ul>
	<li class="unactivated">��鰲װ����</li>
	<li class="unactivated">�������ݿ�</li>
	<li class="current">���ú�̨����Ա</li>
	<li class="unactivated last">��װ</li>
	</ul>
	<div class="stepstatbg stepstat1"></div>
	</div>
	</div>
	<div class="main">
	<form name="theuser" method="post" action="install.php?step=5">
	<div class="desc"><b>��д����Ա��Ϣ</b></div>
	<table class="tb2">
	<tr><th class="tbopt" align="left">&nbsp;����Ա�ʺ�:</th>
	<td><input type="text" name="uname" value="" size="35" class="txt" onkeyup="value=value.replace(/[\W]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td>
	<td>������ĸ������</td>
	</tr>
	<tr><th class="tbopt" align="left">&nbsp;����Ա����:</th>
	<td><input type="password" name="upw" value="" size="35" class="txt"></td>
	<td>��������Խ���ӣ���ȫ����Խ��</td>
	</tr>
	<tr><th class="tbopt" align="left">&nbsp;�ظ�����:</th>
	<td><input type="password" name="upw1" value="" size="35" class="txt"></td>
	<td></td>
	</tr>
	<tr><th class="tbopt" align="left">&nbsp;��֤��:</th>
	<td><input type="text" name="ucode" value="" size="35" class="txt"></td>
	<td>���ú󣬿����ں�̨ѡ������ر�</td>
	</tr>
	</table>
	<table class="tb2">
	<tr><th class="tbopt" align="left">&nbsp;</th>
	<td><input type="submit" name="submituser" value="��������Ա" onclick="return checkuser();" class="btn"></td>
	<td></td>
	</tr>
	</table>
	</form>
END;
	show_footer();

} elseif ($step == 5) {
	if(!submitcheck('submituser')){show_msg('������֤�������޷��ύ��', 999);}
	$lnk=@mysql_connect(IN_DBHOST, IN_DBUSER, IN_DBPW) or show_msg('���ݿ������쳣���޷�ִ�У�', 999);
	@mysql_select_db(IN_DBNAME, $lnk) or show_msg('���ݿ������쳣���޷�ִ�У�', 999);
	mysql_query("SET NAMES ".IN_DBCHARSET, $lnk);
	$name=SafeRequest("uname","post");
	$pw=SafeRequest("upw","post");
	$pw1=SafeRequest("upw1","post");
	$code=SafeRequest("ucode","post");

	$t_name="Ĭ��ģ��";
	$t_dir="default";
	$t_html="html";
	$str=file_get_contents("template/".$t_dir."/install.xml");
	$str=preg_replace("/type=\"(.*?)\"/", "type=\"".IN_CHARSET."\"", $str);
	$str=preg_replace("/name=\"(.*?)\"/", "name=\"".$t_name."\"", $str);
	$str=preg_replace("/dir=\"(.*?)\"/", "dir=\"".$t_dir."\"", $str);
	$str=preg_replace("/html=\"(.*?)\"/", "html=\"".$t_html."\"", $str);
	$str=preg_replace("/CDATA\[(.*?)\]/", "CDATA[".IN_VERSION."]", $str);
	$ifile=new iFile('template/'.$t_dir.'/install.xml', 'w');
	$ifile->WriteFile(convert_xmlcharset($str, 1), 3);

	$strs=file_get_contents("source/system/config.inc.php");
	$strs=preg_replace("/'IN_CODE', '(.*?)'/", "'IN_CODE', '".$code."'", $strs);
	$ifiles=new iFile('source/system/config.inc.php', 'w');
	$ifiles->WriteFile($strs, 3);

	$p_name="��ʱͨѶ";
	$p_dir="webim";
	$p_file="admin";
	$p_type=2;
	$p_author="erduo";
	$p_address="http://www.erduo.in/";
	$strss=file_get_contents("source/plugin/".$p_dir."/install.xml");
	$strss=preg_replace("/g type=\"(.*?)\"/", "g type=\"".IN_CHARSET."\"", $strss);
	$strss=preg_replace("/name=\"(.*?)\"/", "name=\"".$p_name."\"", $strss);
	$strss=preg_replace("/dir=\"(.*?)\"/", "dir=\"".$p_dir."\"", $strss);
	$strss=preg_replace("/file=\"(.*?)\"/", "file=\"".$p_file."\"", $strss);
	$strss=preg_replace("/\" type=\"(.*?)\"/", "\" type=\"".$p_type."\"", $strss);
	$strss=preg_replace("/author=\"(.*?)\"/", "author=\"".$p_author."\"", $strss);
	$strss=preg_replace("/address=\"(.*?)\"/", "address=\"".$p_address."\"", $strss);
	$strss=preg_replace("/CDATA\[(.*?)\]/", "CDATA[".IN_VERSION."]", $strss);
	$ifiless=new iFile('source/plugin/'.$p_dir.'/install.xml', 'w');
	$ifiless->WriteFile(convert_xmlcharset($strss, 1), 3);

	$sql="insert into `".tname('admin')."` (in_adminname,in_adminpassword,in_loginnum,in_islock,in_permission) values ('".$name."','".md5($pw1)."','0','0','1,2,3,4,5,6,7,8,9')";
	$sqls="insert into `".tname('user')."` (in_username,in_userpassword,in_ismail,in_sex,in_regdate,in_islock,in_isstar,in_hits,in_points,in_rank,in_grade,in_vipgrade,in_sign,in_ucid) values ('".$name."','".substr(md5($pw1),8,16)."','0','0','".date('Y-m-d H:i:s')."','0','0','0','0','0','0','0','0','0')";
	$sqlss="insert into `".tname('template')."` (in_name,in_path,in_default,in_addtime) values ('".$t_name."','template/".$t_dir."/".$t_html."/','1','".date('Y-m-d H:i:s')."')";
	$sql1="insert into `".tname('plugin')."` (in_name,in_dir,in_file,in_isindex,in_type,in_author,in_address,in_addtime) values ('�����ƴ洢','oss','uplog','0','3','erduo','http://www.erduo.in/','".date('Y-m-d H:i:s')."')";
	$sql2="insert into `".tname('plugin')."` (in_name,in_dir,in_file,in_isindex,in_type,in_author,in_address,in_addtime) values ('����վȺ','chat','talk','0','1','erduo','http://www.erduo.in/','".date('Y-m-d H:i:s')."')";
	$sql3="insert into `".tname('plugin')."` (in_name,in_dir,in_file,in_isindex,in_type,in_author,in_address,in_addtime) values ('".$p_name."','".$p_dir."','".$p_file."','1','".$p_type."','".$p_author."','".$p_address."','".date('Y-m-d H:i:s')."')";
	if(mysql_query($sql) && mysql_query($sqls) && mysql_query($sqlss) && mysql_query($sql1) && mysql_query($sql2) && mysql_query($sql3)) {
		fwrite(fopen('data/install.txt', 'wb+'), date('Y-m-d H:i:s'));
		show_msg('��ϲ��Ear Music ˳����װ��ɣ�<br>Ϊ�˱�֤���ݰ�ȫ�����ֶ�ɾ��installĿ¼��<br><br>���ĺ�̨����Ա�ʺ���ǰ̨��Ա�ʺ��Ѿ��ɹ��������������������ԣ�<br><br><a href="index.php" target="_blank">������վ��ҳ</a><br>�� <a href="admin.php" target="_blank">���������̨</a> �Թ���Ա���ݶ�վ������������ã�', 999);
	} else {
		show_msg(mysql_error(), 999);
	}
}

function show_header() {
	global $version, $charset, $build;
	print<<<END
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=$charset" />
	<title>Ear Music ��װ��</title>
	<link rel="stylesheet" href="./static/install/images/style.css" type="text/css" media="all" />
	<link href="./static/pack/asynctips/asynctips.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="./static/pack/asynctips/jquery.min.js"></script>
	<script type="text/javascript" src="./static/pack/asynctips/asyncbox.v1.4.5.js"></script>
	<script type="text/javascript">
	function windowclose() {
		var browserName = navigator.appName;
		if (browserName=="Netscape") {
        		window.open('', '_self', '');
        		window.close();
        	} else if (browserName=="Microsoft Internet Explorer") {
        		window.opener = "whocares";
        		window.opener = null;
        		window.open('', '_top');
        		window.close();
        	}
        }
	function checkmysql() {
        	if (this.themysql.dbhost.value=="") {
        		asyncbox.tips("���ݿ���������Ϊ�գ�����д��", "wait", 1000);
        		this.themysql.dbhost.focus();
        		return false;
        	} else if (this.themysql.dbname.value=="") {
        		asyncbox.tips("���ݿ����Ʋ���Ϊ�գ�����д��", "wait", 1000);
        		this.themysql.dbname.focus();
        		return false;
        	} else if (this.themysql.dbuser.value=="") {
        		asyncbox.tips("���ݿ��û�������Ϊ�գ�����д��", "wait", 1000);
        		this.themysql.dbuser.focus();
        		return false;
        	} else if (this.themysql.dbpw.value=="") {
        		asyncbox.tips("���ݿ����벻��Ϊ�գ�����д��", "wait", 1000);
        		this.themysql.dbpw.focus();
        		return false;
        	} else if (this.themysql.dbtablepre.value=="") {
        		asyncbox.tips("���ݿ��ǰ׺����Ϊ�գ�����д��", "wait", 1000);
        		this.themysql.dbtablepre.focus();
        		return false;
        	} else {
        		return true;
        	}
	}
	function checkuser() {
        	if (this.theuser.uname.value=="") {
        		asyncbox.tips("����Ա�ʺŲ���Ϊ�գ�����д��", "wait", 1000);
        		this.theuser.uname.focus();
        		return false;
        	} else if (this.theuser.upw.value=="") {
        		asyncbox.tips("����Ա���벻��Ϊ�գ�����д��", "wait", 1000);
        		this.theuser.upw.focus();
        		return false;
        	} else if (this.theuser.upw1.value=="") {
        		asyncbox.tips("�ظ����벻��Ϊ�գ�����д��", "wait", 1000);
        		this.theuser.upw1.focus();
        		return false;
        	} else if (this.theuser.upw1.value!==this.theuser.upw.value) {
        		asyncbox.tips("�����������벻һ�£�����ģ�", "error", 1000);
        		this.theuser.upw1.focus();
        		return false;
        	} else if (this.theuser.ucode.value=="") {
        		asyncbox.tips("��֤�벻��Ϊ�գ�����д��", "wait", 1000);
        		this.theuser.ucode.focus();
        		return false;
        	} else {
        		return true;
        	}
	}
	</script>
	</head>
	<body>
	<div class="container">
	<div class="header">
	<h1>Ear Music ��װ��</h1>
	<span>Ear Music $version ��������$charset $build</span>
END;
}

function show_footer() {
	global $year;
	print<<<END
	<div class="footer">&copy;2011 - $year <a href="http://www.earcms.com/" target="_blank">Earcms</a> Inc.</div>
	</div>
	</div>
	</body>
	</html>
END;
}

function show_msg($message, $next=0, $jump=0) {
	$nextstr = '';
	$backstr = '';
	if(empty($next)) {
		$backstr .= "<a href=\"install.php?step=1\">������һ��</a>";
	} elseif ($next < 999) {
		$url_forward = "install.php?step=$next";
		if(empty($jump)) {
			$nextstr .= "<a href=\"$url_forward\">������һ��</a>";
			$backstr .= "<a href=\"install.php?step=1\">������һ��</a>";
		} else {
			$nextstr .= "<a href=\"$url_forward\">���Ե�...</a><script type=\"text/javascript\">setTimeout(\"location.href='$url_forward';\", 1000);</script>";
		}
	}
	show_header();
	print<<<END
	<div class="setup">
	<h2>��װ��ʾ</h2>
	</div>
	<div class="stepstat">
	<ul>
	<li class="unactivated">��鰲װ����</li>
	<li class="unactivated">�������ݿ�</li>
	<li class="unactivated">���ú�̨����Ա</li>
	<li class="current last">��װ</li>
	</ul>
	<div class="stepstatbg"></div>
	</div>
	</div>
	<div class="main">
	<div class="desc" align="center"><b>��ʾ��Ϣ</b></div>
	<table class="tb2">
	<tr><td class="desc" align="center">$message</td>
	</tr>
	</table>
	<div class="btnbox marginbot">$backstr $nextstr</div>
END;
	show_footer();
	exit();
}

function checkfdperm($path, $isfile=0) {
	if($isfile) {
		$file = $path;
		$mod = 'a';
	} else {
		$file = $path.'./install_tmptest.data';
		$mod = 'w';
	}
	if(!@$fp = fopen($file, $mod)) {
		return false;
	}
	if(!$isfile) {
		fwrite($fp, ' ');
		fclose($fp);
		if(!@unlink($file)) {
			return false;
		}
		if(is_dir($path.'./install_tmpdir')) {
			if(!@rmdir($path.'./install_tmpdir')) {
				return false;
			}
		}
		if(!@mkdir($path.'./install_tmpdir')) {
			return false;
		}
		if(!@rmdir($path.'./install_tmpdir')) {
			return false;
		}
	} else {
		fclose($fp);
	}
	return true;
}
?>