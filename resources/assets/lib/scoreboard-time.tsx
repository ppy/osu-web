// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as moment from 'moment';
import * as React from 'react';

interface Props {
  dateTime: string;
}

export default function ScoreboardTime(props: Props) {
  const localMoment = moment(props.dateTime);
  const previousLocale = moment.locale();
  moment.locale('scoreboard', {
    relativeTime: {
      future: '',
      past: '%s',
      s: '1 sec',
      m: '1 min',
      mm: '%d min',
      h: '1 hr',
      hh: '%d hr',
      d: '1 d',
      dd: '%d d',
      M: '1 M',
      MM: '%d M',
      y: '1 y',
      yy: '%d y',
    },
  });

  localMoment.locale('scoreboard');
  const text = localMoment.fromNow();
  if (moment.locale() !== previousLocale) {
    moment.locale(previousLocale);
  }

  return (
    <time className='js-tooltip-time' title={props.dateTime}>
      {text}
    </time>
  );
}
