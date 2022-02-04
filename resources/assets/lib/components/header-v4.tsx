// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import HeaderLink from 'interfaces/header-link';
import core from 'osu-core-singleton';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { parseJson } from 'utils/json';
import { Spinner } from './spinner';

interface Props {
  backgroundImage?: string | null;
  contentAppend?: React.ReactNode;
  contentPrepend?: React.ReactNode;
  isCoverUpdating?: boolean;
  links: HeaderLink[];
  linksBreadcrumb?: boolean;
  onLinkClick?: (event: React.MouseEvent<HTMLAnchorElement>) => void;
  theme?: string;
  titleAppend?: React.ReactNode;
}

interface RouteSection {
  action: string;
  controller: string;
  namespace: string;
  section: string;
}

export default class HeaderV4 extends React.Component<Props> {
  static defaultProps = {
    links: [],
    linksBreadcrumb: false,
  };

  render(): React.ReactNode {
    const classNames = classWithModifiers(
      'header-v4',
      osu.presence(this.props.theme),
      { restricted: core.currentUser?.is_restricted ?? false },
    );

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
                {this.title()}
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

  private title() {
    const routeSection = parseJson<RouteSection>('json-route-section');

    const keys = [
      `page_title.${routeSection.namespace}.${routeSection.controller}.${routeSection.action}`,
      `page_title.${routeSection.namespace}.${routeSection.controller}._`,
      `page_title.${routeSection.namespace}._`,
    ];

    for (const key of keys) {
      if (osu.transExists(key, fallbackLocale)) {
        return osu.trans(key);
      }
    }

    return 'unknown';
  }
}
