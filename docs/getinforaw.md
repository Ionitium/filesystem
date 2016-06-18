# getInfoRaw

Returns raw information of file

## Description

```php
getInfoRaw()
```

Returns detailed information of file using fileinfo handler

## Parameters

_No parameter._

## Return values

__Exception__
: Returns if is not defined file source

Returns file info in a raw format.

## Examples

Example #1 Get a info raw data
```php
use Ionitium\Filesystem\FilesystemInfo;

$filesystem = new FilesystemInfo('/tmp/myfile');
echo $filesystem->getInfoRaw();
```

Result:

```php
very short file (no magic)
```

## Notes

> Function use `finfo_open` to get `FILEINFO_RAW` attribute.

## See also

* [`getInfoNone()`](getinfonone.md) - Returns mime info global
* [`getInfoDevices()`](getinfodevices.md) - Return information about a file