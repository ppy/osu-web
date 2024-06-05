// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export const rulesets = ['osu', 'taiko', 'fruits', 'mania'] as const;

export function ensureGameMode(maybeMode: string): Ruleset | undefined {
  if ((rulesets as Readonly<string[]>).includes(maybeMode)) {
    return maybeMode as Ruleset;
  }
}

type Ruleset = typeof rulesets[number];

export default Ruleset;
