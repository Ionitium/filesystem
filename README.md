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

* [`mkdir()`](docs/mkdir) - Create a directory
* [`touch()`](docs/touch) - Create a file or set access time
* [`touchWithoutOwnerSet()`](docs/touchWithoutOwnerSet) - Change a file state changed by owner
