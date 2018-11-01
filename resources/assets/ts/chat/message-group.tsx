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

import Message from 'models/chat/message';
import * as React from 'react';

interface PropsInterface {
  messages: Message[];
}

export default class MessageGroup extends React.Component<PropsInterface, any> {
  render(): React.ReactNode {
    const messages = this.props.messages;

    if (_.isEmpty(messages)) {
      return;
    }

    let className = 'chat__message-group';
    if (messages[0] && messages[0].sender.id === currentUser.id) {
      className += ' chat__message-group--own';
    }

    return (
      <div className={className}>
        <div className='chat__message-group-sender'>
          <a className='js-usercard' data-user-id={messages[0].sender.id} data-tooltip-position='top center' href='#'>
            <img className='chat__message-group-avatar' src={messages[0].sender.avatarUrl} />
          </a>
          <div className='u-ellipsis-overflow' style={{maxWidth: '60px'}}>
            {messages[0].sender.username}
          </div>
        </div>
        <div className='chat__message-group-bubble'>
          {messages.map((message: Message, key: number) => {
            if (!message.content) {
              return;
            }

            let classes = 'chat__message';
            let innerClasses;

            if (!message.persisted) {
              classes += ' chat__message--sending';
            }

            if (message.isAction) {
              innerClasses = ' chat__message-content--action';
            }

            const showTimestamp: boolean =
              // show timestamp if this is the last message in the group
              (key === messages.length - 1) ||
              // or if the next message has a different displayed timestamp
              (moment(message.timestamp).format('LT') !== moment(messages[key + 1].timestamp).format('LT'));

            return (
              <div className={classes} key={message.uuid}>
                <div className={`chat__message-content${innerClasses ? innerClasses : ''}`}>
                  {message.content}
                  {!message.persisted && !message.errored &&
                    <div className='chat__message-status'>
                      <Spinner />
                    </div>
                  }
                  {message.errored &&
                    <div className='chat__message-status'>
                      <i className='fas fa-times'/>
                    </div>
                  }
                </div>
                { showTimestamp &&
                  <div className='chat__message-timestamp'>{moment(message.timestamp).format('LT')}</div>
                }
              </div>
            );
          })}
        </div>
      </div>
    );

  }
}
