// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetCover from 'components/beatmapset-cover';
import { BeatmapsetDiscussionMessagePostJson } from 'interfaces/beatmapset-discussion-post-json';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import BeatmapsetDiscussions from 'models/beatmapset-discussions';
import { deletedUserJson } from 'models/user';
import * as React from 'react';
import { makeUrl } from 'utils/beatmapset-discussion-helper';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import Post from '../beatmap-discussions/post';

interface Props {
  posts: BeatmapsetDiscussionMessagePostJson[];
  store: BeatmapsetDiscussions;
  user: UserJson;
}

export class Posts extends React.Component<Props> {
  render() {
    return (
      <div className='page-extra'>
        <h2 className='title title--page-extra'>{trans('users.show.extra.posts.title_longer')}</h2>
        <div className='modding-profile-list'>
          {this.props.posts.length === 0 ? (
            <div className='modding-profile-list__empty'>{trans('users.show.extra.none')}</div>
          ) : (
            <>
              {this.props.posts.map(this.renderPost)}
              <a
                className='modding-profile-list__show-more'
                href={route('users.modding.posts', { user: this.props.user.id })}
              >
                {trans('users.show.extra.posts.show_more')}
              </a>
            </>
          )}
        </div>
      </div>
    );
  }

  private readonly renderPost = (post: BeatmapsetDiscussionMessagePostJson) => {
    const discussion = post.beatmap_discussion;
    if (discussion == null || discussion.beatmapset == null) return;

    const discussionClasses = classWithModifiers(
      'beatmap-discussion',
      ['preview', 'modding-profile'],
      { deleted: post.deleted_at != null },
    );

    return (
      <div key={post.id} className='modding-profile-list__row'>
        <a className='modding-profile-list__thumbnail' href={makeUrl({ discussion })}>
          <BeatmapsetCover
            beatmapset={discussion.beatmapset}
            size='list'
          />
        </a>
        <div className='modding-profile-list__timestamp hidden-xs'>
          <div className='beatmap-discussion-timestamp'>
            <div className='beatmap-discussion-timestamp__icons-container'>
              <span className='fas fa-reply' title={trans('common.buttons.reply')} />
            </div>
          </div>
        </div>
        <div className={discussionClasses}>
          <div className='beatmap-discussion__discussion'>
            <Post
              discussion={discussion}
              discussionsState={null}
              post={post}
              read
              readonly
              store={this.props.store}
              type='reply'
              user={this.props.store.users.get(post.user_id) ?? deletedUserJson}
            />
          </div>
        </div>
      </div>
    );
  };
}
