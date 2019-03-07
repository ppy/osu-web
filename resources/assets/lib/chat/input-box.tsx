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

import { ChatMessageSendAction } from 'actions/chat-actions';
import DispatcherAction from 'actions/dispatcher-action';
import { WindowFocusAction } from 'actions/window-focus-actions';
import DispatchListener from 'dispatch-listener';
import * as _ from 'lodash';
import { inject, observer } from 'mobx-react';
import Message from 'models/chat/message';
import * as React from 'react';
import RootDataStore from 'stores/root-data-store';

@inject('dataStore')
@inject('dispatcher')
@observer
export default class InputBox extends React.Component<any, any> implements DispatchListener {
  private inputBoxRef = React.createRef<HTMLInputElement>();

  constructor(props: {}) {
    super(props);
    this.props.dispatcher.register(this);
  }

  handleDispatchAction(action: DispatcherAction) {
    if (action instanceof WindowFocusAction) {
      this.focusInput();
    }
  }

  componentDidMount() {
    this.focusInput();
  }

  sendMessage(messageText?: string) {
    if (!messageText || _.trim(messageText) === '') {
      return;
    }

    const message = new Message();
    message.sender = this.props.dataStore.userStore.getOrCreate(currentUser.id);
    message.channelId = this.props.dataStore.uiState.chat.selected;
    message.content = _.trim(messageText);

    this.props.dispatcher.dispatch(new ChatMessageSendAction(message));
  }

  buttonClicked = (e: React.MouseEvent<HTMLElement>) => {
    const target = $(e.currentTarget).parent().children('input')[0] as HTMLInputElement;
    const message = target.value || '';
    this.sendMessage(message);
    target.value = '';
  }

  checkIfEnterPressed = (e: React.KeyboardEvent<HTMLInputElement>) => {
    if (e.keyCode === 13) {
      const target = $(e.currentTarget)[0] as HTMLInputElement;
      const message = target.value || '';
      this.sendMessage(message);
      target.value = '';
    }
  }

  focusInput() {
    if (this.inputBoxRef.current) {
      this.inputBoxRef.current.focus();
    }
  }

  render(): React.ReactNode {
    const dataStore: RootDataStore = this.props.dataStore;
    const channel = dataStore.channelStore.get(dataStore.uiState.chat.selected);
    const disableInput = !channel || channel.moderated;

    return (
      <div className='chat-input'>
        <input className={`chat-input__box${disableInput ? ' chat-input__box--disabled' : ''}`}
          name='textbox'
          placeholder={disableInput ? osu.trans('chat.input.disabled') : osu.trans('chat.input.placeholder')}
          onKeyDown={this.checkIfEnterPressed}
          disabled={disableInput}
          ref={this.inputBoxRef}
        />

        <BigButton
          text={osu.trans('chat.input.send')}
          icon='fas fa-reply'
          modifiers={['chat-send']}
          props={{
            disabled: disableInput,
            onClick: this.buttonClicked,
          }}
        />
      </div>
    );
  }
}
