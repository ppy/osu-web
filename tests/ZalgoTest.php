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

class ZalgoTest extends TestCase
{
    /**
     * This does not seem like the best idea.
     *
     * @dataProvider examples
     */
    public function testUnzalgo($expected, $level)
    {
        $text = 't́̌͌̌͘e̎̀́͐̅s̐̑̈͋͡ť̎̅̌̅i͛̋̋͋̽ñ̈́̌̽̿g̈́̆͋͡͞';

        $this->assertSame(unzalgo($text, $level), $expected);
    }

    // Quick test that unzalgo isn't eating the wrong characters.
    public function testTextDoesNotChange()
    {
        foreach (config('app.available_locales') as $locale) {
            $text = trans('layout.defaults.page_description', [], $locale);
            $this->assertSame(unzalgo($text), $text);
        }
    }

    public function examples()
    {
        return [
            ['testing', 0],
            ['t͘e̎s̐ťi͛ñg̈́', 1],
            ['t́͘e̎̀s̐̑ť̎i͛̋ñ̈́g̈́͡', 2],
        ];
    }
}
