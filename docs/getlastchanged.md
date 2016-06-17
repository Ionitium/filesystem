# getLastChanged

Gets inode change time of file, marks of last time

## Description

```php
getLastChanged($file)
```

Returns unix timestamp of last access timestamp. Affects on file permission changes.

## Parameters

_No parameter._

## Return values

__integer__
: Returns unix timestamp

__Exception__
: Exception if no file found

## Examples

Example #1 Get a last access time for a file
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$filesystem->getLastChanged('/tmp/myfile');
```

Result:
```php
int(1466085246)
```

## Notes

> Useful for javascript in query `?=time` changes. Use `getLastModification()` to get most suitable for changes in a files.

## See also

_No documentation._
