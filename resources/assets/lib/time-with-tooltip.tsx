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
  const { dateTime, format = 'll', relative = false, ...otherProps } = props;
  const className = relative ? 'js-timeago' : 'js-tooltip-time';

  let dateTimeAttr: string;
  let dateTimeMoment: moment.Moment;

  if (typeof dateTime === 'string') {
    dateTimeAttr = dateTime;
    dateTimeMoment = moment(dateTime);
  } else {
    dateTimeAttr = dateTime.format();
    dateTimeMoment = dateTime;
  }

  return (
    <time className={className} dateTime={dateTimeAttr} title={dateTimeAttr} {...otherProps}>
      {dateTimeMoment.format(format)}
    </time>
  );
}
