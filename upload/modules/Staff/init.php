<?php

/**
 *	STAFF PAGE MODULE
 *	By Xemah | https://xemah.com
 *
**/

$staffLanguage = new Language(__DIR__ . '/language', LANGUAGE);

require_once(__DIR__ . '/module.php');
$module = new StaffModule($language, $staffLanguage, $user, $pages, $navigation, $queries, $smarty, $cache);
