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

import { dispatch, dispatcher } from 'app-dispatcher';
import NotificationJson, { NotificationBundleJson } from 'interfaces/notification-json';
import Notification from 'models/notification';
import { NotificationEventMoreLoaded, NotificationEventRead } from 'notifications/notification-events';
import { NotificationIdentity, toJson } from 'notifications/notification-identity';
import NotificationStore from 'stores/notification-store';

function makeNotificationJson(overrides: object) {
  const base = {
    category: 'beatmapset_discussion',
    created_at: '2019-12-02T08:13:19+00:00',
    details: {},
    id: 1,
    is_read: false,
    name: 'beatmapset_discussion_post_new',
    object_id: 1,
    object_type: 'beatmapset',
    source_user_id: 475002,
  };

  return Object.assign({}, base, overrides) as NotificationJson;
}

function makeStackJson(identity: NotificationIdentity, total: number, name: string, cursorId?: number) {
  return {
    category: identity.category,
    cursor: cursorId != null ? { id: cursorId } : null,
    name,
    object_id: identity.objectId,
    object_type: identity.objectType,
    total,
  };
}

const baseUnreadCount = 10;
const stackIdentity  = { objectType: 'beatmapset', objectId: 1, category: 'beatmapset_discussion' };
const identities = [
  { id: 1000, ...stackIdentity },
  { id: 1002, ...stackIdentity },
];

