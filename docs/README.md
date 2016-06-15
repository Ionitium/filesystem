# Filesystem

The `Filesystem` provides manage, access and retrieve information of file

## Installation

1. Installation via [Composer](http://www.composer.org) on [Packagist](http://www.packagist.com)
2. Installation using [Git](http://www.github.com) GIT clone component


## Prerequisities

PHP version requirements: _PHP >5.3_

Add `use Ionitium\Filesystem\Filesystem` declaration into required vendor package.

Example use to create directory:

```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
if ($filesystem->mkdir('/tmp/myfolder')) {
    echo 'Directory created';
}
```


## Changelog

Status of core:

| Version       | State                |
| ------------- |:-------------------- |
| `1.0`         | Release version      |

PHP version above `5.3`.
Quality assurance: Unit tests provided

## Table of Contents

* [`mkdir()`](mkdir.md) - Create a directory
* [`touch()`](touch.md) - Create a file or set access time
* [`touchWithoutOwnerSet()`](touchWithoutOwnerSet.md) - Create a file or set access time
* [`touchAlternate()`](touchAlternate.md) - Touch a file using fopen
* [`remove()`](remove.md) - Remove a file or folder from path
* [`copy()`](copy.md) - Copy recursive file and folder
* [`isExists()`](isexists.md) - Check if file or directory exists
* [`isExistsAnyFile()`](isexistsanyfile.md) - Check if any file exists in folder recursive or get lists of files
* [`getFiles()`](getfiles.md) - Get files inside directory non-recursive or recursive
* [`setChmod()`](setchmod.md) - Changes file mode
* [`setChmodRecursive()`](setchmodrecursive.md) - Changes file mode
* [`setChgrp()`](setchgrp.md) - Changes file group
* [`setChown()`](setchown.md) - Change file owner
* [`rename()`](rename.md) - Rename a file or folder
* [`getFileOwnerName()`](getfileownername.md) - Return info about a user by user id