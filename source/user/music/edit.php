<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<?php global $db,$userlogined,$erduo_in_userid; ?>
<?php if(!$userlogined){header("location:".rewrite_mode('user.php/people/login/'));exit();} ?>
<?php
if(IN_UPOPEN == 1){
        $script = IN_PATH."source/pack/upload/save.php";
}elseif(IN_REMOTE == 1){
        $script = IN_PATH."source/plugin/".IN_REMOTEPK."/save.php";
        if(!is_file(str_replace('/'.IN_PATH, IN_ROOT, '/'.$script))){
                $script = IN_PATH."source/pack/upload/save.php";
        }
}else{
        $script = IN_PATH."source/pack/ftp/save.php";
}
$music = explode('/', $_SERVER['PATH_INFO']);
$mid = isset($music[3]) ? $music[3] : NULL;
if(IsNum($mid)){
$get = $db->getrow("select * from ".tname('music')." where in_uid=".$erduo_in_userid." and in_passed=1 and in_id=".$mid);
}else{
$get = false;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>�༭���� - <?php echo IN_NAME; ?></title>
<meta name="Keywords" content="<?php echo IN_KEYWORDS; ?>" />
<meta name="Description" content="<?php echo IN_DESCRIPTION; ?>" />
<link href="<?php echo IN_PATH; ?>static/pack/asynctips/asynctips.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/asynctips/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/asynctips/asyncbox.v1.4.5.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/lib.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/confirm-html.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/user/js/lib.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/user/js/music.js"></script>
<script type="text/javascript">
var in_path = '<?php echo IN_PATH; ?>';
var guide_url = '<?php echo rewrite_mode('user.php/music/passed/'); ?>';
var pop = {
	up: function(scrolling, text, url, width, height, top) {
		layer.open({
			type: 2,
			maxmin: true,
			title: text,
			content: [url, scrolling],
			area: [width, height],
			offset: top,
			shade: false
		});
	},
	record: function() {
		$.flayer({
			type: 1,
			title: '¼����Ƶ',
			area: ['auto', 'auto'],
			page: {html: '<object id="as_js" type="application/x-shockwave-flash" width="811" height="140"><param name="movie" value="' + in_path + 'static/pack/upload/record.swf" /><param name="wmode" value="transparent" /></object>'}
		});
	}
}
function f_getURL() {
	return '<?php echo $script; ?>';
}
function f_getMAX() {
	return 3600;
}
function f_getMIN() {
	return 10;
}
function f_complete(filename) {
	if (filename == 'error'){
		asyncbox.tips("������������ԣ�", "error", 3000);
	}else{
		document.form.in_audio.value = filename;
		asyncbox.tips("��ϲ���ļ�¼�Ƴɹ���", "success", 1000);
	}
	flayer.closeAll();
}
</script>
<style type="text/css">
@import url(<?php echo IN_PATH; ?>static/user/css/style.css);
</style>
</head>
<body>
<?php include 'source/user/people/top.php'; ?>
<div id="main">
<?php include 'source/user/people/left.php'; ?>
<div id="mainarea">
<h2 class="title"><img src="<?php echo IN_PATH; ?>static/user/images/icon/music.gif">����</h2>
<div class="tabs_header">
<ul class="tabs">
<li><a href="<?php echo rewrite_mode('user.php/music/index/'); ?>"><span>��������</span></a></li>
<li><a href="<?php echo rewrite_mode('user.php/music/passed/'); ?>"><span>��������</span></a></li>
<li><a href="<?php echo rewrite_mode('user.php/music/song/'); ?>"><span>�ҵĸ赥</span></a></li>
<li class="null"><a href="<?php echo rewrite_mode('user.php/music/add/'); ?>">�ϴ�����</a></li>
</ul>
</div>
<?php if($get){ ?>
<form method="get" name="form" onsubmit="editmusic(<?php echo $get['in_id']; ?>);return false;" class="c_form">
<table cellspacing="0" cellpadding="0" class="formtable"><caption><h2>�༭����</h2></caption>
<tr><th style="width:10em;">��������:</th><td><input type="text" id="in_name" value="<?php echo $get['in_name']; ?>" class="t_input" size="30" /></td></tr>
<tr><th style="width:10em;">��������:</th><td>
<select id="in_classid">
<option value="0">ѡ�����</option>
<?php
$result=$db->query("select * from ".tname('class')." order by in_id asc");
if($result){
        while ($row = $db->fetch_array($result)){
                if($get['in_classid'] == $row['in_id']){
                        echo "<option value=\"".$row['in_id']."\" selected=\"selected\">".$row['in_name']."</option>";
                }else{
                        echo "<option value=\"".$row['in_id']."\">".$row['in_name']."</option>";
                }
        }
}
?>
</select>
</td></tr>
<tr><th style="width:10em;">ѡ��ר��:</th><td>
<select id="in_specialid">
<option value="0">��ѡ��</option>
<?php
$result=$db->query("select * from ".tname('special')." order by in_addtime desc");
if($result){
        while ($row = $db->fetch_array($result)){
                if($get['in_specialid'] == $row['in_id']){
                        echo "<option value=\"".$row['in_id']."\" selected=\"selected\">".$row['in_name']."</option>";
                }else{
                        echo "<option value=\"".$row['in_id']."\">".$row['in_name']."</option>";
                }
        }
}
?>
</select>
<input type="button" class="button" value="ѡ��" onclick="pop.up('yes', 'ѡ��ר��', in_path+'source/pack/tag/special_opt.php?so=form.in_specialid', '500px', '400px', '115px');" />
</td></tr>
<tr><th style="width:10em;">ѡ�����:</th><td>
<select id="in_singerid">
<option value="0">��ѡ��</option>
<?php
$result=$db->query("select * from ".tname('singer')." order by in_addtime desc");
if($result){
        while ($row = $db->fetch_array($result)){
                if($get['in_singerid'] == $row['in_id']){
                        echo "<option value=\"".$row['in_id']."\" selected=\"selected\">".$row['in_name']."</option>";
                }else{
                        echo "<option value=\"".$row['in_id']."\">".$row['in_name']."</option>";
                }
        }
}
?>
</select>
<input type="button" class="button" value="ѡ��" onclick="pop.up('yes', 'ѡ�����', in_path+'source/pack/tag/singer_opt.php?so=form.in_singerid', '500px', '400px', '115px');" />
</td></tr>
<tr><th style="width:10em;">���ֱ�ǩ:</th><td>
<input type="text" id="in_tag" value="<?php echo $get['in_tag']; ?>" class="t_input" size="30" />
<input type="button" class="button" value="���" onclick="pop.up('yes', '��ӱ�ǩ', in_path+'source/pack/tag/open.php?form=form.in_tag', '540px', '400px', '115px');" />
</td></tr>
<tr><th style="width:10em;">��Ƶ��ַ:</th><td>
<input type="text" id="in_audio" value="<?php echo $get['in_audio']; ?>" class="t_input" size="45" />
<input type="button" class="button" value="�ϴ���Ƶ" onclick="pop.up('no', '�ϴ���Ƶ', in_path+'source/pack/upload/open.php?mode=1&type=music_audio&form=form.in_audio', '406px', '180px', '225px');" />
<input type="button" style="padding:0 5px;margin:0 0 0 3px;height:24px;border:none;background:#DDD;color:#F60;line-height:20px;letter-spacing:1px;cursor:pointer" value="¼����Ƶ" onclick="pop.record();" />
</td></tr>
<tr><th style="width:10em;">�����ַ:</th><td>
<input type="text" id="in_cover" value="<?php echo $get['in_cover']; ?>" class="t_input" size="45" />
<input type="button" class="button" value="�ϴ�����" onclick="pop.up('no', '�ϴ�����', in_path+'source/pack/upload/open.php?mode=1&type=music_cover&form=form.in_cover', '406px', '180px', '225px');" />
</td></tr>
<tr><th style="width:10em;">��ʵ�ַ:</th><td>
<input type="text" id="in_lyric" value="<?php echo $get['in_lyric']; ?>" class="t_input" size="45" />
<input type="button" class="button" value="�ϴ����" onclick="pop.up('no', '�ϴ����', in_path+'source/pack/upload/open.php?mode=1&type=music_lyric&form=form.in_lyric', '406px', '180px', '225px');" />
</td></tr>
<tr><th>�ı����:</th><td><textarea id="in_text" cols="40" rows="4" style="width: 282px; height: 118px;"><?php echo $get['in_text']; ?></textarea></td></tr>
<tr><th style="width:10em;"></th><td><input type="submit" value="����༭" class="submit" /></td></tr>
</table>
</form>
<?php }else{ ?>
<div id="content" style="width:100%;"><div class="c_form">���ֲ����ڻ�����Ȩ�༭��</div></div>
<?php } ?>
</div>
<div id="bottom"></div>
</div>
<?php include 'source/user/people/bottom.php'; ?>
</body>
</html>