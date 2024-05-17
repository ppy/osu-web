// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import FollowJson from 'interfaces/follow-json';
import { route } from 'laroute';
import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { classWithModifiers, Modifiers } from 'utils/css';
import { Spinner } from './spinner';

interface Props {
  follow: FollowJson;
  following: boolean;
  modifiers?: Modifiers;
}

@observer
export default class FollowToggle extends React.PureComponent<Props> {
  static defaultProps = {
    following: true,
  };

  @observable _following: boolean;
  @observable private xhr?: JQuery.jqXHR;

  private get following() {
    return this.props.follow.subtype === 'mapping'
      ? core.currentUserModel.followUserMapping.has(this.props.follow.notifiable_id)
      : this._following;
  }

  private get toggling() {
    return this.xhr != null;
  }

  constructor(props: Props) {
    super(props);
    makeObservable(this);

    this._following = this.props.following;
  }

  render() {
    return (
      <button
        className={classWithModifiers('btn-circle', this.props.modifiers)}
        disabled={this.toggling}
        onClick={this.onClick}
        type='button'
      >
        <span className='btn-circle__content'>
          {this.renderToggleIcon()}
        </span>
      </button>
    );
  }

  @action
  private readonly onClick = () => {
    if (this.xhr != null) return;

    const settings = {
      data: {
        follow: {
          notifiable_id: this.props.follow.notifiable_id,
          notifiable_type: this.props.follow.notifiable_type,
          subtype: this.props.follow.subtype,
        },
      },
      method: this.following ? 'DELETE' : 'POST',
    };

    this.xhr = $.ajax(route('follows.store'), settings)
      .done(action(() => {
        if (this.props.follow.subtype === 'mapping') {
          core.currentUserModel.updateFollowUserMapping(!this.following, this.props.follow.notifiable_id);
        } else {
          this._following = !this.following;
        }
      })).always(action(() => {
        this.xhr = undefined;
      }));
  };

  private renderToggleIcon() {
    if (this.toggling) {
      return (
        <span className='btn-circle__icon'>
          <Spinner />
        </span>
      );
    }

    let hoverIcon: string;
    let normalIcon: string;

    if (this.following) {
      normalIcon = 'fas fa-bell';
      hoverIcon = 'fas fa-bell-slash';
    } else {
      normalIcon = 'far fa-bell';
      hoverIcon = 'fas fa-bell';
    }

    return (
      <>
        <span className='btn-circle__icon btn-circle__icon--hover-show'>
          <span className={hoverIcon} />
        </span>
        <span className='btn-circle__icon btn-circle__icon--hover-hide'>
          <span className={normalIcon} />
        </span>
      </>
    );
  }
}
