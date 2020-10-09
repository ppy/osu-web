<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Libraries;

use App\Libraries\BBCodeForDB;
use App\Models\User;
use Tests\TestCase;

class BBCodeForDBTest extends TestCase
{
    /**
     * @dataProvider examples
     */
    public function testGenerate($name, $path)
    {
        $baseFilePath = "{$path}/{$name}.base.txt";
        $dbFilePath = "{$path}/{$name}.db.txt";

        $output = (new BBCodeForDB(file_get_contents($baseFilePath)))->generate();

        $this->assertStringEqualsFile($dbFilePath, $output);
    }

    public function testNewline()
    {
        $source = "[code]line one\r\nline two\rline three\nline four\r\nline five[/code]";
        $expectedOutput = '[code:1]line one&#10;line two&#10;line three&#10;line four&#10;line five[/code:1]';

        $output = (new BBCodeForDB($source))->generate();

        $this->assertSame($expectedOutput, $output);
    }

    public function testProfile()
    {
        $user = factory(User::class)->create();
        $emptyBbcode = new BBCodeForDB();
        $name = $emptyBbcode->extraEscapes($user->username);

        $source = "[profile]{$user->username}[/profile]";
        $expectedOutput = "[profile={$user->getKey()}:1]{$name}[/profile:1]";

        $output = (new BBCodeForDB($source))->generate();

        $this->assertSame($expectedOutput, $output);
    }

    public function testProfileMismatchId()
    {
        $user = factory(User::class)->create();
        $emptyBbcode = new BBCodeForDB();
        $name = $emptyBbcode->extraEscapes($user->username);

        $source = "[profile={$user->getKey()}]x[/profile]";
        $expectedOutput = "[profile={$user->getKey()}:1]{$name}[/profile:1]";

        $output = (new BBCodeForDB($source))->generate();

        $this->assertSame($expectedOutput, $output);
    }

    public function testProfileInvalidUser()
    {
        $source = '[profile]a[/profile]'; // name is too short to match any users
        $expectedOutput = '[profile:1]a[/profile:1]';

        $output = (new BBCodeForDB($source))->generate();

        $this->assertSame($expectedOutput, $output);
    }

    public function examples()
    {
        return $this->fileList(__DIR__.'/bbcode_examples', '.base.txt');
    }

    protected function setUp(): void
    {
        parent::setUp();

        config()->set('osu.bbcode.uid', '1');
    }
}
