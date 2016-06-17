# getLastModification

Gets last modification time of file

## Description

```php
getLastModification()
```

Returns unix timestamp when the data blocks of a file were being written. Affects on changes inode and data.

## Parameters

_No parameter._

## Return values

__int__
: Returns unix timestamp of last modification

__Exception__
: Returns exception if file is not defined

## Examples

Example #1 Get unix timestamp of last modification file
```php
use Ionitium\Filesystem\FilesystemInfo;

$stat = new FilesystemInfo('/tmp/source');
echo $stat->getLastModification();
```

Result:

```php
int(1466169603)
```

## Notes

_No notes._

## See also

_No documentation._