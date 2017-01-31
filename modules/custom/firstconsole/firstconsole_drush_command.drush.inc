<?php

/**
 * Implements hook_drush_command().
 */
function firstconsole_drush_command_drush_command() {
	$items =array();
	$items['hello-world'] =[
		'description' => 'Hello-world',
		'arguments' => [
			'name'=> 'Hello-world',
		],
		'aliases' => ['hr'],
	];
  return $items;
}

function drush_firstconsole_drush_command_hello_world(){
	
	echo "HelloWor5ld";

}