# getHumanFileSize

Get human readable filesize

## Description

```php
getHumanFileSize($bytes, $decimals = 2, $array_print = false)
```

Get human readable filesize

## Parameters

__bytes__
: A size in a bytes, integer

__decimals__
: Return a size in a decimal point
: Default: `2`

__array_print__
: Return as array instead string separated as value and filesize type
: Default: `false`

## Return values

__Exception__
: Returns if bytes parameter is not defined.

Returns a file size in human readable format.

## Examples

Example #1 Get a filesize from bytes
```php
use Ionitium\Filesystem\FilesystemInfo;

$filesystem = new FilesystemInfo('/tmp/myfile');
echo $filesystem->getHumanFileSize(8);
);
```

Result:

```php
(string )8.00 KiB
```

Example #1 Get a filesize into 3 decimals
```php
use Ionitium\Filesystem\FilesystemInfo;

$filesystem = new FilesystemInfo('/tmp/myfile');
echo $filesystem->getHumanFileSize(8, 3);
```

Result:

```php
(string) 8.000 KiB
```

Example #1 Get a filesize into 3 decimals and separate data
```php
use Ionitium\Filesystem\FilesystemInfo;

$filesystem = new FilesystemInfo('/tmp/myfile');
echo $filesystem->getHumanFileSize(8, 3, true);
```

Result:

```php
array {
    [0] => '8.000',
    [1] => 'KiB'
}
```

## Notes

> File size is measurement the size of computer file. By IEC standard it uses '*bi' form. Max range format is `YiB`.

## See also

_No documentation._