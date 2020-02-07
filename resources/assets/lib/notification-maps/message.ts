/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

import Notification from 'models/notification';

export function formatMessage(item: Notification, compact: boolean = false) {
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

  return osu.trans(key, replacements);
}
