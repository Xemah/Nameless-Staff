<?php

/**
 *	STAFF PAGE MODULE
 *	By Xemah | https://xemah.com
 *
**/

define('PAGE', 'staff');

$page_title = 'Staff';
require_once(ROOT_PATH . '/core/templates/frontend_init.php');

$groups = $queries->orderWhere('groups', 'staff = 1', '`order`');

foreach ($groups as $key => $group) {

	$staff_groups[$key] = array(
		'id' => $group->id,
		'name' => $group->name,
		'style' => $group->group_username_css,
	);

	$members = $queries->getWhere('users', array('group_id', '=', $group->id));
	foreach ($members as $member) {
		$staff_groups[$key]['members'][] = array(
			'id' => $member->id,
			'profile' => URL::build('/profile/' . Output::getClean($member->username)),
			'style' => $group->group_username_css,
			'username' => $member->username,
			'nickname' => $member->nickname,
			'avatar' => $user->getAvatar($member->id),
			'title' => Output::getClean($member->user_title)
		);
	}
}

$smarty->assign('STAFF_GROUPS', $staff_groups);

Module::loadPage($user, $pages, $cache, $smarty, array($navigation, $cc_nav, $mod_nav), $widgets);

$page_load = microtime(true) - $start;
define('PAGE_LOAD_TIME', str_replace('{x}', round($page_load, 3), $language->get('general', 'page_loaded_in')));

$template->onPageLoad();

require(ROOT_PATH . '/core/templates/navbar.php');
require(ROOT_PATH . '/core/templates/footer.php');

$template->displayTemplate('staff.tpl', $smarty);