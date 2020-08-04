<?php
/*
Plugin Name: Perry Rylance - WordPress Boilerplate Test
Description: This small plugin can be used to test that the boilerplate is working correctly. This file should not be included in a normal project.
Version: 1.0.0
*/

namespace PerryRylance\WordPress\BoilerplateTest;

require_once(__DIR__ . '/src/class.plugin.php');

class Plugin extends \PerryRylance\WordPress\Plugin
{
	public function __construct()
	{
		\PerryRylance\WordPress\Plugin::__construct();
	}
	
	public function getPluginSlug()
	{
		return "wordpress-plugin-boilerplate-test";
	}
	
	public function getPluginDirPath()
	{
		return plugin_dir_path(__FILE__);
	}
}

$plugin = new Plugin();
