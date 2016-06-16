<?php

namespace Ionitium\Http\Tests;

use Ionitium\Filesystem\Filesystem;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

/**
 * Filesystem unit test
 * 
 */
class FilesystemTest extends \PHPUnit_Framework_TestCase
{
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
    
    private static function getCurrentOwner()
    {
        $getpwuid = posix_getpwuid(posix_geteuid());
        
        return $getpwuid['name'];
    }
    
    /**
     * At end of test clean up
     */
    public function __destruct()
    {
        
    }
    
    /**
     * @test
     */
    public function testMkdir()
    {
        $file = new Filesystem;
        
        $path = static::getTempPath(__FUNCTION__);
        
        $this->assertEquals(true, $file->mkdir($path));
        $this->assertEquals(true, is_dir($path));
    }
    
    /**
     * @test
     */
    public function testMkdirChmod()
    {        
        $file = new Filesystem;
        $dir_path = static::getTempPath(__FUNCTION__);
        
        $this->assertEquals(true, $file->mkdir($dir_path, 0755));
        
        $file_permission = $file->getFileSystemInfo($dir_path)->getFilePermission('octal');
        $this->assertEquals('0755', $file_permission);
        
        $file_permission = $file->getFileSystemInfo($dir_path)->getFilePermission('full');
        $this->assertEquals('drwxr-xr-x', $file_permission);
        
        $dir_path = static::getTempPath(__FUNCTION__);
        $this->assertEquals(true, $file->mkdir($dir_path, 0666));
        
        $file_permission = $file->getFileSystemInfo($dir_path)->getFilePermission('octal');
        $this->assertEquals('0666', $file_permission);
        
        $file_permission = $file->getFileSystemInfo($dir_path)->getFilePermission('full');
        $this->assertEquals('drw-rw-rw-', $file_permission);
        
        $dir_path = static::getTempPath(__FUNCTION__);
        $this->assertEquals(true, $file->mkdir($dir_path, 0644));
        
        $file_permission = $file->getFileSystemInfo($dir_path)->getFilePermission('octal');
        $this->assertEquals('0644', $file_permission);
        
        $file_permission = $file->getFileSystemInfo($dir_path)->getFilePermission('full');
        $this->assertEquals('drw-r--r--', $file_permission);
    }
    
    /**
     * @test
     */
    public function testTouch()
    {
        $file = new Filesystem;
        $path = static::getTempPath(__FUNCTION__);
        
        $this->assertFileExists($path, $file->touch($path));
        
        // access time
        
        $current_time = time();
        $path = static::getTempPath(__FUNCTION__);
        $file->touch($path, null, $current_time+3600);
        $accesstime = $file->getFileSystemInfo($path)->getLastAccess();
        $this->assertEquals($current_time+3600, $accesstime);
    }
    
    /**
     * @test
     */
    public function testTouchWithoutOwnerSet()
    {
        $file = new Filesystem;
        $dir_path = static::getTempPath(__FUNCTION__);
        
        $this->assertFileExists($dir_path, $file->touchWithoutOwnerSet($dir_path));
        
        $file_owner = $file->getFileOwnerName($dir_path);
        
        $file->touchWithoutOwnerSet($dir_path);
        
        $file_owner2 = $file->getFileOwnerName($dir_path);
        
        $this->assertEquals($file_owner, $file_owner2);
    }
    
    /**
     * @test
     */
    public function testTouchAlternate()
    {
       $file = new Filesystem;
       $path = static::getTempPath(__FUNCTION__);
       
       $file->touch($path);
       
       $this->assertFileExists($path, $file->touchAlternate($path));
    }
    
    /**
     * @test
     */
    public function testRemove()
    {
       $file = new Filesystem;
       
       $path = static::getTempPath(__FUNCTION__);
       $this->assertFileExists($path, $file->touch($path));
       $this->assertFileNotExists($path, $file->remove($path));
       
       $path = static::getTempPath(__FUNCTION__);
       $this->assertFileExists($path, $file->touch($path));
       $this->assertFileNotExists($path, $file->remove($path, true));
    }
    
