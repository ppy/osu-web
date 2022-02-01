// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

// FIXME: the type checks for details currently rely on Notification.name
export default interface NotificationDetails extends Record<string, any> {
  channel_id?: number;
  content?: string;
  coverUrl: string | null;
  embeds?: {
    praises: number;
    problems: number;
    suggestions: number;
  };
  title: string;
  titleUnicode?: string | null;
  type?: string;
  username?: string;
}

export function newEmptyNotificationDetails(): NotificationDetails {
  return {
    coverUrl: null,
    title: '',
  };
}
