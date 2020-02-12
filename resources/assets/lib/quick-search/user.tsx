/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

import { FlagCountry } from 'flag-country';
import { FriendButton } from 'friend-button';
import { route } from 'laroute';
import * as React from 'react';
import { SupporterIcon } from 'supporter-icon';
import UserGroupBadge from 'user-group-badge';

export default function User({ user, modifiers = [] }: { modifiers?: string[], user: User }) {
  const url = route('users.show', { user: user.id });

  return (
    <div className={`${osu.classWithModifiers('user-search-card', modifiers)} clickable-row`}>
      <a className='user-search-card__avatar-container' href={url}>
        <div className='avatar avatar--full' style={{ backgroundImage: osu.urlPresence(user.avatar_url) }} />
      </a>

      <div className='user-search-card__details'>
        <div className='user-search-card__col  user-search-card__col--flag'>
          <FlagCountry country={user.country} modifiers={['inline']} />
        </div>

        <a className='user-search-card__col user-search-card__col--username clickable-row-link' href={url}>
          {user.username}
        </a>

        {user.is_supporter
          ? (
            <div className='user-search-card__col user-search-card__col--icon'>
              <SupporterIcon level={user.support_level} modifiers={['quick-search']} />
            </div>
          ) : null}

        {user.group_badge != null && (
          <div className='user-search-card__col user-search-card__col--icon'>
            <UserGroupBadge badge={user.group_badge} />
          </div>
        )}

        <div className='user-search-card__col user-search-card__col--icon'>
          <FriendButton userId={user.id} modifiers={['quick-search']} />
        </div>
      </div>
    </div>
  );
}
