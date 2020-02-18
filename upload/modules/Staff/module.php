<?php

/**
 *	STAFF PAGE MODULE
 *	By Xemah | https://xemah.com
 *
**/

class StaffModule extends Module {

	public function __construct($language, $pages, $user, $navigation, $queries, $smarty, $cache) {

		$module = array(
			'name' => 'Staff',
			'author' => '<a href="https://xemah.com" target="_blank">Xemah</a>',
			'version' => '1.0',
			'namelessVersion' => '2.0.0-pr7'
		);

		parent::__construct($this, $module['name'], $module['author'], $module['version'], $module['namelessVersion']);

        $pages->add($module['name'], '/staff', 'pages/staff.php', 'staff', true);

		$this->_queries = $queries;
		$this->_navigation = $navigation;
		$this->_cache = $cache;
		$this->_smarty = $smarty;
        
	}

	public function onInstall() {
		// ...
	}

	public function onUninstall() {
		// ...
	}

	public function onEnable() {
		// ...
	}

	public function onDisable() {
		// ...
	}

	public function onPageLoad($user, $pages, $cache, $smarty, $navs, $widgets, $template) {

		$queries = $this->_queries;

		if(!$cache->setCache('navbar_order')->isCached('staff_order'))
			$cache->store('staff_order', 99);
		$staff_order = $cache->setCache('navbar_order')->retrieve('staff_order');

		if(!$cache->setCache('navbar_icons')->isCached('staff_icon'))
			$cache->store('staff_icon', '');
		$staff_icon = $cache->setCache('navbar_icons')->retrieve('staff_icon');
		
        $navs[0]->add('staff', 'Staff', URL::build('/staff'), 'top', null, $staff_order, $staff_icon);
        
    }
    
}