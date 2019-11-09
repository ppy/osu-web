/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

import HeaderLink from 'interfaces/header-link';
import HeaderTitleTrans from 'interfaces/header-title-trans';
import * as React from 'react';

interface Props {
  backgroundImage?: string;
  compact?: boolean;
  links?: HeaderLink[];
  theme?: string;
  title?: string;
  titleTrans?: HeaderTitleTrans;
}

export default class HeaderV3 extends React.Component<Props> {
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
        <div
          className='header-v3__bg'
          style={{ backgroundImage: osu.urlPresence(this.props.backgroundImage) }}
        />
        <div className='header-v3__overlay'/>
        <div className={osuPageClasses}>
          { !this.props.compact &&
            this.renderHeaderTitle()
          }
          {this.renderHeaderTabs()}
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

        return (
          <li className='page-mode-v2__item' key={`${link.url}-${link.title}`}>
            <a className={linkClass} href={link.url}>{link.title}</a>
          </li>
        );
      });
    }

    return (
      <ol className={classNames}>
        {items}
      </ol>
    );
  }
  renderHeaderTitle(): React.ReactNode {
    let classNames = 'osu-page-header-v3';
    if (this.props.theme) {
      classNames += ` osu-page-header-v3--${this.props.theme}`;
    }

    let title;

    if (this.props.titleTrans != null) {
      title = (
        <h1
          className='osu-page-header-v3__title-text'
          dangerouslySetInnerHTML={{
            __html: osu.trans(this.props.titleTrans.key, {
              info: `<span class='osu-page-header-v3__title-highlight'>${this.props.titleTrans.info}</span>`,
            }),
          }}
        />
      );
    } else {
      title = <h1 className='osu-page-header-v3__title-text'>{this.props.title}</h1>;
    }

    return (
      <div className={classNames}>
        <div className='osu-page-header-v3__title'>
          <div className='osu-page-header-v3__title-icon'>
            <div className='osu-page-header-v3__icon' />
          </div>
          {title}
        </div>
      </div>
    );
  }
}
