<?php
function kish_translate_style() {
	?>
	<style>
	#lang_menu {
		font-size:11px;
		background:#<?php echo get_option('kish_trans_bcolor'); ?>;
		padding:3px;	
		border:solid <?php echo get_option('kish_trans_borderwid'); ?>px #<?php echo get_option('kish_trans_bordercolor'); ?>;
		height:<?php echo get_option('kish_trans_widheight'); ?>px;
		color:#<?php echo get_option('kish_trans_fcolor'); ?>;
		width:<?php echo get_option('kish_trans_widwidth'); ?>px;
	}
	#lang_menu img {
		padding:2px;
	}
	.lang_sb {
		font-size:11px;
		background:#<?php echo get_option('kish_trans_bcolor'); ?>;
		padding:3px;	
		border:solid <?php echo get_option('kish_trans_borderwid'); ?>px #<?php echo get_option('kish_trans_bordercolor'); ?>;
		color:#<?php echo get_option('kish_trans_fcolor'); ?>;
		margin:3px 0px 3px 0px;
		padding:3px;
	}
	.lang_sb strong {
		font-stretch:expanded;
		font-weight:bold;
		line-height:15px;	
	}
	.lang_sb a {
		color:#<?php echo get_option('kish_trans_fcolor'); ?>;
		text-decoration: none !important;
	}
	.lang_sb img {
		padding:2px;
		margin:2px;
	}
	#lang_menu a {
		color:#<?php echo get_option('kish_trans_fcolor'); ?>;
		text-decoration: none !important;
	}
	#lang_menu a:hover {
		font-weight:bold;
		text-decoration: underline !important;
	}
	.optionlang {
		font:Verdana, Arial, Helvetica, sans-serif;
		font-size:12px;
	}
	.kishinfo {
		display:inline;
	
	}
	.kishinfo a {
		text-decoration: none;
		font-size:12px; 
		color:#<?php echo get_option('kish_trans_fcolor'); ?>;
		font-stretch:extra-expanded;
		font-weight:bold;
		float:right;
	}
	.kishinfo img {
		border:none;
	}
	.kishinfo a:hover {
		color: #0c811d;
		text-decoration: none !important;
	}
	#divprog {
		height:20px;
		width:20px;
		font:verdana;
		font-size:9px;
		padding-top:3px;
		float:left;
		
	}
	#divprog img {
		float:left;
		padding-top:1px;
		padding-right:5px;
		margin-right:5px;
	}
	#kish_translate {
		color:#FFFFFF;
	}
	#kish_translate a {
	}
	.clearboth {
		clear: both;
	}
	</style>
	<?php 
}
function addHeaderFadeJs() {
	echo "<script type=\"text/javascript\" src=\"" .KT_BLOGURL. "/wp-content/plugins/kish-translate-ajax/fader.js\"></script>\n";
}
function kish_translate_js() {
	?>
	<script type="text/javascript">
	function postDataGetTextTrans(urlToCall, dataToSend, functionToCallBack, resultDiv, progressDiv)
	{ 
	  var XMLHttpRequestObject = false; 
	  //document.getElementById(resultDiv).innerHTML='';
	  document.getElementById(resultDiv).style.display = 'block';
	
	  if (window.XMLHttpRequest) {
		XMLHttpRequestObject = new XMLHttpRequest();
	  } else if (window.ActiveXObject) {
		XMLHttpRequestObject = new 
		 ActiveXObject("Microsoft.XMLHTTP");
	  }
	
	  if(XMLHttpRequestObject) {
		XMLHttpRequestObject.open("POST", urlToCall); 
		XMLHttpRequestObject.setRequestHeader('Content-Type', 
		  'application/x-www-form-urlencoded'); 
	
		XMLHttpRequestObject.onreadystatechange = function() 
		{ 
		   if (XMLHttpRequestObject.readyState == 4 && 
			XMLHttpRequestObject.status == 200) {
			colorFade('thistranslation','color','<?php echo get_option('kish_trans_txtfontcolor'); ?>','<?php echo get_option('kish_trans_txtBackcolor'); ?>',20,50);
			hideOriginal('totranslate');
			   functionToCallBack( XMLHttpRequestObject.responseText, resultDiv, progressDiv); 
				var X=setTimeout("colorFade('thistranslation','color','<?php echo get_option('kish_trans_txtBackcolor'); ?>','<?php echo get_option('kish_trans_txtfontcolor'); ?>',20,50)",1000); 
			  delete XMLHttpRequestObject;
			  XMLHttpRequestObject = null;  
		  } 
		}
	
		XMLHttpRequestObject.send(dataToSend); 
	  }
	}
	function showprogressTrans(divID, message) {
		document.getElementById(divID).innerHTML='<img src = <?php echo KT_BLOGURL."/wp-content/plugins/kish-translate-ajax/ajax-loader.gif"; ?> >' + message;
	}
	function displayModeTrans(text, resultDiv, progressDiv) {        
			document.getElementById(progressDiv).innerHTML = '';
			document.getElementById(resultDiv).innerHTML = text;
	}
	
	function hideOriginal(articleDiv) {
	document.getElementById(articleDiv).style.display = 'none';
	}
	function hideOriginalSM() {
	var t=setTimeout("hideOriginal('kish_article')",500);
	}
	function cfade() {
	var t=setTimeout("colorFade('kish_translate','color','<?php echo get_option('kish_trans_txtfontcolor'); ?>','<?php echo get_option('kish_trans_txtBackcolor'); ?>',10,400)",30);
	}
	function showOriginal(articleDiv, resultDiv) {
	document.getElementById(articleDiv).style.display = 'block';
	document.getElementById(resultDiv).style.display = 'none';
	}
	function getVarTL(v) {
		var retval;
		retval = document.getElementById(v).value; 
		return retval;
	} 
	</script>
	<?php
}
function printLangListKish() {
	if(get_option('kish_trans_autoadd')==1) {
		if(!$_REQUEST['kishtrans']) {
		global $post,  $kish_translate_credits;
		echo "<center><div id = \"lang_menu\"><div id = \"divprog\"></div>".$kish_translate_credits;
		//  Hindi
		if(get_option('kish_trans_hindi')==1) printLangLinksKish($post->ID, 'hi',"Hindi");
		//Arabic
		if(get_option('kish_trans_arabic')==1) printLangLinksKish($post->ID, 'ar',"Arabic");
		//Spanis
		if(get_option('kish_trans_spanish')==1) printLangLinksKish($post->ID, 'es',"Spanish");
		//French
		if(get_option('kish_trans_french')==1) printLangLinksKish($post->ID, 'fr',"French");
		//German
		if(get_option('kish_trans_german')==1) printLangLinksKish($post->ID, 'de',"German");
		//Romanian
		if(get_option('kish_trans_romanian')==1) printLangLinksKish($post->ID, 'ro',"Romanian");
		//Czech
		if(get_option('kish_trans_czech')==1) printLangLinksKish($post->ID, 'cs',"Czech");
		//Chinese
		if(get_option('kish_trans_chinese')==1) printLangLinksKish($post->ID, 'zh-CN',"Chinese");
		//Russian
		if(get_option('kish_trans_russian')==1) printLangLinksKish($post->ID, 'ru',"Russian");
		//Finnish
		if(get_option('kish_trans_finnish')==1) printLangLinksKish($post->ID, 'fi',"Finnish");
		//Danish
		if(get_option('kish_trans_danish')==1) printLangLinksKish($post->ID, 'da',"Danish");
		//Italian
		if(get_option('kish_trans_italian')==1) printLangLinksKish($post->ID, 'it',"Italian");
		echo "&nbsp;&nbsp;&nbsp;<strong><a href =\"##\" onclick = \"showOriginal('totranslate', 'thistranslation')\"/>Show Original</a></strong></span>&nbsp;&nbsp;&nbsp; </div></center><div id = \"thistranslation\"></div><div id =\"totranslate\">";
		}
	}
}
function printKishTransfooter() {
	print "</div>";
}
function outsideWP() {
	$thisurl = kish_trans_curPageURL();
	if(strpos($thisurl,get_option('kish_trans_wordpressurl'))===false) {
		if(strpos(str_replace("www.", "",$thisurl),get_option('kish_trans_wordpressurl'))===false) {
			return true;
		}
		else return false;
	}
	else return false;
}
function printOptionBox() {
	global $wp_query, $kish_translate_credits;
	$pageId = $wp_query->post->ID;
	if(is_home()) {
		$url = kish_trans_curPageURL();
		if(strpos($thisurl,KT_BLOGURL)===false) {
			if(strpos(str_replace("www.", "",$url),KT_BLOGURL)===false) {
					print "Problem is Sourceurl";
					exit;
			}
			else $url = str_replace("www.", "",$url);
		}
		$url = $url."index.php";
	}
	else $url = "";
	echo "<select class = \"optionlang\" id = \"l\" onchange=\"showprogressTrans('divprog', '');  postDataGetTextTrans('".get_bloginfo('wpurl')."/wp-content/plugins/kish-translate-ajax/kish-translate.php' , 'req=kishtran&url=".$url."&pageid=' + ".$pageId." + '&lang=' + getVarTL('l') + '&x=y', displayModeTrans , 'thistranslation', 'divprog')\"/>";
	$lang=availabe_languages();
	$len=count($lang);
	for ($r = 0; $r < $len; $r++) {
		echo "<option value=\"".$lang[$r]['id']."\">".$lang[$r]['name']."</option>";
	}
	echo "</select>";
}
function kish_tran_printAdminOptionBox() {
	print "<select name =\"kish_trans_bloglang\" size=\"1\">";
	$lang=availabe_languages();
	$len=count($lang);
	for ($r = 0; $r < $len; $r++) {
		if(get_option('kish_trans_bloglang')==$lang[$r]['id']) {
			echo "<option value=\"".$lang[$r]['id']."\" selected=\"selected\">".$lang[$r]['name']."</option>";
		}
		else {
			echo "<option value=\"".$lang[$r]['id']."\">".$lang[$r]['name']."</option>";
		}
	}
	echo "</select>";
}
function printLangLinksKish($pageId, $langId, $langName) {
if(!KT_REWRITE_OK) { print "This Plugin Does not work without permalink support";  }
	if(is_home()) {
		$url = kish_trans_curPageURL();
		if(strpos($url,KT_BLOGURL)===false) {
			if(strpos(str_replace("www.", "",$url),KT_BLOGURL)===false) {
					print "Problem is Sourceurl";
					exit;
			}
			else $url = str_replace("www.", "",$url);
		}
		$url = $url."index.php";
	}
	else $url = "";
	strlen($url) ? $url = "&url=".$url : $url = "";
	$thistitle = get_the_title($pageId);
	$imgpath = KT_BLOGURL."/wp-content/plugins/kish-translate-ajax/flags/";
	echo "<a href =\"##\" onclick = \"showprogressTrans('divprog', '');  postDataGetTextTrans('".KT_BLOGURL."/wp-content/plugins/kish-translate-ajax/kish-translate.php' , 'req=kishtran".$url."&pageid=".$pageId."&lang=".$langId."', displayModeTrans , 'thistranslation', 'divprog')\"/><img src = \"".$imgpath.$langId.".png\" title = \"Translation of $thistitle in $langname\"</a>&nbsp;&nbsp;&nbsp; ";
}
function printWidgetLinks() {
	global $post;
	$pageId = $wp_query->post->ID;
	is_single() ? $url = kish_trans_get_permalink($postId) : $url = cleanCurUrlBug(kish_trans_curPageURL());
	if(KT_ENABLE_PSAVE==1) {
		global $wp_query, $kish_translate_credits;
		$createTPage = true;
		$langdir = get_option('kish_trans_langdirname');
		$output = '';		
		$lang=availabe_languages();
		$len=count($lang);
		$output .= "<div class = \"lang_sb\">";
		$output .= "<strong>Available Translations</strong>";
		$output .= "<p>";
		for ($r = 0; $r < $len; $r++) {
			$plink=$url;
			strlen(KT_BLOGURL) ? $wpurl = KT_BLOGURL : $wpurl = KT_BLOGURL;
			is_home() ? $ptitle = "Translation of ".get_bloginfo()." in ".$lang[$r]['name'] : $ptitle= "Translation of ".get_the_title($pageId)." in ".$lang[$r]['name'];
			$postslug = substr(str_replace($wpurl, "", $plink),0,-1);
			if(is_home()) {
				//print "Yest its home.<br>";
				$postslug.= "/index";
			}
			$root = get_option('kish_trans_rootpath');
			file_exists(getServerPathSaveFile($langurl)) ? $homextension = "/" : $homextension = "/index".KT_URL_EXTENSION;
			is_home() ? $langlink = KT_ROOT_PATH."/".KT_LANG_DIR."/".$lang[$r]['id'].$homextension :  $langlink = KT_ROOT_PATH."/".KT_LANG_DIR."/".$lang[$r]['id'].$postslug.KT_URL_EXTENSION;
			if($lang[$r]['id']==KT_BLOG_LANG) {	
				$langurl = $url;
				$rel = " rel = \"bookmark\" ";
			}
			else {
				$langurl=printTransLangLinks($lang[$r]['id'], KT_LANG_DIR, KT_BLOGURL, $postslug);
				file_exists(getServerPathSaveFile($langurl)) ? $rel = " " : $rel = " rel = \"nofollow\" ";
			}
			is_home() ? $sourceurl = getSaveUrlIndex($url,$lang[$r]['id']) : $sourceurl = getSaveUrl(get_permalink($pageId), $lang[$r]['id']);
			$imgpath = KT_BLOGURL."/wp-content/plugins/kish-translate-ajax/flags/";
			$output .= "<a".$rel."title = \"".$ptitle."\" href = \"".$langurl." \"><img src =\"".$imgpath.$lang[$r]['id'].".png\"></a>"; 	
		}
		$output .= "<br><strong><a href = \"http://kish.in/wordpress-plugin-translation-ajax-seo/\" target = \"_blank\">Kish Translate Ajax</a></strong></div>";
		return $output;
	//}
	}
}
function kish_trans_print_widget() {
	echo printWidgetLinks();
}
function kish_trans_get_trans_fromPage($pageId, $langId, $url) {
	if(!KT_REWRITE_OK) { print "This Plugin Does not work without permalink support";  }
	if(strlen($url)) {
		if($url==KT_BLOGURL."/index.php") {
			$saveUrl = getSaveUrlIndex($url, $langId);
			//print $saveUrl."<br>";	
		}
	}
	else {
		$saveUrl = get_permalink($pageId);	
		$saveUrl = getSaveUrl($saveUrl, $langId);
		//print $saveUrl."<br>";
	}
	$savefile =  getServerPathSaveFile($saveUrl);
	//print $savefile;
	if(file_exists($savefile) && filesize($savefile) >=5) {
	//print "File exisits".$savefile;
	kish_get_content_ajax($savefile);
	}
	else {
	//print "Creating new file";
	createHTMLFileGoogleURLAJAX($saveUrl);
	//createHTMLFileGoogleURL($saveUrl, $saveUrl);
	}
}
function kish_get_content_ajax($file) {
	$handle = fopen($file, "rb");
	$contents = '';
	while (!feof($handle)) {
	  $contents .= fread($handle, 8192);
	}
	fclose($handle);
	print $contents;;
}
function printLangLinks($pageId, $langId, $langName) {
	echo "<a href =\"##\" onclick = \"showprogressTrans('divprog', 'Translating .. Google Translation...');  postDataGetTextTrans('".get_bloginfo('wpurl')."/wp-content/plugins/kish-translate-ajax/kish-translate.php' , 'req=translate&pageid=".$pageId."&lang=".$langId."', displayModeTrans , 'kish_translate', 'divprog')\"/>".$langName."</a>&nbsp;&nbsp;&nbsp; ";
}
function printDelLink($pageId, $langId) {
	global $user_ID; 
	if( $user_ID ) :
		if( current_user_can('level_10') ) : 
			echo "<a href =\"##\" onclick = \"showprogressTrans('divprog', 'Clearing Cache....');  postDataGetTextTrans('".get_bloginfo('wpurl')."/wp-content/plugins/kish-translate-ajax/kish-translate.php' , 'req=clearcache&pageid=".$pageId."&lang=".$langId."', displayModeTrans , 'kish_translate', 'divprog')\"/>Clear Cache</a>&nbsp;&nbsp;&nbsp; ";
		endif;
	endif;
}

