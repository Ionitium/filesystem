# writeFileAppend

Append a data to a file

## Description

```php
writeFileAppend($file, $content, $buffer = false)
```

Append a content to end of a file

## Parameters

__file__
: Filename path

__content__
: A dato to add on top of file
  
__buffer__
: A buffer when writing a file. If specified it will stop to specified length in bytes.
: Default: `false`

## Return values

No returns.

## Examples

Example #1 Add a content to end of file
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$filesystem->writeFileAppend('/tmp/myfile', 'A content');
echo $filesystem->readFile('/tmp/myfile');
```

## Notes

> A `fwrite()` uses append `a+` condition.


## See also

__No documentation.__