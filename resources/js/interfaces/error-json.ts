// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export default interface ErrorJson {
  error: string;
}

export function isErrorJson(arg: unknown): arg is ErrorJson {
  return typeof arg === 'object'
    && arg != null
    && 'error' in arg
    && typeof arg.error === 'string';
}
