// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Notification from 'models/notification';

export function displayType(item: Notification) {
  if (item.name === 'legacy_pm') {
    return 'legacy_pm';
  }

  if (item.objectType == null || item.objectId == null) {
    return;
  }

  if (item.name === 'user_achievement_unlock') {
    return 'user_achievement';
  }

  if (item.name === 'user_beatmapset_new') {
    return 'user_modding';
  }

  return item.objectType;
}
