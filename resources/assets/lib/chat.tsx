// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import MainView from 'chat/main-view';
import ChannelJson from 'interfaces/chat/channel-json';
import UserJson from 'interfaces/user-json';
import { action } from 'mobx';
import Channel from 'models/chat/channel';
import core from 'osu-core-singleton';
import * as React from 'react';
import { parseJsonNullable } from 'utils/json';
import { currentUrlParams } from 'utils/turbolinks';

interface ChatInitialJson {
  last_message_id: number | null;
  presence: ChannelJson[];
  send_to?: SendToJson;
}

interface SendToJson {
  can_message_error: string | null;
  channel_id: number | null;
  target: UserJson;
}

core.reactTurbolinks.register('chat', action(() => {
  const dataStore = core.dataStore;
  const initial = parseJsonNullable<ChatInitialJson>('json-chat-initial', true);

  if (initial != null) {
    if (Array.isArray(initial.presence)) {
      // initial population of channel/presence data
      dataStore.channelStore.updateWithPresence(initial.presence);
    }

    dataStore.channelStore.lastReceivedMessageId = initial.last_message_id ?? 0;
  }

  let initialChannel = 0;
  const sendTo = initial?.send_to;

  if (sendTo != null) {
    const target = dataStore.userStore.getOrCreate(sendTo.target.id, sendTo.target); // pre-populate userStore with target
    let channel = dataStore.channelStore.findPM(target.id);

    if (channel != null) {
      initialChannel = channel.channelId;
    } else if (!target.is(core.currentUser)) {
      channel = Channel.newPM(target, sendTo.channel_id);
      channel.canMessageError = sendTo.can_message_error; // TODO: move can_message to a user prop?
      dataStore.channelStore.channels.set(channel.channelId, channel);
      initialChannel = channel.channelId;
    }
  } else {
    const channelId = parseInt(currentUrlParams().get('channel_id') ?? '', 10);
    // TODO: should clear query string as well (and maybe update on channel selection?)
    initialChannel = dataStore.channelStore.get(channelId) != null ? channelId : dataStore.chatState.selected;

    if (initialChannel === 0) {
      if (dataStore.channelStore.nonPmChannels.length > 0) {
        initialChannel = dataStore.channelStore.nonPmChannels[0].channelId;
      } else if (dataStore.channelStore.pmChannels.length > 0) {
        initialChannel = dataStore.channelStore.pmChannels[0].channelId;
      }
    }
  }

  if (initialChannel !== 0) {
    void dataStore.chatState.selectChannel(initialChannel);
  }

  return <MainView dataStore={core.dataStore} />;
}));
