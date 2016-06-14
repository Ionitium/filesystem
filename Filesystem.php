<?php
/*
 * Ionitium - Full-stack PHP framework
 *
 * @package     Ionitium
 * @copyright   Copyright (C) 2015-2016 with MIT license
 * @version     1.0.0
 * @author      Marin Sagovac <marin@sagovac.com>
 */
namespace Ionitium\Filesystem;

use Ionitium\Filesystem\FileNotFoundException;
use Ionitium\Filesystem\Filesysteminfo;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use IteratorIterator;
use RecursiveTreeIterator;
use DirectoryIterator;
use Exception;

/**
 * The filesystem functions allows to access and use filesystem
 * 
 * @author Marin Sagovac <marin@sagovac.com>
 * @todo ini set file upload
 * @version 1.0.0
 */
class Filesystem 
{
    const UPLOAD_ERR_OK = 0;
    const UPLOAD_ERR_INI_SIZE = 1;
    const UPLOAD_ERR_FORM_SIZE = 2;
    const UPLOAD_ERR_NO_TMP_DIR = 6;
    const UPLOAD_ERR_CANT_WRITE = 7;
    const UPLOAD_ERR_EXTENSION = 8;
    const UPLOAD_ERR_PARTIAL = 3;
    
    // Most common chmod filters
    const CHMOD_OWNER_RW_OTHER_NONE = 0600;
    const CHMOD_600 = 0600;
    const CHMOD_755 = 0755;
    
    /**
     * Constructor
     */
    public function __construct() {}
    
    /**
     * Makes directory
     * 
     * Create a directory using chmod attribute and context
     * 
     * @param string $directory The directory path
     * @param int $mode Chmod mode
     * @param type $context Context stream
     * @return boolean
     * @throws \Exception Throws error on creating a directory
     * @throws \RuntimeException
     */
    public function mkdir($directory, $mode = 0755, $context = null)
    {
        if (!$directory) {
            throw new \Exception('Directory should be set');
        }
        
        if ($this->isExists($directory)) {
            return true;
        }
        
        if (!is_null($context)) {
            $context_res = $context;
        }
        
        if (stristr($directory, "/") || stristr($directory, "\\")) {
            if (stristr($directory, "\\")) {
                $mode = null;
            }
            $recursive = true;
        }
        else {
            $recursive = false;
        }
        
        if (!is_null($context)) {
            $result = @mkdir($directory, $mode, $recursive, $context);
        }
        else {
            $result = @mkdir($directory, $mode, $recursive);
        }
        
        @chmod($directory, $mode);
        
        if (!$result) {
            if (!is_dir($directory)) {
                throw new \RuntimeException(sprintf('Error on create directory: %s', $directory));
            }
        }
        
        return true;
    }
    
    /**
     * Create a file or set access time
     * 
     * Set access time or create a file
     * 
     * @param string $file Filepath
     * @param type $time Time in seconds (like time() + 3600) Default is current time
     * @param type $atime Set access time (fileatime)
     * @throws \RuntimeException Throws not modified a file
     */
    public function touch($file, $time = null, $atime = null)
    {
        if ($time || $atime) {
            
            if (is_null($time)) {
                $time = time();
            }
            
            if (!is_null($atime)) {
                $touch = touch($file, $time, $atime);
            } else {
                $touch = touch($file, $time);
            }
            
            
        } else {
            $touch = touch($file);
        }
        
        if (!$touch) {
            throw new \RuntimeException('Could not change a modification touch a file %s', $file);
        }
    }
    
    /**
     * Touch a file without change an owner
     * 
     * Change a file state that is changed by owner
     * 
     * @param string $file Filepath
     */
    public function touchWithoutOwnerSet($file)
    {
        @exec('touch '.escapeshellarg($file));
    }
    
    /**
     * Touch a file using file_put_contents
     * 
     * In some case if you can\'t use touch
     * 
     * @param string $file File destination
     * @throws \RuntimeException Throws if no files found
     */
    public function touchAlternate($file)
    {
        if (!file_exists($file)) {
            throw new \RuntimeException(sprintf('No file to handle touch %s', $file));
        }
        
        $fp = fopen($file, 'w+');
        fclose($fp);
    }
    
