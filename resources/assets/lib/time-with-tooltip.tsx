// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as moment from 'moment';
import * as React from 'react';

interface Props {
  dateTime: string;
  format?: string;
  key?: string;
  relative?: boolean;
}

export default function TimeWithTooltip(props: Props) {
  const { format = 'll', relative = false, ...otherProps } = props;
  const className = relative ? 'js-timeago' : 'js-tooltip-time';

  return (
    <time className={className} title={props.dateTime} {...otherProps}>
      {moment(props.dateTime).format(format)}
    </time>
  );
}
