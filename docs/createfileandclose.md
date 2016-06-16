# createFileAndClose

Create a non-exists file then close

## Description

```php
createFileAndClose($file)
```

Create a file if not exists, open read-only mode and close a file. Return `FALSE` if exists.

## Parameters

__file__
: Filename path

## Return values

__boolean__
: Returns `TRUE` if created a file

## Examples

Example #1 Example
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$file = $filesystem->createFileAndClose('/tmp/myfile');
if ($file) {
    // Created a file
}
```

## Notes

> A file will create using `fopen()` in `x` mode. This will create a file in writing mode.

## See also

__No documentation.__