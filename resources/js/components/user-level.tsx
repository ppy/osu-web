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

  // using tier as a modifier in the linear gradient is required to ensure that
  // if multiple level components are on one page they will only use matching gradients

  return (
    <div
      className={blockClass}
      title={trans('users.show.stats.level', { level })}
    >
      <span className="user-level__level">{level}</span>
      <svg className="user-level__icon" data-name="Layer 1" id="Layer_1" viewBox="0 0 86.6 100" xmlns="http://www.w3.org/2000/svg"><defs><style>{`.cls-1{fill:url(#level-tier-gradient-${tier});}`}</style><linearGradient gradientTransform="rotate(90)" id={`level-tier-gradient-${tier}`}><stop className='stop-1' offset="0%" /><stop className='stop-2' offset="100%" /></linearGradient></defs><path className="cls-1" d="M43.3,8.45A17.3,17.3,0,0,1,52,10.77L73,22.89a17.35,17.35,0,0,1,8.64,15V62.13a17.35,17.35,0,0,1-8.64,15L52,89.23a17.29,17.29,0,0,1-17.3,0l-21-12.12A17.34,17.34,0,0,1,5,62.13V37.87a17.34,17.34,0,0,1,8.65-15l21-12.12A17.3,17.3,0,0,1,43.3,8.45m0-5a22.2,22.2,0,0,0-11.15,3l-21,12.12A22.31,22.31,0,0,0,0,37.87V62.13A22.31,22.31,0,0,0,11.15,81.44l21,12.12a22.28,22.28,0,0,0,22.3,0l21-12.12A22.32,22.32,0,0,0,86.6,62.13V37.87A22.32,22.32,0,0,0,75.46,18.56l-21-12.12a22.2,22.2,0,0,0-11.15-3Z" /></svg>
    </div>
  );
}
