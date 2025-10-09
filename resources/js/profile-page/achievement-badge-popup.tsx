// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import StringWithComponent from 'components/string-with-component';
import TimeWithTooltip from 'components/time-with-tooltip';
import AchievementJson from 'interfaces/achievement-json';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';
import AchievementBadgeIcon from './achievement-badge-icon';

function formatAchievedPercent(percent: number) {
  const precision = percent < 0.01
    ? 4
    : percent < 0.1
      ? 3
      : 2;

  return formatNumber(percent, precision, { style: 'percent' });
}

interface Props {
  achievedAt?: string;
  achievement: AchievementJson;
}

export default function AchievementBadgePopup({ achievedAt, achievement }: Props) {
  return (
    <div className='tooltip-achievement'>
      <div className='tooltip-achievement__grouping'>
        {achievement.grouping}
      </div>

      <div className={classWithModifiers('tooltip-achievement__middle')}>
        <div className='tooltip-achievement__badge'>
          <AchievementBadgeIcon
            achievement={achievement}
            modifiers={{
              'dynamic-height': true,
              locked: achievedAt == null,
            }}
          />
        </div>

        <div className={classWithModifiers('tooltip-achievement__detail-container', {
          hoverable: achievement.instructions != null,
        })}>
          <div className={classWithModifiers('tooltip-achievement__detail', { normal: achievement.instructions != null })}>
            <div className='tooltip-achievement__name'>
              {achievement.name}
            </div>
            <div
              dangerouslySetInnerHTML={{ __html: achievement.description }}
              className='tooltip-achievement__description'
            />
          </div>
          {achievement.instructions != null &&
            <div className='tooltip-achievement__detail tooltip-achievement__detail--hover'>
              <div
                dangerouslySetInnerHTML={{ __html: achievement.instructions }}
                className='tooltip-achievement__instructions'
              />
            </div>
          }
        </div>
      </div>

      <div className='tooltip-achievement__achieved'>
        {achievement.achieved_percent != null &&
          <div>
            {trans('users.show.extra.achievements.achieved_by_percent_user', {
              percent: formatAchievedPercent(achievement.achieved_percent),
            })}
          </div>
        }
        <div className='tooltip-achievement__date'>
          {achievedAt == null ? (
            trans('users.show.extra.achievements.locked')
          ) : (
            <StringWithComponent
              mappings={{ date: <TimeWithTooltip dateTime={achievedAt} /> }}
              pattern={trans('users.show.extra.achievements.achieved-on')}
            />
          )}
        </div>
      </div>
    </div>
  );
}
