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
