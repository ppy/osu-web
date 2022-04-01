// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import HeaderV4 from 'components/header-v4';
import Img2x from 'components/img2x';
import { action, autorun, makeObservable, runInAction } from 'mobx';
import { disposeOnUnmount, observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import ConversationList from './conversation-list';
import ConversationPanel from './conversation-panel';

const lazerLink = 'https://github.com/ppy/osu/releases';

@observer
export default class MainView extends React.Component<Record<string, never>> {
  constructor(props: Record<string, never>) {
    super(props);

    makeObservable(this);

    disposeOnUnmount(
      this,
      autorun(() => {
        if (core.dataStore.chatState.isChatMounted) {
          // This keeps the body element (not the html element) from rubberbanding on mobile Safari
          // when scroll hits the end.
          document.documentElement.classList.add('u-chat');
        } else {
          document.documentElement.classList.remove('u-chat');
        }
      }),
    );
  }

  @action
  componentDidMount() {
    core.dataStore.chatState.viewsMounted.add(this);
  }

  componentWillUnmount() {
    runInAction(() => {
      core.dataStore.chatState.viewsMounted.delete(this);
    });
  }

  render() {
    return (
      <>
        <HeaderV4 theme='chat' />
        {core.dataStore.channelStore.channels.size > 0 ? (
          <div className='chat osu-page osu-page--chat'>
            <div className='chat__sidebar'>
              <ConversationList />
            </div>
            <div className='chat__conversation-area'>
              <ConversationPanel />
            </div>
          </div>
        ) : (
          <div className='chat osu-page osu-page--chat'>
            <div className='chat__not-active'>
              <Img2x alt='Art by Badou_Rammsteiner' src='/images/layout/chat/none-yet.png' title='Art by Badou_Rammsteiner' />
              <div className='chat__title'>{osu.trans('chat.no-conversations.title')}</div>
              <div className='chat__instructions'>{osu.trans('chat.no-conversations.howto')}</div>
              <div dangerouslySetInnerHTML={{__html: osu.trans('chat.no-conversations.lazer', {link: lazerLink})}} />
            </div>
          </div>
        )}
      </>
    );
  }
}
