// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Spinner } from 'components/spinner';
import ChannelJson from 'interfaces/chat/channel-json';
import { computed, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { getPublicChannels } from './chat-api';

type Props = Record<string, never>;

function Channel({ channel, joined, onClick }: { channel: ChannelJson; joined: boolean; onClick: (id: number) => void }) {
  return (
    <button key={channel.channel_id} className={classWithModifiers('chat-join-channel__channel', { joined })} onClick={() => onClick(channel.channel_id)}>
      <div>{joined && <i className='fas fa-check' />}</div>
      <div>{channel.name}</div>
      <div>{channel.description}</div>
    </button>
  );
}

@observer
export default class JoinChannel extends React.Component<Props> {
  @observable private channels?: ChannelJson[];


  @computed
  get joinedChannelIds() {
    return new Set(core.dataStore.channelStore.groupedChannels.PUBLIC.map((channel) => channel.channelId));
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);

    this.loadChannelList();
  }

  render() {
    if (this.channels == null) {
      return <Spinner />;
    }

    return (
      <div className='chat-join-channel'>
        <div className='chat-join-channel__channels'>
          {this.channels.map((channel) => (
            <Channel key={channel.channel_id} channel={channel} joined={this.joinedChannelIds.has(channel.channel_id)} onClick={this.handleClick} />
          ))}
        </div>
      </div>
    );
  }

  private readonly handleClick = (channelId: number) => {
    core.dataStore.chatState.joinChannel(channelId);
  };

  private async loadChannelList() {
    if (this.channels != null) return;

    this.channels = await getPublicChannels();
  }
}
