<?php
if(!defined('IN_ROOT')){exit('Access denied');}
Administrator(2);
$action=SafeRequest("action","get");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>">
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>ȫ������</title>
<link href="static/admincp/css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function $(obj) {return document.getElementById(obj);}
function change(type){
        if(type==1){
            $('mailopen').style.display='';
        }else if(type==2){
            $('mailopen').style.display='none';
        }else if(type==3){
            $('codeopen').style.display='';
        }else if(type==4){
            $('codeopen').style.display='none';
        }else if(type==5){
            $('in_open').style.display='none';
        }else if(type==6){
            $('in_open').style.display='';
        }else if(type==7){
            $('cacheopen').style.display='';
        }else if(type==8){
            $('cacheopen').style.display='none';
        }else if(type==9){
            $('upopen').style.display='';
        }else if(type==10){
            $('upopen').style.display='none';
        }else if(type==11){
            $('remotedisk').style.display='';
            $('remoteftp').style.display='none';
        }else if(type==12){
            $('remotedisk').style.display='none';
            $('remoteftp').style.display='';
        }else if(type==13){
            $('qqopen').style.display='';
        }else if(type==14){
            $('qqopen').style.display='none';
        }
}
</script>
</head>
<body>
<?php
switch($action){
	case 'save':
		save();
		break;
	default:
		main();
		break;
	}
