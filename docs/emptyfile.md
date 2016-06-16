# emptyFile

Truncate a file

## Description

```php
emptyFile($file)
```

Truncate a file using `ftruncate()` function

## Parameters

__filename__
: Filename path

## Return values

__Exceptions__
: Returns exceptions if file is not exists

## Examples

Example #1 Example truncating a file
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$filesystem->emptyFile('/tmp/myfile');
```

## Notes

> A function open a file on writing mode then uses `ftruncate()` to seek truncating a file.

## See also

__No documentation.__