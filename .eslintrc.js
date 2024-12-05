// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

module.exports = {
  env: {
    es2020: true,
    node: true,
  },
  extends: [
    'eslint:recommended',
  ],
  overrides: [
    {
      extends: [
        'plugin:@typescript-eslint/recommended',
        'plugin:@typescript-eslint/recommended-requiring-type-checking',
        'plugin:react-hooks/recommended',
        'plugin:react/recommended',
      ],
      files: ['resources/js/**/*.{ts,tsx}', 'tests/karma/**/*.{ts,tsx}'],
      parser: '@typescript-eslint/parser',
      plugins: [
        '@typescript-eslint',
        'eslint-plugin-react',
        'typescript-sort-keys',
      ],
      rules: {
        '@stylistic/member-delimiter-style': 'error',
        '@stylistic/type-annotation-spacing': 'error',
        '@typescript-eslint/array-type': [
          'error',
          {
            default: 'array',
          },
        ],
        '@typescript-eslint/consistent-type-assertions': 'error',
        '@typescript-eslint/consistent-type-definitions': 'error',
        '@typescript-eslint/dot-notation': 'error',
        '@typescript-eslint/explicit-member-accessibility': [
          'error',
          {
            accessibility: 'no-public',
          },
        ],
        '@typescript-eslint/explicit-module-boundary-types': 'off',
        '@typescript-eslint/member-ordering': [
          'error',
          {
            default: {
              memberTypes: [
                'public-static-field',
                'protected-static-field',
                'private-static-field',

                'public-instance-field',
                'protected-instance-field',
                'private-instance-field',

                'public-constructor',
                'protected-constructor',
                'private-constructor',

                'public-static-method',
                'protected-static-method',
                'private-static-method',

                'public-instance-method',
                'protected-instance-method',
                'private-instance-method',
              ],
              order: 'alphabetically-case-insensitive',
            },
          },
        ],
        '@typescript-eslint/naming-convention': 'off',
        '@typescript-eslint/no-explicit-any': 'off',
        // JQuery's `done`/`fail`/`always` aren't properly supported.
        // Even if we change `done` to `then` and `fail` to `catch`, there's
        // no replacement for `always` short of changing the rule itself
        // or appending empty `.then().catch()`.
        // Blindly appending `void` isn't all that useful either.
        '@typescript-eslint/no-floating-promises': 'off',
        '@typescript-eslint/no-invalid-this': 'error',
        '@typescript-eslint/no-parameter-properties': 'off',
        '@typescript-eslint/no-shadow': ['error', { hoist: 'all' }],
        '@typescript-eslint/no-unsafe-argument': 'warn',
        '@typescript-eslint/no-unsafe-assignment': 'warn',
        '@typescript-eslint/no-unsafe-call': 'warn',
        '@typescript-eslint/no-unsafe-member-access': 'warn',
        '@typescript-eslint/no-unsafe-return': 'warn',
        '@typescript-eslint/no-unused-expressions': 'error',
        '@typescript-eslint/no-unused-vars': [
          'error', {
            argsIgnorePattern: '^_',
            caughtErrorsIgnorePattern: '^_',
            ignoreRestSiblings: true,
          },
        ],
        '@typescript-eslint/no-use-before-define': 'off',
        '@typescript-eslint/prefer-for-of': 'error',
        '@typescript-eslint/prefer-function-type': 'error',
        '@typescript-eslint/prefer-readonly': 'error',
        '@typescript-eslint/restrict-template-expressions': [
          'error',
          {
            allowAny: false,
            allowBoolean: true,
            allowNullish: true,
            allowNumber: true,
          },
        ],
        // TODO: make more strict.
        '@typescript-eslint/strict-boolean-expressions': [
          'error',
          {
            allowNullableBoolean: true,
          },
        ],
        '@typescript-eslint/unified-signatures': 'error',
        'dot-notation': 'off',
        'no-invalid-this': 'off',
        'no-shadow': 'off',
        'react-hooks/exhaustive-deps': 'error',
        'react/jsx-boolean-value': 'error',
        'react/jsx-curly-spacing': 'error',
        'react/jsx-equals-spacing': 'error',
        'react/jsx-max-props-per-line': ['error', { when: 'multiline' }],
        'react/jsx-no-bind': 'error',
        'react/jsx-sort-props': ['error', { reservedFirst: true }],
        'react/jsx-tag-spacing': ['error', {
          afterOpening: 'never',
          beforeClosing: 'never',
          beforeSelfClosing: 'always',
          closingSlash: 'never',
        }],
        'react/jsx-wrap-multilines': 'error',
        'react/no-deprecated': 'warn',
        'react/no-unsafe': 'off',
        'react/self-closing-comp': 'error',
        semi: 'off',
        'typescript-sort-keys/interface': ['error', 'asc', { caseSensitive: false }],
        'typescript-sort-keys/string-enum': ['error', 'asc', { caseSensitive: false }],
      },
      settings: {
        react: {
          version: 'detect',
        },
      },
    },
    {
      env: {
        browser: true,
        node: false,
      },
      files: ['resources/js/**/*.{ts,tsx}'],
      parserOptions: {
        project: 'tsconfig.json',
        sourceType: 'module',
      },
    },
    {
      env: {
        browser: false,
        node: true,
      },
      files: ['tests/karma/**/*.{ts,tsx}'],
      parserOptions: {
        project: 'tests/karma/tsconfig.json',
        sourceType: 'module',
      },
    },
  ],
  parserOptions: {
    sourceType: 'module',
  },
  plugins: [
    '@stylistic',
    'eslint-plugin-jsdoc',
    'eslint-plugin-import',
  ],
  rules: {
    '@stylistic/arrow-parens': 'error',
    '@stylistic/arrow-spacing': 'error',
    '@stylistic/brace-style': 'error',
    '@stylistic/comma-dangle': ['error', 'always-multiline'],
    '@stylistic/eol-last': 'error',
    '@stylistic/indent': [
      'error',
      2,
      {
        FunctionDeclaration: {
          parameters: 'first',
        },
        FunctionExpression: {
          parameters: 'first',
        },
        SwitchCase: 1,
      },
    ],
    '@stylistic/max-len': 'off',
    '@stylistic/new-parens': 'error',
    '@stylistic/no-multiple-empty-lines': 'error',
    '@stylistic/no-trailing-spaces': 'error',
    '@stylistic/object-curly-spacing': ['error', 'always'],
    '@stylistic/quote-props': ['error', 'as-needed'],
    '@stylistic/quotes': [
      'error',
      'single',
      { avoidEscape: true },
    ],
    '@stylistic/semi': ['error', 'always'],
    '@stylistic/space-before-function-paren': [
      'error',
      {
        anonymous: 'never',
        asyncArrow: 'always',
        named: 'never',
      },
    ],
    '@stylistic/spaced-comment': 'error',
    'arrow-body-style': 'error',
    complexity: 'off',
    curly: ['error', 'multi-line'],
    'dot-notation': 'error',
    eqeqeq: ['error', 'smart'],
    'guard-for-in': 'error',
    'id-denylist': [
      'error',
      'any',
      'Number',
      'number',
      'String',
      'string',
      'Boolean',
      'boolean',
      'Undefined',
      'undefined',
    ],
    'id-match': 'error',
    'import/order': ['error', { alphabetize: { order: 'asc' } }],
    'jsdoc/check-alignment': 'error',
    'jsdoc/check-indentation': 'error',
    'jsdoc/tag-lines': ['error', 'never', { startLines: 1 }],
    'max-classes-per-file': 'error',
    'no-bitwise': 'error',
    'no-caller': 'error',
    'no-console': ['error', { allow: ['error', 'warn'] }],
    'no-empty-function': 'error',
    'no-eval': 'error',
    'no-invalid-this': 'error',
    'no-new-wrappers': 'error',
    'no-shadow': ['error', { hoist: 'all' }],
    'no-throw-literal': 'error',
    'no-undef-init': 'error',
    'no-unsafe-finally': 'error',
    'object-shorthand': 'error',
    'one-var': ['error', 'never'],
    radix: 'error',
    'sort-keys': ['error', 'asc', { caseSensitive: false }],
  },
};
