<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<?php global $userlogined; ?>
<div id="app_sidebar">
        <?php if($userlogined){ ?>
        <ul class="app_list">
                <li><img src="<?php echo IN_PATH; ?>static/user/images/icon/feed.gif"><a href="<?php echo rewrite_mode('user.php/feed/index/'); ?>">˵˵</a></li>
                <li><img src="<?php echo IN_PATH; ?>static/user/images/icon/music.gif"><a href="<?php echo rewrite_mode('user.php/music/index/'); ?>">����</a><em><a href="<?php echo rewrite_mode('user.php/music/add/'); ?>" class="gray">�ϴ�</a></em></li>
                <li><img src="<?php echo IN_PATH; ?>static/user/images/icon/special.gif"><a href="<?php echo rewrite_mode('user.php/special/index/'); ?>">ר��</a><em><a href="<?php echo rewrite_mode('user.php/special/add/'); ?>" class="gray">����</a></em></li>
                <li><img src="<?php echo IN_PATH; ?>static/user/images/icon/singer.gif"><a href="<?php echo rewrite_mode('user.php/singer/index/'); ?>">����</a><em><a href="<?php echo rewrite_mode('user.php/singer/add/'); ?>" class="gray">����</a></em></li>
                <li><img src="<?php echo IN_PATH; ?>static/user/images/icon/video.gif"><a href="<?php echo rewrite_mode('user.php/video/index/'); ?>">��Ƶ</a><em><a href="<?php echo rewrite_mode('user.php/video/add/'); ?>" class="gray">����</a></em></li>
                <li><img src="<?php echo IN_PATH; ?>static/user/images/icon/photo.gif"><a href="<?php echo rewrite_mode('user.php/photo/index/'); ?>">��Ƭ</a></li>
                <li><img src="<?php echo IN_PATH; ?>static/user/images/icon/blog.gif"><a href="<?php echo rewrite_mode('user.php/blog/index/'); ?>">��־</a></li>
                <li><img src="<?php echo IN_PATH; ?>static/user/images/icon/friend.gif"><a href="<?php echo rewrite_mode('user.php/friend/index/'); ?>">����</a></li>
                <li><img src="<?php echo IN_PATH; ?>static/user/images/icon/message.gif"><a href="<?php echo rewrite_mode('user.php/message/index/'); ?>">��Ϣ</a></li>
                <li><img src="<?php echo IN_PATH; ?>static/user/images/icon/rank.gif"><a href="<?php echo rewrite_mode('user.php/misc/rank/'); ?>">����</a></li>
                <li><img src="<?php echo IN_PATH; ?>static/user/images/icon/search.gif"><a href="<?php echo rewrite_mode('user.php/misc/search/'); ?>">����</a></li>
                <li><img src="<?php echo IN_PATH; ?>static/user/images/icon/profile.gif"><a href="<?php echo rewrite_mode('user.php/profile/index/'); ?>">����</a></li>
        </ul>
        <ul class="app_list topline"></ul>
        <?php echo left_plugin(); ?>
        <?php }else{ ?>
        <div class="bar_text">
        <form method="get" onsubmit="login(2);return false;">
        <p class="title">��¼��վ</p>
        <p>�û���</p>
        <p><input type="text" id="username" class="t_input" size="15" /></p>
        <p>�ܡ���</p>
        <p><input type="password" id="password" class="t_input" size="15" /></p>
        <p>��֤��</p>
        <p><input type="text" id="seccode" class="t_input" style="width:45px;" maxlength="4" />&nbsp;<img id="img_seccode" src="<?php echo rewrite_mode('user.php/people/seccode/'); ?>" align="absmiddle" /></p>
        <p style="margin-top:5px;"><a href="javascript:update_seccode()">����</a></p>
        <p style="margin-top:10px;"><input type="submit" value="��¼" class="submit" />&nbsp;<input type="button" value="ע��" class="button" onclick="location.href='<?php echo rewrite_mode('user.php/people/register/'); ?>';"></p>
        <p style="margin-top:10px;"><a href="javascript:void(0)" onclick="pop.up('no', 'QQ��¼', in_path+'source/pack/connect/login.php', '700px', '430px', '100px');"><img src="<?php echo IN_PATH; ?>static/user/images/connect.gif" /></a></p>
        </form>
        </div>
        <?php } ?>
</div>