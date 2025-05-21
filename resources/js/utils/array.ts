// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export function mobxArrayGet<T>(array: T[] | null | undefined, index: number): T | undefined {
  if (index < 0) {
    index += array?.length ?? 0;
  }

  return array != null && array.length > index ? array[index] : undefined;
}
