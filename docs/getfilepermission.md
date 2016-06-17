# getFilePermission

Gets file permissions

## Description

```php
getFilePermission($type = 'octal')
```

Returns file permission in octal by default or hexadecimal

## Parameters

__type__
: Use `octal` as default to get octal value or `full` to get `rwxsStT-` form.

## Return values

__string__ or __octal__
: Return file permission value

## Examples

Example #1 Get an octal value
```php
use Ionitium\Filesystem\FilesystemInfo;

$filesystem = new FilesystemInfo('/tmp/myfile');
echo $filesystem->getFilePermission();
```

Result:
```php
int(3) 666
```

Example #2 Get an `rwx` form value
```php
use Ionitium\Filesystem\FilesystemInfo;

$filesystem = new FilesystemInfo('/tmp/myfile');
echo $filesystem->getFilePermission('full');
```

Result:
```php
string(10) '-rw-rw-rw-'
```

## Notes

> It uses `clearstatcache()` to get updated filesystem information.

## See also

_No documentation._
