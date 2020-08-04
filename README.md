# WordPress Boilerplate Plugin

A basic boilerplate WordPress plugin, including activation and de-activation hooks, first run, update detection, admin menu and script loading callbacks.

## Installation

I recommend installing this library via Composer:

`composer require perry-rylance/wordpress-plugin-boilerplate`

## Usage

Extend from `PerryRylance\WordPress\Plugin` to use the plugin.

You must define the following methods, which are abstract in the base class:

- `getPluginSlug`
- `getPluginDirPath`

The following methods can be overridden as and where you need to do so:

- `onActivate` (Please remember to call the base method)
- `onDeactivate`
- `onFirstRun`
- `onUpdated($prevVersion)`
- `onTextDomain`
- `onAdminMenu`
- `onAdminEnqueueScripts`
- `onEnqueueScripts`

*It is recommended* that your plugin instantiates itself immediately (eg do not wait for `plugins_loaded` or `init`) so that activation and de-activation hooks work correctly.