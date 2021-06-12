// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserGroupJson from 'interfaces/user-group-json';
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

  const style = osu.groupColour(group);

  let blockClass = classWithModifiers('user-group-badge', {
    probationary: group.is_probationary,
    [group.identifier]: true,
  });
  blockClass += classWithModifiers('user-group-badge', modifiers, true);

  const playModes: JSX.Element[] = (group.playmodes ?? []).map((mode) => <i key={mode} className={`fal fa-extra-mode-${mode}`} />);

  let title = group.name;

  if (group.playmodes != null) {
    const playmodeNames = group.playmodes
      .map((playmode) => osu.trans(`beatmaps.mode.${playmode}`))
      .join(', ');

    title += ` (${playmodeNames})`;
  }

  return (
    <div
      className={blockClass}
      data-label={group.short_name}
      style={style}
      title={title}
    >
      {playModes.length > 0 &&
        <div className={'user-group-badge__modes'}>
          {playModes}
        </div>
      }
    </div>
  );
}
