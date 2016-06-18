# getMimeEncoding

Return the mime encoding

## Description

```php
getMimeEncoding()
```

Returns mime encoding of the file such as 'binary', specified by _RFC 2045_

## Parameters

_No parameter._

## Return values

__Exception__
: Returns if is not defined file source

Returns a mime encoding as string value.

## Examples

Example #1 Returns the mime encoding
```php
use Ionitium\Filesystem\FilesystemInfo;

$filesystem = new FilesystemInfo('/tmp/myfile');
echo $filesystem->getMimeEncoding();
```

Result:

```php
binary
```

## Notes

_No notes._

## See also

* [`getMime()`](getmime.md) - Return the mime type and encoding
* [`getMimeType()`](getmimetype.md) - Return the mime type
* [`getMimeContentType()`](getmimecontenttype.md) - Detect MIME Content-type for a file