// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { dispatch } from 'app-dispatcher';
import ChannelJson from 'interfaces/chat/channel-json';
import { action, makeObservable, observable, runInAction } from 'mobx';
import { observer } from 'mobx-react';
import { Modal } from 'modal';
import core from 'osu-core-singleton';
import * as React from 'react';
import { Spinner } from 'spinner';
import ChannelJoinEvent from './channel-join-event';
import { getPublicChannels, joinChannel } from './chat-api';

@observer
export default class AddChannelButton extends React.Component {
  @observable private channels?: ChannelJson[];
  @observable private isLoading = false;
  @observable private isOpen = false;

  constructor(props: Record<string, never>) {
    super(props);

    makeObservable(this);
  }

  render() {
    return (
      <div className='chat-conversation-list-item'>
        <button className={'chat-conversation-list-item__tile'} onClick={this.toggle}>
          <div className={'chat-conversation-list-item__avatar'} />
          <div className={'chat-conversation-list-item__name'}>Join Channel</div>
          <div className={'chat-conversation-list-item__chevron'}>
            <i className='fas fa-chevron-right' />
          </div>
        </button>
        {this.renderModal()}
      </div>
    );
  }

  @action
  private handleChannelClick = async (e: React.SyntheticEvent<HTMLElement>) => {
    const channelId = parseInt(e.currentTarget.dataset.id ?? '', 10);

    const json = await joinChannel(channelId, core.currentUserOrFail.id);

    runInAction(() => {
      dispatch(new ChannelJoinEvent(json));
      this.isOpen = false;
    });
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

  private renderChannel = (channel: ChannelJson) => (
    <div key={channel.channel_id} data-id={channel.channel_id} onClick={this.handleChannelClick}>{channel.name}</div>
  );

  private renderModal() {
    if (!this.isOpen) return null;

    return (
      <Modal onClose={this.toggle} visible>
        <div className='add-channel-list'>
          {this.isLoading ? <Spinner /> : (
            this.channels?.map(this.renderChannel)
          )}
        </div>
      </Modal>
    );
  }

  @action
  private toggle = () => {
    this.isOpen = !this.isOpen;
    if (this.isOpen) {
      this.loadChannels();
    }
  };
}
