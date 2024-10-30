<?php
/*Author: Kishore Asokan
Author URI: http://www.kisaso.com */
	$kish_T_root = str_replace("\\", "/", dirname(__FILE__));
	$root = dirname(dirname(dirname(dirname(__FILE__))));
	file_exists($root.'/wp-load.php') ? require_once($root.'/wp-load.php') : require_once($root.'/wp-config.php');
	include_once($kish_T_root.'/functions.php');
	include_once($kish_T_root.'/kish-translate-core.php');
	if(!kish_trans_security_check($_REQUEST['file'])) exit;
	//header('Location:'.KT_BLOGURL);
	if($filepath = getServerPathSaveFile($_REQUEST['file'])!=false) {
		if(file_exists($filepath) && !checkfileage($filepath) && filesize($langlink) >=3) {
			//if(substr($_REQUEST['redirect'],-2)==substr(get_option('kish_trans_ext'),-2)) {
				header('Location:'.$_REQUEST['redirect']);
			//}
		}
		else {
			if(KT_GOOGLE_BAN) {
				if((date(mktime()) - KT_GOOGLE_BAN_L_CHECK)<=7200) {
					//print "Last check was at ".KT_GOOGLE_BAN_L_CHECK;
					//print "Saved time is ". KT_GOOGLE_BAN_L_CHECK;
					//print "   Time now is ". date(mktime());
					$diff = date(mktime()) - KT_GOOGLE_BAN_L_CHECK;
					//print " Differece is $diff";
					$tryafter = 7200-$diff;
					print "Currently we are not able to process the translation, We can check after ".$tryafter." Seconds<br>";
					print "<a href = \"".KT_BLOGURL."\">Back to Home Page</a>";
					exit;
					//header('Location:'.KT_BLOGURL);
				}
				else {
					update_option('kish_trans_google_ban', 0 );
					createHTMLFileGoogleURL($_REQUEST['file'],$_REQUEST['redirect']);
				}
			}
			else {
				createHTMLFileGoogleURL($_REQUEST['file'],$_REQUEST['redirect']);
			}
		}
	}
	else {
		print "Error in URL Request";
		exit;
	}
?>