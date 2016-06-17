# getStatRaw

Gives information about a file

## Description

```php
getStatRaw($findkey = '')
```

Stat from regular file (stat()) and symbolic link (lstat())

## Parameters

__findkey__
: Find a key from stat value as 'dev'

## Return values

__array__
: Returns arrays from stat
> Returns arrays:
  * `dev` - Device number
  * `ino` - Inode number
  * `mode` - Unix permission mode, protection mode
  * `nlink` - Node link, number of hard link
  * `uid` - User ID of owner
  * `gid` - Group ID of owner
  * `rdev` - Device type ("/dev/tty", "/dev/sda")
  * `size` - Total size in bytes
  * `atime` - Time of last access
  * `mtime` - Time of modification
  * `ctime` - Time of last status change
  * `blksize` - blocksize for filesystem I/O
  * `blocks` - number of 512B blocks allocated

__string__
: Returns if used by `findkey` variable

## Examples

Example #1 Get all stat data
```php
use Ionitium\Filesystem\FilesystemInfo;

$stat = new FilesystemInfo('/tmp/source');
$statraw = $stat->getStatRaw();
print_r($statraw);
```

Example result:

```php
array(26) {
  [0]=>
  int(2049)  // dev
  [1]=>
  int(1064114)  // ino
  [2]=>
  int(33204)  // mode
  [3]=>
  int(1)  // nlink
  [4]=>
  int(1000)  // uid
  [5]=>
  int(1000)  // gid
  [6]=>
  int(0)  // rdev
  [7]=>
  int(0)  // size
  [8]=>
  int(1466169603)  // atime
  [9]=>
  int(1466169603)  // mtime
  [10]=>
  int(1466169603)  // ctime
  [11]=>
  int(4096)  // blksize
  [12]=>
  int(0)  // blocks
  ["dev"]=>
  int(2049)
  ["ino"]=>
  int(1064114)
  ["mode"]=>
  int(33204)
  ["nlink"]=>
  int(1)
  ["uid"]=>
  int(1000)
  ["gid"]=>
  int(1000)
  ["rdev"]=>
  int(0)
  ["size"]=>
  int(0)
  ["atime"]=>
  int(1466169603)
  ["mtime"]=>
  int(1466169603)
  ["ctime"]=>
  int(1466169603)
  ["blksize"]=>
  int(4096)
  ["blocks"]=>
  int(0)
}
```

Example #2 Get device number
```php
use Ionitium\Filesystem\FilesystemInfo;

$stat = new FilesystemInfo('/tmp/source');
echo $stat->getStatRaw('dev');
```

Result:

```php
(int)2049
```

## Notes

> Response affects on link using `lstat()` or `stat()` for regular files and folder.

## See also

_No documentation._