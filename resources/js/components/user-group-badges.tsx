// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserGroupJson from 'interfaces/user-group-json';
import * as React from 'react';
import { Modifiers } from 'utils/css';
import UserGroupBadge from './user-group-badge';

interface Props {
  groups?: UserGroupJson[];
  modifiers?: Modifiers;
  short?: boolean;
  wrapper: string; // FIXME: temporary?
}

export default function UserGroupBadges(props: Props) {
  const {
    groups = [],
    modifiers,
    short = false,
    wrapper,
  } = props;

  let mainGroupWasSet = false;

  return (
    <>
      {groups.map((group) => {
        const className = short && mainGroupWasSet ? `${wrapper} u-hidden-narrow` : wrapper;
        mainGroupWasSet = true;

        return (
          <span key={group.identifier} className={className}>
            <UserGroupBadge group={group} modifiers={modifiers} />
          </span>
        );
      })}
    </>
  );
}
