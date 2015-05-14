<?php

define('WP_AUTOLOAD_PREFIX', 'Hello\\');
define('WP_AUTOLOAD_BASE_DIR', __DIR__ . '/fixtures');

require __DIR__ . '/../vendor/autoload.php';
