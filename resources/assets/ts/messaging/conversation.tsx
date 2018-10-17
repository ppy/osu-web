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
import { observer, inject } from 'mobx-react';
import RootDataStore from 'stores/root-data-store';
import Channel from 'models/chat/channel';

@inject('dataStore')
@observer
export default class Conversation extends React.Component<any, any> {
  componentDidMount() {
    this.componentDidUpdate();
  }

  componentDidUpdate() {
    if ($('.messaging__read-marker').length > 0 && false) {
      $('.messaging__read-marker')[0].scrollIntoView();
    } else {
      $('.messaging__conversation').scrollTop($('.messaging__conversation')[0].scrollHeight)
    }
  }

  noCanSendMessage(): React.ReactNode {
    // console.log('noCanSendMessage', this.props.presence?.type)
    let dataStore: RootDataStore = this.props.dataStore;
    let presence = dataStore.channelStore.channels.get(dataStore.uiState.chat.selected);
    if (presence.type == 'PM' || presence.type == 'NEW')
      return (
        <div>
          <div className='messaging__cannot-message'>You cannot message this user at this time. This may be due to any of the following reasons:</div>
          <ul className='messaging__cannot-message-reasons'>
            <li>The recipient is only accepting messages from people on their friends list</li>
            <li>The recipient is currently restricted</li>
            <li>You were blocked by the recipient</li>
            <li>You are currently restricted</li>
          </ul>
        </div>
      );
    else if (presence.type == 'GROUP')
      return (
        <div>
          <div className='messaging__cannot-message'>You cannot message this channel at this time. This may be due to any of the following reasons:</div>
          <ul className='messaging__cannot-message-reasons'>
            <li>The channel has been moderated</li>
            <li>You are currently restricted</li>
          </ul>
        </div>
      );
  }

  render(): React.ReactNode {
    let dataStore: RootDataStore = this.props.dataStore;
    let channel: Channel = dataStore.channelStore.channels.get(dataStore.uiState.chat.selected);

    // if (channel && channel.messages.length > 0) {
    //   // console.log('messages', channel.messages);
    //   console.log('last_read_id', channel.last_read_id)
    //   console.log('last_message_id', channel.last_message_id)

    // }

    // return (
    //   <div className='messaging__conversation'>
    //     {channel && channel.messages.length &&
    //       channel.messages.map((message, index) => {
    //         return (
    //           <div key={message.uuid} style={{backgroundColor: `#${message.uuid.substr(0,6)}`}}>{message.message_id}</div>
    //         )
    //       })
    //     }
    //     {channel && channel.messages.length &&
    //       <div style={{color: 'red'}}>{channel.last_message_id}</div>
    //     }
    //   </div>
    // );

    if (!channel) {
      return(<div className='messaging__conversation' />);
    }

    let messageGroups = []
    let group = []
    let lastReadIndicatorShown = false
    let currentDay = null

    _.each(channel.messages, (message, key) => {
      if (!lastReadIndicatorShown && message.message_id > channel.last_read_id && message.sender.id != currentUser.id) {
        lastReadIndicatorShown = true
        if (!_.isEmpty(group))
          messageGroups.push(group)
        messageGroups.push({'READ_MARKER': message.timestamp})
        group = []
      }

      if (_.isEmpty(messageGroups) || moment(message.timestamp).date() != currentDay) {
        if (!_.isEmpty(group))
          messageGroups.push(group)
        messageGroups.push({'DAY_DIVIDER': message.timestamp})
        currentDay = moment(message.timestamp).date()
        group = []
      }

      if (_.isEmpty(group)) {
        group = [message]
      } else {
        if (_.last(group).sender.id == message.sender.id) {
          group = group.concat(message)
        } else {
          messageGroups.push(group)
          group = [message]
        }
      }

      if (key == channel.messages.length - 1) {
        messageGroups.push(group)
      }
    })

    // console.log('MG', messageGroups)
    return (
      <div className='messaging__conversation'>
        {channel.newChannel &&
          <div className='messaging__conversation'>
            <div className='messaging__day-divider'>
              <img className='messaging__new-chat-avatar' src={channel.icon} />
            </div>
            <div className='messaging__day-divider'>new conversation with {channel.name}</div>
          </div>
        }

        {channel.loading &&
          <div className='messaging__day-divider'>
            <Spinner />
          </div>
        }

        {messageGroups.map((group) => {
          let className = 'messaging__message-group'
          if (group[0] && group[0].sender.id == currentUser.id)
            className += ' messaging__message-group--own'

          return (
            <div key={osu.uuid()}>
              {group['DAY_DIVIDER'] && // if
                <div className='messaging__day-divider' key={`dd-${group['DAY_DIVIDER']}`}>{moment(group['DAY_DIVIDER']).format('LL')}</div>
              }
              {!group['DAY_DIVIDER'] && group['READ_MARKER'] && // else if
                <div className='messaging__read-marker' key={`read-${group['READ_MARKER']}`} data-content='unread messages' />
              }
              {!group['DAY_DIVIDER'] && !group['READ_MARKER'] && group[0] && // else
                <div className={className} key={group[0].uuid}>
                  <div className='messaging__message-group-sender'>
                    <a className='js-usercard' data-user-id={group[0].sender.id} data-tooltip-position='top center' href='#'>
                      <img className='messaging__message-group-avatar' src={group[0].sender.avatarUrl} />
                    </a>
                    <div className='u-ellipsis-overflow' style={{maxWidth: '60px'}}>
                      {group[0].sender.username}
                    </div>
                  </div>
                  <div className='messaging__message-group-bubble'>
                    {group.map((message) => {
                      let classes = 'messaging__message'
                      var innerClasses

                      if (!message.persisted)
                        classes += ' messaging__message--sending'
                      if (message.isAction)
                        innerClasses = ' messaging__message-content--action'

                      return (
                        <div className={classes} key={message.uuid}>
                          <div className={`messaging__message-content${innerClasses ? innerClasses : ''}`}>
                            {message.content}
                            {!message.persisted && !message.errored &&
                              <div className='messaging__message-sending'>
                                <Spinner />
                              </div>
                            }
                            {message.errored &&
                              <div className='messaging__message-sending'>
                                <i className='fas fa-times'/>
                              </div>
                            }
                          </div>
                          <div className='messaging__message-timestamp'>{moment(message.timestamp).format('LT')}</div>
                        </div>
                      )
                    })}
                  </div>
                </div>
              }
            </div>
          )
        })}
        {!this.props.canMessage && false &&
          this.noCanSendMessage()
        }
      </div>
    );
  }
}
