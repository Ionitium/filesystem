# getInfoNone

Returns mime info global

## Description

```php
getInfoNone()
```

Returns mime magic name such as  'very short file (no magic)', specified by _RFC 2045_

## Parameters

_No parameter._

## Return values

__Exception__
: Returns if is not defined file source

Returns a mime content type as string value.

## Examples

Example #1 Example get a mime magic name
```php
use Ionitium\Filesystem\FilesystemInfo;

$filesystem = new FilesystemInfo('/tmp/myfile');
echo $filesystem->getInfoNone();
```

Result:

```php
very short file (no magic)
```

## Notes

> Function use `finfo_open` to get `FILEINFO_NONE` attribute.

## See also

* [`getInfoDevices()`](getinfodevices.md) - Return information about a file
* [`getInfoRaw()`](getinforaw.md) - Returns raw information of file