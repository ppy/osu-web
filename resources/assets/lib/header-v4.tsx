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
import * as React from 'react';
import { Spinner } from 'spinner';

interface Props {
  backgroundImage?: string;
  contentAppend?: React.ReactNode;
  contentPrepend?: React.ReactNode;
  isCoverUpdating?: boolean;
  links: HeaderLink[];
  linksBreadcrumb?: boolean;
  onLinkClick?: (event: React.MouseEvent<HTMLAnchorElement>) => void;
  section: string;
  subSection: string;
  theme?: string;
  titleAppend?: React.ReactNode;
}

export default class HeaderV4 extends React.Component<Props> {
  static defaultProps = {
    links: [],
    linksBreadcrumb: false,
    subSection: '',
  };

  render(): React.ReactNode {
    let classNames = 'header-v4';
    if (this.props.theme) {
      classNames += ` header-v4--${this.props.theme}`;
    }

    if (currentUser.is_restricted) {
      classNames += ' header-v4--restricted';
    }

    return (
      <div className={classNames}>
        <div className='header-v4__container header-v4__container--main'>
          <div className='header-v4__bg-container'>
            <div
              className='header-v4__bg'
              style={{ backgroundImage: osu.urlPresence(this.props.backgroundImage) }}
            />
          </div>

          {this.props.isCoverUpdating &&
            <div className='header-v4__spinner'>
              <Spinner />
            </div>
          }

          <div className='header-v4__content'>
            {this.props.contentPrepend}

            <div className='header-v4__row header-v4__row--title'>
              <div className='header-v4__icon' />
              <div className='header-v4__title'>
                <span className='header-v4__title-section'>
                  {this.props.section}
                </span>
                {this.props.subSection !== '' &&
                  <span className='header-v4__title-action'>
                    {this.props.subSection}
                  </span>
                }
              </div>

              {this.props.titleAppend}
            </div>

            {this.props.contentAppend}
          </div>
        </div>

        {this.props.links.length > 0 &&
          <div className='header-v4__container'>
            <div className='header-v4__content'>
              <div className='header-v4__row header-v4__row--bar'>
                {this.renderLinks()}
                {this.renderLinksMobile()}
              </div>

            </div>
          </div>
        }
      </div>
    );
  }

  private renderLinks() {
    const items = this.props.links.map((link) => {
      const linkModifiers = [];
      if (link.active) {
        linkModifiers.push('active');
      }

      return (
        <li className='header-nav-v4__item' key={`${link.url}-${link.title}`}>
          <a
            className={osu.classWithModifiers('header-nav-v4__link', linkModifiers)}
            href={link.url}
            onClick={this.props.onLinkClick}
            {...link.data}
          >
            {link.title}
          </a>
        </li>
      );
    });

    const List = this.props.linksBreadcrumb ? 'ol' : 'ul';

    const modifiers = [];
    modifiers.push(this.props.linksBreadcrumb ? 'breadcrumb' : 'list');

    return (
      <List className={osu.classWithModifiers('header-nav-v4', modifiers)}>
        {items}
      </List>
    );
  }

  private renderLinksMobile() {
    if (this.props.linksBreadcrumb) {
      return null;
    }

    if (this.props.links.length === 0) {
      return null;
    }

    let activeLink: HeaderLink = this.props.links[0];
    const items = this.props.links.map((link) => {
      const linkModifiers = [];
      if (link.active) {
        linkModifiers.push('active');
        activeLink = link;
      }

      return (
        <li key={`${link.url}-${link.title}`}>
          <a
            className='header-nav-mobile__item'
            href={link.url}
            onClick={this.props.onLinkClick}
          >
            {link.title}
          </a>
        </li>
      );
    });

    return (
      <div className='header-nav-mobile'>
        <a
          className='header-nav-mobile__toggle js-click-menu'
          data-click-menu-target='header-nav-mobile'
          href={activeLink.url}
        >
          {activeLink.title}

          <span className='header-nav-mobile__toggle-icon'>
            <span className='fas fa-chevron-down' />
          </span>
        </a>

        <ul
          className='header-nav-mobile__menu js-click-menu'
          data-click-menu-id='header-nav-mobile'
          data-visibility='hidden'
        >
            {items}
        </ul>
      </div>
    );
  }
}
