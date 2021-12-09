// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { observer } from 'mobx-react';
import Message from 'models/chat/message';
import * as moment from 'moment';
import * as React from 'react';
import { Spinner } from 'spinner';
import { classWithModifiers } from 'utils/css';

interface Props {
  message: Message;
  showTimestamp: boolean;
}

@observer
export default class MessageItem extends React.Component<Props> {
  render() {
    return (
      <div className={classWithModifiers('chat-message-item', { sending: !this.props.message.persisted })}>
        <div className='chat-message-item__entry'>
          <span
            dangerouslySetInnerHTML={{ __html: this.props.message.parsedContent }}
            className={classWithModifiers('chat-message-item__content', { action: this.props.message.isAction })}
          />
          {!this.props.message.persisted && !this.props.message.errored &&
            <div className='chat-message-item__status'>
              <Spinner />
            </div>
          }
          {this.props.message.errored &&
            <div className='chat-message-item__status chat-message-item__status--errored'>
              <i className='fas fa-times'/>
            </div>
          }
        </div>
        {this.props.showTimestamp &&
          <div className='chat-message-item__timestamp'>{moment(this.props.message.timestamp).format('LT')}</div>
        }
      </div>
    );
  }
}
