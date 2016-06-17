# getFileInode

Gets file inode

## Description

```php
getFileInode()
```

Returns inode number of file or folder. Compare is your current file with `getmyinode()` of current execution script.

## Parameters

_No parameter._

## Return values

__int__
: Returns unix timestamp of last file access

__Exception__
: Returns exception if file is not defined

## Examples

Example #1 Get file inode number
```php
use Ionitium\Filesystem\FilesystemInfo;

$result = new FilesystemInfo('/tmp/source');
echo $result->getFileInode();
echo getmyinode();
```

Result:

```php
int(1064114)
int(1064114)
```

## Notes

> Alternate is `stat["ino"]` from `stat` function.

## See also

_No notes._