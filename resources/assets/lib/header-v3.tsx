/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

import HeaderLink from 'interfaces/header-link';
import HeaderTitleTrans from 'interfaces/header-title-trans';
import * as React from 'react';

interface PropsInterface {
  compact?: boolean;
  links?: HeaderLink[];
  theme?: string;
  title?: string;
  titleTrans?: HeaderTitleTrans;
}

export default class HeaderV3 extends React.Component<PropsInterface, {}> {
  renderHeaderTitle(): React.ReactNode {
    let classNames = 'osu-page-header-v3';
    if (this.props.theme) {
      classNames += ` osu-page-header-v3--${this.props.theme}`;
    }

    let title;

    if (this.props.titleTrans != null) {
      title = <h1
        className='osu-page-header-v3__title-text'
        dangerouslySetInnerHTML={{
          __html: osu.trans(this.props.titleTrans.key, {
            info: `<span class='osu-page-header-v3__title-highlight'>${this.props.titleTrans.info}</span>`,
        })}} />;
    } else {
      title = <h1 className='osu-page-header-v3__title-text'>{title}</h1>;
    }

    return (
      <div className={classNames}>
        <div className='osu-page-header-v3__title js-nav2--hidden-on-menu-access'>
          <div className='osu-page-header-v3__title-icon'>
            <div className='osu-page-header-v3__icon' />
          </div>
          {title}
        </div>
      </div>
    );
  }

  renderHeaderTabs(): React.ReactNode {
    // TODO: handle tabs
    let classNames = 'page-mode-v2';
    if (this.props.theme) {
      classNames += ` page-mode-v2--${this.props.theme}`;
    }

    let items;

    if (this.props.links != null) {
      items = this.props.links.map((link) => {
        let linkClass = 'page-mode-v2__link';
        if (link.active) {
          linkClass += ' page-mode-v2__link--active';
        }

        return <li className='page-mode-v2__item' key={`${link.url}-${link.title}`}>
          <a className={linkClass} href={link.url}>{link.title}</a>
        </li>;
      });
    }

    return (
      <ol className={classNames}>
        {items}
      </ol>
    );
  }

  render(): React.ReactNode {
    let classNames = 'header-v3';
    if (this.props.theme) {
      classNames += ` header-v3--${this.props.theme}`;
    }

    let osuPageClasses = 'osu-page osu-page--header-v3';
    if (this.props.compact) {
      osuPageClasses += '-compact';
    }

    return (
      <div className={classNames}>
        <div className='header-v3__bg'></div>
        <div className='header-v3__overlay'></div>
        <div className={osuPageClasses}>
          { !this.props.compact &&
            this.renderHeaderTitle()
          }
          { this.renderHeaderTabs() }
        </div>
      </div>
    );
  }
}
