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

import { inject, observer } from 'mobx-react';
import Channel from 'models/chat/channel';
import * as React from 'react';
import ConversationListItem from './conversation-list-item';

@inject('dataStore')
@observer
export default class ConversationList extends React.Component<any, {}> {
  render(): React.ReactNode {
    const nonPmChannels: Channel[] = this.props.dataStore.channelStore.nonPmChannels;
    const pmChannels: Channel[] = this.props.dataStore.channelStore.pmChannels;
    const conversationList: React.ReactNode[] = [];

    nonPmChannels.forEach((conversation) => {
      conversationList.push(<ConversationListItem key={conversation.channelId} channelId={conversation.channelId} />);
    });

    if (nonPmChannels.length > 0 && pmChannels.length > 0) {
      conversationList.push(
        <div key='separator' className='chat-conversation-list-separator' />,
      );
    }

    pmChannels.forEach((conversation) => {
      conversationList.push(<ConversationListItem key={conversation.channelId} channelId={conversation.channelId} />);
    });

    return <div className='chat-conversation-list'>{conversationList}</div>;
  }
}
