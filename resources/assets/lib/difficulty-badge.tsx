// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import osu from 'osu-common';
import * as React from 'react';
import { getDiffRating } from 'utils/beatmap-helper';

export default function DifficultyBadge(props: { rating: number }) {
  return (
    <div
      className='difficulty-badge'
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
