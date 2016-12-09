<?php
if (!defined('IN_ROOT')) {
    exit('Access denied');
}
Administrator(1);
$serverip = gethostbyname($_SERVER['SERVER_NAME']);
$serverinfo = PHP_OS . ' / PHP v' . PHP_VERSION;
$serverinfo .= @ini_get('safe_mode') ? ' Safe Mode' : NULL;
$serversoft = $_SERVER['SERVER_SOFTWARE'];
$servermysql = @mysql_get_server_info();
$diskspace = function_exists('disk_free_space') ? floor(disk_free_space(IN_ROOT) / (1024 * 1024)) . 'M' : '<span style="color:#C00">unknow</span>';
$attachmentupload = @ini_get('file_uploads') ? ini_get('upload_max_filesize') : '<span style="color:#C00">unknow</span>';
$check_file_get_contents = function_exists('file_get_contents') ? '<span style="color:#090">[√]</span>' : '<span style="color:#C00">[×]</span>';
$check_allow_url_fopen = ini_get('allow_url_fopen') ? '<span style="color:#090">[√]</span>' : '<span style="color:#C00">[×]</span>';
$check_fsockopen = function_exists('fsockopen') ? '<span style="color:#090">[√]</span>' : '<span style="color:#C00">[×]</span>';
$check_curl_init = function_exists('curl_init') ? '<span style="color:#090">[√]</span>' : '<span style="color:#C00">[×]</span>';
global $db;
$user = $db->num_rows($db->query("select * from " . tname('user')));
$user_verify = $db->num_rows($db->query("select * from " . tname('user') . " where in_isstar=2"));
$music = $db->num_rows($db->query("select * from " . tname('music')));
$music_pass = $db->num_rows($db->query("select * from " . tname('music') . " where in_passed=1"));
$music_wrong = $db->num_rows($db->query("select * from " . tname('music') . " where in_wrong=1"));
$special = $db->num_rows($db->query("select * from " . tname('special')));
$special_pass = $db->num_rows($db->query("select * from " . tname('special') . " where in_passed=1"));
$singer = $db->num_rows($db->query("select * from " . tname('singer')));
$singer_pass = $db->num_rows($db->query("select * from " . tname('singer') . " where in_passed=1"));
$video = $db->num_rows($db->query("select * from " . tname('video')));
$video_pass = $db->num_rows($db->query("select * from " . tname('video') . " where in_passed=1"));
$comment = $db->num_rows($db->query("select * from " . tname('comment')));
$feed = $db->num_rows($db->query("select * from " . tname('feed') . " where in_type=0"));
$wall = $db->num_rows($db->query("select * from " . tname('wall')));
$blog = $db->num_rows($db->query("select * from " . tname('blog')));
$photo = $db->num_rows($db->query("select * from " . tname('photo')));
if (isset($_POST['submit']) == '1') {
    $content = SafeRequest("content", "post");
    if (!IsNul($content)) {
        ShowMessage("发送失败，请输入私信内容！", "?iframe=body", "infotitle3", 3000, 0);
    }
    $query = $db->query("select in_userid,in_username from " . tname('user') . " where in_islock=0");
    while ($row = $db->fetch_array($query)) {
        $setarr = array(
            'in_uid' => 0,
            'in_uname' => '系统用户',
            'in_uids' => $row['in_userid'],
            'in_unames' => $row['in_username'],
            'in_content' => $content,
            'in_isread' => 0,
            'in_addtime' => date('Y-m-d H:i:s')
        );
        inserttable('message', $setarr, 1);
    }
    ShowMessage("恭喜，该条私信已经发送给所有用户！", "?iframe=body", "infotitle2", 3000, 0);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>"/>
    <meta http-equiv="x-ua-compatible" content="ie=7"/>
    <title>首页</title>
    <link href="static/admincp/css/main.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript">function $(obj) {
            return document.getElementById(obj);
        }</script>
</head>
<body>
<div class="container">
    <script type="text/javascript">parent.document.title = '西部音乐管理中心 - 首页';
        if (parent.$('admincpnav')) parent.$('admincpnav').innerHTML = '首页';</script>
    <div class="itemtitle"><h3>西部音乐管理中心</h3></div>
    <table class="tb tb2 fixpadding">
        <form method="post">
            <tr>
                <th colspan="3" class="partition">用户私信</th>
            </tr>
            <tr>
                <td><input type="text" name="content" class="txt" style="width:300px;"><input name="submit"
                                                                                              type="hidden"
                                                                                              value="1"><input
                        value="发送" type="submit" class="btn"></td>
            </tr>
        </form>
    </table>
    <?php if ($user_verify > 0 || $music_pass > 0 || $music_wrong > 0 || $special_pass > 0 || $singer_pass > 0 || $video_pass > 0) { ?>
        <table class="tb tb2 nobdb fixpadding">
            <tr>
                <td><h3 class="left margintop">待处理事项:</h3>
                    <?php if ($user_verify > 0) { ?>
                        <p class="left difflink"><a href="?iframe=user&action=staring">待审明星</a>(<em
                                class="lightnum"><?php echo $user_verify; ?></em>)</p>
                    <?php }
                    if ($music_pass > 0) { ?>
                        <p class="left difflink"><a href="?iframe=music&action=pass">待审音乐</a>(<em
                                class="lightnum"><?php echo $music_pass; ?></em>)</p>
                    <?php }
                    if ($music_wrong > 0) { ?>
                        <p class="left difflink"><a href="?iframe=music&action=wrong">报错音乐</a>(<em
                                class="lightnum"><?php echo $music_wrong; ?></em>)</p>
                    <?php }
                    if ($special_pass > 0) { ?>
                        <p class="left difflink"><a href="?iframe=special&action=pass">待审专辑</a>(<em
                                class="lightnum"><?php echo $special_pass; ?></em>)</p>
                    <?php }
                    if ($singer_pass > 0) { ?>
                        <p class="left difflink"><a href="?iframe=singer&action=pass">待审歌手</a>(<em
                                class="lightnum"><?php echo $singer_pass; ?></em>)</p>
                    <?php }
                    if ($video_pass > 0) { ?>
                        <p class="left difflink"><a href="?iframe=video&action=pass">待审视频</a>(<em
                                class="lightnum"><?php echo $video_pass; ?></em>)</p>
                    <?php } ?>
                    <div class="clear"></div>
                </td>
            </tr>
        </table>
    <?php } ?>
    <table class="tb tb2 nobdb fixpadding">
        <tr>
            <th colspan="15" class="partition">数据统计</th>
        </tr>
        <tr>
            <td><a href="?iframe=user">用户</a>(<em class="lightnum"><?php echo $user; ?></em>)</td>
            <td><a href="?iframe=music">音乐</a>(<em class="lightnum"><?php echo $music; ?></em>)</td>
            <td><a href="?iframe=special">专辑</a>(<em class="lightnum"><?php echo $special; ?></em>)</td>
            <td><a href="?iframe=singer">歌手</a>(<em class="lightnum"><?php echo $singer; ?></em>)</td>
            <td><a href="?iframe=video">视频</a>(<em class="lightnum"><?php echo $video; ?></em>)</td>
            <td><a href="?iframe=comment">评论</a>(<em class="lightnum"><?php echo $comment; ?></em>)</td>
            <td><a href="?iframe=feed">说说</a>(<em class="lightnum"><?php echo $feed; ?></em>)</td>
            <td><a href="?iframe=wall">留言</a>(<em class="lightnum"><?php echo $wall; ?></em>)</td>
            <td><a href="?iframe=blog">日志</a>(<em class="lightnum"><?php echo $blog; ?></em>)</td>
            <td><a href="?iframe=photo">照片</a>(<em class="lightnum"><?php echo $photo; ?></em>)</td>
        </tr>
    </table>
    <table class="tb tb2 fixpadding">
        <tr>
            <th colspan="15" class="partition">系统信息</th>
        </tr>
        <tr>
            <td class="vtop td24 lineheight">程序版本</td>
            <td class="lineheight smallfont">West Music <?php echo IN_VERSION; ?>
                简体中文<?php echo strtoupper(IN_CHARSET); ?> <?php echo IN_BUILD; ?></td>
        </tr>
        <tr>
            <td class="vtop td24 lineheight">服务器IP地址</td>
            <td class="lineheight smallfont"><?php echo $serverip; ?></td>
        </tr>
        <tr>
            <td class="vtop td24 lineheight">服务器系统及 PHP</td>
            <td class="lineheight smallfont"><?php echo $serverinfo; ?></td>
        </tr>
        <tr>
            <td class="vtop td24 lineheight">服务器软件</td>
            <td class="lineheight smallfont"><?php echo $serversoft; ?></td>
        </tr>
        <tr>
            <td class="vtop td24 lineheight">服务器 MySQL 版本</td>
            <td class="lineheight smallfont"><?php echo $servermysql; ?></td>
        </tr>
        <tr>
            <td class="vtop td24 lineheight">磁盘空间</td>
            <td class="lineheight smallfont"><?php echo $diskspace; ?></td>
        </tr>
        <tr>
            <td class="vtop td24 lineheight">附件上传</td>
            <td class="lineheight smallfont"><?php echo $attachmentupload; ?></td>
        </tr>
        <tr>
            <td class="vtop td24 lineheight">file_get_contents()</td>
            <td class="lineheight smallfont"><?php echo $check_file_get_contents; ?></td>
        </tr>
        <tr>
            <td class="vtop td24 lineheight">allow_url_fopen</td>
            <td class="lineheight smallfont"><?php echo $check_allow_url_fopen; ?></td>
        </tr>
        <tr>
            <td class="vtop td24 lineheight">fsockopen()</td>
            <td class="lineheight smallfont"><?php echo $check_fsockopen; ?></td>
        </tr>
        <tr>
            <td class="vtop td24 lineheight">curl_init()</td>
            <td class="lineheight smallfont"><?php echo $check_curl_init; ?></td>
        </tr>
    </table>
<!--    <table class="tb tb2 fixpadding">
        <tr>
            <th colspan="15" class="partition">开发团队</th>
        </tr>
        <tr>
            <td class="vtop td24 lineheight">版权所有</td>
            <td><span class="bold"><a href="http://www.erduo.in" class="lightlink2" target="_blank">耳朵音乐</a></span></td>
        </tr>
        <tr>
            <td class="vtop td24 lineheight">团队成员</td>
            <td class="lineheight smallfont team"><a href="http://wpa.qq.com/msgrd?v=3&uin=136245992&site=耳朵音乐&menu=yes"
                                                     target="_blank" class="lightlink2 smallfont">刘文韬</a></td>
        </tr>
        <tr>
            <td class="vtop td24 lineheight">官方微博</td>
            <td class="lineheight"><a href="http://t.qq.com/mliuwentao123" target="_blank" class="lightlink2 smallfont">腾讯微博</a>
            </td>
        </tr>
        <tr>
            <td class="vtop td24 lineheight">合作邮箱</td>
            <td class="lineheight"><a href="mailto:web@earcms.com" class="lightlink2 smallfont">web@earcms.com</a></td>
        </tr>
        <tr>
            <td class="vtop td24 lineheight">旗下域名</td>
            <td class="lineheight"><a href="http://www.earcms.com/" class="lightlink2"
                                      target="_blank">www.earcms.com</a>, <a href="http://www.erduo.in/"
                                                                             class="lightlink2" target="_blank">www.erduo.in</a>
            </td>
        </tr>
    </table>-->
</div>
</body>
</html>