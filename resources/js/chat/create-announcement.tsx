// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BigButton from 'components/big-button';
import InputContainer from 'components/input-container';
import UserCardBrick from 'components/user-card-brick';
import UsernameInput from 'components/username-input';
import UserJson from 'interfaces/user-json';
import { action, computed, makeObservable, runInAction } from 'mobx';
import { observer } from 'mobx-react';
import { isInputKey } from 'models/chat/create-announcement';
import core from 'osu-core-singleton';
import * as React from 'react';
import { trans } from 'utils/lang';

type Props = Record<string, never>;

@observer
export default class CreateAnnouncement extends React.Component<Props> {
  private readonly usernameInputInitialProps;

  @computed
  private get canSend() {
    return core.dataStore.chatState.isReady && !core.dataStore.chatState.isAddingChannel && this.model.isValid;
  }

  @computed
  private get model() {
    return core.dataStore.chatState.createAnnouncement;
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);

    runInAction(() => {
      this.model.initialize();
    });

    this.usernameInputInitialProps = runInAction(() => this.model.propsForUsernameInput);
  }

  render() {
    if (!core.dataStore.chatState.canChatAnnounce) return null;

    return (
      <div className='chat-form'>
        <div className='chat-form__fields'>
          <div className='chat-form__title'>{trans('chat.form.title.announcement')}</div>
          <InputContainer
            labelKey='chat.form.labels.name'
            {...this.model.inputContainerPropsFor('name')}
          >
            <input
              className='input-text'
              defaultValue={this.model.inputs.name}
              name='name'
              onBlur={this.handleBlur}
              onChange={this.handleInput}
            />
          </InputContainer>
          <InputContainer
            labelKey='chat.form.labels.description'
            {...this.model.inputContainerPropsFor('description')}
          >
            <input
              className='input-text'
              defaultValue={this.model.inputs.description}
              name='description'
              onBlur={this.handleBlur}
              onChange={this.handleInput}
            />
          </InputContainer>
          <InputContainer
            for='chat-form-users'
            labelKey='chat.form.labels.users'
            {...this.model.inputContainerPropsFor('users')}
          >
            <div className='input-text'>
              <div className='chat-form-users'>
                <UserCardBrick user={core.currentUserOrFail} />
                <UsernameInput
                  id='chat-form-users'
                  ignoreCurrentUser
                  name='users'
                  onBlur={this.handleBlur}
                  onValidUsersChanged={this.handleValidUsersChanged}
                  onValueChanged={this.handleUsernameInputValueChanged}
                  {...this.usernameInputInitialProps}
                />
              </div>
            </div>
          </InputContainer>
          <InputContainer
            labelKey='chat.form.labels.message'
            modifiers='fill'
            {...this.model.inputContainerPropsFor('message')}
          >
            <textarea
              autoComplete='off'
              className='input-text'
              defaultValue={this.model.inputs.message}
              name='message'
              onBlur={this.handleBlur}
              onChange={this.handleInput}
              placeholder={trans('chat.input.placeholder')}
            />
          </InputContainer>
          <div className='chat-form__button-bar'>
            <BigButton
              disabled={!this.canSend}
              icon='fas fa-bullhorn'
              isBusy={core.dataStore.chatState.isAddingChannel}
              modifiers='chat-send'
              props={{ onClick: this.handleButtonClick }}
              text={trans(core.dataStore.chatState.isReady ? 'chat.input.create' : 'chat.input.disconnected')}
            />
          </div>
        </div>
      </div>
    );
  }

  @action
  private readonly handleBlur = (e: React.FocusEvent<HTMLInputElement> | React.FocusEvent<HTMLTextAreaElement>) => {
    const elem = e.target;

    if (isInputKey(elem.name)) {
      this.model.showError[elem.name] = true;
    }
  };

  @action
  private readonly handleButtonClick = () => {
    core.dataStore.chatState.addChannel();
  };

  @action
  private readonly handleInput = (e: React.ChangeEvent<HTMLInputElement> | React.FormEvent<HTMLTextAreaElement>) => {
    const elem = e.currentTarget;

    if (isInputKey(elem.name)) {
      this.model.inputs[elem.name] = elem.value.trim();
    }
  };

  @action
  private readonly handleUsernameInputValueChanged = (value: string) => {
    this.model.inputs.users = value;
  };

  @action
  private readonly handleValidUsersChanged = (value: Map<number, UserJson>) => {
    this.model.validUsers = value;
  };
}
