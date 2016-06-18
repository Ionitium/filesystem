# getMimeType

Return the mime type

## Description

```php
getMimeType()
```

Returns mime type specified by _RFC 2045_

## Parameters

_No parameter._

## Return values

__Exception__
: Returns if is not defined file source

Returns a mime type as string value.

## Examples

Example #1 Get a mime type
```php
use Ionitium\Filesystem\FilesystemInfo;

$filesystem = new FilesystemInfo('/tmp/myfile');
echo $filesystem->getMimeType();
```

Result:

```php
application/octet-stream
```

## Notes

_No notes._

## See also

* [`getMime()`](getmime.md) - Return the mime type and encoding
* [`getMimeEncoding()`](getmimeencoding.md) - Return the mime encoding
* [`getMimeContentType()`](getmimecontenttype.md) - Detect MIME Content-type for a file