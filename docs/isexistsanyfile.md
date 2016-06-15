# isExistsAnyFile

Check if any file exists in folder recursive or get lists of files or/and returns lists of file

## Description

```php
isExistsAnyFile($directory, $return_files = false)
```

Returns by filepath recursive find a files, if it exists returns boolean state or get a lists of found files.

## Parameters

__directory__
: A filepath directory

__returnFiles__
: Boolean state `TRUE` to set return lists of files
: Default value: `FALSE`

## Return values

__bool__
: Returns `TRUE`
: Returns `arrays` on lists of files

## Examples

Example #1 Check if exists any files
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
if ($filesystem->isExistsAnyFile('/tmp/myfolder')) {
    echo 'A path exists';
}
```

Example #2 Get a lists of files
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
if ($lists = $filesystem->isExistsAnyFile('/tmp/myfolder', true)) {
    print_r($lists);
}
```

A value returns as arrays:
```php
array {
    'foo.jpg',
    'bar.php'
}
```

## Notes

No notes.

## See also

* [`isExists()`](isexists.md) - Check if file or directory exists