// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserAchievementJson from 'interfaces/user-achievement-json';
import * as React from 'react';
import ValueDisplay from 'value-display';

interface Props {
  userAchievements: UserAchievementJson[];
}

export default function MedalsCount({ userAchievements }: Props) {
  return (
    <ValueDisplay
      label={osu.trans('users.show.stats.medals')}
      modifiers='medals'
      value={userAchievements.length}
    />
  );
}
