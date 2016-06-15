# setChgrp

Changes file group

## Description

```php
setChgrp($path, $user, $recursive = false)
```

Change users group owner in file

## Parameters

__path__
: A path of filename

__user__
: A group name or GUID (number group)

__recursive__
: Make recursive changes
: Default: `FALSE`

## Return values

__boolean__
: Returns if successfully changed group

## Examples

Example #1 Set a CHGRP decimal way
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$return = $filesystem->setChgrp('/tmp/mypath', 'apache');
if ($return) {
    // Group changed
}
```

## Notes

> A parameter `$user` is string type.

## See also

* [`setChown()`](setchown.md) - Change file owner