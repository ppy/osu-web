// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
