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

import { ChatChannelSwitchAction } from 'actions/chat-actions';
import Dispatcher from 'dispatcher';
import HeaderV3 from 'header-v3';
import { observer, Provider } from 'mobx-react';
import * as React from 'react';
import RootDataStore from 'stores/root-data-store';
import ChatLogo from './chat-logo';
import ChatWorker from './chat-worker';
import ConversationList from './conversation-list';
import ConversationView from './conversation-view';
import InputBox from './input-box';

interface PropsInterface {
  dataStore: RootDataStore;
  dispatcher: Dispatcher;
  initialChannel?: number;
  worker: ChatWorker;
}

@observer
export default class MainView extends React.Component<PropsInterface, any> {
  constructor(props: PropsInterface) {
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
    return(
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
