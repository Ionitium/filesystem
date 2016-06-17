# getBasename

Get basename of the path

## Description

```php
getBasename($path)
```

Return basename of filepath

## Parameters

__path__
: Filename path

## Return values

__string__
: Returns result of basename from filepath

__Exception__
: Returns Exception when is not a string filepath

## Examples

Example #1 Example
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$basename = $filesystem->getBasename('/var/www/');
echo $basename;
}
```

Result:

```php
string ("www")
```

Other samples:

```php
/var/www/lorem.php > lorem.php
http://local.localhost.tld/test > test
http://local.localhost.tld/test/abc > abc
'' > ''
'/var/../var1' > 'var1'
```

## Notes

_No notes._

## See also

_No documentation._
