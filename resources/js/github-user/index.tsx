// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BigButton from 'components/big-button';
import GithubUserJson from 'interfaces/github-user-json';
import { route } from 'laroute';
import { action, makeObservable, observable, reaction } from 'mobx';
import { disposeOnUnmount, observer } from 'mobx-react';
import * as React from 'react';
import { onErrorWithCallback } from 'utils/ajax';
import { trans } from 'utils/lang';

interface Props {
  container: HTMLElement;
}

@observer
export default class GithubUser extends React.Component<Props> {
  @observable private unlinkXhr: JQuery.jqXHR<void> | null = null;
  @observable private user;

  constructor(props: Props) {
    super(props);

    this.user = JSON.parse(this.props.container.dataset.user ?? '') as GithubUserJson | null;

    makeObservable(this);

    disposeOnUnmount(this, reaction(
      () => JSON.stringify(this.user),
      (githubUserJson) => this.props.container.dataset.user = githubUserJson,
    ));
  }

  componentWillUnmount() {
    this.unlinkXhr?.abort();
  }

  render() {
    return (
      <div className='account-edit-entry account-edit-entry--block'>
        {this.user != null ? (
          <div className='github-user'>
            <a className='github-user__name' href={this.user.github_url}>
              {this.user.github_username}
            </a>
            <BigButton
              icon='fas fa-unlink'
              isBusy={this.unlinkXhr != null}
              modifiers={['account-edit', 'account-edit-small', 'danger']}
              props={{ onClick: this.onUnlinkButtonClick }}
              text={trans('accounts.github_user.unlink')}
            />
          </div>
        ) : (
          <>
            <BigButton
              href={route('account.github-users.create')}
              icon='fas fa-link'
              text={trans('accounts.github_user.link')}
            />
            <div className='account-edit-entry__rules'>
              {trans('accounts.github_user.info')}
            </div>
          </>
        )}
      </div>
    );
  }

  @action
  private readonly onUnlinkButtonClick = () => {
    if (this.unlinkXhr != null) return;

    this.unlinkXhr = $.ajax(
      route('account.github-users.destroy'),
      { method: 'DELETE' },
    )
      .done(action(() => this.user = null))
      .fail(onErrorWithCallback(this.onUnlinkButtonClick))
      .always(action(() => this.unlinkXhr = null));
  };
}
