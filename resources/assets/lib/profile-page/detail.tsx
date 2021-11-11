// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserExtendedJson from 'interfaces/user-extended-json';
import UserStatisticsJson from 'interfaces/user-statistics-json';
import DetailBarColumns from 'profile-page/detail-bar-columns';
import Rank from 'profile-page/rank';
import * as React from 'react';

interface Props {
  stats: UserStatisticsJson;
  user: UserExtendedJson;
}

export default function Detail({ stats, user }: Props) {
  return (
    <div className='profile-detail'>
      <div className='profile-detail-bar'>
        <DetailBarColumns user={user}>
          {!user.is_bot && (
            <>
              <div className='profile-detail-bar__entry'>
                <Rank stats={stats} type='global' />
              </div>
              <div className='profile-detail-bar__entry'>
                <Rank stats={stats} type='country' />
              </div>
              <div className='profile-detail-bar__entry profile-detail-bar__entry--level'>
                <div
                  className='profile-detail-bar__level'
                  title={osu.trans('users.show.stats.level', { level: stats.level.current })}
                >
                  {stats.level.current}
                </div>
              </div>
            </>
          )}
        </DetailBarColumns>
      </div>
    </div>
  );
}
