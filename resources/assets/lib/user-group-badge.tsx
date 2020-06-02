// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GroupJSON from 'interfaces/group-json';
import * as React from 'react';

interface Props {
  group?: GroupJSON;
  modifiers?: string[];
}

export default function UserGroupBadge({group, modifiers}: Props) {
  if (group == null) {
    return null;
  }

  const style = osu.groupColour(group);

  return (
    <div
      className={osu.classWithModifiers('user-group-badge', modifiers)}
      data-label={group.short_name}
      style={style}
      title={group.name}
    />
  );
}
