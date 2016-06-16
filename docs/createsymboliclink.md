# createSymbolicLink

Creates a symbolic link

## Description

```php
createSymbolicLink($source, $link)
```

Create soft link, a symbolic link from source to target

## Parameters

__source__
: A path of filename source

__link__
: A target path to create symbolic link

## Return values

__boolean__
: Returns if created symbolic link to target filename

__Exceptions__
: Returns if is link exists or is exists a symbolic link

## Examples

Example #1 Create a symbolic link
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$symlink = $filesystem->createSymbolicLink('/tmp/source', '/tmp/link');
if ($symlink) {
    // A symbolic link created
}
```

## Notes

> It uses internally `symlink()` function.

## See also

__No documentation.__