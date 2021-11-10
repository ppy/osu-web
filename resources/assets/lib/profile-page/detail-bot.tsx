// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserExtendedJson from 'interfaces/user-extended-json';
import DetailBarColumns from 'profile-page/detail-bar-columns';
import * as React from 'react';

interface Props {
  user: UserExtendedJson;
}

export default function DetailBot({ user }: Props) {
  return (
    <div className='profile-detail'>
      <div className='profile-detail-bar'>
        <DetailBarColumns user={user} />
      </div>
    </div>
  );
}
