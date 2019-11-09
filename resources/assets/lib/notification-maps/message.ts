/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

import LegacyPmNotification from 'models/legacy-pm-notification';
import Notification from 'models/notification';

export function formatMessage(item: Notification, compact: boolean = false) {
  let message: string;

  const replacements = {
    content: item.details.content,
    title: item.details.title,
    username: item.details.username,
  };

  let key = `notifications.item.${item.displayType}.${item.category}`;
  if (item.objectType === 'channel') {
    key += `.${item.details.type}`;
  }

  key += `.${item.name}`;

  if (compact) {
    key += '_compact';
  }

  const emptyKey = `${key}_empty`;
  if (item.details.content == null && osu.transExists(emptyKey)) {
    key = emptyKey;
  }

  if (item instanceof LegacyPmNotification) {
    message = osu.transChoice(key, item.details.count, replacements);
  } else {
    message = osu.trans(key, replacements);
  }

  return message;
}

export function messageGroup(item: Notification) {
  if (item.objectType === 'channel') {
    const replacements = {
      title: item.details.title,
      username: item.details.username,
    };

    const key = `notifications.item.${item.objectType}.${item.category}.${item.details.type}.${item.name}_group`;

    return osu.trans(key, replacements);
  }

  return item.details.title;
}
