<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests;

use App\Libraries\HasDynamicTable;
use App\Models\Model;
use File;
use ReflectionClass;
use Symfony\Component\Finder\SplFileInfo;

class TableTest extends TestCase
{
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
