// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as moment from 'moment';
import * as osu from 'osu-common';
import * as React from 'react';

interface Props {
  dateTime: string;
}

let isLocaleConfigured = false;

const translatedUnits = {
  d: 'd',
  dd: 'dd',
  h: 'h',
  hh: 'hh',
  m: 'm',
  mm: 'mm',
  month: 'M',
  months: 'MM',
  past: 'past',
  s: 's',
  y: 'y',
  yy: 'yy',
};

function setupScoreboardLocale() {
  if (isLocaleConfigured) return;

  const previousLocale = moment.locale();

  const relativeTime: Partial<Record<string, string>> = { future: '' };
  for (const [key, unit] of Object.entries(translatedUnits)) {
    relativeTime[unit] = osu.trans(`common.scoreboard_time.${key}`);
  }

  moment.defineLocale('scoreboard', { relativeTime });

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
