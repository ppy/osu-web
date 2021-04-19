// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ChatInitialJson } from 'chat/chat-api-responses';
import MainView from 'chat/main-view';
import Channel from 'models/chat/channel';
import core from 'osu-core-singleton';

reactTurbolinks.register('chat', MainView, () => {
  const dataStore = core.dataStore;
  const initial = osu.parseJson<ChatInitialJson | null>('json-chat-initial', true);

  if (initial != null) {
    if (Array.isArray(initial.presence)) {
      // initial population of channel/presence data
      dataStore.channelStore.updateWithPresence(initial.presence);
    }

    dataStore.channelStore.lastPolledMessageId = initial.last_message_id ?? 0;
  }

  let initialChannel = 0;
  const sendTo = initial?.send_to;

  if ((sendTo != null)) {
    const target = dataStore.userStore.getOrCreate(sendTo.target.id, sendTo.target); // pre-populate userStore with target
    let channel = dataStore.channelStore.findPM(target.id);

    if (channel != null) {
      initialChannel = channel.channelId;
    } else if (!target.is(core.currentUser)) {
      channel = Channel.newPM(target, sendTo.channel_id);
      channel.moderated = !sendTo.can_message; // TODO: move can_message to a user prop?
      dataStore.channelStore.channels.set(channel.channelId, channel);
      dataStore.channelStore.loaded = true;
      initialChannel = channel.channelId;
    }
  } else {
    const channelId = parseInt(new URL(location.href).searchParams.get('channel_id') ?? '', 10);
    initialChannel = Number.isFinite(channelId) ? channelId : dataStore.chatState.selected;

    if (initialChannel === 0 && dataStore.channelStore.loaded) {
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

  return {
    dataStore: core.dataStore,
    worker: core.chatWorker,
  };
});
