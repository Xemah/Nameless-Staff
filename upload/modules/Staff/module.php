<?php

/**
 *	STAFF PAGE MODULE
 *	By Xemah | https://xemah.com
 *
**/

class StaffModule extends Module
{
	public static $PANEL_PERMISSION = 'staff.settings';

	public function __construct($language, $staffLanguage, $user, $pages, $navigation, $queries, $smarty, $cache)
	{
		$module = [
			'name' => 'Staff',
			'author' => '<a href="https://xemah.com" target="_blank">Xemah</a>',
			'version' => '2.1',
			'namelessVersion' => '2.0.0-pr8'
		];

		parent::__construct($this, $module['name'], $module['author'], $module['version'], $module['namelessVersion']);

		$cache->setCache('staff_module');
		if ($cache->isCached('link_path')) {
			$pages->add($module['name'], $cache->retrieve('link_path'), 'pages/staff.php', 'staff', true);
		}

		$pages->add($module['name'], '/panel/staff', 'pages/panel/staff.php');

		$this->_language = $language;
		$this->_staffLanguage = $staffLanguage;
		$this->_queries = $queries;
		$this->_cache = $cache;
	}

	public function onInstall()
	{
		// ...
	}

	public function onUninstall()
	{
		// ...
	}

	public function onEnable()
	{
		$this->_cache->setCache('staff_module');

		if (!$this->_cache->isCached('page_title')) {
			$this->_cache->store('page_title', 'Staff');
		}

		if (!$this->_cache->isCached('link_path')) {
			$this->_cache->store('link_path', '/staff');
		}
		
		if (!$this->_cache->isCached('link_location')) {
			$this->_cache->store('link_location', 1);
		}

		$this->_cache->setCache('navbar_order');
		
		if (!$this->_cache->isCached('staff_order')) {
			$this->_cache->store('staff_order', 100);
		}

		$this->_cache->setCache('navbar_icons');

		if (!$this->_cache->isCached('staff_icon')) {
			$this->_cache->store('staff_icon', '<i class="icon fas fa-users fa-fw"></i>');
		}
		
		$this->_cache->setCache('panel_sidebar');

		if (!$this->_cache->isCached('staff_order')) {
			$this->_cache->store('staff_order', 100);
		}

		if (!$this->_cache->isCached('staff_icon')) {
			$this->_cache->store('staff_icon', '<i class="nav-icon fas fa-sliders-h fa-fw"></i>');
		}

		try {

			$group = $this->_queries->getWhere('groups', ['id', '=', 2]);
			$group = $group[0];
			
			$groupPermissions = json_decode($group->permissions, true);
			$groupPermissions[self::$PANEL_PERMISSION] = 1;
			
			$groupPermissions = json_encode($groupPermissions);
			$this->_queries->update('groups', 2, ['permissions' => $groupPermissions]);

		} catch (Exception $e) {
			// ...
		}
	}

	public function onDisable()
	{
		// ...
	}

	public function onPageLoad($user, $pages, $cache, $smarty, $navs, $widgets, $template)
	{
		PermissionHandler::registerPermissions($this->getName(), [
			self::$PANEL_PERMISSION => $this->_staffLanguage->get('general', 'permission'),
		]);

		$cache->setCache('staff_module');
		$staffPageTitle = $cache->retrieve('page_title');
		$staffLinkPath = $cache->retrieve('link_path');
		$staffLinkLocation = $cache->retrieve('link_location');

		$cache->setCache('navbar_order');
		$staffNavigationOrder = $cache->retrieve('staff_order');

		$cache->setCache('navbar_icons');
		$staffNavigationIcon = $cache->retrieve('staff_icon');
		
		switch ($staffLinkLocation) {
			case 1:
				$navs[0]->add('staff', $staffPageTitle, URL::build($staffLinkPath), 'top', null, $staffNavigationOrder, $staffNavigationIcon);
				break;
			case 2:
				$navs[0]->addItemToDropdown('more_dropdown', 'staff', $staffPageTitle, URL::build($staffLinkPath), 'top', null, $staffNavigationIcon, $staffNavigationOrder);
				break;
			case 3:
				$navs[0]->add('staff', $staffPageTitle, URL::build($staffLinkPath), 'footer', null, $staffNavigationOrder, $staffNavigationIcon);
				break;
		}

		if (defined('BACK_END')) {
			
			if (!$user->hasPermission(self::$PANEL_PERMISSION)) {
				return;
			}
	
			$cache->setCache('panel_sidebar');
			$staffOrder = $cache->retrieve('staff_order');
			$staffIcon = $cache->retrieve('staff_icon');
			
			$navs[2]->add('staff_divider', strtoupper($this->_staffLanguage->get('general', 'title')), 'divider', 'top', null, $staffOrder, '');
			$navs[2]->add('staff', $this->_staffLanguage->get('general', 'settings'), URL::build('/panel/staff'), 'top', null, $staffOrder + 0.1, $staffIcon);

		}
	}
}