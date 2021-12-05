<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Providers;

use App\GraphQL\Providers\ResolverProvider;
use Closure;
use GraphQL\Language\AST\EnumTypeDefinitionNode;
use GraphQL\Language\AST\FieldDefinitionNode;
use GraphQL\Language\AST\NamedTypeNode;
use GraphQL\Language\AST\ObjectTypeDefinitionNode;
use GraphQL\Language\AST\ScalarTypeDefinitionNode;
use GraphQL\Language\AST\TypeNode;
use GraphQL\Language\Parser;
use GraphQL\Type\Definition\Type;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Nuwave\Lighthouse\Events\ManipulateAST;
use Nuwave\Lighthouse\Schema\AST\ASTHelper;
use Nuwave\Lighthouse\Support\Contracts\ProvidesResolver;

class GraphQLServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Dispatcher $dispatcher)
    {
        // Registers GraphQL performance tracing
        if ($this->app->environment('local')) {
            $this->app->register('\Nuwave\Lighthouse\Tracing\TracingServiceProvider');
        }

        $dispatcher->listen(
            ManipulateAST::class,
            Closure::fromCallable([static::class, 'handleManipulateAST'])
        );
    }

    /**
     * Registers the custom default resolver
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProvidesResolver::class, ResolverProvider::class);
    }

    /**
     * We're manipulating the AST here to programatically assign complexity costs
     * This should only be run once everytime the schema cache is rebuilt, so performance isn't too big of a worry
     */
    public static function handleManipulateAST(ManipulateAST $manipulateAST)
    {
        $documentAST = $manipulateAST->documentAST;

        /* First create a temporary registry of enums and scalars, which are leaf types */
        $leafTypeRegistry = array_keys(Type::getStandardTypes()); // Default scalar types
        foreach ($documentAST->types as $typeDefinition) {
            if (
                $typeDefinition instanceof EnumTypeDefinitionNode ||
                $typeDefinition instanceof ScalarTypeDefinitionNode
            ) {
                array_push($leafTypeRegistry, $typeDefinition->name->value);
            }
        }

        /* Then we go through the tree again and assign cost 1 to leaf types and cost 2 to objects */
        foreach ($documentAST->types as $typeDefinition) {
            if ($typeDefinition instanceof ObjectTypeDefinitionNode) {
                /** @var iterable<\GraphQL\Language\AST\FieldDefinitionNode> $fieldDefinitions */
                $fieldDefinitions = $typeDefinition->fields;
                foreach ($fieldDefinitions as $fieldDefinition) {
                    static::applyCostToField($leafTypeRegistry, $fieldDefinition, $typeDefinition);
                }
            }
        }
    }

    private static function applyCostToField(array $leafTypeRegistry, FieldDefinitionNode $fieldDefinition, ObjectTypeDefinitionNode $typeDefinition)
    {
        /* Recurse until we can retrieve the field's type name */
        $fieldType = $fieldDefinition->type;
        while ($fieldType instanceof TypeNode) {
            if ($fieldType instanceof NamedTypeNode) {
                $fieldType = $fieldType->name->value;
            } else {
                $fieldType = $fieldType->type;
            }
        }

        $cost = 1;

        /* If the type isn't found in our prior leaf registry, assume object and assign cost 2 */
        if (!in_array($fieldType, $leafTypeRegistry, true)) {
            $cost = 2;
        }

        /* Assuming 'data' is part of pagination, assign cost 0 since it has virtually no overhead */
        if ($fieldDefinition->name->value === 'data' && str_ends_with($typeDefinition->name->value, 'Paginator')) {
            $cost = 0;
        }

        /* Checks if there's already a cost directive on the field */
        /** @var iterable<\GraphQL\Language\AST\DirectiveNode> $iterator */
        $iterator = $fieldDefinition->directives->getIterator();
        foreach ($iterator as $directive) {
            Log::debug($directive->name->value);
            if ($directive->name->value === 'cost') {
                return;
            }
        }

        /* Finally, apply the cost to the field */
        $fieldDefinition->directives = ASTHelper::prepend(
            $fieldDefinition->directives,
            Parser::constDirective(/** @lang GraphQL */ '@cost(complexity: '.$cost.')')
        );
    }
}
