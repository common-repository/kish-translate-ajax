<?php
/*
Plugin Name: Kish Translate
Plugin URI: http://kish.in/wordpress-plugin-translation-ajax-seo/
Description: This plugin is a simple plugin to diplay inline translation using the google translate API. Your visitor can read the translation in the offered languages. You can select the languages that you would like the visitor to use. Other feature is that every page have a searchable and indexable page for every language you offer. Please update your <a href = "../wp-admin/options-general.php?page=kish-translate">settings here</a>.
Version:1.7
Author: Kishore Asokan
Author URI: http://www.kisaso.com 
*/

/*  Copyright 2008  Kishore Asokan  (email : kishore@asokans.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
$root = dirname(dirname(dirname(dirname(__FILE__))));
file_exists($root.'/wp-load.php') ? require_once($root.'/wp-load.php') : require_once($root.'/wp-config.php');
global $kish_T_root, $kish_translate_version, $kish_translate_credits, $kish_translate_wpurl, $kish_debug_msg;
define('KT_VERSION', 1.7);
define('KT_DEBUG_PREMSG', "<center><strong>YOU CAN DISABLE THIS MESSAGE BY DISABLING DEBUG OPTION</strong></center>");
define('KT_DEBUG_POSTMSG', "<center><strong>THIS DEBUG MESSAGE IS VIEWED ONLY PERSON WHO IS LOGGED IN AS ADMIN PREVILATES</strong></center>");
define('KT_BLOGURL', get_bloginfo('wpurl'));
define('KT_ROOT_PATH',  dirname(dirname(dirname(dirname(__FILE__)))));
define('KT_LANG_DIR', get_option('kish_trans_langdirname'));
define('KT_CACHE_LIFE', get_option('kish_trans_cron'));
define('KT_URL_EXTENSION', get_option('kish_trans_ext'));
define('KT_URL_SLUGEND', get_option('kish_trans_slugend'));
if(get_option('kish_trans_google_ban')==1) {
	define('KT_GOOGLE_BAN',true);
}
else {
	define('KT_GOOGLE_BAN',false);
}
define('KT_GOOGLE_BAN_L_CHECK', get_option('kish_trans_google_ban_check'));
if(strlen(get_option('kish_trans_bloglang'))) {
	define('KT_BLOG_LANG', get_option('kish_trans_bloglang'));
}
else {
	define('KT_BLOG_LANG', 'en');
}
define('KT_ENABLE_PSAVE', get_option('kish_trans_enpagesave'));
define('KT_CRON_TRANSPAGE_TOKEN', '<!--addtranspagecron -->');
if(get_option('kish_trans_endebug')==1) {
	define('KT_DEBUG_ON', true);
}
else {
	define('KT_DEBUG_ON', false);
}
//current version
$kish_translate_version ='1.6';
$kish_T_root = str_replace("\\", "/", dirname(__FILE__));

include_once($kish_T_root.'/functions.php');
include_once($kish_T_root.'/kish-translate-core.php');
$kish_translate_credits="<span class = \"kishinfo\"><a href = \"http://kish.in/wordpress-plugin-translation-ajax-seo/\" target = \"_blank\" title = \"Grab this plugin\" alt = \"Translation plugin for wordpress\"><img src = \"" .get_bloginfo('wpurl')."/wp-content/plugins/kish-translate-ajax/ga-translate.png\" align = \"right\"></a></span>";
//
// check if the Version is Updated
//echo "Version Running" . get_option('kish_trans_version');
function kish_tran_check_permalink_used() {
	global $wp_rewrite;
	if (isset($wp_rewrite) && $wp_rewrite->using_permalinks()) {
		define('KT_REWRITE_OK', true);
		define('KT_PL_BASE', $wp_rewrite->root);
	} else {
		define('KT_REWRITE_OK', false);
		define('KT_PL_BASE', '');
	}
}
if(get_option('kish_trans_version')!=KT_VERSION) {
		update_option('kish_trans_version', KT_VERSION);
}
if($_POST['req']=='links') {
	printLangList();
}
else if($_POST['req']=='translate') {
	googleTranslateJS($_POST['lang'], $_POST['pageid']);
}
else if($_POST['req']=='kishtran') {
	kish_trans_get_trans_fromPage($_POST['pageid'], $_POST['lang'], $_POST['url']);
}
else if($_POST['req']=='allang') {
	printLangListAll($_POST['pageid']);
}
else if($_POST['req']=='clearcache') {
	kish_translate_clearCache($_POST['lang'], $_POST['pageid']);
}
else if($_POST['req']=='clearcacheall') {
	kish_translate_clearCache_All($_POST['lang'], $_POST['pageid']);
}
if( function_exists('register_activation_hook') ) {
	register_activation_hook(__FILE__,"kish_translate_install");
}
//add_filter('query_vars', 'add_my_var_kish_translate');
if( function_exists('add_action') ) {
		//add_action("plugins_loaded", "kishTranslateWidget_init");
		add_action('wp_head', 'kish_translate_style');
		add_action('wp_head', 'addHeaderFadeJs');
		add_action('wp_head', 'kish_translate_js');	
		add_action('wp_footer', 'printKishTransfooter');	
		add_action('wp_footer', 'kish_tran_cronjob');	
		//add_filter('the_content', 'translate_the_content');
		add_filter('the_content', 'permalink_the_content');
		add_action('admin_menu', 'kish_translate_add_admin');
		add_action('init', 'kish_tran_check_permalink_used');
}
?>