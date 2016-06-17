# getLastAccess

Gets last access time of file

## Description

```php
getLastAccess()
```

Returns unix timestamp when the file last access

## Parameters

_No parameter._

## Return values

__int__
: Returns unix timestamp of last file access

__Exception__
: Returns exception if file is not defined

## Examples

Example #1 Get unix timestamp of last access file
```php
use Ionitium\Filesystem\FilesystemInfo;

$stat = new FilesystemInfo('/tmp/source');
echo $stat->getLastAccess();
```

Result:

```php
int(1466169603)
```

## Notes

> Costly for very large files. Time resolution may differ filesystem. Uses `clearstatcache()` before execution to get correctly information.

## See also

_No notes._