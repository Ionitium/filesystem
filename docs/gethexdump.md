# getHexDump

Returns hexadecimal dumps from a file

## Description

```php
getHexDump($path)
```

Returns binary and hex data from a file

## Parameters

__path__
: Filename path

## Return values

__array__
: Returns hexadecimal, octal and ASCII dump

__Exception__
: Throws Exception if can not read a file

## Examples

Example #1 Get a hex dump
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$result = $filesystem->getHexDump('/tmp/file');
print_r($result);
```

Result:

```
array(3) {
  [0]=>
  string(9) "00000000"
  [1]=>
  string(30) "30 31 32 33 34 35 36 37 38 39 "
  [2]=>
  string(10) "0123456789"
}
```

## Notes

> Using for reverse engineering or debugging a file to view in hexadecimal way.

## See also

__No documentation.__
