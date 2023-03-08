// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import HeaderLink from 'interfaces/header-link';
import core from 'osu-core-singleton';
import * as React from 'react';
import { classWithModifiers, Modifiers, urlPresence } from 'utils/css';
import { parseJson } from 'utils/json';
import { trans, transExists } from 'utils/lang';
import { presence } from 'utils/string';
import HeaderNavV4 from './header-nav-v4';

interface Props {
  backgroundImage?: string | null;
  contentAppend?: React.ReactNode;
  contentPrepend?: React.ReactNode;
  links: HeaderLink[];
  linksAppend?: React.ReactNode;
  linksBreadcrumb?: boolean;
  modifiers?: Modifiers;
  onLinkClick?: (event: React.MouseEvent<HTMLAnchorElement>) => void;
  theme?: string;
}

interface RouteSection {
  action: string;
  controller: string;
  namespace: string;
  section: string;
}

// sync with page_title in helpers.php
const pageTitleMap: Record<`${'action' | 'controller' | 'namespace'}Key`, Partial<Record<string, string>>> = {
  actionKey: {
    'forum.topic_watches_controller.index': 'main.home_controller.index',
    'main.account_controller.edit': 'main.home_controller.index',
    'main.beatmapset_watches_controller.index': 'main.home_controller.index',
    'main.follows_controller.index': 'main.home_controller.index',
    'main.friends_controller.index': 'main.home_controller.index',
  },
  controllerKey: {
    'main.artist_tracks_controller._': 'main.artists_controller._',
    'main.store_controller._': 'store._',
    'multiplayer.rooms_controller._': 'main.ranking_controller._',
  },
  namespaceKey: {
    'admin_forum._': 'admin._',
  },
};

export default class HeaderV4 extends React.Component<Props> {
  static defaultProps = {
    links: [],
    linksBreadcrumb: false,
  };

  private cancelSyncHeight?: () => void;

  componentDidMount() {
    this.cancelSyncHeight = core.reactTurbolinks.runAfterPageLoad(() => {
      $.publish('sync-height:force');
    });
  }

  componentWillUnmount() {
    this.cancelSyncHeight?.();
  }

  render() {
    const classNames = classWithModifiers(
      'header-v4',
      presence(this.props.theme),
      this.props.modifiers,
    );

    return (
      <div className={classNames}>
        <div className='header-v4__container header-v4__container--main'>
          <div className='header-v4__bg-container'>
            <div
              className='header-v4__bg'
              style={{ backgroundImage: urlPresence(this.props.backgroundImage) }}
            />
          </div>

          <div
            className='hidden-xs js-sync-height--target'
            data-sync-height-id='notification-banners'
          />

          <div className='header-v4__content'>
            {this.props.contentPrepend}

            <div className='header-v4__row header-v4__row--title'>
              <div className='header-v4__icon' />
              <div className='header-v4__title'>
                {this.title()}
              </div>
            </div>

            {this.props.contentAppend}
          </div>
        </div>

        {this.props.links.length > 0 &&
          <div className='header-v4__container'>
            <div className='header-v4__content'>
              <div className='header-v4__row header-v4__row--bar'>
                <HeaderNavV4 links={this.props.links} linksBreadcrumb={this.props.linksBreadcrumb} onLinkClick={this.props.onLinkClick} />
                {this.props.linksAppend}
              </div>
            </div>
          </div>
        }
      </div>
    );
  }

  private title() {
    const routeSection = parseJson<RouteSection>('json-route-section');

    let actionKey = `${routeSection.namespace}.${routeSection.controller}.${routeSection.action}`;
    actionKey = pageTitleMap.actionKey[actionKey] ?? actionKey;
    let controllerKey = `${routeSection.namespace}.${routeSection.controller}._`;
    controllerKey = pageTitleMap.controllerKey[controllerKey] ?? controllerKey;
    let namespaceKey = `${routeSection.namespace}._`;
    namespaceKey = pageTitleMap.namespaceKey[namespaceKey] ?? namespaceKey;

    const keys = [
      `page_title.${actionKey}`,
      `page_title.${controllerKey}`,
      `page_title.${namespaceKey}`,
    ];

    for (const key of keys) {
      if (transExists(key, fallbackLocale)) {
        return trans(key);
      }
    }

    return 'unknown';
  }
}
