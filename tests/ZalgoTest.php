<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
