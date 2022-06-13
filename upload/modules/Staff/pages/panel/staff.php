<?php

/**
 *	STAFF PAGE MODULE
 *	By Xemah | https://xemah.com
 *
**/

define('PAGE', 'panel');
define('PARENT_PAGE', 'staff');
define('PANEL_PAGE', 'staff');

$page_title = StaffModule::getLanguage('general', 'settings');
require_once(ROOT_PATH . '/core/templates/backend_init.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	if (!Token::check($_POST['token'])) {
		Session::flash('error', StaffModule::getLanguage('general', 'errorToken'));
		Redirect::to(URL::build('/panel/staff'));
	}

	$validation = Validate::check($_POST, [
		'pageTitle' => ['required' => true, 'max' => 64],
		'linkPath' => ['required' => true, 'min' => 3, 'max' => 32],
		'linkLocation' => ['required' => true],
		'navIcon' => ['max' => 64,],
	]);
	
	if (!$validation->passed()) {
		Session::flash('error', StaffModule::getLanguage('general', 'errorEdit'));
		Redirect::to(URL::build('/panel/staff'));
	}

	$cache->setCache(StaffModule::$CACHE);

	$pageTitleInput = $_POST['pageTitle'];
	$cache->store('pageTitle', isset($pageTitleInput) ? $pageTitleInput : 'Staff');

	$linkPathInput = $_POST['linkPath'];
	$cache->store('linkPath', isset($linkPathInput) ? $linkPathInput : '/staff');

	$linkLocationInput = $_POST['linkLocation'];
	$cache->store('linkLocation', isset($linkLocationInput) ? $linkLocationInput : '1');

	$cache->setCache('navbar_icons');
	$navIconInput = $_POST['navIcon'];
	$cache->store('staff_icon', isset($navIconInput) ? $navIconInput : '<i class="icon fas fa-users fa-fw"></i>');

	$cache->setCache('navbar_order');
	$navOrderInput = $_POST['navOrder'];
	$cache->store('staff_order', isset($navOrderInput) ? $navOrderInput : '99');

	Session::flash('success', StaffModule::getLanguage('general', 'settingsUpdated'));
	Redirect::to(URL::build('/panel/staff'));

}

$settings = StaffModule::getSettings($cache);

if (Session::exists('success')) {
	$smarty->assign('SUCCESS', Session::flash('success'));
}

if (Session::exists('error')) {
	$smarty->assign('ERROR', Session::flash('error'));
}

$smarty->assign([
	'PAGE_TITLE' => $page_title,
	'SETTINGS' => $settings,
	'STAFF_LANGUAGE' => StaffModule::getLanguage(),
	'TOKEN' => Token::get(),
]);

Module::loadPage($user, $pages, $cache, $smarty, [$navigation, $cc_nav, $staffcp_nav], $widgets, $template);

$template->onPageLoad();
require(ROOT_PATH . '/core/templates/panel_navbar.php');

array_push($smarty->security_policy->secure_dir, __DIR__);

try {
	$template->displayTemplate('staff.tpl', $smarty);
} catch (Exception $e) {
	$template->displayTemplate(__DIR__ . '/staff.tpl', $smarty);
}