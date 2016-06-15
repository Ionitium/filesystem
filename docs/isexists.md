# isExists

Check if file or directory exists

## Description

```php
isExists($path)
```

Checks if file or folder exists in filepath.

## Parameters

__path__
: A filepath

## Return values

__bool__
: Returns `TRUE` if exists

## Examples

Example #1 Check if exists path
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
if ($filesystem->isExists('/tmp/myfolder')) {
    echo 'A path exists';
}
```

## Notes

No notes.

## See also

* [`isExistsAnyFile()`](isexistsanyfile.md) - Check if any file exists in folder recursive or get lists of files