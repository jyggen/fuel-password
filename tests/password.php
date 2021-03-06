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

namespace Password;

class Test_Password extends \PHPUnit_Framework_TestCase
{

	protected static $hashes = array(
		// Strong hash generated with Blowfish prefix $2y$ (PHP 5.3.7 or above).
		'mode_2y' => array(
			'password' => 'supermegafoxyawesomehot',
			'hash'     => '$2y$08$2BBmzqkrYEpfO9diDGOjz.2Bs6RXasUwROwWzWxdUnRGmRbw2fJxi',
		),
		// Strong hash generated with Blowfish prefix $2a$ (below PHP 5.3.7).
		'mode_2a' => array(
			'password' => 'supermegafoxyawesomehot',
			'hash'     => '$2a$08$584rvuMJmE1UPjMDZTK1SORFWx7SDrjyGK7DrZz4gA6RbwTYqWcxe',
		),
		// Weak portable hash.
		'portable'  => array(
			'password' => 'supermegafoxyawesomehot',
			'hash'     => '$P$7p1yBN5udHObwMmnSOW4y003UiuBRG1',
		),
		// Strong hash generated by PHPass 0.3.
		'phpass_strong' => array(
			'password' => 'test12345',
			'hash'     => '$2a$08$2GFE.xb9jCcLPsjCeXOF9uO8zGzDpbCYEiPd.Wd9DO5xlBfZjBGbu',
		),

		// Portable hash generated by PHPass 0.3.
		'phpass_portable' => array(
			'password' => 'test12345',
			'hash'     => '$P$9IQRaTwmfeRo7ud9Fh4E2PdI0S3r.L0',
		),
	);

	// Test stronger but system-specific hash.
	public function test_strong()
	{

		$password = new Password();
		$correct  = 'supermegafoxyawesomehot';
		$hash     = $password->hash($correct);
		$check    = $password->check($correct, $hash);

		$this->assertTrue($check);

		$wrong = 'thisisobviouslywrong';
		$check = $password->check($wrong, $hash);

		$this->assertFalse($check);

	}

	// Test weaker portable hash.
	public function test_portable()
	{

		$password = new Password(5, true);
		$correct  = 'supermegafoxyawesomehot';
		$hash     = $password->hash($correct);
		$check    = $password->check($correct, $hash);

		$this->assertTrue($check);

		$wrong = 'thisisobviouslywrong';
		$check = $password->check($wrong, $hash);

		$this->assertFalse($check);

	}

	// Ensure that we're still PHPass compatible.
	public function test_predefined()
	{

		$password = new Password();

		foreach(static::$hashes as $key => $row)
		{
			if($key !== "mode_2y" or version_compare(PHP_VERSION, '5.3.7') >= 0)
			{
				$this->assertTrue($password->check($row['password'], $row['hash']));
			}
		}


	}

}
