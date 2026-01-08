// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import StringWithComponent from 'components/string-with-component';
import TimeWithTooltip from 'components/time-with-tooltip';
import UserLink from 'components/user-link';
import UserGroupEventJson from 'interfaces/user-group-event-json';
import { route } from 'laroute';
import * as React from 'react';
import { classWithModifiers, groupColour } from 'utils/css';
import { trans, transArray } from 'utils/lang';
import groupStore from './group-store';

interface Props {
  event: UserGroupEventJson;
}

export default class Event extends React.PureComponent<Props> {
  private get messageMappings() {
    const event = this.props.event;
    const mappings: Record<string, React.ReactNode> = {
      group: (
        <a href={route('groups.show', { group: event.group_id })}>
          {event.group_name}
        </a>
      ),
    };

    if ('playmodes' in event && event.playmodes != null) {
      mappings.rulesets = transArray(
        event.playmodes.map((mode) => trans(`beatmaps.mode.${mode}`)),
      );
    }

    if ('previous_group_name' in event) {
      mappings.previous_group = (
        <a href={route('groups.show', { group: event.group_id })}>
          {event.previous_group_name}
        </a>
      );
    }

    if (event.user_id != null) {
      mappings.user = <UserLink user={{ id: event.user_id, username: event.user_name }} />;
    }

    return mappings;
  }

  private get messagePattern() {
    const event = this.props.event;
    const type = event.type === 'user_add' && event.playmodes != null
      ? 'user_add_with_playmodes'
      : event.type;

    return trans(`group_history.event.message.${type}`);
  }

  render() {
    return (
      <div
        className={classWithModifiers('group-history-event', this.props.event.type)}
        style={groupColour(groupStore.byId.get(this.props.event.group_id))}
      >
        <i className='group-history-event__icon' />
        <div className='group-history-event__message'>
          <StringWithComponent
            mappings={this.messageMappings}
            pattern={this.messagePattern}
          />
        </div>
        <div className='group-history-event__info'>
          <TimeWithTooltip dateTime={this.props.event.created_at} />
          {this.props.event.actor != null && (
            <span>
              <StringWithComponent
                mappings={{ user: <UserLink user={this.props.event.actor} /> }}
                pattern={trans('group_history.event.actor')}
              />
            </span>
          )}
        </div>
      </div>
    );
  }
}
