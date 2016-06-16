# setChmodRecursive

Tells whether the filename is a symbolic link

## Description

```php
isSymbolicLink($source)
```

Check is filepath symbolic link

## Parameters

__source__
: A path of filename source

## Return values

__boolean__
: Returns if is symbolic link

__Exception__
: Returns Exception if file not exists or is a directory

## Examples

Example #1 Check is symbolic link
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$path = $filesystem->isSymbolicLink('/tmp/mysymboliclink');
if ($path) {
    // A path is symbolic link
}
```

## Notes

__No notes.__

## See also

__No documentation.__