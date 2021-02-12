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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	if (!Token::check($_POST['token'])) {
		Session::flash('error', $chatboxLanguage->get('general', 'errorToken'));
		Redirect::to(URL::build('/panel/staff'));
	}

	$validate = new Validate();
	$validation = $validate->check($_POST, [
		'pageTitle' => ['required' => true, 'max' => 64],
		'linkPath' => ['required' => true, 'min' => 3, 'max' => 32],
		'linkLocation' => ['required' => true],
		'navIcon' => ['max' => 64,],
	]);
	
	if (!$validation->passed()) {
		Session::flash('error', $staffLanguage->get('general', 'errorEdit'));
		Redirect::to(URL::build('/panel/staff'));
	}

	$cache->setCache(StaffModule::$CACHE);

	$pageTitleInput = $_POST['pageTitle'];
	$cache->store('pageTitle', isset($pageTitleInput) ? $pageTitleInput : 'Staff');

	$linkPathInput = $_POST['linkPath'];
	$cache->store('linkPath', isset($linkPathInput) ? $linkPathInput : '/staff');

	$linkLocationInput = $_POST['linkLocation'];
	$cache->store('linkLocation', isset($linkLocationInput) ? $linkLocationInput : '1');

	$cache->setCache('navbar_icon');
	$navIconInput = $_POST['navIcon'];
	$cache->store('staff_icon', isset($navIconInput) ? $navIconInput : '<i class="icon fas fa-users fa-fw"></i>');

	$cache->setCache('navbar_order');
	$navOrderInput = $_POST['navOrder'];
	$cache->store('staff_order', isset($navOrderInput) ? $navOrderInput : '99');

	Session::flash('success', $staffLanguage->get('general', 'settingsUpdated'));
	Redirect::to(URL::build('/panel/staff'));

}

$settings = StaffModule::getSettings($cache);

$_language = $language;
require($staffLanguage->getActiveLanguageDirectory() . '/general.php');
$staffLanguageArr = $language;
$language = $_language;

if (Session::exists('success')) {
	$smarty->assign('SUCCESS', Session::flash('success'));
}

if (Session::exists('error')) {
	$smarty->assign('ERROR', Session::flash('error'));
}

$smarty->assign([
	'PAGE_TITLE' => $page_title,
	'SETTINGS' => $settings,
	'STAFF_LANGUAGE' => $staffLanguageArr,
	'TOKEN' => Token::get(),
]);

Module::loadPage($user, $pages, $cache, $smarty, [$navigation, $cc_nav, $mod_nav], $widgets);

$pageLoadTime = microtime(true) - $start;
define('PAGE_LOAD_TIME', str_replace('{x}', round($pageLoadTime, 3), $language->get('general', 'page_loaded_in')));

$template->onPageLoad();
require(ROOT_PATH . '/core/templates/panel_navbar.php');

try {
	$template->displayTemplate('staff.tpl', $smarty);
} catch (Exception $e) {
	$template->displayTemplate(__DIR__ . '/staff.tpl', $smarty);
}