    /**
     * @test
     */
    public function testCopy()
    {
        $file = new Filesystem;
        
        $dir = static::getTempPath(__FUNCTION__);
        $dir_inner = rand(1,10).rand(0, getrandmax());
        
        $file->mkdir($dir);
        $file->touch($dir.DIRECTORY_SEPARATOR.$dir_inner);
        $file->copy($dir, $dir.'_copy');
        $this->assertFileExists($dir.'_copy'.DIRECTORY_SEPARATOR.$dir_inner, $dir.DIRECTORY_SEPARATOR.$dir_inner);
        
        // Stream copy
        $dir = static::getTempPath(__FUNCTION__);
        $dir_inner = rand(1,10).rand(0, getrandmax());
        $file->mkdir($dir);
        $file->touch($dir.DIRECTORY_SEPARATOR.$dir_inner);
        $file->copy($dir, $dir.'_copy', true);
        $this->assertFileExists($dir.'_copy'.DIRECTORY_SEPARATOR.$dir_inner, $dir.DIRECTORY_SEPARATOR.$dir_inner);
    }
    
    /**
     * @test
     */
    public function testIsExists()
    {
        $file = new Filesystem;
        
        $path = static::getTempPath(__FUNCTION__);
        $file->touch($path);
        $this->assertEquals(true, $file->isExists($path));
    }
    
    /**
     * @test
     */
    public function testIsExistsAnyFile()
    {
        $file = new Filesystem;
        
        $dir = static::getTempPath(__FUNCTION__);
        $file_inner = rand(1,10).rand(0, getrandmax());
        
        $file->mkdir($dir);
        $this->assertEquals(false, $file->isExistsAnyFile($dir));
        $file->touch($dir.DIRECTORY_SEPARATOR.$file_inner);
        $this->assertEquals(true, $file->isExistsAnyFile($dir));
    }
    
    /**
     * @test
     */
    public function testIsExistsAnyFileReturnArrays()
    {
        $file = new Filesystem;
        
        $dir = static::getTempPath(__FUNCTION__);
        $file_inner = rand(1,10).rand(0, getrandmax());
        
        $file->mkdir($dir);
        $this->assertTrue(empty($file->isExistsAnyFile($dir, true)));
        $file->touch($dir.DIRECTORY_SEPARATOR.$file_inner);
        $this->assertTrue(is_array($file->isExistsAnyFile($dir, true)));
    }
    
    /**
     * @test
     */
    public function testGetFiles()
    {
        $file = new Filesystem;
        
        $dir = static::getTempPath(__FUNCTION__);
        $file_inner = rand(1,10).rand(0, getrandmax());
        $file_inner2 = rand(1,10).rand(0, getrandmax());
        $dir_inner1 = rand(1,10).rand(0, getrandmax());
        
        $file->mkdir($dir);
        $file->touch($dir.DIRECTORY_SEPARATOR.$file_inner);
        $file->touch($dir.DIRECTORY_SEPARATOR.$file_inner2);
        
        $file->mkdir($dir.DIRECTORY_SEPARATOR.$dir_inner1.DIRECTORY_SEPARATOR.'innerdir');
        $file->touch($dir.DIRECTORY_SEPARATOR.$dir_inner1.DIRECTORY_SEPARATOR.'innerdir'.DIRECTORY_SEPARATOR.'innerfile');
        
        $this->assertFileExists($dir.DIRECTORY_SEPARATOR.$file_inner, $file->getFiles($file_inner, false));
        $this->assertFileExists($dir.DIRECTORY_SEPARATOR.$file_inner2, $file->getFiles($file_inner2, false));
        
        $scandir = $file->getFiles($dir, true);
        
        foreach ($scandir as $files) {
            $this->assertFileExists($files);
        }
    }
    
