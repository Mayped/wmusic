<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<?php global $userlogined,$erduo_in_rank,$erduo_in_points,$erduo_in_grade,$erduo_in_vipgrade,$erduo_in_vipindate,$erduo_in_vipenddate; ?>
<?php if(!$userlogined){header("location:".rewrite_mode('user.php/people/login/'));exit();} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>�ҵĻ��� - <?php echo IN_NAME; ?></title>
<meta name="Keywords" content="<?php echo IN_KEYWORDS; ?>" />
<meta name="Description" content="<?php echo IN_DESCRIPTION; ?>" />
<style type="text/css">
@import url(<?php echo IN_PATH; ?>static/user/css/style.css);
</style>
</head>
<body>
<?php include 'source/user/people/top.php'; ?>
<div id="main">
<?php include 'source/user/people/left.php'; ?>
<div id="mainarea">
<h2 class="title"><img src="<?php echo IN_PATH; ?>static/user/images/icon/profile.gif">��������</h2>
<div class="tabs_header">
<ul class="tabs">
<li><a href="<?php echo rewrite_mode('user.php/profile/index/'); ?>"><span>��������</span></a></li>
<li><a href="<?php echo rewrite_mode('user.php/profile/avatar/'); ?>"><span>�ҵ�ͷ��</span></a></li>
<li class="active"><a href="<?php echo rewrite_mode('user.php/profile/credit/'); ?>"><span>�����˻�</span></a></li>
<li><a href="<?php echo rewrite_mode('user.php/profile/oauth/'); ?>"><span>�ʺŰ�</span></a></li>
</ul>
</div>
<div class="l_status c_form">
<a href="<?php echo rewrite_mode('user.php/profile/credit/'); ?>" class="active">�ҵĻ���</a><span class="pipe">|</span>
<a href="<?php echo rewrite_mode('user.php/profile/vip/'); ?>">��ͨ��Ա</a><span class="pipe">|</span>
<a href="<?php echo rewrite_mode('user.php/profile/pay/'); ?>">��ֵ���</a>
</div>
<div class="c_form">
<table cellspacing="0" cellpadding="0" class="formtable">
<tr><th width="150">����ֵ:</th><td><span style="color:#3B5998;font-size:14px;"><?php echo $erduo_in_rank; ?></span> <?php echo getlevel($erduo_in_rank); ?></td></tr>
<tr><th width="150">&nbsp;</th><td class="gray">����ÿ�� <strong>100</strong> ����ͼ��ͻ���һ��<br />
<?php
$level = 'ͼ��ȼ��ɵ͵���Ϊ��';
for($i=1;$i<11;$i++){
        $level .= '<img src="'.IN_PATH.'static/user/images/level/star_level'.$i.'.gif" align="absmiddle">';
}
echo $level;
?>
</td></tr>
<tr><th width="150">�����:</th><td><img src="<?php echo IN_PATH; ?>static/user/images/credit.gif"> <span style="color:red;font-size:14px;"><?php echo $erduo_in_points; ?></span></td></tr>
<tr><th width="150">�û��ȼ�:</th><td>
<?php
if($erduo_in_grade == 0){
        echo '��ͨ�û� <img src="'.IN_PATH.'static/user/images/vip/novip.jpg" align="absmiddle"></td></tr>';
}else{
        if($erduo_in_vipgrade == 1){
                echo '<span style="color:green;">�¸���Ա</span> <img src="'.IN_PATH.'static/user/images/vip/vip.png" align="absmiddle"> <img src="'.IN_PATH.'static/user/images/vip/no_year_vip.jpg" align="absmiddle"></td></tr>';
        }elseif($erduo_in_vipgrade == 2){
                echo '<span style="color:green;">�긶��Ա</span> <img src="'.IN_PATH.'static/user/images/vip/vip.png" align="absmiddle"> <img src="'.IN_PATH.'static/user/images/vip/year_vip.jpg" align="absmiddle"></td></tr>';
        }
        echo '<tr><th width="150">&nbsp;</th><td class="gray">ҵ���� <strong>'.$erduo_in_vipindate.'</strong> ��ͨ������ <strong>'.$erduo_in_vipenddate.'</strong> ����<br />';
        echo '��Ա����ʣ <strong style="color:green;">'.floor(DateDiff(date('Y-m-d H:i:s'), $erduo_in_vipenddate) / 3600 / 24).'</strong> ��</td></tr>';
}
?>
</table>
<br />
<table cellspacing="0" cellpadding="0" class="listtable">
<caption>
<h2>���ֽ�������</h2>
<p>���������¼���������õ����ֽ�������������һ�������ڣ������õ��Ľ������������ơ�</p>
</caption>
<thead>
<tr class="title">
<td>��������</td>
<td align="center">���ڷ�Χ</td>
<td align="center">�������</td>
<td align="center">��������</td>
</tr>
</thead>
<tr class="line">
<td>ע���û�</td>
<td align="center">һ����</td>
<td align="center"><?php echo IN_REGPOINTS; ?></td>
<td align="center"><?php echo IN_REGRANK; ?></td>
</tr>
<tr>
<td>ÿ�յ�¼</td>
<td align="center">ÿ��</td>
<td align="center"><?php echo IN_LOGINDAYPOINTS; ?></td>
<td align="center"><?php echo IN_LOGINDAYRANK; ?></td>
</tr>
<tr>
<td>ÿ��ǩ��</td>
<td align="center">ÿ��</td>
<td align="center"><?php echo IN_SIGNDAYPOINTS; ?>*����ǩ������</td>
<td align="center"><?php echo IN_SIGNDAYRANK; ?>*����ǩ������</td>
</tr>
<tr>
<td>�ϴ�ͷ��</td>
<td align="center">һ����</td>
<td align="center"><?php echo IN_AVATARPOINTS; ?></td>
<td align="center"><?php echo IN_AVATARRANK; ?></td>
</tr>
<tr>
<td>��֤����</td>
<td align="center">һ����</td>
<td align="center"><?php echo IN_MAILPOINTS; ?></td>
<td align="center"><?php echo IN_MAILRANK; ?></td>
</tr>
<tr>
<td>�������</td>
<td align="center">��������</td>
<td align="center"><?php echo IN_MUSICINPOINTS; ?></td>
<td align="center"><?php echo IN_MUSICINRANK; ?></td>
</tr>
<tr>
<td>���ר��</td>
<td align="center">��������</td>
<td align="center"><?php echo IN_SPECIALINPOINTS; ?></td>
<td align="center"><?php echo IN_SPECIALINRANK; ?></td>
</tr>
<tr>
<td>��˸���</td>
<td align="center">��������</td>
<td align="center"><?php echo IN_SINGERINPOINTS; ?></td>
<td align="center"><?php echo IN_SINGERINRANK; ?></td>
</tr>
<tr>
<td>�����Ƶ</td>
<td align="center">��������</td>
<td align="center"><?php echo IN_VIDEOINPOINTS; ?></td>
<td align="center"><?php echo IN_VIDEOINRANK; ?></td>
</tr>
</table>
<br />
<table cellspacing="0" cellpadding="0" class="listtable">
<caption>
<h2>���ֳͷ�����</h2>
<p>�����¼���������ʱ����ۼ����֡����У��Լ���������Ϣ�Լ�ɾ�������ۼ����֣�������Աɾ���Ż�ۼ����֡�</p>
</caption>
<thead>
<tr class="title">
<td>��������</td>
<td align="center">���ڷ�Χ</td>
<td align="center">�ۼ����</td>
<td align="center">�ۼ�����</td>
</tr>
</thead>
<tr class="line">
<td>ɾ������</td>
<td align="center">��������</td>
<td align="center"><?php echo IN_MUSICOUTPOINTS; ?></td>
<td align="center"><?php echo IN_MUSICOUTRANK; ?></td>
</tr>
<tr>
<td>ɾ��ר��</td>
<td align="center">��������</td>
<td align="center"><?php echo IN_SPECIALOUTPOINTS; ?></td>
<td align="center"><?php echo IN_SPECIALOUTRANK; ?></td>
</tr>
<tr>
<td>ɾ������</td>
<td align="center">��������</td>
<td align="center"><?php echo IN_SINGEROUTPOINTS; ?></td>
<td align="center"><?php echo IN_SINGEROUTRANK; ?></td>
</tr>
<tr>
<td>ɾ����Ƶ</td>
<td align="center">��������</td>
<td align="center"><?php echo IN_VIDEOOUTPOINTS; ?></td>
<td align="center"><?php echo IN_VIDEOOUTRANK; ?></td>
</tr>
</table>
</div>
</div>
<div id="bottom"></div>
</div>
<?php include 'source/user/people/bottom.php'; ?>
</body>
</html>