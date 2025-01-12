<?php

declare(strict_types=1);

namespace Rector\PHPUnit\PHPUnit100\Rector\Yield_;

use PhpParser\Node;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Expr\ArrayItem;
use PhpParser\Node\Expr\Yield_;
use PhpParser\Node\Scalar\String_;
use Rector\PHPUnit\Tests\PHPUnit100\Rector\MethodCall\RemoveNamedArgsInDataProviderRector\RemoveNamedArgsInDataProviderRectorTest;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see RemoveNamedArgsInDataProviderRectorTest
 */
final class RemoveNamedArgsInDataProviderRector extends AbstractRector
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Remove named arguments in data provider', [
            new CodeSample(
                <<<'CODE_SAMPLE'
use PHPUnit\Framework\TestCase;

final class SomeTest extends TestCase
{
    /**
     * @dataProvider provideData()
     */
    public function test()
    {
    }

    public static function provideData()
    {
        yield ['namedArg' => 100];
    }
}
CODE_SAMPLE

                ,
                <<<'CODE_SAMPLE'
use PHPUnit\Framework\TestCase;

final class SomeTest extends TestCase
{
    /**
     * @dataProvider provideData()
     */
    public function test()
    {
    }

    public static function provideData()
    {
        yield [100];
    }
}
CODE_SAMPLE
            ),
        ]);
    }

    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [Yield_::class];
    }

    /**
     * @param  Yield_  $node
     */
    public function refactor(Node $node): ?Node
    {
        if (! $node instanceof Yield_) {
            return null;
        }

        $hasChanged = false;

        /** @var Array_ $value */
        $value = $node->value;
        foreach ($value->items as $item) {
            if (!$item instanceof ArrayItem) {
                continue;
            }
            if (!$item->key instanceof String_) {
                continue;
            }
            $item->key = null;
            $hasChanged = true;
        }

        if ($hasChanged) {
            return $node;
        }

        return null;
    }
}
