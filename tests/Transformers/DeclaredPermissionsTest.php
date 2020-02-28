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

namespace Tests\Transformers;

use App\Transformers\TransformerAbstract;
use League\Fractal\TransformerAbstract as FractalTrasformerAbstract;
use ReflectionClass;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Tests\TestCase;

class DeclaredPermissionsTest extends TestCase
{
    /**
     * @dataProvider transformerClassesDataProvider
     */
    public function testCorrectSubclass($class)
    {
        $this->assertTrue(is_subclass_of($class, TransformerAbstract::class));
    }

    /**
     * @dataProvider privilegeDataProvider
     */
    public function testPrivilegeExists($class, ?string $include, string $privilege)
    {
        /** @var TransformerAbstract */
        $transformer = new $class;
        $allIncludes = array_merge($transformer->getDefaultIncludes(), $transformer->getAvailableIncludes());

        if ($include !== null) {
            $this->assertContains($include, $allIncludes, "{$class} has permission check for {$include} but does not exist in transformer.");
        }

        $this->assertTrue(method_exists(app('OsuAuthorize'), "check{$privilege}"), "{$class} uses check{$privilege} but is not implemented.");
    }

    public function transformerClassesDataProvider()
    {
        return array_map(
            function ($class) {
                return [$class];
            },
            static::getTransformerClasses()
        );
    }

    public function privilegeDataProvider()
    {
        $data = [];

        foreach (static::getTransformerClasses() as $class) {
            $transformer = new $class;

            if ($transformer->getRequiredPermission() !== null) {
                $data[] = [$class, null, $transformer->getRequiredPermission()];
            }

            foreach ($transformer->getPermissions() as $include => $privilege) {
                $data[] = [$class, $include, $privilege];
            }
        }

        return $data;
    }

    private static function getTransformerClasses()
    {
        // data provider is set up before laravel boots, so can't use laravel methods.
        $path = realpath(__DIR__.'/../../app/Transformers');
        $files = Finder::create()->files()->in($path)->sortByName();
        $classes = [];

        foreach ($files as $file) {
            $class = static::classFromFileInfo($file);
            // use ReflectionClass so the qualified names are normalized.
            $reflectionClass = new ReflectionClass($class);
            if ($reflectionClass->isSubclassOf(FractalTrasformerAbstract::class)
                && $reflectionClass->getName() !== (new ReflectionClass(TransformerAbstract::class))->getName()) {
                $classes[] = $class;
            }
        }

        return $classes;
    }

    private static function classFromFileInfo(SplFileInfo $fileInfo)
    {
        $baseName = $fileInfo->getBasename(".{$fileInfo->getExtension()}");
        $namespace = str_replace('/', '\\', $fileInfo->getRelativePath());
        if (mb_strlen($namespace) !== 0) {
            $namespace .= '\\';
        }

        return "\\App\\Transformers\\{$namespace}{$baseName}";
    }
}
