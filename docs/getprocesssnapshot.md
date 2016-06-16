# getProcessSnapshot

Get a process

## Description

```php
getProcessSnapshot()
```

Get a process using 'ps'. Get a process ID as array result.

## Parameters

__No parameters.__
  
## Return values

__array__
If no process found it will return empty array.
If process founds it will return lists of process as array.

## Examples

Example #1 Get a process lists
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$filesystem->getProcessSnapshot();
```

Result:

```php
  [1]=>string(89) "root    1  0.0  0.1 152544  7908 ?        S    Lip15   0:00 /sbin/init"

```

To get a specified process to find 'www-data':

```php
foreach ($file->getProcessSnapshot() as $pcs)
{
    if (stristr($pcs, 'www-data'))
    {
        // Found a process
    }
}
```

## Notes

__No notes.__

## See also

__No documentation.__
