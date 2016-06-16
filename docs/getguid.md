# createFileAndClose

Generate 128 bits of random data

## Description

```php
getGuid()
```
Returns 128-bit truly random data

## Parameters

__No parameters__

## Return values

__string__
: Returns string a-z, 0-9 in a form __xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx__

## Examples

Example #1 Example
```php
use Ionitium\Filesystem\Filesystem;

$filesystem = new Filesystem;
$guid = $filesystem->getGuid();
echo $guid;
```

## Notes

> It uses pseudom random generator from `openssl_random_pseudo_bytes()` function.

## See also

__No documentation.__