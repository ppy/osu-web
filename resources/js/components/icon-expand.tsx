// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';

interface IconProps {
  icon: 'angle-down' | 'angle-up';
  position: 'bottom' | 'top';
}

interface Props {
  expand: boolean;
  parentClass: string;
}

function Icon({ position, icon }: IconProps) {
  return (
    <span className={`icon-stack__icon icon-stack__icon--${position}`}>
      <i className={`fas fa-fw fa-${icon}`} />
    </span>
  );
}

export default function IconExpand({ expand = false, parentClass }: Props) {
  return (
    <span className={`icon-stack ${parentClass}`}>
      <span className='icon-stack__base'>
        <i className='fas fa-fw fa-angle-down' />
      </span>
      {expand ? (
        <>
          <Icon icon='angle-up' position='top' />
          <Icon icon='angle-down' position='bottom' />
        </>
      ) : (
        <>
          <Icon icon='angle-down' position='top' />
          <Icon icon='angle-up' position='bottom' />
        </>
      )}
    </span>
  );
}
