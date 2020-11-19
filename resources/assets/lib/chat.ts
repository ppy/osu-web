// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { PresenceJson, SendToJson } from 'chat/chat-api-responses';
import MainView from 'chat/main-view';
import { isEmpty } from 'lodash';
import Channel from 'models/chat/channel';
import core from 'osu-core-singleton';

const dataStore = core.dataStore;
const presence = osu.parseJson<PresenceJson>('json-presence');

if (!isEmpty(presence)) {
  // initial population of channel/presence data
  dataStore.channelStore.updateWithPresence(presence);
}

reactTurbolinks.register('chat', MainView, () => {
  let initialChannel: number | undefined;
  const sendTo: SendToJson = osu.parseJson('json-sendto');

  if (!isEmpty(sendTo)) {
    const target = dataStore.userStore.getOrCreate(sendTo.target.id, sendTo.target); // pre-populate userStore with target
    let channel = dataStore.channelStore.findPM(target.id);

    if (channel != null) {
      initialChannel = channel.channelId;
    } else if (!target.is(core.currentUser)) {
      channel = Channel.newPM(target);
      channel.moderated = !sendTo.can_message; // TODO: move can_message to a user prop?
      dataStore.channelStore.channels.set(channel.channelId, channel);
      dataStore.channelStore.loaded = true;
      initialChannel = channel.channelId;
    }
  } else if (dataStore.channelStore.loaded) {
    const hasNonPmChannels = dataStore.channelStore.nonPmChannels.length > 0;
    const hasPmChannels = dataStore.channelStore.pmChannels.length > 0;

    if (hasNonPmChannels) {
      initialChannel = dataStore.channelStore.nonPmChannels[0].channelId;
    } else if (hasPmChannels) {
      initialChannel = dataStore.channelStore.pmChannels[0].channelId;
    }
  }

  if (initialChannel != null) {
    dataStore.chatState.selectChannel(initialChannel);
  }

  return {
    dataStore: core.dataStore,
    worker: core.chatWorker,
  };
});
