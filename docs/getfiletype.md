# getFileType

Gets file type

## Description

```php
getFileType($fullName = false)
```

Get a file type as value or full regular name

## Parameters

__fullName__
: Returns filetype meaning data
: Default: `FALSE`

## Return values

Returns a filetype data.

> Returns as `block`, `char`, `dir`, `fifo`, `file`, `link` or `unknown`

If statement `fullName` set to true it will return text:

  *  `block` - Block special device
  *  `char` - Character special device
  *  `dir` - Directory
  *  `fifo` - FIFO (pipe)
  *  `file` - Regular file
  *  `link` - Symbolic link
  *  `unknown` - Unknown File Type

__Exception__
: Returns if file not defined.

## Examples

Example #1 Get a filetype
```php
use Ionitium\Filesystem\FilesystemInfo;

$filesystem = new FilesystemInfo('/tmp/myfile');
echo $filesystem->getFileType();
```

Example #1 Get a full text filetype
```php
use Ionitium\Filesystem\FilesystemInfo;

$filesystem = new FilesystemInfo('/tmp/myfile');
echo $filesystem->getFileType(true);
```

## Notes

_No notes._

## See also

_No documentation._