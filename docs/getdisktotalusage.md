# getDiskTotalUsage

Returns the total usage of disk filesystem

## Description

```php
getDiskTotalUsage($humanSize = false, $decimals = 2, $array_print = false)
```

Return total number of bytes usage of filesystem

## Parameters

__humanSize__
: A size in a bytes, integer
: Default: `FALSE`

__decimals__
: Return a size in a decimal point
: Default: `2`

__array_print__
: Return as array instead string separated as value and filesize type
: Default: `false`

## Return values

__Exception__
: Return total number of bytes usage of filesystem

Returns a total size of filesystem in bytes or disk partition in `float()` type.

## Examples

Example #1 Get a total bytes usage of filesystem
```php
use Ionitium\Filesystem\FilesystemInfo;

$filesystem = new FilesystemInfo('/tmp/myfile');
echo $filesystem->getDiskTotalUsage();
);
```

Result:

```php
int(403198476288)
```

Example #2 Get a total usage of filesystem in human readable format
```php
use Ionitium\Filesystem\FilesystemInfo;

$filesystem = new FilesystemInfo('/tmp/myfile');
echo $filesystem->getDiskTotalUsage(true, 3);
```

Result:

```php
(string) "375.508 GiB"
```

Example #3 Get a total usage of filesystem into 3 decimals and separate data
```php
use Ionitium\Filesystem\FilesystemInfo;

$filesystem = new FilesystemInfo('/tmp/myfile');
print_r($filesystem->getDiskTotalUsage(true, 3, true));
```

Result:

```php
array(2) {
  [0]=>
  string(7) "375.508"
  [1]=>
  string(3) "GiB"
}
```

## Notes

> A result can irrelevant by different filesystem. A result substract total space of filesystem and free space of filesystem.

## See also

* [`getDiskFreeSpace()`](getdiskfreespace.md) - Returns available space on filesystem or disk partition
* [`getDiskTotalSpace()`](getdisktotalspace.md) - Returns the total size of a filesystem or disk partition