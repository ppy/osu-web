// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsContext } from 'beatmap-discussions/beatmaps-context';
import { BeatmapsetsContext } from 'beatmap-discussions/beatmapsets-context';
import { Discussion } from 'beatmap-discussions/discussion';
import BeatmapsetCover from 'components/beatmapset-cover';
import { BeatmapsetDiscussionJsonForBundle } from 'interfaces/beatmapset-discussion-json';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import core from 'osu-core-singleton';
import React from 'react';
import { makeUrl } from 'utils/beatmapset-discussion-helper';
import { trans } from 'utils/lang';


interface Props {
  discussions: BeatmapsetDiscussionJsonForBundle[];
  user: UserJson;
  users: Partial<Record<number, UserJson>>;
}

export class Discussions extends React.Component<Props> {
  render() {
    return (
      <div className='page-extra'>
        <h2 className='title title--page-extra'>{trans('users.show.extra.discussions.title_longer')}</h2>
        <div className='modding-profile-list'>
          {this.props.discussions.length === 0 ? (
            <div className='modding-profile-list__empty'>{trans('users.show.extra.none')}</div>
          ) : (
            <BeatmapsetsContext.Consumer>
              {(beatmapsets) => (
                <BeatmapsContext.Consumer>
                  {(beatmaps) => (
                    <>
                      {this.props.discussions.map((discussion) => (
                        <div key={discussion.id} className='modding-profile-list__row'>
                          <a className='modding-profile-list__thumbnail' href={makeUrl({ discussion })}>
                            <BeatmapsetCover beatmapset={beatmapsets[discussion.beatmapset_id]} size='list' />
                          </a>
                          <Discussion
                            beatmapset={beatmapsets[discussion.beatmapset_id]}
                            currentBeatmap={beatmaps[discussion.beatmap_id]}
                            currentUser={core.currentUser}
                            discussion={discussion}
                            isTimelineVisible={false}
                            preview
                            showDeleted
                            users={this.props.users}
                          />
                        </div>
                      ))}
                      <a className='modding-profile-list__show-more' href={route('beatmapsets.discussions.index', { user: this.props.user.id })}>
                        {trans('users.show.extra.discussions.show_more')}
                      </a>
                    </>
                  )}
                </BeatmapsContext.Consumer>
              )}
            </BeatmapsetsContext.Consumer>
          )}
        </div>
      </div>
    );
  }
}
