// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { dispatcher } from 'app-dispatcher';
import { NotificationBundleJson } from 'interfaces/notification-json';
import { resolveStackId, toJson } from 'notifications/notification-identity';
import NotificationStore from 'stores/notification-store';
import { makeNotificationJson, makeStackJson } from './helpers';

const identities = [
  {
    category: 'beatmapset_discussion',
    id: 1003,
    objectId: 1,
    objectType: 'beatmapset',
  },
  {
    category: 'beatmapset_discussion',
    id: 1002,
    objectId: 2,
    objectType: 'beatmapset',
  },
  {
    category: 'beatmapset_discussion',
    id: 1001,
    objectId: 1,
    objectType: 'beatmapset',
  },
];

describe('Widget Notification Stack', () => {
  beforeEach(() => dispatcher.clear());
  afterEach(() => dispatcher.clear());

  const bundle: NotificationBundleJson = {
    notifications: identities.map(toJson).map(makeNotificationJson),
    stacks: [
      makeStackJson(identities[0], 2, 'beatmapset_discussion_post_new'),
      makeStackJson(identities[1], 1, 'beatmapset_discussion_post_new'),
    ],
    timestamp: new Date().toJSON(),
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
