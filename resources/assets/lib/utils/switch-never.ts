// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

/**
 * Function for exhaustive check in switch statements by trying to assign the predicate to never.
 *
 * @param _never
 */
export function switchNever(_never: never) {
  // just exist.
}
