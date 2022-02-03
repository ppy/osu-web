// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';

interface Props {
  currentSubtype: string;
}

export default function FollowsSubtypes(props: Props) {
  return (
    <div className='page-tabs page-tabs--follows'>
      {['comment', 'forum_topic', 'mapping', 'modding'].map((t) => (
        <a
          key={t}
          className={classWithModifiers('page-tabs__tab', { active: t === props.currentSubtype })}
          href={route('follows.index', { subtype: t })}
        >
          {osu.trans(`follows.${t}.title`)}
        </a>
      ))}
    </div>
  );
}
