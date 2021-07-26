// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as osu from 'osu-common';
import * as React from 'react';
import { getDiffColour } from 'utils/beatmap-helper';
import { classWithModifiers } from 'utils/css';

export default function DifficultyBadge(props: { rating: number }) {
  return (
    <div
      className={classWithModifiers('difficulty-badge', {
        'expert-plus': props.rating >= 6.5,
      })}
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
