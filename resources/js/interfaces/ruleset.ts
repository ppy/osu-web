// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export const rulesetIdToName = {
  0: 'osu',
  1: 'taiko',
  2: 'fruits',
  3: 'mania',
} as const;
export const rulesets = Object.values(rulesetIdToName);

export function ensureRuleset(maybeRuleset: string): Ruleset | undefined {
  if ((rulesets as readonly string[]).includes(maybeRuleset)) {
    return maybeRuleset as Ruleset;
  }
}

export type RulesetId = keyof typeof rulesetIdToName;
type Ruleset = typeof rulesetIdToName[RulesetId];

export default Ruleset;
