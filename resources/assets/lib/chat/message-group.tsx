// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { observer } from 'mobx-react';
import Message from 'models/chat/message';
import * as moment from 'moment';
import core from 'osu-core-singleton';
import * as React from 'react';
import UserAvatar from 'user-avatar';
import { UserLink } from 'user-link';
import { classWithModifiers } from 'utils/css';
import MessageItem from './message-item';

interface Props {
  messages: Message[];
}

@observer
export default class MessageGroup extends React.Component<Props> {
  render(): React.ReactNode {
    const messages = this.props.messages;

    if (messages.length === 0) {
      return;
    }

    const sender = messages[0].sender;

    return (
      <div className={classWithModifiers('chat-message-group', { own: sender.id === core.currentUser?.id })}>
        <div className='chat-message-group__sender'>
          <UserLink tooltipPosition='top center' user={sender}>
            <div className='chat-message-group__avatar'>
              <UserAvatar modifiers='full-circle' user={{ avatar_url: sender.avatarUrl }} />
            </div>
          </UserLink>
          <div className='u-ellipsis-overflow' style={{maxWidth: '60px'}}>
            {sender.username}
          </div>
        </div>
        <div className='chat-message-group__bubble'>
          {messages.map((message: Message, key: number) => {
            if (message.parsedContent == null) {
              return;
            }

            const showTimestamp: boolean =
              // show timestamp if this is the last message in the group
              (key === messages.length - 1) ||
              // or if the next message has a different displayed timestamp
              (moment(message.timestamp).format('LT') !== moment(messages[key + 1].timestamp).format('LT'));

            return <MessageItem key={message.uuid} message={message} showTimestamp={showTimestamp} />;
          })}
        </div>
      </div>
    );

  }
}
