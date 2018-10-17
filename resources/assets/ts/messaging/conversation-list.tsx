/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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

import * as React from 'react';
import ConversationListItem from './conversation-list-item';
import { inject, observer } from 'mobx-react';

@inject('dataStore')
@observer
export default class ConversationList extends React.Component<any, {}> {
  render(): React.ReactNode {
    let conversations = this.props.dataStore.channelStore.sortedByPresence;
    let conversationList: Array<React.ReactNode> = new Array<React.ReactNode>();

    conversations.forEach((conversation) => {
      conversationList.push(
        <ConversationListItem
            key={conversation.channel_id}
            channel_id={conversation.channel_id}
        />
      );
    })

    return(
      <div className='messaging__conversation-list'>
        {_.isEmpty(conversationList) ? (
          <div className='messaging__conversation-list-item'>{osu.trans('messages.no-conversations')}</div>
        ) : (
          conversationList
        )}
      </div>
    )
  }
}
