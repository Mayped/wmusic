<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<?php include 'source/user/space/common.php'; ?>
<?php include 'source/user/space/space_head.php'; ?>
<?php include 'source/user/people/top.php'; ?>
<?php include 'source/user/space/space_left.php'; ?>
<?php include 'source/user/space/space_center.php'; ?>
<?php global $db; ?>
<div class="feed">
<h3 class="feed_header">��־</h3>
<?php
$Arr = getuserpage("select * from ".tname('blog')." where in_uid=".$ear['in_userid']." order by in_addtime desc", 20, 4);
$result = $db->query($Arr[2]);
$count = $db->num_rows($result);
if($count == 0){
?>
<div class="c_form">û�п��Ķ�����־��</div>
<?php }else{ ?>
<ul>
<?php
while ($row = $db->fetch_array($result)){
$content = getblog($row['in_content'], 1);
?>
<li>
<span class="gray r_option"><?php echo datetime($row['in_addtime']); ?></span>
<h4><a href="<?php echo getlink($row['in_id'], 'blog'); ?>" target="_blank"><?php echo $row['in_title']; ?></a></h4>
<div class="detail"><?php echo $content; ?></div>
</li>
<?php } ?>
</ul>
<?php echo $Arr[0]; ?>
<p style="padding:5px 0 10px 0;">&nbsp;</p>
<?php } ?>
</div>
<?php include 'source/user/space/space_right.php'; ?>
<?php include 'source/user/people/bottom.php'; ?>
</body>
</html>