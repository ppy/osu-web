// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Spinner } from 'components/spinner';
import ChannelJson from 'interfaces/chat/channel-json';
import { action, computed, makeObservable, observable, runInAction } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { isJqXHR } from 'utils/ajax';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import { getPublicChannels } from './chat-api';

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
    <button key={channel.channel_id} className={classWithModifiers('chat-join-channel__channel', { joined: status === 'joined' })} onClick={handleClick}>
      <span>{statusElement}</span>
      <span>{channel.name}</span>
      <span>{channel.description}</span>
    </button>
  );
}

@observer
export default class JoinChannels extends React.Component<Props> {
  @observable private channels?: ChannelJson[];
  @observable private error = false;
  private xhr: ReturnType<typeof getPublicChannels> | null= null;

  @computed
  get joinedPublicChannelIds() {
    return new Set(core.dataStore.channelStore.groupedChannels.PUBLIC.map((channel) => channel.channelId));
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);

    this.loadChannelList();
  }

  componentWillUnmount() {
    this.xhr?.abort();
  }

  render() {
    return (
      <div className='chat-join-channel'>
        {this.channels == null ? (
          <div className='chat-join-channel__loading'>
            {this.renderLoading()}
          </div>
        ) : (
          <div className='chat-join-channel__channels'>
            {this.channels.map(this.renderChannel)}
          </div>
        )}
      </div>
    );
  }

  private readonly handleClick = (channelId: number) => {
    core.dataStore.chatState.joinChannel(channelId);
  };

  private readonly handleRetryClick = () => {
    this.loadChannelList();
  };

  @action
  private async loadChannelList() {
    if (this.channels != null || this.xhr != null) return;

    this.error = false;

    try {
      this.xhr = getPublicChannels();
      const channels = await this.xhr;
      runInAction(() => {
        this.channels = channels;
      });
    } catch (error) {
      if (!isJqXHR(error)) throw error;
      runInAction(() => {
        this.error = true;
      });
    } finally {
      this.xhr = null;
    }
  }

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
          <button className='btn-osu-big btn-osu-big--rounded-thin' onClick={this.handleRetryClick} type='button'>
            {trans('common.buttons.retry')}
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
