// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ChannelJson from 'interfaces/chat/channel-json';
import { action, makeObservable, observable, runInAction } from 'mobx';
import { observer } from 'mobx-react';
import { Modal } from 'modal';
import Channel from 'models/chat/channel';
import core from 'osu-core-singleton';
import * as React from 'react';
import { Spinner } from 'spinner';
import { getPublicChannels } from './chat-api';
import ConversationListItem from './conversation-list-item';

@observer
export default class AddChannelButton extends React.Component {
  @observable private channels?: ChannelJson[];
  @observable private isLoading = false;

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
          <div className='chat-conversation-list-item__name'>Join Channel</div>
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

    this.isLoading = true;
    this.channels = await getPublicChannels();

    runInAction(() => {
      this.isLoading = false;
    });
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
          <select className='chat-join-channel__selector'>
            <option>Join channel</option>
            <option>Message user</option>
            <option>New announcement</option>
          </select>
          <div className='chat-conversation-list chat-conversation-list--join-channel'>
            {this.isLoading ? <Spinner /> : (
              this.channels?.map(this.renderChannel)
            )}
          </div>
        </div>
      </Modal>
    );
  }
}
