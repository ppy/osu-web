// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ShowMoreLink from 'components/show-more-link';
import StringWithComponent from 'components/string-with-component';
import TimeWithTooltip from 'components/time-with-tooltip';
import EventJson from 'interfaces/event-json';
import { snakeCase } from 'lodash';
import { observer } from 'mobx-react';
import ExtraHeader from 'profile-page/extra-header';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { stripTags } from 'utils/html';
import { trans } from 'utils/lang';
import ExtraPageProps from './extra-page-props';
import parseEvent from './parse-event';

@observer
export default class RecentActivity extends React.Component<ExtraPageProps> {
  render() {
    return (
      <div className='page-extra'>
        <ExtraHeader name={this.props.name} withEdit={this.props.controller.withEdit} />
        {this.props.controller.state.recentActivity.items.length > 0 ? this.renderEntries() : this.renderEmpty()}
      </div>
    );
  }

  private readonly onShowMore = () => {
    this.props.controller.apiShowMore('recentActivity');
  };

  private renderEmpty() {
    return <p className='profile-extra-entries'>{trans('events.empty')}</p>;
  }

  private renderEntries() {
    return (
      <ul className='profile-extra-entries'>
        {this.props.controller.state.recentActivity.items.map(this.renderEntry)}
        <li className='profile-extra-entries__item'>
          <ShowMoreLink
            {...this.props.controller.state.recentActivity.pagination}
            callback={this.onShowMore}
            modifiers='profile-page'
          />
        </li>
      </ul>
    );
  }

  private renderEntry = (event: EventJson) => {
    const { badge, iconModifiers, mappings } = parseEvent(event, 'recent-activity');
    if (mappings == null) return null;

    return (
      <li key={event.id} className='profile-extra-entries__item'>
        <div className='profile-extra-entries__detail'>
          <div className={classWithModifiers('profile-extra-entries__icon', [
            iconModifiers,
          ])}>
            {badge}
          </div>
          <div className='profile-extra-entries__text'>
            <StringWithComponent
              mappings={mappings}
              // TODO: remove stripTags once translations are updated
              pattern={stripTags(trans(`events.${snakeCase(event.type)}`))}
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
