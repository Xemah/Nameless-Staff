<?php

/**
 *    STAFF PAGE MODULE
 *    By Xemah | https://xemah.com
 *
**/

require_once(ROOT_PATH . "/modules/Staff/classes/Staff.php");

define('PAGE', 'panel');
define('PARENT_PAGE', 'staff');
define('PANEL_PAGE', 'staff');

$page_title = Staff::getLanguage('general', 'settings');
$template_file = 'staff.tpl';
require_once(ROOT_PATH . '/core/templates/backend_init.php');

$smarty->assign([
    'SUBMIT' => $language->get('general', 'submit'),
    'YES' => $language->get('general', 'yes'),
    'NO' => $language->get('general', 'no'),
    'BACK' => $language->get('general', 'back'),
    'ARE_YOU_SURE' => $language->get('general', 'are_you_sure'),
    'CONFIRM_DELETE' => $language->get('general', 'confirm_delete'),
    'NAME' => $language->get('admin', 'name'),
    'INFO' => $language->get('general', 'info'),
    'ENABLED' => $language->get('admin', 'enabled'),
    'DISABLED' => $language->get('admin', 'disabled'),
    'DASHBOARD' => $language->get('admin', 'dashboard'),

    'STAFF_SETTINGS' => Staff::getLanguage('general', 'settings'),
    'SUCCESS_TITLE' => Staff::getLanguage('general', 'success'),
    'ERROR_TITLE' => Staff::getLanguage('general', 'error'),
    'PAGETITLE' => Staff::getLanguage('general', 'pageTitle'),
    'LINKPATH' => Staff::getLanguage('general', 'linkPath'),
    'LINKLOCATION' => Staff::getLanguage('general', 'linkLocation'),
    'NAVBAR' => Staff::getLanguage('general', 'navbar'),
    'NAVBARMOREDROPDOWN' => Staff::getLanguage('general', 'navbarMoreDropdown'),
    'FOOTER' => Staff::getLanguage('general', 'footer'),
    'NONE' => Staff::getLanguage('general', 'none'),
    'NAVICON' => Staff::getLanguage('general', 'navIcon'),
    'NAVORDER' => Staff::getLanguage('general', 'navOrder')
]);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!Token::check($_POST['token'])) {
        Session::flash('error', Staff::getLanguage('general', 'errorToken'));
        Redirect::to(URL::build('/panel/staff'));
    }

    $validation = Validate::check($_POST, [
        'pageTitle' => ['required' => true, 'max' => 64],
        'linkPath' => ['required' => true, 'min' => 3, 'max' => 32],
        'linkLocation' => ['required' => true],
        'navIcon' => ['max' => 64,],
    ]);
    
    if (!$validation->passed()) {
        Session::flash('error', Staff::getLanguage('general', 'errorEdit'));
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

    Session::flash('success', Staff::getLanguage('general', 'settingsUpdated'));
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
    'TOKEN' => Token::get(),
]);

Module::loadPage($user, $pages, $cache, $smarty, [$navigation, $cc_nav, $staffcp_nav], $widgets, $template);

$template->onPageLoad();

require(ROOT_PATH . '/core/templates/panel_navbar.php');

$template->displayTemplate($template_file, $smarty);