# getPathInfo

Returns information about a file path

## Description

```php
getPathInfo($type = null)
```

Returns path name from extension of file.

## Parameters

__type__
: Filename path
: Default: `NULL`

## Return values

__array__
: Returns directory name, basename of file, filename and extension with multiple extension such as `.ext.ext`

__string__
: Returns a result if specified `type` parameter

__Exception__
: Returns Exception if type is not defined corretly as `dirname` or if type is not exists

## Examples

Example #1 Get an array of path info
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem('/var/www/');
$pathinfo = $filesystem->getPathInfo();
print_r($pathinfo);
}
```

Result:

```php
array(4) {
  ["dirname"]=>
  string(28) "/tmp/__construct_21605828463"
  ["basename"]=>
  string(11) "91304997506"
  ["filename"]=>
  string(11) "91304997506"
  ["extensionall"]=>
  string(0) ""
}
```

Example #2 Get a specified key name example `dirname`
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem('/var/www/');
$pathinfo = $filesystem->getPathInfo('dirname');
print_r($pathinfo);
}
```

Result:

```php
string(28) "/tmp/__construct_21605828463"
```

## Notes

_No notes._

## See also

_No documentation._
