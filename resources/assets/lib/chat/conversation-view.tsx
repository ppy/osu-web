// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import { each, isEmpty, last, throttle } from 'lodash';
import { action, computed, makeObservable, observe } from 'mobx';
import { disposeOnUnmount, inject, observer } from 'mobx-react';
import Message from 'models/chat/message';
import * as moment from 'moment';
import core from 'osu-core-singleton';
import * as React from 'react';
import ShowMoreLink from 'show-more-link';
import { Spinner } from 'spinner';
import RootDataStore from 'stores/root-data-store';
import StringWithComponent from 'string-with-component';
import UserAvatar from 'user-avatar';
import { MessageDivider } from './message-divider';
import MessageGroup from './message-group';

interface Props {
  dataStore?: RootDataStore;
}

interface Snapshot {
  chatHeight: number;
  chatTop: number;
}

const blankSnapshot = (): Snapshot => ({ chatHeight: 0, chatTop: 0 });

@inject('dataStore')
@observer
export default class ConversationView extends React.Component<Props> {
  private assumeHasBacklog = false;
  private chatViewRef = React.createRef<HTMLDivElement>();
  private readonly dataStore: RootDataStore;
  private didSwitchChannel = true;
  private firstMessage?: Message;
  private unreadMarkerRef = React.createRef<HTMLDivElement>();

