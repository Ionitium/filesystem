# rename

Rename a file or folder

## Description

```php
rename($from, $to)
```

Rename a file or folder. Throws exception if no action perform.

## Parameters

__from__
: Filename path source

__to__
: New filename path destinaton to rename file or folder

## Return values

No returns.

## Examples

Example #1 Rename a file
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$filesystem->rename('/tmp/myfile', '/tmp/mynewfile');
```

## Notes

_No notes._

## See also

_No documents._
