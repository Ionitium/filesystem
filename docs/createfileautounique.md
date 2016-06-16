# createFileAutoUnique

Create file with unique file name

## Description

```php
createFileAutoUnique($directory = null, $prefix = null, $content = '')
```

Create a temporary file automatically into temporary directory with/without content.
Can be set a prefix into filename temporary file.
By default it will create unique file with empty content.

## Parameters

__directory__
: Set a directory to create a temporary name.
: If not set, use default temporary dir like `/tmp`

__prefix__
: Set a prefix name to tempory file
: Default: no prefix

__content__
: A data into a temporary file
: Default: _none_

## Return values

__string__
: Returns temporary filename (with path) or `FALSE` on failure.

## Examples

Example #1 Create a file
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$linktarget = $filesystem->createFileAutoUnique();
if ($linktarget) {
    echo $linktarget; // A filename
}
```

Example #1 Create a file with prefix
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$linktarget = $filesystem->createFileAutoUnique(null, 'pref');
if ($linktarget) {
    echo $linktarget; // A filename with `pref` on filename prefix
}
```

Example #1 Create a file with content
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$linktarget = $filesystem->createFileAutoUnique(null, null, 'A content');
if ($linktarget) {
    echo $linktarget; // A filename with data content `A content`
}
```

## Notes

__No notes.__

## See also

__No documentation.__