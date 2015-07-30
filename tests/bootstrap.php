<?php

// Load Composer autoload.
require __DIR__ . '/../vendor/autoload.php';

// Register Hello with the autoload.
register_wp_autoload( 'Hello\\', __DIR__ . '/fixtures' );
