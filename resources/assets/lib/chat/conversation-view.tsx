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

import { route } from 'laroute';
import * as _ from 'lodash';
import { inject, observer } from 'mobx-react';
import Message from 'models/chat/message';
import * as moment from 'moment';
import * as React from 'react';
import { Spinner } from 'spinner';
import RootDataStore from 'stores/root-data-store';
import { StringWithComponent } from 'string-with-component';
import { UserAvatar } from 'user-avatar';
import { ChatChannelSwitchAction } from '../actions/chat-actions';
import DispatcherAction from '../actions/dispatcher-action';
import DispatchListener from '../dispatch-listener';
import Dispatcher from '../dispatcher';
import MessageDivider from './message-divider';
import MessageGroup from './message-group';

interface Props {
  dataStore?: RootDataStore;
  dispatcher?: Dispatcher;
}

@inject('dataStore')
@inject('dispatcher')
@observer
export default class ConversationView extends React.Component<Props> implements DispatchListener {
  private baseCssClass = 'chat-conversation';
  private chatLabelClass = 'chat-label';
  private chatViewRef = React.createRef<HTMLInputElement>();
  private readonly dataStore: RootDataStore;
  private didSwitchChannel: boolean = true;
  private unreadMarker?: JQuery<HTMLElement>;
  private unreadMarkerClass = 'read-marker';

  constructor(props: Props) {
    super(props);

    this.dataStore = props.dataStore!;
    props.dispatcher!.register(this);
  }

  componentDidMount() {
    this.componentDidUpdate();
    $(window).on('throttled-scroll', _.throttle(this.onScroll, 1000));
  }

  componentDidUpdate = () => {
    const chatView = this.chatViewRef.current;
    if (!chatView) {
      return;
    }

    const dataStore = this.dataStore;
    const channel = dataStore.channelStore.channels.get(dataStore.uiState.chat.selected);
    if (!channel?.loaded) {
      return;
    }

    const unreadMarker = $(chatView).find(`.${this.baseCssClass}__${this.unreadMarkerClass}`);
    this.unreadMarker = unreadMarker.length > 0 ? unreadMarker : undefined;

    if (this.didSwitchChannel) {
      if (this.unreadMarker) {
        this.scrollToUnread();
      } else {
        this.scrollToBottom();
      }
      this.didSwitchChannel = false;
    } else {
      if (this.dataStore.uiState.chat.autoScroll) {
        this.scrollToBottom();
      }
    }
  }

  handleDispatchAction(action: DispatcherAction) {
    if (action instanceof ChatChannelSwitchAction) {
      this.didSwitchChannel = true;
    }
  }

  noCanSendMessage(): React.ReactNode {
    const dataStore: RootDataStore = this.dataStore;
    const presence = dataStore.channelStore.channels.get(dataStore.uiState.chat.selected);

    if (!presence) {
      // this shouldn't happen...
      return;
    }

    if (presence.type === 'PM' || presence.type === 'NEW') {
      return (
        <div>
          <div className='chat-conversation__cannot-message'>{osu.trans('chat.cannot_send.user')}</div>
          <ul className='chat-conversation__cannot-message-reasons'>
            <li>{osu.trans('chat.cannot_send.reasons.friends_only')}</li>
            <li>{osu.trans('chat.cannot_send.reasons.target_restricted')}</li>
            <li>{osu.trans('chat.cannot_send.reasons.restricted')}</li>
            <li>{osu.trans('chat.cannot_send.reasons.blocked')}</li>
          </ul>
        </div>
      );
    } else if (presence.type === 'GROUP') {
      return (
        <div>
          <div className='chat-conversation__cannot-message'>{osu.trans('chat.cannot_send.channel')}</div>
          <ul className='chat-conversation__cannot-message-reasons'>
            <li>{osu.trans('chat.cannot_send.reasons.channel_moderated')}</li>
            <li>{osu.trans('chat.cannot_send.reasons.restricted')}</li>
          </ul>
        </div>
      );
    }
  }

  onScroll = () => {
    const chatView = this.chatViewRef.current;
    if (chatView) {
      this.dataStore.uiState.chat.autoScroll = chatView.scrollTop + chatView.clientHeight >= chatView.scrollHeight;
    }
  }

