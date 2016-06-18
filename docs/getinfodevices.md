# getInfoDevices

Return information about a file

## Description

```php
getInfoDevices()
```

Look at the contents of blocks or character special devices

## Parameters

_No parameter._

## Return values

__Exception__
: Returns if is not defined file source

Returns device info name (for example tty terminal).

## Examples

Example #1 Get a info device by filename
```php
use Ionitium\Filesystem\FilesystemInfo;

$filesystem = new FilesystemInfo('/tmp/myfile');
echo $filesystem->getInfoDevices();
```

Result:

```php
very short file (no magic)
```

## Notes

> Function use `finfo_open` to get `FILEINFO_DEVICES` attribute.

## See also

* `getInfoNone()` - Returns mime info global
* `getInfoRaw()` - Returns raw information of file