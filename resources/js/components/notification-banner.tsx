// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import Portal from './portal';

const bn = 'notification-banner-v2';

interface Props {
  message: React.ReactNode;
  title: string;
  type: string;
}

export default class NotificationBanner extends React.PureComponent<Props> {
  private readonly portalRoot: Element;

  constructor(props: Props) {
    super(props);

    const portalRoot = (window.newBody ?? document.body).querySelector('.js-notification-banners');
    if (portalRoot == null) {
      throw new Error('Notification banner container is missing');
    }
    this.portalRoot = portalRoot;
  }

  componentDidMount() {
    this.notifySyncHeight();
  }

  componentWillUnmount() {
    window.setTimeout(this.notifySyncHeight);
  }

  render() {
    return (
      <Portal root={this.portalRoot}>
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
      </Portal>
    );
  }

  private notifySyncHeight(this: void) {
    $.publish('osu:page:change');
  }
}
