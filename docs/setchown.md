# setChown

Change file owner

## Description

```php
setChown($path, $user, $recursive = false)
```

Change owner name for path or files

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
: Returns if successfully changed name owner of files or folders

## Examples

Example #1 Set a CHOWN method
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$return = $filesystem->setChown('/tmp/mypath', 'apache');
if ($return) {
    // Owner changed
}
```

## Notes

> A parameter `$user` is string type.

## See also

__No documentation.__