function printDelLinkAll($pageId, $langId) {
	global $user_ID; 
	if( $user_ID ) :
		if( current_user_can('level_10') ) : 
			echo "<a href =\"##\" onclick = \"showprogressTrans('divprog', 'Clearing Cache....');  postDataGetTextTrans('".get_bloginfo('wpurl')."/wp-content/plugins/kish-translate-ajax/kish-translate.php' , 'req=clearcacheall&pageid=".$pageId."&lang=".$langId."', displayModeTrans , 'kish_translate', 'divprog')\"/>Clear Cache All</a>&nbsp;&nbsp;&nbsp; ";
		endif;
	endif;
}

function printAllLangList($pageId) {
	echo "<strong><a href =\"##\" onclick = \"showprogressTrans('divprog', '');  postDataGetTextTrans('".get_bloginfo('wpurl')."/wp-content/plugins/kish-translate-ajax/kish-translate.php' , 'req=allang&pageid=".$pageId."', displayModeTrans , 'lang_menu', 'divprog')\"/>All Langs</a></strong>&nbsp;&nbsp;&nbsp; ";
}
function printLangListAll($pageId) {
	global $post, $kish_translate_credits;
	echo $kish_translate_credits;
	$lang=availabe_languages();
	$len=count($lang);
	for ($r = 0; $r < $len; $r++) {
		printLangLinks($pageId, $lang[$r]['id'],$lang[$r]['name']);
	}
	echo "&nbsp;&nbsp;&nbsp;<strong><a href =\"##\" onclick = \"showOriginal('kish_article', 'kish_translate')\"/>Show Original</a></strong>";
}

