// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as moment from 'moment';
import * as React from 'react';

interface Props {
  timestamp: string;
  type: string;
}

export const MessageDivider = React.forwardRef<HTMLDivElement, Props>(({timestamp, type}, innerRef) => {
  switch (type) {
    case 'DAY_MARKER':
      return (<div ref={innerRef} className='chat-conversation__day-divider'>{moment(timestamp).format('LL')}</div>);

    case 'UNREAD_MARKER':
      return (<div ref={innerRef} className='chat-conversation__unread-marker' data-content='unread messages' />);

    default:
      return null;
  }
});
