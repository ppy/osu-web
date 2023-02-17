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
import { currentUrl, currentUrlParams } from 'utils/turbolinks';

interface ChatInitialJson {
  current_user_attributes: {
    can_chat_announce: boolean;
  };
  last_message_id: number | null;
  presence: ChannelJson[];
  send_to?: SendToJson;
}

interface SendToJson {
  can_message_error: string | null;
  channel_id: number | null;
  target: UserJson;
}

function getParamValue(urlParams: URLSearchParams, key: string) {
  const value = Number(urlParams.get(key));
  return Number.isInteger(value) && value > 0 ? value : null;
}

/**
 * @returns The initial Channel; null, if requested initial Channel doesn't exist;
 * undefined, if no initial Channel was requested.
 */
function getInitialChannel(sendTo?: SendToJson) {
  const dataStore = core.dataStore;

  const urlParams = currentUrlParams();
  const sendToParam = getParamValue(urlParams, 'sendto');

  if (sendTo != null) {
    const target = dataStore.userStore.update(sendTo.target); // pre-populate userStore with target
    let channel = dataStore.channelStore.findPM(target.id);

    if (channel == null && !target.is(core.currentUser)) {
      channel = Channel.newPM(target, sendTo.channel_id);
      channel.canMessageError = sendTo.can_message_error; // TODO: move can_message to a user prop?
      dataStore.channelStore.channels.set(channel.channelId, channel);
    }

    return channel;
  } else if (sendToParam != null) {
    // history navigation to ?sendto, json was already loaded.
    return dataStore.channelStore.findPM(sendToParam);
  }

  const channelId = getParamValue(urlParams, 'channel_id');
  if (channelId != null) {
    return dataStore.channelStore.get(channelId) ?? null;
  }
}

core.reactTurbolinks.register('chat', action(() => {
  const initial = parseJsonNullable<ChatInitialJson>('json-chat-initial', true);

  if (initial != null) {
    if (Array.isArray(initial.presence)) {
      // initial population of channel/presence data
      core.dataStore.channelStore.updateMany(initial.presence);
      core.dataStore.chatState.skipRefresh = true;
      core.dataStore.chatState.canChatAnnounce = initial.current_user_attributes.can_chat_announce;
    }

    core.dataStore.channelStore.lastReceivedMessageId = initial.last_message_id ?? 0;
  }

  if (currentUrl().hash === '#create') {
    core.dataStore.chatState.selectChannel('create', 'replaceHistory');
  } else {
    const channel = getInitialChannel(initial?.send_to);

    if (channel === undefined) {
      core.dataStore.chatState.selectFirst();
    } else {
      core.dataStore.chatState.selectChannel(channel?.channelId ?? null, 'replaceHistory');
    }
  }

  return <MainView />;
}));
