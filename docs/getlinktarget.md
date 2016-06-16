# getLinkTarget

Returns the target of a symbolic link

## Description

```php
readlink($path)
```

Returns the target filepath of symbolic or hard link

## Parameters

__path__
: A path of symbolic link or hardlink source

## Return values

__string__
: Returns filename path of source link

## Examples

Example #1 Get a source link
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$linktarget = $filesystem->getLinkTarget('/tmp/link');
echo $linktarget;
```

## Notes

__No notes.__

## See also

__No documentation.__