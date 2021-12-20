// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import FollowJson from 'interfaces/follow-json';
import { route } from 'laroute';
import core from 'osu-core-singleton';
import * as React from 'react';
import { Spinner } from 'spinner';
import { classWithModifiers, Modifiers } from 'utils/css';
import { nextVal } from 'utils/seq';

interface Props {
  follow: FollowJson;
  following: boolean;
  modifiers?: Modifiers;
}

interface State {
  following: boolean;
  toggling: boolean;
}

export default class FollowToggle extends React.PureComponent<Props, State> {
  static defaultProps = {
    following: true,
  };

  state: State;

  private eventId = `follow-toggle-${nextVal()}`;
  private toggleXhr: null | JQueryXHR = null;

  constructor(props: Props) {
    super(props);

    this.state = {
      following: this.props.following,
      toggling: false,
    };
  }

  componentDidMount() {
    if (this.props.follow.subtype === 'mapping') {
      $.subscribe(`user:followUserMapping:refresh.${this.eventId}`, this.refresh);
    }
  }

  componentWillUnmount() {
    $.unsubscribe(`.${this.eventId}`);
  }

  render() {
    return (
      <button
        className={classWithModifiers('btn-circle', this.props.modifiers)}
        disabled={this.state.toggling}
        onClick={this.onClick}
        type='button'
      >
        <span className='btn-circle__content'>
          {this.renderToggleIcon()}
        </span>
      </button>
    );
  }

  private onClick = () => {
    const params = {
      follow: {
        notifiable_id: this.props.follow.notifiable_id,
        notifiable_type: this.props.follow.notifiable_type,
        subtype: this.props.follow.subtype,
      },
    };

    const method = this.state.following ? 'DELETE' : 'POST';

    this.toggleXhr?.abort();

    this.setState({ toggling: true }, () => {
      this.toggleXhr = $.ajax(route('follows.store'), { data: params, method })
        .done(() => {
          if (this.props.follow.subtype === 'mapping') {
            $.publish('user:followUserMapping:update', {
              following: !this.state.following,
              userId: this.props.follow.notifiable_id,
            });
          } else {
            this.setState({ following: !this.state.following });
          }
        }).always(() => {
          this.setState({ toggling: false });
        });
    });
  };

  private refresh = () => {
    if (this.props.follow.subtype === 'mapping') {
      this.setState({
        following: core.currentUser != null && core.currentUser.follow_user_mapping.includes(this.props.follow.notifiable_id),
      });
    }
  };

  private renderToggleIcon() {
    if (this.state.toggling) {
      return (
        <span className='btn-circle__icon'>
          <Spinner />
        </span>
      );
    }

    let hoverIcon: string;
    let normalIcon: string;

    if (this.state.following) {
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
