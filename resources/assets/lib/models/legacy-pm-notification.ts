// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Notification from './notification';

export default class LegacyPmNotification extends Notification {
  details = {};
  isRead = false;
  name = 'legacy_pm';
  objectId = -1;

  get count() {
    return currentUser?.unread_pm_count ?? 0;
  }

  constructor() {
    super(-1, 'legacy_pm');
  }
}
