# mkdir

Create a directory

## Description

```php
mkdir($directory, $mode = 0755, $context = null)
```

Create a directory with chmod 0755 by default. Context is used for __context__ stream.

## Parameters

__directory__
: The directory path

__mode__
: Chmod mode decimal value
: Default: `0755`
  
__context__
: Stream context create for _FTP/HTTP_ request
: Default: `NULL`

## Return values

__bool__
: Returns `TRUE` or `FALSE`

__Exception__
1. `directory` attribute is empty
2. Error on creating directory

## Examples

Example #1 Basic creating a directory
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
if ($filesystem->mkdir('/tmp/myfolder')) {
    echo 'Directory created';
}
```

Example #2 Creating a directory with decimal 0777 or octal 511 as same value:
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
if ($filesystem->mkdir('/tmp/myfolder', 0777)) {
    echo 'Directory created';
}
```

```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
if ($filesystem->mkdir('/tmp/myfolder', 511)) {
    echo 'Directory created';
}
```

## Notes

> When you specified a recursive path as `/tmp/folder/folder2` it will automatically make a subfolders defined by nested path.

## See also

_No documents._
