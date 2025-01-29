// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Notification from 'models/notification';
import { isBeatmapOwnerChangeNotification } from 'models/notification/beatmap-owner-change-notification';
import NotificationDetails from 'models/notification-details';
import { trans, transArray, transChoice, transExists } from 'utils/lang';

type Replacements = { title: string } & Partial<Record<string, string|number>>;

function formatBeatmapsetReviewCounts(counts: NonNullable<NotificationDetails['embeds']>, replacements: Replacements) {
  const translatedCounts = [];
  for (const type of ['praises', 'problems', 'suggestions'] as const) {
    const count = counts[type];
    if (count > 0) {
      translatedCounts.push(transChoice(
        `notifications.item.beatmapset.beatmapset_discussion.review_count.${type}`,
        count,
      ));
    }
    // TODO: remove after all translations are updated to use the :review_counts
    replacements[type] = count;
  }
  if (translatedCounts.length === 0) {
    translatedCounts.push(transChoice(
      'notifications.item.beatmapset.beatmapset_discussion.review_count.problems',
      0,
    ));
  }
  replacements.review_counts = transArray(translatedCounts);
}

export function formatMessage(item: Notification, compact = false) {
  const replacements: Replacements = {
    content: item.details.content,
    title: item.title,
    username: item.details.username,
  };

  if (isBeatmapOwnerChangeNotification(item)) {
    replacements.beatmap = item.details.version;
  }

  if (item.name === 'beatmapset_discussion_review_new' && item.details.embeds != null) {
    formatBeatmapsetReviewCounts(item.details.embeds, replacements);
  }

  let key = `notifications.item.${item.displayType}.${item.category}`;
  if (item.objectType === 'channel') {
    key += `.${item.details.type}`;
  }

  key += `.${item.name}`;

  if (compact) {
    key += '_compact';
  }

  const emptyKey = `${key}_empty`;
  if (item.details.content == null && transExists(emptyKey, window.fallbackLocale)) {
    key = emptyKey;
  }

  return trans(key, replacements);
}

export function formatMessageGroup(item: Notification) {
  if (item.objectType === 'channel') {
    const replacements = {
      title: item.title,
      username: item.details.username,
    };

    const key = `notifications.item.${item.objectType}.${item.category}.${item.details.type}.${item.name}_group`;

    return trans(key, replacements);
  }

  if (item.name === 'user_achievement_unlock') {
    const replacements = {
      username: item.details.username,
    };

    return trans(`notifications.item.${item.displayType}.${item.category}.${item.name}_group`, replacements);
  }

  if (item.category === 'user_beatmapset_new') {
    const replacements = {
      username: item.details.username,
    };

    return trans(`notifications.item.${item.displayType}.${item.category}.${item.category}_group`, replacements);
  }

  return item.title;
}
