# writeFilePrepend

Prepend a data to a file

## Description

```php
writeFilePrepend($file, $content, $buffer = 512)
```

Append a data on top of file

## Parameters

__file__
: Filename path

__content__
: A dato to add on top of file
  
__buffer__
: A buffer when reading a file
: Default: `512`

## Return values

No returns.

## Examples

Example #1 Prepend a data into a file
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$filesystem->writeFilePrepend('/tmp/myfile', 'A content');
echo $filesystem->readFile('/tmp/myfile');
```

Example #2 Prepend a data and change buffer reading for large file
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$filesystem->writeFilePrepend('/tmp/myfile', 'A content', 2048);
echo $filesystem->readFile('/tmp/myfile');
```

## Notes

> A function read entire file using `fopen` then write to a new temporary file a content to append a data. A new temporary file renames to original filename and execute `clearstatcache()` to make sure that file exists due to renaming a file.


## See also

__No documentation.__