# WordPress Autoload

Simple PHP autoloader that will autoload `class-$class.php` classes with namespace prefix.

# Install

```
$ composer require frozzare/wp-autoload
```

## Example

```php
define('WP_AUTOLOAD_PREFIX', 'Digster\\');
define('WP_AUTOLOAD_BASE_DIR', __DIR__ . '/src');
require 'vendor/frozzare/wp-autoload/autoload.php';
```

## License

MIT © [Fredrik Forsmo](https://github.com/frozzare)
