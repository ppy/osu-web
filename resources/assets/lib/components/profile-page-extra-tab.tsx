// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { classWithModifiers } from 'utils/css';

interface Props {
  currentPage: string;
  page: string;
}

export default function ProfilePageExtraTab(props: Props) {
  const blockClass = classWithModifiers(
    'page-mode-link',
    'profile-page',
    { 'is-active': props.page === props.currentPage },
  );
  const title = osu.trans(`users.show.extra.${props.page}.title`);

  return (
    <span className={blockClass}>
      <span className='fake-bold' data-content={title}>
        {title}
      </span>
    </span>
  );
}
