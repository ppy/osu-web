// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import TeamJson from 'interfaces/team-json';
import * as React from 'react';

export default function FlagTeam({ team }: { team: TeamJson }) {
  return (
    <span
      className='flag-team'
      style={{ backgroundImage: `url('${team.logo}')` }}
      title={team.name}
    />
  );
}
