# getFileOwnerName

Return info about a user name

## Description

```php
getFileOwnerName($file)
```

Returns user name for file owner. Returns `stat` information from __posix__.

## Parameters

__file__
: A filename source

## Return values

__string__
: Returns user name from file owner

## Examples

Example #1 Get a `user` name file
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$filesystem->getFileOwnerName('/tmp/myfile');
```

Result:
```php
string 'apache'
```

## Notes

_No notes._

## See also

* [`getFileOwner()`](getfileowner.md) - Return info about a user by user id