// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import StringWithComponent from 'components/string-with-component';
import TimeWithTooltip from 'components/time-with-tooltip';
import UserAvatar from 'components/user-avatar';
import UserLink from 'components/user-link';
import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import * as moment from 'moment';
import * as React from 'react';
import { trans } from 'utils/lang';

const bn = 'beatmapset-mapping';

interface Props {
  beatmapset: BeatmapsetExtendedJson;
  user?: BeatmapsetExtendedJson['user'];
}

interface DisplayUser {
  avatar_url?: string;
  id?: number;
  username: string;
}

export default class BeatmapsetMapping extends React.PureComponent<Props> {
  render() {
    const displayUser: DisplayUser = { username: this.props.beatmapset.creator };

    const user = this.props.user ?? this.props.beatmapset.user;
    if (user != null) {
      displayUser.id = user.id;
      displayUser.avatar_url = user.avatar_url;
    }

    return (
      <div className={bn}>
        <UserLink user={displayUser}>
          <UserAvatar modifiers='beatmapset' user={displayUser} />
        </UserLink>

        <div className={`${bn}__content`}>
          <div className={`${bn}__mapper`}>
            <StringWithComponent
              mappings={{
                mapper: <UserLink className={`${bn}__user`} user={displayUser} />,
              }}
              pattern={trans('beatmapsets.show.details.mapped_by')}
            />
          </div>

          {this.renderDate('submitted', 'submitted_date')}

          {this.props.beatmapset.ranked > 0
            ? this.renderDate(this.props.beatmapset.status, 'ranked_date')
            : this.renderDate('updated', 'last_updated')
          }
        </div>
      </div>
    );
  }

  private renderDate(key: string, attribute: 'last_updated' | 'ranked_date' | 'submitted_date') {
    const date = this.props.beatmapset[attribute];
    if (date == null) {
      throw new Error(`beatmapset data is missing the expected date attribute: ${attribute}`);
    }

    const relative = Math.abs(moment().diff(moment(date), 'weeks')) < 4;

    return (
      <div>
        <StringWithComponent
          mappings={{
            timeago: (
              <strong>
                <TimeWithTooltip dateTime={date} relative={relative} />
              </strong>
            ),
          }}
          pattern={trans(`beatmapsets.show.details_date.${key}`)}
        />
      </div>
    );
  }
}
