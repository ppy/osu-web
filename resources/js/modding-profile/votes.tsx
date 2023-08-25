// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ProfilePageExtraSectionTitle from 'components/profile-page-extra-section-title';
import UserAvatar from 'components/user-avatar';
import UserGroupBadge from 'components/user-group-badge';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import * as React from 'react';
import { groupColour } from 'utils/css';
import { trans, transChoice } from 'utils/lang';

const bn = 'modding-profile-vote-card';
const directions = ['received', 'given'] as const;
export type Direction = (typeof directions)[number];

interface Props {
  users: Partial<Record<number, UserJson>>;
  votes: Record<Direction, VoteSummary[]>;
}

export interface VoteSummary {
  count: number;
  score: number;
  user_id: number;
}

export default class Votes extends React.Component<Props> {
  render() {
    return (
      <div className='page-extra'>
        <h1 className='title title--page-extra'>{trans('users.show.extra.votes.title_longer')}</h1>
        {directions.map((direction) => (
          <React.Fragment key={direction}>
            <ProfilePageExtraSectionTitle
              count={this.props.votes[direction].length === 0 ? 0 : null}
              titleKey={`users.show.extra.votes.${direction}`}
            />
            {this.props.votes[direction].length > 0 && (
              <div className='modding-profile-list modding-profile-list--votes'>
                {this.props.votes[direction].map((vote) => this.renderUser(vote.score, vote.count, this.props.users[vote.user_id]))}
              </div>
            )}
          </React.Fragment>
        ))}
      </div>
    );
  }

  private renderUser(score: number, count: number, user?: UserJson) {
    if (user == null) return;

    const userBadge = user.groups?.[0];
    const style = groupColour(userBadge);
    const href = route('users.modding.index', { user: user.id }) + '#votes';

    return (
      <div
        key={user.id}
        className={bn}
        style={style}
      >
        <div className={`${bn}__avatar`}>
          <a
            className={`${bn}__user-link`}
            href={href}
          >
            <UserAvatar modifiers='full-rounded' user={user} />
          </a>
        </div>
        <div className={`${bn}__user`}>
          <div className={`${bn}__user-row`}>
            <a
              className={`${bn}__user-link`}
              href={href}
            >
              <span className={`${bn}__user-text u-ellipsis-overflow`}>
                {user.username}
              </span>
            </a>
          </div>
          <div className={`${bn}__user-badge`}>
            <UserGroupBadge group={userBadge} />
          </div>
        </div>
        <div className={`${bn}__user-stripe`} />
        <div className={`${bn}__votes-container`}>
          <div className={`${bn}__score`}>{score > 0 && '+'}{score}</div>
          <div className={`${bn}__count`}>{transChoice('users.show.extra.votes.vote_count', count)}</div>
        </div>
      </div>
    );
  }
}
