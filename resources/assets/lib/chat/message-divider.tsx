/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

import * as moment from 'moment';
import * as React from 'react';

interface Props {
  timestamp: string;
  type: string;
}

export default class MessageDivider extends React.Component<Props, any> {
  render(): React.ReactNode {
    switch (this.props.type) {
      case 'DAY_MARKER':
        return (<div className='chat-conversation__day-divider'>{moment(this.props.timestamp).format('LL')}</div>);

      case 'READ_MARKER':
        return (<div className='chat-conversation__read-marker' data-content='unread messages' />);

      default:
        return null;
    }
  }
}
