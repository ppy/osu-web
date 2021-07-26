// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as osu from 'osu-common';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';

interface Props {
  count: number;
  iconClassName: string;
  ready: boolean;
  type?: string;
}

function format(count: number) {
  // combination of latency and delays processing marking as read can cause the display count to go negative.
  return osu.formatNumber(count > 0 ? count : 0);
}

export default function NotificationIcon(props: Props) {
  const modifiers = {
    glow: props.count > 0,
    mobile: props.type === 'mobile',
  };

  return (
    <span className={classWithModifiers('notification-icon', modifiers)}>
      <i className={props.iconClassName} />
      <span className='notification-icon__count'>
        {props.ready ? format(props.count) : '...'}
      </span>
    </span>
  );
}
