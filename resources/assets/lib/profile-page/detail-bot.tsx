// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { FriendButton } from 'friend-button';
import UserExtendedJson from 'interfaces/user-extended-json';
import * as React from 'react';

interface Props {
  user: UserExtendedJson;
}

export default function DetailBot({ user }: Props) {
  return (
    <div className='profile-detail'>
      <div className='profile-detail__bar'>
        <div className='profile-detail-bar'>
          <div className='profile-detail-bar__column profile-detail-bar__column--left'>
            <div className='profile-detail-bar__entry'>
              <FriendButton
                alwaysVisible
                followers={user.follower_count}
                modifiers='profile-page'
                showFollowerCounter
                userId={user.id}
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
