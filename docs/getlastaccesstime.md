# getLastAccessTime

Get last access time of file

## Description

```php
getLastAccessTime($file)
```

Returns unix timestamp of file access time. Returns `stat` information from __posix__.

## Parameters

__file__
: A filename source

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
$filesystem->getLastAccessTime('/tmp/myfile');
```

Result:
```php
int(1466085246)
```

## Notes

_No notes._

## See also

_No notes._
