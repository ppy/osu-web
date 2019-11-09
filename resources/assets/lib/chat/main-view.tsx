/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

import { ChatChannelSwitchAction } from 'actions/chat-actions';
import Dispatcher from 'dispatcher';
import HeaderV3 from 'header-v3';
import { Img2x } from 'img2x';
import { observer, Provider } from 'mobx-react';
import * as React from 'react';
import RootDataStore from 'stores/root-data-store';
import ChatLogo from './chat-logo';
import ChatWorker from './chat-worker';
import ConversationList from './conversation-list';
import ConversationView from './conversation-view';
import InputBox from './input-box';

interface Props {
  dataStore: RootDataStore;
  dispatcher: Dispatcher;
  initialChannel?: number;
  worker: ChatWorker;
}

@observer
export default class MainView extends React.Component<Props, any> {
  constructor(props: Props) {
    super(props);

    if (this.props.initialChannel) {
      this.props.dispatcher.dispatch(new ChatChannelSwitchAction(this.props.initialChannel));
    }
  }

  componentDidMount() {
    $('html').addClass('osu-layout--mobile-app');
    this.props.worker.startPolling();
  }

  componentWillUnmount() {
    $('html').removeClass('osu-layout--mobile-app');
    this.props.worker.stopPolling();
  }

  render(): React.ReactNode {
    const lazerLink = 'https://github.com/ppy/osu/releases';
    return (
      <div>
        <HeaderV3 compact={true} theme='chat' title='Chat' />
        <Provider dataStore={this.props.dataStore} dispatcher={this.props.dispatcher}>
          {this.props.dataStore.channelStore.loaded ? (
            <div className='chat osu-page osu-page--chat'>
              <div className='chat__sidebar'>
                <ChatLogo />
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
                <Img2x src='/images/layout/chat/none-yet.png' alt='Art by Badou_Rammsteiner' title='Art by Badou_Rammsteiner' />
                <div className='chat__title'>{osu.trans('chat.no-conversations.title')}</div>
                <div className='chat__instructions'>{osu.trans('chat.no-conversations.howto')}</div>
                <div dangerouslySetInnerHTML={{__html: osu.trans('chat.no-conversations.lazer', {link: lazerLink})}} />
                <div dangerouslySetInnerHTML={{__html: osu.trans('chat.no-conversations.pm_limitations', {link: lazerLink})}} />
              </div>
            </div>
          )}
        </Provider>
      </div>
    );
  }
}
