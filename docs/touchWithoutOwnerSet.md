# touchWithoutOwnerSet

Create a directory

## Description

```php
touchWithoutOwnerSet($file)
```

Touch a file without change an owner. After execution it will update `stat` file.

## Parameters

__file__
: The directory path

## Return values

No value is returned. 

## Examples

Example #1 Basic touch a file
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$filesystem->touchWithoutOwnerSet('/tmp/myfile')
```

## Notes

> A function works only on __postfix__ UNIX compatble system.

## See also

* [`touch()`](touch.md) - Create a file or set access time
