// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BigButton from 'components/big-button';
import InputContainer from 'components/input-container';
import { Spinner } from 'components/spinner';
import UserCardBrick from 'components/user-card-brick';
import UserJson from 'interfaces/user-json';
import { action, computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import { isInputKey } from 'models/chat/create-announcement';
import core from 'osu-core-singleton';
import * as React from 'react';

type Props = Record<string, never>;

const BusySpinner = ({ busy }: { busy: boolean }) => (
  <div className='chat-join-channel__spinner'>
    {busy && <Spinner />}
  </div>
);

@observer
export default class JoinChannel extends React.Component<Props> {
  @computed
  get canView() {
    const currentUser = core.currentUserOrFail;
    return currentUser.is_admin || currentUser.is_moderator || core.currentUserModel.inGroup('announce');
  }

  @computed
  get canSend() {
    return core.dataStore.chatState.isReady && !this.model.busy.create && this.model.isValid;
  }

  @computed
  get model() {
    return core.dataStore.chatState.createAnnoucement;
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  render() {
    if (!this.canView) return null;

    return (
      <div className='chat-join-channel'>
        <div className='chat-join-channel__fields'>
          <div className='chat-join-channel__title'>{osu.trans('chat.join_channel.title.announcement')}</div>
          <InputContainer labelKey='chat.join_channel.labels.name' model={this.model} name='name'>
            <input
              className='chat-join-channel__input'
              defaultValue={this.model.inputs.name}
              name='name'
              onBlur={this.handleBlur}
              onChange={this.handleInput}
            />
          </InputContainer>
          <InputContainer labelKey='chat.join_channel.labels.description' model={this.model} name='description'>
            <input
              className='chat-join-channel__input'
              defaultValue={this.model.inputs.description}
              name='description'
              onBlur={this.handleBlur}
              onChange={this.handleInput}
            />
          </InputContainer>
          <InputContainer labelKey='chat.join_channel.labels.users' model={this.model} name='users'>
            <div className='chat-join-channel__users-input'>
              <div className='chat-join-channel__users'>
                {this.renderValidUsers()}
              </div>
              <input
                className='chat-join-channel__users-text'
                name='users'
                onBlur={this.handleBlur}
                onChange={this.handleUsersInputChange}
                onKeyDown={this.handleUsersInputKeyDown}
                onPaste={this.handleUsersInputPaste}
                value={this.model.inputs.users}
              />
              <BusySpinner busy={this.model.busy.lookupUsers} />
            </div>
          </InputContainer>
          <InputContainer model={this.model} name='message'>
            <textarea
              autoComplete='off'
              className='chat-join-channel__box'
              defaultValue={this.model.inputs.message}
              name='message'
              onBlur={this.handleBlur}
              onChange={this.handleInput}
              placeholder={osu.trans('chat.input.placeholder')}
              rows={10}
            />
          </InputContainer>
        </div>
        <div className='chat-join-channel__button-bar'>
          <BigButton
            disabled={!this.canSend}
            icon='fas fa-bullhorn'
            isBusy={this.model.busy.create}
            modifiers='chat-send'
            props={{ onClick: this.handleButtonClick }}
            text={osu.trans(core.dataStore.chatState.isReady ? 'chat.input.create' : 'chat.input.disconnected')}
          />
        </div>
      </div>
    );
  }

  renderValidUsers() {
    return [...this.model.validUsers.values()].map((user) => (
      <UserCardBrick key={user.id} modifiers='fit' onRemoveClick={this.handleRemoveUser} user={user} />
    ));
  }

  @action
  private handleBlur = (e: React.FocusEvent<HTMLInputElement> | React.FocusEvent<HTMLTextAreaElement>) => {
    const elem = e.target;

    if (isInputKey(elem.name)) {
      this.model.showError[elem.name] = true;
    }
  };

  @action
  private handleButtonClick = () => {
    this.model.create();
  };

  @action
  private handleInput = (e: React.ChangeEvent<HTMLInputElement> | React.FormEvent<HTMLTextAreaElement>) => {
    const elem = e.currentTarget;

    if (isInputKey(elem.name)) {
      this.model.inputs[elem.name] = elem.value.trim();
    }
  };

  @action
  private handleRemoveUser = (user: UserJson) => {
    this.model.validUsers.delete(user.id);
  };

  @action
  private handleUsersInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    this.model.updateUsers(e.currentTarget.value, false);
  };

  @action
  private handleUsersInputKeyDown = (e: React.KeyboardEvent<HTMLInputElement>) => {
    if (e.key === 'Backspace' && this.model.inputs.users.length === 0) {
      const last = [...this.model.validUsers.keys()].pop();
      if (last != null) {
        this.model.validUsers.delete(last);
      }
    }
  };

  @action
  private handleUsersInputPaste = (e: React.SyntheticEvent<HTMLInputElement>) => {
    this.model.updateUsers(e.currentTarget.value, true);
  };
}
