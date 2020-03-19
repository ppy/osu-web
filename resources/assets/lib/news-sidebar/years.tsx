// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import * as React from 'react';

interface Props {
  currentYear: number;
  years: number[];
}

export default function Years(props: Props) {
  return (
    <div className='news-sidebar-years'>
      {props.years.map((year) => (
        <a
          href={route('news.index', { year })}
          key={year}
          className={`news-sidebar-years__item ${year === props.currentYear ? 'news-sidebar-years__item--active' : ''}`}
        >
          {year}
        </a>
      ))}
    </div>
  );
}
