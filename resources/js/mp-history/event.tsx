// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import TimeWithTooltip from 'components/time-with-tooltip';
import { route } from 'laroute';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import { linkHtml } from 'utils/url';
import { MatchEvent } from '../interfaces/match-json';
import UserJson from '../interfaces/user-json';

interface Props {
  event: MatchEvent;
  users: { [userId: number]: UserJson };
}

const icons = {
  'host-changed': ['fas fa-exchange-alt'],
  'match-created': ['fas fa-plus'],
  'match-disbanded': ['fas fa-times'],
  'player-joined': ['fas fa-arrow-right', 'far fa-circle'],
  'player-kicked': ['fas fa-arrow-left', 'fas fa-ban'],
  'player-left': ['fas fa-arrow-left', 'far fa-circle'],
};

export default function Event(props: Props) {
  const user = props.event.user_id != null ? props.users[props.event.user_id] : undefined;

  const event_type = props.event.detail.type;
  if (event_type === 'other') {
    return null;
  }

  let userLink = '';

  if (user != null && event_type !== 'match-disbanded') {
    userLink = linkHtml(route('users.show', { user: user.id }), user.username, { classNames: ['mp-history-event__username'] });
  }

  return (
    <div className='mp-history-event'>
      <div className='mp-history-event__time'>
        <TimeWithTooltip dateTime={props.event.timestamp} format={'LTS'} />
      </div>
      <div className={classWithModifiers('mp-history-event__type', [event_type])}>
        {icons[event_type].map((m) => <i key={m} className={m} />)}
      </div>
      <div
        dangerouslySetInnerHTML={{
          __html: trans(`matches.match.events.${event_type}${user != null ? '' : '-no-user'}`, { user: userLink }),
        }}
        className='mp-history-event__text' />
    </div>
  );
}
