<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Tests;

use Symfony\Component\Finder\Finder;

class ZalgoTest extends TestCase
{
    /**
     * @dataProvider zalgoExamples
     */
    public function testCombination($text)
    {
        $this->assertSame(unzalgo($text), $text);
    }

    // Quick test that unzalgo isn't eating the wrong characters.
    public function testTranslations()
    {
        $path = realpath(__DIR__.'/../resources/lang');

        $files = Finder::create()->files()->in($path)->sortByName();
        foreach ($files as $file) {
            $contents = $file->getContents();
            $this->assertSame($contents, unzalgo($contents), $file->getRelativePathname());
        }
    }

    /**
     * This does not seem like the best idea.
     *
     * @dataProvider zalgoExamples
     */
    public function testUnzalgo($expected, $level)
    {
        $text = 't́̌͌̌͘e̎̀́͐̅s̐̑̈͋͡ť̎̅̌̅i͛̋̋͋̽ñ̈́̌̽̿g̈́̆͋͡͞';

        $this->assertSame(unzalgo($text, $level), $expected);
    }

    public function combinationExamples()
    {
        return [
            ['👩🏻‍⚕️'],
            ['再⃝'],
            ['N⃝H⃝K⃝'],
        ];
    }

    public function zalgoExamples()
    {
        return [
            ['testing', 0],
            ['t͘e̎s̐ťi͛ñg̈́', 1],
            ['t́͘e̎̀s̐̑ť̎i͛̋ñ̈́g̈́͡', 2],
        ];
    }
}
