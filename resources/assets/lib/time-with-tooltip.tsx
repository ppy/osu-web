// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as moment from 'moment';
import * as React from 'react';

interface Props {
  dateTime: string | moment.Moment;
  format?: string;
  key?: string;
  relative?: boolean;
}

export default function TimeWithTooltip(props: Props) {
  const { dateTime, format, relative = false, ...otherProps } = props;

  const dateTimeAttr = typeof dateTime === 'string' ? dateTime : dateTime.format();

  let className: string;
  let label = dateTimeAttr;

  if (relative) {
    className = 'js-timeago';
  } else {
    className = 'js-tooltip-time';

    const dateTimeMoment = typeof dateTime === 'string' ? moment(dateTime) : dateTime;
    label = dateTimeMoment.format(format ?? 'll');
  }

  return (
    <time className={className} dateTime={dateTimeAttr} title={dateTimeAttr} {...otherProps}>
      {label}
    </time>
  );
}
