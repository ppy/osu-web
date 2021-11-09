// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserRelationJson from 'interfaces/user-relation-json';
import { route } from 'laroute';
import { observable, computed, action, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { Spinner } from 'spinner';
import { onErrorWithCallback } from 'utils/ajax';
import { Modifiers, classWithModifiers } from 'utils/css';

const bn = 'user-action-button';

interface Props {
  alwaysVisible: boolean;
  container?: HTMLElement;
  followers?: number;
  modifiers?: Modifiers;
  userId: number;
}

@observer
export default class FriendButton extends React.Component<Props> {
  static readonly defaultProps = {
    alwaysVisible: false,
  };

  @observable private followersWithoutSelf: number;
  @observable private loading = false;
  private xhr?: JQuery.jqXHR<UserRelationJson[]>;

  @computed
  private get followers() {
    return this.followersWithoutSelf + (this.friend == null ? 0 : 1);
  }

  @computed
  private get friend() {
    return core.currentUser?.friends.find((f) => f.target_id === this.props.userId);
  }

  @computed
  private get isFriendLimit() {
    return core.currentUser == null || core.currentUser.friends.length >= core.currentUser.max_friends;
  }

  @computed
  private get isVisible() {
    // - not a guest
    // - not viewing own card
    // - not blocked
    return core.currentUser != null &&
      Number.isFinite(this.props.userId) &&
      this.props.userId !== core.currentUser.id &&
      !core.currentUser.blocks.some((b) => b.target_id === this.props.userId);
  }

  private get showFollowerCounter() {
    return this.props.followers != null;
  }

  @computed
  private get title() {
    if (!this.isVisible) {
      return osu.trans('friends.buttons.disabled');
    }

    if (this.friend != null) {
      return osu.trans('friends.buttons.remove');
    }

    if (this.isFriendLimit) {
      return osu.trans('friends.too_many');
    }

    return osu.trans('friends.buttons.add');
  }

  constructor(props: Props) {
    super(props);

    this.followersWithoutSelf = this.props.followers ?? 0;
    if (this.friend != null) {
      this.followersWithoutSelf -= 1;
    }

    makeObservable(this);
  }

  componentWillUnmount() {
    this.xhr?.abort();
  }

  render() {
    if (!this.props.alwaysVisible && !this.isVisible) {
      return null;
    }

    const extraModifier = this.friend == null || this.loading
      ? null
      : (this.friend.mutual ? 'mutual' : 'friend');

    const blockClass = classWithModifiers(bn, this.props.modifiers, extraModifier);
    const disabled = !this.isVisible || this.loading || this.isFriendLimit && this.friend == null;

    return (
      <div title={this.title}>
        <button className={blockClass} disabled={disabled} onClick={this.clicked} type='button'>
          <span className={`${bn}__icon-container`}>
            {this.renderIcon()}
          </span>
          {this.renderCounter()}
        </button>
      </div>
    );
  }

  @action
  private readonly clicked = () => {
    this.loading = true;

    if (this.friend == null) {
      // friending
      this.xhr = $.ajax(route('friends.store', { target: this.props.userId }), { type: 'POST' });
    } else {
      // un-friending
      this.xhr = $.ajax(route('friends.destroy', { friend: this.props.userId }), { type: 'DELETE' });
    }

    this.xhr
      .done(this.updateFriends)
      .fail(onErrorWithCallback(this.clicked))
      .always(action(() => this.loading = false));
  };

  private renderCounter() {
    if (!this.showFollowerCounter) return;

    return <span className={`${bn}__counter`}>{osu.formatNumber(this.followers)}</span>;
  }

  private renderIcon() {
    if (this.loading) {
      return <Spinner />;
    }

    if (!this.isVisible) {
      return <span className='fas fa-user' />;
    }

    if (this.friend != null) {
      return (
        <>
          <span className={`${bn}__icon ${bn}__icon--hover-visible`}>
            <span className='fas fa-user-times' />
          </span>
          {this.friend.mutual ? (
            <span className={`${bn}__icon ${bn}__icon--hover-hidden`}>
              <span className='fas fa-user-friends' />
            </span>
          ) : (
            <span className={`${bn}__icon ${bn}__icon--hover-hidden`}>
              <span className='fas fa-user' />
            </span>
          )}
        </>
      );
    }

    return <span className={this.isFriendLimit ? 'fas fa-user' : 'fas fa-user-plus'} />;
  }

  @action
  private readonly updateFriends = (data: UserRelationJson[]) => {
    if (core.currentUser == null) return;

    core.currentUser.friends = data;
    $.publish('user:update', core.currentUser);
    $.publish('friendButton:refresh');
  };
}
