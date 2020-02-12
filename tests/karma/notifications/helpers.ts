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

import NotificationJson, { NotificationStackJson, NotificationTypeJson } from 'interfaces/notification-json';
import { NotificationIdentity } from 'notifications/notification-identity';

export function makeNotificationJson(overrides: object) {
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

export function makeStackJson(identity: NotificationIdentity, total: number, name: string, cursorId?: number) {
  return {
    category: identity.category,
    cursor: cursorId != null ? { id: cursorId } : null,
    name,
    object_id: identity.objectId,
    object_type: identity.objectType,
    total,
  } as NotificationStackJson;
}

export function makeTypeJson(total: number, name: string | null, cursorId?: number) {
  return {
    cursor: cursorId != null ? { id: cursorId } : null,
    name,
    total,
  } as NotificationTypeJson;
}
