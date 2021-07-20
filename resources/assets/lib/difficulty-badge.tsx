// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { getDiffColour } from 'utils/beatmap-helper';

export default function DifficultyBadge(props: { rating: number }) {
  return (
    <div
      className={'difficulty-badge' + (props.rating >= 6.5 ? ' difficulty-badge--expert-plus' : '')}
      style={{
        '--bg': getDiffColour(props.rating),
      } as React.CSSProperties}
    >
      <span className='difficulty-badge__icon'>
        <span className='fas fa-star' />
      </span>
      {osu.formatNumber(props.rating, 2)}
    </div>
  );
}