//Settings part
function kish_translate_install() { 
	add_option('kish_trans_autoadd', 	"1", "Auto Add Post");
	add_option('kish_trans_autosidebar', 	"0", "Auto Add Sidebar");
	add_option('kish_trans_version', 	"1", "Kish Translate Version");
	add_option('kish_trans_bcolor', 	"f7f8fc", "Kish Translate BG Color");
	add_option('kish_trans_fcolor', 	"000000", "Kish Translate Font Color");
	add_option('kish_trans_bordercolor', 	"000000", "Kish Translate Border Color");
	add_option('kish_trans_widheight', 	"25", "Kish Translate Widget Height");
	add_option('kish_trans_borderwid', 	"1", "Kish Translate Widget Border Width");
	add_option('kish_trans_widwidth', 	"auto", "Kish Translate Widget Width");
	add_option('kish_trans_count_pl', 	"1", "Kish Translate PL count");
	add_option('kish_trans_arabic', 	"0", "Arabic");
	add_option('kish_trans_hindi', 	"1", "Hindi");
	add_option('kish_trans_russian', 	"0", "Russian");
	add_option('kish_trans_french', 	"1", "French");
	add_option('kish_trans_spanish', 	"0", "Spanish");
	add_option('kish_trans_czech', 	"0", "Czech");
	add_option('kish_trans_italian', 	"1", "Italian");
	add_option('kish_trans_danish', 	"1", "Danish");
	add_option('kish_trans_chinese', 	"0", "Chinese");
	add_option('kish_trans_finnish', 	"1", "Finnish");
	add_option('kish_trans_romanian', 	"0", "Romanian");
	add_option('kish_trans_german', 	"1", "German");
	add_option('kish_trans_korean', 	"1", "Korean");
	add_option('kish_trans_swedish', 	"0", "Swedish");
	add_option('kish_trans_bulgarian', 	"0", "Bulgarian");
	add_option('kish_trans_croatian', 	"0", "Croatian");
	add_option('kish_trans_dutch', 	"0", "Dutch");
	add_option('kish_trans_greek', 	"0", "Greek");
	add_option('kish_trans_japan', 	"0", "Japan");
	add_option('kish_trans_polish', 	"0", "Polish");
	add_option('kish_trans_portuguese', 	"0", "Portuguese");
	add_option('kish_trans_txtBackcolor', 	"FFFFFF", "Text Fade Color");
	add_option('kish_trans_txtfontcolor', 	"000000", "Text Font Color");
	add_option('kish_trans_enpagesave', 	"0", "Enable Page Saving");
	add_option('kish_trans_endebug', 	"0", "Enable Debuging");
	add_option('kish_trans_wordpressurl', 	"", "Wordpress URL");
	add_option('kish_trans_rootpath', 	"", "Root Path");
	add_option('kish_trans_langdirname', 	"", "Translation Folder Name");
	add_option('kish_trans_langdirpath', 	"", "Translation Path");
	add_option('kish_trans_cron', 	"24", "Cron Interval");
	add_option('kish_trans_ext', 	".html", "File Extension");
	add_option('kish_trans_slugend', 	"/", "Site Slug End");
	add_option('kish_trans_bloglang', 	"en", "Blog Language");
	add_option('kish_trans_google_ban', "0", "Google Ban");
	add_option('kish_trans_google_ban_check', "0", "Google Ban Last Check");
	add_option('kish_trans_google_last_cron', "0", "Google Last Cron");
}

