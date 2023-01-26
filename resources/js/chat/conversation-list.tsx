// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { SupportedChannelType, supportedChannelTypes } from 'interfaces/chat/channel-json';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { trans } from 'utils/lang';
import ConversationListItem from './conversation-list-item';
import CreateAnnouncementButton from './create-announcement-button';

const icons: Record<SupportedChannelType, string> = {
  ANNOUNCE: 'fas fa-bullhorn',
  GROUP: 'fas fa-user-group', // just give it an icon; nothing returns this yet.
  PM: 'fas fa-envelope',
  PUBLIC: 'fas fa-comments',
};

function renderChannels(type: SupportedChannelType) {
  const channels = core.dataStore.channelStore.groupedChannels[type];
  if (channels.length > 0 || type === 'ANNOUNCE' && core.dataStore.chatState.canChatAnnounce) {
    const title = trans(`chat.channels.list.title.${type}`);

    return (
      <React.Fragment key={type}>
        <div className='chat-conversation-list__group'>
          <div className='chat-conversation-list__header'>
            <span className='chat-conversation-list__header-text'>{title}</span>
            <span className='chat-conversation-list__header-icon' title={title}><i className={icons[type]} /></span>
          </div>
          {channels.map((channel) => <ConversationListItem key={channel.channelId} channel={channel} />)}
          {type === 'ANNOUNCE' && <CreateAnnouncementButton />}
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
