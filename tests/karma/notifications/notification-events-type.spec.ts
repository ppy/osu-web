// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { dispatch, dispatcher } from 'app-dispatcher';
import { NotificationBundleJson } from 'interfaces/notification-json';
import {
  NotificationEventRead,
} from 'notifications/notification-events';
import { toJson } from 'notifications/notification-identity';
import NotificationStore from 'stores/notification-store';
import { makeNotificationJson, makeStackJson } from './helpers';

describe('Notification Event Read (NotificationType only)', () => {
  beforeEach(() => dispatcher.clear());
  afterEach(() => dispatcher.clear());

  describe('on NotificationEventRead', () => {
    const identities = [
      {
        category: 'beatmapset_discussion',
        id: 1000,
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
        category: 'channel',
        id: 1004,
        objectId: 3,
        objectType: 'channel',
      },
    ];

    const baseUnreadCount = 10;
    const bundleBase = {
      stacks: [
        makeStackJson(identities[0], 2, 'beatmapset_discussion_post_new', 900),
        makeStackJson(identities[1], 2, 'beatmapset_discussion_post_new', 900),
        makeStackJson(identities[2], 6, 'channel_message', 900),
      ],
      types: [
        { cursor: null, name: null, total: baseUnreadCount },
        { cursor: null, name: 'beatmapset', total: 4 },
        { cursor: null, name: 'channel', total: 6 },
      ],
    };

    const notificationsJson = identities.map(toJson).map(makeNotificationJson);

    const bundleWithNotification = { ...bundleBase } as NotificationBundleJson;
    bundleWithNotification.notifications = notificationsJson;
    bundleWithNotification.unread_count = baseUnreadCount;

    const bundleWithoutNotification = { ...bundleBase } as NotificationBundleJson;
    bundleWithoutNotification.unread_count = baseUnreadCount;

    let store!: NotificationStore;
    beforeEach(() => {
      store = new NotificationStore();
    });

    describe('when single notification type is marked as read', () => {
      beforeEach(() => {
        store.stacks.updateWithBundle(bundleWithNotification);
        store.unreadStacks.updateWithBundle(bundleWithNotification);

        const event = new NotificationEventRead([{ objectType: 'beatmapset' }], 4);
        dispatch(event);
      });

      it('decrements the unread count', () => {
        expect(store.unreadStacks.total).toBe(baseUnreadCount - 4);
      });

      it('does not change the total counts of the type', () => {
        expect(store.stacks.total).toBe(10);
        expect(store.stacks.types.get('beatmapset')?.total).toBe(4);
      });

      it('removes the type from unread', () => {
        expect(store.unreadStacks.types.get('beatmapset')).toBeUndefined();
      });
    });

    describe('when all notification type is marked as read', () => {
      beforeEach(() => {
        store.stacks.updateWithBundle(bundleWithNotification);
        store.unreadStacks.updateWithBundle(bundleWithNotification);

        const event = new NotificationEventRead([{ objectType: null }], 10);
        dispatch(event);
      });

      it('decrements the unread count', () => {
        expect(store.unreadStacks.total).toBe(0);
      });

      it('does not change the total counts', () => {
        expect(store.stacks.total).toBe(10);
      });

      it('leaves only all type in unreads', () => {
        const keys = [...store.unreadStacks.types.keys()];

        expect(keys.length).toBe(1);
        expect(keys[0]).toBeNull();
      });
    });
  });
});
