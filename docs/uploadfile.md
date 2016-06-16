# uploadFile

Moves an uploaded file to a new location

## Description

```php
uploadFile($filename, $destination, $overwrite = true)
```

Move a filepath to destination. If overwrite is set to true by default, it will rewrite uploaded destination file'

## Parameters

__filename__
: A path of filename source

__destination__
: A path of destination file

__overwrite__
: Overwrite a destination file
: Default: `TRUE`

## Return values

__boolean__
: Returns if a file is moved successfully

## Examples

Example #1 Move a uploaded file
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$move = $filesystem->uploadFile('/tmp/source', '/tmp/destination');
if ($move) {
    // Moved a file successfully
}
```

## Notes

> It uses internally `copy()` function.

## See also

__No documentation.__