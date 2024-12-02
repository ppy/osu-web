// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import TeamJson from 'interfaces/team-json';
import * as React from 'react';
import { classWithModifiers, Modifiers } from 'utils/css';

interface Props {
  modifiers?: Modifiers;
  team: TeamJson;
}

export default function TeamCountry({ team, modifiers }: Props) {
  return (
    <span
      className={classWithModifiers('flag-team', modifiers)}
      style={{
        backgroundImage: `url('${team.logo}')`,
      }}
      title={team.name}
    />
  );
}
