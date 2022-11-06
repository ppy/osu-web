// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BigButton from 'components/big-button';
import { GithubUserJsonForAccountEdit } from 'interfaces/github-user-json';
import { route } from 'laroute';
import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import GithubUser from './github-user';

interface Props {
  users: GithubUserJsonForAccountEdit[];
}

@observer
export default class GithubUsers extends React.Component<Props> {
  @observable private users: GithubUserJsonForAccountEdit[];

  constructor(props: Props) {
    super(props);

    this.users = props.users;

    makeObservable(this);
  }

  render() {
    return (
      <>
        {this.users.length === 0
          ? <div className='github-user'>{osu.trans('accounts.github_users.none')}</div>
          : this.users.map((user) => (
            <GithubUser
              key={user.id}
              onDelete={this.onDelete}
              user={user}
            />
          ))}
        <BigButton
          href={route('account.github-users.create')}
          icon='fas fa-link'
          text={osu.trans('accounts.github_users.link')}
        />
      </>
    );
  }

  @action
  private onDelete = (id: number) => {
    this.users = this.users.filter((user) => user.id !== id);
  };
}
