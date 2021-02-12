<?php

/**
 *	STAFF PAGE MODULE
 *	By Xemah | https://xemah.com
 *
**/

class StaffModule extends Module
{
	public static $CACHE = 'staff_module';

	public static $PANEL_PERMISSION = 'staff.settings';

	public function __construct($staffLanguage, $pages, $queries, $cache)
	{
		$module = [
			'name' => 'Staff',
			'author' => '<a href="https://xemah.com" target="_blank">Xemah</a>',
			'version' => '2.3',
			'namelessVersion' => '2.0.0-pr9'
		];

		parent::__construct($this, $module['name'], $module['author'], $module['version'], $module['namelessVersion']);

		$settings = $this->getSettings($cache);

		$pages->add($module['name'], '/panel/staff', 'pages/panel/staff.php');
		$pages->add($module['name'], $settings['linkPath'], 'pages/staff.php', 'staff', true);

		$this->staffLanguage = $staffLanguage;
		$this->queries = $queries;
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
		try {
			$this->queries->addPermissionGroup(2, self::$PANEL_PERMISSION);
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
			self::$PANEL_PERMISSION => $this->staffLanguage->get('general', 'permission'),
		]);

		$settings = self::getSettings($cache);
		
		switch ($settings['linkLocation']) {
			case 1:
				$navs[0]->add('staff', $settings['pageTitle'], URL::build($settings['linkPath']), 'top', null, $settings['navOrder'], Output::getDecoded($settings['navIcon']));
				break;
			case 2:
				$navs[0]->addItemToDropdown('more_dropdown', 'staff', $settings['pageTitle'], URL::build($settings['linkPath']), 'top', null, Output::getDecoded($settings['navIcon']), $settings['navOrder']);
				break;
			case 3:
				$navs[0]->add('staff', $settings['pageTitle'], URL::build($settings['linkPath']), 'footer', null, $settings['navOrder'], Output::getDecoded($settings['navIcon']));
				break;
		}

		if (defined('BACK_END')) {
			
			if ($user->hasPermission(self::$PANEL_PERMISSION)) {
				$navs[2]->add('staff_divider', strtoupper($this->staffLanguage->get('general', 'title')), 'divider', 'top', null, 100, '');
				$navs[2]->add('staff', $this->staffLanguage->get('general', 'settings'), URL::build('/panel/staff'), 'top', null, 100.1, '<i class="nav-icon fas fa-sliders-h fa-fw"></i>');
			}

		}
	}

	public static function getSettings($cache)
	{
		$settings = [
			'pageTitle' => 'Staff',
			'linkPath' => '/staff',
			'linkLocation' => '1',
			'navIcon' => '99',
			'navOrder' => '<i class="icon fas fa-users fa-fw"></i>'
		];

		foreach (array_keys($settings) as $key) {
			$cache->setCache(self::$CACHE);
			if ($key === 'navIcon') {
				$cache->setCache('navbar_icons');
				if ($cache->isCached('staff_icon')) {
					$settings[$key] = $cache->retrieve('staff_icon');
				}
			} else if ($key === 'navOrder') {
				$cache->setCache('navbar_order');
				if ($cache->isCached('staff_order')) {
					$settings[$key] = $cache->retrieve('staff_order');
				}
			} else {
				if ($cache->isCached($key)) {
					$value = $cache->retrieve($key);
					$arr = json_decode($value);
					$settings[$key] = $arr ? $arr : $value;
				}
			}
		}

		return $settings;
	}
}