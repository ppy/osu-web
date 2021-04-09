// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

module.exports = {
  env: {
    es6: true,
    node: true,
  },
  extends: [
    "eslint:recommended",
  ],
  parserOptions: {
    sourceType: "module",
  },
  plugins: [
    "eslint-plugin-jsdoc",
    "eslint-plugin-import",
  ],
  rules: {
    "arrow-body-style": "error",
    "arrow-parens": [
      "error",
      "always",
    ],
    "brace-style": [
      "error",
      "1tbs",
    ],
    "comma-dangle": [
      "error",
      "always-multiline",
    ],
    "complexity": "off",
    "curly": [
      "error",
      "multi-line",
    ],
    "eol-last": "error",
    "eqeqeq": [
      "error",
      "smart",
    ],
    "guard-for-in": "error",
    "id-blacklist": [
      "error",
      "any",
      "Number",
      "number",
      "String",
      "string",
      "Boolean",
      "boolean",
      "Undefined",
      "undefined",
    ],
    "id-match": "error",
    "import/order": "error",
    "jsdoc/check-alignment": "error",
    "jsdoc/check-indentation": "error",
    "jsdoc/newline-after-description": "error",
    "max-classes-per-file": [
      "error",
      1,
    ],
    "max-len": "off",
    "new-parens": "error",
    "no-bitwise": "error",
    "no-caller": "error",
    "no-console": "warn",
    "no-eval": "error",
    "no-multiple-empty-lines": "error",
    "no-new-wrappers": "error",
    "no-shadow": [
      "error",
      {
        hoist: "all",
      },
    ],
    "no-throw-literal": "error",
    "no-trailing-spaces": "error",
    "no-undef-init": "error",
    "no-underscore-dangle": "error",
    "no-unsafe-finally": "error",
    "object-shorthand": "error",
    "one-var": [
      "error",
      "never",
    ],
    "quote-props": [
      "error",
      "consistent-as-needed",
    ],
    "radix": "error",
    "sort-keys": "error",
    "space-before-function-paren": [
      "error",
      {
        anonymous: "never",
        asyncArrow: "always",
        named: "never",
      },
    ],
    "spaced-comment": [
      "error",
      "always",
      {
        markers: [
          "/",
        ],
      },
    ],
  },
};
