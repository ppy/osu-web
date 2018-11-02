/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
import { inject, observer } from 'mobx-react';
import Channel from 'models/chat/channel';
import Message from 'models/chat/message';
import * as React from 'react';
import RootDataStore from 'stores/root-data-store';

@inject('dataStore')
@inject('dispatcher')
@observer
export default class InputBox extends React.Component<any, any> {
  sendMessage(messageText?: string) {
    if (!messageText || _.trim(messageText) === '') {
      return;
    }

    const message: Message = new Message();
    message.sender = this.props.dataStore.userStore.getOrCreate(currentUser.id);
    message.channelId = this.props.dataStore.uiState.chat.selected;
    message.content = _.trim(messageText);

    this.props.dispatcher.dispatch(new ChatMessageSendAction(message));
  }

  buttonClicked = (e: React.MouseEvent<HTMLElement>) => {
    const target = $(e.currentTarget).parent().children('input')[0] as HTMLInputElement;
    const message: string = target.value || '';
    this.sendMessage(message);
    target.value = '';
  }

  checkIfEnterPressed = (e: React.KeyboardEvent<HTMLInputElement>) => {
    if (e.keyCode === 13) {
      const target = $(e.currentTarget)[0] as HTMLInputElement;
      const message: string = target.value || '';
      this.sendMessage(message);
      target.value = '';
    }
  }

  render(): React.ReactNode {
    const dataStore: RootDataStore = this.props.dataStore;
    const selectedChan: number = dataStore.uiState.chat.selected;

    let disableInput: boolean = false;
    if (dataStore.channelStore.channels.has(selectedChan)) {
      const channel: Channel = dataStore.channelStore.getOrCreate(selectedChan);
      disableInput = channel.moderated;
    }

    return (
      <div className='chat-input'>
        <input className={`chat-input__box${disableInput ? ' chat-input__box--disabled' : ''}`}
          name= 'textbox'
          placeholder={disableInput ? osu.trans('chat.input.disabled') : osu.trans('chat.input.placeholder')}
          onKeyDown={this.checkIfEnterPressed}
          disabled={disableInput}
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
