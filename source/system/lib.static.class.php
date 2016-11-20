<?php
class Lib{
	public static function L_oad($file){
	        $static = @file_get_contents(get_template().$file);
	        $static = Min::G_lobal($static);
	        return self::E_val($static);
	}
	public static function I_nfo($id, $table){
	        global $db,$userlogined,$erduo_in_userid,$erduo_in_username;
	        if($row = $db->getrow("select * from ".tname($table)." where in_id=".$id)){
		        if($table == 'music' && $userlogined){
		                if($lid = $db->getone("select in_id from ".tname('listen')." where in_uid=".$erduo_in_userid." and in_mid=".$row['in_id'])){
		                        updatetable('listen', array('in_addtime' => date('Y-m-d H:i:s')), array('in_id' => $lid));
		                }else{
		                        $setarr = array(
			                        'in_uid' => $erduo_in_userid,
			                        'in_uname' => $erduo_in_username,
			                        'in_mid' => $row['in_id'],
			                        'in_addtime' => date('Y-m-d H:i:s')
		                        );
		                        inserttable('listen', $setarr, 1);
		                }
		        }
		        $db->query("update ".tname($table)." set in_hits=in_hits+1 where in_id=".$row['in_id']);
		        $static = @file_get_contents(get_template().$table.'.html');
	                $static = Min::G_lobal($static, $row['in_id']);
	                switch($table){
		                case 'music':
			                $static = Min::M_usic($static, $static, $row);
			                break;
		                case 'special':
			                $static = Min::S_pecial($static, $static, $row);
			                break;
		                case 'singer':
			                $static = Min::S_inger($static, $static, $row);
			                break;
		                case 'video':
			                $static = Min::V_ideo($static, $static, $row);
			                break;
	                }
	                return self::E_val($static);
	        }else{
	                return html_message("������Ϣ","���ݲ����ڻ��ѱ�ɾ����");
	        }
	}
	public static function L_ist($id, $table, $pid, $self){
	        global $db;
	        if($row = $db->getrow("select * from ".tname($table)." where in_id=".$id)){
		        $static = @file_get_contents(get_template().$table.'.html');
		        $type = $table == 'class' ? 'music' : str_replace('_class', '', $table);
		        $search = array('{$'.$type.'[\'classname\']}', '{$'.$type.'[\'classlink\']}', '{$'.$type.'[\'classid\']}');
		        $replace = array($row['in_name'], getlink($row['in_id'], str_replace('_', '', $table)), $row['in_id']);
		        $static = str_replace($search, $replace, $static);
		        list($data, $li, $lis, $lisp, $pagenum) = self::P_ageStyle($static);
	                preg_match_all('/<!--\{loop '.$type.'(.*?page=([\S]+).*?)\}-->([\s\S]+?)<!--\{\/loop '.$type.'\}-->/', $data, $arr);
	                if(!empty($arr) && !empty($arr[2])){
		                $content = '';
		                $sqlstr = Min::S_ql($type, $arr[1][0], $row['in_id']);
		                $array = self::P_age($sqlstr, intval($arr[2][0]), $li, $lis, $lisp, $pagenum, 3, $pid, $self);
		                $result = $db->query($array[2]);
		                $count = $db->num_rows($result);
		                if($count > 0){
			                if($result){
				                $sorti = 0;
				                while($rows = $db->fetch_array($result)){
					                $sorti = $sorti + 1;
						        switch($type){
							        case 'music':
                                                                        $content .= Min::M_usic($arr[0][0], $arr[3][0], $rows, $sorti);
                                                                        break;
							        case 'special':
                                                                        $content .= Min::S_pecial($arr[0][0], $arr[3][0], $rows, $sorti);
                                                                        break;
							        case 'singer':
                                                                        $content .= Min::S_inger($arr[0][0], $arr[3][0], $rows, $sorti);
                                                                        break;
							        case 'video':
                                                                        $content .= Min::V_ideo($arr[0][0], $arr[3][0], $rows, $sorti);
                                                                        break;
						        }
				                }
			                }
		                }
		                $static = self::P_ageReplace($data, $array);
		                $static = str_replace($arr[0][0], $content, $static);
		                unset($array);
	                }
	                unset($arr);
	                $static = Min::G_lobal($static, $row['in_id']);
	                return self::E_val($static);
	        }else{
	                return html_message("������Ϣ","���಻���ڻ��ѱ�ɾ����");
	        }
	}
	public static function S_earch($like, $type, $pid, $self){
	        $table = str_replace(array('tag', 'letter'), array('music', 'singer'), $type);
		$static = @file_get_contents(get_template().str_replace('music_', '', $table.'_search.html'));
		$like = $type == 'tag' ? getfield('tag', 'in_title', 'in_id', $like) : $like;
		$static = str_replace('{$'.$table.'[\'search\']}', $like, $static);
		list($data, $li, $lis, $lisp, $pagenum) = self::P_ageStyle($static);
	        preg_match_all('/<!--\{loop '.$table.'(.*?page=([\S]+).*?)\}-->([\s\S]+?)<!--\{\/loop '.$table.'\}-->/', $data, $arr);
	        if(!empty($arr) && !empty($arr[2])){
		        $content = '';
	                if($type == 'tag'){
			        $sqlstr = "select * from ".tname('music')." where in_passed=0 and in_tag like '%".$like."%' or in_passed=0 and in_name like '%".$like."%' order by in_addtime desc";
	                }elseif($type == 'letter'){
			        $letter_arr = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
			        $letter_arr1 = array(-20319, -20283, -19775, -19218, -18710, -18526, -18239, -17922, -1, -17417, -16474, -16212, -15640, -15165, -14922, -14914, -14630, -14149, -14090, -13318, -1, -1, -12838, -12556, -11847, -11055);
			        $letter_arr2 = array(-20284, -19776, -19219, -18711, -18527, -18240, -17923, -17418, -1, -16475, -16213, -15641, -15166, -14923, -14915, -14631, -14150, -14091, -13319, -12839, -1, -1, -12557, -11848, -11056, -2050);
			        $posarr = array_keys($letter_arr, strtoupper($like));
			        $pos = $posarr[0];
			        $sqlstr = "select * from ".tname('singer')." where in_passed=0 and UPPER(substring(".convert_using('in_name').",1,1))='".$letter_arr[$pos]."' or in_passed=0 and ord(substring(".convert_using('in_name').",1,1))-65536>=".$letter_arr1[$pos]." and  ord(substring(".convert_using('in_name').",1,1))-65536<=".$letter_arr2[$pos];
	                }elseif($type == 'music'){
			        $sqlstr = "select * from ".tname('music')." where in_passed=0 and in_name like '%".$like."%' or in_passed=0 and in_tag like '%".$like."%' order by in_addtime desc";
	                }else{
			        $sqlstr = "select * from ".tname($table)." where in_passed=0 and in_name like '%".$like."%' order by in_addtime desc";
	                }
		        $pathinfo = $type == 'tag' || $type == 'letter' ? 3 : 4;
		        $array = self::P_age($sqlstr, intval($arr[2][0]), $li, $lis, $lisp, $pagenum, $pathinfo, $pid, $self);
		        global $db;
		        $result = $db->query($array[2]);
		        $count = $db->num_rows($result);
		        if($count > 0){
			        if($result){
				        $sorti = 0;
				        while($rows = $db->fetch_array($result)){
					        $sorti = $sorti + 1;
						switch($table){
							case 'music':
                                                                $content .= Min::M_usic($arr[0][0], $arr[3][0], $rows, $sorti);
                                                                break;
							case 'special':
                                                                $content .= Min::S_pecial($arr[0][0], $arr[3][0], $rows, $sorti);
                                                                break;
							case 'singer':
                                                                $content .= Min::S_inger($arr[0][0], $arr[3][0], $rows, $sorti);
                                                                break;
							case 'video':
                                                                $content .= Min::V_ideo($arr[0][0], $arr[3][0], $rows, $sorti);
                                                                break;
						}
				        }
			        }
		        }
		        $static = self::P_ageReplace($data, $array);
		        $static = str_replace($arr[0][0], $content, $static);
		        unset($array);
	        }
	        unset($arr);
	        $static = Min::G_lobal($static);
	        return self::E_val($static);
	}
	public static function P_age($sqlstr, $pagesok, $li, $lis, $lisp, $pagenum, $pathinfo, $pages, $self){
	        global $db;
	        $url = explode('/', $self);
  	        $res = $db->query($sqlstr);
 	        $nums = $db->num_rows($res);
 	        $num = $nums == 0 ? 1 : $nums;
 	        $pagejs = ceil($num / $pagesok);
 	        if($pages > $pagejs){
		        $pages = $pagejs;
 	        }
 	        $sql = $sqlstr." LIMIT ".$pagesok * ($pages - 1).",".$pagesok;
 	        $result = $db->query($sql);
 	        $str = '';
 	        $up = $pages > 1 ? ($pages - 1) : 1;
 	        $next = $pages == $pagejs ? $pagejs : ($pages + 1);
 	        $first = rewrite_mode(!empty($url[$pathinfo]) ? str_replace($url[$pathinfo], 'p1', $self) : $self.'p1/', true);
 	        $pageup = rewrite_mode(!empty($url[$pathinfo]) ? str_replace($url[$pathinfo], 'p'.$up, $self) : $self.'p'.$up.'/', true);
 	        $pagenext = rewrite_mode(!empty($url[$pathinfo]) ? str_replace($url[$pathinfo], 'p'.$next, $self) : $self.'p'.$next.'/', true);
 	        $last = rewrite_mode(!empty($url[$pathinfo]) ? str_replace($url[$pathinfo], 'p'.$pagejs, $self) : $self.'p'.$pagejs.'/', true);
 	        $pagelist = '<select onchange="location.href=this.options[this.selectedIndex].value;">';
 	        for($k=1;$k<=$pagejs;$k++){
		        if($k == $pages){
			        $pagelist .= '<option selected="selected">��'.$k.'ҳ</option>';
	                }else{
			        $pagelist .= '<option value="'.rewrite_mode(!empty($url[$pathinfo]) ? str_replace($url[$pathinfo], 'p'.$k, $self) : $self.'p'.$k.'/', true).'">��'.$k.'ҳ</option>';
	                }
 	        }
 	        $pagelist .= '</select>';
 	        if($pagejs <= $pagenum){
  		        for($i=1;$i<=$pagejs;$i++){
   			        if($i == $pages){
   				        $str .= $lis.$i.$lisp;
   			        }else{
   				        $str .= str_replace('[link]', rewrite_mode(!empty($url[$pathinfo]) ? str_replace($url[$pathinfo], 'p'.$i, $self) : $self.'p'.$i.'/', true), $li).$i.$lisp;
   			        }
 	 	        }
 	        }else{
 		        if($pages >= $pagenum){
 			        for($i=$pages-intval($pagenum/2);$i<=$pages+intval($pagenum/2);$i++){
   				        if($i <= $pagejs){
   				                if($i == $pages){
   						        $str .= $lis.$i.$lisp;
   				                }else{
   						        $str .= str_replace('[link]', rewrite_mode(!empty($url[$pathinfo]) ? str_replace($url[$pathinfo], 'p'.$i, $self) : $self.'p'.$i.'/', true), $li).$i.$lisp;
   				                }
   				        }
 			        }
 		        }else{
 			        for($i=1;$i<=$pagenum;$i++){
   				        if($i == $pages){
   					        $str .= $lis.$i.$lisp;
   				        }else{
   					        $str .= str_replace('[link]', rewrite_mode(!empty($url[$pathinfo]) ? str_replace($url[$pathinfo], 'p'.$i, $self) : $self.'p'.$i.'/', true), $li).$i.$lisp;
   				        }
 			        }
 		        }
 	        }
	        while($row = $db->fetch_array($result)){}
	        $arr = array($str, $result, $sql, $nums, $pagelist, $pages, $pagejs, $first, $pageup, $pagenext, $last, $pagesok);
	        @mysql_free_result($res);
	        return $arr;
	}
	public static function P_ageStyle($static){
	        preg_match('/<!--\{pagestyle (.*?)\|(.*?)\|(.*?)\}-->/', $static, $arr);
	        if(!empty($arr)){
	                $li = $arr[1];
	                $lis = $arr[2];
	                $lisp = $arr[3];
	                $static = str_replace($arr[0], '', $static);
	        }else{
	                $li = '';
	                $lis = '';
	                $lisp = '';
	        }
	        unset($arr);
	        return array($static, $li, $lis, $lisp, self::P_ageNum($static));
	}
	public static function P_ageNum($static){
	        preg_match('/\{\$page\[\'number\s*([\d]*)\'\]\}/', $static, $arr);
	        if(!empty($arr)){
		        if(is_numeric($arr[1])){
			        $num = $arr[1];
		        }else{
			        $num = 10;
		        }
	        }else{
		        $num = 10;
	        }
	        unset($arr);
	        return $num;
	}
	public static function P_ageReplace($static, $arr){
	        $static = preg_replace('/\{\$page\[\'number(.*?)\'\]\}/', $arr[0], $static);
	        $search = array('{$page[\'data\']}', '{$page[\'list\']}', '{$page[\'now\']}', '{$page[\'all\']}', '{$page[\'first\']}', '{$page[\'up\']}', '{$page[\'down\']}', '{$page[\'last\']}', '{$page[\'size\']}');
	        $replace = array($arr[3], $arr[4], $arr[5], $arr[6], $arr[7], $arr[8], $arr[9], $arr[10], $arr[11]);
	        $static = str_replace($search, $replace, $static);
	        return $static;
	}
	public static function E_val($static){
	        $static = preg_replace_callback('/<!--\{eval\}-->([\s\S]+?)<!--\{\/eval\}-->/', create_function('$match', 'return eval($match[1]);'), $static);
	        preg_match_all('/<!--\{if\((.*?)\)\}-->([\s\S]+?)<!--\{\/if\}-->/', $static, $arr);
	        if(!empty($arr)){
		        for($i=0;$i<count($arr[0]);$i++){
			        $else = explode('<!--{else}-->', $arr[2][$i]);
			        if(count($else) == 2){
				        $eval = "if(".$arr[1][$i]."){return '".$else[0]."';}else{return '".$else[1]."';}";
				        $str = eval($eval);
			        }else{
				        $eval = "if(".$arr[1][$i]."){return '".$arr[2][$i]."';}";
				        $str = eval($eval);
			        }
				$static = str_replace($arr[0][$i], $str, $static);
		        }
	        }
	        unset($arr);
	        return $static;
	}
}
?>