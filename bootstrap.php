<?php
/**
 * Password: Portable PHP password hashing framework (PHPass) as a FuelPHP package.
 *
 * @package     Password
 * @version     1.0 (Based on PHPass 0.3)
 * @author      Jonas Stendahl
 * @license     MIT License
 * @copyright   2012 Jonas Stendahl
 * @link        https://github.com/jyggen/fuel-password
 */

Autoloader::add_core_namespace('Password');

Autoloader::add_classes(array(
	'Password\\Password' => __DIR__.DS.'classes'.DS.'password.php',
));
