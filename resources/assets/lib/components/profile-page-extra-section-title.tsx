// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';

interface Props {
  count?: number | null;
  titleKey: string;
}

export default function ProfilePageExtraSectionTitle(props: Props) {
  return (
    <h3 className='title title--page-extra-small'>
      {osu.trans(props.titleKey)}

      {props.count != null &&
        <span className='title__count'>
          {osu.formatNumber(props.count)}
        </span>
      }
    </h3>
  );
}
