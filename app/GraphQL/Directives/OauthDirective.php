<?php

namespace App\GraphQL\Directives;

use App\GraphQL\ErrorCodes;
use App\GraphQL\Exceptions\AuthorisationException;
use Closure;
use GraphQL\Language\AST\TypeDefinitionNode;
use GraphQL\Language\AST\TypeExtensionNode;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Schema\AST\ASTHelper;
use Nuwave\Lighthouse\Schema\AST\DocumentAST;
use Nuwave\Lighthouse\Schema\Directives\BaseDirective;
use Nuwave\Lighthouse\Schema\Values\FieldValue;
use Nuwave\Lighthouse\Support\Contracts\FieldMiddleware;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Nuwave\Lighthouse\Support\Contracts\TypeExtensionManipulator;
use Nuwave\Lighthouse\Support\Contracts\TypeManipulator;

class OauthDirective extends BaseDirective implements FieldMiddleware, TypeManipulator, TypeExtensionManipulator
{
    public static function definition(): string
    {
        return /** @lang GraphQL */ <<<'GRAPHQL'
directive @oauth on OBJECT | FIELD_DEFINITION
GRAPHQL;
    }

    public function handleField(FieldValue $fieldValue, Closure $next)
    {
        $originalResolver = $fieldValue->getResolver();

        return $next(
            $fieldValue->setResolver(
                function ($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo) use ($originalResolver) {
                    $token = oauth_token();

                    if ($token === null) {
                        throw new AuthorisationException(ErrorCodes::AUTH_MISSING_TOKEN);
                    }

                    return $originalResolver($root, $args, $context, $resolveInfo);
                }
            )
        );
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
