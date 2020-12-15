// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import { without } from 'lodash';
import * as React from 'react';
import { Spinner } from 'spinner';
import { classWithModifiers, Modifiers } from 'utils/css';

interface Props {
  alwaysVisible?: boolean;
  followers?: number;
  modifiers?: Modifiers;
  showFollowerCounter?: boolean;
  userId: number;
}

interface State {
  follow: boolean;
  followersWithoutSelf: number;
  loading: boolean;
}

const bn = 'user-action-button';

export default class FollowUserMappingButton extends React.Component<Props, State> {
  private buttonRef = React.createRef<HTMLButtonElement>();
  private eventId = `follow-user-mapping-button-${osu.uuid()}`;
  private xhr?: JQueryXHR;

  constructor(props: Props) {
    super(props);

    const follow = currentUser.follow_user_mapping?.includes(this.props.userId) ?? false;
    let followersWithoutSelf = this.props.followers ?? 0;

    if (follow !== false) followersWithoutSelf -= 1;

    this.state = {
      follow,
      followersWithoutSelf,
      loading: false,
    };
  }

  componentDidMount() {
    $.subscribe(`followUserMapping:refresh.${this.eventId}`, this.refresh);
  }

  componentWillUnmount() {
    $.unsubscribe(`.${this.eventId}`);
    this.xhr?.abort();
  }

  render() {
    if (currentUser.id == null || (currentUser.id === this.props.userId && !this.props.alwaysVisible)) {
      return null;
    }

    const currentUserProfile = currentUser.id === this.props.userId;

    let title = osu.trans(`follows.mapping.${this.state.follow ? 'to_0' : 'to_1'}`);
    if (currentUserProfile) title = osu.trans(`follows.mapping.disabled`);

    let blockClass = classWithModifiers(bn, this.props.modifiers);
    blockClass += classWithModifiers(bn, { friend: this.state.follow }, true);

    const disabled = this.state.loading || currentUserProfile;

    return (
      <div title={title}>
        <button
          className={blockClass}
          disabled={disabled}
          onClick={this.onClick}
          ref={this.buttonRef}
        >
          {this.renderIcon()}
          {this.renderCounter()}
        </button>
      </div>
    );
  }

  private followers() {
    return this.state.followersWithoutSelf + (this.state.follow ? 1 : 0);
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

      if (this.state.follow) {
        params.type = 'DELETE';
        params.url = route('follows.destroy');
      } else {
        params.type = 'POST';
        params.url = route('follows.store');
      }

      this.xhr = $.ajax(params)
        .done(this.updateData)
        .fail(osu.emitAjaxError(this.buttonRef.current))
        .always(() => this.setState({ loading: false }));
    });
  }

  private refresh = () => {
    this.setState({
      follow: currentUser.follow_user_mapping.includes(this.props.userId),
    });
  }

  private renderCounter() {
    if (this.props.showFollowerCounter == null || this.props.followers == null) {
      return;
    }

    return(
      <span className={`${bn}__counter`}>
        {osu.formatNumber(this.followers())}
      </span>
    );
  }

  private renderIcon() {
    const icon = this.state.loading
      ? <Spinner />
      : <i className='fas fa-bell' />;

    return(
      <span className={`${bn}__icon-container`}>
        {icon}
      </span>
    );
  }

  private updateData = () => {
    if (this.state.follow) {
      currentUser.follow_user_mapping = without(currentUser.follow_user_mapping, this.props.userId);
    } else {
      currentUser.follow_user_mapping = currentUser.follow_user_mapping.concat(this.props.userId);
    }

    $.publish('followUserMapping:refresh');
  }
}
