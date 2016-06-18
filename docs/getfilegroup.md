# getFileGroup

Get info about file group and owners

## Description

```php
getFileGroup($details = false, $key = '')
```

Returns name of file group and owner

## Parameters

__details__
: Returns all data of file group as array
: Default: `FALSE`

__key__
: Get a specified data by key, not affects on `details` parameter
: Default: `None`

## Return values

__array__
: Returns arrays data of group owner file

__mixed__
: Returns a value from a specified `key`

## Examples

Example #1 Get a group owner ID by file
```php
use Ionitium\Filesystem\FilesystemInfo;

$filesystem = new FilesystemInfo('/tmp/myfile');
$result = $filesystem->getFileGroup();
print_r($result);
```

Result:
```php
int(1000)
```

Example #2 Get a group owner data by name, password, members and group ID
```php
use Ionitium\Filesystem\FilesystemInfo;

$filesystem = new FilesystemInfo('/tmp/myfile');
$result = $filesystem->getFileGroup(true);
print_r($result);
```

Result:
```php
array(4) {
  ["name"]=>
  string(5) "apache"
  ["passwd"]=>
  string(1) "x"
  ["members"]=>
  array(0) {
  }
  ["gid"]=>
  int(1000)
}
```

Example #3 Get a specified key `gid`
```php
use Ionitium\Filesystem\FilesystemInfo;

$filesystem = new FilesystemInfo('/tmp/myfile');

$result = $filesystem->getFileGroup(false, 'gid');
print_r($result);

$result = $filesystem->getFileGroup(true, 'gid');
print_r($result);
```

Result:
```php
int(1000)
int(1000)
```

## Notes

_No notes._

## See also

_No documentation._