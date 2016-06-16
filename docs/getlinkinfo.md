# getLinkInfo

Gets information about a link

## Description

```php
getLinkInfo($path)
```

Get ID device file, verify link from file path, check is symbolic link.
Returns integer type.


## Parameters

__path__
: Filename path

## Return values

__integer__
: Returns integer type

## Examples

Example #1 Get ID of link
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$linkId = $filesystem->getLinkInfo('/tmp/myfile');
echo $linkId; // Returns 2049
}
```

## Notes

> It is same method as `S_ISLNK` macro defined in `stat`. You can check on unix using `stat filename` and returns in device parameter as `Device: 801h/2049d`. 

## See also

__No documentation.__
