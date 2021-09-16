// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import FollowToggle from 'follow-toggle';
import FollowsSubtypes from 'follows-subtypes';
import HeaderV4 from 'header-v4';
import homeLinks from 'home-links';
import FollowCommentJson from 'interfaces/follow-comment-json';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import * as React from 'react';
import StringWithComponent from 'string-with-component';
import TimeWithTooltip from 'time-with-tooltip';

interface Props {
  follows: FollowCommentJson[];
  user: UserJson;
}

export default class Main extends React.PureComponent<Props> {
  static defaultProps = {
    user: currentUser,
  };

  render() {
    return (
      <div className='osu-layout osu-layout--full'>
        <HeaderV4
          backgroundImage={this.props.user.cover?.url}
          links={homeLinks('follows.index')}
          theme='settings'
        />

        <div className='osu-page osu-page--generic osu-page--full'>
          <FollowsSubtypes currentSubtype='comment' />

          {this.props.follows.length === 0
            ? osu.trans('follows.comment.empty')
            : (
              <table className='follows-table'>
                <tbody>
                  {this.props.follows.map(this.renderItem)}
                </tbody>
              </table>
            )
          }
        </div>
      </div>
    );
  }

  private renderItem = (follow: FollowCommentJson) => {
    const key = `${follow.notifiable_type}:${follow.notifiable_id}`;

    return (
      <tr key={key} className='follows-table__row'>
        <td className='follows-table__data'>
          <div className='type-badge'>
            {osu.trans(`comments.commentable_name.${follow.notifiable_type}`)}
          </div>
        </td>

        <td className='follows-table__data'>
          {'url' in follow.commentable_meta
            ? <a href={follow.commentable_meta.url}>{follow.commentable_meta.title}</a>
            : <span>{follow.commentable_meta.title}</span>
          }
        </td>

        <td className='follows-table__data'>
          {follow.latest_comment != null ? (
            <a href={route('comments.show', { comment: follow.latest_comment.id })}>
              <StringWithComponent
                mappings={{
                  time: <TimeWithTooltip dateTime={follow.latest_comment.created_at} relative />,
                  username: follow.latest_comment.user?.username ?? '???',
                }}
                pattern={osu.trans('follows.comment.table.latest_comment_value')}
              />
            </a>
          ) : osu.trans('follows.comment.table.latest_comment_empty')}
        </td>

        <td className='follows-table__data'>
          <FollowToggle follow={follow} modifiers={['follow-small']} />
        </td>
      </tr>
    );
  };
}
