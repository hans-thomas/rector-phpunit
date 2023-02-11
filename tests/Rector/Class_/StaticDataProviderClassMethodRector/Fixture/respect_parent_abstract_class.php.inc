<?php

namespace PHPUnit\Framework;

namespace Rector\PHPUnit\Tests\Rector\Class_\StaticDataProviderClassMethodRector\Fixture;

use Rector\PHPUnit\Tests\Rector\Class_\StaticDataProviderClassMethodRector\Source\AnotherAbstractClass;

final class RespeparentAbstractClass extends AnotherAbstractClass
{
    public function dataProvider(): array
    {
        return [
        	[1, 2],
        ];
    }
}

?>
-----
<?php

namespace PHPUnit\Framework;

namespace Rector\PHPUnit\Tests\Rector\Class_\StaticDataProviderClassMethodRector\Fixture;

use Rector\PHPUnit\Tests\Rector\Class_\StaticDataProviderClassMethodRector\Source\AnotherAbstractClass;

final class RespeparentAbstractClass extends AnotherAbstractClass
{
    public static function dataProvider(): array
    {
        return [
        	[1, 2],
        ];
    }
}

?>