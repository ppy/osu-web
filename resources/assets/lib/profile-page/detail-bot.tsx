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

import { FriendButton } from 'friend-button';
import * as React from 'react';

interface Props {
  user: User;
}

export default function DetailBot({ user }: Props) {
  return (
    <div className='profile-detail'>
      <div className='profile-detail__bar'>
        <div className='profile-detail-bar'>
          <div className='profile-detail-bar__column profile-detail-bar__column--left'>
            <div className='profile-detail-bar__menu-item'>
              <FriendButton
                alwaysVisible={true}
                followers={user.follower_count}
                modifiers={['profile-page']}
                showFollowerCounter={true}
                userId={user.id}
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
