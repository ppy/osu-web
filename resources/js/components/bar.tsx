// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { clamp } from 'lodash';
import * as React from 'react';
import { classWithModifiers, Modifiers } from 'utils/css';
import { formatNumber } from 'utils/html';

interface Props {
  current: number;
  modifiers?: Modifiers;
  textPrecision?: number;
  title?: string;
  total: number;
}

export default function Bar(props: Props) {
  let percentage = props.total === 0 ? 0 : props.current / props.total;
  percentage = clamp(percentage, 0, 1);

  return (
    <div
      className={classWithModifiers('bar', props.modifiers)}
      style={{ '--fill': `${percentage * 100}%` } as React.CSSProperties}
      title={props.title}
    >
      <div className='bar__fill' />
      {props.textPrecision != null && (
        <div className='bar__text'>
          {formatNumber(percentage, props.textPrecision, { style: 'percent' })}
        </div>
      )}
    </div>
  );
}
