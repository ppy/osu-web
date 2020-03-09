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

import GroupJSON from 'interfaces/group-json';
import * as React from 'react';

interface Props {
  badge?: GroupJSON;
  modifiers?: string[];
}

export default function UserGroupBadge({badge, modifiers}: Props) {
  if (badge == null) {
    return null;
  }

  const style = osu.groupColour(badge);

  return (
    <div
      className={osu.classWithModifiers('user-group-badge', modifiers)}
      data-label={badge.short_name}
      style={style}
      title={badge.name}
    />
  );
}
