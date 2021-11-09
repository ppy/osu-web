// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserRelationJson from 'interfaces/user-relation-json';
import { route } from 'laroute';
import core from 'osu-core-singleton';
import * as React from 'react';
import { Spinner } from 'spinner';
import { onErrorWithCallback } from 'utils/ajax';
import { Modifiers, classWithModifiers } from 'utils/css';
import { nextVal } from 'utils/seq';

const bn = 'user-action-button';

interface Props {
  alwaysVisible: boolean;
  container?: HTMLElement;
  followers?: number;
  modifiers?: Modifiers;
  showFollowerCounter: boolean;
  showIf?: 'friend' | 'mutual';
  userId: number;
}

interface State {
  followersWithoutSelf: number;
  friend: UserRelationJson | undefined;
  loading: boolean;
}

export default class FriendButton extends React.PureComponent<Props, State> {
  static readonly defaultProps = {
    alwaysVisible: false,
    showFollowerCounter: false,
  };

  private readonly eventId: string;
  private xhr?: JQuery.jqXHR<UserRelationJson[]>;

  private get followers() {
    return this.state.followersWithoutSelf + (this.state.friend == null ? 0 : 1);
  }

  constructor(props: Props) {
    super(props);

    this.eventId = `friendButton-${this.props.userId}-${nextVal()}`;

    const friend = core.currentUser?.friends.find((f) => f.target_id === props.userId);
    let followersWithoutSelf = this.props.followers ?? 0;
    if (friend != null) {
      followersWithoutSelf -= 1;
    }

    this.state = {
      followersWithoutSelf,
      friend,
      loading: false,
    };
  }

  componentDidMount() {
    $.subscribe(`friendButton:refresh.${this.eventId}`, this.refresh);
  }

  componentWillUnmount() {
    $.unsubscribe(`.${this.eventId}`);
    this.xhr?.abort();
  }

  render() {
    if (this.props.showIf === 'friend' && this.state.friend == null) return null;
    if (this.props.showIf === 'mutual' && this.state.friend?.mutual !== true) return null;

    const isVisible = this.isVisible();

    if (!this.props.alwaysVisible) {
      if (isVisible) {
        this.props.container?.classList.remove('hidden');
      } else {
        this.props.container?.classList.add('hidden');

        return null;
      }
    }

    let blockClass = classWithModifiers(bn, this.props.modifiers);

    const isFriendLimit = core.currentUser == null || core.currentUser.friends.length >= core.currentUser.max_friends;
    const title = (() => {
      if (!isVisible) {
        return osu.trans('friends.buttons.disabled');
      }

      if (this.state.friend != null) {
        return osu.trans('friends.buttons.remove');
      }

      if (isFriendLimit) {
        return osu.trans('friends.too_many');
      }

      return osu.trans('friends.buttons.add');
    })();

    const disabled = !isVisible || this.state.loading || isFriendLimit && this.state.friend == null;

    if (this.state.friend != null && !this.state.loading) {
      if (this.state.friend.mutual) {
        blockClass += ` ${bn}--mutual`;
      } else {
        blockClass += ` ${bn}--friend`;
      }
    }

    return (
      <div title={title}>
        <button
          className={blockClass}
          disabled={disabled}
          onClick={this.clicked}
          type='button'
        >
          <span className={`${bn}__icon-container`}>
            {this.renderIcon(isFriendLimit, isVisible)}
          </span>
          {this.renderCounter()}
        </button>
      </div>
    );
  }

  private readonly clicked = () => {
    this.setState({ loading: true });

    if (this.state.friend == null) {
      // friending
      this.xhr = $.ajax(route('friends.store', { target: this.props.userId }), { type: 'POST' });
    } else {
      // un-friending
      this.xhr = $.ajax(route('friends.destroy', { friend: this.props.userId }), { type: 'DELETE' });
    }

    this.xhr
      .done(this.updateFriends)
      .fail(onErrorWithCallback(this.clicked))
      .always(this.requestDone);
  };

  private isVisible() {
    // - not a guest
    // - not viewing own card
    // - not blocked
    return core.currentUser != null &&
      Number.isFinite(this.props.userId) &&
      this.props.userId !== core.currentUser.id &&
      !core.currentUser.blocks.some((b) => b.target_id === this.props.userId);
  }

  private readonly refresh = () => {
    this.setState(
      { friend: core.currentUser?.friends.find((f) => f.target_id === this.props.userId) },
      this.forceUpdate,
    );
  };

  private renderCounter() {
    if (!this.props.showFollowerCounter || this.props.followers == null) return;

    return <span className={`${bn}__counter`}>{osu.formatNumber(this.followers)}</span>;
  }

  private renderIcon(isFriendLimit: boolean, isVisible: boolean) {
    if (this.state.loading) {
      return <Spinner />;
    }

    if (!isVisible) {
      return <span className='fas fa-user' />;
    }

    if (this.state.friend != null) {
      return (
        <>
          <span className={`${bn}__icon ${bn}__icon--hover-visible`}>
            <span className='fas fa-user-times' />
          </span>
          {this.state.friend.mutual ? (
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

    return <span className={isFriendLimit ? 'fas fa-user' : 'fas fa-user-plus'} />;
  }

  private readonly requestDone = () => {
    this.setState({ loading: false });
  };

  private readonly updateFriends = (data: UserRelationJson[]) => {
    this.setState({ friend: data.find((f) => f.target_id === this.props.userId) }, () => {
      if (core.currentUser == null) return;
      core.currentUser.friends = data;
      $.publish('user:update', core.currentUser);
      $.publish('friendButton:refresh');
    });
  };
}
