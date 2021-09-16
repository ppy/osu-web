<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
        /** @var TransformerAbstract $transformer */
        $transformer = new $class();
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
            $transformer = new $class();

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
            if (
                $reflectionClass->isSubclassOf(FractalTrasformerAbstract::class)
                && $reflectionClass->getName() !== (new ReflectionClass(TransformerAbstract::class))->getName()
            ) {
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
