// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import { without } from 'lodash';
import * as React from 'react';
import { Spinner } from 'spinner';
import { classWithModifiers, Modifiers } from 'utils/css';

interface Props {
  modifiers?: Modifiers;
  userId: number;
}

interface State {
  follow: boolean;
  loading: boolean;
}

const bn = 'user-action-button';

export default class FollowUserModdingButton extends React.Component<Props, State> {
  private buttonRef = React.createRef<HTMLButtonElement>();
  private eventId = `follow-user-modding-button-${osu.uuid()}`;
  private xhr?: JQueryXHR;

  constructor(props: Props) {
    super(props);

    this.state = {
      follow: currentUser.follow_user_modding?.includes(this.props.userId) ?? false,
      loading: false,
    };
  }

  componentDidMount() {
    $.subscribe(`followUserModding:refresh.${this.eventId}`, this.refresh);
  }

  componentWillUnmount() {
    $.unsubscribe(`.${this.eventId}`);
    this.xhr?.abort();
  }

  render() {
    if (currentUser.id == null || currentUser.id === this.props.userId) {
      return null;
    }

    const title = osu.trans(`follows.user.modding.${this.state.follow ? 'to_0' : 'to_1'}`);

    let blockClass = classWithModifiers(bn, this.props.modifiers);
    blockClass += classWithModifiers(bn, { friend: this.state.follow }, true);

    return (
      <div title={title}>
        <button
          className={blockClass}
          disabled={this.state.loading}
          onClick={this.onClick}
          ref={this.buttonRef}
        >
          {this.renderIcon()}
        </button>
      </div>
    );
  }

  private onClick = () => {
    this.setState({ loading: true }, () => {
      const params: JQuery.AjaxSettings = {
        data: {
          follow: {
            notifiable_id: this.props.userId,
            notifiable_type: 'user',
            subtype: 'modding',
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
      follow: currentUser.follow_user_modding.includes(this.props.userId),
    });
  }

  private renderIcon() {
    return (this.state.loading
      ? <Spinner />
      : <i className='fas fa-bell' />
    );
  }

  private updateData = () => {
    if (this.state.follow) {
      currentUser.follow_user_modding = without(currentUser.follow_user_modding, this.props.userId);
    } else {
      currentUser.follow_user_modding = currentUser.follow_user_modding.concat(this.props.userId);
    }

    $.publish('followUserModding:refresh');
  }
}