  @computed
  get conversationStack() {
    const channel = this.currentChannel;
    if (channel == null) return [];

    const conversationStack: JSX.Element[] = [];
    let currentGroup: Message[] = [];
    let unreadMarkerShown = false;
    let currentDay: number;

    each(channel.messages, (message: Message, key: number) => {
      // check if the last read indicator needs to be shown
      // when messageId is a uuid, comparison will always be false.
      if (!unreadMarkerShown && message.messageId > (channel.lastReadId ?? -1) && message.sender.id !== core.currentUser?.id) {
        unreadMarkerShown = true;

        // If the unread marker is the first element in this conversation, it most likely means that the unread cursor
        // is even further in the past, making the displayed marker somewhat useless (until we can back-load those
        // past messages in)... thus we ignore it when auto-scrolling and just go to the bottom instead.
        //
        // TODO: Actually in hindsight, there's another scenario where the first element in the conversation is an
        // unread marker - when you receive new PMs and have yet to read any. Will look to handle this case later...
        if (isEmpty(conversationStack)) {
          this.assumeHasBacklog = true;
        }

        if (!isEmpty(currentGroup)) {
          conversationStack.push(<MessageGroup key={currentGroup[0].uuid} messages={currentGroup} />);
          currentGroup = [];
        }
        conversationStack.push(<MessageDivider key={`read-${message.timestamp}`} ref={this.unreadMarkerRef} timestamp={message.timestamp} type='UNREAD_MARKER' />);
      }

      // check whether the day-change header needs to be shown
      if (isEmpty(conversationStack) || moment(message.timestamp).date() !== currentDay /* TODO: make check less dodgy */) {
        if (!isEmpty(currentGroup)) {
          conversationStack.push(<MessageGroup key={currentGroup[0].uuid} messages={currentGroup} />);
          currentGroup = [];
        }
        conversationStack.push(<MessageDivider key={`day-${message.timestamp}`} timestamp={message.timestamp} type='DAY_MARKER' />);
        currentDay = moment(message.timestamp).date();
      }

      // add message to current message grouping if the sender is the same, otherwise create a new message grouping
      const lastCurrentGroup = last(currentGroup);
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

    return conversationStack;
  }

  @computed
  get currentChannel() {
    return this.dataStore.chatState.selectedChannel;
  }

  constructor(props: Props) {
    super(props);

    this.dataStore = props.dataStore!;

    makeObservable(this);

    disposeOnUnmount(
      this,
      observe(this.dataStore.chatState.selectedBoxed, (change) => {
        if (change.newValue !== change.oldValue) {
          this.didSwitchChannel = true;
        }
      }),
    );
  }

  componentDidMount() {
    this.componentDidUpdate();
    $(window).on('scroll', throttle(this.onScroll, 1000));
  }

  @action
  componentDidUpdate(prevProps?: Props, prevState?: Readonly<Record<string, never>>, snapshot?: Snapshot) {
    const chatView = this.chatViewRef.current;
    if (!chatView || !this.currentChannel) {
      return;
    }

    if (this.didSwitchChannel) {
      if (this.unreadMarkerRef.current) {
        this.scrollToUnread();
      } else {
        this.scrollToBottom();
      }
      this.didSwitchChannel = false;
    } else {
      snapshot = snapshot ?? blankSnapshot();
      const prepending = this.firstMessage !== this.currentChannel.firstMessage;

      if (prepending && this.chatViewRef.current != null) {
        const chatEl = this.chatViewRef.current;
        const newHeight = chatEl.scrollHeight;
        chatEl.scrollTo(chatEl.scrollLeft, snapshot.chatTop + (newHeight - snapshot.chatHeight));
      } else {
        if (this.dataStore.chatState.autoScroll) {
          this.scrollToBottom();
        }
      }
    }

    this.firstMessage = this.currentChannel.firstMessage;
  }

  getSnapshotBeforeUpdate() {
    const snapshot = blankSnapshot();

    if (this.chatViewRef.current != null) {
      snapshot.chatHeight = this.chatViewRef.current.scrollHeight;
      snapshot.chatTop = this.chatViewRef.current.scrollTop;
    }

    return snapshot;
  }

  noCanSendMessage(): React.ReactNode {
    if (this.currentChannel == null) {
      // this shouldn't happen...
      return;
    }

    if (this.currentChannel.type === 'PM' || this.currentChannel.transient) {
      return (
        <div>
          <div className='chat-conversation__cannot-message'>{osu.trans('chat.cannot_send.user')}</div>
          <ul className='chat-conversation__cannot-message-reasons'>
            <li>{osu.trans('chat.cannot_send.reasons.friends_only')}</li>
            <li>{osu.trans('chat.cannot_send.reasons.target_restricted')}</li>
            <li>{osu.trans('chat.cannot_send.reasons.restricted')}</li>
            <li>{osu.trans('chat.cannot_send.reasons.silenced')}</li>
            <li>{osu.trans('chat.cannot_send.reasons.blocked')}</li>
            <li>{osu.trans('chat.cannot_send.reasons.not_enough_plays')}</li>
            {/* TODO: missing verification */}
            <li>{osu.trans('chat.cannot_send.reasons.not_verified')}</li>
          </ul>
        </div>
      );
    } else if (this.currentChannel.type === 'GROUP') {
      return (
        <div>
          <div className='chat-conversation__cannot-message'>{osu.trans('chat.cannot_send.channel')}</div>
          <ul className='chat-conversation__cannot-message-reasons'>
            <li>{osu.trans('chat.cannot_send.reasons.channel_moderated')}</li>
            <li>{osu.trans('chat.cannot_send.reasons.restricted')}</li>
            <li>{osu.trans('chat.cannot_send.reasons.silenced')}</li>
            <li>{osu.trans('chat.cannot_send.reasons.not_enough_plays')}</li>
            <li>{osu.trans('chat.cannot_send.reasons.not_verified')}</li>
          </ul>
        </div>
      );
    }
  }

  onScroll = () => {
    const chatView = this.chatViewRef.current;
    if (chatView) {
      this.dataStore.chatState.autoScroll = chatView.scrollTop + chatView.clientHeight >= chatView.scrollHeight;
    }
  };

  render(): React.ReactNode {
    const channel = this.currentChannel;
    this.assumeHasBacklog = false;

    if (channel == null || !channel.isDisplayable) {
      return <div className='chat-conversation' />;
    }

    return (
      <div ref={this.chatViewRef} className='chat-conversation' onScroll={this.onScroll}>
        <div className='chat-conversation__new-chat-avatar'>
          <UserAvatar user={{ avatar_url: channel.icon }} />
        </div>
        <div className='chat-conversation__chat-label'>
          {channel.pmTarget != null ? (
            <StringWithComponent
              mappings={{ name: (
                <a
                  className='js-usercard'
                  data-user-id={channel.pmTarget}
                  href={route('users.show', {user: channel.pmTarget})}
                >
                  {channel.name}
                </a>
              ) }}
              // TODO: rework this once the user class situation is resolved
              pattern={osu.trans('chat.talking_with')}
            />
          ) : (
            osu.trans('chat.talking_in', {channel: channel.name})
          )}
        </div>
        {channel.description &&
          <div className='chat-conversation__chat-label'>
            {channel.description}
          </div>
        }
        <ShowMoreLink
          callback={this.loadEarlierMessages}
          direction='up'
          hasMore={channel.hasEarlierMessages}
          loading={channel.loadingEarlierMessages}
          modifiers='chat-conversation-earlier-messages'
        />
        {channel.loadingMessages &&
          <div className='chat-conversation__day-divider'>
            <Spinner />
          </div>
        }
        {this.conversationStack}
        {!channel.canMessage &&
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
  };

  scrollToUnread = (): void => {
    const chatView = this.chatViewRef.current;
    if (chatView && this.unreadMarkerRef.current) {
      if (this.assumeHasBacklog) {
        this.scrollToBottom();
      } else {
        $(chatView).scrollTop(this.unreadMarkerRef.current.offsetTop);
      }
    }
  };

  private loadEarlierMessages = () => {
    if (this.currentChannel == null) return;
    this.dataStore.channelStore.loadChannelEarlierMessages(this.currentChannel.channelId);
  };
}
