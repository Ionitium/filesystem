# getFileSize

Get file size

## Description

```php
getFileSize($humanSize = false, $decimals = 2, $arrayPrint = false)
```

Returns filesize in bytes. For defined `humanSize` it will return in decimals and filesize size type. If is `array_print` set to `TRUE` returns in array as size and size type.

## Parameters

__humanSize__
: Returns filesize in readable format (`1 kB`)
: Default: `FALSE`

__decimals__
: If humanSize defined, it will returns in decimal separator
: Default: `2` (`2.00 kB`)

__arrayPrint__
: Return result as array (`2.00` / `kB`)
: Default: `FALSE`

## Return values

Returns filesize in bytes if `humanSize` se to `false` by default.

> If `humanSize` set to `TRUE` it will return in decimal separators.
> If `arrayPrint` set with `humanSize` to `true` it will return as array as `2.00` as value and filesize type as `kB`.

__Exception__

: Returns if file not defined.

## Examples

Example #1 Get a filesize in bytes
```php
use Ionitium\Filesystem\FilesystemInfo;

$filesystem = new FilesystemInfo('/tmp/myfile');
echo $filesystem->getFileOwnerName();
```

Example #2 Get a filesize in humanSize
```php
use Ionitium\Filesystem\FilesystemInfo;

$filesystem = new FilesystemInfo('/tmp/myfile');
echo $filesystem->getFileOwnerName(true);
```

Example #3 Get a filesize in humanSize with 3 decimals
```php
use Ionitium\Filesystem\FilesystemInfo;

$filesystem = new FilesystemInfo('/tmp/myfile');
echo $filesystem->getFileOwnerName(true, 3, false);
```

Result:

```php
array(
    '8.000 B'
)
```

Example #3 Get a filesize in humanSize with 3 decimals and separated size and filesize type
```php
use Ionitium\Filesystem\FilesystemInfo;

$filesystem = new FilesystemInfo('/tmp/myfile');
print_r($filesystem->getFileOwnerName(true, 3, true));
```

Result:

```php
array(
    '8.00', 'B'
)
```

## Notes

> Before fetching a filesize a `clearstatcache()` function has been provided to get correctly result from filesystem.

## See also

_No documentation._