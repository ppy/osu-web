<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\GraphQL\Providers;

use GraphQL\Language\AST\EnumTypeDefinitionNode;
use GraphQL\Language\AST\FieldDefinitionNode;
use GraphQL\Language\AST\NamedTypeNode;
use GraphQL\Language\AST\ObjectTypeDefinitionNode;
use GraphQL\Language\AST\ScalarTypeDefinitionNode;
use GraphQL\Language\AST\TypeNode;
use GraphQL\Language\Parser;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\ServiceProvider;
use Nuwave\Lighthouse\Events\ManipulateAST;
use Nuwave\Lighthouse\Schema\AST\ASTHelper;
use Nuwave\Lighthouse\Schema\DirectiveLocator;
use Nuwave\Lighthouse\Support\Contracts\ComplexityResolverDirective;

class ComplexityProvider extends ServiceProvider
{
    protected DirectiveLocator $directiveLocator;

    /** The reason why we can't use TypeRegistry is because it's only available after the schema is built. */
    /** @var string[] $localLeafTypes */
    protected array $localLeafTypes;

    public function __construct(DirectiveLocator $directiveLocator)
    {
        $this->directiveLocator = $directiveLocator;
        $this->localLeafTypes = array_keys(Type::getStandardTypes());
    }

    /**
     * We're manipulating the AST here to programatically assign complexity costs
     * This should only be run once everytime the schema cache is rebuilt, so performance isn't too big of a worry
     */
    public function handleManipulateAST(ManipulateAST $manipulateAST)
    {
        $documentAST = $manipulateAST->documentAST;

        /* First populate our local leaf type registry */
        foreach ($documentAST->types as $typeDefinition) {
            if (
                $typeDefinition instanceof EnumTypeDefinitionNode ||
                $typeDefinition instanceof ScalarTypeDefinitionNode
            ) {
                $this->localLeafTypes[] = $typeDefinition->name->value;
            }
        }

        /* Then we go through the tree again and assign cost 1 to leaf types and cost 2 to objects */
        foreach ($documentAST->types as $typeDefinition) {
            if ($typeDefinition instanceof ObjectTypeDefinitionNode) {
                /** @var iterable<\GraphQL\Language\AST\FieldDefinitionNode> $fieldDefinitions */
                $fieldDefinitions = $typeDefinition->fields;
                foreach ($fieldDefinitions as $fieldDefinition) {
                    $this->applyCostToField($fieldDefinition, $typeDefinition);
                }
            }
        }
    }

    private function applyCostToField(FieldDefinitionNode $fieldDefinition, ObjectTypeDefinitionNode $objectDefinition)
    {
        /* Checks if there's already a custom complexity calculator on the field */
        $directive = $this->directiveLocator->exclusiveOfType(
            $fieldDefinition,
            ComplexityResolverDirective::class
        );
        if ($directive !== null) {
            return;
        }

        $fieldType = ASTHelper::getUnderlyingTypeName($fieldDefinition);
        $fieldName = $fieldDefinition->name->value;
        $objectName = $objectDefinition->name->value;
        $cost = 1;

        /* If the type isn't found in our leafs registry, assume object and assign cost 2 */
        if (!in_array($fieldType, $this->localLeafTypes, true)) {
            $cost = 2;
        }

        /* Assuming the type is generated from a paginator, assign cost 0 */
        if (ends_with($objectName, 'Connection')) {
            $cost = 0;
        }
        if ($fieldName === 'node' && ends_with($objectName, 'Edge')) {
            $cost = 0;
        }
        if ($fieldName === 'data' && ends_with($objectName, 'Paginator')) {
            $cost = 0;
        }

        /* Finally, apply the cost to the field */
        $fieldDefinition->directives = ASTHelper::prepend(
            $fieldDefinition->directives,
            Parser::constDirective(/** @lang GraphQL */ '@cost(complexity: '.$cost.')')
        );
    }
}
