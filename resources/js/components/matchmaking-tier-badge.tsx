// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { RulesetId } from 'interfaces/ruleset';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';

interface Props {
  rank: number;
  rulesetId: RulesetId;
  tier: string;
}

export default function MatchmakingTierBadge(props: Props) {
  return (
    <div className={classWithModifiers('matchmaking-tier-badge', [...props.tier.split(' '), props.rulesetId].join('-'))}>
      {props.tier === 'Lustrous' &&
        <div className={classWithModifiers('matchmaking-tier-badge__lustrous-rank', `rank-${props.rank}`)} />
      }
    </div>
  );
}
