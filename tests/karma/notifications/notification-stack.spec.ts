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

import { dispatcher } from 'app-dispatcher';
import { NotificationBundleJson } from 'interfaces/notification-json';
import { resolveStackId, toJson } from 'notifications/notification-identity';
import NotificationStore from 'stores/notification-store';
import { makeNotificationJson, makeStackJson } from './helpers';

const identities = [
  { id: 1003, objectType: 'beatmapset', objectId: 1, category: 'beatmapset_discussion' },
  { id: 1002, objectType: 'beatmapset', objectId: 2, category: 'beatmapset_discussion' },
  { id: 1001, objectType: 'beatmapset', objectId: 1, category: 'beatmapset_discussion' },
];

describe('Widget Notification Stack', () => {
  // @ts-ignore
  beforeEach(() => dispatcher.listeners.clear());
  // @ts-ignore
  afterEach(() => dispatcher.listeners.clear());

  const bundle: NotificationBundleJson = {
    notifications: identities.map(toJson).map(makeNotificationJson),
    stacks: [
      makeStackJson(identities[0], 2, 'beatmapset_discussion_post_new'),
      makeStackJson(identities[1], 1, 'beatmapset_discussion_post_new'),
    ],
    types: [
      { cursor: null, name: null,  total: identities.length },
      { cursor: null, name: 'beatmapset', total: identities.length },
    ],
  };

  const identityToRemove = identities[0];
  const expectedStackOrder = [resolveStackId(identities[0]), resolveStackId(identities[1])];

  let store!: NotificationStore;
  beforeEach(() => {
    store = new NotificationStore();
    store.unreadStacks.updateWithBundle(bundle);
  });

  it('stacks should be ordered by latest notification', () => {
    const ids = store.unreadStacks.orderedStacksOfType('beatmapset').map((stack) => stack.id);

    expect(ids).toEqual(expectedStackOrder);
  });

  describe('when latest notification is removed', () => {
    beforeEach(() => {
      const stack = store.unreadStacks.getStack(identityToRemove);
      if (stack != null) {
        stack.remove(stack.first);
      } else {
        fail('expected stack is missing');
      }
    });

    it('should remove the notification', () => {
      expect(store.unreadStacks.getStack(identityToRemove)?.notifications.size).toBe(1);
    });

    it('order should not change', () => {
      const ids = store.unreadStacks.orderedStacksOfType('beatmapset').map((stack) => stack.id);

      expect(ids).toEqual(expectedStackOrder);
    });
  });
});
