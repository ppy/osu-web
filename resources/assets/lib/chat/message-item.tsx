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
      <div className={classWithModifiers('chat-message-group__message', { sending: !this.props.message.persisted })}>
        <div className='chat-message-group__message-entry'>
          <span
            dangerouslySetInnerHTML={{__html: this.props.message.parsedContent}}
            className={classWithModifiers('chat-message-group__message-content', { action: this.props.message.isAction })}
          />
          {!this.props.message.persisted && !this.props.message.errored &&
            <div className='chat-message-group__message-status'>
              <Spinner />
            </div>
          }
          {this.props.message.errored &&
            <div className='chat-message-group__message-status chat-message-group__message-status--errored'>
              <i className='fas fa-times'/>
            </div>
          }
        </div>
        {this.props.showTimestamp &&
          <div className='chat-message-group__message-timestamp'>{moment(this.props.message.timestamp).format('LT')}</div>
        }
      </div>
    );
  }
}
