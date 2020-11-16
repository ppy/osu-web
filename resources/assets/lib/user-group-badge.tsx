// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GroupJson from 'interfaces/group-json';
import * as React from 'react';

interface Props {
  group?: GroupJson;
  modifiers?: string[];
}

export default function UserGroupBadge({group, modifiers = []}: Props) {
  if (group == null) {
    return null;
  }

  const style = osu.groupColour(group);

  const badgeModifiers = [...modifiers];
  if (group.is_probationary) {
    badgeModifiers.push('probationary');
  }

  const playModes: JSX.Element[] = (group.playmodes ?? []).map((mode) => <i className={`fal fa-extra-mode-${mode}`} key={mode} />);

  return (
    <div
      className={osu.classWithModifiers('user-group-badge', badgeModifiers)}
      data-label={group.short_name}
      style={style}
      title={group.name}
    >
      {playModes.length > 0 &&
        <div className={'user-group-badge__modes'}>
          {playModes}
        </div>
      }
    </div>
  );
}
