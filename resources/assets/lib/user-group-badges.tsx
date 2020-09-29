// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import GroupJSON from 'interfaces/group-json';
import * as React from 'react';
import UserGroupBadge from 'user-group-badge';

interface Props {
  groups: GroupJSON[];
  modifiers?: string[];
  wrapper: string; // FIXME: temporary?
}

export default function UserGroupBadges(props: Props) {
  const { groups, modifiers, wrapper } = props;

  return (
    <>
      {groups.map((group) => {
        return (
          <span className={wrapper} key={group.identifier}>
            <UserGroupBadge group={group} modifiers={modifiers} />
          </span>
        );
      })}
    </>
  );
}
