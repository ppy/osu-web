// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import HeaderV4 from 'header-v4';
import Img2x from 'img2x';
import { observer, Provider } from 'mobx-react';
import * as React from 'react';
import RootDataStore from 'stores/root-data-store';
import ConversationList from './conversation-list';
import ConversationView from './conversation-view';
import InputBox from './input-box';

interface Props {
  dataStore: RootDataStore;
}

@observer
export default class MainView extends React.Component<Props> {
  componentDidMount() {
    $('html').addClass('osu-layout--mobile-app');
  }

  componentWillUnmount() {
    $('html').removeClass('osu-layout--mobile-app');
  }

  render(): React.ReactNode {
    const lazerLink = 'https://github.com/ppy/osu/releases';
    return (
      <>
        <HeaderV4 theme='chat' />
        <Provider dataStore={this.props.dataStore}>
          {this.props.dataStore.channelStore.channels.size > 0 ? (
            <div className='chat osu-page osu-page--chat'>
              <div className='chat__sidebar'>
                <ConversationList />
              </div>
              <div className='chat__conversation-area'>
                <ConversationView />
                <InputBox />
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
        </Provider>
      </>
    );
  }
}
