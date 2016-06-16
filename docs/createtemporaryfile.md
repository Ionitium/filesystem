# createTemporaryFile

Creates a temporary file

## Description

```php
createTemporaryFile($content = null)
```

Create a temporary file with or without content.
Creates a temporary file with a unique name in read-write (w+) mode.

## Parameters

__content__
: Set a data into a file
: Default: `null`

## Return values

__object__
: Returns file handle such as `fopen()` or `FALSE` on failure.
: Use `readTemporaryFile($object)` to read a file

## Examples

Example #1 Create a file
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$tempfile = $filesystem->createTemporaryFile('A content');
```

Example #2 Create a file and read a file using `readTemporaryFile()`
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$tempfile = $filesystem->createTemporaryFile('A content');
if ($tempfile) {
    echo $tempfile->readTemporaryFile($tempfile);
}
```

## Notes

__No notes.__

## See also

* [`readTemporaryFile()`](readtemporaryfile.md) - Read a data from create temporary file
* [`removeTemporaryFile()`](removetemporaryfile.md) - Close temporary file
