# removeTemporaryFile

Close temporary file (remove a file)

## Description

```php
removeTemporaryFile($resource = null)
```

Delete a temporary file due to `fclose()` automatically removes.

## Parameters

__resource__
: A resource from `createTemporaryFile()` function

## Return values

__boolean__
: Returns if source has been removed

## Examples

Example #1 Remove a file
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$tempfile = $filesystem->createTemporaryFile();
if ($tempfile) {
    $removesource = $tempfile->removeTemporaryFile($tempfile);
    if ($removesource) {
        // File has been removed
    }
}
```

## Notes

__No notes.__

## See also

* ['createTemporaryFile()`](createtemporaryfile.md) - Creates a temporary file
* [`readTemporaryFile()`](readtemporaryfile.md) - Read a data from create temporary file