describe('Notification Events', () => {
  // @ts-ignore
  beforeEach(() => dispatcher.listeners.clear());
  // @ts-ignore
  afterEach(() => dispatcher.listeners.clear());

  describe('on NotificationEventRead', () => {
    describe('/ when single notification read', () => {
      const identity = identities[0];
      const notificationJson = makeNotificationJson(toJson(identity));

      const bundleBase = {
        stacks: [makeStackJson(identity, 5, 'beatmapset_discussion_post_new', identity.id - 100)],
        types: [
          { cursor: null, name: null,  total: 5 },
          { cursor: null, name: 'beatmapset', total: 5 },
        ],
      };

      const bundleWithNotification = { ...bundleBase } as NotificationBundleJson;
      bundleWithNotification.notifications = [notificationJson];
      bundleWithNotification.unread_count = baseUnreadCount;

      const bundleWithoutNotification = { ...bundleBase } as NotificationBundleJson;
      bundleWithoutNotification.unread_count = baseUnreadCount;

      let store!: NotificationStore;
      beforeEach(() => {
        store = new NotificationStore();
        store.stacks.updateWithBundle(bundleWithNotification);
      });

      it('expects stack to be created', () => {
        expect(store.stacks.getStack(identity)).toBeDefined();
      });

      describe('/ when unread notification has been loaded', () => {
        beforeEach(() => {
          store.unreadStacks.updateWithBundle(bundleWithNotification);

          const event = new NotificationEventRead([identity], 1);
          dispatch(event);
        });

        it('marks the notification as read', () => {
          const notification = store.get(identity.id) as Notification;
          expect(notification.isRead).toBe(true);
        });

        it('decrements the unread count', () => {
          expect(store.unreadStacks.total).toBe(baseUnreadCount - 1);
          expect(store.unreadStacks.getStack(identity)?.total).toBe(4);
          expect(store.stacks.getStack(identity)?.total).toBe(5);
        });

        it('does not decrement the unread count on duplicate notification', () => {
          const event = new NotificationEventRead([identity], 1);
          dispatch(event);

          expect(store.unreadStacks.total).toBe(baseUnreadCount - 1);
          expect(store.unreadStacks.getStack(identity)?.total).toBe(4);
          expect(store.stacks.getStack(identity)?.total).toBe(5);
        });

        it('removes the notification from the stack', () => {
          expect(store.unreadStacks.getStack(identity)?.notifications.get(identity.id)).toBeUndefined();
        });
      });

      describe('/ when unread notification has not been loaded yet', () => {
        // id needs to be less than cursor too.
        const unreadIdentity = { id: 500, ...stackIdentity };
        const unreadEventData = [unreadIdentity];

        beforeEach(() => {
          store.unreadStacks.updateWithBundle(bundleWithoutNotification);

          const event = new NotificationEventRead(unreadEventData, unreadEventData.length);
          dispatch(event);
        });

        it('decrements the unread count', () => {
          expect(store.unreadStacks.total).toBe(baseUnreadCount - 1);
          expect(store.unreadStacks.getStack(unreadIdentity)?.total).toBe(4);
          expect(store.stacks.getStack(unreadIdentity)?.total).toBe(5);
        });

        it('does not have an existing notification', () => {
          const stack = store.unreadStacks.getStack(unreadIdentity);
          expect(stack).toBeDefined();
          expect(stack?.notifications.get(unreadIdentity.id)).toBeUndefined();
        });
      });
    });

    describe('/ when multiple notifications read', () => {
      const bundleBase = {
        stacks: [makeStackJson(identities[0], 5, 'beatmapset_discussion_post_new', identities[0].id - 100)],
        types: [
          { cursor: null, name: null,  total: 5 },
          { cursor: null, name: 'beatmapset', total: 5 },
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
        store.stacks.updateWithBundle(bundleWithNotification);
      });

      describe('/ when unread notifications have been loaded', () => {
        beforeEach(() => {
          store.unreadStacks.updateWithBundle(bundleWithNotification);

          const event = new NotificationEventRead(identities, identities.length);
          dispatch(event);
        });

        it('marks the notifications as read', () => {
          for (const identity of identities) {
            const notification = store.get(identity.id) as Notification;
            expect(notification.isRead).toBe(true);
          }
        });

        it('decrements the unread count', () => {
          const identity = identities[0];
          expect(store.unreadStacks.total).toBe(baseUnreadCount - 2);
          expect(store.unreadStacks.getStack(identity)?.total).toBe(3);
          expect(store.stacks.getStack(identity)?.total).toBe(5);
        });

        it('does not decrement the unread count on duplicate notification', () => {
          const event = new NotificationEventRead(identities, identities.length);
          dispatch(event);

          const identity = identities[0];
          expect(store.unreadStacks.total).toBe(baseUnreadCount - 2);
          expect(store.unreadStacks.getStack(identity)?.total).toBe(3);
          expect(store.stacks.getStack(identity)?.total).toBe(5);
        });

        it('removes the notifications from the stack', () => {
          for (const identity of identities) {
            expect(store.unreadStacks.getStack(identity)?.notifications.get(identity.id)).toBeUndefined();
          }
        });
      });

      describe('/ when some unread notifications have not been loaded yet', () => {
        // id needs to be less than cursor too.
        const unreadIdentity = { id: 500, objectType: 'beatmapset', objectId: 1, category: 'beatmapset_discussion' };
        const identity = identities[0];
        const unreadEventData = [identity, unreadIdentity];

        beforeEach(() => {
          store.unreadStacks.updateWithBundle(bundleWithNotification);

          const event = new NotificationEventRead(unreadEventData, unreadEventData.length);
          dispatch(event);
        });

        it('decrements the unread count', () => {
          expect(store.unreadStacks.total).toBe(baseUnreadCount - 2);
          expect(store.unreadStacks.getStack(unreadIdentity)?.total).toBe(3);
          expect(store.stacks.getStack(unreadIdentity)?.total).toBe(5);
        });

        it('does not have an existing notification', () => {
          const stack = store.unreadStacks.getStack(unreadIdentity);
          expect(stack).toBeDefined();
          expect(stack?.notifications.get(unreadIdentity.id)).toBeUndefined();
          expect(stack?.notifications.get(identity.id)).toBeUndefined();
        });
      });
    });

    describe('/ when notification stack read', () => {
      const stackSize = identities.length;
      const typeSize = 5;

      const bundleBase = {
        stacks: [makeStackJson(stackIdentity, stackSize, 'beatmapset_discussion_post_new', identities[0].id - 100)],
        types: [
          { cursor: null, name: null,  total: typeSize },
          { cursor: null, name: 'beatmapset', total: typeSize },
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

      describe('/ when stack has all notifications loaded', () => {
        beforeEach(() => {
          store.stacks.updateWithBundle(bundleWithNotification);
          store.unreadStacks.updateWithBundle(bundleWithNotification);

          const event = new NotificationEventRead([stackIdentity], stackSize);
          dispatch(event);
        });

        it('marks all the notifications in the stack as read', () => {
          const stack = store.stacks.getStack(stackIdentity);
          // this is just to remove undefined from the typing
          expect(stack).toBeDefined();
          if (stack != null) {
            expect([...stack.notifications.values()].every((notification) => notification.isRead)).toBe(true);
          }
        });

        it('decrements the unread count', () => {
          expect(store.unreadStacks.total).toBe(baseUnreadCount - stackSize);
        });

        it('does not change the total counts', () => {
          expect(store.stacks.getStack(stackIdentity)?.total).toBe(stackSize);
        });

        it('removes the unread stack', () => {
          expect(store.unreadStacks.getStack(stackIdentity)).toBeUndefined();
        });
      });

      describe('/ when stack has some notifications loaded', () => {
        beforeEach(() => {
          store.stacks.updateWithBundle(bundleWithNotification);

          const bundle = { ...bundleBase } as NotificationBundleJson;
          bundle.notifications = notificationsJson.slice(1);
          bundle.unread_count = baseUnreadCount;
          store.unreadStacks.updateWithBundle(bundle);

          const event = new NotificationEventRead([stackIdentity], 0);
          dispatch(event);
        });

        it('marks all the notifications in the stack as read', () => {
          const stack = store.stacks.getStack(stackIdentity);
          // this is just to remove undefined from the typing
          expect(stack).toBeDefined();
          if (stack != null) {
            expect([...stack.notifications.values()].every((notification) => notification.isRead)).toBe(true);
          }
        });

        it('ignroes the event readCount and decrements the unread count', () => {
          expect(store.unreadStacks.total).toBe(baseUnreadCount - stackSize);
        });

        it('does not change the total counts', () => {
          expect(store.stacks.getStack(stackIdentity)?.total).toBe(stackSize);
        });

        it('removes the unread stack', () => {
          expect(store.unreadStacks.getStack(stackIdentity)).toBeUndefined();
        });
      });

      describe('/ when stack has not been loaded yet', () => {
        beforeEach(() => {
          store.stacks.updateWithBundle(bundleWithNotification);

          const bundle = { ...bundleBase } as NotificationBundleJson;
          bundle.unread_count = baseUnreadCount;
          store.unreadStacks.updateWithBundle(bundle);

          const event = new NotificationEventRead([stackIdentity], stackSize);
          dispatch(event);
        });

        it('marks all the notifications in the stack as read', () => {
          const stack = store.stacks.getStack(stackIdentity);
          // this is just to remove undefined from the typing
          expect(stack).toBeDefined();
          if (stack != null) {
            expect([...stack.notifications.values()].every((notification) => notification.isRead)).toBe(true);
          }
        });

        it('decrements the unread count', () => {
          expect(store.unreadStacks.total).toBe(baseUnreadCount - stackSize);
        });

        it('does not change the total counts', () => {
          expect(store.stacks.getStack(stackIdentity)?.total).toBe(stackSize);
        });

        it('removes the unread stack', () => {
          expect(store.unreadStacks.getStack(stackIdentity)).toBeUndefined();
        });
      });
    });
  });

  describe('on NotificationEventMoreLoaded', () => {
    const bundleBase = {
      stacks: [makeStackJson(identities[0], 5, 'beatmapset_discussion_post_new', identities[0].id - 100)],
      types: [
        { cursor: null, name: null,  total: 5 },
        { cursor: null, name: 'beatmapset', total: 5 },
      ],
    };

    const notificationsJson = identities.map(toJson).map(makeNotificationJson);

    const bundle = { ...bundleBase } as NotificationBundleJson;
    bundle.notifications = notificationsJson;
    bundle.unread_count = baseUnreadCount;

    let store!: NotificationStore;
    beforeEach(() => {
      store = new NotificationStore();
    });

    it('only contains legacy pm', () => {
      expect(store.unreadStacks.stacks.size).toBe(1);
      expect(store.unreadStacks.types.size).toBe(1);
      expect(store.stacks.stacks.size).toBe(1);
      expect(store.stacks.types.size).toBe(1);

      expect(store.unreadStacks.stacks.values().next().value.category).toBe('legacy_pm');
      expect(store.unreadStacks.types.values().next().value.name).toBe('legacy_pm');
      expect(store.stacks.stacks.values().next().value.category).toBe('legacy_pm');
      expect(store.stacks.types.values().next().value.name).toBe('legacy_pm');
    });

    describe('/ all notifications', () => {
      beforeEach(() => {
        dispatch(new NotificationEventMoreLoaded(bundle, { unreadOnly: false } ));
      });

      it ('does not update the unread count', () => {
        // does not update because the response doesn't have it
        expect(store.unreadStacks.total).toBe(0);
      });

      it('store.stacks is not empty', () => {
        expect(store.stacks.stacks.size).toBe(2);
        expect(store.stacks.types.size).toBe(3);
        expect(store.stacks.getType({ objectType: null })).toBeDefined();
        expect(store.stacks.getType({ objectType: 'beatmapset' })).toBeDefined();
      });

      it('store.unreadStacks only contains legacy pm', () => {
        expect(store.unreadStacks.stacks.size).toBe(1);
        expect(store.unreadStacks.types.size).toBe(1);
        expect(store.unreadStacks.getType({ objectType: 'legacy_pm' })).toBeDefined();
      });

      it('notifications added to store.notifications', () => {
        identities.forEach((identity) => {
          expect(store.notifications.get(identity.id)).toEqual(jasmine.any(Notification));
        });
      });
    });

    describe('/ only unread notifications', () => {
      beforeEach(() => {
        dispatch(new NotificationEventMoreLoaded(bundle, { unreadOnly: true } ));
      });

      it('updates the unread count', () => {
        expect(store.unreadStacks.total).toBe(baseUnreadCount);
      });

      it('store.stacks only contains legacy pm', () => {
        expect(store.stacks.stacks.size).toBe(1);

        expect(store.stacks.types.size).toBe(1);
        expect(store.stacks.getType({ objectType: 'legacy_pm' })).toBeDefined();
      });

      it('store.unreadStacks is not empty', () => {
        expect(store.unreadStacks.stacks.size).toBe(2);
        expect(store.unreadStacks.types.size).toBe(3);
        expect(store.unreadStacks.getType({ objectType: null })).toBeDefined();
        expect(store.unreadStacks.getType({ objectType: 'beatmapset' })).toBeDefined();
        expect(store.unreadStacks.getType({ objectType: 'legacy_pm' })).toBeDefined();
      });

      it('notifications added to store.notifications', () => {
        identities.forEach((identity) => {
          expect(store.notifications.get(identity.id)).toEqual(jasmine.any(Notification));
        });
      });
    });
  });
});
