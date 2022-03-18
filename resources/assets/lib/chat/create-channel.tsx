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
import * as React from 'react';
import TextareaAutosize from 'react-autosize-textarea/lib';
import { createAnnoucement } from './chat-api';

type Props = Record<string, never>;

interface Inputs {
  description: string;
  message: string;
  name: string;
}

const BusySpinner = ({ busy }: { busy: boolean }) => (
  <div className='chat-create-channel__spinner'>
    {busy && <Spinner />}
  </div>
);

@observer
export default class CreateChannel extends React.Component<Props> {
  @observable private busy = {
    lookupUsers: false,
  };
  // delay needs to shorter when copy and paste, or need to be a discrete action
  private debouncedLookupUsers = debounce(this.lookupUsers, 1000);
  @observable
  private inputs: Record<keyof Inputs, string> & Partial<Record<string, string>> = {
    description: '',
    message: '',
    name: '',
  };
  @observable private usersText = '';
  @observable private validUsers = new Map<number, UserJson>();

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  @computed
  get isValid() {
    return this.validUsers.size > 0
      && !osu.present(this.usersText.trim()) // implies no invalid ids left
      && Object.values(this.inputs).every(osu.present);
  }

  render() {
    return (
      <div className='chat-create-channel'>
        <div className='chat-create-channel__title'>Create New Announcement</div>
        <div className='chat-create-channel__input-container'>
          <label className='chat-create-channel__input-label'>room name</label>
          <input
            className='chat-create-channel__input'
            name='name'
            onChange={this.handleInput}
          />
        </div>
        <div className='chat-create-channel__input-container'>
          <label className='chat-create-channel__input-label'>description</label>
          <input
            className='chat-create-channel__input'
            name='description'
            onChange={this.handleInput}
          />
        </div>
        <div className='chat-create-channel__input-container'>
          <label className='chat-create-channel__input-label'>players to invite</label>
          <div className='chat-create-channel__users-input'>
            <div className='chat-create-channel__users'>
              {this.renderValidUsers()}
            </div>
            <input
              className='chat-create-channel__users-text'
              onChange={this.handleUsersInputChange}
              onPaste={this.handleUsersInputPaste}
              value={this.usersText}
            />
            <BusySpinner busy={this.busy.lookupUsers} />
          </div>
        </div>
        <div className='chat-create-channel__input-container'>
          <TextareaAutosize
            autoComplete='off'
            className='chat-create-channel__box'
            maxRows={10}
            name='message'
            onChange={this.handleInput}
            placeholder={osu.trans('chat.input.placeholder')}
            rows={10}
          />
        </div>
        <div className='chat-create-channel__button-bar'>
          <BigButton
            disabled={!this.isValid}
            modifiers='chat-send'
            props={{ onClick: this.handleButtonClick }}
            text='Create'
          />
        </div>
      </div>
    );
  }

  renderValidUsers() {
    return [...this.validUsers.values()].map((user) => (
      <UserCardBrick key={user.id} modifiers='fit' user={user} />
    ));
  }

  /**
   * Disassembles and extract valid users from the string.
   */
  @action
  private extractValidUsers() {
    const userIds = this.usersText.split(',');
    if (userIds.length === 0) return false;

    const invalidUsers: string[] = [];

    for (const userId of userIds) {
      const trimmedUserId = osu.presence(userId.trim());

      if (!this.validUsersContains(trimmedUserId)) {
        invalidUsers.push(userId);
      }
    }

    this.usersText = invalidUsers.join(',');
  }

  private fetchUsers(ids: (string | null)[]) {
    return $.getJSON(route('users.index'), { ids }) as JQuery.jqXHR<{ users: UserJson[] }>;
  }

  private handleButtonClick = () => {
    const { description, message, name } = this.inputs;

    createAnnoucement({
      channel: { description, name },
      message,
      target_ids: [...this.validUsers.keys()],
      type: 'ANNOUNCE',
    });
  };

  @action
  private handleInput = (e: React.ChangeEvent<HTMLInputElement> | React.FormEvent<HTMLTextAreaElement>) => {
    const elem = e.currentTarget;

    this.inputs[elem.name] = elem.value.trim();
  };

  @action
  private handleUsersInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    this.debouncedLookupUsers.cancel();
    this.usersText = e.currentTarget.value;
    this.debouncedLookupUsers();
  };

  private handleUsersInputPaste = (e: React.SyntheticEvent<HTMLInputElement>) => {
    this.debouncedLookupUsers.cancel();
    this.usersText = e.currentTarget.value;
    this.debouncedLookupUsers();
    this.debouncedLookupUsers.flush();
  };

  @action
  private async lookupUsers() {
    this.busy.lookupUsers = true;
    this.debouncedLookupUsers.cancel();

    const userIds = this.usersText.split(',').map((s) => osu.presence(s.trim()));

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
