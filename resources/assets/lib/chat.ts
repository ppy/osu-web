// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.
import { PresenceJSON, SendToJSON } from 'chat/chat-api-responses';
import MainView from 'chat/main-view';
import * as _ from 'lodash';
import Channel from 'models/chat/channel';
import core from 'osu-core-singleton';

const dataStore = core.dataStore;
const presence: PresenceJSON = osu.parseJson('json-presence');

if (!_.isEmpty(presence)) {
  // initial population of channel/presence data
  dataStore.channelStore.updatePresence(presence);
}

reactTurbolinks.register('chat', MainView, () => {
  let initialChannel: number | undefined;
  const sendTo: SendToJSON = osu.parseJson('json-sendto');

  if (!_.isEmpty(sendTo)) {
    const target = dataStore.userStore.getOrCreate(sendTo.target.id, sendTo.target); // pre-populate userStore with target
    let channel = dataStore.channelStore.findPM(target.id);

    if (channel) {
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

  return {
    dataStore: core.dataStore,
    initialChannel,
    worker: core.chatWorker,
  };
});
