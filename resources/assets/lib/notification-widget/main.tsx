/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

import * as _ from 'lodash';
import { observer } from 'mobx-react';
import * as React from 'react';
import { ShowMoreLink } from 'show-more-link';
import TypeGroup from './type-group';
import Worker from './worker';

interface Props {
  type?: string;
  worker: Worker;
}

@observer
export default class Main extends React.Component<Props> {
  private menuId: string;

  constructor(props: Props) {
    super(props);

    this.menuId = `nav-notification-popup-${osu.uuid()}`;
  }

  render() {
    if (!this.props.worker.isActive()) {
      return null;
    }

    return (
      <>
        <button
          className={this.buttonClass()}
          data-click-menu-target={this.menuId}
        >
          <span className={this.mainClass()}>
            <i className='fas fa-inbox' />
            <span className='notification-icon__count'>
              {this.unreadCount()}
            </span>
          </span>
        </button>
        <div className='nav-click-popup'>
          <div
            className='notification-popup js-click-menu js-nav2--centered-popup u-fancy-scrollbar'
            data-click-menu-id={this.menuId}
            data-visibility='hidden'
          >
            <div className='notification-popup__scroll-container'>
              {this.renderTypeGroup()}

              {this.renderShowMoreButton()}
            </div>
          </div>
        </div>
      </>
    );
  }

  private buttonClass() {
    let ret = 'js-click-menu nav-button';

    if (this.props.type === 'mobile') {
      ret += ' nav-button--mobile';
    } else {
      ret += ' nav-button--stadium';
    }

    return ret;
  }

  private mainClass() {
    let ret = 'notification-icon';

    if (this.props.worker.unreadCount > 0) {
      ret += ' notification-icon--glow';
    }

    if (this.props.type === 'mobile') {
      ret += ' notification-icon--mobile';
    }

    return ret;
  }

  private renderShowMoreButton() {
    if (!this.props.worker.hasMore) {
      return;
    }

    return (
      <div className='notification-popup__show-more'>
        <ShowMoreLink
          callback={this.props.worker.loadMore}
          hasMore={this.props.worker.hasMore}
          loading={this.props.worker.loadingMore}
          modifiers={['t-greysky']}
        />
      </div>
    );
  }

  private renderTypeGroup() {
    const items: React.ReactNode[] = [];

    this.props.worker.itemsGroupedByType.forEach((value, key) => {
      if (value.length === 0) {
        return;
      }

      items.push(
        (
          <div key={key} className='notification-popup__item'>
            <TypeGroup
              item={value[0]}
              items={value}
              worker={this.props.worker}
            />
          </div>
        ),
      );
    });

    if (items.length === 0) {
      items.push(this.props.worker.hasMore ? (
        <div key='empty-with-more' className='notification-popup__empty-with-more' />
      ) : (
        <p key='empty' className='notification-popup__empty'>
          {osu.trans('notifications.all_read')}
        </p>
      ));
    }

    return items;
  }

  private unreadCount() {
    if (this.props.worker.hasData) {
      return osu.formatNumber(this.props.worker.unreadCount);
    } else {
      return '...';
    }
  }
}
