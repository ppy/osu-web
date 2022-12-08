// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BigButton from 'components/big-button';
import { GithubUserJsonForAccountEdit } from 'interfaces/github-user-json';
import { route } from 'laroute';
import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import * as React from 'react';
import { onErrorWithCallback } from 'utils/ajax';
import { trans } from 'utils/lang';

interface Props {
  onDelete: (id: number) => void;
  user: GithubUserJsonForAccountEdit;
}

@observer
export default class GithubUser extends React.Component<Props> {
  @observable private deleting = false;
  private xhr?: JQuery.jqXHR;

  constructor(props: Props) {
    super(props);
    makeObservable(this);
  }

  componentWillUnmount() {
    this.xhr?.abort();
  }

  render() {
    return (
      <div className='github-user'>
        <a
          className='github-user__name'
          href={this.props.user.github_url}
        >
          {this.props.user.github_username}
        </a>
        <BigButton
          icon='fas fa-trash'
          isBusy={this.deleting}
          modifiers={['account-edit', 'danger', 'settings-oauth']}
          props={{ onClick: this.onDeleteButtonClick }}
          text={trans('common.buttons.delete')}
        />
      </div>
    );
  }

  @action
  private onDeleteButtonClick = () => {
    this.xhr?.abort();
    this.deleting = true;

    this.xhr = $.ajax(
      route('account.github-users.destroy', { github_user: this.props.user.id }),
      { method: 'DELETE' },
    )
      .done(() => this.props.onDelete(this.props.user.id))
      .fail(onErrorWithCallback(this.onDeleteButtonClick))
      .always(action(() => this.deleting = false));
  };
}
