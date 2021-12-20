// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import FriendButton from 'components/friend-button';
import FlagCountry from 'flag-country';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import * as React from 'react';
import { SupporterIcon } from 'supporter-icon';
import UserGroupBadges from 'user-group-badges';
import { classWithModifiers } from 'utils/css';

export default function User({ user, modifiers = [] }: { modifiers?: string[]; user: UserJson }) {
  const url = route('users.show', { user: user.id });

  return (
    <div className={`${classWithModifiers('user-search-card', modifiers)} clickable-row`}>
      <a className='user-search-card__avatar-container' href={url}>
        <div className='avatar avatar--full' style={{ backgroundImage: osu.urlPresence(user.avatar_url) }} />
      </a>

      <div className='user-search-card__details'>
        <div className='user-search-card__col  user-search-card__col--flag'>
          <FlagCountry country={user.country} />
        </div>

        <a className='user-search-card__col user-search-card__col--username clickable-row-link' href={url}>
          {user.username}
        </a>

        {user.is_supporter
          ? (
            <div className='user-search-card__col user-search-card__col--icon u-hidden-narrow'>
              <SupporterIcon level={user.support_level} modifiers={['quick-search']} />
            </div>
          ) : null}

        <UserGroupBadges groups={user.groups} short wrapper='user-search-card__col user-search-card__col--icon' />

        <div className='user-search-card__col user-search-card__col--icon'>
          <FriendButton modifiers='quick-search' userId={user.id} />
        </div>
      </div>
    </div>
  );
}
