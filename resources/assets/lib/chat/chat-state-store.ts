// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ChatNewConversationAdded } from 'actions/chat-new-conversation-added';
import DispatcherAction from 'actions/dispatcher-action';
import FriendUpdated from 'actions/friend-updated';
import SocketMessageSendAction from 'actions/socket-message-send-action';
import SocketStateChangedAction from 'actions/socket-state-changed-action';
import { dispatch, dispatchListener } from 'app-dispatcher';
import DispatchListener from 'dispatch-listener';
import { supportedChannelTypes } from 'interfaces/chat/channel-json';
import { clamp, maxBy } from 'lodash';
import { action, autorun, computed, makeObservable, observable, observe, runInAction } from 'mobx';
import Channel from 'models/chat/channel';
import CreateAnnouncement from 'models/chat/create-announcement';
import ChannelStore from 'stores/channel-store';
import { onError } from 'utils/ajax';
import { setBrowserTitle } from 'utils/html';
import { trans } from 'utils/lang';
import { updateQueryString } from 'utils/url';
import ChannelJoinEvent from './channel-join-event';
import ChannelPartEvent from './channel-part-event';
import { createAnnouncement, getUpdates } from './chat-api';
import MainView from './main-view';
import PingService from './ping-service';

type ChannelId = number | 'create' | null;

@dispatchListener
export default class ChatStateStore implements DispatchListener {
  @observable canChatAnnounce = false;
  @observable createAnnouncement = new CreateAnnouncement();
  @observable isReady = false;
  skipRefresh = false;
  @observable viewsMounted = new Set<MainView>();
  @observable private isConnected = false;
  private lastHistoryId: number | null = null;
  private pingService: PingService;
  @observable private selected: ChannelId = null;
  private selectedIndex = 0;
  @observable private waitJoinChannelUuid: string | null = null;

  @computed
  get isChatMounted() {
    return this.viewsMounted.size > 0;
  }

  // Should not join/create another channel if still waiting for a pending request.
  @computed
  get isJoiningChannel() {
    return this.waitJoinChannelUuid != null;
  }

  @computed
  get selectedChannel() {
    return this.selected == null || this.selected === 'create' ? null : this.channelStore.get(this.selected);
  }

  get showingCreateAnnouncement() {
    return this.selected === 'create';
  }

  @computed
  private get channelList(): Channel[] {
    return supportedChannelTypes.flatMap((type) => this.channelStore.groupedChannels[type]);
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
      if (this.isConnected && this.isChatMounted) {
        if (this.skipRefresh) {
          this.skipRefresh = false;
        } else {
          await this.updateChannelList();
        }

        runInAction(() => {
          // TODO: use selectChannel?
          if (typeof this.selected === 'number') {
            this.channelStore.loadChannel(this.selected);
          }

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
    } else if (event instanceof ChatNewConversationAdded) {
      this.handleChatNewConversationAdded(event);
    } else if (event instanceof FriendUpdated) {
      this.handleFriendUpdated(event);
    } else if (event instanceof SocketStateChangedAction) {
      this.handleSocketStateChanged(event);
    }
  }

  // TODO: This will support the other types of joining channels in the future
  // Only up to one join/create channel operation should be allowed to be running at any time.
  // For consistency, the operation is considered complete when the websocket message arrives, not when the request completes.
  @action
  joinChannel() {
    if (!this.createAnnouncement.isValid || this.isJoiningChannel) return;

    const json = this.createAnnouncement.toJson();
    this.waitJoinChannelUuid = json.uuid;
    // TODO: when adding more channel types to join, remember to add separate busy spinner states for them.

    createAnnouncement(json)
      .fail(action((xhr: JQueryXHR) => {
        onError(xhr);
        this.waitJoinChannelUuid = null;
      }));
  }

  @action
  selectChannel(channelId: ChannelId, mode: 'advanceHistory' | 'replaceHistory' | null = 'advanceHistory') {
    // TODO: enforce location url even if channel doesn't change;
    // noticeable when navigating via ?sendto= on existing channel.
    if (this.selected === channelId) return;

    // Mark the channel being switched away from as read.
    // Marking as read is done here to avoid constantly sending mark-as-read requests
    // while receiving messages when autoScroll is enabled on the channel.
    this.selectedChannel?.throttledSendMarkAsRead();

    this.selected = channelId;

    if (channelId === 'create') {
      if (mode != null) {
        Turbolinks.controller[mode](updateQueryString(null, {
          channel_id: null,
          sendto: null,
        }, 'create'));
      }

      return;
    }

    if (channelId == null) return;

    const channel = this.channelStore.get(channelId);

    if (channel == null) {
      console.error(`Trying to switch to non-existent channel ${channelId}`);
      return;
    }

    this.selectedIndex = this.channelList.indexOf(channel);

    // TODO: should this be here or have something else figure out if channel needs to be loaded?
    this.channelStore.loadChannel(channelId);

    if (mode != null) {
      const params = channel.newPmChannel
        ? { channel_id: null, sendto: channel.pmTarget?.toString() }
        : { channel_id: channel.channelId.toString(), sendto: null };

      Turbolinks.controller[mode](updateQueryString(null, params, ''));
    }
    setBrowserTitle(`${channel.name} · ${trans('page_title.main.chat_controller._')}`);
  }

  @action
  selectFirst() {
    if (this.channelList.length === 0) return;

    this.selectChannel(this.channelList[0].channelId, null);
    // Remove channel_id from location on selectFirst();
    Turbolinks.controller.replaceHistory(updateQueryString(null, {
      channel_id: null,
      sendto: null,
    }));
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
    this.channelStore.update(event.json);

    if (this.waitJoinChannelUuid != null && this.waitJoinChannelUuid === event.json.uuid) {
      this.selectChannel(event.json.channel_id);
      this.waitJoinChannelUuid = null;
      if (event.json.type === 'ANNOUNCE') {
        this.createAnnouncement.clear();
      }
    }
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
  private handleFriendUpdated(event: FriendUpdated) {
    if (!this.isChatMounted) return;

    // FIXME: friend list update isn't propagated to other tabs without a full refresh, yet.
    const channel = this.channelStore.groupedChannels.PM.find((value) => value.pmTarget === event.userId);
    channel?.loadMetadata();
  }

  @action
  private handleSocketStateChanged(event: SocketStateChangedAction) {
    this.isConnected = event.connected;
    if (!event.connected) {
      this.channelStore.channels.forEach((channel) => channel.needsRefresh = true);
      this.isReady = false;
    }
  }

  @action
  /**
   * Keeps the current channel in focus, unless deleted, then focus on next channel.
   */
  private refocusSelectedChannel() {
    if (this.showingCreateAnnouncement) return;

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

      this.channelStore.updateWithChatUpdates(json);
    });
  }
}
