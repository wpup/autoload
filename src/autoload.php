<?php

if ( ! function_exists( 'register_wp_autoload' ) ) {

	/**
	 * Register the autoloader.
	 *
	 * The autoloader understands WordPress file naming convention.
	 *
	 * @param string $prefix
	 * @param string $base_dir
	 */
	function register_wp_autoload( $prefix, $base_dir ) {
		if ( empty( $prefix ) || empty( $base_dir ) ) {
			return;
		}

		spl_autoload_register( function ( $class ) use( $prefix, $base_dir ) {
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
			$relative_class = str_replace( '_', '-', $relative_class );
			$files = [];

			foreach ( ['interface-', 'class-', 'trait-', ''] as $type ) {
				$parts = explode( '\\', $relative_class );
				$last  = array_pop( $parts );
				$last  = $type . str_replace( '_', '-', $last );
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
	}

}
