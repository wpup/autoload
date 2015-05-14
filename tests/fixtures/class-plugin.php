<?php

namespace Hello;

use Hello\Extra\Length;

class Plugin {
	use Name;
	use Length;

	public function hello() {
		return 'Hello, world!';
	}
}
