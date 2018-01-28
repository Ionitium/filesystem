<?php

namespace Ionitium\Http\Tests;

use Ionitium\Filesystem\Filesystem;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

/**
 * Filesystem unit test
 * 
 */
class FilesystemInfoTest extends \PHPUnit_Framework_TestCase
{
    protected $filesystemInfo;
    
    private $path;
    
    /**
     * Set temporary directory path
     * 
     * @param file $function
     * @return string
     */
    private static function getTempPath($function)
    {
        $filepath = sys_get_temp_dir().DIRECTORY_SEPARATOR.$function.'_'.mt_rand(time(), time()+time()).rand(1,5);
                
        return $filepath;
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $file = new Filesystem;
        
        $dir = static::getTempPath(__FUNCTION__);
        mkdir($dir);
        $filename = rand(1,10).rand(0, getrandmax());
        
        $this->path = $dir.DIRECTORY_SEPARATOR.$filename;
        touch($this->path);
        
        $this->filesystemInfo = $file->getFileSystemInfo($this->path);
        
    }
    
    /**
     * @test
     */
    public function testGetStatRaw()
    {
        $stat = $this->filesystemInfo->getStatRaw();
        
        $this->assertEquals(true, isset($stat['dev']));
        
        $this->assertEquals($stat['dev'], $this->filesystemInfo->getStatRaw('dev'));
        $this->assertEquals($stat['dev'], $this->filesystemInfo->getStatRaw('dev'));
    }
    
    /**
     * @test
     */
    public function testGetLastAccess()
    {
        $res = $this->filesystemInfo->getLastAccess();
        
        $stat = stat($this->path);
        
        $this->assertEquals($stat['atime'], $res);
    }
    
    /**
     * @test
     */
    public function testGetLastModification()
    {
        $res = $this->filesystemInfo->getLastModification();
        
        $stat = stat($this->path);
        
        $this->assertEquals($stat['mtime'], $res);
    }
    
    /**
     * @test
     */
    public function testGetLastChanged()
    {
        $res = $this->filesystemInfo->getLastChanged();
        
        $stat = stat($this->path);
        
        $this->assertEquals($stat['atime'], $res);
    }
    
    /**
     * @test
     */
    public function testGetFileInode()
    {
        $stat = stat($this->path);
        
        $this->assertEquals($stat['ino'], $this->filesystemInfo->getFileInode());
    }
    
    /**
     * @test
     */
    public function testGetFileOwner()
    {        
        $this->assertEquals(posix_geteuid(), $this->filesystemInfo->getFileOwner(false, 'gid'));
        $fileowner = $this->filesystemInfo->getFileOwner(true);
        
        $this->assertEquals(posix_geteuid(), $fileowner['gid']);
    }
    
    /**
     * @test
     */
    public function testGetFilePermission()
    {
        //$this->assertEquals(0644, $this->filesystemInfo->getFilePermission());
        
        chmod($this->path, 0666);
        $this->assertEquals(666, $this->filesystemInfo->getFilePermission());
        
        $this->assertEquals('-rw-rw-rw-', $this->filesystemInfo->getFilePermission('full'));
    }
    
    /**
     * @test
     */
    public function testGetFileSize()
    {
        $file = new Filesystem;
        $file->writeFile($this->path, null);
        
        file_put_contents($this->path, str_repeat('.', 8));
        
        $this->assertEquals('8.00 B', $this->filesystemInfo->getFileSize(true));
        $this->assertEquals('8.000 B', $this->filesystemInfo->getFileSize(true, 3));        
        $this->assertEquals(array('8.00', 'B'), $this->filesystemInfo->getFileSize(true, 2, true));
        $this->assertEquals((int)8, $this->filesystemInfo->getFileSize(false));
    }
    
    /**
     * @test
     */
    public function testGetFileType()
    {
        $this->assertEquals('file', $this->filesystemInfo->getFiletype());
        $this->assertEquals('Regular file', $this->filesystemInfo->getFiletype(true));
    }
    
