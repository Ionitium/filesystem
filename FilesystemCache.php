<?php
/*
 * Ionitium - Full-stack PHP 
 *
 * @package     Ionitium
 * @copyright   Copyright (C) 2015 with MIT license
 * @version     1.0.0
 * @author      Marin Sagovac <marin@sagovac.com>
 */

namespace Ionitium\Filesystem;

class FilesystemCache
{
    /**
     * Get realpath cache entries
     * 
     * Get the contents of the realpath cache such as path, path expiration and is_dir
     * Performance costs
     * 
     * @return array
     */
    public function getRealpathCacheGet()
    {
        return realpath_cache_get();
    }
    
    /**
     * Get realpath cache size
     * 
     * Returns memory usage of cache in bytes for path given by require/include
     * Performance costs
     * 
     * @return int
     */
    public function getRealpathCacheSize()
    {
        return realpath_cache_size();
    }
    
    /**
     * Increase performance for include/require files and caching files
     * 
     * Exampple: 256kb / ttl: 300 for tune heavy-load sites
     * 
     * @param float $factor
     */
    public function increaseRealpath($factor)
    {
        if ($factor < 1 || $factor >= 2) {
            throw new Exception(sprintf("A realpath_cache_size() and realpath_cache_ttl() should not be increase factor more than 2 or lower than 1"));
        }
        
        $size = 16 * $factor.'k';
        $ttl = 120 * $factor;
        
        ini_set('realpath_cache_size', $size);
        ini_set('realpath_cache_ttl', $ttl);
    }
    
    /**
     * Set Realpath cache size
     * 
     * Size of cache for require/include files. If many files for opening, increase value.
     * Try not to set more than 256k due to use a lot of memory.
     * 
     * @link http://php.net/manual/en/ini.core.php#ini.realpath-cache-size
     * 
     * @param string $size
     */
    public function setRealpathCacheSize($size = '64k')
    {
        ini_set('realpath_cache_size', $size);
    }
    
    /**
     * Set Realpath time to live
     * 
     * A duration in seconds to keep a cache required files
     * If rarely changing files increase a value
     * Tuning: Set large as 3600 than decrease a value
     * Set a TTL based on traffic. 
     * 
     * 1 user per minutes set to 3600 seconds
     * 100 visits per minutes set to 120 seconds
     * 1000 visits per minutes set to 60 seconds
     * 
     * @link http://php.net/manual/en/ini.core.php#ini.realpath-cache-ttl
     * 
     * @param int $seconds
     */
    public function setRealpathCacheTtl($seconds = '120')
    {
        ini_set('realpath_cache_ttl', $seconds);
    }
}
