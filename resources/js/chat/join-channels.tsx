// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Spinner } from 'components/spinner';
import ChannelJson from 'interfaces/chat/channel-json';
import { computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';

type JoinedStatus = 'joined' | 'joining' | null;
type Props = Record<string, never>;

interface ChannelProps {
  channel: ChannelJson;
  onClick: (channelId: number) => void;
  status: JoinedStatus;
}

function Channel({ channel, onClick, status }: ChannelProps) {
  const handleClick = React.useCallback(
    () => onClick(channel.channel_id),
    [channel.channel_id, onClick],
  );

  let statusElement: React.ReactNode | undefined;
  if (status === 'joined') {
    statusElement = <i className='fas fa-check' />;
  } else if (status === 'joining') {
    statusElement = <Spinner />;
  }

  return (
    <button className={classWithModifiers('chat-join-channel__channel', { joined: status === 'joined' })} onClick={handleClick}>
      <span>{statusElement}</span>
      <span>{channel.name}</span>
      <span>{channel.description}</span>
    </button>
  );
}

@observer
export default class JoinChannels extends React.Component<Props> {
  get channels() {
    return core.dataStore.chatState.publicChannels;
  }

  get isLoading() {
    return core.dataStore.chatState.publicChannelsXhr != null;
  }

  get error() {
    return core.dataStore.chatState.publicChannelsXhrError;
  }

  @computed
  get joinedPublicChannelIds() {
    return new Set(core.dataStore.channelStore.groupedChannels.PUBLIC.map((channel) => channel.channelId));
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  render() {
    return (
      <div className='chat-join-channel'>
        <div className='chat-join-channel__toolbar'>
          <button className='btn-osu-big btn-osu-big--rounded-thin' onClick={this.handleRefreshClick} type='button'>
            {trans('common.buttons.refresh')}
          </button>
        </div>
        {this.isLoading ? (
          <div className='chat-join-channel__loading'>
            {this.renderLoading()}
          </div>
        ) : (
          <div className='chat-join-channel__channels'>
            {this.channels?.map(this.renderChannel)}
          </div>
        )}
      </div>
    );
  }

  private readonly handleClick = (channelId: number) => {
    core.dataStore.chatState.addChannel(channelId);
  };

  private readonly handleRefreshClick = () => {
    core.dataStore.chatState.loadPublicChannelList();
  };

  private readonly renderChannel = (channel: ChannelJson) => {
    let status: JoinedStatus = null;
    if (this.joinedPublicChannelIds.has(channel.channel_id)) {
      status = 'joined';
    } else if (core.dataStore.chatState.joiningChannelId === channel.channel_id) {
      status = 'joining';
    }

    return (
      <Channel
        key={channel.channel_id}
        channel={channel}
        onClick={this.handleClick}
        status={status}
      />
    );
  };

  private renderLoading() {
    if (this.error) {
      return (
        <>
          <p>{trans('errors.load_failed')}</p>
          <button className='btn-osu-big btn-osu-big--rounded-thin' onClick={this.handleRefreshClick} type='button'>
            {trans('common.buttons.refresh')}
          </button>
        </>
      );
    }

    return (
      <>
        <Spinner />
        <p>{trans('chat.join_channels.loading')}</p>
      </>
    );
  }
}
