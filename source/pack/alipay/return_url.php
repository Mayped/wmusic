<?php
include '../../system/db.class.php';
require_once 'alipay.config.php';
require_once 'alipay_notify.class.php';
?>
<!DOCTYPE HTML>
<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>">
<?php
$alipayNotify = new AlipayNotify($aliapy_config);
$verify_result = $alipayNotify->verifyReturn();
if($verify_result) {
	$dingdan	= $_GET['out_trade_no'];
	$trade_no	= $_GET['trade_no'];
	$total_fee	= $_GET['price'];
	if($_GET['trade_status'] == 'WAIT_SELLER_SEND_GOODS' || $_GET['trade_status'] == 'TRADE_FINISHED') {
		global $db;
		$result=$db->query("select * from ".tname('paylog')." where cd_title='".SafeSql($dingdan)."'");
		if($row=$db->fetch_array($result)){
			$in_uid = $row['in_uid'];
			$in_points = $row['in_points'];
			$db->query("update ".tname('paylog')." set in_lock=0 where cd_title='".SafeSql($dingdan)."'");
			$db->query("update ".tname('user')." set in_points=in_points+".$in_points." where in_userid=".$in_uid);
			$trade_statuss = "��ϲ�����ɹ����� ".$in_points." �����";
		}else{
    			$trade_statuss = "�Ƿ�����������ˢ�´�ҳ��";
		}
	} else {
    		$trade_statuss = "֧��ʧ�ܣ��뽫������Ϣ���Ƹ�����Ա1��";
	}
}else {
    	$trade_statuss = "֧��ʧ�ܣ��뽫������Ϣ���Ƹ�����Ա��";
}
?>
        <title>֧������ʱ֧��</title>
        <style type="text/css">
            .font_content{
                font-family:"����";
                font-size:14px;
                color:#FF6600;
            }
            .font_title{
                font-family:"����";
                font-size:16px;
                color:#FF0000;
                font-weight:bold;
            }
            table{
                border: 1px solid #CCCCCC;
            }
        </style>
    </head>
    <body>
        <table align="center" width="600" cellpadding="5" cellspacing="0">
            <tr>
                <td align="center" class="font_title" colspan="2">֪ͨ����</td>
            </tr>
            <tr>
                <td class="font_content" align="right">֧�������׺ţ�</td>
                <td class="font_content" align="left"><?php echo $_GET['trade_no']; ?></td>
            </tr>
            <tr>
                <td class="font_content" align="right">�����ţ�</td>
                <td class="font_content" align="left"><?php echo $_GET['out_trade_no']; ?></td>
            </tr>
            <tr>
                <td class="font_content" align="right">�����ܽ�</td>
                <td class="font_content" align="left"><?php echo $_GET['total_fee']; ?></td>
            </tr>
            <tr>
                <td class="font_content" align="right">��Ʒ���⣺</td>
                <td class="font_content" align="left"><?php echo $_GET['subject']; ?></td>
            </tr>
            <tr>
                <td class="font_content" align="right">��Ʒ������</td>
                <td class="font_content" align="left"><?php echo $_GET['body']; ?></td>
            </tr>
            <tr>
                <td class="font_content" align="right">����˺ţ�</td>
                <td class="font_content" align="left"><?php echo $_GET['buyer_email']; ?></td>
            </tr>
            <tr>
                <td class="font_content" align="right">����״̬��</td>
                <td class="font_title" align="left"><?php echo $trade_statuss; ?></td>
            </tr>
        </table>
    </body>
</html>