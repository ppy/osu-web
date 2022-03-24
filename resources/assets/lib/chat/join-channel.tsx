// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BigButton from 'components/big-button';
import { Spinner } from 'components/spinner';
import UserCardBrick from 'components/user-card-brick';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import { debounce } from 'lodash';
import { action, computed, makeObservable, observable, runInAction } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import TextareaAutosize from 'react-autosize-textarea/lib';
import { classWithModifiers } from 'utils/css';
import { createAnnoucement } from './chat-api';

type Props = Record<string, never>;

interface InputContainerProps {
  error: boolean;
  labelKey?: string;
}

interface Inputs {
  description: string;
  message: string;
  name: string;
  users: string;
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
  @observable private busy = {
    lookupUsers: false,
  };
  // delay needs to shorter when copy and paste, or need to be a discrete action
  private debouncedLookupUsers = debounce(action(() => this.lookupUsers()), 1000);
  @observable
  private inputs: Record<keyof Inputs, string> & Partial<Record<string, string>> = {
    description: '',
    message: '',
    name: '',
    users: '',
  };
  @observable private validUsers = new Map<number, UserJson>();

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  @computed
  get errors() {
    return {
      description: !osu.present(this.inputs.description),
      message: !osu.present(this.inputs.message),
      name: !osu.present(this.inputs.name),
      users: this.validUsers.size === 0
        || osu.present(this.inputs.users.trim()), // implies invalid ids left
    };
  }

  @computed
  get canView() {
    const currentUser = core.currentUserOrFail;
    return currentUser.is_admin || currentUser.is_moderator || core.currentUserModel.inGroup('announce');
  }

  @computed
  get isValid() {
    return !Object.values(this.errors).some(Boolean);
  }

  render() {
    if (!this.canView) return null;

    return (
      <div className='chat-join-channel'>
        <div className='chat-join-channel__title'>{osu.trans('chat.join_channel.title.announcement')}</div>
        <InputContainer error={this.errors.name} labelKey='chat.join_channel.labels.name'>
          <input
            className='chat-join-channel__input'
            name='name'
            onChange={this.handleInput}
          />
        </InputContainer>
        <InputContainer error={this.errors.description} labelKey='chat.join_channel.labels.description'>
          <input
            className='chat-join-channel__input'
            name='description'
            onChange={this.handleInput}
          />
        </InputContainer>
        <InputContainer error={this.errors.users} labelKey='chat.join_channel.labels.users'>
          <div className='chat-join-channel__users-input'>
            <div className='chat-join-channel__users'>
              {this.renderValidUsers()}
            </div>
            <input
              className='chat-join-channel__users-text'
              onChange={this.handleUsersInputChange}
              onKeyUp={this.handleUsersInputKeyUp}
              onPaste={this.handleUsersInputPaste}
              value={this.inputs.users}
            />
            <BusySpinner busy={this.busy.lookupUsers} />
          </div>
        </InputContainer>
        <InputContainer error={this.errors.message}>
          <TextareaAutosize
            autoComplete='off'
            className='chat-join-channel__box'
            maxRows={10}
            name='message'
            onChange={this.handleInput}
            placeholder={osu.trans('chat.input.placeholder')}
            rows={10}
          />
        </InputContainer>
        <div className='chat-join-channel__button-bar'>
          <BigButton
            disabled={!this.isValid}
            modifiers='chat-send'
            props={{ onClick: this.handleButtonClick }}
            text={osu.trans('common.buttons.create')}
          />
        </div>
      </div>
    );
  }

  renderValidUsers() {
    return [...this.validUsers.values()].map((user) => (
      <UserCardBrick key={user.id} modifiers='fit' onRemoveClick={this.handleRemoveUser} user={user} />
    ));
  }

  /**
   * Disassembles and extract valid users from the string.
   */
  @action
  private extractValidUsers() {
    const userIds = this.inputs.users.split(',');
    if (userIds.length === 0) return false;

    const invalidUsers: string[] = [];

    for (const userId of userIds) {
      const trimmedUserId = osu.presence(userId.trim());

      if (!this.validUsersContains(trimmedUserId)) {
        invalidUsers.push(userId);
      }
    }

    this.inputs.users = invalidUsers.join(',');
  }

  private fetchUsers(ids: (string | null)[]) {
    return $.getJSON(route('chat.users.index'), { ids }) as JQuery.jqXHR<{ users: UserJson[] }>;
  }

  @action
  private handleButtonClick = () => {
    const { description, message, name } = this.inputs;

    core.dataStore.chatState.waitJoinChannelUuid = osu.uuid();

    createAnnoucement({
      channel: { description, name },
      message,
      target_ids: [...this.validUsers.keys()],
      type: 'ANNOUNCE',
      uuid: core.dataStore.chatState.waitJoinChannelUuid,
    });
  };

  @action
  private handleInput = (e: React.ChangeEvent<HTMLInputElement> | React.FormEvent<HTMLTextAreaElement>) => {
    const elem = e.currentTarget;

    this.inputs[elem.name] = elem.value.trim();
  };

  @action
  private handleRemoveUser = (user: UserJson) => {
    this.validUsers.delete(user.id);
  };

  @action
  private handleUsersInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    this.debouncedLookupUsers.cancel();
    this.inputs.users = e.currentTarget.value;
    this.debouncedLookupUsers();
  };

  @action
  private handleUsersInputKeyUp = (e: React.KeyboardEvent<HTMLInputElement>) => {
    if (e.key === 'Backspace' && this.inputs.users.length === 0) {
      const last = [...this.validUsers.keys()].pop();
      if (last != null) {
        this.validUsers.delete(last);
      }
    }
  };

  @action
  private handleUsersInputPaste = (e: React.SyntheticEvent<HTMLInputElement>) => {
    this.debouncedLookupUsers.cancel();
    this.inputs.users = e.currentTarget.value;
    this.debouncedLookupUsers();
    this.debouncedLookupUsers.flush();
  };

  @action
  private async lookupUsers() {
    this.busy.lookupUsers = true;
    this.debouncedLookupUsers.cancel();

    const userIds = this.inputs.users.split(',').map((s) => osu.presence(s.trim())).filter(Boolean);
    if (userIds.length === 0) {
      this.busy.lookupUsers = false;
      return;
    }

    try {
      const response = await this.fetchUsers(userIds);
      runInAction(() => {
        for (const user of response.users) {
          this.validUsers.set(user.id, user);
        }

        this.extractValidUsers();
      });
    } finally {
      runInAction(() => this.busy.lookupUsers = false);
    }
  }

  private validUsersContains(userId?: string | null) {
    if (userId == null) return false;

    if (this.validUsers.has(Number.parseInt(userId, 10))) return true;

    // maybe it's a username
    for (const user of this.validUsers.values()) {
      if (user.username === userId) return true;
    }

    return false;
  }
}
