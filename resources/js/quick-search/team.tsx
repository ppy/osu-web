// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import TeamJson from 'interfaces/team-json';
import { route } from 'laroute';
import * as React from 'react';
import { classWithModifiers, Modifiers, urlPresence } from 'utils/css';

export default function Team({ team, modifiers }: { modifiers?: Modifiers; team: TeamJson }) {
  const url = route('teams.show', { team: team.id });

  return (
    <div className={classWithModifiers('user-search-card', 'team', modifiers)}>
      <a className='user-search-card__background-container' href={url} />
      <div className='user-search-card__container'>
        <a className='user-search-card__avatar-container' href={url}>
          <div className='flag-team flag-team--full' style={{ backgroundImage: urlPresence(team.flag_url) }} />
        </a>

        <div className='user-search-card__details'>
          <a className='user-search-card__col user-search-card__col--username' href={url}>
            {team.name}
          </a>
        </div>
      </div>
    </div>
  );
}

