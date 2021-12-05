<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\GraphQL\Providers;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Str;
use Nuwave\Lighthouse\Exceptions\DefinitionException;
use Nuwave\Lighthouse\Schema\Values\FieldValue;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Nuwave\Lighthouse\Support\Contracts\ProvidesResolver;
use Nuwave\Lighthouse\Support\Utils;

class ResolverProvider implements ProvidesResolver
{
    public function provideResolver(FieldValue $fieldValue): Closure
    {
        return Closure::fromCallable([static::class, 'fieldResolver']);
    }

    public static function fieldResolver(...$params)
    {
        $fieldName = $params[3]->fieldName;

        return static::findCustomResolver(...$params)
            ?? static::tryResolve($fieldName, ...$params)
            ?? static::tryResolve($fieldName, ...$params);
    }

    public static function findCustomResolver($root, array $args, GraphQLContext $context, ResolveInfo $info)
    {
        $splitRootClass = explode('\\', get_class($root));
        $rootName = end($splitRootClass);

        $className = Str::studly($rootName).'Resolver';
        $methodName = Str::camel($info->fieldName);

        $namespacedClassName = Utils::namespaceClassName(
            $className,
            (array) config('lighthouse.namespaces.resolvers'),
            'class_exists'
        );

        if (!$namespacedClassName) {
            return null;
        }

        try {
            $resolver = Utils::constructResolver($namespacedClassName, $methodName);
        } catch (DefinitionException) {
            return null;
        }

        return $resolver instanceof Closure
            ? $resolver($root, $args, $context, $info)
            : null;
    }

    public static function tryResolve(string $fieldName, $root, array $args, GraphQLContext $context, ResolveInfo $info)
    {
        $property = null;

        if (is_array($root) || $root instanceof \ArrayAccess) {
            if (isset($root[$fieldName])) {
                $property = $root[$fieldName];
            }
        } elseif (is_object($root)) {
            if (isset($root->{$fieldName})) {
                $property = $root->{$fieldName};
            }
        }

        return $property instanceof Closure
            ? $property($root, $args, $context, $info)
            : $property;
    }
}
