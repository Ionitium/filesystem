<?php
/*
 * Ionitium - Full-stack PHP framework
 *
 * @package     Ionitium
 * @copyright   Copyright (C) 2015 with MIT license
 * @version     1.0.0
 * @author      Marin Sagovac <marin@sagovac.com>
 */
namespace Ionitium\Filesystem;

use Ionitium\Filesystem\FileNotFoundException;
use Exception;

/**
 * The filesystem info functions that return file info
 * 
 * @author Marin Sagovac <marin@sagovac.com>
 * @version 1.0.0
 */
class Filesysteminfo
{
    protected $source;
    
    public function __construct($source)
    {
        $this->source = $source;
    }
    
    /**
     * Gives information about a file
     * 
     * Stat from regular file (stat()) and symbolic link (lstat())
     * 
     * @param string $findkey Find a key from stat value as 'dev'
     * @return array|string
     */
    public function getStatRaw($findkey = '')
    {
        if (is_link($this->source)) {
            
            if ($findkey !== '') {
                $stat = lstat($this->source);
                return $stat[$findkey];
            }
            
            if ($findkey === '') {
                return lstat($this->source);
            } else {
                $stat = lstat($this->source);
                
                if ($stat) {
                    
                    foreach (array_keys($stat) as $key) {
                        if (is_string($key)) {
                            $statResponse[$key] = $stat[$key];
                        }
                    }
                    return $statResponse;
                }
                
                return $stat;
            }
            
        }
        
        if (file_exists($this->source) || is_dir($this->source)) {
            
            if ($findkey !== '') {
                $stat = stat($this->source);
                return $stat[$findkey];
            }
            
            if ($findkey === '') {
                return stat($this->source);
            } else {
                $stat = stat($this->source);
                
                if ($stat) {
                    
                    foreach (array_keys($stat) as $key) {
                        if (is_string($key)) {
                            $statResponse[$key] = $stat[$key];
                        }
                    }
                    return $statResponse;
                }
                
                return $stat;
            }
        } 
        
        return false;
    }
    
    /**
     * Gets last access time of file
     * 
     * Returns the unix timestamp the file was last accessed
     * Costly for very large of files
     * Time resolution may differ from one file system to another
     * 
     * @return int Returns unixtimestamp or false
     * @throws Exception Throws exception if not found a source
     */
    public function getLastAccess()
    {
        if (!file_exists($this->source)) {
            throw new Exception(sprintf("No file is defined"));
        }
        
        clearstatcache();
        
        return fileatime($this->source);
    }
    
    /**
     * Gets last modification time of file
     * 
     * Changes of data and inode
     * Returns the time when the data blocks of a file were being written
     * 
     * @return int Returns unixtimestamp or false
     * @throws Exception Throws if no file is defined
     */
    public function getLastModification()
    {
        if (!file_exists($this->source)) {
            throw new Exception(sprintf("No file is defined"));
        }
        
        return filemtime($this->source);
    }
    
    /**
     * Gets inode change time of file, marks of last time
     * 
     * Changes of permission
     * Use getLastModification() that is most suitable for changes
     * Use this for javascript in query "?" changes
     * 
     * @return int Returns unixtimestamp or false
     * @throws Exception
     */
    public function getLastChanged()
    {
        if (!file_exists($this->source)) {
            throw new Exception(sprintf("No file is defined"));
        }
        
        return filectime($this->source);
    }
    
    /**
     * Gets file inode
     * 
     * Compare is your current file with getmyinode() function identically
     * Works on directory
     * Alternative is stat["ino"]
     * 
     * @return int Returns inode number
     * @throws Exception Throws if no file defined
     */
    public function getFileInode()
    {
        if (!file_exists($this->source)) {
            throw new Exception(sprintf("No file is defined"));
        }
        
        return fileinode($this->source);
    }
    
