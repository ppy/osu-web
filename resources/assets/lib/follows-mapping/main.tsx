// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetListView from 'beatmapset-list-view';
import FollowToggle from 'follow-toggle';
import FollowsSubtypes from 'follows-subtypes';
import HeaderV4 from 'header-v4';
import homeLinks from 'home-links';
import CurrentUserJson from 'interfaces/current-user-json';
import FollowMappingJson from 'interfaces/follow-mapping-json';
import { route } from 'laroute';
import * as React from 'react';

interface Props {
  follows: FollowMappingJson[];
  user: CurrentUserJson;
}

export default class Main extends React.PureComponent<Props> {
  render() {
    return (
      <div className='osu-layout osu-layout--full'>
        <HeaderV4
          backgroundImage={this.props.user.cover?.url}
          links={homeLinks('follows.index')}
          theme='settings'
        />

        <div className='osu-page osu-page--generic osu-page--full'>
          <FollowsSubtypes currentSubtype='mapping' />

          {this.props.follows.length === 0
            ? osu.trans('follows.mapping.empty')
            : (
              <div className='follows-table follows-table--mapping'>
                {this.props.follows.map(this.renderItem)}
              </div>
            )
          }
        </div>
      </div>
    );
  }

  private renderItem = (follow: FollowMappingJson) => {
    const beatmapset = follow.latest_beatmapset;

    return (
      <div key={follow.notifiable_id} className='follows-table__row'>
        <div className='follows-table__data follows-table__data--user'>
          <a
            className='follow-mapper js-usercard'
            data-tooltip-position='top center'
            data-user-id={follow.user.id}
            href={route('users.show', { user: follow.user.id })}
          >
            <span className='follow-mapper__avatar'>
              <span
                className='avatar avatar--full-rounded'
                style={{
                  backgroundImage: osu.urlPresence(follow.user.avatar_url),
                }}
              />
            </span>

            <span className='u-ellipsis-overflow'>
              {follow.user.username}
            </span>
          </a>
        </div>

        <div className='follows-table__data follows-table__data--beatmapset'>
          <BeatmapsetListView beatmapset={beatmapset} />
        </div>

        <div className='follows-table__data follows-table__data--toggle'>
          <FollowToggle follow={follow} modifiers={['follow']} />
        </div>
      </div>
    );
  };
}
