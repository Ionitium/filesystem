# remove

Remove a file or folder from path

## Description

```php
remove($path, $safedelete = false)
```

Remove a file or a folder. A `safedelete` overwrites a data then delete a file.

## Parameters

__file__
: Filename path

__safedelete__
: Use for overwriting to a file before remove a file
: Default: `FALSE`

## Return values

__Exception__
: Returns Exception if a file or a folder can't remove

## Examples

Example #1 Basic remove a file
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$filesystem->remove('/tmp/myfile')
```

## Notes

_No notes._

## See also

_No documents._
