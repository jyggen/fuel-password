# Password
Password is a port of [PHPass](http://www.openwall.com/phpass/) (Portable PHP password hashing framework) to work as a package for FuelPHP.

[![Build Status](https://secure.travis-ci.org/jyggen/fuel-password.png)](http://travis-ci.org/jyggen/fuel-password)

## Installation
1. Clone (`git clone git://github.com/jyggen/fuel-password`) or [Download the package](https://github.com/jyggen/fuel-password/zipball/master).
2. Password should be located in `./fuel/packages/`.
4. Add `password` to your config.php `always_loaded.packages` config option (or use `Fuel::add_package('password')` in your code).
5. Success!

## Usage
First you need to create a new Password object.

	$password = new Password();

 The password construct accepts two optional arguments. The first one is the iteration count used for password stretching and the second is whether the hash should be portable (MD5-based) or not. The default values are `8` and `false`.

	$password = new Password(12, true);

Next up you'd want to calculate the actual hash of your password, and you do it like this:

	$hash = $password->hash('supermegafoxyawesomehot');

To later check if a password is valid against a hash, use the following:

	if($password->check('supermegafoxyawesomehot', $hash))
	{
		// password match, your code here
	}

## Changes
I've done some changes to the original PHPass class. Here's a short list:

1. Renamed `CheckPassword()` and `HashPassword()` to `check()` and `hash()`.
2. Cleaned up the code to match FuelPHP's coding standards.
3. Removed some of PHPass' backward compatibility since FuelPHP requires PHP 5.3.
4. PHP 5.3.7 and above will now use Blowfish with the prefix "$2y$" to fix a
security weakness.