    /**
     * @test
     */
    public function testIsDirectory()
    {
        $file = new Filesystem;
        
        $dir = static::getTempPath(__FUNCTION__);
        $dir_inner = rand(1,10).rand(0, getrandmax());
        
        $directoryScan = $dir.DIRECTORY_SEPARATOR.$dir_inner;
        
        $file->mkdir($directoryScan);
        
        $this->assertEquals(true, $file->isDirectory($directoryScan));
        $this->assertEquals(true, $file->isDirectory($directoryScan, true));
    }
    
    /**
     * @test
     */
    public function testSetChmod()
    {
        $file = new Filesystem;
        
        // Test 0755
        $dir = static::getTempPath(__FUNCTION__);
        $file1 = rand(1,10).rand(0, getrandmax());
        $filepath1 = $dir.DIRECTORY_SEPARATOR.$file1;
        mkdir($dir);
        file_put_contents($filepath1, __FUNCTION__, FILE_APPEND);
        
        $this->assertEquals(true, $file->setChmod($filepath1, 0755));
        $this->assertEquals(755, $file->getFileSystemInfo($filepath1)->getFilePermission());
        
        // Test 0644
        $dir2 = static::getTempPath(__FUNCTION__);
        $file2 = rand(1,10).rand(0, getrandmax());
        $filepath2 = $dir2.DIRECTORY_SEPARATOR.$file2;
        mkdir($dir2);
        file_put_contents($filepath2, __FUNCTION__, FILE_APPEND);
        
        $this->assertEquals(true, $file->setChmod($filepath2, 0644));
        $this->assertEquals(644, $file->getFileSystemInfo($filepath2)->getFilePermission());
        
        
        // CHMOD 0755
        $dir3 = static::getTempPath(__FUNCTION__);
        $file3 = rand(1,10).rand(0, getrandmax());
        $filepath3 = $dir3.DIRECTORY_SEPARATOR.$file3;
        mkdir($dir3);
        file_put_contents($filepath3, __FUNCTION__, FILE_APPEND);
        $file->setChmod($filepath3, 0755);
        
        $this->assertEquals(755, $file->getFileSystemInfo($filepath3)->getFilePermission());
        
        // CHMOD 511 octal
        $dir4 = static::getTempPath(__FUNCTION__);
        $file4 = rand(1,10).rand(0, getrandmax());
        $filepath4 = $dir4.DIRECTORY_SEPARATOR.$file4;
        mkdir($dir4);
        file_put_contents($filepath4, __FUNCTION__, FILE_APPEND);
        // those `511` is octal as `0777`. `511` is octal
        $file->setChmod($filepath4, 511);
        
        $this->assertEquals(777, $file->getFileSystemInfo($filepath4)->getFilePermission());
        
        
        // Test mode rwxsStT-`chmod($file, 511)`
        $dir5 = static::getTempPath(__FUNCTION__);
        $file5 = rand(1,10).rand(0, getrandmax());
        $filepath5 = $dir5.DIRECTORY_SEPARATOR.$file5;
        mkdir($dir5);
        file_put_contents($filepath5, __FUNCTION__, FILE_APPEND);
        $file->setChmod($filepath5, '-rwxr-xr-x');
        
        $this->assertEquals(755, $file->getFileSystemInfo($filepath5)->getFilePermission());
        
        
        $dir6 = static::getTempPath(__FUNCTION__);
        $file6 = rand(1,10).rand(0, getrandmax());
        $filepath6 = $dir6.DIRECTORY_SEPARATOR.$file6;
        mkdir($dir6);
        file_put_contents($filepath6, __FUNCTION__, FILE_APPEND);
        $file->setChmod($filepath6, '-rw-r--r--');
        
        $this->assertEquals(644, $file->getFileSystemInfo($filepath6)->getFilePermission());        
    }
    
