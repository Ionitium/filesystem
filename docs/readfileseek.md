# readFileSeek

Returns string from a file to specified line of file

## Description

```php
readFileSeek($source, $linenum = 0, $range = 0)
```

Returns string from read file at specified line and range of below and below code

## Parameters

__source__
: Filename path

__linenum__
: Seek to line number

__range__
: Seek to line number below and above of `$linenum`
: Default: `0` or current line as `$linenum`

## Return values

__string__
: Returns contents of file

__Exception__
: Returns Exception when a file is not seekable

## Examples

Example #1 Example
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
echo $filesystem->readFileSeek('/tmp/file', 15, 2);
}
```

Result:

```php
string ("13_abc // Seek 2 above
14_abc  // Seek 1 above
15_abc  // A linenum seekable
16_abc  // Seek 1 below
17_abc  // Seek 2 below
")
```

## Notes

> If file is not seekable to below or above lines it will skip and returns strings as possible.

## See also

_No documentation._
