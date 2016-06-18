# getMime

Return the mime type and encoding

## Description

```php
getMime()
```

Returns mime type and mime encoding type specified by _RFC 2045_

## Parameters

_No parameter._

## Return values

__Exception__
: Returns if is not defined file source

Returns a mime type and mime encoding type as string.

## Examples

Example #1 Get a mime type and mime encoding type
```php
use Ionitium\Filesystem\FilesystemInfo;

$filesystem = new FilesystemInfo('/tmp/myfile');
echo $filesystem->getMime();
```

Result:

```php
application/octet-stream; charset=binary
```

## Notes

_No notes._

## See also

* [`getMimeType()`](getmimetype.md) - Return the mime type
* [`getMimeEncoding()`](getmimeencoding.md) - Return the mime encoding
* [`getMimeContentType()`](getmimecontenttype.md) - Detect MIME Content-type for a file