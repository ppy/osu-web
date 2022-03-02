// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ValueDisplay from 'components/value-display';
import UserStatisticsJson from 'interfaces/user-statistics-json';
import * as moment from 'moment';
import * as React from 'react';

interface Props {
  stats: UserStatisticsJson;
}

export default function PlayTime({ stats }: Props) {
  const playTime = moment.duration(stats.play_time, 'seconds');

  const daysLeftOver = Math.floor(playTime.asDays());
  const hours = playTime.hours();
  const totalMinutes = Math.floor(playTime.asMinutes());
  const minutes = totalMinutes % 60; // account for seconds rounding

  let titleValue = Math.round(playTime.asHours());
  let titleUnit = 'hours';

  if (titleValue < 2) {
    titleValue = totalMinutes;
    titleUnit = 'minutes';
  }

  const title = osu.transChoice(`common.count.${titleUnit}`, titleValue);

  let timeString = daysLeftOver > 0 ? `${osu.formatNumber(daysLeftOver)}d ` : '';
  timeString += `${hours}h ${minutes}m`;

  return (
    <ValueDisplay
      label={osu.trans('users.show.stats.play_time')}
      modifiers={['plain', 'plain-wide']}
      value={
        <span data-tooltip-position='bottom center' title={title}>
          {timeString}
        </span>
      }
    />
  );
}
