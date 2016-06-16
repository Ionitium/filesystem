# executeFileInBackground

Execute background process

## Description

```php
executeFileInBackground($command)
```

Execute console/command process in a background system. Supports on Unix and Windows platform.

## Parameters

__command__
: A command that execute in terminal as background process
  
## Return values

__bool__
: Returns `TRUE` on started process

__Exception__
: Exception on no command defined

## Examples

Example #1 Create a process
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$filesystem->executeFileInBackground('php script.php');
```

## Notes

> On Windows uses `start /B` on unix uses `exec()` command.

## See also

__No documentation.__
