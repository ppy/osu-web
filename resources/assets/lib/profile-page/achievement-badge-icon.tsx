// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Img2x from 'components/img2x';
import AchievementJson from 'interfaces/achievement-json';
import * as React from 'react';
import { classWithModifiers, Modifiers } from 'utils/css';

type Props = {
  achievement: AchievementJson;
  modifiers: Modifiers;
} & React.HTMLAttributes<HTMLDivElement>;

export default function AchievementBadgeIcon(props: Props) {
  const { achievement, modifiers, ...divProps } = props;

  return (
    <div
      className={classWithModifiers('badge-achievement', modifiers)}
      {...divProps}
    >
      <Img2x
        alt={achievement.name}
        className='badge-achievement__image'
        src={achievement.icon_url}
      />
    </div>
  );
}
