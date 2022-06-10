<?php

/**
 *    STAFF PAGE MODULE
 *    By Xemah | https://xemah.com
 *
**/

$staffLanguage = new Language(ROOT_PATH . '/modules/Staff/language', LANGUAGE);

require_once(ROOT_PATH . '/modules/Staff/module.php');
$module = new StaffModule($staffLanguage, $pages, $queries, $cache);