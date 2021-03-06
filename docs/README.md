# Filesystem

The `Filesystem` provides manage, access and retrieve information of file

## Installation

1. Installation via [Composer](http://www.composer.org) on [Packagist](http://www.packagist.com)
2. Installation using [Git](http://www.github.com) GIT clone component

## Prerequisities

PHP version requirements: _PHP >5.3_

PHP package requiremenets: php-xml or specified version (php5.6-xml, php7.0-xml, php7.1-xml)

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

| Version       | State                      |
| ------------- |:-------------------------- |
| `1.1`         | Work with PHP 5.6/7.0/7.1  |
| `1.0`         | Release version            |

PHP version above `5.3`.
Quality assurance: Unit tests provided

## Table of Contents

### Filesystem

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
* [`getFileOwner()`](getfileowner.md) - Return info about a user by user id
* [`getFileOwnerName()`](getfileownername.md) - Return info about a user by user id
* [`getLastAccessTime()`](getlastaccesstime.md) - Get last access time of file
* [`readFile()`](readfile.md) - Read a file
* [`writeFilePrepend()`](writefileprepend.md) - Prepend a data to a file
* [`writeFileAppend()`](writefileappend.md) - Append a data to a file
* [`writeFile()`](writefile.md) - Write a new file, overwrite if exists
* [`createFileAndClose()`](createfileandclose.md) - Create a non-exists file then close
* [`isWriteable()`](iswriteable.md) - Tells whether the filename is writable
* [`getGuid()`](getguid.md) - Generate 128 bits of random data
* [`emptyFile()`](emptyfile.md) - Truncate a file
* [`isSymbolicLink()`](issymboliclink.md) - Tells whether the filename is a symbolic link
* [`uploadFile()`](uploadfile.md) - Moves an uploaded file to a new location
* [`createHardLink()`](createhardlink.md) - Create a hard link
* [`createSymbolicLink()`](createsymboliclink.md) - Create a hard link
* [`getLinkTarget()`](getlinktarget.md) - Returns the target of a symbolic link
* [`createFileAutoUnique()`](createfileautounique.md) - Create file with unique file name
* [`createTemporaryFile()`](createtemporaryfile.md) - Creates a temporary file
* [`readTemporaryFile()`](readtemporaryfile.md) - Read a data from create temporary file
* [`removeTemporaryFile()`](removetemporaryfile.md) - Close temporary file
* [`getLinkInfo()`](getlinkinfo.md) - Gets information about a link
* [`executeFileInBackground()`](executefileinbackground.md) - Execute background process
* [`getProcessSnapshot()`](getprocesssnapshot.md) - Get a process
* [`getTreeStructure()`](gettreestructure.md) - Get tree structure of file
* [`getHexDump()`](gethexdump.md) - Returns hexadecimal dumps from a file
* [`getChecksum()`](getchecksum.md) - Get checksum of file
* [`getIncludedFiles()`](getincludedfiles.md) - Get a lists of included files
* [`getBasename()`](getbasename.md) - Get basename of the path
* [`readFileSeek()`](readfileseek.md) - Returns string from read file at specified line

### FilesystemInfo

* [`getStatRaw()`](getstatraw.md) - Gives information about a file
* [`getLastAccess()`](getlastaccess.md) - Gets last access time of file
* [`getLastModification()`](getlastmodification.md) - Gets last modification time of file
* [`getLastChanged()`](getlastchanged.md) - Gets inode change time of file, marks of last time
* [`getFileInode()`](getfileinode.md) - Gets file inode
* [`getFileOwner()`](getfileowner2.md) - Gets file owner
* [`getFilePermission()`](getfilepermission.md) - Gets file permissions
* [`getFileSize()`](getfilesize.md) - Get file size
* [`getFileType()`](getfiletype.md) - Gets file type
* [`getHumanFileSize()`](gethumanfilesize.md) - Get human readable filesize
* [`getFileGroup()`](getfilegroup.md) - Gets file group
* [`getCountLines()`](getcountlines.md) - Counts number lines of code
* [`getDiskFreeSpace()`](getdiskfreespace.md) - Returns available space on filesystem or disk partition
* [`getDiskTotalSpace()`](getdisktotalspace.md) - Returns the total size of a filesystem or disk partition
* [`getDiskTotalUsage()`](getdisktotalusage.md) - Returns the total usage of disk filesystem
* [`getPathInfo()`](getpathinfo.md) - Returns information about a file path
* [`getMime()`](getmime.md) - Return the mime type and encoding
* [`getMimeType()`](getmimetype.md) - Return the mime type
* [`getMimeEncoding()`](getmimeencoding.md) - Return the mime encoding
* [`getMimeContentType()`](getmimecontenttype.md) - Detect MIME Content-type for a file
* [`getInfoNone()`](getinfonone.md) - Returns mime info global
* [`getInfoDevices()`](getinfodevices.md) - Return information about a file
* [`getInfoRaw()`](getinforaw.md) - Returns raw information of file
