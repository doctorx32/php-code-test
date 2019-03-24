<?php
declare(strict_types=1);

namespace App\tests\Output;


use App\Output\OutputStrategy;
use PHPUnit\Framework\TestCase;

class OutputStrategyTest extends TestCase
{
    public function testResolve()
    {
        $outputStrategy = new OutputStrategy();
        $test = [
            'book' => [
                'author' => 'Mark Twain',
                'title' => 'Tom Sawyer',
                'isbn' => 2424234242
            ],
            'stock' => [
                'quantity' => 1,
                'price' => 20
            ]
        ];
        $test = json_encode($test);
        $result = $outputStrategy->resolve(OutputStrategy::TYPE_JSON, $test);
        self::assertEquals([], $result);
    }
}