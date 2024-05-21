// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserGroupEventJson from 'interfaces/user-group-event-json';
import { observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import Event from './event';

const bn = 'group-history';

interface Props {
  events: UserGroupEventJson[];
}

@observer
export default class Events extends React.Component<Props> {
  render() {
    return this.props.events.length > 0 ? (
      <div className={classWithModifiers(bn, 'events')}>
        {this.props.events.map((event) => (
          <Event key={event.id} event={event} />
        ))}
      </div>
    ) : (
      <p className={classWithModifiers(bn, 'none')}>
        {trans('group_history.none')}
      </p>
    );
  }
}
