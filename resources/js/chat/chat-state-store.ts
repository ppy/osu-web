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
import core from 'osu-core-singleton';
import ChannelStore from 'stores/channel-store';
import { isJqXHR, onError } from 'utils/ajax';
import { hideLoadingOverlay } from 'utils/loading-overlay';
import { updateHistory } from 'utils/turbolinks';
import { updateQueryString } from 'utils/url';
import ChannelId, { AddChannelType } from './channel-id';
import ChannelJoinEvent from './channel-join-event';
import ChannelPartEvent from './channel-part-event';
import { createAnnouncement, getUpdates, joinChannel } from './chat-api';
import MainView from './main-view';
import PingService from './ping-service';
import PublicChannels from './public-channels';

@dispatchListener
export default class ChatStateStore implements DispatchListener {
  @observable canChatAnnounce = false;
  @observable createAnnouncement = new CreateAnnouncement();
  @observable isReady = false;
  readonly publicChannels = new PublicChannels();
  skipRefresh = false;
  @observable viewsMounted = new Set<MainView>();
  @observable private isConnected = false;

  private lastHistoryId: number | null = null;
  private readonly pingService: PingService;
  private refocusToIndex = 0; // For refocusing to a channel next to the previously selected one when channel is removed from the list.
  @observable private selected: ChannelId = null;
  @observable private waitAddChannelId: string | number | null = null;

  get isChatMounted() {
    return this.viewsMounted.size > 0;
  }

  // Should not join/create another channel if still waiting for a pending request.
  get isAddingChannel() {
    return this.waitAddChannelId != null;
  }

  get joiningChannelId() {
    return typeof this.waitAddChannelId === 'number'
      ? this.waitAddChannelId
      : null;
  }

  @computed
  get joinedPublicChannelIds() {
    return new Set(this.channelStore.groupedChannels.PUBLIC.map((channel) => channel.channelId));
  }

  get selectedChannel() {
    return typeof this.selected === 'number' ? this.channelStore.get(this.selected) : null;
  }

  // In most cases we want the Channel or create/add channel type, not the channel id itself.
  get selectedChannelOrType() {
    return typeof this.selected === 'number'
      ? this.channelStore.get(this.selected)
      : this.selected;
  }

  @computed
  private get channelList(): Channel[] {
    return supportedChannelTypes.flatMap((type) => this.channelStore.groupedChannels[type]);
  }

  constructor(protected channelStore: ChannelStore) {
    this.pingService = new PingService(channelStore);

    makeObservable(this);

    document.addEventListener('turbo:before-cache', this.handleBeforeCache);

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
        this.channelStore.channels.forEach((channel) => channel.needsRefresh = true);
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
          this.selectedChannel?.load();

          this.isReady = true;
        });
      }
    });

    autorun(() => {
      if (this.selected === 'join' && this.publicChannels.channels == null && !this.publicChannels.error) {
        this.publicChannels.load();
      }
    });
  }

  // Only up to one join/create channel operation should be allowed to be running at any time.
  // For consistency, the operation is considered complete when the websocket message arrives, not when the request completes.
  // TODO: allow user cancelling operation from UI?
  @action
  async addChannel(channelId?: number) {
    if (this.isAddingChannel) return;

    try {
      if (channelId != null) {
        if (this.channelStore.channels.has(channelId)) {
          this.selectChannel(channelId);
          return;
        }

        this.waitAddChannelId = channelId;
        await joinChannel(channelId, core.currentUserOrFail.id);
      } else {
        if (!this.createAnnouncement.isValid) return;

        const json = this.createAnnouncement.toJson();
        this.waitAddChannelId = json.uuid;
        await createAnnouncement(json);
      }
    } catch (error) {
      runInAction(() => {
        this.waitAddChannelId = null;
      });

      if (!isJqXHR(error)) throw error;
      onError(error);
    }
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

  @action
  selectChannel(channelId: ChannelId, mode: 'push' | 'replace' | null = 'push') {
    this.waitAddChannelId = null; // reset any waiting for channel.
    // Mark the channel being switched away from as read.
    // Marking as read is done here to avoid constantly sending mark-as-read requests
    // while receiving messages when autoScroll is enabled on the channel.
    this.selectedChannel?.throttledSendMarkAsRead();
    this.selected = channelId;

    if (typeof channelId === 'string') {
      this.updateUrl(channelId, mode);
      return;
    }

    if (channelId == null) return;
    const channel = this.channelStore.get(channelId);
    if (channel == null) return;

    this.refocusToIndex = this.channelList.indexOf(channel);

    // TODO: should this be here or have something else figure out if channel needs to be loaded?
    channel.load();

    this.updateUrl(channel, mode);
  }

  @action
  selectFirst() {
    if (this.channelList.length === 0) return;

    this.selectChannel(this.channelList[0].channelId, null);
    // Remove channel_id from location on selectFirst();
    updateHistory(updateQueryString(null, {
      channel_id: null,
      sendto: null,
    }), 'replace');
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
  private readonly handleBeforeCache = () => {
    // anything that needs to be reset when navigating away.
    // TODO: split the wait for channel/busy and xhr, or maybe use a placeholder channel instead
    // of blocking the UI.
    this.waitAddChannelId = null;
  };

  @action
  private handleChatChannelJoinEvent(event: ChannelJoinEvent) {
    const json = event.json;
    this.channelStore.update(json);

    if (typeof this.waitAddChannelId === 'string' && this.waitAddChannelId === json.uuid
      || typeof this.waitAddChannelId === 'number' && this.waitAddChannelId === json.channel_id
    ) {
      // hide overlay before changing channel if we're waiting for a change to remove it from history navigation.
      hideLoadingOverlay();
      this.selectChannel(json.channel_id);
      this.waitAddChannelId = null;
      if (json.type === 'ANNOUNCE') {
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
      this.isReady = false;
    }
  }

  @action
  /**
   * Keeps the current channel in focus, unless deleted, then focus on next channel.
   */
  private refocusSelectedChannel() {
    if (typeof this.selectedChannelOrType === 'string') return;

    if (this.selectedChannelOrType != null) {
      this.selectChannel(this.selectedChannelOrType.channelId);
    } else {
      this.focusChannelAtIndex(this.refocusToIndex);
    }
  }

  @action
  private async updateChannelList() {
    const json = await getUpdates(this.channelStore.lastReceivedMessageId, this.lastHistoryId);

    runInAction(() => {
      const newHistoryId = maxBy(json.silences, 'id')?.id;

      if (newHistoryId != null) {
        this.lastHistoryId = newHistoryId;
      }

      this.channelStore.updateWithChatUpdates(json);
    });
  }

  private updateUrl(channel: Channel | AddChannelType, mode: 'push' | 'replace' | null) {
    if (mode == null) return;

    let hash = '';
    const params: Record<'channel_id' | 'sendto', string | null | undefined> = { channel_id: null, sendto: null };

    if (typeof channel === 'string') {
      hash = channel;
    } else {
      if (channel.newPmChannel) {
        params.sendto = channel.pmTarget?.toString();
      } else {
        params.channel_id = channel.channelId.toString();
      }
    }

    updateHistory(updateQueryString(null, params, hash), mode);
  }
}
