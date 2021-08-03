// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import * as osu from 'osu-common';
import * as React from 'react';
import { Spinner } from 'spinner';
import { onErrorWithClick } from 'utils/ajax';
import { classWithModifiers, Modifiers } from 'utils/css';
import { nextVal } from 'utils/seq';

interface Props {
  alwaysVisible?: boolean;
  followers?: number;
  modifiers?: Modifiers;
  showFollowerCounter?: boolean;
  userId: number;
}

interface State {
  followersWithoutSelf: number;
  following: boolean;
  loading: boolean;
}

const bn = 'user-action-button';

export default class FollowUserMappingButton extends React.Component<Props, State> {
  private buttonRef = React.createRef<HTMLButtonElement>();
  private eventId = `follow-user-mapping-button-${nextVal()}`;
  private xhr?: JQueryXHR;

  constructor(props: Props) {
    super(props);

    const following = currentUser.follow_user_mapping?.includes(this.props.userId) ?? false;
    let followersWithoutSelf = this.props.followers ?? 0;

    if (following !== false) followersWithoutSelf -= 1;

    this.state = {
      followersWithoutSelf,
      following,
      loading: false,
    };
  }

  componentDidMount() {
    $.subscribe(`user:followUserMapping:refresh.${this.eventId}`, this.refresh);
  }

  componentWillUnmount() {
    $.unsubscribe(`.${this.eventId}`);
    this.xhr?.abort();
  }

  render() {
    const canToggle = !(currentUser.id == null || currentUser.id === this.props.userId);

    if (!canToggle && !this.props.alwaysVisible) {
      return null;
    }

    const title = canToggle
      ? osu.trans(`follows.mapping.${this.state.following ? 'to_0' : 'to_1'}`)
      : osu.trans('follows.mapping.followers');

    const blockClass = classWithModifiers(
      bn,
      this.props.modifiers,
      { friend: this.state.following },
    );

    const disabled = this.state.loading || !canToggle;

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

  private followers() {
    return this.state.followersWithoutSelf + (this.state.following ? 1 : 0);
  }

  private onClick = () => {
    this.setState({ loading: true }, () => {
      const params: JQuery.AjaxSettings = {
        data: {
          follow: {
            notifiable_id: this.props.userId,
            notifiable_type: 'user',
            subtype: 'mapping',
          },
        },
      };

      if (this.state.following) {
        params.type = 'DELETE';
        params.url = route('follows.destroy');
      } else {
        params.type = 'POST';
        params.url = route('follows.store');
      }

      this.xhr = $.ajax(params)
        .done(this.updateData)
        .fail(onErrorWithClick(this.buttonRef.current))
        .always(() => this.setState({ loading: false }));
    });
  };

  private refresh = () => {
    this.setState({
      following: currentUser.follow_user_mapping.includes(this.props.userId),
    });
  };

  private renderCounter() {
    if (this.props.showFollowerCounter == null || this.props.followers == null) {
      return;
    }

    return (
      <span className={`${bn}__counter`}>
        {osu.formatNumber(this.followers())}
      </span>
    );
  }

  private renderIcon() {
    const icon = this.state.loading
      ? <Spinner />
      : <i className='fas fa-bell' />;

    return (
      <span className={`${bn}__icon-container`}>
        {icon}
      </span>
    );
  }

  private updateData = () => {
    $.publish('user:followUserMapping:update', { following: !this.state.following, userId: this.props.userId });
  };
}