?>
</body>
</html>
<?php function main(){
global $action;
?>
<form method="post" action="?iframe=config&action=save">
<input type="hidden" name="hash" value="<?php echo $_COOKIE['in_adminpassword']; ?>" />
<div class="container" style="<?php if(empty($action)){echo "display:";}else{echo "display:none";} ?>;">
<?php if(empty($action)){echo "<script type=\"text/javascript\">parent.document.title = 'Ear Music Board �������� - ȫ�� - վ����Ϣ';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='ȫ��&nbsp;&raquo;&nbsp;վ����Ϣ';</script>";} ?>
<div class="floattop"><div class="itemtitle"><h3>վ����Ϣ</h3><ul class="tab1">
<li class="current"><a href="?iframe=config"><span>վ����Ϣ</span></a></li>
<li><a href="?iframe=config&action=cache"><span>������Ϣ</span></a></li>
<li><a href="?iframe=config&action=upload"><span>�ϴ���Ϣ</span></a></li>
<li><a href="?iframe=config&action=pay"><span>֧����Ϣ</span></a></li>
<li><a href="?iframe=config&action=user"><span>��Ա��Ϣ</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th colspan="15" class="partition">��������</th></tr>
<tr><td colspan="2" class="td27">վ������:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_NAME; ?>" name="IN_NAME"></td><td class="vtop tips2">��ʾ����������ڱ����λ��</td></tr>
<tr><td colspan="2" class="td27">�ؼ��ִ�:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_KEYWORDS; ?>" name="IN_KEYWORDS"></td><td class="vtop tips2">����Ĵʻ����������������Ż�</td></tr>
<tr><td colspan="2" class="td27">վ������:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_DESCRIPTION; ?>" name="IN_DESCRIPTION"></td><td class="vtop tips2">������������������������Ż�</td></tr>
<tr><td colspan="2" class="td27">������Ϣ:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_ICP; ?>" name="IN_ICP"></td><td class="vtop tips2">��ʾ��ҳ��ײ���λ��</td></tr>
<tr><td colspan="2" class="td27">�ͷ� E-mail:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_MAIL; ?>" name="IN_MAIL"></td><td class="vtop tips2">���ʼ�ʱ�ķ����˵�ַ</td></tr>
<tr><td colspan="2" class="td27">�ʼ����񿪹�:</td></tr>
<tr><td class="vtop rowform">
<ul>
<?php if(IN_MAILOPEN==1){echo "<li class=\"checked\">";}else{echo "<li>";} ?><input class="radio" type="radio" name="IN_MAILOPEN" value="1" onclick="change(1);"<?php if(IN_MAILOPEN==1){echo " checked";} ?>>&nbsp;����</li>
<?php if(IN_MAILOPEN==0){echo "<li class=\"checked\">";}else{echo "<li>";} ?><input class="radio" type="radio" name="IN_MAILOPEN" value="0" onclick="change(2);"<?php if(IN_MAILOPEN==0){echo " checked";} ?>>&nbsp;�ر�</li>
</ul>
</td><td class="vtop lightnum">��Ҫ����ǰ̨�һ���������֤����ȹ��ܣ����鿪��</td></tr>
<tbody class="sub" id="mailopen"<?php if(IN_MAILOPEN<>1){echo " style=\"display:none;\"";} ?>>
<tr><td colspan="2" class="td27">SMTP ������:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_MAILSMTP; ?>" name="IN_MAILSMTP"></td><td class="vtop tips2">���ʼ�ʱ��ָ���ķ�����</td></tr>
<tr><td colspan="2" class="td27">E-mail ����:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_MAILPW; ?>" name="IN_MAILPW"></td><td class="vtop tips2">���ʼ�ʱ��Ҫ��֤������</td></tr>
</tbody>
<tr><td colspan="2" class="td27">��̨���ʿ���:</td></tr>
<tr><td class="vtop rowform">
<ul>
<?php if(IN_CODEOPEN==1){echo "<li class=\"checked\">";}else{echo "<li>";} ?><input class="radio" type="radio" name="IN_CODEOPEN" value="1" onclick="change(3);"<?php if(IN_CODEOPEN==1){echo " checked";} ?>>&nbsp;����</li>
<?php if(IN_CODEOPEN==0){echo "<li class=\"checked\">";}else{echo "<li>";} ?><input class="radio" type="radio" name="IN_CODEOPEN" value="0" onclick="change(4);"<?php if(IN_CODEOPEN==0){echo " checked";} ?>>&nbsp;�ر�</li>
</ul>
</td><td class="vtop tips2">Ϊ��վ�㰲ȫ��������鿪��</td></tr>
<tbody class="sub" id="codeopen"<?php if(IN_CODEOPEN<>1){echo " style=\"display:none;\"";} ?>>
<tr><td colspan="2" class="td27">��֤��:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_CODE; ?>" name="IN_CODE"></td><td class="vtop tips2">����Ա��¼��̨ʱ�İ�ȫ���ʴ�</td></tr>
</tbody>
<tr><td colspan="2" class="td27">ͳ�ƴ���:</td></tr>
<tr><td class="vtop rowform"><textarea rows="6" name="IN_STAT" cols="50" class="tarea"><?php echo base64_decode(IN_STAT); ?></textarea></td><td class="vtop tips2">ҳ��ײ���ʾ�ĵ�����ͳ��</td></tr>
</table>
<table class="tb tb2">
<tr><th colspan="15" class="partition">�ر�վ��</th></tr>
<tr><td colspan="2" class="td27">վ��ά������:</td></tr>
<tr><td class="vtop rowform">
<ul>
<?php if(IN_OPEN==1){echo "<li class=\"checked\">";}else{echo "<li>";} ?><input class="radio" type="radio" name="IN_OPEN" value="1" onclick="change(5);"<?php if(IN_OPEN==1){echo " checked";} ?>>&nbsp;����</li>
<?php if(IN_OPEN==0){echo "<li class=\"checked\">";}else{echo "<li>";} ?><input class="radio" type="radio" name="IN_OPEN" value="0" onclick="change(6);"<?php if(IN_OPEN==0){echo " checked";} ?>>&nbsp;ά��</li>
</ul>
</td><td class="vtop tips2">��ʱ��վ��رգ�ǰ̨�޷����ʣ�����Ӱ���̨����</td></tr>
<tbody class="sub" id="in_open"<?php if(IN_OPEN<>0){echo " style=\"display:none;\"";} ?>>
<tr><td colspan="2" class="td27">ά��˵��:</td></tr>
<tr><td class="vtop rowform"><textarea rows="6" name="IN_OPENS" cols="50" class="tarea"><?php echo IN_OPENS; ?></textarea></td><td class="vtop tips2">ǰ̨��ʾ��ά����Ϣ</td></tr>
</tbody>
<tr><td colspan="15"><div class="fixsel"><input type="submit" class="btn" value="�ύ" /></div></td></tr>
</table>
</div>

<div class="container" style="<?php if($action=="cache"){echo "display:";}else{echo "display:none";} ?>;">
<?php if($action=="cache"){echo "<script type=\"text/javascript\">parent.document.title = 'Ear Music Board �������� - ȫ�� - ������Ϣ';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='ȫ��&nbsp;&raquo;&nbsp;������Ϣ';</script>";} ?>
<div class="floattop"><div class="itemtitle"><h3>������Ϣ</h3><ul class="tab1">
<li><a href="?iframe=config"><span>վ����Ϣ</span></a></li>
<li class="current"><a href="?iframe=config&action=cache"><span>������Ϣ</span></a></li>
<li><a href="?iframe=config&action=upload"><span>�ϴ���Ϣ</span></a></li>
<li><a href="?iframe=config&action=pay"><span>֧����Ϣ</span></a></li>
<li><a href="?iframe=config&action=user"><span>��Ա��Ϣ</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th colspan="15" class="partition">ģ�建��</th></tr>
<tr><td colspan="2" class="td27">���濪��:</td></tr>
<tr><td class="vtop rowform">
<ul>
<?php if(IN_CACHEOPEN==1){echo "<li class=\"checked\">";}else{echo "<li>";} ?><input class="radio" type="radio" name="IN_CACHEOPEN" value="1" onclick="change(7);"<?php if(IN_CACHEOPEN==1){echo " checked";} ?>>&nbsp;����</li>
<?php if(IN_CACHEOPEN==0){echo "<li class=\"checked\">";}else{echo "<li>";} ?><input class="radio" type="radio" name="IN_CACHEOPEN" value="0" onclick="change(8);"<?php if(IN_CACHEOPEN==0){echo " checked";} ?>>&nbsp;�ر�</li>
</ul>
</td><td class="vtop tips2">�������������ģ�������Ч��</td></tr>
<tbody class="sub" id="cacheopen"<?php if(IN_CACHEOPEN<>1){echo " style=\"display:none;\"";} ?>>
<tr><td colspan="2" class="td27">����ʱ��:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_CACHETIME; ?>" name="IN_CACHETIME" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">��</td></tr>
</tbody>
</table>
<table class="tb tb2">
<tr><th colspan="15" class="partition">����ģʽ</th></tr>
<tr><td colspan="2" class="td27">α��̬����:</td></tr>
<tr><td class="vtop rowform">
<select name="IN_REWRITEOPEN">
<option value="0">��̬</option>
<option value="1"<?php if(IN_REWRITEOPEN==1){echo " selected";} ?>>α��̬</option>
<option value="2"<?php if(IN_REWRITEOPEN==2){echo " selected";} ?>>��̬</option>
</select>
</td><td class="vtop tips2">������ķ�������֧�� Rewrite����ѡ�񡰶�̬��</td></tr>
<tr><td colspan="15"><div class="fixsel"><input type="submit" class="btn" value="�ύ" /></div></td></tr>
</table>
</div>

<div class="container" style="<?php if($action=="upload"){echo "display:";}else{echo "display:none";} ?>;">
<?php if($action=="upload"){echo "<script type=\"text/javascript\">parent.document.title = 'Ear Music Board �������� - ȫ�� - �ϴ���Ϣ';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='ȫ��&nbsp;&raquo;&nbsp;�ϴ���Ϣ';</script>";} ?>
<div class="floattop"><div class="itemtitle"><h3>�ϴ���Ϣ</h3><ul class="tab1">
<li><a href="?iframe=config"><span>վ����Ϣ</span></a></li>
<li><a href="?iframe=config&action=cache"><span>������Ϣ</span></a></li>
<li class="current"><a href="?iframe=config&action=upload"><span>�ϴ���Ϣ</span></a></li>
<li><a href="?iframe=config&action=pay"><span>֧����Ϣ</span></a></li>
<li><a href="?iframe=config&action=user"><span>��Ա��Ϣ</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th colspan="15" class="partition">��������</th></tr>
<tr><td colspan="2" class="td27">�ϴ�����:</td></tr>
<tr><td class="vtop rowform">
<ul>
<?php if(IN_UPOPEN==1){echo "<li class=\"checked\">";}else{echo "<li>";} ?><input class="radio" type="radio" name="IN_UPOPEN" value="1" onclick="change(9);"<?php if(IN_UPOPEN==1){echo " checked";} ?>>&nbsp;����</li>
<?php if(IN_UPOPEN==0){echo "<li class=\"checked\">";}else{echo "<li>";} ?><input class="radio" type="radio" name="IN_UPOPEN" value="0" onclick="change(10);"<?php if(IN_UPOPEN==0){echo " checked";} ?>>&nbsp;�ر�</li>
</ul>
</td><td class="vtop tips2">�رպ�ȫվ���Զ��л���Զ���ϴ�</td></tr>
<tbody class="sub" id="upopen"<?php if(IN_UPOPEN<>1){echo " style=\"display:none;\"";} ?>>
<tr><td colspan="2" class="td27">MP3��������:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_UPMP3KBPS; ?>" name="IN_UPMP3KBPS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">��λ��Kbps��0 Ϊ�رոù���</td></tr>
<tr><td colspan="2" class="td27">��Ƶ����Ĵ�С:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_UPMUSICSIZE; ?>" name="IN_UPMUSICSIZE" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">MB</td></tr>
<tr><td colspan="2" class="td27">��Ƶ���������:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_UPMUSICEXT; ?>" name="IN_UPMUSICEXT"></td><td class="vtop tips2">�������ʱ���á�;������</td></tr>
<tr><td colspan="2" class="td27">��Ƶ����Ĵ�С:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_UPVIDEOSIZE; ?>" name="IN_UPVIDEOSIZE" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">MB</td></tr>
<tr><td colspan="2" class="td27">��Ƶ���������:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_UPVIDEOEXT; ?>" name="IN_UPVIDEOEXT"></td><td class="vtop tips2">�������ʱ���á�;������</td></tr>
</tbody>
</table>
<table class="tb tb2">
<tr><th colspan="15" class="partition">Զ������</th></tr>
<tr><td colspan="2" class="td27">�ϴ�����:</td></tr>
<tr><td class="vtop rowform">
<ul>
<?php if(IN_REMOTE==1){echo "<li class=\"checked\">";}else{echo "<li>";} ?><input class="radio" type="radio" name="IN_REMOTE" value="1" onclick="change(11);"<?php if(IN_REMOTE==1){echo " checked";} ?>>&nbsp;�ƴ洢</li>
<?php if(IN_REMOTE==2){echo "<li class=\"checked\">";}else{echo "<li>";} ?><input class="radio" type="radio" name="IN_REMOTE" value="2" onclick="change(12);"<?php if(IN_REMOTE==2){echo " checked";} ?>>&nbsp;FTP</li>
</ul>
</td><td class="vtop tips2">�رձ����ϴ�ʱ���Զ��л���������</td></tr>
<tbody class="sub" id="remotedisk"<?php if(IN_REMOTE<>1){echo " style=\"display:none;\"";} ?>>
<tr><td colspan="2" class="td27">�ϴ���ʶ:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_REMOTEPK; ?>" name="IN_REMOTEPK"></td><td class="vtop tips2">�ƴ洢����չĿ¼</td></tr>
<tr><td colspan="2" class="td27">Bucket:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_REMOTEBK; ?>" name="IN_REMOTEBK"></td><td class="vtop tips2">�ƴ洢�Ŀռ�����</td></tr>
<tr><td colspan="2" class="td27">AccessKey:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_REMOTEAK; ?>" name="IN_REMOTEAK"></td><td class="vtop tips2">�ƴ洢��ͨ����Կ</td></tr>
<tr><td colspan="2" class="td27">SecretKey:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_REMOTESK; ?>" name="IN_REMOTESK"></td><td class="vtop tips2">�ƴ洢��ͨ����Կ</td></tr>
</tbody>
<tbody class="sub" id="remoteftp"<?php if(IN_REMOTE<>2){echo " style=\"display:none;\"";} ?>>
<tr><td colspan="2" class="td27">FTP ��������ַ:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_REMOTEHOST; ?>" name="IN_REMOTEHOST"></td><td class="vtop tips2">������ FTP �������� IP ��ַ������</td></tr>
<tr><td colspan="2" class="td27">FTP �������˿�:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_REMOTEPORT; ?>" name="IN_REMOTEPORT" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">Ĭ��Ϊ 21</td></tr>
<tr><td colspan="2" class="td27">FTP �ʺ�:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_REMOTEUSER; ?>" name="IN_REMOTEUSER"></td><td class="vtop tips2">���ʺű����������Ȩ�ޣ���ȡ�ļ���д���ļ���ɾ���ļ�������Ŀ¼����Ŀ¼�̳�</td></tr>
<tr><td colspan="2" class="td27">FTP ����:</td></tr>
<tr><td class="vtop rowform"><input type="password" class="txt" value="<?php echo IN_REMOTEPW; ?>" name="IN_REMOTEPW"></td><td class="vtop tips2">���ڰ�ȫ���ǣ�FTP ���뽫������</td></tr>
<tr><td colspan="2" class="td27">����ģʽ(pasv)����:</td></tr>
<tr><td class="vtop rowform">
<select name="IN_REMOTEPASV">
<option value="0">��</option>
<option value="1"<?php if(IN_REMOTEPASV==1){echo " selected";} ?>>��</option>
</select>
</td><td class="vtop tips2">һ������·Ǳ���ģʽ���ɣ���������ϴ�ʧ�����⣬�ɳ��Դ򿪴�����</td></tr>
<tr><td colspan="2" class="td27">Զ�̸���Ŀ¼:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_REMOTEDIR; ?>" name="IN_REMOTEDIR"></td><td class="vtop tips2">Զ�̸���Ŀ¼�ľ���·��������� FTP ��Ŀ¼�����·����<em class="lightnum">ǰ��Ҫ��б��</em>��<em class="lightnum">/</em>������<em class="lightnum">.</em>��<em class="lightnum">��ʾ FTP ��Ŀ¼</em></td></tr>
<tr><td colspan="2" class="td27">Զ�̷��� URL:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_REMOTEURL; ?>" name="IN_REMOTEURL"></td><td class="vtop tips2">֧�� HTTP �� FTP Э�飬<em class="lightnum">��β��Ҫ��б��</em>��<em class="lightnum">/</em>�������ʹ�� FTP Э�飬FTP ����������֧�� PASV ģʽ��Ϊ�˰�ȫ�����ʹ�� FTP ���ӵ��ʺŲ�Ҫ���ÿ�дȨ�޺��б�Ȩ��</td></tr>
<tr><td colspan="2" class="td27">FTP ���䳬ʱʱ��:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_REMOTEOUT; ?>" name="IN_REMOTEOUT" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">��λ���룬0 Ϊ������Ĭ��</td></tr>
</tbody>
<tr><td colspan="15"><div class="fixsel"><input type="submit" class="btn" value="�ύ" /></div></td></tr>
</table>
</div>

<div class="container" style="<?php if($action=="pay"){echo "display:";}else{echo "display:none";} ?>;">
<?php if($action=="pay"){echo "<script type=\"text/javascript\">parent.document.title = 'Ear Music Board �������� - ȫ�� - ֧����Ϣ';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='ȫ��&nbsp;&raquo;&nbsp;֧����Ϣ';</script>";} ?>
<div class="floattop"><div class="itemtitle"><h3>֧����Ϣ</h3><ul class="tab1">
<li><a href="?iframe=config"><span>վ����Ϣ</span></a></li>
<li><a href="?iframe=config&action=cache"><span>������Ϣ</span></a></li>
<li><a href="?iframe=config&action=upload"><span>�ϴ���Ϣ</span></a></li>
<li class="current"><a href="?iframe=config&action=pay"><span>֧����Ϣ</span></a></li>
<li><a href="?iframe=config&action=user"><span>��Ա��Ϣ</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th colspan="15" class="partition">֧����</th></tr>
<tr><td colspan="2" class="td27">��������� ID:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_ALIPAYID; ?>" name="IN_ALIPAYID"></td><td class="vtop tips2">��2088��ͷ��16λ������</td></tr>
<tr><td colspan="2" class="td27">��ȫ������:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_ALIPAYKEY; ?>" name="IN_ALIPAYKEY"></td><td class="vtop tips2">�����ֺ���ĸ��ɵ�32λ�ַ�</td></tr>
<tr><td colspan="2" class="td27">֧�����˺�:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_ALIPAYUID; ?>" name="IN_ALIPAYUID"></td><td class="vtop tips2">ǩԼ֧�����˺Ż�����֧�����ʻ�</td></tr>
</table>
<table class="tb tb2">
<tr><th colspan="15" class="partition">��ֵҵ��</th></tr>
<tr><td colspan="2" class="td27">��ҳ�ֵ���ʻ���:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_RMBPOINTS; ?>" name="IN_RMBPOINTS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">���/ÿԪ</td></tr>
<tr><td colspan="2" class="td27">������ͨ��Ա�ۼ�:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_VIPPOINTS; ?>" name="IN_VIPPOINTS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">���/ÿ��</td></tr>
<tr><td colspan="15"><div class="fixsel"><input type="submit" class="btn" value="�ύ" /></div></td></tr>
</table>
</div>

<div class="container" style="<?php if($action=="user"){echo "display:";}else{echo "display:none";} ?>;">
<?php if($action=="user"){echo "<script type=\"text/javascript\">parent.document.title = 'Ear Music Board �������� - ȫ�� - ��Ա��Ϣ';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='ȫ��&nbsp;&raquo;&nbsp;��Ա��Ϣ';</script>";} ?>
<div class="floattop"><div class="itemtitle"><h3>��Ա��Ϣ</h3><ul class="tab1">
<li><a href="?iframe=config"><span>վ����Ϣ</span></a></li>
<li><a href="?iframe=config&action=cache"><span>������Ϣ</span></a></li>
<li><a href="?iframe=config&action=upload"><span>�ϴ���Ϣ</span></a></li>
<li><a href="?iframe=config&action=pay"><span>֧����Ϣ</span></a></li>
<li class="current"><a href="?iframe=config&action=user"><span>��Ա��Ϣ</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th colspan="15" class="partition">QQ��¼</th></tr>
<tr><td colspan="2" class="td27">��¼����:</td></tr>
<tr><td class="vtop rowform">
<ul>
<?php if(IN_QQOPEN==1){echo "<li class=\"checked\">";}else{echo "<li>";} ?><input class="radio" type="radio" name="IN_QQOPEN" value="1" onclick="change(13);"<?php if(IN_QQOPEN==1){echo " checked";} ?>>&nbsp;����</li>
<?php if(IN_QQOPEN==0){echo "<li class=\"checked\">";}else{echo "<li>";} ?><input class="radio" type="radio" name="IN_QQOPEN" value="0" onclick="change(14);"<?php if(IN_QQOPEN==0){echo " checked";} ?>>&nbsp;�ر�</li>
</ul>
</td><td class="vtop lightnum">�ص���ַ��<?php echo "http://".$_SERVER['HTTP_HOST'].IN_PATH."source/pack/connect/redirect.php"; ?></td></tr>
<tbody class="sub" id="qqopen"<?php if(IN_QQOPEN<>1){echo " style=\"display:none;\"";} ?>>
<tr><td colspan="2" class="td27">APP ID:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_QQAPPID; ?>" name="IN_QQAPPID"></td><td class="vtop tips2">QQ������ͨ����Կ</td></tr>
<tr><td colspan="2" class="td27">APP KEY:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_QQAPPKEY; ?>" name="IN_QQAPPKEY"></td><td class="vtop tips2">QQ������ͨ����Կ</td></tr>
</tbody>
</table>
<table class="tb tb2">
<tr><th colspan="15" class="partition">��������</th></tr>
<tr><td colspan="2" class="td27">��Աע�Ὺ��:</td></tr>
<tr><td class="vtop rowform">
<select name="IN_REGOPEN">
<option value="0">�ر�</option>
<option value="1"<?php if(IN_REGOPEN==1){echo " selected";} ?>>����</option>
</select>
</td><td class="vtop tips2">�رպ�ǰ̨���޷�ʹ��ע�Ṧ��</td></tr>
<tr><td colspan="2" class="td27">��ԱͶ�忪��:</td></tr>
<tr><td class="vtop rowform">
<select name="IN_SHAREOPEN">
<option value="0">�ر�</option>
<option value="1"<?php if(IN_SHAREOPEN==1){echo " selected";} ?>>����</option>
</select>
</td><td class="vtop tips2">�رպ�ǰ̨���޷�ʹ��Ͷ�幦��</td></tr>
<tr><td colspan="2" class="td27">�û����߱�������:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_ONLINEHOLD; ?>" name="IN_ONLINEHOLD" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">��</td></tr>
<tr><td colspan="2" class="td27">��̬��¼��������:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_FEEDDAY; ?>" name="IN_FEEDDAY" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">��</td></tr>
<tr><td colspan="2" class="td27">�ÿͼ�¼��������:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_FOOTPRINTDAY; ?>" name="IN_FOOTPRINTDAY" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">��</td></tr>
<tr><td colspan="2" class="td27">��Ϣ��¼��������:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_MESSAGEDAY; ?>" name="IN_MESSAGEDAY" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">��</td></tr>
<tr><td colspan="2" class="td27">������¼��������:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_LISTENDAY; ?>" name="IN_LISTENDAY" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">��</td></tr>
<tr><td colspan="2" class="td27">�ʼ���¼��������:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_MAILDAY; ?>" name="IN_MAILDAY" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">��</td></tr>
</table>
<table class="tb tb2">
<tr><th colspan="15" class="partition">��������</th></tr>
<tr><td colspan="2" class="td27">ע���Ա��ʼ:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_REGPOINTS; ?>" name="IN_REGPOINTS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">���</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_REGRANK; ?>" name="IN_REGRANK" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">����</td></tr>
<tr><td colspan="2" class="td27">ÿ���״ε�¼:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_LOGINDAYPOINTS; ?>" name="IN_LOGINDAYPOINTS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">���</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_LOGINDAYRANK; ?>" name="IN_LOGINDAYRANK" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">����</td></tr>
<tr><td colspan="2" class="td27">ÿ�մ�ǩ��:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_SIGNDAYPOINTS; ?>" name="IN_SIGNDAYPOINTS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">���*����ǩ������</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_SIGNDAYRANK; ?>" name="IN_SIGNDAYRANK" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">����*����ǩ������</td></tr>
<tr><td class="vtop rowform">
<select name="IN_SIGNVIPOPEN">
<option value="0">��</option>
<option value="1"<?php if(IN_SIGNVIPOPEN==1){echo " selected";} ?>>��</option>
</select>
</td><td class="vtop tips2">�Ƿ��������¸���Ա�����ڽ�</td></tr>
<tr><td colspan="2" class="td27">�����ϴ�ͷ��:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_AVATARPOINTS; ?>" name="IN_AVATARPOINTS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">���</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_AVATARRANK; ?>" name="IN_AVATARRANK" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">����</td></tr>
<tr><td colspan="2" class="td27">������֤����:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_MAILPOINTS; ?>" name="IN_MAILPOINTS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">���</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_MAILRANK; ?>" name="IN_MAILRANK" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">����</td></tr>
<tr><td colspan="2" class="td27">�������:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_MUSICINPOINTS; ?>" name="IN_MUSICINPOINTS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">���</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_MUSICINRANK; ?>" name="IN_MUSICINRANK" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">����</td></tr>
<tr><td colspan="2" class="td27">���ר��:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_SPECIALINPOINTS; ?>" name="IN_SPECIALINPOINTS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">���</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_SPECIALINRANK; ?>" name="IN_SPECIALINRANK" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">����</td></tr>
<tr><td colspan="2" class="td27">��˸���:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_SINGERINPOINTS; ?>" name="IN_SINGERINPOINTS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">���</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_SINGERINRANK; ?>" name="IN_SINGERINRANK" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">����</td></tr>
<tr><td colspan="2" class="td27">�����Ƶ:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_VIDEOINPOINTS; ?>" name="IN_VIDEOINPOINTS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">���</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_VIDEOINRANK; ?>" name="IN_VIDEOINRANK" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">����</td></tr>
</table>
<table class="tb tb2">
<tr><th colspan="15" class="partition">�ͷ�����</th></tr>
<tr><td colspan="2" class="td27">ɾ������:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_MUSICOUTPOINTS; ?>" name="IN_MUSICOUTPOINTS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">���</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_MUSICOUTRANK; ?>" name="IN_MUSICOUTRANK" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">����</td></tr>
<tr><td colspan="2" class="td27">ɾ��ר��:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_SPECIALOUTPOINTS; ?>" name="IN_SPECIALOUTPOINTS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">���</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_SPECIALOUTRANK; ?>" name="IN_SPECIALOUTRANK" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">����</td></tr>
<tr><td colspan="2" class="td27">ɾ������:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_SINGEROUTPOINTS; ?>" name="IN_SINGEROUTPOINTS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">���</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_SINGEROUTRANK; ?>" name="IN_SINGEROUTRANK" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">����</td></tr>
<tr><td colspan="2" class="td27">ɾ����Ƶ:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_VIDEOOUTPOINTS; ?>" name="IN_VIDEOOUTPOINTS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">���</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_VIDEOOUTRANK; ?>" name="IN_VIDEOOUTRANK" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">����</td></tr>
<tr><td colspan="15"><div class="fixsel"><input type="submit" class="btn" value="�ύ" /></div></td></tr>
</table>
</div>
</form>
<?php
}
function save(){
if(!submitcheck('hash', 1)){ShowMessage("����·�������޷��ύ��",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
$str=file_get_contents('source/system/config.inc.php');
$str=preg_replace("/'IN_NAME', '(.*?)'/", "'IN_NAME', '".SafeRequest("IN_NAME","post")."'", $str);
$str=preg_replace("/'IN_KEYWORDS', '(.*?)'/", "'IN_KEYWORDS', '".SafeRequest("IN_KEYWORDS","post")."'", $str);
$str=preg_replace("/'IN_DESCRIPTION', '(.*?)'/", "'IN_DESCRIPTION', '".SafeRequest("IN_DESCRIPTION","post")."'", $str);
$str=preg_replace("/'IN_ICP', '(.*?)'/", "'IN_ICP', '".SafeRequest("IN_ICP","post")."'", $str);
$str=preg_replace("/'IN_MAIL', '(.*?)'/", "'IN_MAIL', '".SafeRequest("IN_MAIL","post")."'", $str);
$str=preg_replace("/'IN_MAILOPEN', '(.*?)'/", "'IN_MAILOPEN', '".SafeRequest("IN_MAILOPEN","post")."'", $str);
$str=preg_replace("/'IN_MAILSMTP', '(.*?)'/", "'IN_MAILSMTP', '".SafeRequest("IN_MAILSMTP","post")."'", $str);
$str=preg_replace("/'IN_MAILPW', '(.*?)'/", "'IN_MAILPW', '".SafeRequest("IN_MAILPW","post")."'", $str);
$str=preg_replace("/'IN_CODEOPEN', '(.*?)'/", "'IN_CODEOPEN', '".SafeRequest("IN_CODEOPEN","post")."'", $str);
$str=preg_replace("/'IN_CODE', '(.*?)'/", "'IN_CODE', '".SafeRequest("IN_CODE","post")."'", $str);
$str=preg_replace("/'IN_STAT', '(.*?)'/", "'IN_STAT', '".base64_encode(stripslashes(SafeRequest("IN_STAT","post",1)))."'", $str);
$str=preg_replace("/'IN_OPEN', '(.*?)'/", "'IN_OPEN', '".SafeRequest("IN_OPEN","post")."'", $str);
$str=preg_replace("/'IN_OPENS', '(.*?)'/", "'IN_OPENS', '".SafeRequest("IN_OPENS","post")."'", $str);
$str=preg_replace("/'IN_CACHEOPEN', '(.*?)'/", "'IN_CACHEOPEN', '".SafeRequest("IN_CACHEOPEN","post")."'", $str);
$str=preg_replace("/'IN_CACHETIME', '(.*?)'/", "'IN_CACHETIME', '".SafeRequest("IN_CACHETIME","post")."'", $str);
$str=preg_replace("/'IN_REWRITEOPEN', '(.*?)'/", "'IN_REWRITEOPEN', '".SafeRequest("IN_REWRITEOPEN","post")."'", $str);
$str=preg_replace("/'IN_UPOPEN', '(.*?)'/", "'IN_UPOPEN', '".SafeRequest("IN_UPOPEN","post")."'", $str);
$str=preg_replace("/'IN_UPMP3KBPS', '(.*?)'/", "'IN_UPMP3KBPS', '".SafeRequest("IN_UPMP3KBPS","post")."'", $str);
$str=preg_replace("/'IN_UPMUSICSIZE', '(.*?)'/", "'IN_UPMUSICSIZE', '".SafeRequest("IN_UPMUSICSIZE","post")."'", $str);
$str=preg_replace("/'IN_UPMUSICEXT', '(.*?)'/", "'IN_UPMUSICEXT', '".SafeRequest("IN_UPMUSICEXT","post")."'", $str);
$str=preg_replace("/'IN_UPVIDEOSIZE', '(.*?)'/", "'IN_UPVIDEOSIZE', '".SafeRequest("IN_UPVIDEOSIZE","post")."'", $str);
$str=preg_replace("/'IN_UPVIDEOEXT', '(.*?)'/", "'IN_UPVIDEOEXT', '".SafeRequest("IN_UPVIDEOEXT","post")."'", $str);
$str=preg_replace("/'IN_REMOTE', '(.*?)'/", "'IN_REMOTE', '".SafeRequest("IN_REMOTE","post")."'", $str);
$str=preg_replace("/'IN_REMOTEPK', '(.*?)'/", "'IN_REMOTEPK', '".SafeRequest("IN_REMOTEPK","post")."'", $str);
$str=preg_replace("/'IN_REMOTEBK', '(.*?)'/", "'IN_REMOTEBK', '".SafeRequest("IN_REMOTEBK","post")."'", $str);
$str=preg_replace("/'IN_REMOTEAK', '(.*?)'/", "'IN_REMOTEAK', '".SafeRequest("IN_REMOTEAK","post")."'", $str);
$str=preg_replace("/'IN_REMOTESK', '(.*?)'/", "'IN_REMOTESK', '".SafeRequest("IN_REMOTESK","post")."'", $str);
$str=preg_replace("/'IN_REMOTEHOST', '(.*?)'/", "'IN_REMOTEHOST', '".SafeRequest("IN_REMOTEHOST","post")."'", $str);
$str=preg_replace("/'IN_REMOTEPORT', '(.*?)'/", "'IN_REMOTEPORT', '".SafeRequest("IN_REMOTEPORT","post")."'", $str);
$str=preg_replace("/'IN_REMOTEUSER', '(.*?)'/", "'IN_REMOTEUSER', '".SafeRequest("IN_REMOTEUSER","post")."'", $str);
$str=preg_replace("/'IN_REMOTEPW', '(.*?)'/", "'IN_REMOTEPW', '".SafeRequest("IN_REMOTEPW","post")."'", $str);
$str=preg_replace("/'IN_REMOTEPASV', '(.*?)'/", "'IN_REMOTEPASV', '".SafeRequest("IN_REMOTEPASV","post")."'", $str);
$str=preg_replace("/'IN_REMOTEDIR', '(.*?)'/", "'IN_REMOTEDIR', '".SafeRequest("IN_REMOTEDIR","post")."'", $str);
$str=preg_replace("/'IN_REMOTEURL', '(.*?)'/", "'IN_REMOTEURL', '".SafeRequest("IN_REMOTEURL","post")."'", $str);
$str=preg_replace("/'IN_REMOTEOUT', '(.*?)'/", "'IN_REMOTEOUT', '".SafeRequest("IN_REMOTEOUT","post")."'", $str);
$str=preg_replace("/'IN_ALIPAYID', '(.*?)'/", "'IN_ALIPAYID', '".SafeRequest("IN_ALIPAYID","post")."'", $str);
$str=preg_replace("/'IN_ALIPAYKEY', '(.*?)'/", "'IN_ALIPAYKEY', '".SafeRequest("IN_ALIPAYKEY","post")."'", $str);
$str=preg_replace("/'IN_ALIPAYUID', '(.*?)'/", "'IN_ALIPAYUID', '".SafeRequest("IN_ALIPAYUID","post")."'", $str);
$str=preg_replace("/'IN_RMBPOINTS', '(.*?)'/", "'IN_RMBPOINTS', '".SafeRequest("IN_RMBPOINTS","post")."'", $str);
$str=preg_replace("/'IN_VIPPOINTS', '(.*?)'/", "'IN_VIPPOINTS', '".SafeRequest("IN_VIPPOINTS","post")."'", $str);
$str=preg_replace("/'IN_QQOPEN', '(.*?)'/", "'IN_QQOPEN', '".SafeRequest("IN_QQOPEN","post")."'", $str);
$str=preg_replace("/'IN_QQAPPID', '(.*?)'/", "'IN_QQAPPID', '".SafeRequest("IN_QQAPPID","post")."'", $str);
$str=preg_replace("/'IN_QQAPPKEY', '(.*?)'/", "'IN_QQAPPKEY', '".SafeRequest("IN_QQAPPKEY","post")."'", $str);
$str=preg_replace("/'IN_REGOPEN', '(.*?)'/", "'IN_REGOPEN', '".SafeRequest("IN_REGOPEN","post")."'", $str);
$str=preg_replace("/'IN_SHAREOPEN', '(.*?)'/", "'IN_SHAREOPEN', '".SafeRequest("IN_SHAREOPEN","post")."'", $str);
$str=preg_replace("/'IN_ONLINEHOLD', '(.*?)'/", "'IN_ONLINEHOLD', '".SafeRequest("IN_ONLINEHOLD","post")."'", $str);
$str=preg_replace("/'IN_FEEDDAY', '(.*?)'/", "'IN_FEEDDAY', '".SafeRequest("IN_FEEDDAY","post")."'", $str);
$str=preg_replace("/'IN_FOOTPRINTDAY', '(.*?)'/", "'IN_FOOTPRINTDAY', '".SafeRequest("IN_FOOTPRINTDAY","post")."'", $str);
$str=preg_replace("/'IN_MESSAGEDAY', '(.*?)'/", "'IN_MESSAGEDAY', '".SafeRequest("IN_MESSAGEDAY","post")."'", $str);
$str=preg_replace("/'IN_LISTENDAY', '(.*?)'/", "'IN_LISTENDAY', '".SafeRequest("IN_LISTENDAY","post")."'", $str);
$str=preg_replace("/'IN_MAILDAY', '(.*?)'/", "'IN_MAILDAY', '".SafeRequest("IN_MAILDAY","post")."'", $str);
$str=preg_replace("/'IN_REGPOINTS', '(.*?)'/", "'IN_REGPOINTS', '".SafeRequest("IN_REGPOINTS","post")."'", $str);
$str=preg_replace("/'IN_REGRANK', '(.*?)'/", "'IN_REGRANK', '".SafeRequest("IN_REGRANK","post")."'", $str);
$str=preg_replace("/'IN_LOGINDAYPOINTS', '(.*?)'/", "'IN_LOGINDAYPOINTS', '".SafeRequest("IN_LOGINDAYPOINTS","post")."'", $str);
$str=preg_replace("/'IN_LOGINDAYRANK', '(.*?)'/", "'IN_LOGINDAYRANK', '".SafeRequest("IN_LOGINDAYRANK","post")."'", $str);
$str=preg_replace("/'IN_SIGNDAYPOINTS', '(.*?)'/", "'IN_SIGNDAYPOINTS', '".SafeRequest("IN_SIGNDAYPOINTS","post")."'", $str);
$str=preg_replace("/'IN_SIGNDAYRANK', '(.*?)'/", "'IN_SIGNDAYRANK', '".SafeRequest("IN_SIGNDAYRANK","post")."'", $str);
$str=preg_replace("/'IN_SIGNVIPOPEN', '(.*?)'/", "'IN_SIGNVIPOPEN', '".SafeRequest("IN_SIGNVIPOPEN","post")."'", $str);
$str=preg_replace("/'IN_AVATARPOINTS', '(.*?)'/", "'IN_AVATARPOINTS', '".SafeRequest("IN_AVATARPOINTS","post")."'", $str);
$str=preg_replace("/'IN_AVATARRANK', '(.*?)'/", "'IN_AVATARRANK', '".SafeRequest("IN_AVATARRANK","post")."'", $str);
$str=preg_replace("/'IN_MAILPOINTS', '(.*?)'/", "'IN_MAILPOINTS', '".SafeRequest("IN_MAILPOINTS","post")."'", $str);
$str=preg_replace("/'IN_MAILRANK', '(.*?)'/", "'IN_MAILRANK', '".SafeRequest("IN_MAILRANK","post")."'", $str);
$str=preg_replace("/'IN_MUSICINPOINTS', '(.*?)'/", "'IN_MUSICINPOINTS', '".SafeRequest("IN_MUSICINPOINTS","post")."'", $str);
$str=preg_replace("/'IN_MUSICINRANK', '(.*?)'/", "'IN_MUSICINRANK', '".SafeRequest("IN_MUSICINRANK","post")."'", $str);
$str=preg_replace("/'IN_SPECIALINPOINTS', '(.*?)'/", "'IN_SPECIALINPOINTS', '".SafeRequest("IN_SPECIALINPOINTS","post")."'", $str);
$str=preg_replace("/'IN_SPECIALINRANK', '(.*?)'/", "'IN_SPECIALINRANK', '".SafeRequest("IN_SPECIALINRANK","post")."'", $str);
$str=preg_replace("/'IN_SINGERINPOINTS', '(.*?)'/", "'IN_SINGERINPOINTS', '".SafeRequest("IN_SINGERINPOINTS","post")."'", $str);
$str=preg_replace("/'IN_SINGERINRANK', '(.*?)'/", "'IN_SINGERINRANK', '".SafeRequest("IN_SINGERINRANK","post")."'", $str);
$str=preg_replace("/'IN_VIDEOINPOINTS', '(.*?)'/", "'IN_VIDEOINPOINTS', '".SafeRequest("IN_VIDEOINPOINTS","post")."'", $str);
$str=preg_replace("/'IN_VIDEOINRANK', '(.*?)'/", "'IN_VIDEOINRANK', '".SafeRequest("IN_VIDEOINRANK","post")."'", $str);
$str=preg_replace("/'IN_MUSICOUTPOINTS', '(.*?)'/", "'IN_MUSICOUTPOINTS', '".SafeRequest("IN_MUSICOUTPOINTS","post")."'", $str);
$str=preg_replace("/'IN_MUSICOUTRANK', '(.*?)'/", "'IN_MUSICOUTRANK', '".SafeRequest("IN_MUSICOUTRANK","post")."'", $str);
$str=preg_replace("/'IN_SPECIALOUTPOINTS', '(.*?)'/", "'IN_SPECIALOUTPOINTS', '".SafeRequest("IN_SPECIALOUTPOINTS","post")."'", $str);
$str=preg_replace("/'IN_SPECIALOUTRANK', '(.*?)'/", "'IN_SPECIALOUTRANK', '".SafeRequest("IN_SPECIALOUTRANK","post")."'", $str);
$str=preg_replace("/'IN_SINGEROUTPOINTS', '(.*?)'/", "'IN_SINGEROUTPOINTS', '".SafeRequest("IN_SINGEROUTPOINTS","post")."'", $str);
$str=preg_replace("/'IN_SINGEROUTRANK', '(.*?)'/", "'IN_SINGEROUTRANK', '".SafeRequest("IN_SINGEROUTRANK","post")."'", $str);
$str=preg_replace("/'IN_VIDEOOUTPOINTS', '(.*?)'/", "'IN_VIDEOOUTPOINTS', '".SafeRequest("IN_VIDEOOUTPOINTS","post")."'", $str);
$str=preg_replace("/'IN_VIDEOOUTRANK', '(.*?)'/", "'IN_VIDEOOUTRANK', '".SafeRequest("IN_VIDEOOUTRANK","post")."'", $str);

if(!$fp = fopen('source/system/config.inc.php', 'w')) {
	ShowMessage("����ʧ�ܣ��ļ�{source/system/config.inc.php}û��д��Ȩ�ޣ�",$_SERVER['HTTP_REFERER'],"infotitle3",3000,1);
}
	$ifile = new iFile('source/system/config.inc.php', 'w');
	$ifile->WriteFile($str, 3);
	ShowMessage("��ϲ�������ñ���ɹ���",$_SERVER['HTTP_REFERER'],"infotitle2",1000,1);
}
?>