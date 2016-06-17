# getTreeStructure

Get tree structure of file

## Description

```php
getTreeStructure($directory, $depth = 0)
```

Iterate a folder with arrays data as nested-tree. Return a result as tree array.

## Parameters

__directory__
: Filename folder path

__depth__
: Set a depth of folder
: Default: `0` Infinite depth on recursion

## Return values

__array__
: Returns array with filenames from the path
: Returns a name of folder and files

## Examples

Example #1 Infinite lists of filenames
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$tree = $filesystem->getTreeStructure('/tmp/myfolder');
print_r($tree);
```

Example #2 Get a first depth
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$tree = $filesystem->getTreeStructure('/tmp/myfolder', 1);
print_r($tree);
```

## Notes

> It uses `splFileInfo` to return filename and `DirectoryITerator` to iterate a folders.

## See also

__No documentation.__
