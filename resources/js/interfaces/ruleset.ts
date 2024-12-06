// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export const rulesets = ['osu', 'taiko', 'fruits', 'mania'] as const;

export function ensureRuleset(maybeRuleset: string): Ruleset | undefined {
  if ((rulesets as readonly string[]).includes(maybeRuleset)) {
    return maybeRuleset as Ruleset;
  }
}

type Ruleset = typeof rulesets[number];

export default Ruleset;
