# WordPress Autoload

Simple autoloader that will autoload `class-$class.php` classes with namespace prefix.

# Install

```
$ composer require frozzare/wp-autoload
```

## Example

Example of your main php file.

```php
define('WP_AUTOLOAD_PREFIX', 'Digster\\');
define('WP_AUTOLOAD_BASE_DIR', __DIR__ . '/src');
require 'vendor/autoload.php';
```

Example of `src/class-plugin-loader.php`

```php
namespace Digster;
class Plugin_Loader {}
```

## Todo
- [ ] Autoload classes without namespace prefix

## License

MIT © [Fredrik Forsmo](https://github.com/frozzare)