function kish_translate_add_admin() {
	add_options_page('Kish Translate', 'Kish Translate', 8, 'kish-translate', 'kish_translate_option');
}
function kish_translate_option() {
	global $kish_translate_credits;
	saveDefaults();
	$kish_translate_option = array("kish_trans_autoadd","kish_trans_autosidebar", "kish_trans_count_pl", "kish_trans_autofooter", "kish_trans_bcolor", "kish_trans_fcolor", "kish_trans_bordercolor", "kish_trans_widheight","kish_trans_borderwid", "kish_trans_widwidth","kish_trans_arabic", "kish_trans_hindi", "kish_trans_russian", "kish_trans_french", "kish_trans_spanish", "kish_trans_czech", "kish_trans_italian", "kish_trans_korean", "kish_trans_bulgarian", "kish_trans_croatian", "kish_trans_dutch", "kish_trans_greek", "kish_trans_japan", "kish_trans_polish","kish_trans_danish", "kish_trans_chinese", "kish_trans_finnish", "kish_trans_romanian", "kish_trans_german", "kish_trans_korean", "kish_trans_english", "kish_trans_swedish", "kish_trans_txtBackcolor", "kish_trans_txtfontcolor", "kish_trans_enpagesave", "kish_trans_endebug", "kish_trans_wordpressurl", "kish_trans_rootpath", "kish_trans_langdirname", "kish_trans_langdirpath", "kish_trans_cron", "kish_trans_ext", "kish_trans_slugend",  "kish_trans_bloglang");
	if($_POST['action'] == 'save') {			
		foreach($kish_translate_option as $o) {	
			if(isset( $_POST[$o]) ) {
				$val = $_POST[$o];
				update_option($o, $val);
			}	
		}
		if(!isset($_POST['kish_trans_autoadd'])) update_option('kish_trans_autoadd', 0);
		else update_option('kish_trans_autoadd', 1);
		if(!isset($_POST['kish_trans_autosidebar'])) update_option('kish_trans_autosidebar', 0);
		else update_option('kish_trans_autosidebar', 1);
		if(!isset($_POST['kish_trans_autofooter'])) update_option('kish_trans_autofooter', 0);
		else update_option('kish_trans_autofooter', 1);
		if(!isset($_POST['kish_trans_arabic'])) update_option('kish_trans_arabic', 0);
		else update_option('kish_trans_arabic', 1);
		if(!isset($_POST['kish_trans_hindi'])) update_option('kish_trans_hindi', 0);
		else update_option('kish_trans_hindi', 1);
		if(!isset($_POST['kish_trans_russian'])) update_option('kish_trans_russian', 0);
		else update_option('kish_trans_russian', 1);
		if(!isset($_POST['kish_trans_french'])) update_option('kish_trans_french', 0);
		else update_option('kish_trans_french', 1);
		if(!isset($_POST['kish_trans_spanish'])) update_option('kish_trans_spanish', 0);
		else update_option('kish_trans_spanish', 1);
		if(!isset($_POST['kish_trans_czech'])) update_option('kish_trans_czech', 0);
		else update_option('kish_trans_czech', 1);
		if(!isset($_POST['kish_trans_italian'])) update_option('kish_trans_italian', 0);
		else update_option('kish_trans_italian', 1);
		if(!isset($_POST['kish_trans_danish'])) update_option('kish_trans_danish', 0);
		else update_option('kish_trans_danish', 1);
		if(!isset($_POST['kish_trans_chinese'])) update_option('kish_trans_chinese', 0);
		else update_option('kish_trans_chinese', 1);
		if(!isset($_POST['kish_trans_finnish'])) update_option('kish_trans_finnish', 0);
		else update_option('kish_trans_finnish', 1);
		if(!isset($_POST['kish_trans_romanian'])) update_option('kish_trans_romanian', 0);
		else update_option('kish_trans_romanian', 1);
		if(!isset($_POST['kish_trans_german'])) update_option('kish_trans_german', 0);
		else update_option('kish_trans_german', 1);
		if(!isset($_POST['kish_trans_korean'])) update_option('kish_trans_korean', 0);
		else update_option('kish_trans_korean', 1);
		if(!isset($_POST['kish_trans_swedish'])) update_option('kish_trans_swedish', 0);
		else update_option('kish_trans_swedish', 1);
		if(!isset($_POST['kish_trans_bulgarian'])) update_option('kish_trans_bulgarian', 0);
		else update_option('kish_trans_bulgarian', 1);
		if(!isset($_POST['kish_trans_croatian'])) update_option('kish_trans_croatian', 0);
		else update_option('kish_trans_croatian', 1);
		if(!isset($_POST['kish_trans_dutch'])) update_option('kish_trans_dutch', 0);
		else update_option('kish_trans_dutch', 1);
		if(!isset($_POST['kish_trans_greek'])) update_option('kish_trans_greek', 0);
		else update_option('kish_trans_greek', 1);
		if(!isset($_POST['kish_trans_japan'])) update_option('kish_trans_japan', 0);
		else update_option('kish_trans_japan', 1);
		if(!isset($_POST['kish_trans_polish'])) update_option('kish_trans_polish', 0);
		else update_option('kish_trans_polish', 1);
		if(!isset($_POST['kish_trans_portuguese'])) update_option('kish_trans_portuguese', 0);
		else update_option('kish_trans_portuguese', 1);
		if(!isset($_POST['kish_trans_enpagesave'])) update_option('kish_trans_enpagesave', 0);
		else update_option('kish_trans_enpagesave', 1);
		if(!isset($_POST['kish_trans_endebug'])) update_option('kish_trans_endebug', 0);
		else update_option('kish_trans_endebug', 1);
	}
?>
<p><?php echo $kish_translate_credits; ?>Here you can update the languages that you would like to translate for your post. Its adviced to enable not more than 5 languages. If you are stuck somewhere or if the plugin is not working as expected, please let me know. The input language is automatically detected, so you can use this for all the available languages</p><p> An explaination for this plugin can be found at <a href="http://kish.in/translation-plugin-updated/" target="_blank">Ajax Translation with SEO Links</a></p>
<?php $_POST['action'] ? print "<div style=\"background-color: rgb(255, 251, 204);\" id=\"message\" class=\"updated fade\"><p><strong>Settings saved.</strong></p></div>" : print ""; ?>
<?php 
//if(get_option('kish_trans_endebug')==1) {
	print "<div align = \"center\" style=\"border:1px solid #CCCCCC;width:70%px;\">";
	debugKishTranslate();
//}	print "</div>";
?>
<form action="?page=kish-translate" method="POST">
<input type="hidden" name="action" value="save"/>
<table width="70%" height="129" border="1" cellpadding="6" cellspacing="1" bordercolor="#000000" align="left" style="margin-left:15px">
	<tr bgcolor="#FFFFFF" border="1"> 
		<td width="34%"  bordercolor="#FFFFFF"><font color="#2a4255"><strong>Enable Ajax Translation Widget</strong></font></td>
		<td bordercolor="#99CCFF"><input type="checkbox" name="kish_trans_autoadd" value = "1" <?php if(get_option('kish_trans_autoadd')==1) { echo " checked "; }?>></td>	
		<td width="34%"  bordercolor="#e4f2fd"><font color="#2a4255"><strong>Add Permalinks After Post</strong></font></td>
		<td bordercolor="#99CCFF"><input type="checkbox" name="kish_trans_autofooter" value = "1" <?php if(get_option('kish_trans_autofooter')==1) { echo " checked "; }?>></td>		
	</tr>
	<tr bgcolor="#e4f2fd"> 
		<td height="42" bordercolor="#e4f2fd"><font color="#2a4255">Background Color #</font></td>
    <td bordercolor="#e4f2fd"><input name="kish_trans_bcolor" type="text" value="<?php echo get_option('kish_trans_bcolor'); ?>" size="20">
    </td>	
		<td height="42" bordercolor="#e4f2fd"><font color="#2a4255">Font Color #</font></td>
    <td bordercolor="#e4f2fd"><input name="kish_trans_fcolor" type="text" value="<?php echo get_option('kish_trans_fcolor'); ?>" size="20">
    </td>
	</tr>  
	</tr>
	<tr bgcolor="#e4f2fd"> 
		<td height="42" bordercolor="#e4f2fd"><font color="#2a4255">Border Color#</font></td>
    <td bordercolor="#e4f2fd"><input name="kish_trans_bordercolor" type="text" value="<?php echo get_option('kish_trans_bordercolor'); ?>" size="20">
    </td>	
		<td height="42" bordercolor="#e4f2fd"><font color="#2a4255">Widget Height in px</font></td>
    <td bordercolor="#e4f2fd"><input name="kish_trans_widheight" type="text" value="<?php echo get_option('kish_trans_widheight'); ?>" size="20">
    </td>
	</tr>
	<tr bgcolor="#e4f2fd"> 
		<td height="42" bordercolor="#e4f2fd"><font color="#2a4255">Widget Width in px</font></td>
    <td bordercolor="#e4f2fd"><input name="kish_trans_widwidth" type="text" value="<?php echo get_option('kish_trans_widwidth'); ?>" size="20">
    </td>	
		<td height="42" bordercolor="#e4f2fd"><font color="#2a4255">Widget Border Width in px</font></td>
    <td bordercolor="#e4f2fd"><input name="kish_trans_borderwid" type="text" value="<?php echo get_option('kish_trans_borderwid'); ?>" size="20">
    </td>
	</tr>
	<tr bgcolor="#e4f2fd"> 
		<td height="42" bordercolor="#e4f2fd"><font color="#2a4255">Translated Text Color#</font></td>
    <td bordercolor="#e4f2fd"><input name="kish_trans_txtfontcolor" type="text" value="<?php echo get_option('kish_trans_txtfontcolor'); ?>" size="20">
    </td>	
		<td height="42" bordercolor="#e4f2fd"><font color="#2a4255">Translated Text Fade Color</font></td>
    <td bordercolor="#e4f2fd"><input name="kish_trans_txtBackcolor" type="text" value="<?php echo get_option('kish_trans_txtBackcolor'); ?>" size="20">
    </td>
	</tr>
	<tr bgcolor="#e4f2fd"> 
		<td width="34%"  bordercolor="#e4f2fd"><font color="#2a4255">Romanian</font></td>
		<td bordercolor="#99CCFF"><input type="checkbox" name="kish_trans_romanian" value = "1" <?php if(get_option('kish_trans_romanian')==1) { echo " checked "; }?>></td>
		<td width="34%"  bordercolor="#e4f2fd"><font color="#2a4255">German</font></td>
		<td bordercolor="#99CCFF"><input type="checkbox" name="kish_trans_german" value = "1" <?php if(get_option('kish_trans_german')==1) { echo " checked "; }?>></td>			
	</tr> 	
	</tr>
	<tr bgcolor="#e4f2fd"> 
		<td width="34%"  bordercolor="#e4f2fd"><font color="#2a4255">Arabic</font></td>
		<td bordercolor="#99CCFF"><input type="checkbox" name="kish_trans_arabic" value = "1" <?php if(get_option('kish_trans_arabic')==1) { echo " checked "; }?>></td>	
		<td width="34%"  bordercolor="#e4f2fd"><font color="#2a4255">Hindi</font></td>
		<td bordercolor="#99CCFF"><input type="checkbox" name="kish_trans_hindi" value = "1" <?php if(get_option('kish_trans_hindi')==1) { echo " checked "; }?>></td>		
	</tr>
	<tr bgcolor="#e4f2fd"> 
		<td width="34%"  bordercolor="#e4f2fd"><font color="#2a4255">Russian</font></td>
		<td bordercolor="#99CCFF"><input type="checkbox" name="kish_trans_russian" value = "1" <?php if(get_option('kish_trans_russian')==1) { echo " checked "; }?>></td>		
		<td width="34%"  bordercolor="#e4f2fd"><font color="#2a4255">French</font></td>
		<td bordercolor="#99CCFF"><input type="checkbox" name="kish_trans_french" value = "1" <?php if(get_option('kish_trans_french')==1) { echo " checked "; }?>></td>		
	</tr>
	<tr bgcolor="#e4f2fd"> 
		<td width="34%"  bordercolor="#e4f2fd"><font color="#2a4255">Spanish</font></td>
		<td bordercolor="#99CCFF"><input type="checkbox" name="kish_trans_spanish" value = "1" <?php if(get_option('kish_trans_spanish')==1) { echo " checked "; }?>></td>
		<td width="34%"  bordercolor="#e4f2fd"><font color="#2a4255">Czech</font></td>
		<td bordercolor="#99CCFF"><input type="checkbox" name="kish_trans_czech" value = "1" <?php if(get_option('kish_trans_czech')==1) { echo " checked "; }?>></td>			
	</tr>  
		<tr bgcolor="#e4f2fd"> 
		<td width="34%"  bordercolor="#e4f2fd"><font color="#2a4255">Italian</font></td>
		<td bordercolor="#99CCFF"><input type="checkbox" name="kish_trans_italian" value = "1" <?php if(get_option('kish_trans_italian')==1) { echo " checked "; }?>></td>
		<td width="34%"  bordercolor="#e4f2fd"><font color="#2a4255">Danish</font></td>
		<td bordercolor="#99CCFF"><input type="checkbox" name="kish_trans_danish" value = "1" <?php if(get_option('kish_trans_danish')==1) { echo " checked "; }?>></td>			
	</tr>
		<tr bgcolor="#e4f2fd"> 
		<td width="34%"  bordercolor="#e4f2fd"><font color="#2a4255">Chinese</font></td>
		<td bordercolor="#99CCFF"><input type="checkbox" name="kish_trans_chinese" value = "1" <?php if(get_option('kish_trans_chinese')==1) { echo " checked "; }?>></td>
		<td width="34%"  bordercolor="#e4f2fd"><font color="#2a4255">Finnish</font></td>
		<td bordercolor="#99CCFF"><input type="checkbox" name="kish_trans_finnish" value = "1" <?php if(get_option('kish_trans_finnish')==1) { echo " checked "; }?>></td>			
	</tr>  
	<tr bgcolor="#e4f2fd"> 
		<td width="34%"  bordercolor="#e4f2fd"><font color="#2a4255">Romanian</font></td>
		<td bordercolor="#99CCFF"><input type="checkbox" name="kish_trans_romanian" value = "1" <?php if(get_option('kish_trans_romanian')==1) { echo " checked "; }?>></td>
		<td width="34%"  bordercolor="#e4f2fd"><font color="#2a4255">Korean</font></td>
		<td bordercolor="#99CCFF"><input type="checkbox" name="kish_trans_korean" value = "1" <?php if(get_option('kish_trans_korean')==1) { echo " checked "; }?>></td>			
	</tr>  
	<tr bgcolor="#e4f2fd"> 
		<td width="34%"  bordercolor="#e4f2fd"><font color="#2a4255">English</font></td>
		<td bordercolor="#99CCFF"><input type="checkbox" name="kish_trans_english" value = "1" <?php if(get_option('kish_trans_english')==1) { echo " checked "; }?>></td>
		<td width="34%"  bordercolor="#e4f2fd"><font color="#2a4255">Swedish</font></td>
		<td bordercolor="#99CCFF"><input type="checkbox" name="kish_trans_swedish" value = "1" <?php if(get_option('kish_trans_swedish')==1) { echo " checked "; }?>></td>			
	</tr> 
	<tr bgcolor="#e4f2fd"> 
		<td width="34%"  bordercolor="#e4f2fd"><font color="#2a4255">Bulgarian</font></td>
		<td bordercolor="#99CCFF"><input type="checkbox" name="kish_trans_bulgarian" value = "1" <?php if(get_option('kish_trans_bulgarian')==1) { echo " checked "; }?>></td>
		<td width="34%"  bordercolor="#e4f2fd"><font color="#2a4255">Croatian</font></td>
		<td bordercolor="#99CCFF"><input type="checkbox" name="kish_trans_croatian" value = "1" <?php if(get_option('kish_trans_croatian')==1) { echo " checked "; }?>></td>			
	</tr> 
	<tr bgcolor="#e4f2fd"> 
		<td width="34%"  bordercolor="#e4f2fd"><font color="#2a4255">Dutch</font></td>
		<td bordercolor="#99CCFF"><input type="checkbox" name="kish_trans_dutch" value = "1" <?php if(get_option('kish_trans_dutch')==1) { echo " checked "; }?>></td>
		<td width="34%"  bordercolor="#e4f2fd"><font color="#2a4255">Greek</font></td>
		<td bordercolor="#99CCFF"><input type="checkbox" name="kish_trans_greek" value = "1" <?php if(get_option('kish_trans_greek')==1) { echo " checked "; }?>></td>			
	</tr> 
	<tr bgcolor="#e4f2fd"> 
		<td width="34%"  bordercolor="#e4f2fd"><font color="#2a4255">Japanese</font></td>
		<td bordercolor="#99CCFF"><input type="checkbox" name="kish_trans_japan" value = "1" <?php if(get_option('kish_trans_japan')==1) { echo " checked "; }?>></td>
		<td width="34%"  bordercolor="#e4f2fd"><font color="#2a4255">Korean</font></td>
		<td bordercolor="#99CCFF"><input type="checkbox" name="kish_trans_korean" value = "1" <?php if(get_option('kish_trans_korean')==1) { echo " checked "; }?>></td>			
	</tr> 
	<tr bgcolor="#e4f2fd"> 
		<td width="34%"  bordercolor="#e4f2fd"><font color="#2a4255">Polish</font></td>
		<td bordercolor="#99CCFF"><input type="checkbox" name="kish_trans_polish" value = "1" <?php if(get_option('kish_trans_polish')==1) { echo " checked "; }?>></td>
		<td width="34%"  bordercolor="#e4f2fd"><font color="#2a4255">Portuguese</font></td>
		<td bordercolor="#99CCFF"><input type="checkbox" name="kish_trans_portuguese" value = "1" <?php if(get_option('kish_trans_portuguese')==1) { echo " checked "; }?>></td>			
	</tr> 

	<!--google tranlation page saving options -->
	<tr bgcolor="#e4f2fd"> 
		<td width="34%"  bordercolor="#e4f2fd"><font color="#2a4255">Enable Page Saving</font></td>
		<td bordercolor="#99CCFF"><input type="checkbox" name="kish_trans_enpagesave" value = "1" <?php if(get_option('kish_trans_enpagesave')==1) { echo " checked "; }?>></td>
		<td width="34%"  bordercolor="#e4f2fd"><font color="#2a4255">Enable Debug</font></td>
		<td bordercolor="#99CCFF"><input type="checkbox" name="kish_trans_endebug" value = "1" <?php if(get_option('kish_trans_endebug')==1) { echo " checked "; }?>></td>			
	</tr> 
	<tr bgcolor="#e4f2fd"> 
		<td height="42" bordercolor="#e4f2fd"><font color="#2a4255">Blog Language</font></td>
    	<td bordercolor="#e4f2fd"><?php kish_tran_printAdminOptionBox(); ?>
    	</td>	
		<td height="42" bordercolor="#e4f2fd"><font color="#2a4255">Lang Directory Name</font></td>
    <td bordercolor="#e4f2fd"><input name="kish_trans_langdirname" type="text" value="<?php echo get_option('kish_trans_langdirname'); ?>" size="20">
    </td>	
	</tr>
	<tr bgcolor="#e4f2fd"> 
		<td height="42" bordercolor="#e4f2fd"><font color="#2a4255">Page Creation Cron Frequency</font></td>
    <td bordercolor="#e4f2fd"><select name="kish_trans_cron" size="1">
	<?php $croninterval = get_option('kish_trans_cron'); ?>
	<?php 
	if ($croninterval >=0) {
		if($croninterval==1) $interval = "Every 1 Hour";
		if($croninterval==2) $interval = "Every 2 Hours";
		if($croninterval==10) $interval = "Every 10 Hours";
		if($croninterval==24) $interval = "Every Day";
		if($croninterval==72) $interval = "Every 3 Days";
		if($croninterval==138) $interval = "Every Week";
		if($croninterval==720) $interval = "Every Month";
	}
	?>
	  <?php if(strlen($croninterval)) { ?><option value="<?php echo $croninterval; ?>" selected="selected"><?php echo $interval; ?></option><?php } else {?><option value="24" selected="selected">Every Day</option><?php } ?>
  <?php if($croninterval!=1) {?><option value="1">Every 1 Hour</option><?php } ?>
  <?php if($croninterval!=2) {?><option value="2">Every 2 Hours</option><?php } ?>
  <?php if($croninterval!=10) {?><option value="10">Every 10 Hours</option><?php } ?>
  <?php if(strlen($croninterval) && $croninterval!=24) {?><option value="24">Every Day</option><?php } ?>
  <?php if($croninterval!=72) {?><option value="72">Every 3 Days</option><?php } ?>
  <?php if($croninterval!=138) {?><option value="138">Every Week</option><?php } ?>
  <?php if($croninterval!=720) {?><option value="720">Every Month</option><?php } ?>
</select>
    </td>	
		<td height="42" bordercolor="#e4f2fd"><font color="#2a4255">Extension</font></td>
    <td bordercolor="#e4f2fd"><select name="kish_trans_ext" size="1">
	<?php $extension = get_option('kish_trans_ext'); ?>
	<option value="<?php echo get_option('kish_trans_ext'); ?>" selected="selected"><?php echo get_option('kish_trans_ext'); ?></option>
	  <option value=".html">.html</option>
	  </select>
    </td>
	</tr>
 <tr>
 <tr bgcolor="#e4f2fd"> 
 <td><strong>Save Your Settings</strong></td>
    <td height="39" bordercolor="#e4f2fd" bgcolor="#e4f2fd"><div align="center"> 
        <input class="button-secondary" type="submit" name="Submit" value="Update Options &raquo;" >
      </div></td>

  </tr>
</table>
</form>

<?php

}
function saveDefaults() {
	if(!strlen(get_option('kish_trans_rootpath'))) update_option('kish_trans_rootpath', dirname(dirname(dirname(dirname(__FILE__)))));
	if(!strlen(get_option('kish_trans_wordpressurl'))) update_option('kish_trans_wordpressurl',get_bloginfo('wpurl'));	
	if(!strlen(get_option('kish_trans_endebug'))) update_option('kish_trans_endebug',1);
	if(!strlen(get_option('kish_trans_langdirname'))) update_option('kish_trans_langdirname',"lang");
	if(!strlen(get_option('kish_trans_enpagesave'))) update_option('kish_trans_enpagesave',0);
	if(!strlen(get_option('kish_trans_bcolor'))) update_option('kish_trans_bcolor','FFFFFF');
	if(!strlen(get_option('kish_trans_fcolor'))) update_option('kish_trans_fcolor',"000000");
	if(!strlen(get_option('kish_trans_enpagesave'))) update_option('kish_trans_enpagesave',0);
	saveSlugEndToDB();
}
function saveSlugEndToDB() {
	query_posts('showposts=1');
	while(have_posts()) { the_post();
		$postslug = str_replace(KT_BLOGURL,"",get_permalink());
	}
	$slugend = getPostSlugEnd($postslug);
	update_option('kish_trans_slugend',$slugend);
}
function debugKishTranslate() {	
	global $wpdb;
	
?>
	<table width="70%" border="0">
		<tr>
			<td><strong>Check For Debugging</strong></td>
		</tr>
		<tr>
			<td>Version check</td>
			<td><?php echo "Version From DB <strong>" . get_option('kish_trans_version')."</strong>"; ?></td>		
		</tr>
		<tr>
			<td>Directory To Save Translation</td>
			<td><?php echo "<strong>" . get_option('kish_trans_langdirname')."</strong>"; ?></td>		
		</tr>
		<tr>
			<td>Full Path To Save Translation</td>
			<td><?php echo "<strong>" .KT_ROOT_PATH."/".get_option('kish_trans_langdirname')."/</strong>"; ?></td>		
		</tr>
		<tr>
			<td>Wordpress URL</td>
			<td><?php echo "<strong>" .get_option('kish_trans_wordpressurl'); ?></td>		
		</tr>
		<tr>
			<td>Wordpress URL Ending</td>
			<td><?php echo "<strong>" .get_option('kish_trans_slugend'); ?></td>		
		</tr>
		<tr>
			<td>Last Cron Done</td>
			<td><?php echo "<strong>" .(date(mktime())- get_option('kish_trans_google_last_cron')); ?> Seconds Before</td>		
		</tr>

		<tr>		
			<td>Translation Directory Status</td>
				<?php checkLangDir(KT_ROOT_PATH."/".get_option('kish_trans_langdirname')) ? $result = "Translation Directory Available" : $result = "Error creating Translationd Directory ".get_option('kish_trans_rootpath')."/".get_option('kish_trans_langdirname'); ?>
			<td><?php echo "<strong>" .$result; ?></td>		
		</tr>
	</table>
	<?php
}
function table_exists($tablename) {
	global $wpdb;
    foreach ($wpdb->get_col("SHOW TABLES",0) as $table ) {
        if ($table == $tablename) {
            return true;
        }
    }

}
function kish_tran_debug($msg, $priority=1) {
	global $kish_debug_msg;
	if(KT_DEBUG_ON) {
		$priority == 1 ? $output = "<p style = \"font-weight:bold; color:#0a912a; font-size:12px\">".$msg."</p>" : $output = "<p style = \"font-weight:bold; color:#FF0000; font-size:10px\">".$msg."</p>";
			$kish_debug_msg.= $output;
	}	
}
function printKishTranslatePermalink($count=5) {
	global $wp_query, $kish_translate_credits;
	$pageId = $wp_query->post->ID;
	if(!is_numeric($count)) $count = 5;
	$count = get_option('kish_trans_count_pl');
	if($count==false) $count = 5;
	if ($count >=20 || $count <0) $count = 20;	
	$lang=availabe_languages();
	$len=count($lang);
	echo "<div>";
	echo "<strong>Permalink To Available Translations</strong>";
	print "<p>";
	for ($r = 0; $r < $count; $r++) {
		$plink=get_permalink($pageId);
		$ptitle="Translation of ".get_the_title($pageId);
		strpos($plink,'?')===false ? print "<a title = \"".$ptitle."\" target = \"_blank\" href = \"".$plink."?lang=".$lang[$r]['id']."\">".$lang[$r]['name']."</a> | " :  print "<a title = \"".$ptitle."\" href = \"".$plink."&lang=".$lang[$r]['id']."\">".$lang[$r]['name']."</a> | "; 	
	}
	print " <a href = \"http://kish.in/wordpress-plugin-translation-ajax-seo/\" target = \"_blank\">Kish Translate Ajax</p></div><div class=\"clearfix\"></div>";
	
}
function printTransLangLinks($lang,$langdir, $wpurl, $postslug) {
	$root = dirname(dirname(dirname(dirname(__FILE__))));
	is_home() ? $langlink = KT_ROOT_PATH."/".$langdir."/".$lang."/index".KT_URL_EXTENSION : $langlink = KT_ROOT_PATH."/".$langdir."/".$lang.$postslug.KT_URL_EXTENSION;
	if(file_exists($langlink)){
		is_home() ? $langurl = $wpurl."/".$langdir."/".$lang."/" : $langurl = $wpurl."/".$langdir."/".$lang.$postslug.KT_URL_EXTENSION; 
	}
	else {
		is_home() ? $langurl = $wpurl."/".$langdir."/".$lang."/index".KT_URL_EXTENSION : $langurl = $wpurl."/".$langdir."/".$lang.$postslug.KT_URL_EXTENSION;
	}
	return $langurl;
}
function printKishTranslatePermalink2($count=5) {
	if(KT_ENABLE_PSAVE==1) {
		global $wp_query, $kish_translate_credits;
		$createTPage = true;
		$langdir = KT_LANG_DIR;
		$output = '';
		$pageId = $wp_query->post->ID;
		if(!is_numeric($count)) $count = 5;
		$count = get_option('kish_trans_count_pl');
		if($count==false) $count = 5;
		if ($count >=20 || $count <0) $count = 20;	
		$lang=availabe_languages();
		$len=count($lang);
		$output .= "<div>";
		$output .= "<strong>Permalink To Available Translations</strong>";
		$output .= "<p>";
		for ($r = 0; $r < $len; $r++) {
			$plink=get_permalink($pageId);
			strlen(KT_BLOGURL) ? $wpurl = KT_BLOGURL : $wpurl = KT_BLOGURL;
			$ptitle="Translation of ".get_the_title($pageId);
			$postslug = substr(getWPPostSlug($postId),0,-1);
			$root = get_option('kish_trans_rootpath');
			$langlink = KT_ROOT_PATH."/".KT_LANG_DIR."/".$lang[$r]['id'].$postslug.get_option('kish_trans_ext');
			//print $langlink;
			$sourceurl = getSaveUrl(get_permalink($pageId), $lang[$r]['id']);
			//print $sourceurl;
			if($lang[$r]['id']==KT_BLOG_LANG) {
				$langurl = $plink;
				$rel = " rel = \"bookmark\" ";
			}
			else {
				$langurl=printTransLangLinks($lang[$r]['id'], $langdir, $wpurl, $postslug);
				file_exists($langlink) ? $rel = "" : $rel = "rel = \"nofollow\"";
			}
			$output .= "<a ".$rel." title = \"".$ptitle."\" href = \"".$langurl." \">".$lang[$r]['name']."</a> | "; 	
		}
		$output .= " <a href = \"http://kish.in/wordpress-plugin-translation-ajax-seo/\" target = \"_blank\">Kish Translate Ajax</a></p></div><div class=\"clearfix\"></div>";
		return $output;
	}
}

