// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';

export default function UserLevel({ level }: { level: number }) {
  let tier = 'iron';

  if (level >= 110) {
    tier = 'lustrous';
  } else if (level >= 105) {
    tier = 'radiant';
  } else if (level >= 100) {
    tier = 'rhodium';
  } else if (level >= 80) {
    tier = 'platinum';
  } else if (level >= 60) {
    tier = 'gold';
  } else if (level >= 40) {
    tier = 'silver';
  } else if (level >= 20) {
    tier = 'bronze';
  }

  const blockClass = classWithModifiers('user-level', `tier-${tier}`);

  return (
    <div
      className={blockClass}
      title={trans('users.show.stats.level', { level })}
    >
      <div className="user-level__icon" />
      <span className="user-level__level">{level}</span>
    </div>
  );
}
