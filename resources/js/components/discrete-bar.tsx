// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { times } from 'lodash';
import * as React from 'react';
import { classWithModifiers, Modifiers } from 'utils/css';

interface Props {
  current: number;
  label?: React.ReactNode;
  modifiers?: Modifiers;
  total: number;
}

export default function DiscreteBar(props: Props) {
  const current = Math.max(0, props.current);
  const total = Math.max(1, props.total);

  return (
    <div className={classWithModifiers('discrete-bar', props.modifiers)}>
      {times(total, (i) => (
        <div
          key={i}
          className={classWithModifiers('discrete-bar__item', { on: i < current })}
        >
          {props.label}
        </div>
      ))}
    </div>
  );
}
