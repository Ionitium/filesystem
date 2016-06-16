# isWriteable

Tells whether the filename is writable

## Description

```php
isWriteable($filename)
```

Check if file exists and if a file is writeable

## Parameters

__filename__
: Filename path

## Return values

__boolean__
: Returns `TRUE` if file exists and writeable

__Exceptions__
: Returns exceptions if file is not exists or is not writeable, or return `TRUE`

## Examples

Example #1 Example
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$file = $filesystem->isWriteable('/tmp/myfile');
if ($file) {
    // File is writeable
}
```

## Notes

__No notes.__

## See also

__No documentation.__