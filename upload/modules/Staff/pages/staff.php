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
		'name' => Output::getClean($group->name),
		'color' => $group->group_username_color,
		'members' => []
	];

	$groupMembersQuery = $queries->getWhere('users_groups', ['group_id', '=', $group->id]);
	foreach ($groupMembersQuery as $member) {
		$staffMember = new User($member->user_id);
		$staffGroups[$key]['members'][] = [
			'id' => $staffMember->data()->id,
			'uuid' => $staffMember->data()->uuid,
			'avatar' => $staffMember->getAvatar(),
			'profile' => $staffMember->getProfileURL(),
			'username' => $staffMember->getDisplayname(true),
			'nickname' => $staffMember->getDisplayname(),
			'style' => $staffMember->getGroupClass(),
			'title' => Output::getClean($staffMember->data()->user_title),
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

$smarty->assign('WIDGETS_LEFT', $widgets->getWidgets('left'));
$smarty->assign('WIDGETS_RIGHT', $widgets->getWidgets('right'));

require(ROOT_PATH . '/core/templates/navbar.php');
require(ROOT_PATH . '/core/templates/footer.php');

$template->displayTemplate('staff.tpl', $smarty);