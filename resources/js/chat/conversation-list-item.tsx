// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserAvatar from 'components/user-avatar';
import { computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import Channel from 'models/chat/channel';
import core from 'osu-core-singleton';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';

interface Props {
  channel: Channel;
}

@observer
export default class ConversationListItem extends React.Component<Props> {
  private readonly ref = React.createRef<HTMLDivElement>();

  @computed
  get selected() {
    return this.props.channel.channelId === core.dataStore.chatState.selectedChannel?.channelId;
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }


  componentDidMount() {
    // if the current channel is selected on mount, it's probably on page load, so centre it.
    this.ensureSelectedInView('center');
  }

  componentDidUpdate() {
    this.ensureSelectedInView('nearest');
  }

  render(): React.ReactNode {
    const baseClassName = 'chat-conversation-list-item';

    return (
      <div ref={this.ref} className={classWithModifiers(baseClassName, { selected: this.selected })}>
        {this.props.channel.isUnread && !this.selected
          ? <div className={`${baseClassName}__unread-indicator`} />
          : null}

        <button className={`${baseClassName}__close-button`} onClick={this.part}>
          <i className='fas fa-times' />
        </button>

        <button className={`${baseClassName}__tile`} onClick={this.switch}>
          <div className={`${baseClassName}__avatar`}>
            <UserAvatar modifiers='full-circle' user={{ avatar_url: this.props.channel.icon }} />
          </div>
          <div className={`${baseClassName}__name u-ellipsis-overflow`}>{this.props.channel.name}</div>
          <div className={`${baseClassName}__chevron`}>
            <i className='fas fa-chevron-right' />
          </div>
        </button>
      </div>
    );
  }

  private ensureSelectedInView(block: ScrollLogicalPosition) {
    if (this.selected) {
      setTimeout(() => {
        this.ref.current?.scrollIntoView({ block, inline: 'nearest' });
      }, 0);
    }
  }

  private readonly part = () => {
    if (this.props.channel.type === 'ANNOUNCE' && !confirm(trans('chat.channels.confirm_part'))){
      return;
    }

    core.dataStore.channelStore.partChannel(this.props.channel.channelId);
  };

  private readonly switch = () => {
    core.dataStore.chatState.selectChannel(this.props.channel.channelId);
  };
}
