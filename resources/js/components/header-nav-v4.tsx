// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import HeaderLink from 'interfaces/header-link';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';

interface Props {
  links: HeaderLink[];
  linksBreadcrumb?: boolean;
  onLinkClick?: (event: React.MouseEvent<HTMLAnchorElement>) => void;
}

export default class HeaderNavV4 extends React.Component<Props> {
  static defaultProps = {
    links: [],
    linksBreadcrumb: false,
  };

  render() {
    return (
      <>
        {this.renderLinks()}
        {this.renderLinksMobile()}
      </>
    );
  }

  private renderLinks() {
    const items = this.props.links.map((link) => {
      const linkModifiers = [];
      if (link.active) {
        linkModifiers.push('active');
      }

      return (
        <li key={`${link.url}-${link.title}`} className='header-nav-v4__item'>
          <a
            className={classWithModifiers('header-nav-v4__link', linkModifiers)}
            href={link.url}
            onClick={this.props.onLinkClick}
            {...link.data}
          >
            <span className='fake-bold' data-content={link.title}>
              {link.title}
            </span>
          </a>
        </li>
      );
    });

    const List = this.props.linksBreadcrumb ? 'ol' : 'ul';

    const modifiers = [];
    modifiers.push(this.props.linksBreadcrumb ? 'breadcrumb' : 'list');

    return (
      <List className={classWithModifiers('header-nav-v4', modifiers)}>
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
            className='header-nav-mobile__item js-click-menu--close'
            href={link.url}
            onClick={this.props.onLinkClick}
            {...link.data}
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
