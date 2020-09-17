// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import {
  ChatChannelLoadEarlierMessages,
  ChatChannelNewMessages,
} from 'actions/chat-actions';
import DispatcherAction from 'actions/dispatcher-action';
import { dispatch, dispatchListener } from 'app-dispatcher';
import DispatchListener from 'dispatch-listener';
import { transaction } from 'mobx';
import RootDataStore from 'stores/root-data-store';
import ChatAPI from './chat-api';

@dispatchListener
export default class ChatOrchestrator implements DispatchListener {
  private api = new ChatAPI();

  constructor(private rootDataStore: RootDataStore) {
  }

  handleDispatchAction(action: DispatcherAction) {
    if (action instanceof ChatChannelLoadEarlierMessages) {
      this.loadChannelEarlierMessages(action.channelId);
    }
  }

  loadChannelEarlierMessages(channelId: number) {
    const channel = this.rootDataStore.channelStore.get(channelId);

    if (channel == null || !channel.hasEarlierMessages || channel.loadingEarlierMessages) {
      return;
    }

    channel.loadingEarlierMessages = true;
    let until: number | undefined;
    // FIXME: nullable id instead?
    if (channel.minMessageId > 0) {
      until = channel.minMessageId;
    }

    this.api.getMessages(channel.channelId, { until })
      .then((response) => {
        transaction(() => {
          channel.loadingEarlierMessages = false;
          dispatch(new ChatChannelNewMessages(channelId, response));
        });
      }).catch((err) => {
        channel.loadingEarlierMessages = false;
        console.debug('loadChannelEarlierMessages error', err);
      });
  }
}