    /**
     * @test
     */
    public function testSetChmodRecursive()
    {
        $file = new Filesystem;
        
        $dir = static::getTempPath(__FUNCTION__);
        $file1 = rand(1,10).rand(0, getrandmax());
        mkdir($dir);
        $filepath1 = $dir.DIRECTORY_SEPARATOR.$file1;
        
        $file2 = rand(1,10).rand(0, getrandmax());
        $filepath2 = $dir.DIRECTORY_SEPARATOR.$file2;
        mkdir($filepath2);
        
        $file3 = rand(1,10).rand(0, getrandmax());
        file_put_contents($filepath2.DIRECTORY_SEPARATOR.$file3, __FUNCTION__, FILE_APPEND);
        
        file_put_contents($filepath1, __FUNCTION__, FILE_APPEND);
        $file->setChmodRecursive($dir, 0733);
        
        $this->assertEquals("733", $file->getFileSystemInfo($filepath2.DIRECTORY_SEPARATOR.$file3)->getFilePermission());
    }
    
    /**
     * @test
     */
    public function testSetChgrp()
    {
        $file = new Filesystem;
        
        $dir = static::getTempPath(__FUNCTION__);
        $file1 = rand(1,10).rand(0, getrandmax());
        mkdir($dir);
        $filepath1 = $dir.DIRECTORY_SEPARATOR.$file1;
        
        $file2 = rand(1,10).rand(0, getrandmax());
        $filepath2 = $dir.DIRECTORY_SEPARATOR.$file2;
        mkdir($filepath2);
        
        $file3 = rand(1,10).rand(0, getrandmax());
        file_put_contents($filepath2.DIRECTORY_SEPARATOR.$file3, __FUNCTION__, FILE_APPEND);
        
        file_put_contents($filepath1, __FUNCTION__, FILE_APPEND);
        $file->setChgrp($dir, 1000, true);
        
        $this->assertEquals(1000, $file->getFileSystemInfo($dir)->getFileGroup());
    }
    
    /**
     * @test
     */
    public function testSetChown()
    {
        $file = new Filesystem;
        
        $dir = static::getTempPath(__FUNCTION__);
        $file1 = rand(1,10).rand(0, getrandmax());
        mkdir($dir);
        $filepath1 = $dir.DIRECTORY_SEPARATOR.$file1;
        
        $file2 = rand(1,10).rand(0, getrandmax());
        $filepath2 = $dir.DIRECTORY_SEPARATOR.$file2;
        mkdir($filepath2);
        
        $file3 = rand(1,10).rand(0, getrandmax());
        file_put_contents($filepath2.DIRECTORY_SEPARATOR.$file3, __FUNCTION__, FILE_APPEND);
        
        file_put_contents($filepath1, __FUNCTION__, FILE_APPEND);
        $file->setChown($dir, 1000, true);
        
        $this->assertEquals(1000, $file->getFileSystemInfo($dir)->getFileGroup());
    }
    
    /**
     * @test
     */
    public function testRename()
    {
        $file = new Filesystem;
        
        $dir = static::getTempPath(__FUNCTION__);
        mkdir($dir);
        $file1 = rand(1,10).rand(0, getrandmax());
        
        $path1 = $dir.DIRECTORY_SEPARATOR.$file1;
        
        $file2 = rand(1,10).rand(0, getrandmax());
        $path2 = $dir.DIRECTORY_SEPARATOR.$file2;
        
        file_put_contents($path1, __FUNCTION__, FILE_APPEND);
        
        $this->assertFileExists($path1);
        
        $file->rename($path1, $path2);
        
        $this->assertFileExists($path2);
    }
    
    /**
     * @test
     */
    public function testFileOwner()
    {
        $file = new Filesystem;
        
        $dir = static::getTempPath(__FUNCTION__);
        mkdir($dir);
        $file1 = rand(1,10).rand(0, getrandmax());
        
        $path1 = $dir.DIRECTORY_SEPARATOR.$file1;
        
        file_put_contents($path1, __FUNCTION__, FILE_APPEND);
        
        $owner = $file->getFileOwner($path1);
        
        $this->assertEquals(self::getCurrentOwner(), $owner['name']);
    }
    
    /**
     * @test
     */
    public function testFileOwnerName()
    {
        $file = new Filesystem;
        
        $dir = static::getTempPath(__FUNCTION__);
        mkdir($dir);
        $file1 = rand(1,10).rand(0, getrandmax());
        
        $path1 = $dir.DIRECTORY_SEPARATOR.$file1;
        
        file_put_contents($path1, __FUNCTION__, FILE_APPEND);
        
        $owner = $file->getFileOwner($path1);
        
        $getpwuid = posix_getpwuid(posix_geteuid());
        
        $this->assertEquals($getpwuid['name'], $owner['name']);
    }
    
