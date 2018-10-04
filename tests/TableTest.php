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
use App\Libraries\HasDynamicTable;
use App\Models\Model;
use Symfony\Component\Finder\SplFileInfo;

class TableTest extends TestCase
{
    private $modelsPath;

    public function testTableExistence()
    {
        $errors = [];

        $files = File::allFiles(app_path().'/Models');
        foreach ($files as $file) {
            $error = $this->checkFile($file);
            if ($error !== null) {
                $errors[] = $error;
            }
        }

        // prints a diff with the classes that errored.
        $this->assertSame([], $errors);
    }

    private function checkFile(SplFileInfo $file)
    {
        $class = $this->classFromFileInfo($file);
        $reflectionClass = new ReflectionClass($class);
        if (
            $reflectionClass->isAbstract() ||
            !$reflectionClass->isSubclassOf(Model::class) ||
            $reflectionClass->implementsInterface(HasDynamicTable::class)
        ) {
            return;
        }

        try {
            $class::first();
        } catch (Exception $e) {
            return $class;
        }
    }

    private function classFromFileInfo(SplFileInfo $fileInfo)
    {
        $baseName = $fileInfo->getBasename(".{$fileInfo->getExtension()}");
        $namespace = str_replace('/', '\\', $fileInfo->getRelativePath());
        if (mb_strlen($fileInfo->getRelativePath()) !== 0) {
            $namespace .= '\\';
        }

        return "\\App\\Models\\{$namespace}{$baseName}";
    }
}