function replaceTranlatedWidget($saveurl) {
	$lang=availabe_languages();
	$len=count($lang);
	$langdirname = KT_LANG_DIR;
	$sourceurl = getSourceUrl($saveurl, $langdirname);
	$output .= "<div class = \"lang_sb\">";
	$output .= "<strong>Available Translations</strong>";
	$output .= "<p>";
	for ($r = 0; $r < $len; $r++) {		
		if($lang[$r]['id']==KT_BLOG_LANG) {
			$langurl = str_replace(KT_LANG_DIR."/".getLangRequest($saveurl)."/","", $saveurl);
			$langurl = str_replace(KT_URL_EXTENSION,KT_URL_SLUGEND, $langurl);
			if(kish_tran_ishome($saveurl)) $langurl = str_replace("/index/", "/", $langurl);
			$rel = " rel = \"bookmark\" ";
		}
		else {
			$langurl = str_replace("/".getLangRequest($saveurl)."/", "/".$lang[$r]['id']."/", $saveurl);
			if(file_exists(getServerPathSaveFile($langurl))) {
			 	$rel = " ";
				$langurl = str_replace("/index.html", "/", $langurl);
			}
			else {
			 	$rel = " rel = \"nofollow\" ";
			 }
			file_exists(getServerPathSaveFile($langurl)) ? $rel = " " : $rel = " rel = \"nofollow\" ";
		}
		$imgpath = KT_BLOGURL."/wp-content/plugins/kish-translate-ajax/flags/";
		$output .= "<a".$rel. "title = \"Translation in ".$lang[$r]['name']."\" href = \"".$langurl."\"><img src =\"".$imgpath.$lang[$r]['id'].".png\"></a>"; 	 	
	}
	$output .= "<br><strong><a href = \"http://kish.in/wordpress-plugin-translation-ajax-seo/\" target = \"_blank\">Kish Translate Ajax</a></strong></div>";
	return $output;
}
function kish_trans_get_permalink($postId) {
	return get_permalink($postId);
}
function printKishTranslateChangeLang($count=5) {
	global $post;
	$pageId = $wp_query->post->ID;
	is_single() ? $url = kish_trans_get_permalink($postId) : $url = cleanCurUrlBug(kish_trans_curPageURL());
	/*
	if(strpos($url,KT_BLOGURL)===false) {
		if(strpos(str_replace("www.", "",$url),KT_BLOGURL)===false) {
				print "Problem is Sourceurl";
				return false;
		}
		else $url = str_replace("www.", "",$url);
	}
		if(is_home()) {
			//$url = $url."index.php";
		}*/
	if(KT_ENABLE_PSAVE==1) {
		global $wp_query, $kish_translate_credits;
		$createTPage = true;
		$langdir = get_option('kish_trans_langdirname');
		$output = '';		
		if(!is_numeric($count)) $count = 5;
		$count = get_option('kish_trans_count_pl');
		if($count==false) $count = 5;
		if ($count >=20 || $count <0) $count = 20;	
		$lang=availabe_languages();
		$len=count($lang);
		$output .= "<div class = \"lang_sb\">";
		$output .= "<strong>Available Translations</strong>";
		$output .= "<p>";
		for ($r = 0; $r < $len; $r++) {
			$plink=$url;
			strlen(KT_BLOGURL) ? $wpurl = KT_BLOGURL : $wpurl = KT_BLOGURL;
			is_home() ? $ptitle = "Translation of ".get_bloginfo()." in ".$lang[$r]['name'] : $ptitle= "Translation of ".get_the_title($pageId)." in ".$lang[$r]['name'];
			$postslug = substr(str_replace($wpurl, "", $plink),0,-1);
			if(is_home()) {
				//print "Yest its home.<br>";
				$postslug.= "/index";
			}
			$root = get_option('kish_trans_rootpath');
			file_exists(getServerPathSaveFile($langurl)) ? $homextension = "/" : $homextension = "/index".KT_URL_EXTENSION;
			is_home() ? $langlink = KT_ROOT_PATH."/".KT_LANG_DIR."/".$lang[$r]['id'].$homextension :  $langlink = KT_ROOT_PATH."/".KT_LANG_DIR."/".$lang[$r]['id'].$postslug.KT_URL_EXTENSION;
			if($lang[$r]['id']==KT_BLOG_LANG) {	
				$langurl = $url;
				$rel = " rel = \"bookmark\" ";
			}
			else {
				$langurl=printTransLangLinks($lang[$r]['id'], KT_LANG_DIR, KT_BLOGURL, $postslug);
				file_exists(getServerPathSaveFile($langurl)) ? $rel = " " : $rel = " rel = \"nofollow\" ";
			}
			is_home() ? $sourceurl = getSaveUrlIndex($url,$lang[$r]['id']) : $sourceurl = getSaveUrl(get_permalink($pageId), $lang[$r]['id']);
			$imgpath = KT_BLOGURL."/wp-content/plugins/kish-translate-ajax/flags/";
			$output .= "<a".$rel."title = \"".$ptitle."\" href = \"".$langurl." \"><img src =\"".$imgpath.$lang[$r]['id'].".png\"></a>"; 	
		}
		$output .= "<br><strong><a href = \"http://kish.in/wordpress-plugin-translation-ajax-seo/\" target = \"_blank\">Kish Translate Ajax</a></strong></div>";
		print $output;
	//}
	}
}

