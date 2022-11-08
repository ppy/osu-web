// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import TimeWithTooltip from 'components/time-with-tooltip';
import { observer } from 'mobx-react';
import Notification from 'models/notification';
import { NotificationContext } from 'notifications-context';
import NotificationDeleteButton from 'notifications/notification-delete-button';
import NotificationReadButton from 'notifications/notification-read-button';
import * as React from 'react';
import { classWithModifiers, mergeModifiers, urlPresence } from 'utils/css';

interface Props {
  canMarkAsRead?: boolean;
  delete?: () => void;
  expandButton?: React.ReactNode;
  icons?: string[];
  isDeleting?: boolean;
  isMarkingAsRead?: boolean;
  item: Notification;
  markRead?: () => void;
  message: string;
  modifiers: string[];
  url?: string;
  withCategory: boolean;
  withCoverImage: boolean;
}

@observer
export default class Item extends React.Component<Props> {
  static contextType = NotificationContext;
  declare context: React.ContextType<typeof NotificationContext>;

  private get canMarkAsRead() {
    return this.props.canMarkAsRead ?? this.props.item.canMarkRead;
  }

  render() {
    const modifiers = mergeModifiers(
      this.props.modifiers,
      this.props.item.category,
      { read: this.props.item.isRead && !this.props.canMarkAsRead },
    );

    return (
      <div className={classWithModifiers('notification-popup-item', modifiers)}>
        <a className='notification-popup-item__link' href={this.props.url} onClick={this.props.markRead} />
        {this.renderCover()}
        <div className='notification-popup-item__main'>
          <div className='notification-popup-item__content'>
            {this.renderCategory()}
            {this.renderMessage()}
            {this.renderTime()}
            {this.renderExpandButton()}
          </div>
          {this.renderMarkAsReadButton()}
          {this.renderDeleteButton()}
        </div>
        {this.renderUnreadStripe()}
      </div>
    );
  }

  private renderCategory() {
    if (!this.props.withCategory) {
      return null;
    }

    const label = osu.trans(`notifications.item.${this.props.item.displayType}.${this.props.item.category}._`);

    if (label === '') {
      return null;
    }

    return <div className='notification-popup-item__row notification-popup-item__row--category'>{label}</div>;
  }

  private renderCover() {
    const coverUrl = this.props.withCoverImage ? this.props.item.details.coverUrl : null;

    return (
      <div
        className='notification-popup-item__cover'
        style={{
          backgroundImage: urlPresence(coverUrl),
        }}
      >
        <div className='notification-popup-item__cover-overlay'>
          {this.renderCoverIcons()}
        </div>
      </div>
    );
  }

  private renderCoverIcons() {
    if (this.props.icons == null) {
      return null;
    }

    return this.props.icons.map((icon) => (
      <div key={icon} className='notification-popup-item__cover-icon'>
        <span className={icon} />
      </div>
    ));
  }

  private renderDeleteButton() {
    if (this.context.isWidget) {
      return null;
    }

    return (
      <NotificationDeleteButton
        isDeleting={this.props.isDeleting ?? this.props.item.isDeleting}
        modifiers={['fancy']}
        onDelete={this.props.delete}
      />
    );
  }

  private renderExpandButton() {
    if (this.props.expandButton == null) {
      return null;
    }

    return (
      <div className='notification-popup-item__row notification-popup-item__row--expand'>
        {this.props.expandButton}
      </div>
    );
  }

  private renderMarkAsReadButton() {
    if (!this.canMarkAsRead) {
      return null;
    }

    return (
      <NotificationReadButton
        isMarkingAsRead={this.props.isMarkingAsRead ?? this.props.item.isMarkingAsRead}
        modifiers={['fancy']}
        onMarkAsRead={this.props.markRead}
      />
    );
  }

  private renderMessage() {
    return (
      <div className='notification-popup-item__row notification-popup-item__row--message'>
        {this.props.message}
      </div>
    );
  }

  private renderTime() {
    if (this.props.item.createdAtJson == null) {
      return;
    }

    return (
      <a
        className='notification-popup-item__row notification-popup-item__row--time u-hover'
        href={this.props.url}
      >
        <TimeWithTooltip dateTime={this.props.item.createdAtJson} relative />
      </a>
    );
  }

  private renderUnreadStripe() {
    if (this.context.isWidget || !this.canMarkAsRead) return null;

    return (
      <span className='notification-popup-item__unread-stripe' />
    );
  }
}
