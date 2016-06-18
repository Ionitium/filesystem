# getDiskTotalSpace

Returns the total size of a filesystem or disk partition

## Description

```php
getDiskTotalSpace($humanSize = false, $decimals = 2, $array_print = false)
```

Return total number of bytes of filesystem or disk partition

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
: Returns if bytes parameter is not defined.

Returns a total size of filesystem in bytes or disk partition in `float()` type.

## Examples

Example #1 Get a total size of filesystem in float
```php
use Ionitium\Filesystem\FilesystemInfo;

$filesystem = new FilesystemInfo('/tmp/myfile');
echo $filesystem->getDiskTotalSpace();
);
```

Result:

```php
float(422037372928)
```

Example #2 Get a total size of filesystem in human readable format
```php
use Ionitium\Filesystem\FilesystemInfo;

$filesystem = new FilesystemInfo('/tmp/myfile');
echo $filesystem->getDiskTotalSpace(true, 3);
```

Result:

```php
(string) "393.053 GiB"
```

Example #3 Get a total size of filesystem into 3 decimals and separate data
```php
use Ionitium\Filesystem\FilesystemInfo;

$filesystem = new FilesystemInfo('/tmp/myfile');
echo $filesystem->getDiskTotalSpace(true, 3, true);
```

Result:

```php
array(2) {
  [0]=>
  string(7) "393.053"
  [1]=>
  string(3) "GiB"
}
```

## Notes

_No notes._

## See also

* [`getDiskFreeSpace()`](getdiskfreespace.md) - Returns available space on filesystem or disk partition
* [`getDiskTotalUsage()`](getdisktotalusage.md) - Returns the total usage of disk filesystem