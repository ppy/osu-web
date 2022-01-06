// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import EventJson from 'interfaces/event-json';
import { snakeCase } from 'lodash';
import { observer } from 'mobx-react';
import ExtraHeader from 'profile-page/extra-header';
import * as React from 'react';
import ShowMoreLink from 'show-more-link';
import StringWithComponent from 'string-with-component';
import TimeWithTooltip from 'time-with-tooltip';
import { stripTags } from 'utils/html';
import ExtraPageProps from './extra-page-props';
import parseEvent from './parse-event';

@observer
export default class RecentActivity extends React.PureComponent<ExtraPageProps> {
  render() {
    return (
      <div className='page-extra'>
        <ExtraHeader name={this.props.name} withEdit={this.props.controller.withEdit} />
        {this.props.controller.state.extras.recentActivity.length > 0 ? this.renderEntries() : this.renderEmpty()}
      </div>
    );
  }

  private readonly onShowMore = () => {
    this.props.controller.apiShowMore('recentActivity');
  };

  private renderEmpty() {
    return <p className='profile-extra-entries'>{osu.trans('events.empty')}</p>;
  }

  private renderEntries() {
    return (
      <ul className='profile-extra-entries'>
        {this.props.controller.state.extras.recentActivity.map(this.renderEntry)}
        <li className='profile-extra-entries__item'>
          <ShowMoreLink
            {...this.props.controller.state.pagination.recentActivity}
            callback={this.onShowMore}
            modifiers='profile-page'
          />
        </li>
      </ul>
    );
  }

  private renderEntry = (event: EventJson) => {
    const { badge, mappings } = parseEvent(event, 'recent-activity');
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
