<?php

/**
 *	STAFF PAGE MODULE
 *	By Xemah | https://xemah.com
 *
**/

$validate = new Validate();

$validation = $validate->check($_POST, [

	$fields['pageTitle']['name'] => [
		'required' => true,
		'max' => 64,
	],

	$fields['linkPath']['name'] => [
		'required' => true,
		'min' => 3,
		'max' => 32,
	],

	$fields['linkLocation']['name'] => [
		'required' => true,
	],

	$fields['navbarIcon']['name'] => [
		'max' => 64,
	],
	
]);