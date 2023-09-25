// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

const postcssLess = require('postcss-less');

const blockElementModifier = '^[a-z][a-z0-9]*((--?|__?)[a-z0-9]+)*$';
const blockModifier =        '^[a-z][a-z0-9]*((--?|_)[a-z0-9]+)*$';

module.exports = {
  customSyntax: postcssLess,
  extends: [
    'stylelint-config-standard',
    'stylelint-stylistic/config',
  ],
  ignoreFiles: [
    'resources/css/entrypoints/docs.less',
    'resources/css/jquery-ui/slider.less',
    'resources/css/jquery-ui/theme.less',
    'resources/css/torus.less',
  ],
  reportInvalidScopeDisables: true,
  reportNeedlessDisables: true,
  rules: {
    // Overrides for stylelint-config-standard
    'alpha-value-notation': 'number',
    'at-rule-empty-line-before': [
      'always',
      {
        except: ['first-nested'],
        ignore: ['after-comment', 'blockless-after-same-name-blockless'],
      },
    ],
    'color-function-notation': [
      'legacy',
      { ignore: ['with-var-inside'] },
    ],
    'custom-property-empty-line-before': null,
    'custom-property-pattern': blockModifier,
    'declaration-block-no-redundant-longhand-properties': [
      true,
      { ignoreShorthands: ['flex-flow', 'grid-template', 'inset'] },
    ],
    'declaration-empty-line-before': null,
    'font-family-no-missing-generic-family-keyword': [
      true,
      { ignoreFontFamilies: [/^FontAwesome/] },
    ],
    'hue-degree-notation': 'number',
    'keyframes-name-pattern': blockModifier,
    'property-no-vendor-prefix': null,
    'selector-class-pattern': [
      blockElementModifier,
      { resolveNestedSelectors: true },
    ],
    'value-keyword-case': [
      'lower',
      { camelCaseSvgKeywords: true },
    ],

    // Overrides for stylelint-stylistic/config
    // eslint-disable-next-line sort-keys
    'stylistic/block-opening-brace-space-before': [
      'always',
      { ignoreSelectors: [/^[0-9.]+%$/] },
    ],
    'stylistic/selector-list-comma-newline-after': 'always-multi-line',

    // Support Less syntax
    // eslint-disable-next-line sort-keys
    'function-no-unknown': null,
    'import-notation': 'string',
    'media-query-no-invalid': null,

    // Extra rules
    // eslint-disable-next-line sort-keys
    'font-weight-notation': 'named-where-possible',
    'stylistic/at-rule-name-newline-after': 'always-multi-line',
    'stylistic/at-rule-semicolon-space-before': 'never',
    'stylistic/declaration-block-semicolon-newline-before': 'never-multi-line',
    'stylistic/function-comma-newline-before': 'never-multi-line',
    'stylistic/linebreaks': 'unix',
    'stylistic/media-query-list-comma-newline-before': 'never-multi-line',
    'stylistic/selector-list-comma-newline-before': 'never-multi-line',
    'stylistic/selector-list-comma-space-after': 'always-single-line',
    'stylistic/unicode-bom': 'never',
    'stylistic/value-list-comma-newline-before': 'never-multi-line',
  },
};
