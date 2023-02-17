// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export function getInt(input: unknown) {
  if (Number.isInteger(input)) {
    // Number.isInteger doesn't guard input as number.
    // Reference: https://github.com/microsoft/TypeScript/issues/15048
    return input as number;
  }

  if (typeof input === 'string') {
    const num = parseInt(input, 10);

    if (Number.isInteger(num)) {
      return num;
    }
  }
}
