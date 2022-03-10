// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { createPortal } from 'react-dom';
import { nextVal } from 'utils/seq';

const bn = 'notification-banner-v2';

interface Props {
  message: React.ReactNode;
  title: string;
  type: string;
}

export default class NotificationBanner extends React.PureComponent<Props> {
  private readonly eventId = `notification-banner-${nextVal()}`;
  private readonly portalContainer: HTMLDivElement;

  constructor(props: Props) {
    super(props);

    this.portalContainer = document.createElement('div');
    const notificationBanners = (window.newBody ?? document.body).querySelector('.js-notification-banners');
    if (notificationBanners == null) {
      throw new Error('Notification banner container is missing');
    }
    notificationBanners.appendChild(this.portalContainer);
  }

  componentDidMount() {
    $(document).on(`turbolinks:before-cache.${this.eventId}`, this.removePortalContainer);
  }

  componentWillUnmount() {
    $(document).off(`.${this.eventId}`);
    this.removePortalContainer();
  }

  render() {
    return createPortal(this.renderNotification(), this.portalContainer);
  }

  private readonly removePortalContainer = () => {
    this.portalContainer.remove();
  };

  private renderNotification() {
    return (
      <div className={`${bn} ${bn}--${this.props.type}`}>
        <div className={`${bn}__col ${bn}__col--icon`} />
        <div className={`${bn}__col ${bn}__col--label`}>
          <div className={`${bn}__type`}>{this.props.type}</div>
          <div className={`${bn}__text`}>{this.props.title}</div>
        </div>
        <div className={`${bn}__col`}>
          <div className={`${bn}__text`}>{this.props.message}</div>
        </div>
      </div>
    );
  }
}
