# getFileOwner

Return info about a user by user id, get a file owner

## Description

```php
getFileOwner($details = false, $key = '')
```

Returns user id for file. Returns `stat` information from __posix__.

## Parameters

__details__
: A posix returns of file owner, all data

__key__
: Get a specified data
: Default: `None`

## Return values

__array__
: Returns arrays data of owner file

__mixed__
: Returns a value from a specified `key`

## Examples

Example #1 Get a UID file detail
```php
use Ionitium\Filesystem\FilesystemInfo;

$filesystem = new FilesystemInfo('/tmp/myfile');
$result = $filesystem->getFileOwner(true);
print_r($result);
```

Result:
```php
array(7) {
  ["name"]=>
  string(5) "apache"
  ["passwd"]=>
  string(1) "x"
  ["uid"]=>
  int(1000)
  ["gid"]=>
  int(1000)
  ["gecos"]=>
  string(8) "apache,,,"
  ["dir"]=>
  string(11) "/home/user"
  ["shell"]=>
  string(9) "/bin/bash"
}
```

Example #2 Get by key value
```php
use Ionitium\Filesystem\FilesystemInfo;

$filesystem = new FilesystemInfo('/tmp/myfile');
$result = $filesystem->getFileOwner(true, 'name');
print_r($result);
```

Result:
```php
string(5) "apache"
```

## Notes

_No notes._

## See also

* [`getFileOwnerName()`](getfileownername.md) - Return info about a user by user id