  render(): React.ReactNode {
    const dataStore: RootDataStore = this.dataStore;
    const channel = dataStore.channelStore.channels.get(dataStore.uiState.chat.selected);

    if (!channel) {
      return <div className='conversation' />;
    }

    const lazerLink = 'https://github.com/ppy/osu/releases';
    const oldPMLink = `https://osu.ppy.sh/forum/ucp.php?i=pm&mode=compose&u=${channel.pmTarget}`;
    const conversationStack: JSX.Element[] = [];
    let currentGroup: Message[] = [];
    let lastReadIndicatorShown = false;
    let currentDay: number;

    _.each(channel.messages, (message: Message, key: number) => {
      // check if the last read indicator needs to be shown
      if (!lastReadIndicatorShown && message.messageId > dataStore.uiState.chat.lastReadId && message.sender.id !== currentUser.id) {
        lastReadIndicatorShown = true;
        if (!_.isEmpty(currentGroup)) {
          conversationStack.push(<MessageGroup key={currentGroup[0].uuid} messages={currentGroup} />);
          currentGroup = [];
        }
        conversationStack.push(<MessageDivider key={`read-${message.timestamp}`} type='READ_MARKER' timestamp={message.timestamp} />);
      }

      // check whether the day-change header needs to be shown
      if (_.isEmpty(conversationStack) || moment(message.timestamp).date() !== currentDay /* TODO: make check less dodgy */) {
        if (!_.isEmpty(currentGroup)) {
          conversationStack.push(<MessageGroup key={currentGroup[0].uuid} messages={currentGroup} />);
          currentGroup = [];
        }
        conversationStack.push(<MessageDivider key={`day-${message.timestamp}`} type='DAY_MARKER' timestamp={message.timestamp} />);
        currentDay = moment(message.timestamp).date();
      }

      // add message to current message grouping if the sender is the same, otherwise create a new message grouping
      const lastCurrentGroup = _.last(currentGroup);
      if (lastCurrentGroup == null || lastCurrentGroup.sender.id === message.sender.id) {
        currentGroup.push(message);
      } else {
        conversationStack.push(<MessageGroup key={currentGroup[0].uuid} messages={currentGroup} />);
        currentGroup = [];
        currentGroup.push(message);
      }

      if (key === channel.messages.length - 1) {
        conversationStack.push(<MessageGroup key={currentGroup[0].uuid} messages={currentGroup} />);
      }
    });

    return (
      <div className='chat-conversation' onScroll={this.onScroll} ref={this.chatViewRef}>
        <div className='chat-conversation__new-chat-avatar'>
          <UserAvatar user={{id: 0, avatar_url: channel.icon}} />
        </div>
        <div className='chat-conversation__chat-label'>
          {channel.type === 'PM' ? (
            <StringWithComponent
              pattern={osu.trans('chat.talking_with')}
              // TODO: rework this once the user class situation is resolved
              mappings={{':name': <a key='user' className='js-usercard' data-user-id={channel.pmTarget} href={route('users.show', {user: channel.pmTarget})}>{channel.name}</a>}}
            />
          ) : (
            osu.trans('chat.talking_in', {channel: channel.name})
          )}
        </div>
        {channel.newChannel &&
          <div className='chat-conversation__limitation-notice' dangerouslySetInnerHTML={{__html: osu.trans('chat.limitation_notice', {lazer_link: lazerLink, oldpm_link: oldPMLink})}} />
        }
        {channel.description &&
          <div className='chat-conversation__chat-label'>
            {channel.description}
          </div>
        }
        {channel.loading &&
          <div className='chat-conversation__day-divider'>
            <Spinner />
          </div>
        }
        {conversationStack}
        {channel.moderated &&
          this.noCanSendMessage()
        }
      </div>
    );
  }

  scrollToBottom = (): void => {
    const chatView = this.chatViewRef.current;
    if (chatView) {
      $(chatView).scrollTop(chatView.scrollHeight);
    }
  }

  scrollToUnread = (): void => {
    const chatView = this.chatViewRef.current;
    const unreadMarkerAtVeryTop = this.unreadMarker?.prev().hasClass(`${this.baseCssClass}__${this.chatLabelClass}`);
    if (chatView && this.unreadMarker) {
      // If the unread marker is the first element in this conversation, it most likely means that the unread cursor
      // is even further in the past, making the displayed marker somewhat useless (until we can back-load those
      // past messages in)... thus we ignore it when auto-scrolling and just go to the bottom instead.
      if (unreadMarkerAtVeryTop) {
        this.scrollToBottom();
      } else {
        $(chatView).scrollTop(this.unreadMarker[0].offsetTop);
      }
    }
  }
}
