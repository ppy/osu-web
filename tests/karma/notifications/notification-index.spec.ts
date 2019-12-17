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
import { NotificationBundleJson } from 'interfaces/notification-json';
import Notification from 'models/notification';
import { NotificationEventMoreLoaded, NotificationEventRead } from 'notifications/notification-events';
import { toJson } from 'notifications/notification-identity';
import NotificationStore from 'stores/notification-store';
import { makeNotificationJson, makeStackJson, makeTypeJson } from './helpers';
import NotificationType from 'models/notification-type';
import { NotificationResolver } from 'notifications/notification-resolver';

const identities = [
  { id: 1002, objectType: 'beatmapset', objectId: 2, category: 'beatmapset_discussion' },
  { id: 1001, objectType: 'beatmapset', objectId: 1, category: 'beatmapset_discussion' },
];

describe('Notification Index', () => {
  // @ts-ignore
  beforeEach(() => dispatcher.listeners.clear());
  // @ts-ignore
  afterEach(() => dispatcher.listeners.clear());

  const bundle = {
    notifications: [identities[0]].map(toJson).map(makeNotificationJson),
    stacks: [makeStackJson(identities[0], 5, 'beatmapset_discussion_post_new', identities[0].id - 100)],
    types: [
      { cursor: null, name: null,  total: 20 },
      { cursor: null, name: 'beatmapset', total: 5 },
    ],
  };

  const loadMoreBundle = {
    notifications: [identities[1]].map(toJson).map(makeNotificationJson),
    stacks: [makeStackJson(identities[1], 5, 'beatmapset_discussion_post_new', identities[1].id - 100)],
    types: [
      { cursor: null, name: null,  total: 20 },
      { cursor: null, name: 'beatmapset', total: 5 },
    ],
  };

  let store!: NotificationStore;
  beforeEach(() => {
    store = new NotificationStore();

    store.stacks.updateWithBundle(bundle);
  });

  describe('/ when starting on All', () => {
    it('should have 1 notification', () => {
      expect(store.notifications.size).toBe(1);
    });

    describe('/ after loading more', () => {
      beforeEach(() => {
        dispatch(new NotificationEventMoreLoaded(loadMoreBundle, { unreadOnly: false }));
      });

      it('should have 2 notifications', () => {
        expect(store.notifications.size).toBe(2);
      });

      describe('/ change filter to Beatmapsets', () => {
        it('should filter by Beatmapsets', () => {

        });

        it('should contain the extra notifications', () => {

        });
      });
    });
  });

  describe('/ when starting on Beatmapsets', () => {
    it('should have 1 notifications', () => {
      expect(store.notifications.size).toBe(1);
    });

    describe('/ after loading more', () => {
      beforeEach(() => {
        dispatch(new NotificationEventMoreLoaded(loadMoreBundle, { unreadOnly: false }));
      });

      it('should have 2 notifications', () => {
        expect(store.notifications.size).toBe(2);
      });

      describe('/ change filter to All', () => {
        it('should filter by All', () => {

        });

        it('should reset the loaded notifications', () => {

        });
      });
    });
  });
});
