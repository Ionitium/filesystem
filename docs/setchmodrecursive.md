# setChmodRecursive

Changes file mode separate for files and folders

## Description

```php
setChmodRecursive($path, $modeFile, $modeDirectory = null, $force = true, $skipOnFalse = false)
```

Changes file mode separated by file chmod and directory chmod

## Parameters

__path__
: A path of filename

__modefile__
: Chmod for files only, chmod decimal `0644`, octal `511` or read/write/execute which contains strings: `drwxsStT-`

__modeDirectory__
: Chmod for directory only

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
$return = $filesystem->setChmodRecursive('/tmp/mypath', 0644);
if ($return) {
    // Chmod success
}
```

Example #2 Set a CHMOD in octal way
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$return = $filesystem->setChmodRecursive('/tmp/mypath', 511);
if ($return) {
    // Chmod success
}
```

Example #3 Set a CHMOD in filetype way as 644 decimal way
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$return = $filesystem->setChmodRecursive('/tmp/mypath', 'drw-r--r--');
if ($return) {
    // Chmod success
}
```

Example #4 Set a CHMOD and supress on errors
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$return = $filesystem->setChmodRecursive('/tmp/mypath', 0644, true);
if ($return) {
    // This will always true
}
```

Example #5 Set a CHMOD and supress on errors
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$return = $filesystem->setChmodRecursive('/tmp/mypath', 0644, false, true);
if ($return) {
    // Returns will throw Exception
}
```

## Notes

> A parameter `$mode` should be integer type.

## See also

__No documentation.__