<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Libraries;

use App\Libraries\FastRandom;
use InvalidArgumentException;
use Tests\TestCase;

class FastRandomTest extends TestCase
{
    /**
     * @dataProvider doubleExamples
     */
    public function testNextDouble(int $seed, array $expectedResults)
    {
        $random = new FastRandom($seed);

        foreach ($expectedResults as $expected) {
            $this->assertSame($random->nextDouble(), $expected);
        }
    }

    /**
     * @dataProvider intExamples
     */
    public function testNextInt(int $seed, array $expectedResults)
    {
        $random = new FastRandom($seed);

        foreach ($expectedResults as $expected) {
            $this->assertSame($random->nextInt(), $expected);
        }
    }

    /**
     * @dataProvider nonnegativeIntExamples
     */
    public function testNextNonnegativeInt(int $seed, array $expectedResults)
    {
        $random = new FastRandom($seed);

        foreach ($expectedResults as $expected) {
            $this->assertSame($random->nextNonnegativeInt(), $expected);
        }
    }

    /**
     * @dataProvider invalidSeeds
     */
    public function testInvalidSeed(int $seed)
    {
        if (PHP_INT_SIZE === 4) {
            $this->markTestSkipped('Every FastRandom seed is valid on 32-bit installations of PHP');
        }

        $this->expectException(InvalidArgumentException::class);
        new FastRandom($seed);
    }

    public function doubleExamples()
    {
        return [
            [0, [0.1272778082638979, 0.23868940630927682, 0.4355649743229151, 0.896547231823206, 0.4360586660914123]],
            [1, [0.1272787661291659, 0.23868844844400883, 0.43556593218818307, 0.8965462748892605, 0.4341065245680511]],
            [-1, [0.12727789394557476, 0.2386884861625731, 0.43556406162679195, 0.896546445786953, 0.4369882270693779]],
            [100000, [0.2222310910001397, 0.1461768727749586, 0.4685103828087449, 0.9920269143767655, 0.8947864421643317]],
        ];
    }

    public function intExamples()
    {
        return [
            [0, [273327012, 2660065245, 3082852308, 4072804168, 3083912503]],
            [1, [273329069, 2660063188, 3082854365, 4072802113, 3079720311]],
            [-1, [273327196, 2660063269, 3082850348, 4072802480, 3085908720]],
            [100000, [477237634, 2461396092, 3153602034, 4277845225, 1921539253]],
        ];
    }

    public function nonnegativeIntExamples()
    {
        return [
            [0, [273327012, 512581597, 935368660, 1925320520, 936428855]],
            [1, [273329069, 512579540, 935370717, 1925318465, 932236663]],
            [-1, [273327196, 512579621, 935366700, 1925318832, 938425072]],
            [100000, [477237634, 313912444, 1006118386, 2130361577, 1921539253]],
        ];
    }

    public function invalidSeeds()
    {
        return [
            [0x80000000],
            [-0x80000001],
        ];
    }
}
