// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { SupportedChannelType, supportedChannelTypes } from 'interfaces/chat/channel-json';
import { chunk } from 'lodash';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { trans } from 'utils/lang';
import AddChannelButton from './add-channel-button';
import ConversationListItem from './conversation-list-item';

const icons: Record<SupportedChannelType, string> = {
  ANNOUNCE: 'fas fa-bullhorn',
  GROUP: 'fas fa-user-group', // just give it an icon; nothing returns this yet.
  PM: 'fas fa-envelope',
  PUBLIC: 'fas fa-comments',
  TEAM: 'fas fa-users',
};

function renderChannels(type: SupportedChannelType) {
  const channels = core.dataStore.channelStore.groupedChannels[type];
  if (channels.length > 0 || type === 'PUBLIC' || type === 'ANNOUNCE' && core.dataStore.chatState.canChatAnnounce) {
    const title = trans(`chat.channels.list.title.${type}`);

    // Optimization so that the channel list can be rendered as several smaller layers.
    // This shouldn't be too large, otherwise, Safari can't handle the layer; it also can't be
    // too small, otherwise there'll be too many layout recalculations.
    const chunks = chunk(channels, 100);

    return (
      <React.Fragment key={type}>
        <div className='chat-conversation-list__group'>
          <div className='chat-conversation-list__header'>
            <span className='chat-conversation-list__header-text'>{title}</span>
            <span className='chat-conversation-list__header-icon' title={title}><i className={icons[type]} /></span>
          </div>
          {chunks.map((c, index) => (
            <div key={index} className='chat-conversation-list__layer'>
              {c.map((channel) => <ConversationListItem key={channel.channelId} channel={channel} />)}
            </div>
          ))}
          {type === 'ANNOUNCE' && <AddChannelButton type='create' />}
          {type === 'PUBLIC' && <AddChannelButton type='join' />}
        </div>
        <div className='chat-conversation-list-separator' />
      </React.Fragment>
    );
  }

  return null;
}

export default observer(() => (
  <div className='chat-conversation-list'>
    {supportedChannelTypes.map(renderChannels)}
  </div>
));
