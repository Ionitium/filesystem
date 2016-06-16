# readTemporaryFile

Read a data from create temporary file

## Description

```php
readTemporaryFile($resource)
```

Read a temporary file from source when use `fopen()` or `createTemporaryFile()` source

## Parameters

__resource__
: A resource from `createTemporaryFile()` function

## Return values

__string__
: Returns a content from temporary file

## Examples

Example #1 Read a file from temporary source
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$tempfile = $filesystem->createTemporaryFile();
if ($tempfile) {
    echo $filesystem->readTemporaryFile($tempfile);
}
```

## Notes

__No notes.__

## See also

* ['createTemporaryFile()`](createtemporaryfile.md) - Creates a temporary file
* [`removeTemporaryFile()`](removetemporaryfile.md) - Close temporary file