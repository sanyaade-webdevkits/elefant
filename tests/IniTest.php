<?php

require_once ('lib/Autoloader.php');

class IniTest extends PHPUnit_Framework_TestCase {
	function test_parse () {
		$str = "one = two\nthree = four";

		$this->assertEquals (
			array ('one' => 'two', 'three' => 'four'),
			Ini::parse ($str)
		);

		$str = "[Section]\none = two\nthree = four";

		$this->assertEquals (
			array ('Section' => array ('one' => 'two', 'three' => 'four')),
			Ini::parse ($str, true)
		);
	}

	function test_write () {
		// write simple structure, with 24 char padding
		$data = array ('one' => 'two', 'three' => true);
		$ini = "; <?php /*\n\none                     = two\nthree                   = On\n\n; */ ?>";
		$this->assertEquals ($ini, Ini::write ($data));

		// write with sections
		$data = array ('Section' => array ('one' => 'http://www.foo.com/', 'two' => false));
		$ini = "; <?php /*\n\n[Section]\n\none                     = \"http://www.foo.com/\"\ntwo                     = Off\n\n; */ ?>";
		$this->assertEquals ($ini, Ini::write ($data));
	}
}

?>