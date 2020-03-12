// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as moment from 'moment';
import * as React from 'react';

export default function TimeWithTooltip({ dateTime, format }: { dateTime: string, format?: string }) {
  if (format == null) {
    format = 'll';
  }

  return (
    <time className='js-tooltip-time' dateTime={dateTime} title={dateTime}>
      {moment(dateTime).format(format)}
    </time>
  );
}
