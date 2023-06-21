// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetEvents from 'components/beatmapset-events';
import BeatmapsetEventJson from 'interfaces/beatmapset-event-json';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import * as React from 'react';
import { trans } from 'utils/lang';

interface Props {
  events: BeatmapsetEventJson[];
  user: UserJson;
  users: Partial<Record<string, UserJson>>;
}

export default class Events extends React.Component<Props> {
  render() {
    return (
      <div className='page-extra'>
        <h2 className='title title--page-extra'>{trans('users.show.extra.events.title_longer')}</h2>
        <div className='modding-profile-list'>
          {this.props.events.length === 0 ? (
            <div className='modding-profile-list__empty'>{trans('users.show.extra.none')}</div>
          ) : (
            <>
              <BeatmapsetEvents
                events={this.props.events}
                mode='profile'
                users={this.props.users}
              />
              <a
                className='modding-profile-list__show-more'
                href={route('beatmapsets.events.index', { user: this.props.user.id })}
              >
                {trans('users.show.extra.events.show_more')}
              </a>
            </>
          )}
        </div>
      </div>
    );
  }
}
