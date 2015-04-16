<?php

// Will not proceed without `WP_AUTOLOAD_PREFIX` or `WP_AUTOLOAD_BASE_DIR`.
if ( ! defined( 'WP_AUTOLOAD_PREFIX' ) || ! defined( 'WP_AUTOLOAD_BASE_DIR' ) ) {
	return;
}

/**
 * Register the autoloader for the Digster plugin classes.
 *
 * The autoloader understands `class-$class.php` naming convention.
 *
 * @param string $class
 */

spl_autoload_register( function ( $class ) {
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

	// the autoloader understands `class-$class.php` naming convention.
	$parts = explode( '\\', $relative_class );
	$last  = array_pop( $parts );
	$last  = 'class-' . str_replace( '_', '-', $last );
	$parts[] = $last;
	$relative_class = implode( '\\', $parts );

	// replace the namespace prefix with the base directory, replace namespace
	// separators with directory separators in the relative class name, append
	// with .php
	$file = $base_dir . str_replace( '\\', '/', $relative_class ) . '.php';
	$file = strtolower( $file );

	// if the file exists, require it
	if ( file_exists( $file ) ) {
		require $file;
	}
} );
