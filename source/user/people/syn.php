<?php
include '../../system/db.class.php';
include '../../system/user.php';
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: text/html;charset=".IN_CHARSET);
$uc=SafeRequest("uc","get");
if($uc == 'login'){
        global $userlogined,$erduo_in_username,$erduo_in_ucid;
        if($userlogined){
	        if(IN_UCOPEN == 1){
			include_once '../../../client/ucenter.php';
			include_once '../../../client/client.php';
		        $ucid = uc_get_user($erduo_in_username);
		        if($erduo_in_ucid > 0 && $erduo_in_ucid == $ucid[0]){
			        echo uc_user_synlogin($ucid[0]);
		        }
	        }
        }
}else{
        if(IN_UCOPEN == 1){
		include_once '../../../client/ucenter.php';
		include_once '../../../client/client.php';
	        echo uc_user_synlogout();
        }
}
?>