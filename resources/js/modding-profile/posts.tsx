// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsetCover from 'components/beatmapset-cover';
import { BeatmapsetDiscussionMessagePostJson } from 'interfaces/beatmapset-discussion-post-json';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import { deletedUser } from 'models/user';
import * as React from 'react';
import { makeUrl } from 'utils/beatmapset-discussion-helper';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import Post from '../beatmap-discussions/post';

interface Props {
  posts: BeatmapsetDiscussionMessagePostJson[];
  user: UserJson;
  users: Partial<Record<number, UserJson>>;
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
    if (post.beatmap_discussion == null || post.beatmap_discussion.beatmapset == null) return;

    const discussionClasses = classWithModifiers('beatmap-discussion', ['preview', 'modding-profile'], { deleted: post.deleted_at != null });

    return (
      <div key={post.id} className='modding-profile-list__row'>
        <a className='modding-profile-list__thumbnail' href={makeUrl({ discussion: post.beatmap_discussion })}>
          <BeatmapsetCover
            beatmapset={post.beatmap_discussion.beatmapset}
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
              beatmap={null}
              beatmapset={post.beatmap_discussion.beatmapset}
              discussion={post.beatmap_discussion}
              post={post}
              read
              readonly
              resolvedSystemPostId={-1} // TODO: Can probably move to context after refactoring state?
              type='reply'
              user={this.props.users[post.user_id] ?? deletedUser.toJson()}
              users={this.props.users}
            />
          </div>
        </div>
      </div>
    );
  };
}
