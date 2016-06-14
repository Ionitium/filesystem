CHANGELOG
=========

1.0.0
-----

* initial Filesystem handler
* mkdir, touch, touchWithoutOwnerSet, touchAlternate, remove, copy, rename, readFile, removeFile
* writeFilePrepend, writeFile, emptyFile, uploadFile, executeFileInBackground
* ifExists, isExistsAnyFile, isDirectory, isWriteable, isSymbolicLink, 
* getFiles, getFileOwner, getLastAccessTime, getGuid, getLinkTarget, getLinkInfo, getProcessSnapshot, getTreeStructure, getHexDump, getChecksum
* setChmod, setChmodRecursive, setChgrp, setChown, 
* createFileAndClose, createHardLink, createSymbolicLink, createFileAutoUnique, createTemporaryFile
* getFileSystemInfo which includes: getStatRaw, getLastAccess, getLastModification, getLastChanged, getFileInode, getFileOwner, getFilePermission, getFileSize, getFileType, getHumanFileSize, getHumanFileSize, getCountLines, getDiskFreeSpace, getDiskTotalSpace, getDiskTotalUsage, getLinkInfo, getPathInfo, getMime, getMimeType, getMimeEncoding, getMimeContentType, getInfoNone, getInfoDevices, getInfoRaw