// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import osu from 'osu-common';
import * as React from 'react';

interface Props {
  mod: string;
  modifiers?: string[];
}

export default function Mod(props: Props) {
  let blockClass = osu.classWithModifiers('mod', props.modifiers);
  blockClass += ` mod--${props.mod}`;

  return (
    <div
      className={blockClass}
      title={osu.trans(`beatmaps.mods.${props.mod}`)}
    />
  );
}
