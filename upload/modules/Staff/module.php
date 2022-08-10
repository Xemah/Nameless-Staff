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

	private static Language $_language;

	public function __construct($pages, $cache)
	{
		$module = [
			'name' => 'Staff',
			'author' => '<a href="https://xemah.com" target="_blank">Xemah</a>',
			'version' => '2.11',
			'namelessVersion' => '2.0.1'
		];

		parent::__construct($this, $module['name'], $module['author'], $module['version'], $module['namelessVersion']);

		$settings = $this->getSettings($cache);

		$pages->add($module['name'], '/panel/staff', 'pages/panel/staff.php');
		$pages->add($module['name'], $settings['linkPath'], 'pages/staff.php', 'staff', true);
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
			$group = DB::getInstance()->get('groups', ['id', '=', 2])->first();
			$groupPermissions = json_decode($group->permissions, TRUE);
			$groupPermissions['administrator'] = 1;
			$groupPermissions = json_encode($groupPermissions);
			DB::getInstance()->update('groups', ['id', '=', 2], ['permissions' => $groupPermissions]);
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
			self::$PANEL_PERMISSION => self::getLanguage('general', 'permission'),
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
				$navs[2]->add('staff_divider', strtoupper(self::getLanguage('general', 'title')), 'divider', 'top', null, 100, '');
				$navs[2]->add('staff', self::getLanguage('general', 'settings'), URL::build('/panel/staff'), 'top', null, 100.1, '<i class="fa-solid fa-sliders"></i>');
			}

		}
	}

	public static function getLanguage(string $file = null, string $term = null, array $variables = [])
	{
		if (!isset(self::$_language)) {
			self::$_language = new Language(__DIR__ . '/language');
		}

		if (!$file && !$term) {
			$language = file_get_contents(__DIR__ . '/language/' . self::$_language->getActiveLanguage() . '.json');
			if (!$language) $language = file_get_contents(__DIR__ . '/language/en_UK.json');
			$language = json_decode($language, true);

			$languageArr = [];
			foreach ($language as $key => $value) {
				$term = explode('/', $key)[1];
				$languageArr[$term] = $value;
			}

			return $languageArr;
		}
		
		return self::$_language->get($file, $term, $variables);
	}

	public static function getSettings($cache)
	{
		$settings = [
			'pageTitle' => 'Staff',
			'linkPath' => '/staff',
			'linkLocation' => '1',
			'navIcon' => Output::getClean('<i class="icon fas fa-users fa-fw"></i>'),
			'navOrder' => '99'
		];

		foreach (array_keys($settings) as $key) {
			$cache->setCache(self::$CACHE);
			if ($key === 'navIcon') {
				$cache->setCache('navbar_icons');
				if ($cache->isCached('staff_icon')) {
					$settings[$key] = Output::getClean($cache->retrieve('staff_icon'));
				}
			} else if ($key === 'navOrder') {
				$cache->setCache('navbar_order');
				if ($cache->isCached('staff_order')) {
					$settings[$key] = Output::getClean($cache->retrieve('staff_order'));
				}
			} else {
				if ($cache->isCached($key)) {
					$value = $cache->retrieve($key);
					$arr = json_decode($value);
					$settings[$key] = $arr ? $arr : Output::getClean($value);
				}
			}
		}

		return $settings;
	}

	public function getDebugInfo(): array
	{
		return [];
	}
}
