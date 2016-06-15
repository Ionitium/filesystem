# copy

Copy recursive file and folder

## Description

```php
copy($source, $destination, $streamCopy = false)
```

Copy directory from source to destination path. 

## Parameters

__source__
: Source filepath of directory

__destination__
: Destination filepath to copy from source
  
__streamCopy__
: Copy using file stream. Slow because it's copy using read and writing to file.
: Default: `FALSE`
: By default uses `copy` instead `stream_copy_to_stream()` function

## Return values

No return values.

__Exception__
: Returns Exception if not folder is defined from sources

## Examples

Example #1 Standard `copy` method
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$filesystem->copy('/tmp/pathfrom', '/tmp/pathto'
```

Example #2 Copy using file stream
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$filesystem->copy('/tmp/pathfrom', '/tmp/pathto', true)
```

## Notes

> A `copy` parameter is faster but it will make sure that a files are copied.

## See also

No documentation.