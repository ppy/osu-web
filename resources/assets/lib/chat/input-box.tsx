// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ChatMessageSendAction } from 'actions/chat-message-send-action';
import DispatcherAction from 'actions/dispatcher-action';
import { WindowFocusAction } from 'actions/window-focus-actions';
import { dispatch, dispatcher } from 'app-dispatcher';
import BigButton from 'big-button';
import DispatchListener from 'dispatch-listener';
import { trim } from 'lodash';
import { computed, makeObservable, observe } from 'mobx';
import { disposeOnUnmount, inject, observer } from 'mobx-react';
import Message from 'models/chat/message';
import core from 'osu-core-singleton';
import * as React from 'react';
import TextareaAutosize from 'react-autosize-textarea';
import RootDataStore from 'stores/root-data-store';

interface Props {
  dataStore?: RootDataStore;
}

@inject('dataStore')
@observer
export default class InputBox extends React.Component<Props> implements DispatchListener {
  readonly dataStore: RootDataStore = this.props.dataStore!;

  private inputBoxRef = React.createRef<HTMLTextAreaElement>();

  @computed
  get currentChannel() {
    return this.dataStore.chatState.selectedChannel;
  }

  @computed
  get inputDisabled() {
    return !this.currentChannel?.canMessage;
  }

  @computed
  get sendDisabled() {
    return this.inputDisabled || !this.dataStore.chatState.isReady;
  }

  constructor(props: Props) {
    super(props);

    dispatcher.register(this);

    makeObservable(this);

    disposeOnUnmount(
      this,
      observe(this.dataStore.chatState.selectedBoxed, (change) => {
        if (change.newValue !== change.oldValue && core.windowSize.isDesktop) {
          this.focusInput();
        }
      }),
    );
  }

  buttonClicked = () => {
    this.sendMessage(this.currentChannel?.inputText);
    this.currentChannel?.setInputText('');
  };

  checkIfEnterPressed = (e: React.KeyboardEvent<HTMLTextAreaElement>) => {
    if (e.keyCode === 13) {
      e.preventDefault();
      if (!this.sendDisabled) {
        this.sendMessage(this.currentChannel?.inputText);
        this.currentChannel?.setInputText('');
      }
    }
  };

  componentDidMount() {
    this.focusInput();
  }

  componentWillUnmount() {
    dispatcher.unregister(this);
  }

  focusInput() {
    if (this.inputBoxRef.current) {
      this.inputBoxRef.current.focus();
    }
  }

  handleChange = (e: React.ChangeEvent<HTMLTextAreaElement>) => {
    const message = e.target.value;
    this.currentChannel?.setInputText(message);
  };

  handleDispatchAction(action: DispatcherAction) {
    if (action instanceof WindowFocusAction) {
      this.focusInput();
    }
  }

  render(): React.ReactNode {
    const channel = this.currentChannel;
    const buttonIcon = this.dataStore.chatState.isReady ? 'fas fa-reply' : 'fas fa-times';
    const buttonText = osu.trans(this.dataStore.chatState.isReady ? 'chat.input.send' : 'chat.input.disconnected');

    return (
      <div className='chat-input'>
        <TextareaAutosize
          ref={this.inputBoxRef}
          autoComplete='off'
          className={`chat-input__box${this.inputDisabled ? ' chat-input__box--disabled' : ''}`}
          disabled={this.inputDisabled}
          maxRows={3}
          name='textbox'
          onChange={this.handleChange}
          onKeyDown={this.checkIfEnterPressed}
          placeholder={this.inputDisabled ? osu.trans('chat.input.disabled') : osu.trans('chat.input.placeholder')}
          value={channel?.inputText}
        />

        <BigButton
          disabled={this.sendDisabled}
          icon={buttonIcon}
          modifiers='chat-send'
          props={{
            onClick: this.buttonClicked,
          }}
          text={buttonText}
        />
      </div>
    );
  }

  sendMessage(messageText?: string) {
    if (!messageText || !osu.present(trim(messageText))) {
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
      messageText = trim(messageText.substring(split + 1));

      // we only support /me commands for now
      if (command !== 'me' || !osu.present(messageText)) {
        return;
      }
    }

    const message = new Message();
    message.senderId = currentUser.id;
    message.channelId = this.dataStore.chatState.selected;
    message.content = messageText;

    // Technically we don't need to check command here, but doing so in case we add more commands
    if (isCommand && command === 'me') {
      message.isAction = true;
    }

    dispatch(new ChatMessageSendAction(message));
  }
}
