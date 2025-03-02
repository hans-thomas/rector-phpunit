<?php

namespace Rector\PHPUnit\Tests\CodeQuality\Rector\MethodCall\AssertCompareOnCountableWithMethodToAssertCountRector\Fixture;

final class OtherCountCall extends \PHPUnit\Framework\TestCase
{
    public function test()
    {
        $this->assertEquals(10, iterator_count($something));

        $count = 92;
        $this->assertNotEquals($count, sizeof($something), 'third argument');
    }
}

?>
-----
<?php

namespace Rector\PHPUnit\Tests\CodeQuality\Rector\MethodCall\AssertCompareOnCountableWithMethodToAssertCountRector\Fixture;

final class OtherCountCall extends \PHPUnit\Framework\TestCase
{
    public function test()
    {
        $this->assertCount(10, $something);

        $count = 92;
        $this->assertNotCount($count, $something, 'third argument');
    }
}

?>
