<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<?php global $userlogined,$erduo_in_userid,$erduo_in_username,$erduo_in_points; ?>
<div id="append_parent"></div>
<div id="header">
        <div class="headerwarp">
                <h1 class="logo"><a href="<?php if($userlogined){echo rewrite_mode('user.php/people/home/');}else{echo IN_PATH.'user.php';} ?>"><img src="<?php echo IN_PATH; ?>static/user/images/logo.gif" /></a></h1>
                <ul id="ucappmenu_menu" class="dropmenu_drop" style="position:absolute;z-index:50;clip:rect(auto auto auto auto);left:602px;top:40px;display:none;">
                        <li><a href="<?php echo rewrite_mode('user.php/people/home/'); ?>">������ҳ</a></li>
                        <li><a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].IN_PATH; ?>" target="_blank">��վ��ҳ</a></li>
                </ul>
                <ul class="menu">
                        <li class="dropmenu" onclick="document.getElementById('ucappmenu_menu').style.display=''"><a href="javascript:void(0)">��ҳ</a></li>
                        <li><a href="<?php if($userlogined){echo getlink($erduo_in_userid);}else{echo rewrite_mode('user.php/people/login/');} ?>">������ҳ</a></li>
                        <li><a href="<?php echo rewrite_mode('user.php/friend/index/'); ?>">����</a></li>
                        <li><a href="<?php echo IN_PATH; ?>user.php">��㿴��</a></li>
                        <li><a href="<?php echo rewrite_mode('user.php/message/index/'); ?>">��Ϣ</a></li>
                        <?php if($userlogined && top_message($erduo_in_userid)){ ?>
                        <li class="notify"><a href="<?php echo rewrite_mode('user.php/message/read/'); ?>"><?php echo top_message($erduo_in_userid); ?>��˽��</a></li>
                        <?php } ?>
                </ul>
                <div class="nav_account">
                        <?php if($userlogined){ ?>
                        <a href="<?php echo getlink($erduo_in_userid); ?>" class="login_thumb"><img src="<?php echo getavatar($erduo_in_userid); ?>"></a>
                        <a href="<?php echo getlink($erduo_in_userid); ?>" class="loginName"><?php echo $erduo_in_username; ?></a>
                        <a href="<?php echo rewrite_mode('user.php/profile/credit/'); ?>" style="font-size:11px;padding:0 0 0 5px;"><img src="<?php echo IN_PATH; ?>static/user/images/credit.gif"><?php echo $erduo_in_points; ?></a><br />
                        <a href="<?php echo rewrite_mode('user.php/profile/index/'); ?>">��������</a> 
                        <a href="<?php echo rewrite_mode('user.php/people/logout/'); ?>">�˳�</a>
                        <?php }else{ ?>
                        <a href="<?php echo rewrite_mode('user.php/people/login/'); ?>" class="login_thumb"><img src="<?php echo getavatar(0); ?>"></a>��ӭ��<br />
                        <a href="<?php echo rewrite_mode('user.php/people/login/'); ?>">��¼</a> | 
                        <a href="<?php echo rewrite_mode('user.php/people/register/'); ?>">ע��</a>
                        <?php } ?>
                </div>
        </div>
</div>
<div id="wrap">