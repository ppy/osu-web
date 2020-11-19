// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { Name } from 'models/notification-type';
import { NotificationCursor } from 'notifications/notification-cursor';
import { NotificationIdentityJson } from 'notifications/notification-identity';

export default interface NotificationJson {
  created_at?: string;
  details: any;
  id: number;
  is_read: boolean;
  name: string;
  object_id: number;
  object_type: Name;
  source_user_id?: number;
}

export interface NotificationBundleJson {
  notifications?: NotificationJson[];
  stacks?: NotificationStackJson[];
  timestamp: string;
  types?: NotificationTypeJson[];
  unread_count?: number;
}

export interface NotificationStackJson extends NotificationIdentityJson {
  category: string;
  cursor: NotificationCursor | null;
  name: string;
  object_id: number;
  object_type: Name;
  total: number;
}

export interface NotificationTypeJson {
  cursor: NotificationCursor | null;
  name: string | null;
  total: number;
}
