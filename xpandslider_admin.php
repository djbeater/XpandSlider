<?php

/*
 * e107 website system
 *
 * Copyright (C) 2008-2018 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * xpandSlider plugin - Perfect responsive image, HTML slider for e107 CMS
 * Author: rolla <raitis.rolis@gmail.com>
 *
*/

require_once("conf.php");

if (!defined('e107_INIT')) {
    require_once("../../class2.php");
}

$xpandSliderPrefs = e107::getPlugPref(XPNSLD_NAME); // get plugin prefs

if (!defined('XPNSLD_DEBUG')) {
    define('XPNSLD_DEBUG', $xpandSliderPrefs['xpnsld_debug']);
}

//$eplug_admin = true;

if (!e107::isInstalled(XPNSLD_NAME)) {
    e107::redirect('admin');
    exit;
}

e107_require_once(e_PLUGIN . 'gallery/includes/gallery_load.php');
// Load prettyPhoto settings and files.
gallery_load_prettyphoto();

e107::lan(XPNSLD_NAME, 'global'); // Loads e_PLUGIN."xpandslider/languages/English/global.php (if English is the current language)
e107::lan(XPNSLD_NAME, 'admin');

e107::css('url', '//cdn.jsdelivr.net/brutusin.json-forms/1.4.0/css/brutusin-json-forms.min.css');
e107::js('url', '//cdn.jsdelivr.net/brutusin.json-forms/1.4.0/js/brutusin-json-forms.min.js');
//e107::js('url', '//cdn.jsdelivr.net/brutusin.json-forms/1.4.0/js/brutusin-json-forms-bootstrap.min.js');

e107::css('core', '../lib/elfinder/css/elfinder.min.css');
e107::css('core', '../lib/elfinder/css/theme.css');
e107::js('core', '../lib/elfinder/js/elfinder.min.js');

e107::css(XPNSLD_NAME, 'css/xpnsld.css');
e107::js(XPNSLD_NAME, 'js/xpnsld-admin-js.js', 'jquery');

new plugin_xpandslider_admin;

$mes = e107::getMessage();

$imagesDir = dirname(__FILE__) . DIRECTORY_SEPARATOR . XPNSLD_IMG_DIR;

if (!is_writable($imagesDir)) {
    $mes->add("Slides directory <b>$imagesDir</b> not writable!", E_MESSAGE_WARNING);
}

require_once(e_ADMIN . "auth.php");

// Send page content
e107::getAdminUI()->runPage();

require_once(e_ADMIN . "footer.php");
