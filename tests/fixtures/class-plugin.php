<?php

namespace Hello;

use Hello\Extra\Length;

class Plugin implements Say {
	use Name;
	use Length;

	public function hello() {
		return 'Hello, world!';
	}
}
