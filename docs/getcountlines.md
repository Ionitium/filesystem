# getCountLines

Counts number lines of code

## Description

```php
getCountLines()
```

Counts a number lines of code in a file

## Parameters

_No parameters._

## Return values

__Exception__
: Returns exception if file is not exists or is not a file

Returns integer type lines of code.

## Examples

Example #1 Count a lines of code in a file
```php
use Ionitium\Filesystem\FilesystemInfo;

$filesystem = new FilesystemInfo('/tmp/myfile'); // 3 new lines
echo $filesystem->getCountLines();
```

Result:

```php
int (3)
```

## Notes

> Useful for source code to count lines of codes.

## See also

_No documentation._