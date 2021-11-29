// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ChatMessageSendAction } from 'actions/chat-message-send-action';
import { ChatNewConversationAdded } from 'actions/chat-new-conversation-added';
import DispatcherAction from 'actions/dispatcher-action';
import SocketMessageSendAction from 'actions/socket-message-send-action';
import SocketStateChangedAction from 'actions/socket-state-changed-action';
import { WindowFocusAction } from 'actions/window-focus-actions';
import { dispatch, dispatchListener } from 'app-dispatcher';
import DispatchListener from 'dispatch-listener';
import { clamp, maxBy } from 'lodash';
import { action, autorun, computed, makeObservable, observable, observe, runInAction } from 'mobx';
import Channel from 'models/chat/channel';
import ChannelStore from 'stores/channel-store';
import ChannelJoinEvent from './channel-join-event';
import ChannelPartEvent from './channel-part-event';
import { getUpdates } from './chat-api';
import PingService from './ping-service';

@dispatchListener
export default class ChatStateStore implements DispatchListener {
  @observable autoScroll = false;
  @observable isChatMounted = false;
  @observable isReady = false;
  @observable selectedBoxed = observable.box(0);
  @observable private isConnected = false;
  private lastHistoryId: number | null = null;
  @observable private needsRefresh = true;
  private pingService: PingService;
  private selectedIndex = 0;

  @computed
  get selected() {
    return this.selectedBoxed.get();
  }

  // This setter should be considered private.
  // Use selectChannel to change channel.
  set selected(value: number) {
    this.selectedBoxed.set(value);
  }

  @computed
  get selectedChannel() {
    return this.channelStore.get(this.selected);
  }

  @computed
  private get channelList(): Channel[] {
    return [...this.channelStore.publicChannels, ...this.channelStore.pmChannels];
  }

  constructor(protected channelStore: ChannelStore) {
    this.pingService = new PingService(channelStore);

    makeObservable(this);

    observe(channelStore.channels, (changes) => {
      // refocus channels if any gets removed
      if (changes.type === 'delete') {
        this.refocusSelectedChannel();
      }
    });

    autorun(() => {
      if (this.isReady && this.isChatMounted) {
        this.pingService.start();
        dispatch(new SocketMessageSendAction({ event: 'chat.start' }));
      } else {
        this.pingService.stop();
        dispatch(new SocketMessageSendAction({ event: 'chat.end' }));
      }
    });

    autorun(async () => {
      if (this.isConnected && this.isChatMounted && this.needsRefresh) {
        await this.updateChannelList();
        runInAction(() => {
          this.channelStore.loadChannel(this.selected);
          this.isReady = true;
        });
      }
    });
  }

  handleDispatchAction(event: DispatcherAction) {
    if (event instanceof ChannelJoinEvent) {
      this.handleChatChannelJoinEvent(event);
    } else if (event instanceof ChannelPartEvent) {
      this.handleChatChannelPartEvent(event);
    } else if (event instanceof ChatMessageSendAction) {
      this.autoScroll = true;
    } else if (event instanceof ChatNewConversationAdded) {
      this.handleChatNewConversationAdded(event);
    } else if (event instanceof SocketStateChangedAction) {
      this.handleSocketStateChanged(event);
    } else if (event instanceof WindowFocusAction) {
      this.handleWindowFocusAction();
    }
  }

  @action
  selectChannel(channelId: number) {
    if (this.selected === channelId) return;

    const channel = this.channelStore.get(channelId);
    if (channel == null) {
      console.error(`Trying to switch to non-existent channel ${channelId}`);
      return;
    }

    if (!(this.selectedChannel?.transient ?? true)) {
      // don't disable autoScroll if we're 'switching' away from the 'new chat' screen
      //   e.g. keep autoScroll enabled to jump to the newly sent message when restarting an old conversation
      this.autoScroll = false;
    }

    this.selected = channelId;
    this.selectedIndex = this.channelList.indexOf(channel);

    // TODO: should this be here or have something else figure out if channel needs to be loaded?
    this.channelStore.loadChannel(channelId);
    this.channelStore.markAsRead(channelId);
  }

  @action
  private focusChannelAtIndex(index: number) {
    if (this.channelList.length === 0) {
      return;
    }

    const nextIndex = clamp(index, 0, this.channelList.length - 1);
    const channel = this.channelList[nextIndex];

    this.selectChannel(channel.channelId);
  }

  @action
  private handleChatChannelJoinEvent(event: ChannelJoinEvent) {
    this.channelStore.channels.set(event.channel.channelId, event.channel);
  }

  @action
  private handleChatChannelPartEvent(event: ChannelPartEvent) {
    this.channelStore.partChannel(event.channelId, false);
  }

  @action
  private handleChatNewConversationAdded(event: ChatNewConversationAdded) {
    // TODO: currently only the current window triggers the action, but this should be updated
    // to ignore unfocused windows once new conversation added messages start getting triggered over the websocket.
    this.selectChannel(event.channelId);
  }

  @action
  private handleSocketStateChanged(event: SocketStateChangedAction) {
    this.isConnected = event.connected;
    if (!event.connected) {
      this.channelStore.channels.forEach((channel) => channel.needsRefresh = true);
      this.needsRefresh = true;
      this.isReady = false;
    }
  }

  @action
  private handleWindowFocusAction() {
    this.channelStore.markAsRead(this.selected);
  }

  @action
  /**
   * Keeps the current channel in focus, unless deleted, then focus on next channel.
   */
  private refocusSelectedChannel() {
    if (this.selectedChannel != null) {
      this.selectChannel(this.selectedChannel.channelId);
    } else {
      this.focusChannelAtIndex(this.selectedIndex);
    }
  }

  @action
  private async updateChannelList() {
    const json = await getUpdates(this.channelStore.lastReceivedMessageId, this.lastHistoryId);
    if (!json) return; // FIXME: fix response

    runInAction(() => {
      const newHistoryId = maxBy(json.silences, 'id')?.id;

      if (newHistoryId != null) {
        this.lastHistoryId = newHistoryId;
      }

      this.channelStore.updateWithJson(json);
    });
  }
}
