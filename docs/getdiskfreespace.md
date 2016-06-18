# getDiskFreeSpace

Returns available space on filesystem or disk partition

## Description

```php
getDiskFreeSpace($humanSize = false, $decimals = 2, $array_print = false)
```

Return number of bytes available by filesystem or disk partition

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

Returns availability of filesystem in bytes or disk partition in `float()` type.

## Examples

Example #1 Get a filesize from bytes
```php
use Ionitium\Filesystem\FilesystemInfo;

$filesystem = new FilesystemInfo('/tmp/myfile');
echo $filesystem->getDiskFreeSpace();
);
```

Result:

```php
float(18838904832)
```

Example #2 Get a filesize into 3 decimals
```php
use Ionitium\Filesystem\FilesystemInfo;

$filesystem = new FilesystemInfo('/tmp/myfile');
echo $filesystem->getDiskFreeSpace(true, 3);
```

Result:

```php
(string) 17.545 GiB
```

Example #3 Get a filesize into 3 decimals and separate data
```php
use Ionitium\Filesystem\FilesystemInfo;

$filesystem = new FilesystemInfo('/tmp/myfile');
echo $filesystem->getDiskFreeSpace(true, 3, true);
```

Result:

```php
array(2) {
  [0]=>
  string(6) "17.545"
  [1]=>
  string(3) "GiB"
}
```

## Notes

_No notes._

## See also

* [`getDiskTotalSpace()`](getdisktotalspace.md) - Returns the total size of a filesystem or disk partition
* [`getDiskTotalUsage()`](getdisktotalusage.md) - Returns the total usage of disk filesystem