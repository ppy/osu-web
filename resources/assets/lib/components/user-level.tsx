// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';

export default function UserLevel({ level }: { level: number }) {
  return (
    <div
      className='user-level'
      title={osu.trans('users.show.stats.level', { level })}
    >
      {level}
    </div>
  );
}
