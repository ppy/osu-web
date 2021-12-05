<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\GraphQL\Directives;

use Nuwave\Lighthouse\Schema\Directives\BaseDirective;
use Nuwave\Lighthouse\Schema\Values\FieldValue;
use Nuwave\Lighthouse\Support\Contracts\ComplexityResolverDirective;

class CostDirective extends BaseDirective implements ComplexityResolverDirective
{
    public static function definition(): string
    {
        return /** @lang GraphQL */ <<<'GRAPHQL'
"""
Defines the complexity cost of a field. This is a simpler alternative to the @complexity directive
"""
directive @cost(
  """
  The complexity cost of the field, used to calculate total query complexity
  By default, it's 2 for object-type fields and 1 for leaf-type (enums and scalars) fields
  """
  complexity: Number
) on FIELD_DEFINITION 
GRAPHQL;
    }

    public function complexityResolver(FieldValue $fieldValue): callable
    {
        $cost = $this->directiveArgValue('complexity', 1);
        return function (...$params) use ($cost) {
            return static::calculateCost($cost, ...$params);
        };
    }

    public static function calculateCost(int $cost, int $childrenComplexity, array $args): int
    {
        /**
         * Assuming pagination, @see PaginationManipulator::countArgument().
         */
        $first = $args['first'] ?? null;

        $expectedNumberOfChildren = is_int($first)
            ? $first
            : 1;

        return $cost + ($childrenComplexity * $expectedNumberOfChildren);
    }
}
