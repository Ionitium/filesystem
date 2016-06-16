# readFile

Read a file using fopen as regular or binary mode, buffer can change

## Description

```php
readFile($file, $binary = false, $length = false)
```

Read a file using `fopen` as regular or binary mode, buffer can change

## Parameters

__file__
: Filename path

__binary__
: Binary read mode
: Default: `FALSE`
  
__length__
: Length of reading file by chunk in integer. If you need to read chunk by 1 byte use `2`.
: Default: `false`

## Return values

On error reading a file returns `false`.

__bool__
: Returns `FALSE` if no data found or can't read a file

__string__
: Returns a string data from readed file

__Exception__
: Exceptions triggers if is directory or link, if not exists a file, if not readable, if not  is integer type of length or if is set to true

## Examples

Example #1 Basic reading file
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$fileData = $filesystem->readFile('/tmp/myfile');
echo $fileData;
```

Example #2 Reading file binary
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$fileData = $filesystem->readFile('/tmp/myfile', true);
echo $fileData;
```

Example #3 Reading file binary and change length reading a file to 1024-1 bytes
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$fileData = $filesystem->readFile('/tmp/myfile', true, 1024);
echo $fileData;
```

## Notes

> If specified parameter `length` reads a file when length -1 bytes have been read. By default read to EOF.


## See also

__No documentation.__