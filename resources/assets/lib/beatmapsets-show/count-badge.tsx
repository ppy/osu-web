// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import StringWithComponent from 'components/string-with-component';
import * as React from 'react';
import { classWithModifiers, Modifiers } from 'utils/css';
import { trans } from 'utils/lang';

interface Props {
  data: Partial<Record<string, string>>;
  modifiers?: Modifiers;
}

export default function CountBadge({ data, modifiers }: Props) {
  return (
    <div className={classWithModifiers('beatmapset-count-badge', modifiers)}>
      {Object.entries(data).map(([key, value]) => (
        <div key={key} className='beatmapset-count-badge__item'>
          <StringWithComponent
            mappings={{
              value:
                <span className='beatmapset-count-badge__value'>
                  {value}
                </span>,
            }}
            pattern={trans(`beatmapsets.show.details.${key}`)}
          />
        </div>
      ))}
    </div>
  );
}
