<?php
if(!defined('IN_ROOT')){exit('Access denied');}
Administrator(6);
include_once 'source/system/min.static.class.php';
include_once 'source/system/lib.static.class.php';
mainjump();
if(IN_REWRITEOPEN != 2){exit("<span style=\"color:#C00\">������ ȫ��->������Ϣ->����ģʽ->α��̬���� ѡ�񡰾�̬��</span>");}
fwrite(fopen('index.html', 'wb'), Lib::L_oad('index.html'));
echo iframe_message("��ҳ������ϣ�");
?>