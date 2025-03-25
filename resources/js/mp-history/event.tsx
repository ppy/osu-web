// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import StringWithComponent from 'components/string-with-component';
import TimeWithTooltip from 'components/time-with-tooltip';
import UserLink from 'components/user-link';
import LegacyMatchEventJson from 'interfaces/legacy-match-event-json';
import UserJson from 'interfaces/user-json';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';

interface Props {
  event: LegacyMatchEventJson;
  users: Partial<Record<number, UserJson>>;
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

  const eventType = props.event.detail.type;
  if (eventType === 'other') {
    return null;
  }

  return (
    <div className='mp-history-event'>
      <div className='mp-history-event__time'>
        <TimeWithTooltip dateTime={props.event.timestamp} format={'LTS'} />
      </div>
      <div className={classWithModifiers('mp-history-event__type', [eventType])}>
        {icons[eventType].map((m) => <i key={m} className={m} />)}
      </div>
      <div className='mp-history-event__text'>
        {
          user == null
            ? trans(`matches.match.events.${eventType}-no-user`)
            : <StringWithComponent
              mappings={{
                user: (<UserLink
                  className={'mp-history-event__username'}
                  user={{
                    id: user.id,
                    username: user.username,
                  }}
                />),
              }}
              pattern={trans(`matches.match.events.${eventType}`)} />
        }
      </div>
    </div>
  );
}