    /**
     * @test
     */
    public function testGetLastAccessTime()
    {
        $file = new Filesystem;
        
        $dir = static::getTempPath(__FUNCTION__);
        mkdir($dir);
        $file1 = rand(1,10).rand(0, getrandmax());
        
        $path1 = $dir.DIRECTORY_SEPARATOR.$file1;
        
        file_put_contents($path1, __FUNCTION__, FILE_APPEND);
        $time = time();
        
        $fileatime = $file->getLastAccessTime($path1);
        
        $this->assertEquals($time, $fileatime);
    }
    
    /**
     * @test
     */
    public function testReadFile()
    {
        $file = new Filesystem;
        
        $dir = static::getTempPath(__FUNCTION__);
        mkdir($dir);
        $file1 = rand(1,10).rand(0, getrandmax());
        
        $path1 = $dir.DIRECTORY_SEPARATOR.$file1;
        
        // Read regulary
        file_put_contents($path1, __FUNCTION__);
        $this->assertEquals(__FUNCTION__, $file->readFile($path1));
        
        // Read with increased length
        file_put_contents($path1, __FUNCTION__);
        $this->assertEquals(__FUNCTION__, $file->readFile($path1, false, 8192));
        
        // Read with by one length
        file_put_contents($path1, __FUNCTION__);
        $this->assertEquals(__FUNCTION__, $file->readFile($path1, false, 2));
        $this->assertEquals('', $file->readFile($path1, false, 1));
        
        // Read binary
        file_put_contents($path1, __FUNCTION__);
        $this->assertEquals(__FUNCTION__, $file->readFile($path1, true));
    }
    
    /**
     * @test
     */
    public function testPrependFile()
    {
        $file = new Filesystem;
        
        $dir = static::getTempPath(__FUNCTION__);
        mkdir($dir);
        $file1 = rand(1,10).rand(0, getrandmax());
        
        $path1 = $dir.DIRECTORY_SEPARATOR.$file1;
        
        file_put_contents($path1, __FUNCTION__);
        
        $file->writeFilePrepend($path1, 'prependText');
        $this->assertEquals('prependText'.__FUNCTION__, $file->readFile($path1));
    }
    
    /**
     * @test
     */
    public function testWriteFileAppend()
    {
        $file = new Filesystem;
        
        $dir = static::getTempPath(__FUNCTION__);
        mkdir($dir);
        $file1 = rand(1,10).rand(0, getrandmax());
        
        $path1 = $dir.DIRECTORY_SEPARATOR.$file1;
        
        file_put_contents($path1, __FUNCTION__);
        
        $file->writeFileAppend($path1, 'appendText');
        $this->assertEquals(__FUNCTION__.'appendText', $file->readFile($path1));
    }
    
    /**
     * @test
     */
    public function testWriteFile()
    {
        $file = new Filesystem;
        
        $dir = static::getTempPath(__FUNCTION__);
        mkdir($dir);
        $file1 = rand(1,10).rand(0, getrandmax());
        
        $path1 = $dir.DIRECTORY_SEPARATOR.$file1;
        
        $file->writeFile($path1, 'testWriteFile');
        $this->assertEquals('testWriteFile', $file->readFile($path1));
        
        $file->writeFile($path1, 'testWriteFile');
        $this->assertEquals('testWriteFile', $file->readFile($path1, 256));
    }
    
    /**
     * @test
     */
    public function testCreateFileAndClose()
    {
        $file = new Filesystem;
        
        $dir = static::getTempPath(__FUNCTION__);
        mkdir($dir);
        $file1 = rand(1,10).rand(0, getrandmax());
        
        $filepath = $dir.DIRECTORY_SEPARATOR.$file1;
        
        $this->assertFileExists($filepath, $file->createFileAndClose($filepath));
    }
    
