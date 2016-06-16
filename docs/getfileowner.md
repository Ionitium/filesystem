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

__array__
: Returns arrays data of owner file

## Examples

Example #1 Get a UID file
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$filesystem->getFileOwner('/tmp/myfile');
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

## Notes

_No notes._

## See also

* [`getFileOwnerName()`](getfileownername.md) - Return info about a user by user id