    /**
     * @test
     */
    public function testGetHumanFileSize()
    {
        $this->assertEquals('8.00 B', $this->filesystemInfo->getHumanFileSize(8));
        $this->assertEquals('8.000 B', $this->filesystemInfo->getHumanFileSize(8, 3));
        $this->assertEquals(array('8.000', 'B'), $this->filesystemInfo->getHumanFileSize(8, 3, true));
    }
    
    /**
     * @test
     */
    public function testGetFileGroup()
    {
        $this->assertEquals(posix_getuid(), $this->filesystemInfo->getFileGroup());
        $res = $this->filesystemInfo->getFileGroup(true);
        $this->assertEquals(posix_getuid(), $res['gid']);
        $this->assertEquals(posix_getuid(), $this->filesystemInfo->getFileGroup(false, 'gid'));
    }
    
    /**
     * @test
     */
    public function testGetCountLines()
    {
        $fs = new Filesystem;
        
        $dir = static::getTempPath(__FUNCTION__);
        mkdir($dir);
        $filename = rand(1,10).rand(0, getrandmax());
        
        $file = $dir.DIRECTORY_SEPARATOR.$filename;
        touch($file);
        
        file_put_contents($file, '.'.PHP_EOL.PHP_EOL.PHP_EOL, FILE_APPEND);
        
        $this->assertEquals(3, $fs->getFileSystemInfo($file)->getCountLines());
    }
    
    /**
     * @test
     */
    public function testGetDiskFreeSpace()
    {
        $fs = new Filesystem;
        
        $this->assertEquals(disk_free_space(__DIR__), $fs->getFileSystemInfo(__DIR__)->getDiskFreeSpace());
    }
    
    /**
     * @test
     */
    public function testGetDiskTotalSpace()
    {
        $fs = new Filesystem;
        
        $this->assertEquals(disk_total_space(__DIR__), $fs->getFileSystemInfo(__DIR__)->getDiskTotalSpace());
    }
    
    /**
     * @test
     */
    public function testgetDiskTotalUsage()
    {
        $fs = new Filesystem;
        
        $comparediskspace = (int)disk_total_space(__FILE__)-(int)disk_free_space(__FILE__);
        
        $this->assertEquals($comparediskspace, $fs->getFileSystemInfo(__DIR__)->getDiskTotalUsage());
    }
    
    /**
     * @test
     */
    public function testGetPathInfo()
    {
        $pathinfo = $this->filesystemInfo->getPathInfo();
        
        $this->assertEquals(true, stristr($this->path, $pathinfo['dirname']) !== FALSE);
        $this->assertEquals($pathinfo['dirname'], $this->filesystemInfo->getPathInfo('dirname'));
    }
    
    /**
     * @test
     */
    public function testGetMime()
    {
        file_put_contents($this->path, '1');
        
        $this->assertEquals('application/octet-stream; charset=binary', $this->filesystemInfo->getMime());
    }
    
    /**
     * @test
     */
    public function testGetMimeType()
    {
        file_put_contents($this->path, '1');
        
        $this->assertEquals('application/octet-stream', $this->filesystemInfo->getMimeType());
    }
    
    /**
     * @test
     */
    public function testGetMimeEncoding()
    {
        file_put_contents($this->path, '1');
        
        $this->assertEquals('binary', $this->filesystemInfo->getMimeEncoding());
    }
    
    /**
     * @test
     */
    public function testGetMimeContentType()
    {
        file_put_contents($this->path, '1');
        
        $this->assertEquals('application/octet-stream', $this->filesystemInfo->getMimeContentType());
    }
    
    /**
     * @test
     */
    public function testGetInfoNone()
    {
        file_put_contents($this->path, '1');
        
        $this->assertEquals('very short file (no magic)', $this->filesystemInfo->getInfoNone());
    }
    
    /**
     * @test
     */
    public function testGetInfoDevices()
    {
        file_put_contents($this->path, '1');
        
        $this->assertEquals('very short file (no magic)', $this->filesystemInfo->getInfoDevices());
    }
    
    /**
     * @test
     */
    public function testGetInfoRaw()
    {
        file_put_contents($this->path, '1');
        
        $this->assertEquals('very short file (no magic)', $this->filesystemInfo->getInfoRaw());
    }
}
