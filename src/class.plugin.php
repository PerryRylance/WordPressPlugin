<?php

namespace PerryRylance\WordPress;

abstract class Plugin
{
	private $cachedVersion;

	public function __construct()
	{
		$dir	= $this->getPluginDirPath();
		$slug	= $this->getPluginSlug();
		$path	= $dir . $slug . ".php";
		
		$option_name = $slug . "-version";
		$db_version = get_option($option_name);
		
		if(empty($db_version))
			update_option($option_name, $this->getVersion());
		else if(version_compare($this->getVersion(), $db_version, '>'))
		{
			$this->onUpdated($db_version);
			update_option($option_name, $this->getVersion());
		}
		
		register_activation_hook($path, array($this, "onActivate"));
		register_deactivation_hook($path, array($this, "onDeactivate"));
		
		load_plugin_textdomain($this->getPluginSlug(), false, $this->getPluginDirPath() . 'languages/');
		
		add_action('admin_menu', array($this, "onAdminMenu"));
		
		add_action('admin_enqueue_scripts', array($this, "onAdminEnqueueScripts"));
		add_action('wp_enqueue_scripts', array($this, "onEnqueueScripts"));
	}
	
	abstract public function getPluginSlug();
	abstract public function getPluginDirPath();
	
	final public function getVersion()
	{
		if(empty($this->cachedVersion))
		{
			$dir	= $this->getPluginDirPath();
			$path	= $dir . $this->getPluginSlug() . ".php";
			
			$subject = file_get_contents($path);
			if(preg_match('/Version:\s*(.+)/', $subject, $m))
				$this->cachedVersion = trim($m[1]);
		}
		
		return $this->cachedVersion;
	}
	
	public function onActivate()
	{
		$slug			= $this->getPluginSlug();
		$option_name	= "$slug-first-run";
		
		if(!get_option($option_name))
		{
			$this->onFirstRun();
			update_option($option_name, date(\DateTime::ISO8601));
		}
	}
	
	public function onDeactivate()
	{
		
	}
	
	public function onFirstRun()
	{
		
	}
	
	public function onUpdated($prevVersion)
	{
		
	}
	
	public function onTextDomain()
	{
		load_plugin_textdomain(
			$this->getPluginSlug(),
			false,
			$this->getPluginDirPath() . '/languages'
		);
	}
	
	public function onAdminMenu()
	{
		
	}
	
	public function onAdminEnqueueScripts()
	{
		
	}
	
	public function onEnqueueScripts()
	{
		
	}
}