    /**
     * @test
     */
    public function testIsWriteable()
    {
        $file = new Filesystem;
        
        $dir = static::getTempPath(__FUNCTION__);
        mkdir($dir);
        $filename = rand(1,10).rand(0, getrandmax());
        
        $path = $dir.DIRECTORY_SEPARATOR.$filename;
        
        touch($path);
        
        $this->assertEquals(true, $file->isWriteable($path));
    }
    
    /**
     * @test
     */
    public function testGetGuid()
    {
        $file = new Filesystem;
        
        $re = "/([a-z0-9]{8})-([a-z0-9]{4})-([a-z0-9]{4})-([a-z0-9]{4})-([a-z0-9]{12})/"; 
     
        $guid = $file->getGuid();
        
        preg_match_all($re, $guid, $matches);
        
        $this->assertEquals($matches[0][0], $guid);
    }
    
    /**
     * @test
     */
    public function testEmptyFile()
    {
        $file = new Filesystem;
        
        $dir = static::getTempPath(__FUNCTION__);
        mkdir($dir);
        $filename = rand(1,10).rand(0, getrandmax());
        
        $path = $dir.DIRECTORY_SEPARATOR.$filename;
        
        file_put_contents($path, __FUNCTION__);
        
        $file->emptyFile($path);
        
        $fileempty = file_get_contents($path);
        
        $this->assertEquals(empty($fileempty), empty(file_get_contents($path)));
    }
    
    /**
     * @test
     */
    public function testIsSymbolicLink()
    {
        $file = new Filesystem;
        
        $dir = static::getTempPath(__FUNCTION__);
        mkdir($dir);
        $filename = rand(1,10).rand(0, getrandmax());
        $filename2 = rand(1,10).rand(0, getrandmax());
        
        $path1 = $dir.DIRECTORY_SEPARATOR.$filename;
        $path2 = $dir.DIRECTORY_SEPARATOR.$filename2;
        
        touch($path1);
        
        symlink($path1, $path2);
        
        $this->assertEquals(true, $file->isSymbolicLink($path2));
    }
    
    /**
     * @test
     * @todo $_FILES
     */
    public function testUploadFile()
    {
        $file = new Filesystem;
        
        $dir = static::getTempPath(__FUNCTION__);
        mkdir($dir);
        $filename = rand(1,10).rand(0, getrandmax());
        
        $dir2 = static::getTempPath(__FUNCTION__);
        mkdir($dir2);
        $filename2 = rand(1,10).rand(0, getrandmax());
        
        $path = $dir.DIRECTORY_SEPARATOR.$filename;
        $path2 = $dir2.DIRECTORY_SEPARATOR.$filename2;
        
        touch($path);
        
        /*
        $_FILES['file']['name'] = $filename;
        $_FILES['file']['type'] = 'text/plain';
        $_FILES['file']['tmp_name'] = $path;
        $_FILES['file']['size'] = 0;
        $_FILES['file']['error'] = null;
         */
        
        copy($path, $path2);
        
        $this->assertFileExists($path);
        $this->assertFileExists($path2);
    }
    
    /**
     * @test
     */
    public function testCreateHardLink()
    {
        $file = new Filesystem;
        
        $dir = static::getTempPath(__FUNCTION__);
        mkdir($dir);
        $filename = rand(1,10).rand(0, getrandmax());
        $filename2 = rand(1,10).rand(0, getrandmax());
        
        $path1 = $dir.DIRECTORY_SEPARATOR.$filename;
        $path2 = $dir.DIRECTORY_SEPARATOR.$filename2;
        
        touch($path1);
        
        $file->createHardLink($path1, $path2);
        
        $this->assertEquals(false, is_link($path2));
        $this->assertEquals("file", filetype($path2));
    }
    