    /**
     * Remove a file or folder from path
     * 
     * Remove a file or directory, remove safe delete to overwrite a file
     * 
     * @param string $path Remove a file or folder
     * @param type $safedelete Overwrite to a file then delete
     * @throws \RuntimeException
     */
    public function remove($path, $safedelete = false)
    {
        if (!is_dir($path)) {
            if (!static::removeFile($path, $safedelete)) {
                throw new \RuntimeException(sprintf('Could not remove a file %s', $path));
            }
        } else {
            if (!@rmdir($path)) {
                throw new \RuntimeException(sprintf('Could not remove a folder %s', $path));
            }
        }
    }
    
    /**
     * Copy recursive file and folder
     * 
     * Options streamCopy or native copy
     * Use copy() by default
     * 
     * @param string $source Source filepath
     * @param type $destination Destination filepath
     * @param type $streamCopy Use stream_copy_to_stream() instead copy()
     */
    public function copy($source, $destination, $streamCopy = false)
    {
        if (!is_dir($source)) {
            throw new \RuntimeException(sprintf("No folder to copy from source %s", $source));
        }
        
        $dir = opendir($source);
        @mkdir($destination);
        
        while(false !== ( $file = readdir($dir)) ) {
            if (($file != '.') && ($file != '..')) {
                if ( is_dir($source . '/' . $file) ) {
                    $this->copy($source . '/' . $file,$destination . '/' . $file);
                }
                else {
                    if (!$streamCopy) {
                        copy($source . '/' . $file,$destination . '/' . $file);
                    } else {
                        $streamSource = @fopen($source. '/' . $file, 'r');
                        $streamDestination = @fopen($destination. '/' . $file, 'w+');

                        stream_copy_to_stream($streamSource, $streamDestination);

                        fclose($streamSource);
                        fclose($streamDestination);
                    }
                }
            }
        }
        
        closedir($dir); 
    }
    
    /**
     * Check if file or directory exists
     * 
     * Returns true if file_exists()
     * 
     * @param string $path A filepath
     * @return boolean Returns boolean if exists file or directory
     */
    public function isExists($path)
    {
        if (!file_exists($path)) {
            return false;
        }
        
        return true;
    }
    
    /**
     * Check if any file exists in folder recursive or get lists of files
     * 
     * Returns bool if exists any files or get an arrays lists files
     * 
     * @param string $directory A root of directory to find a files recursive
     * @param bool $return_files Show lists of files as array
     * @return bool|array
     */
    public function isExistsAnyFile($directory, $return_files = false)
    {
        $lists = array();
        
        if (is_dir($directory)) {
            $opendir = opendir($directory);
            if ($opendir) {
                foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory)) as $key=>$val)
                {
                    if ($val->isFile()) { 
                        if ($return_files) {
                            $lists[] = $val->getPathName();
                        } else {
                            closedir($opendir);
                            return true;
                        }
                    }
                }
                closedir($opendir);
                
