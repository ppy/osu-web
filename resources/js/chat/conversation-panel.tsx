// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Img2x from 'components/img2x';
import { autorun } from 'mobx';
import { observer } from 'mobx-react';
import Channel from 'models/chat/channel';
import core from 'osu-core-singleton';
import * as React from 'react';
import { trans } from 'utils/lang';
import ConversationView from './conversation-view';
import CreateAnnouncement from './create-announcement';
import JoinChannels from './join-channels';

const lazerLink = 'https://github.com/ppy/osu/releases';

@observer
export default class ConversationPanel extends React.Component<Record<string, never>> {
  private readonly disposer: ReturnType<typeof autorun>;
  private navigatingAway = false;

  constructor(props: Record<string, never>) {
    super(props);

    document.addEventListener('turbo:before-cache', this.handleBeforeCache);

    this.disposer = autorun(() => {
      // Don't set title if this is on the document that is going away.
      // before-cache should be running before the autorun.
      if (!this.navigatingAway) {
        const selectedChannelOrType = core.dataStore.chatState.selectedChannelOrType;
        const channelName = selectedChannelOrType instanceof Channel
          ? selectedChannelOrType.name
          : trans(`chat.channels.${selectedChannelOrType ?? 'none'}`);

        core.browserTitleWithNotificationCount.title = `${channelName} · ${trans('page_title.main.chat_controller._')}`;
      }
    });
  }

  componentWillUnmount() {
    this.disposer();
    document.removeEventListener('turbo:before-cache', this.handleBeforeCache);

    if (!core.dataStore.chatState.isChatMounted) {
      core.browserTitleWithNotificationCount.title = null;
    }
  }

  readonly handleBeforeCache = () => {
    this.navigatingAway = true;
  };

  render() {
    return (
      <div className='chat-conversation-panel'>
        {this.renderContent()}
      </div>
    );
  }

  renderContent() {
    const selected = core.dataStore.chatState.selectedChannelOrType;

    if (selected === 'create') {
      return <CreateAnnouncement />;
    }

    if (selected === 'join') {
      return <JoinChannels />;
    }

    if (selected != null) {
      return <ConversationView />;
    }

    return (
      <div className='chat-conversation-panel__no-channel'>
        <Img2x alt='Art by Badou_Rammsteiner' src='/images/layout/chat/none-yet.png' title='Art by Badou_Rammsteiner' />
        {core.dataStore.channelStore.channels.size > 0 ? (
          <>
            <div className='chat-conversation-panel__title'>{trans('chat.not_found.title')}</div>
            <div className='chat-conversation-panel__instructions'>{trans('chat.not_found.message')}</div>
          </>
        ) : (
          <>
            <div className='chat-conversation-panel__title'>{trans('chat.no-conversations.title')}</div>
            <div className='chat-conversation-panel__instructions'>{trans('chat.no-conversations.howto')}</div>
            <div dangerouslySetInnerHTML={{ __html: trans('chat.no-conversations.lazer', { link: lazerLink }) }} />
          </>
        )}
      </div>
    );
  }
}
