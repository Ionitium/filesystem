# getMimeContentType

Detect MIME Content-type for a file

## Description

```php
getMimeContentType()
```

Returns mime content type of the file such as 'application/octet-stream', specified by _RFC 2045_

## Parameters

_No parameter._

## Return values

__Exception__
: Returns if is not defined file source

Returns a mime content type as string value.

## Examples

Example #1 Returns the mime content type
```php
use Ionitium\Filesystem\FilesystemInfo;

$filesystem = new FilesystemInfo('/tmp/myfile');
echo $filesystem->getMimeContentType();
```

Result:

```php
application/octet-stream
```

## Notes

_No notes._

## See also

* [`getMime()`](getmime.md) - Return the mime type and encoding
* [`getMimeType()`](getmimetype.md) - Return the mime type
* [`getMimeEncoding()`](getmimeencoding.md) - Return the mime encoding