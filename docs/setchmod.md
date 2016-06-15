# setChmod

Changes file mode

## Description

```php
setChmod($path, $mode, $force = true, $skipOnFalse = false)
```

Change a file mode octal, decimal or file type mode. A mode `skipOnFalse` will suppress errors.

## Parameters

__path__
: A path of filename

__mode__
: Chmod decimal `0644`, octal `511` or read/write/execute which contains strings: `drwxsStT-`

__force__
: Suppress errors if not chmod made succesfully
: Default: `TRUE`

__skipOnFalse__
: Bypass throw an Exception if failed to chmod
: Default: `FALSE`

## Return values

__boolean__
: Returns if successfully CHMOD action

__Exception__
: Returns Exception if `skipOnFalse` is set to `FALSE`

## Examples

Example #1 Set a CHMOD decimal way
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$return = $filesystem->setChmod('/tmp/mypath', 0644);
if ($return) {
    // Chmod success
}
```

Example #2 Set a CHMOD in octal way
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$return = $filesystem->setChmod('/tmp/mypath', 511);
if ($return) {
    // Chmod success
}
```

Example #3 Set a CHMOD in filetype way as 644 decimal way
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$return = $filesystem->setChmod('/tmp/mypath', 'drw-r--r--');
if ($return) {
    // Chmod success
}
```

Example #4 Set a CHMOD and supress on errors
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$return = $filesystem->setChmod('/tmp/mypath', 0644, true);
if ($return) {
    // This will always true
}
```

Example #5 Set a CHMOD and supress on errors
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$return = $filesystem->setChmod('/tmp/mypath', 0644, false, true);
if ($return) {
    // Returns will throw Exception
}
```

## Notes

> A parameter `$mode` should be integer type.

## See also

__No documentation.__