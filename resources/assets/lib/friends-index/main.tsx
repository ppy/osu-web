/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

import HeaderV3 from 'header-v3';
import { route } from 'laroute';
import * as React from 'react';
import { UserList } from 'user-list';

interface Props {
  friends: User[];
  user: User;
}

export class Main extends React.PureComponent<Props> {
  static defaultProps = {
    user: currentUser,
  };

  static readonly links = [
    { title: osu.trans('home.user.title'), url: route('home') },
    { title: osu.trans('friends.title_compact'), url: route('friends.index'), active: true },
    { title: osu.trans('forum.topic_watches.index.title_compact'), url: route('forum.topic-watches.index') },
    { title: osu.trans('beatmapset_watches.index.title_compact'), url: route('beatmapsets.watches.index') },
    { title: osu.trans('accounts.edit.title_compact'), url: route('account.edit') },
  ];

  render() {
    return (
      <div className='osu-layout osu-layout--full'>
        <HeaderV3
          backgroundImage={this.props.user.cover.url}
          links={Main.links}
          theme='users'
          titleTrans={{
            info: osu.trans('friends.index.title.info'),
            key: 'friends.index.title._',
          }}
        />

        <div className='osu-page osu-page--users'>
          <UserList users={this.props.friends} />
        </div>
      </div>
    );
  }
}
