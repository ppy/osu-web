// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Discussion } from 'beatmap-discussions/discussion';
import BeatmapsetCover from 'components/beatmapset-cover';
import { BeatmapsetDiscussionJsonForBundle } from 'interfaces/beatmapset-discussion-json';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import BeatmapsetDiscussions from 'models/beatmapset-discussions';
import React from 'react';
import { makeUrl } from 'utils/beatmapset-discussion-helper';
import { trans } from 'utils/lang';

interface Props {
  discussions: BeatmapsetDiscussionJsonForBundle[];
  store: BeatmapsetDiscussions;
  user: UserJson;
}

export default class Discussions extends React.Component<Props> {
  render() {
    return (
      <div className='page-extra'>
        <h2 className='title title--page-extra'>{trans('users.show.extra.discussions.title_longer')}</h2>
        <div className='modding-profile-list'>
          {this.props.discussions.length === 0 ? (
            <div className='modding-profile-list__empty'>{trans('users.show.extra.none')}</div>
          ) : (
            <>
              {this.props.discussions.map((discussion) => this.renderDiscussion(discussion))}
              <a className='modding-profile-list__show-more' href={route('beatmapsets.discussions.index', { user: this.props.user.id })}>
                {trans('users.show.extra.discussions.show_more')}
              </a>
            </>
          )}
        </div>
      </div>
    );
  }

  private renderDiscussion(discussion: BeatmapsetDiscussionJsonForBundle) {
    const beatmapset = this.props.store.beatmapsets.get(discussion.beatmapset_id);
    if (beatmapset == null) return null;

    return (
      <div key={discussion.id} className='modding-profile-list__row'>
        <a className='modding-profile-list__thumbnail' href={makeUrl({ discussion })}>
          <BeatmapsetCover beatmapset={beatmapset} size='list' />
        </a>
        <Discussion
          discussion={discussion}
          discussionsState={null}
          isTimelineVisible={false}
          preview
          readonly
          store={this.props.store}
        />
      </div>
    );
  }
}