    /**
     * @test
     */
    public function testCreateSymbolicLink()
    {
        $file = new Filesystem;
        
        $dir = static::getTempPath(__FUNCTION__);
        mkdir($dir);
        $filename = rand(1,10).rand(0, getrandmax());
        $filename2 = rand(1,10).rand(0, getrandmax());
        
        $path1 = $dir.DIRECTORY_SEPARATOR.$filename;
        $path2 = $dir.DIRECTORY_SEPARATOR.$filename2;
        
        touch($path1);
        
        $file->createSymbolicLink($path1, $path2);
        
        $this->assertEquals(true, is_link($path2));
        $this->assertEquals("link", filetype($path2));
    }
    
    /**
     * @test
     */
    public function testGetLinkTarget()
    {
        $file = new Filesystem;
        
        $dir = static::getTempPath(__FUNCTION__);
        mkdir($dir);
        $filename = rand(1,10).rand(0, getrandmax());
        $filename2 = rand(1,10).rand(0, getrandmax());
        
        $path1 = $dir.DIRECTORY_SEPARATOR.$filename;
        $path2 = $dir.DIRECTORY_SEPARATOR.$filename2;
        
        touch($path1);
        
        $file->createSymbolicLink($path1, $path2);
        
        $this->assertEquals(readlink($path2),$path1);
    }
    
    /**
     * @test
     */
    public function testFileAutoUnique()
    {
        $file = new Filesystem;
        
        $tempfile = $file->createFileAutoUnique();
        $this->assertFileExists($tempfile);
        
        $tempfile = $file->createFileAutoUnique(sys_get_temp_dir(), null, __FUNCTION__);
        $this->assertEquals(__FUNCTION__, file_get_contents($tempfile));
        
        $tempfile = $file->createFileAutoUnique(sys_get_temp_dir(), 'prefix', __FUNCTION__);
        $this->assertFileExists($tempfile);
    }
    
    /**
     * @test
     */
    public function testCreateTemporaryFile()
    {
        $file = new Filesystem;
        
        $tempfile = $file->createTemporaryFile('test');
        
        $this->assertEquals('test', $file->readTemporaryFile($tempfile));
        
        $this->assertEquals(true, $file->removeTemporaryFile($tempfile));
    }
    
    /**
     * @test
     */
    public function testGetLinkInfo()
    {
        $file = new Filesystem;
        
        $dir = static::getTempPath(__FUNCTION__);
        mkdir($dir);
        $filename = rand(1,10).rand(0, getrandmax());
        $filename2 = rand(1,10).rand(0, getrandmax());
        
        $path1 = $dir.DIRECTORY_SEPARATOR.$filename;
        $path2 = $dir.DIRECTORY_SEPARATOR.$filename2;
        
        touch($path1);
        
        $file->createSymbolicLink($path1, $path2);
        
        $this->assertEquals(true, is_link($path2));
        $this->assertEquals(2049, $file->getLinkInfo($path1));
    }
    
    /**
     * @test
     */
    public function testExecuteFileInBackground()
    {
        $file = new Filesystem;
        
        $content = '<?php sleep(10);';
        
        $dir = static::getTempPath(__FUNCTION__);
        mkdir($dir);
        $filename = rand(1,10).rand(0, getrandmax());
        $path = $dir.DIRECTORY_SEPARATOR.$filename;
        
        file_put_contents($path, $content);
        
        $file->executeFileInBackground('php '.$path);
        
        $proc = false;
        foreach ($file->getProcessSnapshot() as $pcs)
        {
            if (stristr($pcs, __FUNCTION__))
            {
                $proc = true;
            }
        }
        
        $this->assertEquals(true, $proc);
    }
    
    /**
     * @test
     */
    public function testGetTreeStructure()
    {
        $file = new Filesystem;
        
        $dir = static::getTempPath(__FUNCTION__);
        mkdir($dir);
        $filename = rand(1,10).rand(0, getrandmax());
        $path = $dir.DIRECTORY_SEPARATOR.$filename;
        
        $dirname = rand(1,10).rand(0, getrandmax());
        
        touch($path);
        
        mkdir($dir.DIRECTORY_SEPARATOR.$dirname);
        touch($dir.DIRECTORY_SEPARATOR.$dirname.DIRECTORY_SEPARATOR.$filename);
        touch($dir.DIRECTORY_SEPARATOR.$dirname.DIRECTORY_SEPARATOR.$filename.'1');
        
        $dirstructure = $file->getTreeStructure($dir);
        
        $dir = new \DirectoryIterator($dir);
        foreach ($dir as $fileinfo) {
            if (!$fileinfo->isDot()) {
                $filesiterators[] = $fileinfo->getFilename();
            }
        }
        
        $this->assertTrue(in_array($dirname, $filesiterators));
    }
    
