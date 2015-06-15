<?php

/**
 * Register the autoloader.
 *
 * The autoloader understands `class-$class.php` naming convention.
 *
 * @param string $class
 */

spl_autoload_register( function ( $class ) {
	// Will not proceed without `WP_AUTOLOAD_PREFIX` or `WP_AUTOLOAD_BASE_DIR`.
	if ( ! defined( 'WP_AUTOLOAD_PREFIX' ) || ! defined( 'WP_AUTOLOAD_BASE_DIR' ) ) {
		return;
	}

	// project-specific namespace prefix
	$prefix = WP_AUTOLOAD_PREFIX;

	// base directory for the namespace prefix
	$base_dir = WP_AUTOLOAD_BASE_DIR;
	$base_len = strlen( $base_dir ) - 1;

	if ( $base_dir[$base_len] !== '/' ) {
		$base_dir .= '/';
	}

	// does the class use the namespace prefix?
	$len = strlen( $prefix );

	if ( 0 !== strncmp( $prefix, $class, $len ) ) {
		// no, move to the next registered autoloader
		return;
	}

	// get the relative class name
	$relative_class = substr( $class, $len );

	$files = [];

	// the autoloader understands `class-$class.php` and `trait-$trait.php`.
	foreach ( ['class', 'trait', ''] as $type ) {
		$parts = explode( '\\', $relative_class );
		$last  = array_pop( $parts );
		$last  = $type . '-' . str_replace( '_', '-', $last );
		$parts[] = $last;
		$files[] = implode( '\\', $parts );
	}

	foreach ( $files as $file ) {
		// replace the namespace prefix with the base directory, replace namespace
		// separators with directory separators in the relative class name, append
		// with .php
		$file = $base_dir . str_replace( '\\', '/', $file ) . '.php';
		$file = strtolower( $file );

		// if the file exists, require it
		if ( file_exists( $file ) ) {
			require_once $file;
			break;
		}
	}
} );
