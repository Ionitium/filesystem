# getFileOwner

Return info about a user by user id

## Description

```php
getFileOwner($file)
```

Returns user id for file. Returns `stat` information from __posix__.

## Parameters

__file__
: A filename source

## Return values

__string__
: Returns UID of file owner

## Examples

Example #1 Get a UID file
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$filesystem->getFileOwner('/tmp/myfile');
```

Example result:
```php
string 'apache'
```

## Notes

_No notes._

## See also

_No documents._