                if ($return_files) {
                    return $lists;
                }
            }
        }
        
        return false;
    }
    
    /**
     * Get files inside directory non-recursive or recursive
     * 
     * Default is recursive find files
     * Returns only files available recursive or by root only
     * 
     * @param string $directory Set a path of scan directory
     * @param bool $recursive By default is true to search files recursive, false for root scan files only
     * @return string
     */
    public function getFiles($directory, $recursive = true) {
        
        if (is_dir($directory)) {
            
            $ds = DIRECTORY_SEPARATOR;
            
            $files_root = array();
            
            $root = scandir($directory);
            foreach ($root as $value)
            {
                if ($value === '.' || $value === '..') {
                    continue;
                }
                
                if (is_file("$directory".$ds."$value")) {
                    $result[] = "$directory/$value";
                    $files_root[] = "$directory/$value";
                    continue;
                }
                
                if ($recursive) {
                    foreach($this->getFiles("$directory".$ds."$value") as $value) {
                        $result[] = $value;
                    }
                }
            }
            
            if (!$recursive) {
                return $files_root;
            }
            
            return $result; 
            
        } else {
            return $directory;
        }        
    }
    
    /**
     * 
     * Check is directory exists with file permission to check is directory
     * 
     * checkbypermission is false by default, if is 'true' it will check fileperms
     * (0x4000) to check if is really directory by file pemission on unix
     * 
     * @param string $directory A directory to check if exists
     * @param bool $checkbypermission Use fileperms() to check is directory
     * @return bool
     */
    public function isDirectory($directory, $checkbypermission = false)
    {
        if (is_dir($directory)) {
            return true;
        }
        
        if ($checkbypermission) {
            if (@(fileperms("$directory") & 0x4000) == 0x4000) {
                return true;
            } else {
                return false;
            }
        }
        
        return false;
    }
    
    
    /**
     * Changes file mode
     * 
     * Set chmod for a pathname
     * 
     * @param string $path A pathname
     * @param int $mode Chmod decimal 0666 or octal 511 (0755) or "rwxsSxtT" type
     * @param bool $force If error chmod supress error
     * @param bool $skipOnFalse If error on chmod don't show error
     * @return boolean 
     * @throws \RuntimeException
     */
    public function setChmod($path, $mode, $force = true, $skipOnFalse = false)
    {
    
        if (preg_match('/^[drwxsStT\-]*$/i', $mode))
        {
            $permissions = $mode;
            $modeRes = 0;
            
            if ($permissions[1] == 'r') $modeRes += 0400;
            if ($permissions[2] == 'w') $modeRes += 0200;
            if ($permissions[3] == 'x') $modeRes += 0100;
            else if ($permissions[3] == 's') $modeRes += 04100;
            else if ($permissions[3] == 'S') $modeRes += 04000;

            if ($permissions[4] == 'r') $modeRes += 040;
            if ($permissions[5] == 'w') $modeRes += 020;
            if ($permissions[6] == 'x') $modeRes += 010;
            else if ($permissions[6] == 's') $modeRes += 02010;
            else if ($permissions[6] == 'S') $modeRes += 02000;

            if ($permissions[7] == 'r') $modeRes += 04;
            if ($permissions[8] == 'w') $modeRes += 02;
            if ($permissions[9] == 'x') $modeRes += 01;
            else if ($permissions[9] == 't') $modeRes += 01001;
            else if ($permissions[9] == 'T') $modeRes += 01000;
            
            $modeOutput = sprintf('%d', $modeRes);
        }
        else
        {
            if (!is_numeric($mode)) {
                throw new \Exception("Mode must be CHMOD defined as 644 or 666 integer value");
            }
            
            $modeOutput = $mode;
        }
        
        if (is_dir($path) || is_file($path))
        {            
            if ($force) {
                if (@chmod($path, $modeOutput)) {
                    return true;
                } else {
                    if (!$skipOnFalse) {
                        throw new \RuntimeException(sprintf("Not chmod a path %s in mode %s", $path, $mode));
                    }
                }
            }
            else {
                if (chmod($path, $modeOutput)) {
                    return true;
                } else {
                    if (!$skipOnFalse) {
                        throw new \RuntimeException(sprintf("Not chmod a path %s in mode %s", $path, $mode));
                    }
                }
            }
            
        }
        else
        {
            throw new \RuntimeException(sprintf("No file or folder in %s on mode", $path, $mode));
        }
    }
    
    /**
     * Changes file mode separated by file chmod and directory chmod
     * 
     * Set a chmod for file, link and directory recursive
     * 
     * @param string $path A pathname
     * @param int $modeFile Chmod a file decimal 0666 or octal 511 (0755) or "rwxsSxtT" type
     * @param int $modeDirectory Chmod a directory decimal 0666 or octal 511 (0755) or "rwxsSxtT" type
     * @param bool $force If error chmod supress error
     * @param bool $skipOnFalse If error on chmod don't show error
     * @return boolean 
     * @throws \RuntimeException
     */
    public function setChmodRecursive($path, $modeFile, $modeDirectory = null, $force = true, $skipOnFalse = false)
    {
        if (is_dir($path)) {
            
            $iter = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS),
                RecursiveIteratorIterator::SELF_FIRST,
                RecursiveIteratorIterator::CATCH_GET_CHILD // Ignore "Permission denied"
            );
            
            foreach ($iter as $val)
            {
                if ($val->isFile()) {
                    $this->setChmod($val->getPathName(), $modeFile, $force, $skipOnFalse);
                }
                if ($val->isDir()) {
                    $this->setChmod($val->getPathName(), $modeFile, $force, $skipOnFalse);
                }
            }            
        }
        else if (is_file($path))
        {
            $this->setChmod($path, $modeFile, $force, $skipOnFalse);
        }
        else
        {
            throw new \RuntimeException(sprintf("No file or folder in %s on mode file %s and directory %s", $path, $modeFile, $modeDirectory));
        }
    }
    
    /**
     * Changes file group
     * 
     * Change group of file and directory or a link
     * Set a group like name or GUID (ex: 1000)
     * 
     * @param string $path Path to the file
     * @param string $user A group name or number
     * @param bool $recursive Recursive set a group
     * @throws \RuntimeException
     */
    public function setChgrp($path, $user, $recursive = false)
    {
        if ($recursive)
        {
            $iter = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS),
                RecursiveIteratorIterator::SELF_FIRST,
                RecursiveIteratorIterator::CATCH_GET_CHILD // Ignore "Permission denied"
            );
            
            foreach ($iter as $val)
            {
                if (is_link($val->getPathName())) {
                    if (!lchgrp($path, $user)) {
                        throw new Exception(sprintf("Can not change file owner for link %s with user %s", $path, $user));
                    }
                } else if ($val->isFile()) {
                    if (!chgrp($path, $user)) {
                        throw new Exception(sprintf("Can not change file owner for file %s with user %s", $path, $user));
                    }
                }
            }     
        }
        else
        {
            if (is_link($path)) {
                if (!lchgrp($path, $user)) {
                    throw new Exception(sprintf("Can not change file owner for link %s with user %s", $path, $user));
                }
            } else if (is_file($path)) {
                if (!chgrp($path, $user)) {
                    throw new Exception(sprintf("Can not change file owner for file %s with user %s", $path, $user));
                }
            }
        }
        
        clearstatcache();
    }
    
    /**
     * Changes file owner
     * 
     * Change a file owner to filepath
     * 
     * @param string $path Path to the file
     * @param string $user A file owner name or number UID
     * @param bool $recursive Recursive set a group
     * @throws \RuntimeException
     */
    public function setChown($path, $user, $recursive = false)
    {
        if ($recursive)
        {
            $iter = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS),
                RecursiveIteratorIterator::SELF_FIRST,
                RecursiveIteratorIterator::CATCH_GET_CHILD // Ignore "Permission denied"
            );
            
            foreach ($iter as $val)
            {                
                if (is_link($val->getPathName())) {
                    if (!@lchown($path, $user)) {
                        throw new \Exception(sprintf("Can not change file owner for link %s with user %s", $path, $user));
                    }
                } else if ($val->isFile()) {                    
                    if (!@chown($path, $user)) {
                        throw new \Exception(sprintf("Can not change file owner for file %s with user %s", $path, $user));
                    }
                }
            }     
        }
        else
        {
            if (is_link($path)) {
                if (!lchown($path, $user)) {
                    throw new Exception(sprintf("Can not change file owner for link %s with user %s", $path, $user));
                }
            } else if (is_file($path)) {
                if (!chown($path, $user)) {
                    throw new Exception(sprintf("Can not change file owner for file %s with user %s", $path, $user));
                }
            }
        }
    }
    
    /**
     * Rename a file or folder
     * 
     * @param string $from A filepath remove
     * @param string $to A new filename
     * @throws \RuntimeException A throw of failed to rename()
     */
    public function rename($from, $to)
    {
        if (!rename($from, $to)) {
            throw new \RuntimeException(sprintf("Failed to rename from %s to %s", $from, $to));
        }
    }
    
    /**
     * Return info about a user by user id
     * 
     * Return as owner id
     * 
     * @param string $file A pathname
     * @return bool Returns name of the name 
     */
    public function getFileOwner($file)
    {
        $uid = stat($file);
        
        return posix_getpwuid($uid['uid']);
    }
    
    /**
     * Return info about a user name
     * 
     * Return as owner user
     * 
     * @param string $file A pathname
     * @return string Returns file owner name
     */
    public function getFileOwnerName($file)
    {
        $uid = stat($file);
        
        $posix = posix_getpwuid($uid['uid']);
        
        return $posix['name'];
    }
    
    /**
     * Gets last access time of file
     * 
     * Return as unix timestamp
     * 
     * @param string $file A pathname
     * @return int Returns unix timestamp
     * @throws RuntimeException Exception that not file exists
     */
    public function getLastAccessTime($file)
    {
        if (!file_exists($file)) {
            throw new \RuntimeException(sprintf("No file on %s", $file));
        }
        
        return fileatime($file);
    }
    
    /**
     * Read a file
     * 
     * Read a file using fopen as regular or binary mode, buffer can change
     * 
     * @param string $file File path
     * @param bool $binary By default false is not set to binary
     * @param int $length A length of buffer reading a file, default 4096
     * @return string Returns a data form a readed file
     * @throws RuntimeException
     */
    public function readFile($file, $binary = false, $length = 4096)
    {
        if (is_dir($file)) {
            throw new \RuntimeException(sprintf("Cannot read file should not be folder", $file));
        }
        
        if (is_link($file)) {
            throw new \RuntimeException(sprintf("Cannot read file should not be symbolic link", $file));
        }
        
        if (!file_exists($file)) {
            throw new \RuntimeException(sprintf("A file %s does not exists", $file));
        }
        
        if (!is_readable($file)) {
            throw new \RuntimeException(sprintf("A file %s can not read", $file));
        }
        
        if ($binary) {
            $fp = fopen($file, "rb");
        } else {
            $fp = fopen($file, "r");
        }
        
        if (!$fp) {
            throw new \RuntimeException(sprintf("A file cannot open using fopen() %s", $file));
        }
        
        $curr = false;
        while (($current_line = fgets($fp)) !== false) {
            $curr .= $current_line;
        }
        
        fclose($fp); 
        
        return $curr;
    }
    
    /**
     * Prepend a data to a file
     * 
     * @param string $file File path
     * @param string $content Content to prepend
     * @param int $buffer Buffer in bytes, default 512 bytes
     */
    public function writeFilePrepend($file, $content, $buffer = 512)
    {
        $fhandle = fopen($file, 'r');
        $read = null;
        $fhandlePrepend = fopen($file.'_prepend', 'w');
        fwrite($fhandlePrepend, $content);
        while (!feof($fhandle)) {
            $read .= fread($fhandle, $buffer);
            fwrite($fhandlePrepend, $read);
        }
        fclose($fhandle);
        fclose($fhandlePrepend);
        unlink($file);
        clearstatcache();
        rename($file.'_prepend', $file);
    }
    
    /**
     * Append a data to a file
     * 
     * If file not exists it will create
     * 
     * @param string $file File path
     * @param string $content Content to9 append end of file
     * @param int $buffer Buffer in bytes, default 512 bytes
     */
    public function writeFileAppend($file, $content, $buffer = 512)
    {
        $fhandle = fopen($file, 'a+');
        
        fwrite($fhandle, $content);
        fclose($fhandle);
    }
    
    /**
     * Write a new file, overwrite if exists
     * 
     * Writing only. If exists, truncate content
     * 
     * @param string $file File path
     * @param string $content Content
     * @param int $buffer Buffer in bytes, default 512 bytes
     */
    public function writeFile($file, $content, $buffer = 512)
    {
        $fhandle = fopen($file, 'c');
        
        fwrite($fhandle, $content);
        fclose($fhandle);
    }
    
    /**
     * Create a non-exists file then close
     * 
     * Create a file if not exists, open read-only mode and close a file
     * 
     * @param string $file File path
     * @return boolean Returns if action executed successfully
     */
    public function createFileAndClose($file)
    {
        if (!is_file($file)) {
            fclose(fopen($file, 'x'));
            return true;
        } else return false;
    }
    
    /**
     * Tells whether the filename is writable
     * 
     * @param type $filename A filepath
     * @return boolean Returns is writeable
     * @throws RuntimeException Throw exception if is not writeable or exists a file
     */
    public function isWriteable($filename)
    {
        if (!file_exists($filename)) {
            throw new \RuntimeException(sprintf("A file cannot find %s", $filename));
        }
        
        if (!is_writable($filename)) {
            throw new \RuntimeException(sprintf("A file cannot find %s", $filename));
        } else {
            return true;
        }
    }
    
    /**
     * FileSystem class
     * 
     * Instance FilesystemInfo
     * 
     * @param type $source A filepath
     * @return Filesysteminfo object
     */
    public function getFileSystemInfo($source)
    {
        return new Filesysteminfo($source);
    }
    
    /**
     * Generate 128 bits of random data
     * 
     * Generate truly random 128 bit random data in a form xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx
     * 
     * @see http://tools.ietf.org/html/rfc4122#section-4.4
     * @return string
     */
    public function getGuid()
    {
        $data = openssl_random_pseudo_bytes(16);
        $data[6] = chr( ord( $data[6] ) & 0x0f | 0x40 ); // set version to 0100
        $data[8] = chr( ord( $data[8] ) & 0x3f | 0x80 ); // set bits 6-7 to 10

        return vsprintf( '%s%s-%s-%s-%s-%s%s%s', str_split( bin2hex( $data ), 4 ) );
    }
    
    /**
     * Truncate a file
     * 
     * Truncate using ftruncate() function
     * 
     * @param string $file A filename
     */
    public function emptyFile($file)
    {
        if (!file_exists($file)) {
            throw new \Exception(sprintf('No file exists %s', $file));
        }
        
        $handle = fopen($file, 'r+');
        ftruncate($handle, 0);
        fclose($handle);
    }
    
    /**
     * Tells whether the filename is a symbolic link
     * 
     * Check is filepath symbolic link
     * 
     * @param string $source A symbolic path
     * @return bool Is symbolic link
     * @throws Exception If no exists file or directory
     */
    public function isSymbolicLink($source)
    {        
        if (!file_exists($source) || is_dir($source)) {
            throw new \Exception(sprintf('No source is path is defined or is not a file %s', $source));
        }
        
        return is_link($source);
    }
    
    /**
     * Moves an uploaded file to a new location
     * 
     * Move a filepath to destination. If overwrite is set to true by default,
     * it will rewrite uploaded destination file
     * 
     * @param string $filename The filename of the uploaded file
     * @param string $destination The destination of the moved file 
     * @param bool $overwrite If exists skip overwrite
     * @return boolean If exists returns true if exists otherwise move upload file boolean state
     */
    public function uploadFile($filename, $destination, $overwrite = true)
    {
        if (!$overwrite) {
            if (file_exists($destination)) {
                return true;
            }
        }
        
        return move_uploaded_file($filename, $destination);
    }
    
    /**
     * Create a hard link
     * 
     * Create identically link from source. linkinfo() returns 2049 link state
     * 
     * @param string $source Target of the link
     * @param string $target The link name
     * @return boolean Returns link() state
     * @throws Exception If not exists a file or is directory throws error
     */
    public function createHardLink($source, $target)
    {
        if (!file_exists($source) || is_dir($source)) {
            throw new \Exception(sprintf('No source is path is defined %s', $source));
        }
        
        return link($source, $target);
    }
    
    /**
     * Creates a symbolic link
     * 
     * Create soft link, a symbolic link from source to target
     * 
     * @param string $source Target of the link
     * @param string $link The link name
     * @return boolean Retruns if symlink created
     */
    public function createSymbolicLink($source, $link)
    {        
        if (is_link($link) && is_file($link)) {
            throw new Exception(sprintf("A symbolic link is already set %s", $link));
        }
        
        return symlink($source, $link);
    }
    
    /**
     * Returns the target of a symbolic link
     * 
     * Returns the target filepath of symbolic or hard link
     * 
     * @return boolean Returns filepath
     */
    public function getLinkTarget($path)
    {
        return readlink($path);
    }
    
    /**
     * Create file with unique file name
     * 
     * Create a temporary file automatically into temporary directory with/without content.
     * Can be setup a prefix into filename of temporary file
     * 
     * @param string $directory Directory to crate temporary path, if not set use sys_get_temp_dir like "/tmp"
     * @param string $prefix The prefix generated in filename
     * @param string $content The content in a path
     * @return string Returns a filename
     */
    public function createFileAutoUnique($directory = null, $prefix = null, $content = '')
    {
        if (is_null($directory)) {
            $directory = sys_get_temp_dir();
        }
        
        $tmpfname = tempnam($directory, $prefix);

        if ($content !== null) {
            $handle = fopen($tmpfname, "w");
            fwrite($handle, $content);
            fclose($handle);
        }
        
        return $tmpfname;
    }
    
    /**
     * Creates a temporary file
     * 
     * Create a temporary file with/without content.
     * Creates a temporary file with a unique name in read-write (w+) mode.
     * 
     * @param string $content A content file into temporary file
     * @return string A filepath of temporary file
     */
    public function createTemporaryFile($content = null)
    {
        $tempfile = tmpfile();
        
        //$metaDatas = stream_get_meta_data($tempfile);
        
        fwrite($tempfile, $content);
        fseek($tempfile, 0);
        $tempdata = $tempfile;
        
        return $tempdata;
    }
    
    /**
     * Read a data from create temporary file
     * 
     * Use createTemporaryFile() to create a file
     * 
     * @param resource $resource A resource from createTemporaryFile()
     * @return resource Return a resource
     */
    public function readTemporaryFile($resource)
    {
        $contents = '';
        
        while (!feof($resource)) {
            $contents .= fread($resource, 8192);
        }   
        
        return $contents;
    }
    
    /**
     * Close temporary file
     * 
     * fclose() automatically delete a temporary file
     * 
     * @param resource $resource A resource from createTemporaryFile()
     * @return resource Return a resource
     */
    public function removeTemporaryFile($resource)
    {
        return fclose($resource);
    }
    
    /**
     * Gets information about a link
     * 
     * ID of device containing file,
     * Verify link of filepath
     * It use S_ISLNK(st_mode) or is it a symbolic link
     * 
     * @param string $path A filepath
     * @return stdev field|false
     */
    public function getLinkInfo($path)
    {
        return linkinfo($path);
    }
    
    /**
     * Execute background process
     * 
     * Execute console/command process in a background system
     * 
     * @param string $command Command system script
     * @return boolean Execute function
     * @throws Exception A command is not set
     */
    public function executeFileInBackground($command)
    {
        if (!$command) {
            throw new Exception(sprintf('A command is not defined. Please set a command'));
        }
        
        if (substr(php_uname(), 0, 7) == "Windows") {
            pclose(popen("start /B ". $command, "r")); 
        } else {
            exec($command . " > /dev/null &");
        }
        
        return true;
    }
    
    /**
     * Get a process
     * 
     * Get a process using 'ps'
     * Uses from executeFileInBackground() function
     * 
     * @return array Array of process
     */
    public function getProcessSnapshot()
    {
        $fp=popen("/bin/ps -waux", "r");
        $croninf = array();
        while (!feof($fp)) {
            $buffer = fgets($fp, 4096);
            $croninf[] = trim($buffer);
        }
        pclose($fp);
        return $croninf;
    }
    
    /**
     * Get tree structre of file
     * 
     * Iterate a folder with arrays data as nested-tree
     * 
     * @param type $directory A directory filepath
     * @return array Returns as array iterator of directory
     */
    public function getTreeStructure($directory, $depth = 0)
    {        
        $iterator = new IteratorIterator(new DirectoryIterator($directory));

        $r = array();
        foreach ($iterator as $splFileInfo) {

            if ($splFileInfo->isDot()) {
                continue;
            }
            
            $info = array('file' =>
                $splFileInfo->getFilename()
            );

            
            if ($splFileInfo->isDir()) {
                
                $nodes = $this->getTreeStructure($splFileInfo->getPathname(), $depth + 1);
                
                if (!empty($nodes)) {
                    $info['folder'] = $nodes;
                }
            }
            
            $r[] = $info;
        }
        
        return $r;
    }
    
    /**
     * Return HEX dumps from a file
     * 
     * @param type $path Filename path
     * @return array Returns arrays: Hex dumps, od (octal dumps), ASCII
     */
    public function getHexDump($path)
    {
        $c = $this->readFile($path);
        
        if (!$c) {
            throw new \Exception(sprintf('Can not read a file %s', $path));
        }
        
        $n = 0;
        $h = array('00000000'.PHP_EOL,'','');
        $len = strlen($c);
        for ($i=0; $i<$len; ++$i) {
                $h[1] .= sprintf('%02X',ord($c[$i])).' ';
                switch ( ord($c[$i]) ) {
                        case 0:  $h[2] .= ' '; break;
                        case 9:  $h[2] .= ' '; break;
                        case 10: $h[2] .= ' '; break;
                        case 13: $h[2] .= ' '; break;
                        default: $h[2] .= $c[$i]; break;
                }
                $n++;
                if ($n == 32) {
                        $n = 0;
                        if ($i+1 < $len) {$h[0] .= sprintf('%08X',$i+1).PHP_EOL;}
                        $h[1] .= PHP_EOL;
                        $h[2] .= PHP_EOL;
                }
        }
        
        return $h;
    }
    
    /**
     * Get cheksum of file
     * 
     * List of type attributes:
     * md5 - md5 cheksum hash (alternative is md5sum unix command) (length 32bit)
     * md5raw - md5 hash digest raw binary cheksum (length 16bit)
     * md5raw128 - md5 raw 128bit hash
     * sha1 - sha1 hash
     * sha1raw - sha1 hash raw binary cheksum (length 20bit)
     * crc32 - polynomial 32bit length
     * 
     * @param type $filename Filename
     * @param type $type md5
     * @return boolean|false
     */
    public function getChecksum($filename, $type = 'md5')
    {
        if (!file_exists($filename)) {
            throw new Exception(sprintf("A filename %w does not exists", $filename));
        }
        
        switch ($type)
        {
            case 'md5':
                return md5_file($filename);
                break;
            case 'md5raw':
                return md5_file($filename, true);
                break;
            case 'md5raw128':
                return pack("H*",md5_file($filename));
                break;
            case 'sha1':
                return sha1_file($filename);
                break;
            case 'sha1raw':
                return sha1_file($filename, true);
                break;
            case 'crc32':
                return sprintf('%u', crc32(file_get_contents($filename)));
                break;
        }
        
        return false;
    }
    
    /**
     * Returns an array with the names of included or required files
     * 
     * Returns array of names from include()/require()/include_once()/require_once()
     * 
     * @return array
     */
    public function getIncludedFiles()
    {
        return get_included_files();
    }
    
    /**
     * Get basename of the path
     * 
     * Get basename filepath
     * 
     * @param string $path Filepath
     * @return string Basename filepath
     */
    public function getBasename($path)
    {    
        $ds = DIRECTORY_SEPARATOR;
        
        if (empty($path)) {
            return (string)'';
        }
        
        if ($path === '.' || $path === $ds) {
            return basename($path);
        }
        
        $info = pathinfo($path);
        return basename($path);
    }
    
    
    
    /**
     * Static method to unlink a file internally
     * 
     * @param type $file File path
     * @param type $safedelete Safer remove and overwrite past data
     * @return boolean
     */
    private static function removeFile($file, $safedelete = false)
    {    
        if ($safedelete) {
            
            if (!file_exists($file)) {
                return true;
            }
            
            $filesize = filesize($file);
            $patterns = array(chr(0), chr(255), chr(170), chr(85));
            
            foreach ($patterns as $chr)
            {
                $mask = str_repeat($chr, $filesize);
                $fhandle = fopen($file, 'w');
                fwrite($fhandle, $mask);
                fclose($fhandle);
            }   
        }
        
        if (!@unlink($file)) {
            return false;
        }
        
        return true;   
    }
}
