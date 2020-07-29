// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

export default interface NotificationDetails extends Record<string, any> {
  coverUrl: string | null;
  title: string;
  titleUnicode?: string | null;
}

export function newEmptyNotificationDetails(): NotificationDetails {
  return {
    coverUrl: null,
    title: '',
  };
}
