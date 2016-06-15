# touchAlternate

Touch a file using fopen

## Description

```php
touchAlternate($file)
```

An alternate way to set a time using `fopen`. Works on mostly platform.

## Parameters

__file__
: Filename path

## Return values

No return values.

## Examples

Example #1 Basic function
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$filesystem->touchAlternate('/tmp/myfile');
```

## Notes

> No notes.

## See also

* [`touch()`](touch.md) - Create a file or set access time
* [`touchWithoutOwnerSet()`](touchWithoutOwnerSet.md) - Create a file or set access time
