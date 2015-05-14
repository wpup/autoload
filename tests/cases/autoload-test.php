<?php

use Hello\Plugin as Hello_Plugin;

class Autoload_Test extends PHPUnit_Framework_TestCase {

	public function test_class_autoload() {
		$plugin = new Hello_Plugin();
		$this->assertEquals( 'Hello, world!', $plugin->hello() );

		$hello_name = $plugin->hello_name( 'Foo' );
		$this->assertEquals( 'Hello, Foo!', $hello_name );
		$this->assertEquals( 11, $plugin->strlen( $hello_name ) );
	}

}
