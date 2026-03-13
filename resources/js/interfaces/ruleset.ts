// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { invert } from 'lodash';

export const rulesetIds = {
  fruits: 2,
  mania: 3,
  osu: 0,
  taiko: 1,
} as const;

export const rulesetNames = invert(rulesetIds) as Record<RulesetId, Ruleset>;
export const rulesets = Object.values(rulesetNames);

export function ensureRuleset(maybeRuleset: string): Ruleset | undefined {
  if (maybeRuleset in rulesetIds) {
    return maybeRuleset as Ruleset;
  }
}

export function ensureRulesetId(maybeRulesetId: number | string): RulesetId | undefined {
  if (typeof maybeRulesetId === 'string') {
    maybeRulesetId = parseInt(maybeRulesetId, 10);
  }

  if (maybeRulesetId in rulesetNames) {
    return maybeRulesetId as RulesetId;
  }
}

type Ruleset = keyof typeof rulesetIds;
export type RulesetId = typeof rulesetIds[Ruleset];

export const rulesetVariantIdToName = {
  0: '',
  4: '4k',
  7: '7k',
};
export type RulesetVariantId = keyof typeof rulesetVariantIdToName;

export default Ruleset;
