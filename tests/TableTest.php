<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
use App\Models\Model;

class TableTest extends TestCase
{
    public function testTableExistence()
    {
        $this->modelsPath = app_path().'/Models';
        $this->checkDir($this->modelsPath);
    }

    private function checkFile(string $path, string $namespace = '')
    {
        $pathinfo = pathinfo($path);
        $class = '\\App\\Models'.$namespace.'\\'.$pathinfo['filename'];
        $reflectionClass = new ReflectionClass($class);
        if ($reflectionClass->isAbstract() || !$reflectionClass->isSubclassOf(Model::class)) {
            return;
        }

        $class::first();

        $this->assertTrue(true);
    }

    private function checkDir(string $basePath, string $namespace = '')
    {
        $entries = scandir($basePath);
        foreach ($entries as $entry) {
            $entryPath = $basePath.'/'.$entry;
            if ($entry === '.' || $entry === '..') {
                continue;
            }

            if (is_dir($entryPath)) {
                $this->checkDir($entryPath, $namespace.'\\'.$entry);
            } elseif (is_file($entryPath)) {
                $this->checkFile($entryPath, $namespace);
            }
        }
    }
}
