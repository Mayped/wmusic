<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<div id="footer">
        <p><a href="mailto:<?php echo IN_MAIL; ?>">联系我们</a> - <a href="http://www.miitbeian.gov.cn/" target="_blank"><?php echo IN_ICP; ?></a> <?php echo base64_decode(IN_STAT); ?></p>
        <p>Powered by <a href="http://www.erduo.in/" target="_blank"><strong>Ear Music</strong></a> <span title="<?php echo IN_BUILD; ?>"><?php echo IN_VERSION; ?></span> &copy; 2011-<?php echo date('Y'); ?> <a href="http://www.earcms.com/" target="_blank">Earcms</a> Inc.</p>
</div>
</div>