// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ChatMessageSendAction } from 'actions/chat-message-send-action';
import { dispatch } from 'app-dispatcher';
import BigButton from 'components/big-button';
import TextareaAutosize from 'components/textarea-autosize';
import { trim } from 'lodash';
import { action, autorun, computed, makeObservable, reaction } from 'mobx';
import { disposeOnUnmount, observer } from 'mobx-react';
import { maxMessageLength } from 'models/chat/channel';
import Message from 'models/chat/message';
import core from 'osu-core-singleton';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import { isModalShowing } from 'utils/modal-helper';
import { present } from 'utils/string';

type Props = Record<string, never>;

@observer
export default class InputBox extends React.Component<Props> {
  private readonly inputBoxRef = React.createRef<HTMLTextAreaElement>();

  get allowMultiLine() {
    return this.isAnnouncement;
  }

  @computed
  get currentChannel() {
    return core.dataStore.chatState.selectedChannel;
  }

  @computed
  get inputDisabled() {
    return !this.currentChannel?.canMessage;
  }

  get isAnnouncement() {
    return this.currentChannel != null && this.currentChannel.type === 'ANNOUNCE';
  }

  @computed
  get sendDisabled() {
    return this.inputDisabled || !core.dataStore.chatState.isReady;
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);

    disposeOnUnmount(
      this,
      autorun(() => {
        if (core.windowFocusObserver.hasFocus) {
          this.focusInput();
        }
      }),
    );

    disposeOnUnmount(
      this,
      reaction(() => this.currentChannel, (newValue, oldValue) => {
        if (newValue != null && newValue !== oldValue && core.windowSize.isDesktop) {
          this.focusInput();
        }
      }),
    );
  }

  buttonClicked = () => {
    this.startSendMessage();
  };

  checkIfEnterPressed = (e: React.KeyboardEvent<HTMLTextAreaElement>) => {
    if (e.key === 'Enter') {
      if (e.shiftKey && this.allowMultiLine) return;

      e.preventDefault();
      if (!this.sendDisabled) {
        this.startSendMessage();
      }
    }
  };

  componentDidMount() {
    this.focusInput();
  }

  focusInput() {
    if (isModalShowing()) return;

    if (this.inputBoxRef.current) {
      this.inputBoxRef.current.focus();
    }
  }

  handleChange = (e: React.ChangeEvent<HTMLTextAreaElement>) => {
    const message = e.target.value;
    this.currentChannel?.setInputText(message);
  };

  render(): React.ReactNode {
    const channel = this.currentChannel;

    const buttonIcon = core.dataStore.chatState.isReady ? 'fas fa-reply' : 'fas fa-times';
    const buttonText = trans(core.dataStore.chatState.isReady ? 'chat.input.send' : 'chat.input.disconnected');

    return (
      <div className='chat-input'>
        <TextareaAutosize
          autoComplete='off'
          className={classWithModifiers('chat-input__box', { disabled: this.inputDisabled })}
          disabled={this.inputDisabled}
          innerRef={this.inputBoxRef}
          maxLength={channel?.messageLengthLimit ?? maxMessageLength}
          maxRows={channel?.type === 'ANNOUNCE' ? 10 : 3}
          name='textbox'
          onChange={this.handleChange}
          onKeyDown={this.checkIfEnterPressed}
          placeholder={this.inputDisabled ? trans('chat.input.disabled') : trans('chat.input.placeholder')}
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

  // TODO: move to channel?
  @action
  sendMessage(messageText?: string) {
    if (this.currentChannel == null
      || messageText == null
      || !present(trim(messageText))) {
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
      if (command !== 'me' || !present(messageText)) {
        return;
      }
    }

    const message = new Message();
    message.senderId = core.currentUserOrFail.id;
    message.channelId = this.currentChannel.channelId;
    message.content = messageText;

    // Technically we don't need to check command here, but doing so in case we add more commands
    if (isCommand && command === 'me') {
      message.isAction = true;
      message.type = 'action';
    } else {
      message.type = this.currentChannel.type === 'ANNOUNCE' ? 'markdown' : 'plain';
    }

    if (this.currentChannel != null) {
      this.currentChannel.uiState.autoScroll = true;
    }

    dispatch(new ChatMessageSendAction(message));
  }

  @action
  private readonly startSendMessage = () => {
    if (this.isAnnouncement && !confirm(trans('common.confirmation'))) {
      return;
    }
    this.sendMessage(this.currentChannel?.inputText);
    this.currentChannel?.setInputText('');
  };
}
