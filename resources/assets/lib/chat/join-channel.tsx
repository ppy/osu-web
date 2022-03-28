// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BigButton from 'components/big-button';
import { Spinner } from 'components/spinner';
import UserCardBrick from 'components/user-card-brick';
import UserJson from 'interfaces/user-json';
import { action, computed, makeObservable, } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import TextareaAutosize from 'react-autosize-textarea/lib';
import { classWithModifiers } from 'utils/css';

type Props = Record<string, never>;

interface InputContainerProps {
  error: boolean;
  labelKey?: string;
}

const BusySpinner = ({ busy }: { busy: boolean }) => (
  <div className='chat-join-channel__spinner'>
    {busy && <Spinner />}
  </div>
);

// TODO: look at combining with ValidatingInput
const InputContainer = observer((props: React.PropsWithChildren<InputContainerProps>) => (
  <div className={classWithModifiers('chat-join-channel__input-container', { error: props.error })}>
    {props.labelKey && (
      <label className='chat-join-channel__input-label'>{osu.trans(props.labelKey)}</label>
    )}
    {props.children}
  </div>
));

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
          <InputContainer error={this.model.errors.name} labelKey='chat.join_channel.labels.name'>
            <input
              className='chat-join-channel__input'
              defaultValue={this.model.inputs.name}
              name='name'
              onChange={this.handleInput}
            />
          </InputContainer>
          <InputContainer error={this.model.errors.description} labelKey='chat.join_channel.labels.description'>
            <input
              className='chat-join-channel__input'
              defaultValue={this.model.inputs.description}
              name='description'
              onChange={this.handleInput}
            />
          </InputContainer>
          <InputContainer error={this.model.errors.users} labelKey='chat.join_channel.labels.users'>
            <div className='chat-join-channel__users-input'>
              <div className='chat-join-channel__users'>
                {this.renderValidUsers()}
              </div>
              <input
                className='chat-join-channel__users-text'
                onChange={this.handleUsersInputChange}
                onKeyDown={this.handleUsersInputKeyDown}
                onPaste={this.handleUsersInputPaste}
                value={this.model.inputs.users}
              />
              <BusySpinner busy={this.model.busy.lookupUsers} />
            </div>
          </InputContainer>
          <InputContainer error={this.model.errors.message}>
            <TextareaAutosize
              autoComplete='off'
              className='chat-join-channel__box'
              defaultValue={this.model.inputs.message}
              maxRows={10}
              name='message'
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
  private handleButtonClick = () => {
    this.model.create();
  };

  @action
  private handleInput = (e: React.ChangeEvent<HTMLInputElement> | React.FormEvent<HTMLTextAreaElement>) => {
    const elem = e.currentTarget;

    this.model.inputs[elem.name] = elem.value.trim();
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
