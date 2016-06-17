# getChecksum

Get cheksum of file

## Description

```php
getChecksum($filename, $type = 'md5')
```

Get a cheksum data for a readed file.

## Parameters

__filename__
: Filename path

__type__
: Cheksum type
: Default: `md5`
: Supported cheksum types: 
: `md5` - md5 cheksum hash (alternative is md5sum unix command) (length 32bit)
: `md5raw` - md5 hash digest raw binary cheksum (length 16bit)
: `md5raw128` - md5 raw 128bit hash
: `sha1` - sha1 hash
: `sha1raw` - sha1 hash raw binary cheksum (length 20bit)
: `crc32` - polynomial 32bit length

## Return values

__string__
: Returns cheksum result

__Exception__
: Returns Exception when file is not present

## Examples

Example #1 Get a `md5` cheksum
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$cheksum = $filesystem->getChecksum('/tmp/myfile');
echo $cheksum;
}
```

Example #2 Get another cheksum like `crc32`
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$cheksum = $filesystem->getChecksum('/tmp/myfile', 'crc32');
echo $cheksum;
}
```

## Notes

> A `crc32` cheksum for big file may consuming time for reading because it reads a content of file.

## See also

_No documentation._
