// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as _ from 'lodash';
import Notification from 'models/notification';
import { isBeatmapOwnerChangeNotification } from 'models/notification/beatmap-owner-change-notification';
import * as osu from 'osu-common';

type Replacements = { title: string } & Partial<Record<string, string>>;

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
    _.merge(replacements, {
      praises: item.details.embeds.praises,
      problems: item.details.embeds.problems,
      suggestions: item.details.embeds.suggestions,
    });
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
  if (item.details.content == null && osu.transExists(emptyKey)) {
    key = emptyKey;
  }

  return osu.trans(key, replacements);
}

export function formatMessageGroup(item: Notification) {
  if (item.objectType === 'channel') {
    const replacements = {
      title: item.title,
      username: item.details.username,
    };

    const key = `notifications.item.${item.objectType}.${item.category}.${item.details.type}.${item.name}_group`;

    return osu.trans(key, replacements);
  }

  if (item.name === 'user_achievement_unlock' || item.name === 'user_beatmapset_new') {
    const replacements = {
      username: item.details.username,
    };

    return osu.trans(`notifications.item.${item.displayType}.${item.category}.${item.name}_group`, replacements);
  }

  return item.title;
}
