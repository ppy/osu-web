// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Modal } from 'components/modal';
import { Spinner } from 'components/spinner';
import ChannelJson from 'interfaces/chat/channel-json';
import { action, computed, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import Channel from 'models/chat/channel';
import core from 'osu-core-singleton';
import * as React from 'react';
import { getPublicChannels } from './chat-api';
import ConversationListItem from './conversation-list-item';

@observer
export default class JoinChannelButton extends React.Component {
  @observable private channels?: ChannelJson[];

  @computed
  get joinableChannels() {
    const channelIds = new Set(core.dataStore.channelStore.groupedChannels.PUBLIC.map((channel) => channel.channelId));

    return this.channels == null
      ? []
      : this.channels
        .filter((channel) => !channelIds.has(channel.channel_id))
        .sort((a, b) => a.name.localeCompare(b.name));
  }

  constructor(props: Record<string, never>) {
    super(props);

    makeObservable(this);
  }

  render() {
    return (
      <div className='chat-conversation-list-item'>
        <button className='chat-conversation-list-item__tile' onClick={this.handleModalOpen}>
          <div className='chat-conversation-list-item__avatar'>
            <span className='avatar avatar--join-channel'>
              <span className='fas fa-plus' />
            </span>
          </div>
          <div className='chat-conversation-list-item__name'>{osu.trans('chat.channels.join')}</div>
        </button>
        {this.renderModal()}
      </div>
    );
  }

  @action
  private handleChannelClick = (channel: Channel) => {
    core.dataStore.chatState.joinChannel(channel.channelId);
  };

  @action
  private handleModalClose = () => {
    core.dataStore.chatState.displayJoinDialog = false;
  };

  @action
  private handleModalOpen = () => {
    core.dataStore.chatState.displayJoinDialog = true;
    this.loadChannels();
  };

  @action
  private async loadChannels() {
    if (this.channels != null) return;

    this.channels = await getPublicChannels();
  }

  private renderChannel = (json: ChannelJson) => {
    const channel = new Channel(json.channel_id).updateWithJson(json);
    return <ConversationListItem key={channel.channelId} channel={channel} onClick={this.handleChannelClick} showIndicators={false} />;
  };

  private renderModal() {
    if (!core.dataStore.chatState.displayJoinDialog) return null;

    return (
      <Modal onClose={this.handleModalClose} visible>
        <div className='chat-join-channel'>
          <div className='chat-join-channel__title'>
            {osu.trans('chat.channels.join')}
          </div>
          <div className='chat-conversation-list chat-conversation-list--join-channel'>
            {/* TODO: empty list */}
            {this.channels == null ? <div className='chat-join-channel__spinner'><Spinner /></div> : (
              this.joinableChannels.map(this.renderChannel)
            )}
          </div>
          {/* TODO: close button */}
        </div>
      </Modal>
    );
  }
}
