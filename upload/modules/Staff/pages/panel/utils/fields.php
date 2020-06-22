<?php

/**
 *	STAFF PAGE MODULE
 *	By Xemah | https://xemah.com
 *
**/

$fields = [

	'pageTitle' => [
		'label' => $staffLanguage->get('general', 'pageTitle'),
		'type' => 'textbox',
		'name' => 'page_title',
		'id' => 'pageTitle',
		'cache' => 'staff_module',
	],

	'linkPath' => [
		'label' => $staffLanguage->get('general', 'linkPath'),
		'type' => 'textbox',
		'name' => 'link_path',
		'id' => 'linkPath',
		'cache' => 'staff_module',
	],

	'linkLocation' => [
		'label' => $staffLanguage->get('general', 'linkLocation'),
		'type' => 'select',
		'name' => 'link_location',
		'id' => 'linkLocation',
		'cache' => 'staff_module',
		'options' => [
			'navbar' => [
				'label' => $staffLanguage->get('general', 'navbar'),
				'id' => 'navbar',
				'value' => '1',
			],
			'navbarMoreDropdown' => [
				'label' => $staffLanguage->get('general', 'navbarMoreDropdown'),
				'id' => 'navbarMoreDropdown',
				'value' => '2',
			],
			'footer' => [
				'label' => $staffLanguage->get('general', 'footer'),
				'id' => 'footer',
				'value' => '3',
			],
			'none' => [
				'label' => $staffLanguage->get('general', 'none'),
				'id' => 'none',
				'value' => '0',
			],
		],
	],

	'navigationIcon' => [
		'label' => $staffLanguage->get('general', 'navigationIcon'),
		'type' => 'textbox',
		'name' => 'staff_icon',
		'id' => 'navigationIcon',
		'cache' => 'navbar_icon',
	],

	'navigationOrder' => [
		'label' => $staffLanguage->get('general', 'navigationOrder'),
		'type' => 'textbox',
		'name' => 'staff_order',
		'id' => 'navigationOrder',
		'cache' => 'navbar_order',
	],

];