function checkfileage($file) {
	if(file_exists($file)) {
		//print "File exisits ".$file."<br>";
		//getting the user setting of cache time, if not set we assign the default value is 24 set
		get_option('kish_trans_cron') ? $cachetime = get_option('kish_trans_cron') : $cachetime = 24;
		//print "Cachetime is ".$cachetime."<br>";
		//checking if its a numeric valuce
		is_numeric($cachetime) ? $cachetime=$cachetime*3600 : $cachetime=24*3600;
		//print "Cachetime is ".$cachetime."<br>";
		$createdDate =filemtime($file);
		//print "Created Time  is ".$createdDate."<br>";
		$diff = date(mktime())-$createdDate;
		//print "Difference  Time  is ".$diff."<br>";
		if($diff>=$cachetime) {
			//print "Difference  IS GREATE ".$diff."<br>";
			return true;
		}
		else {
			//print "Difference  IS less ".$diff."<br>";
			return false;
		}
	}
	else {
		//print "File DOESE NOT exisits ".$file."<br>";
		//file does not exisit, so we need to create so we declare as aged
		return true;
	}
}
function getWPPostSlug($postId) {
	return str_replace(get_bloginfo('wpurl'),"",get_permalink($pageId));
}

//creating the file saving destination url from the translated page url which contains the language directory name and the language name
function createSavefile($saveurl, $root) {
	kish_tran_debug("Got into createSavefile($saveurl, $root)", 1);
	$url = str_replace(KT_BLOGURL,"",$saveurl);
	kish_tran_debug("retruning the value $root.$url", 1);
	return $root.$url;
}
function getSourceUrl($saveurl, $langdir) {
	kish_tran_debug("Got into function getSourceUrl($saveurl, $langdir)", 1);
	//$saveurl=cleanCurUrlBug($saveurl);
	//print "Saveurl is ".$saveurl."<br>";
	kish_tran_debug("Saveurl is $saveurl)", 1);
	if(!strlen($langdir)) { $langdir = KT_LANG_DIR; }
	$lang = getLangRequest($saveurl);
	kish_tran_debug("Got the value of lang from the function getLangRequest($saveurl)", 1);
	//print "Laguage is ".$lang."<br>";
	$replace = $langdir."/".$lang."/";	
	$sourceurl =str_replace($replace, "", $saveurl);
	kish_tran_debug("Now after removing langdir and lang $sourceurl", 1);
	//print "Now after removing langdir and lang".$sourceurl."<br>";
	//print "Vaule of extions in db".get_option('kish_trans_ext')."<br>";
	kish_tran_debug("Checking for Sourceurl for extension = $sourceurl, ".KT_URL_EXTENSION , 1);
	if(strpos($sourceurl,KT_URL_EXTENSION)) {
		$sourceurl = str_replace(KT_URL_EXTENSION, "",$sourceurl);
		kish_tran_debug("removed extension , ".KT_URL_EXTENSION." from $sourceurl", 1);
		$sourceurl.= KT_URL_SLUGEND;
		kish_tran_debug("Added the slugend ".KT_URL_SLUGEND, 1);
		kish_tran_debug("Checking if Source URL has index/", 1);
		if(strpos($sourceurl, "index/")) {
			kish_tran_debug("Found index/", 1);
			$sourceurl = str_replace("index/","",$sourceurl);
			kish_tran_debug("Removed  index/, Now the value of sourceurl is $sourceurl", 1);
		}
		//print "Everything fine".$sourceurl."<br>";
		return $sourceurl;
	}
	else {
	kish_tran_debug("Extension not found", 2);
	//print $lang."#".$saveurl."#".$sourceurl."#Error in URL Extension Setting<br>";
	//exit;
	}
}
function getSaveUrl($pageurl, $lang) {
	kish_tran_debug("Getting into function getSaveUrl($pageurl, $lang)", 1);
	$pageurl = cleanCurUrlBug($pageurl);
	kish_tran_debug("Value of pageurl after cleainCurUrlBug = $pageurl", 1);
	//print "Page URL " .$pageurl;
	$replace = KT_BLOGURL."/".KT_LANG_DIR."/".$lang;
	kish_tran_debug("Value of replace is $replace", 1);
	$saveurl = str_replace(KT_BLOGURL,$replace, $pageurl);
	kish_tran_debug("Value of saveurl after replacing the blogurl and langdirectory name and lang = $saveurl", 1);
	$slugendlen = strlen(KT_URL_SLUGEND);
	if(substr($saveurl,-$slugendlen)==KT_URL_SLUGEND) {
		$saveurl = substr($saveurl,0,-$slugendlen);
	}
	if(strlen(KT_URL_EXTENSION)) {
		$saveurl.=KT_URL_EXTENSION;
		kish_tran_debug("Value of saveurl after adding the extension = $saveurl", 1);
	}
	else {
		kish_tran_debug("Extension not saved ", 2);
		print "Extension Option not saved in the setting";
	}
	//print $saveurl;
	return $saveurl;
}
function getServerPathSaveFile($saveUrl) {
	if(strpos($saveUrl,KT_LANG_DIR)) {
		return str_replace(KT_BLOGURL, KT_ROOT_PATH,$saveUrl);
	}
	else return false;
}
function kish_trans_security_check($fileurl) {
	if(strpos($fileurl, KT_BLOGURL."/".KT_LANG_DIR."/")!==false) {
		if(strpos($fileurl, '/wp-content/')!==false) {
			return false;
		}
		else if(strpos($fileurl, '/wp-admin/')!==false) {
			return false;
		}
		else {
			return true;
		}
	}
	else {
		return false;
	}
}