    /**
     * @test
     */
    public function testGetHexDump()
    {
        $file = new Filesystem;
        
        $dir = static::getTempPath(__FUNCTION__);
        mkdir($dir);
        $filename = rand(1,10).rand(0, getrandmax());
        
        $path = $dir.DIRECTORY_SEPARATOR.$filename;
        touch($path);
        
        $input = '0123456789';
        file_put_contents($path, $input);
        
        $dumpresult = $file->getHexDump($path);
        
        $this->assertEquals($dumpresult[1], '30 31 32 33 34 35 36 37 38 39 ');
        $this->assertEquals($dumpresult[2], $input);
    }
    
    /**
     * @test
     */
    public function testGetCheksum()
    {
        $file = new Filesystem;
        
        $dir = static::getTempPath(__FUNCTION__);
        mkdir($dir);
        $filename = rand(1,10).rand(0, getrandmax());
        
        $path = $dir.DIRECTORY_SEPARATOR.$filename;
        touch($path);
        
        $input = 'abcdefgijklmnopqrstuvwxyz01234567890';
        file_put_contents($path, $input);
        
        $this->assertEquals('73c85e86880209a9d2b6b78e22e817bd', $file->getChecksum($path));
        $this->assertEquals('73c85e86880209a9d2b6b78e22e817bd', $file->getChecksum($path, 'md5'));
        $this->assertEquals('8a5e9122ee281ee98967a4af363f823f', md5($file->getChecksum($path, 'md5raw')));
        $this->assertEquals('a1a0d18053dac3145cb4246736b5c48332a96cd1', $file->getChecksum($path, 'sha1'));
        $this->assertEquals('f76f2647f1db6ca5b3fee55934bf4c569766deee', sha1($file->getChecksum($path, 'sha1raw')));
        $this->assertEquals('494136d29a2c6af32f999858630519280d0d47bf', sha1($file->getChecksum($path, 'crc32')));
    }
    
    /**
     * @test
     */
    public function testGetIncludedFiles()
    {
        $file = new Filesystem;
        
        $this->assertEquals(true, is_array($file->getIncludedFiles()));
    }
    
    /**
     * @test
     */
    public function testGetBasename()
    {
        $file = new Filesystem;
        
        $this->assertEquals('var', $file->getBasename('/var'));
        $this->assertEquals('var', $file->getBasename('/var/'));
        $this->assertEquals('www', $file->getBasename('/var/www/'));
        $this->assertEquals('lorem.php', $file->getBasename('/var/www/lorem.php'));
        $this->assertEquals('local.localhost.tld', $file->getBasename('http://local.localhost.tld/'));
        $this->assertEquals('test', $file->getBasename('http://local.localhost.tld/test'));
        $this->assertEquals('abc', $file->getBasename('http://local.localhost.tld/test/abc'));
        $this->assertEquals('test', $file->getBasename('http://local.localhost.tld/test/abc/test'));
        $this->assertEquals('test?a=1', $file->getBasename('http://local.localhost.tld/test/abc/test/test?a=1'));
        $this->assertEquals('', $file->getBasename(''));
        $this->assertEquals('', $file->getBasename('.'));
        $this->assertEquals('..', $file->getBasename('../'));
        $this->assertEquals('..', $file->getBasename('../'));
        $this->assertEquals('.', $file->getBasename('./'));
        $this->assertEquals('.', $file->getBasename('./'));
        $this->assertEquals('', $file->getBasename('/'));
        $this->assertEquals('var1', $file->getBasename('/var/../var1'));
    }
}
