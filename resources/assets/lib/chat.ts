/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */
import { PresenceJSON, SendToJSON } from 'chat/chat-api-responses';
import MainView from 'chat/main-view';
import * as _ from 'lodash';
import Channel from 'models/chat/channel';
import User from 'models/user';
import OsuCore from 'osu-core';

declare global {
  interface Window {
    OsuCore: OsuCore;
  }
}

const core = window.OsuCore = window.OsuCore || new OsuCore(window);
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
    const target: User = dataStore.userStore.getOrCreate(sendTo.target.id, sendTo.target); // pre-populate userStore with target
    let channel: Channel | null = dataStore.channelStore.findPM(target.id);

    if (channel) {
      initialChannel = channel.channelId;
    } else {
      channel = Channel.newPM(target);
      channel.moderated = !sendTo.can_message; // TODO: move can_message to a user prop?
      dataStore.channelStore.channels.set(channel.channelId, channel);
      dataStore.channelStore.loaded = true;
      initialChannel = channel.channelId;
    }
  } else {
    if (dataStore.channelStore.loaded) {
      const hasNonPmChannels = dataStore.channelStore.nonPmChannels.length > 0;
      const hasPmChannels = dataStore.channelStore.pmChannels.length > 0;

      if (hasNonPmChannels) {
        initialChannel = dataStore.channelStore.nonPmChannels[0].channelId;
      } else if (hasPmChannels) {
        initialChannel = dataStore.channelStore.pmChannels[0].channelId;
      }
    }
  }

  return {
    dataStore: core.dataStore,
    dispatcher: core.dispatcher,
    initialChannel,
    worker: core.chatWorker,
  };
});
