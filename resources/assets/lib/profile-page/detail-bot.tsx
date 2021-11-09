// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserExtendedJson from 'interfaces/user-extended-json';
import DetailBarButtons from 'profile-page/detail-bar-buttons';
import * as React from 'react';

interface Props {
  user: UserExtendedJson;
}

export default function DetailBot({ user }: Props) {
  return (
    <div className='profile-detail'>
      <div className='profile-detail-bar'>
        <div className='profile-detail-bar__column'>
          <DetailBarButtons user={user} />
        </div>
      </div>
    </div>
  );
}
