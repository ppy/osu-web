// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ChatChannelSwitchAction, ChatMessageSendAction } from 'actions/chat-actions';
import DispatcherAction from 'actions/dispatcher-action';
import { WindowFocusAction } from 'actions/window-focus-actions';
import { dispatch, dispatchListener } from 'app-dispatcher';
import { BigButton } from 'big-button';
import DispatchListener from 'dispatch-listener';
import * as _ from 'lodash';
import { inject, observer } from 'mobx-react';
import { computed } from 'mobx';
import Message from 'models/chat/message';
import * as React from 'react';
import RootDataStore from 'stores/root-data-store';

interface State {
  messages: { [key: string]: string };
}

@inject('dataStore')
@observer
@dispatchListener
export default class InputBox extends React.Component<any, State> implements DispatchListener {

  state: State = {
    messages: {}
  }

  @computed
  get currentChannel() {
    const dataStore: RootDataStore = this.props.dataStore;
    return dataStore.channelStore.get(dataStore.uiState.chat.selected);
  }

  private inputBoxRef = React.createRef<HTMLInputElement>();

  buttonClicked = () => {
    this.sendMessage(this.getMessage());
    this.setMessage('');
  }

  checkIfEnterPressed = (e: React.KeyboardEvent<HTMLInputElement>) => {
    if (e.keyCode === 13) {
      this.sendMessage(this.getMessage());
      this.setMessage('');
    }
  }

  handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const message = e.target.value;
    this.setMessage(message);
  }

  setMessage = (message: string) => {
    const key = `message-channel--${this.currentChannel?.channelId}`;
    const messages = {...this.state.messages, [key]: message};
    this.setState({ messages });
  }

  getMessage = () => {
    const key = `message-channel--${this.currentChannel?.channelId}`;
    return this.state.messages[key] ?? '';
  }

  componentDidMount() {
    this.focusInput();
  }

  focusInput() {
    if (this.inputBoxRef.current) {
      this.inputBoxRef.current.focus();
    }
  }

  handleDispatchAction(action: DispatcherAction) {
    if (action instanceof WindowFocusAction) {
      this.focusInput();
    } else if (action instanceof ChatChannelSwitchAction) {
      if (osu.isDesktop()) {
        this.focusInput();
      }
    }
  }

  render(): React.ReactNode {
    const channel = this.currentChannel;
    const disableInput = !channel || channel.moderated;

    return (
      <div className='chat-input'>
        <input
          className={`chat-input__box${disableInput ? ' chat-input__box--disabled' : ''}`}
          name='textbox'
          placeholder={disableInput ? osu.trans('chat.input.disabled') : osu.trans('chat.input.placeholder')}
          onKeyDown={this.checkIfEnterPressed}
          disabled={disableInput}
          autoComplete='off'
          ref={this.inputBoxRef}
          onChange={this.handleChange}
          value={this.getMessage()}
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

  sendMessage(messageText?: string) {
    if (!messageText || !osu.present(_.trim(messageText))) {
      return;
    }

    const isCommand = messageText[0] === '/';
    let command: string | null = null;

    if (isCommand) {
      let split = messageText.indexOf(' ');
      if (split === -1) {
        split = messageText.length;
      }

      command = messageText.substring(1, split);
      messageText = _.trim(messageText.substring(split + 1));

      // we only support /me commands for now
      if (command !== 'me' || !osu.present(messageText)) {
        return;
      }
    }

    const message = new Message();
    message.sender = this.props.dataStore.userStore.getOrCreate(currentUser.id);
    message.channelId = this.props.dataStore.uiState.chat.selected;
    message.content = messageText;

    // Technically we don't need to check command here, but doing so in case we add more commands
    if (isCommand && command === 'me') {
      message.isAction = true;
    }

    dispatch(new ChatMessageSendAction(message));
  }
}
