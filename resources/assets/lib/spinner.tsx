// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { classWithModifiers, Modifiers } from 'utils/css';

interface Props {
  modifiers?: Modifiers;
}

export function Spinner(props: Props) {
  return (
    <div
      className={classWithModifiers('la-ball-clip-rotate', props.modifiers)}
    />
  );
}
