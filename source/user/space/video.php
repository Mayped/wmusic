<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<?php include 'source/user/space/common.php'; ?>
<?php include 'source/user/space/space_head.php'; ?>
<?php include 'source/user/people/top.php'; ?>
<?php include 'source/user/space/space_left.php'; ?>
<?php include 'source/user/space/space_center.php'; ?>
<?php global $db; ?>
<div class="feed">
<h3 class="feed_header">视频</h3>
<?php
$Arr = getuserpage("select * from ".tname('video')." where in_uid=".$ear['in_userid']." order by in_addtime desc", 20, 4);
$result = $db->query($Arr[2]);
$count = $db->num_rows($result);
if($count == 0){
?>
<div class="c_form">还没有相关的视频。</div>
<?php }else{ ?>
<ul>
<?php
while ($row = $db->fetch_array($result)){
?>
<li>
<div style="width:100%;overflow:hidden;">
<span class="gray"><?php echo $row['in_addtime']; ?></span>
<div class="feed_content">
<a href="<?php echo getlink($row['in_id'], 'video'); ?>" target="_blank"><img src="<?php echo geturl($row['in_cover'], 'cover'); ?>" class="summaryimg"></a>
<div class="detail"><b><a target="_blank" href="<?php echo getlink($row['in_id'], 'video'); ?>"><?php echo $row['in_name']; ?></a></b><br /></div>
<div class="quote"><span class="q"><?php echo getlenth($row['in_intro'], 100); ?></span></div>
</div>
</div>
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