    /**
     * Gets file owner
     * 
     * Returns file owner by user ID
     * 
     * @return int user ID owner file
     * @throws Exception Exception if file not found
     */
    public function getFileOwner($details = false, $key = '')
    {
        if (!file_exists($this->source)) {
            throw new Exception(sprintf("No file is defined"));
        }
        
        if ($details) {
            if ($key !== '') {
                $pgetpwuid = posix_getpwuid(fileowner($this->source));
                
                if (isset($pgetpwuid[$key]))
                {
                    return $pgetpwuid[$key];
                }
                else
                {
                    throw new Exception(sprintf("No key found on posix_getpwuid(): %s", $key));
                }
            }
            
            return posix_getpwuid(fileowner($this->source));
        }
        
        return fileowner($this->source);
    }
    
    /**
     * Gets file permissions
     * 
     * Show file permission in octal by default, 'full' is hexadecimal
     * 
     * @param octal|full $type A type of chmod
     * @return string|integer Returns chmod as octal or decimal as value
     */
    public function getFilePermission($type = 'octal')
    {
        clearstatcache();
        
        if ($type === 'octal') {  // ne radi dobro          
            return substr(sprintf('%o', fileperms($this->source)), -3);
            
        } else if ($type === 'full') {
            
            $perms = fileperms($this->source);
            
            if (($perms & 0xC000) == 0xC000) {
                    // Socket
                    $info = 's';
                } elseif (($perms & 0xA000) == 0xA000) {
                    // Symbolic Link
                    $info = 'l';
                } elseif (($perms & 0x8000) == 0x8000) {
                    // Regular
                    $info = '-';
                } elseif (($perms & 0x6000) == 0x6000) {
                    // Block special
                    $info = 'b';
                } elseif (($perms & 0x4000) == 0x4000) {
                    // Directory
                    $info = 'd';
                } elseif (($perms & 0x2000) == 0x2000) {
                    // Character special
                    $info = 'c';
                } elseif (($perms & 0x1000) == 0x1000) {
                    // FIFO pipe
                    $info = 'p';
                } else {
                    // Unknown
                    $info = 'u';
                }

                // Owner
                $info .= (($perms & 0x0100) ? 'r' : '-');
                $info .= (($perms & 0x0080) ? 'w' : '-');
                $info .= (($perms & 0x0040) ?
                            (($perms & 0x0800) ? 's' : 'x' ) :
                            (($perms & 0x0800) ? 'S' : '-'));

                // Group
                $info .= (($perms & 0x0020) ? 'r' : '-');
                $info .= (($perms & 0x0010) ? 'w' : '-');
                $info .= (($perms & 0x0008) ?
                            (($perms & 0x0400) ? 's' : 'x' ) :
                            (($perms & 0x0400) ? 'S' : '-'));

                // World
                $info .= (($perms & 0x0004) ? 'r' : '-');
                $info .= (($perms & 0x0002) ? 'w' : '-');
                $info .= (($perms & 0x0001) ?
                            (($perms & 0x0200) ? 't' : 'x' ) :
                            (($perms & 0x0200) ? 'T' : '-'));

        }
        
        return $info;
        
    }
    
    /**
     * Get file size
     * 
     * Print as byte filesize on integer value
     * For humanSize it will show decimals and filesize types
     * array_print returns as array types
     * 
     * @param bool $humanSize Show readbale filesize, default false
     * @param int $decimals Decimal separator, default 2
     * @param bool $array_print Print as array, default is print as string
     * @return string|array Return result
     * @throws Exception Throws if no file found
     */
    public function getFileSize($humanSize = false, $decimals = 2, $array_print = false)
    {
        clearstatcache();
        
        if (!file_exists($this->source)) {
            throw new Exception(sprintf("No file is defined"));
        }
        
        if ($humanSize) {
            return $this->getHumanFileSize(filesize($this->source), $decimals, $array_print);
        } else {
            return filesize($this->source);
        }
        
        return filesize($this->source);
    }
    
    /**
     * Gets file type
     * 
     * Get a file type as value or full regular name
     * 
     * @param bool $fullName Show full alias name of filetype
     * @return string Returns 'block', 'file', 'link',...
     * @throws Exception Throws if no file is defined
     */
    public function getFileType($fullName = false)
    {
        if (!file_exists($this->source)) {
            throw new Exception(sprintf("No file is defined"));
        }
        
        $filetypes = array(
            'block' => 'Block special device',
            'char' => 'Character special device',
            'dir' => 'Directory',
            'fifo' => 'FIFO (pipe)',
            'file' => 'Regular file',
            'link' => 'Symbolic link',
            'unknown' => 'Unknown File Type'
        );
        
        if ($fullName) {
            $response = filetype($this->source);
            return $filetypes[$response];
        }
        
        return filetype($this->source);
    }
    
