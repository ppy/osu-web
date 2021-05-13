// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Notification from 'models/notification';

interface NotificationDetails {
  beatmapId: number;
  coverUrl: string;
  title: string;
  titleUnicode?: string | null;
  version: string;
}

const newEmptyNotificationDetails = () => ({
  beatmapId: 0,
  coverUrl: '',
  title: '',
  version: '',
});

export function isBeatmapOwnerChangeNotification(notification: Notification): notification is BeatmapOwnerChangeNotification {
  return notification.name === 'beatmap_owner_change';
}

export default class BeatmapOwnerChangeNotification extends Notification {
  details: NotificationDetails = newEmptyNotificationDetails();
  name = 'beatmap_owner_change';
}
