<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<?php global $db; ?>
<?php
$invisible = $db->getone("select in_invisible from ".tname('session')." where in_uid=".$ear['in_userid']);
$online = is_numeric($invisible) && $invisible == 0 ? '<a href="'.rewrite_mode('user.php/misc/rank/online/').'" title="��ǰ����"><img src="'.IN_PATH.'static/user/images/online_icon.gif" align="absmiddle"></a>&nbsp;' : '';
$last_doing = '';
$query = $db->query("select * from ".tname('feed')." where in_uid=".$ear['in_userid']." and in_type=0 order by in_addtime desc LIMIT 0,1");
while ($row = $db->fetch_array($query)){
$last_doing = preg_replace('/\[em:(\d+)]/is', '<img src="'.IN_PATH.'static/user/images/face/\1.gif" class="face">', $row['in_content']);
}
?>
<div id="content">
<h3 id="spaceindex_name">
<?php echo $online; ?><a href="<?php echo getlink($ear['in_userid']); ?>"><?php echo $ear['in_username']; ?></a>
<?php if($ear['in_grade'] == 1){ ?>
<a href="<?php echo rewrite_mode('user.php/profile/vip/'); ?>" title="�����Ա"><img src="<?php echo IN_PATH; ?>static/user/images/vip/vip.gif" align="absmiddle" /></a>
<?php } ?>
<?php if($ear['in_isstar'] == 1){ ?>
<a href="<?php echo rewrite_mode('user.php/profile/verify/'); ?>" title="������֤"><img src="<?php echo IN_PATH; ?>static/user/images/star.png" align="absmiddle" /></a>
<?php } ?>
<?php echo getlevel($ear['in_rank'], 1); ?>
</h3>
<div id="spaceindex_note">
<a href="javascript:void(0)" onclick="spaceshare(<?php echo $ear['in_userid']; ?>);" class="a_share">�Ƽ�</a>
<ul class="note_list">
<li>���� <?php echo $ear['in_hits']; ?> ������, <?php echo $ear['in_points']; ?> �����, <?php echo $ear['in_rank']; ?> ������</li>
<li>�û��ȼ���<a href="<?php echo rewrite_mode('user.php/profile/vip/'); ?>"><?php if($ear['in_grade'] == 1){echo "�����Ա";}else{echo "��ͨ�û�";} ?></a> </li>
<li>��ҳ��ַ��<a href="javascript:void(0)" id="space_link" onclick="setcopy(this.id, '<?php echo "http://".$_SERVER['HTTP_HOST'].getlink($ear['in_userid']); ?>');"><?php echo "http://".$_SERVER['HTTP_HOST'].getlink($ear['in_userid']); ?></a></li>
<li><?php echo $last_doing; ?></li>
</ul>
</div>
<?php if($ear['in_isstar'] == 1){ ?>
<div class="borderbox">
<p style="padding-bottom:10px;">���û���ͨ��������֤�����Ը�TA�����ԣ����߷���˽�ţ��������Ϊ���ѡ�<br />��Ϊ���Ѻ����Ϳ��Ե�һʱ���ע��TA�ĸ��¶�̬��</p>
<a href="javascript:void(0)" onclick="pop.friend('<?php echo $ear['in_username']; ?>');" class="submit">��Ϊ����</a>
</div><br />
<?php } ?>