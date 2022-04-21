// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { classWithModifiers } from 'utils/css';

interface Props {
  mod: string;
}

export default function Mod({ mod }: Props) {
  return (
    <div
      className={classWithModifiers('mod', mod)}
      title={osu.trans(`beatmaps.mods.${mod}`)}
    />
  );
}
