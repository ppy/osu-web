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
        $this->skipIf32Bit("FastRandom::nextDouble() isn't as precise as the osu! client on 32-bit installations of PHP");

        $random = new FastRandom($seed);

        foreach ($expectedResults as $expected) {
            $this->assertSame($random->nextDouble(), $expected);
        }
    }

    /**
     * @dataProvider int31Examples
     */
    public function testNextInt31(int $seed, array $expectedResults)
    {
        $random = new FastRandom($seed);

        foreach ($expectedResults as $expected) {
            $this->assertSame($random->nextInt31(), $expected);
        }
    }

    /**
     * @dataProvider int32Examples
     */
    public function testNextInt32(int $seed, array $expectedResults)
    {
        $random = new FastRandom($seed);

        foreach ($expectedResults as $expected) {
            $this->assertSame($random->nextInt32(), $this->maskTo32Bit($expected));
        }
    }

    /**
     * @dataProvider invalidSeeds
     */
    public function testInvalidSeed(int $seed)
    {
        $this->skipIf32Bit('Every FastRandom seed is valid on 32-bit installations of PHP');

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

    public function int31Examples()
    {
        return [
            [0, [273327012, 512581597, 935368660, 1925320520, 936428855]],
            [1, [273329069, 512579540, 935370717, 1925318465, 932236663]],
            [-1, [273327196, 512579621, 935366700, 1925318832, 938425072]],
            [100000, [477237634, 313912444, 1006118386, 2130361577, 1921539253]],
        ];
    }

    public function int32Examples()
    {
        return [
            [0, [273327012, -1634902051, -1212114988, -222163128, -1211054793]],
            [1, [273329069, -1634904108, -1212112931, -222165183, -1215246985]],
            [-1, [273327196, -1634904027, -1212116948, -222164816, -1209058576]],
            [100000, [477237634, -1833571204, -1141365262, -17122071, 1921539253]],
        ];
    }

    public function invalidSeeds()
    {
        return [
            [0x80000000],
            [-0x80000001],
        ];
    }

    private function maskTo32Bit(int $int): int
    {
        if (PHP_INT_SIZE > 4) {
            $int &= 0xFFFFFFFF;
        }

        return $int;
    }

    private function skipIf32Bit(string $message): void
    {
        if (PHP_INT_SIZE === 4) {
            $this->markTestSkipped($message);
        }
    }
}
