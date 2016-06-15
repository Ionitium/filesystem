# touch

Create a file or set access time

## Description

```php
touch($file, $time = null, $atime = null)
```

Create a file with current time, or set a time on exists file. `atime` provides to set access time of file.

## Parameters

__file__
: Filename path

__time__
: Current time
: Default: current timestamp by default or set a touch time
  
__atime__
: Set a file access time or by default not set
: Default: `NULL`

## Return values

__bool__
: Returns `TRUE` on success

__Exception__
: Returns Exception when function not created or set up a time

## Examples

Example #1 Basic create a file
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
if ($filesystem->touch('/tmp/myfile')) {
    echo 'A file created';
}
```

Example #2 Creating a file with current unix timestamp touch time
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
if ($filesystem->touch('/tmp/myfile', time())) {
    echo 'On exists file set touch time';
}
```

Example #3 Set touch time and access time
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
if ($filesystem->touch('/tmp/myfile', time(), time())) {
    echo 'On exists file set touch time and access time';
}
```

## Notes

> A parameter `$atime` is equivalent as `fileatime()` unix function to set access time.

## See also

* [`touchWithoutOwnerSet()`](touchWithoutOwnerSet.md) - Create a file or set access time
