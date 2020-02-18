<?php

/**
 *	STAFF PAGE MODULE
 *	By Xemah | https://xemah.com
 *
**/

require_once(__DIR__ . '/module.php');
$module = new StaffModule($language, $pages, $user, $navigation, $queries, $smarty, $cache);
