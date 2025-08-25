// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { getDiffColour, getDiffTextColour } from 'utils/beatmap-helper';
import { formatNumber } from 'utils/html';

export default function DifficultyBadge(props: { rating: number }) {
  return (
    <div
      className='difficulty-badge'
      style={{
        'color': getDiffTextColour(props.rating),
        '--bg': getDiffColour(props.rating),
      } as React.CSSProperties}
    >
      <span className='difficulty-badge__icon'>
        <span className='fas fa-star' />
      </span>
      <span className='difficulty-badge__rating'>
        {formatNumber(props.rating, 2)}
      </span>
    </div>
  );
}
