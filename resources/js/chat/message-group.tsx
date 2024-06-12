// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserAvatar from 'components/user-avatar';
import UserLink from 'components/user-link';
import Reportable from 'interfaces/reportable';
import { last } from 'lodash';
import { observer } from 'mobx-react';
import Message from 'models/chat/message';
import * as moment from 'moment';
import core from 'osu-core-singleton';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import MessageItem from './message-item';

interface Props {
  messages: Message[];
}

@observer
export default class MessageGroup extends React.Component<Props> {
  private get reportable() {
    const lastMessage = last(this.props.messages);

    if (lastMessage == null) {
      throw new Error('invalid reportable access on empty message group');
    }

    if (typeof lastMessage.messageId !== 'number') {
      return undefined;
    }

    return {
      id: lastMessage.messageId.toString(),
      type: 'message',
    } satisfies Reportable;
  }

  render(): React.ReactNode {
    const messages = this.props.messages;

    if (messages.length === 0) {
      return;
    }

    const sender = messages[0].sender;

    return (
      <div className={classWithModifiers('chat-message-group', { own: sender.id === core.currentUser?.id })}>
        <div className='chat-message-group__sender'>
          <UserLink
            reportable={this.reportable}
            tooltipPosition='top center'
            user={sender}
          >
            <div className='chat-message-group__avatar'>
              <UserAvatar modifiers='full-circle' user={{ avatar_url: sender.avatarUrl }} />
            </div>
          </UserLink>
          <div className='chat-message-group__username u-ellipsis-overflow'>
            {sender.username}
          </div>
        </div>
        <div className='chat-message-group__bubble'>
          {messages.map((message: Message, key: number) => {
            const timestamp = moment(message.timestamp).format('LT');
            const showTimestamp: boolean =
              // show timestamp if this is the last message in the group
              (key === messages.length - 1) ||
              // or if the next message has a different displayed timestamp
              (timestamp !== moment(messages[key + 1].timestamp).format('LT'));

            return (
              <React.Fragment key={message.uuid}>
                <MessageItem message={message} />
                {showTimestamp && (
                  <div className='chat-message-group__timestamp'>{timestamp}</div>
                )}
              </React.Fragment>
            );
          })}
        </div>
      </div>
    );
  }
}
