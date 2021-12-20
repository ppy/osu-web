// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ProfileExtraPage } from 'interfaces/user-extended-json';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';

interface Props {
  currentPage: ProfileExtraPage;
  page: ProfileExtraPage;
}

export default class ExtraTab extends React.PureComponent<Props> {
  render() {
    const blockClass = classWithModifiers(
      'page-mode-link',
      'profile-page',
      { 'is-active': this.props.page === this.props.currentPage },
    );
    const title = osu.trans(`users.show.extra.${this.props.page}.title`);

    return (
      <span className={blockClass}>
        <span className='fake-bold' data-content={title}>
          {title}
        </span>
        <span className='page-mode-link__stripe' />
      </span>
    );
  }
}
