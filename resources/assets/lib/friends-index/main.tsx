/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

import HeaderV4 from 'header-v4';
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
        <HeaderV4
          backgroundImage={this.props.user.cover.url}
          links={Main.links}
          theme='home'
          section={osu.trans('layout.header.home._')}
          subSection={osu.trans('friends.title_compact')}
        />

        <div className='osu-page osu-page--users'>
          <UserList users={this.props.friends} />
        </div>
      </div>
    );
  }
}
