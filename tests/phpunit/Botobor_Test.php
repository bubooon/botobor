<?php
require_once dirname(__FILE__) . '/bootstrap.php';
require_once SRC_ROOT . '/botobor.php';

class Botobor_Test extends PHPUnit_Framework_TestCase
{
	/**
	 * @covers Botobor::getSecret
	 * @covers Botobor::setSecret
	 */
	public function test_secrets()
	{
		$this->assertEquals(filemtime(SRC_ROOT . '/botobor.php'), Botobor::getSecret());

		$secret = 'My secret';
		Botobor::setSecret($secret);
		$this->assertEquals($secret, Botobor::getSecret());
	}
	//-----------------------------------------------------------------------------

	/**
	 * @covers Botobor::getDefault
	 * @covers Botobor::setDefault
	 */
	public function test_defaults()
	{
		Botobor::setDefault('delay', 10);
		$this->assertEquals(10, Botobor::getDefault('delay'));
	}
	//-----------------------------------------------------------------------------

	/**
	 * @covers Botobor::getChecks
	 * @covers Botobor::setCheck
	 */
	public function test_checks()
	{
		$checks = Botobor::getChecks();
		$this->assertInternalType('array', $checks);
		$this->assertNotEmpty($checks);
		reset($checks);
		$check = key($checks);
		$state = $checks[$check];
		Botobor::setCheck($check, !$state);
		$checks = Botobor::getChecks();
		$this->assertNotEquals($state, $checks[$check]);
	}
	//-----------------------------------------------------------------------------

	/* */
}