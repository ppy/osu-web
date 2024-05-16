// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import { action, computed, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { onErrorWithClick } from 'utils/ajax';
import { classWithModifiers, Modifiers } from 'utils/css';
import { formatNumber } from 'utils/html';
import { trans } from 'utils/lang';
import { Spinner } from './spinner';

interface Props {
  alwaysVisible?: boolean;
  followers?: number;
  modifiers?: Modifiers;
  showFollowerCounter?: boolean;
  userId: number;
}

const bn = 'user-action-button';

@observer
export default class FollowUserMappingButton extends React.Component<Props> {
  private readonly buttonRef = React.createRef<HTMLButtonElement>();
  private readonly followerCountWithoutSelf;
  @observable private xhr?: JQuery.jqXHR;

  private get following() {
    return core.currentUserModel.following.has(this.props.userId);
  }

  @computed
  private get followerCount() {
    return this.followerCountWithoutSelf + (this.following ? 1 : 0);
  }

  private get loading() {
    return this.xhr != null;
  }

  constructor(props: Props) {
    super(props);
    makeObservable(this);

    this.followerCountWithoutSelf = this.props.followers ?? 0;
    if (this.following) this.followerCountWithoutSelf -= 1;
  }

  componentWillUnmount() {
    this.xhr?.abort();
  }

  render() {
    const canToggle = !(core.currentUser == null || core.currentUser.id === this.props.userId);

    if (!canToggle && !this.props.alwaysVisible) {
      return null;
    }

    const title = canToggle
      ? trans(`follows.mapping.${this.following ? 'to_0' : 'to_1'}`)
      : trans('follows.mapping.followers');

    const blockClass = classWithModifiers(
      bn,
      this.props.modifiers,
      { friend: this.following },
    );

    const disabled = this.loading || !canToggle;

    return (
      <div title={title}>
        <button
          ref={this.buttonRef}
          className={blockClass}
          disabled={disabled}
          onClick={this.onClick}
        >
          {this.renderIcon()}
          {this.renderCounter()}
        </button>
      </div>
    );
  }

  @action
  private readonly onClick = () => {
    const params: JQuery.AjaxSettings = {
      data: {
        follow: {
          notifiable_id: this.props.userId,
          notifiable_type: 'user',
          subtype: 'mapping',
        },
      },
    };

    if (this.following) {
      params.type = 'DELETE';
      params.url = route('follows.destroy');
    } else {
      params.type = 'POST';
      params.url = route('follows.store');
    }

    this.xhr = $.ajax(params)
      .done(this.updateData)
      .fail(onErrorWithClick(this.buttonRef.current))
      .always(action(() => this.xhr = undefined));
  };

  private renderCounter() {
    if (this.props.showFollowerCounter == null || this.props.followers == null) {
      return;
    }

    return(
      <span className={`${bn}__counter`}>
        {formatNumber(this.followerCount)}
      </span>
    );
  }

  private renderIcon() {
    const icon = this.loading
      ? <Spinner />
      : <i className='fas fa-bell' />;

    return(
      <span className={`${bn}__icon-container`}>
        {icon}
      </span>
    );
  }

  @action
  private readonly updateData = () => {
    core.currentUserModel.updateFollowUserMapping(!this.following, this.props.userId);
  };
}
