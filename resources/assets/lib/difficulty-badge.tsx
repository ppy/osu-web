// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { getDiffRating } from 'utils/beatmap-helper';
import { classWithModifiers } from 'utils/css';

export default function DifficultyBadge(props: { rating: number; modifiers?: string[] }) {
  return (
    <div
      className={classWithModifiers('difficulty-badge', props.modifiers)}
      style={{
        '--bg': `var(--diff-${getDiffRating(props.rating)})`,
      } as React.CSSProperties}
    >
      <span className='difficulty-badge__icon'>
        <span className='fas fa-star' />
      </span>
      {osu.formatNumber(props.rating, 2)}
    </div>
  );
}
