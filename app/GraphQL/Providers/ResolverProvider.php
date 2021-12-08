<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\GraphQL\Providers;

use Closure;
use GraphQL\Executor\Executor;
use GraphQL\Type\Definition\ResolveInfo;
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
        return static::findCustomResolver(...$params)
            ?? Executor::getDefaultFieldResolver()(...$params);
    }

    public static function findCustomResolver($root, array $args, GraphQLContext $context, ResolveInfo $info)
    {
        $splitRootClass = explode('\\', get_class($root));
        $rootName = end($splitRootClass);

        $className = studly_case($rootName).'Resolver';
        $methodName = camel_case($info->fieldName);

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
}
