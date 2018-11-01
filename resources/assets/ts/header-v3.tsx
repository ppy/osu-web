/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

import * as React from 'react';

export default class HeaderV3 extends React.Component<any, any> {
  renderHeaderTitle(): React.ReactNode {
    let classNames = 'osu-page-header-v3';
    if (this.props.theme) {
      classNames += ` osu-page-header-v3--${this.props.theme}`;
    }

    return (
      <div className={classNames}>
        <div className='osu-page-header-v3__title js-nav2--hidden-on-menu-access'>
          <div className='osu-page-header-v3__title-icon'>
            <div className='osu-page-header-v3__icon' />
          </div>
          <h1
            className='osu-page-header-v3__title-text'
            dangerouslySetInnerHTML={{
              __html: this.props.title,
            }} />
        </div>
      </div>
    );
  }

  renderHeaderTabs(): React.ReactNode {
    // TODO: handle tabs
    let classNames = 'page-mode-v2 page-mode-v2--breadcrumbs';
    if (this.props.theme) {
      classNames += ` page-mode-v2--${this.props.theme}`;
    }

    return (
      <ol className={classNames} />
    );
  }

  render(): React.ReactNode {
    let classNames = 'header-v3';
    if (this.props.theme) {
      classNames += ` header-v3--${this.props.theme}`;
    }

    return (
      <div className={classNames}>
        <div className='header-v3__bg'></div>
        <div className='header-v3__overlay'></div>
        <div className='osu-page osu-page--header-v3'>
          { this.renderHeaderTitle() }
          { this.renderHeaderTabs() }
        </div>
      </div>
    );
  }
}
