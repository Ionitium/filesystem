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

__See TOC in `docs` directory__

### Filesystem

* `mkdir()` - Create a directory
* `touch()` - Create a file or set access time
* `touchWithoutOwnerSet()` - Change a file state changed by owner
* `touchAlternate()` - Touch a file using fopen
* `remove()` - Remove a file or folder from path
* `copy()` - Copy recursive file and folder
* `isExists()` - Check if file or directory exists
* `isExistsAnyFile()` - Check if any file exists in folder recursive or get lists of files
* `getFiles()` - Get files inside directory non-recursive or recursive
* `setChmod()` - Changes file mode
* `setChmodRecursive()` - Changes file mode separated by file chmod and directory chmod
* `setChgrp()` - Changes file group
* `setChown()` - Change file owner
* `rename()` - Rename a file or folder
* `getFileOwner()` - Return info about a user by user id
* `getFileOwnerName()` - Return info about a user by user id
* `getLastAccessTime()` - Get last access time of file
* `readFile()` - Read a file
* `writeFilePrepend()` - Prepend a data to a file
* `writeFileAppend()` - Append a data to a file
* `writeFile()` - Write a new file, overwrite if exists
* `createFileAndClose()` - Create a non-exists file then close
* `isWriteable()` - Tells whether the filename is writable
* `getGuid()` - Generate 128 bits of random data
* `emptyFile()` - Truncate a file
* `isSymbolicLink()` - Tells whether the filename is a symbolic link
* `uploadFile()` - Moves an uploaded file to a new location
* `createHardLink()` - Create a hard link
* `createSymbolicLink()` - Creates a symbolic link
* `getLinkTarget()` - Returns the target of a symbolic link
* `createFileAutoUnique()` - Create file with unique file name
* `createTemporaryFile()` - Creates a temporary file
* `readTemporaryFile()` - Read a data from create temporary file
* `removeTemporaryFile()` - Close temporary file
* `getLinkInfo()` - Gets information about a link
* `executeFileInBackground()` - Execute background process
* `getProcessSnapshot()` - Get a process
* `getTreeStructure()` - Get tree structure of file
* `getHexDump()` - Returns hexadecimal dumps from a file
* `getHexDump()` - Get checksum of file
* `getIncludedFiles()` - Get a lists of included files
* `getBasename()` - Get basename of the path

### FilesystemInfo

* `getStatRaw()` - Gives information about a file
* `getLastAccess()` - Gets last access time of file
* `getLastModification()` - Gets last modification time of file
* `getLastChanged()` - Gets inode change time of file, marks of last time
* `getFileInode()` - Gets file inode
* `getFileOwner()` - Gets file owner
* `getFilePermission()` - Gets file permissions
* `getFileSize()` - Get file size
* `getFileType()` - Gets file type
* `getHumanFileSize()` - Get human readable filesize
* `getFileGroup()` - Gets file group
* `getCountLines()` - Counts number lines of code
* `getDiskFreeSpace()` - Returns available space on filesystem or disk partition
* `getDiskTotalSpace()` - Returns the total size of a filesystem or disk partition
* `getDiskTotalUsage()` - Returns the total usage of disk filesystem
* `getPathInfo()` - Returns information about a file path
* `getMime()` - Return the mime type and encoding
* `getMimeType()` - Return the mime type
* `getMimeEncoding()` - Return the mime encoding
* `getMimeContentType()` - Detect MIME Content-type for a file
* `getInfoNone()` - Returns mime info global
* `getInfoDevices()` - Return information about a file
* `getInfoRaw()` - Returns raw information of file