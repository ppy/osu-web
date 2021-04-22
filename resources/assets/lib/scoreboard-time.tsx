// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as moment from 'moment';
import * as React from 'react';

interface Props {
  dateTime: string;
}

let isLocaleConfigured = false;

function setupScoreboardLocale() {
  if (isLocaleConfigured) return;

  const previousLocale = moment.locale();

  moment.defineLocale('scoreboard', {
    // tslint complains that M should be before m. And m should be before M.
    /* tslint:disable  */
    relativeTime: {
      future: '',
      past: osu.trans('common.scoreboard_time.past'),
      s: osu.trans('common.scoreboard_time.s'),
      m: osu.trans('common.scoreboard_time.m'),
      mm: osu.trans('common.scoreboard_time.mm'),
      h: osu.trans('common.scoreboard_time.h'),
      hh: osu.trans('common.scoreboard_time.hh'),
      d: osu.trans('common.scoreboard_time.d'),
      dd: osu.trans('common.scoreboard_time.dd'),
      M: osu.trans('common.scoreboard_time.M'),
      MM: osu.trans('common.scoreboard_time.MM'),
      y: osu.trans('common.scoreboard_time.y'),
      yy: osu.trans('common.scoreboard_time.yy'),
    },
    /* tslint:enable */
  });

  moment.locale(previousLocale);

  isLocaleConfigured = true;
}

export default function ScoreboardTime(props: Props) {
  setupScoreboardLocale();

  return (
    <time className='js-tooltip-time' title={props.dateTime}>
      {moment(props.dateTime).locale('scoreboard').fromNow()}
    </time>
  );
}
