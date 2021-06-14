// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserGroupJson from 'interfaces/user-group-json';
import { route } from 'laroute';
import * as React from 'react';
import { classWithModifiers, Modifiers } from 'utils/css';

interface Props {
  group?: UserGroupJson;
  modifiers?: Modifiers;
}

export default function UserGroupBadge({group, modifiers}: Props) {
  if (group == null) {
    return null;
  }

  let title = group.name;

  if (group.playmodes != null && group.playmodes.length > 0) {
    const playmodeNames = group.playmodes
      .map((playmode) => osu.trans(`beatmaps.mode.${playmode}`))
      .join(', ');

    title += ` (${playmodeNames})`;
  }

  const props = {
    'children': group.playmodes != null && group.playmodes.length > 0 && (
      <div className={'user-group-badge__modes'}>
        {group.playmodes.map((playmode) => (
          <i key={playmode} className={`fal fa-extra-mode-${playmode}`} />
        ))}
      </div>
    ),
    'className': classWithModifiers('user-group-badge', {
      probationary: group.is_probationary,
      [group.identifier]: true,
      ...modifiers,
    }),
    'data-label': group.short_name,
    'style': osu.groupColour(group),
    title,
  };

  return group.id < 0
    ? <div {...props} />
    : <a {...props} href={route('groups.show', { group: group.id })} />;
}