function getSaveUrlIndex($pageurl, $lang) {
	//print "Page URL " .$pageurl;
	$replace = KT_BLOGURL."/".KT_LANG_DIR."/".$lang."/index";
	//print $replace;
	$saveurl = str_replace($pageurl,$replace, $pageurl);
	//print $saveurl;
	//$slugendlen = strlen(get_option('kish_trans_slugend'));
	//$saveurl = substr($saveurl,0,-$slugendlen);
	$saveurl.=KT_URL_EXTENSION;
	//print $saveurl;
	return $saveurl;
}
function cleanCurUrlBug($url) {
	//print get_option('kish_trans_wordpressurl');
	if(strpos($url, "#")) {
	$url = substr($url, 0, strpos($url, "#"));
	}
	if(strpos($url,KT_BLOGURL)===false) {
		if(strpos(str_replace("www.", "",$url),KT_BLOGURL)===false) {
			//print "Problem is Sourceurl";
			exit;
		}
		else {
			$url = str_replace("www.", "",$url);
			return $url;
		}
	}
	else {
		return $url;
	}
}

function createTranspage($langlink) {
	//$pageurl = getSourceUrl($langlink, $langdir);
	//$gourl = "?file=".$langlink."&redirect=".$pageurl;
	$gourl = "?file=".$langlink;
	$gourl = KT_BLOGURL."/wp-content/plugins/kish-translate-ajax/createp.php".$gourl;
	print "<iframe src=\"".$gourl."\" width=\"0\" height=\"0\" border=\"0\"></iframe>";
}
function kish_tran_cronjob() {
	if(!$_REQUEST['kishtrans']) {
		if((date(mktime())- get_option('kish_trans_google_last_cron')) >= 300) {
			$createTPage = true;
			$thisurl = cleanCurUrlBug(kish_trans_curPageURL());
			$lang=availabe_languages();	
			$len=count($lang);
			for ($r = 0; $r < $len; $r++) {		
				//is_home() ? $sourceurl = getSaveUrlIndex($thisurl, $lang[$r]['id']) : $sourceurl = getSaveUrl($thisurl, $lang[$r]['id']);
				$thisurl == KT_BLOGURL."/" ? $sourceurl = getSaveUrlIndex($thisurl, $lang[$r]['id']) : $sourceurl = getSaveUrl($thisurl, $lang[$r]['id']);
				$savefile = getServerPathSaveFile($sourceurl);
				if(!file_exists($savefile) && $createTPage==true && $lang[$r]['id']!=KT_BLOG_LANG){
				//print "Creating New Cache Page..";
					update_option('kish_trans_google_last_cron', date(mktime()));
					createTranspage($sourceurl);
					$createTPage = false;
				}
				else if(file_exists($savefile) && $createTPage==true  && checkfileage($savefile) && $lang[$r]['id']!=KT_BLOG_LANG) {
				//print "Creating New Cache Page..Condition -2<br>";
					update_option('kish_trans_google_last_cron', date(mktime()));
					createTranspage($sourceurl);
					$createTPage = false;
				}
				else if(file_exists($savefile) && $createTPage==true  && $lang[$r]['id']!=KT_BLOG_LANG && filesize($savefile) <=1) {
					update_option('kish_trans_google_last_cron', date(mktime()));
					createTranspage($sourceurl);
					$createTPage = false;
				}
			}
		}
	}
}
function kish_tran_ishome($url) {
	if(strlen(getLangRequest($url))) {
		if(strpos($url, getLangRequest($url)."/index.html")) {
			return true;
		}
		else return false;
	}
	else return false;
}
function kish_transpage_cronjob($saveurl) {
	if((date(mktime())- get_option('kish_trans_google_last_cron')) >= 300) {
		$createTPage = true;		
		$thisurl = $saveurl;
		//print $thisurl;
		$thisurl = getSourceUrl($thisurl, KT_LANG_DIR);
		//print "Original url is $thisurl";
		$lang=availabe_languages();	
		$len=count($lang);
		for ($r = 0; $r < $len; $r++) {		
			if($thisurl==KT_BLOGURL."/") {
				//print "Home URL";
				$sourceurl = getSaveUrlIndex($thisurl, $lang[$r]['id']);
			}
			else {
				//print "Not home url";
				$sourceurl = getSaveUrl($thisurl, $lang[$r]['id']);	
			}		
			//print "Source url is ".$sourceurl."<br>";
			$savefile = getServerPathSaveFile($sourceurl);
			//print "Page savefile is ".$savefile."<br>";
			if(!file_exists($savefile) && $createTPage==true && $lang[$r]['id']!=KT_BLOG_LANG){
			//print "Creating New Cache Page..";
				$pageurl = $thisurl;
				//$gourl = "?file=".$sourceurl."&redirect=".$pageurl;
				$gourl = "?file=".$sourceurl;
				$gourl = KT_BLOGURL."/wp-content/plugins/kish-translate-ajax/createp.php".$gourl;
				$createTPage = false;
				//print $gourl;
				update_option('kish_trans_google_last_cron', date(mktime()));
				return "<iframe src=\"".$gourl."\" width=\"0\" height=\"0\" border=\"0\"></iframe>";				
			}
			else if(file_exists($savefile) && $createTPage==true  && checkfileage($savefile) && $lang[$r]['id']!=KT_BLOG_LANG) {
			//print "Creating New Cache Page..Condition -2<br>";
				$pageurl = $thisurl;
				//$gourl = "?file=".$sourceurl."&redirect=".$pageurl;
				$gourl = "?file=".$sourceurl;
				$gourl = KT_BLOGURL."/wp-content/plugins/kish-translate-ajax/createp.php".$gourl;
				$createTPage = false;
				update_option('kish_trans_google_last_cron', date(mktime()));
				return "<iframe src=\"".$gourl."\" width=\"0\" height=\"0\" border=\"0\"></iframe>";
			}
			else if(file_exists($savefile) && $createTPage==true  && $lang[$r]['id']!=KT_BLOG_LANG && filesize($savefile) <=1) {
				$pageurl = $thisurl;
				//$gourl = "?file=".$sourceurl."&redirect=".$pageurl;
				$gourl = "?file=".$sourceurl;
				$gourl = KT_BLOGURL."/wp-content/plugins/kish-translate-ajax/createp.php".$gourl;
				$createTPage = false;
				update_option('kish_trans_google_last_cron', date(mktime()));
				return "<iframe src=\"".$gourl."\" width=\"0\" height=\"0\" border=\"0\"></iframe>";
			}
		}
		//print $gourl;
	}
}
function getLangRequest($url) {
	$langdirpos = strpos($url, KT_LANG_DIR);
	$langdirlength = strlen(KT_LANG_DIR);
	$strfromlangdir = substr($url, $langdirpos+$langdirlength+1);
	//print $strfromlangdir."<br>";
	$langlength = strpos($strfromlangdir, "/");
	$lang = substr($url, $langdirpos+$langdirlength+1,$langlength);
	return $lang;
}
function getPostSlugEnd($postslug) {
	if(substr($postslug,-1)=="/") {
		$slugend = "/";
	}
	else if(strpos($postslug, ".")) {
		$pos = strpos($postslug, ".");
		$slugend = substr($postslug, $pos);
	}
	else {
		$slugend = "";
	}
	//update_option('kish_trans_slugend',$slugend);
	return $slugend;
}
function translateUrl($url, $lang) {
	global $kish_T_root, $kish_translate_credits;
	file_exists(ABSPATH.'/wp-content/plugins/kish-translate-ajax/googleTranslateTool.class.php') ? include_once(ABSPATH.'/wp-content/plugins/kish-translate-ajax/googleTranslateTool.class.php') : include_once($kish_T_root.'/googleTranslateTool.class.php'); 
	$startfrom=0; 
	$translator = new googleTranslateTool('en',$lang);
	$result = $translator->translate_URL($url."?req=lang");
	return $result;
}
function permalink_the_content($content) {
global $post;
if(is_single() && !$_REQUEST['kishtrans']) {
	get_option('kish_trans_autofooter')==1 ? $permBox = "<div>".printKishTranslatePermalink2(20)."</div><br>" : $permBox='';
	$finalcontent = "<div>".$content.$permBox."</div>";	
	return $finalcontent;
	}
	else {
		return $content;
	}
}



