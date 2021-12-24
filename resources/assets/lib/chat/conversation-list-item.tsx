// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserAvatar from 'components/user-avatar';
import { observer } from 'mobx-react';
import Channel from 'models/chat/channel';
import core from 'osu-core-singleton';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';

interface Props {
  channel: Channel;
  onClick?: (channel: Channel) => void;
  showIndicators: boolean;
}

const className = 'chat-conversation-list-item';

@observer
export default class ConversationListItem extends React.Component<Props> {
  static readonly defaultProps = {
    showIndicators: true,
  };

  render() {
    const selected = this.props.showIndicators && this.props.channel.channelId === core.dataStore.chatState.selected;

    return (
      <div className={classWithModifiers(className, { selected })}>
        {this.props.channel.isUnread && !selected
          ? <div className={`${className}__unread-indicator`} />
          : null}

        {this.props.showIndicators && (
          <button className={`${className}__close-button`} onClick={this.part}>
            <i className='fas fa-times' />
          </button>
        )}

        <button className={`${className}__tile`} onClick={this.switch}>
          <div className={`${className}__avatar`}>
            <UserAvatar modifiers='full-circle' user={{ avatar_url: this.props.channel.icon }} />
          </div>
          <div className={`${className}__name`}>{this.props.channel.name}</div>

          {this.props.showIndicators && (
            <div className={`${className}__chevron`}>
              <i className='fas fa-chevron-right' />
            </div>
          )}
        </button>
      </div>
    );
  }

  private part = () => {
    core.dataStore.channelStore.partChannel(this.props.channel.channelId);
  };

  private switch = () => {
    if (this.props.onClick) {
      return this.props.onClick(this.props.channel);
    }

    core.dataStore.chatState.selectChannel(this.props.channel.channelId);
  };
}
