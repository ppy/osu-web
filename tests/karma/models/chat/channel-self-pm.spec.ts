// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ChannelJson from 'interfaces/chat/channel-json';
import Channel from 'models/chat/channel';
import ChannelStore from 'stores/channel-store';
import testCurrentUserJson from '../../test-current-user-json';

// current user id in the test fixture
const currentUserId = testCurrentUserJson.id;

function pmJson(channelId: number, userIds: number[]): ChannelJson {
  return {
    channel_id: channelId,
    message_length_limit: 1024,
    name: 'pm',
    type: 'PM',
    users: userIds,
  };
}

describe('Channel self-PM handling', () => {
  beforeEach(() => {
    // set the singleton current user (id = currentUserId)
    $.publish('user:update', testCurrentUserJson);
  });

  afterEach(() => {
    // unset the singleton current user
    $.publish('user:update', { id: undefined });
  });

  describe('Channel#pmTarget', () => {
    it('returns the other user for a normal PM', () => {
      const channel = new Channel(1);
      channel.updateWithJson(pmJson(1, [currentUserId, 2]));

      expect(channel.pmTarget).toBe(2);
    });

    it('returns the current user for a self-PM', () => {
      const channel = new Channel(2);
      channel.updateWithJson(pmJson(2, [currentUserId, currentUserId]));

      expect(channel.pmTarget).toBe(currentUserId);
    });
  });

  describe('ChannelStore#findPM', () => {
    it('finds a self-PM by the current user id', () => {
      const store = new ChannelStore();
      const selfPm = store.update(pmJson(2, [currentUserId, currentUserId]));
      store.update(pmJson(3, [currentUserId, 2]));

      expect(store.findPM(currentUserId)).toBe(selfPm);
    });

    it('finds a normal PM by the other user id', () => {
      const store = new ChannelStore();
      store.update(pmJson(2, [currentUserId, currentUserId]));
      const normalPm = store.update(pmJson(3, [currentUserId, 2]));

      expect(store.findPM(2)).toBe(normalPm);
    });

    it('returns null when no PM matches', () => {
      const store = new ChannelStore();
      store.update(pmJson(3, [currentUserId, 2]));

      expect(store.findPM(999)).toBeNull();
    });
  });
});