function availabe_languages(){
        $languages=array();
		$count =  0;
		if(get_option('kish_trans_arabic')==1) { $languages[$count]=array("id" => 'ar',"name" => 'Arabic'); $count++; }
		if(get_option('kish_trans_bulgarian')==1) { $languages[$count] = array("id" => 'bg',"name" => 'Bulgarian'); $count++; }
		if(get_option('kish_trans_chinese')==1)  { $languages[$count] = array("id" => 'zh-CN',"name" => 'Chinese'); $count++; }
		if(get_option('kish_trans_croatian')==1)  { $languages[$count] = array("id" => 'hr',"name" => 'Croatian'); $count++; }
		if(get_option('kish_trans_czech')==1)  { $languages[$count] = array("id" => 'cs',"name" => 'Czech'); $count++; }
		if(get_option('kish_trans_danish')==1)  { $languages[$count] = array("id" => 'da',"name" => 'Danish'); $count++; }
		if(get_option('kish_trans_dutch')==1)  { $languages[$count] = array("id" => 'nl',"name" => 'Dutch');  $count++; }
		$languages[$count] = array("id" => 'en',"name" => 'English'); $count++;
		if(get_option('kish_trans_finnish')==1)  { $languages[$count] = array("id" => 'fi',"name" => 'Finnish'); $count++; }
		if(get_option('kish_trans_french')==1)  { $languages[$count] = array("id" => 'fr',"name" => 'French'); $count++; }
		if(get_option('kish_trans_german')==1)  { $languages[$count] = array("id" => 'de',"name" => 'German'); $count++; }
		if(get_option('kish_trans_greek')==1)  { $languages[$count] = array("id" => 'el',"name" => 'Greek'); $count++; }
		if(get_option('kish_trans_hindi')==1) { $languages[$count] = array("id" => 'hi',"name" => 'Hindi'); $count++; }
		if(get_option('kish_trans_italian')==1)  { $languages[$count] = array("id" => 'it',"name" => 'Italian'); $count++; }
		if(get_option('kish_trans_japan')==1)  { $languages[$count] = array("id" => 'ja',"name" => 'Japanese'); $count++; }
		if(get_option('kish_trans_korean')==1)  { $languages[$count] = array("id" => 'ko',"name" => 'Korean'); $count++; }
		if(get_option('kish_trans_polish')==1) { $languages[$count] = array("id" => 'pl',"name" => 'Polish'); $count++; }
		if(get_option('kish_trans_portuguese')==1)  { $languages[$count] = array("id" => 'pt',"name" => 'Portuguese'); $count++; }
		if(get_option('kish_trans_romanian')==1)  { $languages[$count] = array("id" => 'ro',"name" => 'Romanian'); $count++; }
		if(get_option('kish_trans_russian')==1)  { $languages[$count] = array("id" => 'ru',"name" => 'Russian'); $count++; }
		if(get_option('kish_trans_spanish')==1)  { $languages[$count] = array("id" => 'es',"name" => 'Spanish'); $count++; }
		if(get_option('kish_trans_swedish')==1)  { $languages[$count] = array("id" => 'sv',"name" => 'Swedish');	$count++; }
return $languages;
}
function kish_trans_curPageURL() {
	$pageURL = 'http';
 	if ($_SERVER["HTTPS"] == "on") {
		$pageURL .= "s";
	}
 	$pageURL .= "://";
 	if ($_SERVER["SERVER_PORT"] != "80") {
  		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 	} 
	else {
  		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 	}
 return $pageURL;
}
//Widget Function
function kish_trans_lang_widget() {
	echo $before_widget;
    echo $before_title . $title . $after_title;
	kish_trans_print_widget();
    echo $after_widget;
}

function kish_trans_widget_init()
{
  register_sidebar_widget(__('Kish Translate Lang Icons'), 'kish_trans_lang_widget');
}
?>