    /**
     * Get human readable filesize
     * 
     * Get a human readable file size in decimals size or result as array
     * 
     * @param int $bytes A value on bytes
     * @param int $decimals A decimal point
     * @param bool $array_print Show as array
     * @return int|array Returns as integer on bytes or human filesize as '8.00 B' or array
     * @throws Exception Throws if no file is defined
     */
    public function getHumanFileSize($bytes, $decimals = 2, $array_print = false)
    {        
        if (!$bytes) {
            throw new Exception(sprintf("No filesize is defined"));
        }
        
        $size = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
        $factor = floor((strlen($bytes) - 1) / 3);
        
        if ($array_print) {
            return array(
                sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)),
                @$size[$factor]
            );
        }
        
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . ' ' . @$size[$factor];
    }
    
    /**
     * Gets file group
     * 
     * Get info about file group and owners
     * 
     * @return int Return user group ID
     * @throws Exception Throws if no file is defined
     */
    public function getFileGroup($details = false, $key = '')
    {
        if (!file_exists($this->source)) {
            throw new Exception(sprintf("No file is defined"));
        }
        
        if ($details || $key !== '') {
            if ($key !== '') {
                $pgetpwuid = posix_getgrgid(filegroup($this->source));
                
                if (isset($pgetpwuid[$key]))
                {
                    return $pgetpwuid[$key];
                }
                else
                {
                    throw new Exception(sprintf("No key found on posix_getgrgid(): %s", $key));
                }
            }
            
            return posix_getgrgid(filegroup($this->source));
        }
        
        return fileowner($this->source);
    }
    
    /**
     * Counts number lines of code
     * 
     * Counts a number lines of code in a file
     * 
     * @return int Returns number of lines
     * @throws Exception Throws if not file defined
     */
    public function getCountLines()
    {
        if (!file_exists($this->source) || !is_file($this->source)) {
            throw new Exception(sprintf("No file is defined"));
        }
        
        $handle = fopen($this->source, "r");
        $count = 0;
        while( fgets($handle) ) 
        {
            $count++;
        }
        fclose($handle);
        return $count;
    }
    
    /**
     * Returns available space on filesystem or disk partition
     * 
     * Return number of bytes available by filesystem or disk partition
     * 
     * @param bool $humanSize Show result in readable format
     * @param int $decimals Decimal separator size
     * @param bool $array_print Print as array in size and format size
     * @return array|string Returns data of disk free space
     */
    public function getDiskFreeSpace($humanSize = false, $decimals = 2, $array_print = false)
    {        
        if ($humanSize) {
            return $this->getHumanFileSize(disk_free_space($this->source), $decimals, $array_print);
        }
        
        return disk_free_space($this->source);
    }
    
    /**
     * Returns the total size of a filesystem or disk partition
     * 
     * Return total number of bytes of filesystem or disk partition
     * 
     * @param bool $humanSize Show result in readable format
     * @param int $decimals Decimal separator size
     * @param bool $array_print Print as array in size and format size
     * @return string Returns data of disk free space
     */
    public function getDiskTotalSpace($humanSize = false, $decimals = 2, $array_print = false)
    {
        if ($humanSize) {
            return $this->getHumanFileSize(disk_total_space($this->source), $decimals, $array_print);
        }
        
        return disk_total_space($this->source);
    }
    
    /**
     * Returns the total usage of disk filesystem
     * 
     * Return total number of bytes usage of filesystem
     * A result can irrelevant by filesystem
     * 
     * @param bool $humanSize Show result in readable format
     * @param int $decimals Decimal separator size
     * @param bool $array_print Print as array in size and format size
     * @return string Returns data of disk free space
     */
    public function getDiskTotalUsage($humanSize = false, $decimals = 2, $array_print = false)
    {
        $usage = (int)disk_total_space($this->source)-(int)disk_free_space($this->source);
        
        if ($humanSize) {
            return $this->getHumanFileSize($usage, $decimals, $array_print);
        }
        
        return $usage;
    }
    
    /**
     * Returns information about a file path
     * 
     * Note: Extension such as .ext.ext will reproduce as ext not .ext.ext
     * Works with UTF-8 filenames
     * Returns 'extensionall' if is multiple extensiion such as '.ext.ext'
     * 
     * @param string $type Search by type as 'dirname'
     * @return array|string Retruns array if not specified type or string as specified type
     * @throws Exception Throws if type is not specified correctly as dirname or source not exists
     */
    public function getPathInfo($type = null)
    {        
        $source = pathinfo($this->source);
        
        $source['extensionall'] = ltrim(strstr($this->source, '.'), '.');
        
        if (!is_null($type)) {
            if (!in_array($type, array('dirname', 'basename', 'filename', 'extensionall'))) {
                throw new Exception(sprintf('A type of path info should be "dirname" or "basename" or "filename" or "extension"'));
            }
            
            if (!isset($source[$type])) {
                throw new Exception(sprintf('A type %s does not exists in pathinfo()', $type));
            }
            
            return $source[$type];
        }
        
        return $source;
    }
    
    /**
     * Return the mime type and encoding
     * 
     * Returns mime type and mime encoding type specified by RFC 2045
     * 
     * @return string Returns mime encoding encoding and mime type
     * @throws Exception If not file defined throws exception
     */
    public function getMime()
    {
        if (!file_exists($this->source) || !is_file($this->source)) {
            throw new Exception(sprintf("No file is defined"));
        }
        
        return finfo_file(finfo_open(FILEINFO_MIME), $this->source);
    }
    
    /**
     * Return the mime type
     * 
     * Returns mime type
     * 
     * @return string Retruns mime type
     * @throws Exception If not file defined throws exception
     */
    public function getMimeType()
    {
        if (!file_exists($this->source) || !is_file($this->source)) {
            throw new Exception(sprintf("No file is defined"));
        }
        
        return finfo_file(finfo_open(FILEINFO_MIME_TYPE), $this->source);
    }
    
    /**
     * Return the mime encoding
     * 
     * Returns mime encoding of the file such as 'binary'
     * 
     * @return string Retruns mime encoding
     * @throws Exception If not file defined throws exception
     */
    public function getMimeEncoding()
    {
        if (!file_exists($this->source) || !is_file($this->source)) {
            throw new Exception(sprintf("No file is defined"));
        }
        
        return finfo_file(finfo_open(FILEINFO_MIME_ENCODING), $this->source);
    }
    
    /**
     * Detect MIME Content-type for a file
     * 
     * Returns the MIME content type using "magic.mime" file
     * 
     * @return string Returns mime type
     * @throws Exception If not file defined throws exception
     */
    public function getMimeContentType()
    {
        if (!file_exists($this->source) || !is_file($this->source)) {
            throw new Exception(sprintf("No file is defined"));
        }
        
        return mime_content_type($this->source);
    }
    
    /**
     * Returns mime info global
     * 
     * No special handling
     * 
     * @return string Return contents of blocks
     * @throws Exception If not file defined throws exception
     */
    public function getInfoNone()
    {
        if (!file_exists($this->source) || !is_file($this->source)) {
            throw new Exception(sprintf("No file is defined"));
        }
        
        return finfo_file(finfo_open(FILEINFO_NONE), $this->source);
    }
    
    /**
     * Return information about a file
     * 
     * Look at the contents of blocks or character special devices
     * 
     * @return string Return contents of blocks
     * @throws Exception If not file defined throws exception
     */
    public function getInfoDevices()
    {
        if (!file_exists($this->source) || !is_file($this->source)) {
            throw new Exception(sprintf("No file is defined"));
        }
        
        return finfo_file(finfo_open(FILEINFO_DEVICES), $this->source);
    }
    
    /**
     * Returns raw information of file
     * 
     * Returns detailed information of file using fileinfo handler
     * 
     * @return string Retrun contnets of information
     * @throws Exception If not file defined throws exception
     */
    public function getInfoRaw()
    {
        if (!file_exists($this->source) || !is_file($this->source)) {
            throw new Exception(sprintf("No file is defined"));
        }
        
        return finfo_file(finfo_open(FILEINFO_RAW), $this->source);
    }
}
