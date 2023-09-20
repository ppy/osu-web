// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
  }

  return 'type';
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

export function toString(identity: NotificationIdentity) {
  return `${identity.objectType}-${identity.objectId}-${identity.category}-${identity.id}`;
}
