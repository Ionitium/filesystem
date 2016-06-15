# getFiles

Get files inside directory non-recursive or recursive

## Description

```php
getFiles($directory, $recursive = true)
```

Get a lists of files on local root directory by path or get all files recursive

## Parameters

__directory__
: A directory path

__recursive__
: Get lists of files recursive as array
: Default: `TRUE`

## Return values

__array__
: Returns lists of files

## Examples

Example #1 Get a lists of files in directory recursive
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$lists = $filesystem->getFiles('/tmp/mydir');
print_r($lists);
```

Example #2 Get a lists of files in current directory
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$lists = $filesystem->getFiles('/tmp/mydir', false);
print_r($lists);
```

## Notes

> A parameter `$directory` should be folder if is not folder it will return name of file.

## See also

__No documentation.__