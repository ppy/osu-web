// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import StringWithComponent from 'components/string-with-component';
import TimeWithTooltip from 'components/time-with-tooltip';
import UserLink from 'components/user-link';
import RealtimeRoomEventJson from 'interfaces/realtime-room-event-json';
import UserJson from 'interfaces/user-json';
import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';

interface Props {
  event: RealtimeRoomEventJson;
  users: Partial<Record<number, UserJson>>;
}

const icons = {
  game_aborted: ['fas fa-stop-circle'],
  game_completed: ['fas fa-check-circle'],
  host_changed: ['fas fa-exchange-alt'],
  player_joined: ['fas fa-arrow-right', 'far fa-circle'],
  player_kicked: ['fas fa-arrow-left', 'fas fa-ban'],
  player_left: ['fas fa-arrow-left', 'far fa-circle'],
  room_created: ['fas fa-plus'],
  room_disbanded: ['fas fa-times'],
};

export default observer(function Event(props: Props) {
  const user = props.event.user_id != null ? props.users[props.event.user_id] : undefined;

  const eventType = props.event.event_type;
  if (eventType === 'unknown' || eventType === 'game_started') {
    return null;
  }

  return (
    <div className='mp-history-event'>
      <div className='mp-history-event__time'>
        <TimeWithTooltip dateTime={props.event.created_at} format='LTS' />
      </div>
      <div className={classWithModifiers('mp-history-event__type', [eventType])}>
        {icons[eventType].map((m) => <i key={m} className={m} />)}
      </div>
      <div className='mp-history-event__text'>
        {
          user == null
            ? trans(`matches.match.events.${eventType}_no_user`)
            : <StringWithComponent
              mappings={{
                user: (<UserLink
                  className='mp-history-event__username'
                  user={user}
                />),
              }}
              pattern={trans(`matches.match.events.${eventType}`)} />
        }
      </div>
    </div>
  );
});
