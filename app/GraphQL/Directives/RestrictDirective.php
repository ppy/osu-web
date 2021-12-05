<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\GraphQL\Directives;

use App\GraphQL\ErrorCodes;
use App\GraphQL\Exceptions\AuthorisationException;
use App\GraphQL\Exceptions\MissingScopesException;
use Closure;
use GraphQL\Language\AST\FieldDefinitionNode;
use GraphQL\Language\AST\ObjectTypeDefinitionNode;
use GraphQL\Language\AST\TypeDefinitionNode;
use GraphQL\Language\AST\TypeExtensionNode;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Exceptions\DefinitionException;
use Nuwave\Lighthouse\Schema\AST\ASTHelper;
use Nuwave\Lighthouse\Schema\AST\DocumentAST;
use Nuwave\Lighthouse\Schema\Directives\BaseDirective;
use Nuwave\Lighthouse\Schema\Values\FieldValue;
use Nuwave\Lighthouse\Support\Contracts\ArgDirective;
use Nuwave\Lighthouse\Support\Contracts\ArgSanitizerDirective;
use Nuwave\Lighthouse\Support\Contracts\FieldManipulator;
use Nuwave\Lighthouse\Support\Contracts\FieldMiddleware;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Nuwave\Lighthouse\Support\Contracts\TypeExtensionManipulator;
use Nuwave\Lighthouse\Support\Contracts\TypeManipulator;

/**
 * GraphQL directive for general authorisation checks
 */
class RestrictDirective extends BaseDirective implements FieldManipulator, FieldMiddleware, TypeManipulator, TypeExtensionManipulator, ArgSanitizerDirective, ArgDirective
{
    public static function definition(): string
    {
        return /** @lang GraphQL */ <<<GRAPHQL
"""
Limit field or type access
"""
directive @restrict(
    """
    Scopes that the token needs to have
    """
    scopes: [String!]
  
    """
    On fields of a user type, only allow access if the user is the same as the token's
    """
    isCurrentUser: Boolean
  
    """
    Requires that the user associated with the auth token has supporter
    """
    requiresSupporter: Boolean
) on OBJECT | FIELD_DEFINITION | ARGUMENT_DEFINITION
GRAPHQL;
    }

    public function handleField(FieldValue $fieldValue, Closure $next): FieldValue
    {
        $originalResolver = $fieldValue->getResolver();

        return $next(
            $fieldValue->setResolver(
                function ($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo) use ($originalResolver) {
                    $this->checkScope();
                    $this->checkCurrentUser($context, $root);
                    $this->checkSupporter();

                    return $originalResolver($root, $args, $context, $resolveInfo);
                }
            )
        );
    }

    public function sanitize($argumentValue)
    {
        $this->checkScope();
        $this->checkSupporter();

        return $argumentValue;
    }

    public function checkScope()
    {
        $token = oauth_token();

        $scopes = $this->directiveArgValue('scopes');
        if ($scopes === null) {
            return true;
        }

        if ($token === null) {
            throw new AuthorisationException(ErrorCodes::AUTH_MISSING_TOKEN);
            return;
        }

        $missingScopes = [];
        foreach ($scopes as $scope) {
            if ($scope !== 'any' && !$token->can($scope)) {
                array_push($missingScopes, $scope);
            }
        }

        if (count($missingScopes) !== 0) {
            throw new MissingScopesException($missingScopes);
        }
    }

    public function checkCurrentUser(GraphQLContext $context, $root)
    {
        $shouldCheck = $this->directiveArgValue('isCurrentUser');
        if ($shouldCheck === null || $shouldCheck === false) {
            return;
        }

        if ($root->user_id !== null && $context->user()->user_id === $root->user_id) {
            return;
        }

        throw new AuthorisationException(ErrorCodes::AUTH_OWNER_ONLY);
    }

    public function checkSupporter()
    {
        $shouldCheck = $this->directiveArgValue('requiresSupporter');
        if ($shouldCheck === null || $shouldCheck === false) {
            return;
        }

        if (auth()->user()->isSupporter()) {
            return;
        }

        throw new AuthorisationException(ErrorCodes::AUTH_SUPPORTER_REQUIRED);
    }

    /* Checks that the `isCurrentUser` argument is only used on fields of object type User */
    public function manipulateFieldDefinition(DocumentAST &$documentAST, FieldDefinitionNode &$fieldDefinition, ObjectTypeDefinitionNode &$parentType)
    {
        /** @var iterable<\GraphQL\Language\AST\DirectiveNode> $directiveIterator */
        $directiveIterator = $fieldDefinition->directives->getIterator();
        foreach ($directiveIterator as $directive) {
            if ($directive->name->value !== 'restrict') {
                continue;
            }

            /** @var iterable<\GraphQL\Language\AST\InputValueDefinitionNode> $argIterator */
            $argIterator = $directive->arguments->getIterator();
            foreach ($argIterator as $argument) {
                if ($argument->name->value === 'isCurrentUser') {
                    if ($parentType->name->value !== 'User') {
                        throw new DefinitionException('@restrict(isCurrentUser) used on field of non-user object');
                    }
                }
            }
        }
    }

    public function manipulateTypeDefinition(DocumentAST &$documentAST, TypeDefinitionNode &$typeDefinition): void
    {
        ASTHelper::addDirectiveToFields($this->directiveNode, $typeDefinition);
    }

    public function manipulateTypeExtension(DocumentAST &$documentAST, TypeExtensionNode &$typeExtension): void
    {
        ASTHelper::addDirectiveToFields($this->directiveNode, $typeExtension);
    }
}
