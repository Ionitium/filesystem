# writeFile

Write a new file, overwrite if exists

## Description

```php
writeFile($file, $content, $buffer = false)
```

Write a content to a file. By default buffer is length size of string. Writing mode only. If file not exists it will create if exists it will truncated.

## Parameters

__file__
: Filename path

__content__
: A content
  
__buffer__
: Limit to write a data a file in bytes. Default is by length of content.
: Default: `false`

## Return values

No returns.

## Examples

Example #1 Writing a file
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$fileData = $filesystem->writeFile('/tmp/myfile', 'Hello World');
```

Example #2 Limit length to 256 bytes
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$fileData = $filesystem->writeFile('/tmp/myfile', 'Hello World', 256);
echo $fileData;
```

## Notes

__No notes.__

## See also

__No documentation.__