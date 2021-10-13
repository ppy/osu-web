// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import { snakeCase } from 'lodash';
import ExtraHeader from 'profile-page/extra-header';
import { Event, parseEvent } from 'profile-page/recent-activity-events';
import * as React from 'react';
import ShowMoreLink from 'show-more-link';
import StringWithComponent from 'string-with-component';
import TimeWithTooltip from 'time-with-tooltip';
import { stripTags } from 'utils/html';

interface Props {
  name: string;
  pagination: {
    recentActivity: {
      hasMore: boolean;
      loading: boolean;
    };
  };
  recentActivity: Event[];
  user: UserJson;
  withEdit: boolean;
}

export default class RecentActivity extends React.PureComponent<Props> {
  render() {
    return (
      <div className='page-extra'>
        <ExtraHeader name={this.props.name} withEdit={this.props.withEdit} />
        {this.props.recentActivity.length > 0 ? this.renderEntries() : this.renderEmpty()}
      </div>
    );
  }

  private renderEmpty() {
    return <p className='profile-extra-entries'>{osu.trans('events.empty')}</p>;
  }

  private renderEntries() {
    return (
      <div>
        <ul className='profile-extra-entries'>
          {this.props.recentActivity.map(this.renderEntry)}
        </ul>
        <div className='profile-extra-entries__item'>
          <ShowMoreLink
            data={{
              name: 'recentActivity',
              url: route('users.recent-activity', { user: this.props.user.id }),
            }}
            event='profile:showMore'
            hasMore={this.props.pagination.recentActivity.hasMore}
            loading={this.props.pagination.recentActivity.loading}
            modifiers={['profile-page', 't-greyseafoam-dark']}
          />
        </div>
      </div>
    );
  }

  private renderEntry = (event: Event) => {
    const { badge, mappings } = parseEvent(event, { badge: 'recent-activity' });
    if (mappings == null) return null;

    return (
      <li key={event.id} className='profile-extra-entries__item'>
        <div className='profile-extra-entries__detail'>
          <div className='profile-extra-entries__icon'>
            {badge}
          </div>
          <div className='profile-extra-entries__text'>
            <StringWithComponent
              mappings={mappings}
              // TODO: remove stripTags once translations are updated
              pattern={stripTags(osu.trans(`events.${snakeCase(event.type)}`))}
            />
          </div>
        </div>
        <div className='profile-extra-entries__time'>
          <TimeWithTooltip dateTime={event.created_at} relative />
        </div>
      </li>
    );
  };
}
