<?php

/**
 *	STAFF PAGE MODULE
 *	By Xemah | https://xemah.com
 *
**/

$user->handlePanelPageLoad(StaffModule::$PANEL_PERMISSION);

define('PAGE', 'panel');
define('PARENT_PAGE', 'staff');
define('PANEL_PAGE', 'staff');

$page_title = $staffLanguage->get('general', 'settings');
require_once(ROOT_PATH . '/core/templates/backend_init.php');

$breadcrumbs = [
	'dashboard' => [
		'name' => $staffLanguage->get('general', 'dashboard'),
		'link' => URL::build('/panel'),
	],
	'staff' => [
		'name' => $staffLanguage->get('general', 'title'),
	],
	'staffPageSettings' => [
		'name' => $staffLanguage->get('general', 'settings'),
		'link' => URL::build('/panel/staff'),
	],
];

require_once('utils/fields.php');

if (Input::exists()) {
	if (!Token::check(Input::get('token'))) {
		$smarty->assign('ERROR', $staffLanguage->get('general', 'errorToken'));
	} else {
		require_once('utils/validation.php');
		if (!$validation->passed()) {
			$smarty->assign('ERROR', $staffLanguage->get('general', 'errorEdit'));
		} else {
			foreach ($fields as $key => $value) {	
				$cache->setCache($value['cache']);
				$cache->store($value['name'], Input::get($value['name']));
			}
			$smarty->assign('SUCCESS', $staffLanguage->get('general', 'settingsUpdated'));
		}
	}
}

foreach ($fields as $key => $value) {
	$cache->setCache($value['cache']);
	if ($cache->isCached($value['name'])) {
		$fields[$key]['value'] = Output::getClean($cache->retrieve($value['name']));
	}
}

$smarty->assign([

	'PARENT_PAGE' => PARENT_PAGE,

	'TITLE' => $staffLanguage->get('general', 'title'),
	'PAGE_TITLE' => $page_title,

	'BREADCRUMBS' => $breadcrumbs,
    'FIELDS' => $fields,

	'SUCCESS_TITLE' => $staffLanguage->get('general', 'success'),
	'ERROR_TITLE' => $staffLanguage->get('general', 'error'),

	'SUBMIT' => $staffLanguage->get('general', 'submit'),
	'CANCEL' => $staffLanguage->get('general', 'cancel'),
	
	'TOKEN' => Token::get(),

]);

Module::loadPage($user, $pages, $cache, $smarty, [$navigation, $cc_nav, $mod_nav], $widgets);

$pageLoadTime = microtime(true) - $start;
define('PAGE_LOAD_TIME', str_replace('{x}', round($pageLoadTime, 3), $language->get('general', 'page_loaded_in')));

$template->onPageLoad();

require(ROOT_PATH . '/core/templates/panel_navbar.php');
$template->displayTemplate('staff/index.tpl', $smarty);