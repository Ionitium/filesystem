# getIncludedFiles

Get a lists of included files

## Description

```php
getIncludedFiles()
```

Get arrays lists of included files. Returns array of names from `include()`, `require()`, `include_once()`, `require_once()`.
Return data is sorted by time.

## Parameters

_No parameters._

## Return values

__array__
: Returns array of included files

## Examples

Example #1 Example
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$cheksum = $filesystem->getIncludedFiles();
print_r($cheksum);
}
```

Result:

```php
array(88) {
  [0]=>
  string(16) "/usr/bin/phpunit"
  ...
}
```

## Notes

_No notes._

## See also

_No documentation._
