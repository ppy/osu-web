// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

module.exports = {
  env: {
    es2017: true,
    node: true,
  },
  extends: [
    "eslint:recommended",
  ],
  overrides: [{
    env: {
      browser: true,
      node: false,
    },
    extends: [
      "plugin:@typescript-eslint/recommended",
      "plugin:@typescript-eslint/recommended-requiring-type-checking",
      "plugin:react/recommended",
      "plugin:react-hooks/recommended",
    ],
    files: ["resources/assets/lib/**/*.{js,jsx,ts,tsx}"],
    parser: "@typescript-eslint/parser",
    parserOptions: {
      project: "tsconfig.json",
      sourceType: "module",
    },
    plugins: [
      "eslint-plugin-react",
      "@typescript-eslint",
    ],
    rules: {
      "@typescript-eslint/array-type": [
        "error",
        {
          default: "array",
        },
      ],
      "@typescript-eslint/consistent-type-assertions": "error",
      "@typescript-eslint/consistent-type-definitions": "error",
      "@typescript-eslint/dot-notation": "error",
      "@typescript-eslint/explicit-member-accessibility": [
        "error",
        {
          accessibility: "no-public",
        },
      ],
      "@typescript-eslint/explicit-module-boundary-types": "off",
      "@typescript-eslint/indent": [
        "error",
        2,
        {
          FunctionDeclaration: {
            parameters: "first",
          },
          FunctionExpression: {
            parameters: "first",
          },
          SwitchCase: 1,
        },
      ],
      "@typescript-eslint/member-delimiter-style": "error",
      "@typescript-eslint/member-ordering": [
        "error",
        {
          default: [
            "public-static-field",
            "protected-static-field",
            "private-static-field",

            "public-instance-field",
            "protected-instance-field",
            "private-instance-field",

            "public-constructor",
            "protected-constructor",
            "private-constructor",

            "public-static-method",
            "protected-static-method",
            "private-static-method",

            "public-instance-method",
            "protected-instance-method",
            "private-instance-method",
          ],
        },
      ],
      "@typescript-eslint/naming-convention": "off",
      "@typescript-eslint/no-explicit-any": "off",
      "@typescript-eslint/no-invalid-this": ["error"],
      "@typescript-eslint/no-parameter-properties": "off",
      "@typescript-eslint/no-unsafe-assignment": "warn",
      "@typescript-eslint/no-unsafe-call": "warn",
      "@typescript-eslint/no-unsafe-member-access": "warn",
      "@typescript-eslint/no-unsafe-return": "warn",
      "@typescript-eslint/no-unused-expressions": "error",
      "@typescript-eslint/no-use-before-define": "off",
      "@typescript-eslint/prefer-for-of": "error",
      "@typescript-eslint/prefer-function-type": "error",
      "@typescript-eslint/quotes": [
        "error",
        "single",
        { avoidEscape: true },
      ],
      "@typescript-eslint/restrict-template-expressions": [
        "error",
        {
          allowAny: false,
          allowBoolean: true,
          allowNullish: true,
          allowNumber: true,
        },
      ],
      "@typescript-eslint/semi": [
        "error",
        "always",
      ],
      "@typescript-eslint/type-annotation-spacing": "error",
      "@typescript-eslint/unbound-method": "warn", // TODO: some calls are intentionally unbounded...
      "@typescript-eslint/unified-signatures": "error",
      "no-fallthrough": "off",
      "no-invalid-this": "off", // @typescript-eslint/no-invalid-this
      "react-hooks/exhaustive-deps": "error",
      "react/jsx-boolean-value": "error",
      "react/jsx-curly-spacing": [
        "error",
        {
          when: "never",
        },
      ],
      "react/jsx-equals-spacing": [
        "error",
        "never",
      ],
      "react/jsx-max-props-per-line": ["error", { when: "multiline" }],
      "react/jsx-no-bind": "error",
      "react/jsx-sort-props": ["error", { reservedFirst: true }],
      "react/jsx-wrap-multilines": "error",
      "react/no-deprecated": "warn",
      "react/no-unsafe": "off",
      "react/self-closing-comp": "error",
    },
    settings: {
      react: {
        version: "detect",
      },
    },
  }],
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
    "sort-keys": ["error", "asc", { caseSensitive: false }],
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
