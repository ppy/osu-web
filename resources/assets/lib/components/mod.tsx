// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import modNames from 'mod-names.json';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';

interface Props {
  mod: string;
}

export default function Mod({ mod }: Props) {
  const modJson = modNames[mod] ?? {
    acronym: mod,
    name: '',
    type: 'Fun',
  };

  return (
    <div
      className={classWithModifiers('mod', modJson.acronym, `type-${modJson.type}`)}
      data-acronym={modJson.acronym}
      title={modJson.name}
    />
  );
}
