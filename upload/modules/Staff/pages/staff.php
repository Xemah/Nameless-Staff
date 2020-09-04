<?php

/**
 *	STAFF PAGE MODULE
 *	By Xemah | https://xemah.com
 *
**/

define('PAGE', 'staff');

$page_title = $cache->setCache('staff_module')->retrieve('page_title');
require_once(ROOT_PATH . '/core/templates/frontend_init.php');

$staffGroupsQuery = $queries->orderWhere('groups', 'staff = 1', '`order`');

$staffGroups = [];
foreach ($staffGroupsQuery as $key => $group) {

	$staffGroups[$key] = [
		'id' => $group->id,
		'name' => $group->name,
		'style' => $group->group_username_css,
	];

	$groupMembersQuery = $queries->getWhere('users', ['group_id', '=', $group->id]);
	foreach ($groupMembersQuery as $member) {
		$staffGroups[$key]['members'][] = [
			'id' => $member->id,
			'avatar' => $user->getAvatar($member->id),
			'profile' => URL::build('/profile/' . Output::getClean($member->username)),
			'username' => $member->username,
			'nickname' => $member->nickname,
			'style' => $group->group_username_css,
			'title' => Output::getClean($member->user_title),
		];
	}
	
}

$smarty->assign([
	'TITLE' => $page_title,
	'STAFF_GROUPS' => $staffGroups
]);

Module::loadPage($user, $pages, $cache, $smarty, [$navigation, $cc_nav, $mod_nav], $widgets);

$pageLoadTime = microtime(true) - $start;
define('PAGE_LOAD_TIME', str_replace('{x}', round($pageLoadTime, 3), $language->get('general', 'page_loaded_in')));

$template->onPageLoad();

$smarty->assign('WIDGETS', $widgets->getWidgets());

require(ROOT_PATH . '/core/templates/navbar.php');
require(ROOT_PATH . '/core/templates/footer.php');

$template->displayTemplate('staff.tpl', $smarty);
