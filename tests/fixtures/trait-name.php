<?php

namespace Hello;

trait Name {
	public function hello_name( $name ) {
		return sprintf( 'Hello, %s!', $name );
	}
}
