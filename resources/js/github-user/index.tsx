// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BigButton from 'components/big-button';
import GithubUserJson from 'interfaces/github-user-json';
import { route } from 'laroute';
import { action, makeObservable, observable, reaction } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { onErrorWithCallback } from 'utils/ajax';
import { trans } from 'utils/lang';

interface Props {
  container: HTMLElement;
}

@observer
export default class GithubUser extends React.Component<Props> {
  @observable private user: GithubUserJson | null;
  private userDatasetSyncDisposer;
  @observable private xhr: JQuery.jqXHR<void> | null = null;

  constructor(props: Props) {
    super(props);

    this.user = JSON.parse(this.props.container.dataset.user ?? '') as GithubUserJson | null;
    this.userDatasetSyncDisposer = reaction(
      () => JSON.stringify(this.user),
      (githubUserJson) => this.props.container.dataset.user = githubUserJson,
    );

    makeObservable(this);
  }

  componentWillUnmount() {
    this.userDatasetSyncDisposer();
    this.xhr?.abort();
  }

  render() {
    return (
      <div className='github-user'>
        {this.user != null ? (
          <>
            <a
              className='github-user__name'
              href={this.user.github_url}
            >
              {this.user.github_username}
            </a>
            <BigButton
              icon='fas fa-trash'
              isBusy={this.xhr != null}
              modifiers={['account-edit', 'danger', 'settings-github']}
              props={{ onClick: this.onDeleteButtonClick }}
              text={trans('common.buttons.delete')}
            />
          </>
        ) : (
          <BigButton
            href={route('account.github-users.create')}
            icon='fas fa-link'
            props={{ 'data-turbolinks': 'false' }}
            text={trans('accounts.github_user.link')}
          />
        )}
      </div>
    );
  }

  @action
  private onDeleteButtonClick = () => {
    if (this.xhr != null) return;

    this.xhr = $.ajax(
      route('account.github-users.destroy', { github_user: this.user?.id }),
      { method: 'DELETE' },
    )
      .done(action(() => this.user = null))
      .fail(onErrorWithCallback(this.onDeleteButtonClick))
      .always(action(() => this.xhr = null));
  };
}
