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

export type NotificationIdentityType = 'notification' | 'type' | 'stack';

export interface NotificationIdentity {
  category?: string;
  id?: number;
  objectId?: number;
  objectType: string | null;
}

export interface NotificationIdentityJson {
  category?: string;
  id?: number;
  object_id?: number;
  object_type: string | null;
}

export function resolveStackId(identity: NotificationIdentity) {
  return `${identity.objectType}-${identity.objectId}-${identity.category}`;
}

export function resolveIdentityType(identity: NotificationIdentity): NotificationIdentityType | undefined {
  if (identity.objectId != null) {
    if (identity.category != null) {
      if (identity.id != null) {
        return 'notification';
      }
      return 'stack';
    }
    return 'type';
  }
}

export function fromJson(json: NotificationIdentityJson): NotificationIdentity {
  return {
    category: json.category,
    id: json.id,
    objectId: json.object_id,
    objectType: json.object_type,
  };
}

export function toJson(identity: NotificationIdentity) {
  // TODO: object from iterating only interface keys and snake casing them would be nice.
  return {
    category: identity.category,
    id: identity.id,
    object_id: identity.objectId,
    object_type: identity.objectType,
  };
}
