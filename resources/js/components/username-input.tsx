// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import { debounce } from 'lodash';
import { action, makeObservable, observable, runInAction } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { isJqXHR, onError } from 'utils/ajax';
import { presence } from 'utils/string';
import { Spinner } from './spinner';
import UserCardBrick from './user-card-brick';

interface Props {
  defaultValue?: string;
  id?: string;
  ignoreCurrentUser?: boolean;
  name?: string;
  onBlur?: (e: React.FocusEvent<HTMLInputElement>) => void;
  onValidUsersChanged?: (value: Map<number, UserJson>) => void;
  onValueChanged?: (value: string) => void;
}

const BusySpinner = ({ busy }: { busy: boolean }) => (
  <div className='chat-form__spinner'>
    {busy && <Spinner />}
  </div>
);

@observer
export default class UsernameInput extends React.PureComponent<Props> {
  @observable users: string = '';
  @observable validUsers = new Map<number, UserJson>();
  @observable private busy = false;
  private readonly debouncedLookupUsers = debounce(() => this.lookupUsers(), 1000);
  private xhrLookupUsers?: JQuery.jqXHR<{ users: UserJson[] }>;

  constructor(props: Props) {
    super(props);

    makeObservable(this);

    if (this.props.defaultValue != null) {
      this.updateUsers(this.props.defaultValue, true);
    }
  }

  componentWillUnmount() {
    this.debouncedLookupUsers.cancel();
    this.xhrLookupUsers?.abort();
  }

  render() {
    return (
      <>
        {this.renderValidUsers()}
        <input
          className='chat-form__input chat-form__input--users'
          id={this.props.id}
          name={this.props.name}
          onBlur={this.handleBlur}
          onChange={this.handleUsersInputChange}
          onKeyDown={this.handleUsersInputKeyDown}
          onPaste={this.handleUsersInputPaste}
          value={this.users}
        />
        <BusySpinner busy={this.busy} />
      </>
    );
  }

  /**
   * Disassembles and extract valid users from the string.
   */
  @action
  private extractValidUsers(users: UserJson[]) {
    const userIds = this.users.split(',');

    for (const user of users) {
      this.validUsers.set(user.id, user);
    }

    const invalidUsers: string[] = [];

    for (const userId of userIds) {
      const trimmedUserId = presence(userId.trim());

      if (!this.validUsersContains(trimmedUserId)) {
        invalidUsers.push(userId);
      }
    }

    this.users = invalidUsers.join(',');

    if (this.props.ignoreCurrentUser ?? false) {
      this.validUsers.delete(core.currentUserOrFail.id);
    }

    this.props.onValueChanged?.(this.users);
    this.props.onValidUsersChanged?.(this.validUsers);
  }

  @action
  private readonly handleBlur = (e: React.FocusEvent<HTMLInputElement>) => {
    this.props.onBlur?.(e);
  };

  @action
  private readonly handleRemoveUser = (user: UserJson) => {
    this.validUsers.delete(user.id);
    this.props.onValidUsersChanged?.(this.validUsers);
  };

  @action
  private readonly handleUsersInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    this.updateUsers(e.currentTarget.value, false);
  };

  @action
  private readonly handleUsersInputKeyDown = (e: React.KeyboardEvent<HTMLInputElement>) => {
    const elem = e.currentTarget;
    if (e.key === 'Backspace' && elem.selectionStart === 0 && elem.selectionEnd === 0) {
      const last = [...this.validUsers.keys()].pop();
      if (last != null) {
        this.validUsers.delete(last);
        this.props.onValidUsersChanged?.(this.validUsers);
      }
    }
  };

  @action
  private readonly handleUsersInputPaste = (e: React.SyntheticEvent<HTMLInputElement>) => {
    this.updateUsers(e.currentTarget.value, true);
  };

  @action
  private async lookupUsers() {
    this.xhrLookupUsers?.abort();
    this.debouncedLookupUsers.cancel();

    const userIds = this.users.split(',').map((s) => presence(s.trim())).filter(Boolean);
    if (userIds.length === 0) {
      this.busy = false;
      return;
    }

    try {
      this.xhrLookupUsers = $.getJSON(route('chat.users.index'), { ids: userIds });
      const response = await this.xhrLookupUsers;
      this.extractValidUsers(response.users);
    } catch (error) {
      if (!isJqXHR(error)) throw error;
      onError(error);
    } finally {
      runInAction(() => this.busy = false);
    }
  }


  private renderValidUsers() {
    return [...this.validUsers.values()].map((user) => (
      <UserCardBrick key={user.id} onRemoveClick={this.handleRemoveUser} user={user} />
    ));
  }

  @action
  private updateUsers(text: string, immediate: boolean) {
    this.debouncedLookupUsers.cancel();
    this.users = text;

    this.props.onValueChanged?.(this.users);

    // TODO: check if change is only whitespace.
    if (text.trim().length === 0) {
      this.xhrLookupUsers?.abort();
      this.busy = false;

      return;
    }

    // spinner should trigger even before request is sent.
    this.busy = true;
    this.debouncedLookupUsers();

    if (immediate) {
      this.debouncedLookupUsers.flush();
    }
  }

  private validUsersContains(userId?: string | null) {
    if (userId == null) return false;

    return this.validUsers.has(Number(userId))
      // maybe it's a username
      || [...this.validUsers.values()].some((user) => user.username.toLowerCase() === userId.toLowerCase());
  }
}


