// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJson from 'interfaces/user-json';
import { debounce } from 'lodash';
import { action, makeObservable, observable, runInAction } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { isJqXHR, onError } from 'utils/ajax';
import { classWithModifiers, Modifiers } from 'utils/css';
import { presence } from 'utils/string';
import { apiLookupUsers } from 'utils/user';
import { Spinner } from './spinner';
import UserCardBrick from './user-card-brick';

interface Props {
  id?: string;
  ignoreCurrentUser?: boolean;
  initialUsers?: UserJson[];
  initialValue?: string;
  modifiers?: Modifiers;
  name?: string;
  onBlur?: (e: React.FocusEvent<HTMLInputElement>) => void;
  onEnterPressed?: () => void;
  onValidUsersChanged?: (value: Map<number, UserJson>) => void;
  onValueChanged?: (value: string) => void;
  renderUser?: (user: UserJson, onRemoveClick: (user: UserJson) => void) => void;
}

const BusySpinner = ({ busy }: { busy: boolean }) => (
  <div className='username-input__spinner'>
    {busy && <Spinner />}
  </div>
);

@observer
export default class UsernameInput extends React.PureComponent<Props> {
  @observable private busy = false;
  private readonly debouncedLookupUsers = debounce(() => this.lookupUsers(), 1000);
  @observable private input: string = '';
  @observable private readonly validUsers = new Map<number, UserJson>();
  private xhr?: ReturnType<typeof apiLookupUsers>;

  constructor(props: Props) {
    super(props);

    makeObservable(this);

    // Does not accept input value updates outside of construction.
    // The component manages its own state so it can handle user and text
    // conversion without bouncing values back and forth.
    if (this.props.initialUsers != null) {
      for (const user of this.props.initialUsers) {
        this.validUsers.set(user.id, user);
      }
    }

    if (this.props.initialValue != null) {
      this.updateUsers(this.props.initialValue, true);
    }
  }

  componentWillUnmount() {
    this.debouncedLookupUsers.cancel();
    this.xhr?.abort();
  }

  render() {
    return (
      <div className={classWithModifiers('username-input', this.props.modifiers)}>
        <input
          className='username-input__input'
          id={this.props.id}
          name={this.props.name}
          onBlur={this.handleBlur}
          onChange={this.handleUsersInputChange}
          onKeyDown={this.handleUsersInputKeyDown}
          onKeyUp={this.handleUsersInputKeyUp}
          onPaste={this.handleUsersInputPaste}
          value={this.input}
        />
        {this.renderValidUsers()}
        <BusySpinner busy={this.busy} />
      </div>
    );
  }

  /**
   * Disassembles and extract valid users from the string.
   */
  @action
  private extractValidUsers(users: UserJson[]) {
    const userIds = this.input.split(',');

    for (const user of users) {
      this.validUsers.set(user.id, user);
    }

    const invalidUsers: string[] = [];

    for (const userId of userIds) {
      const trimmedUserId = presence(userId.trim());

      if (!this.validUsersContain(trimmedUserId)) {
        invalidUsers.push(userId);
      }
    }

    this.input = invalidUsers.join(',');

    if (this.props.ignoreCurrentUser ?? false) {
      this.validUsers.delete(core.currentUserOrFail.id);
    }

    this.props.onValueChanged?.(this.input);
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

  private readonly handleUsersInputKeyUp = (e: React.KeyboardEvent<HTMLInputElement>) => {
    if (e.key === 'Enter') this.props.onEnterPressed?.();
  };

  @action
  private readonly handleUsersInputPaste = (e: React.SyntheticEvent<HTMLInputElement>) => {
    this.updateUsers(e.currentTarget.value, true);
  };

  @action
  private async lookupUsers() {
    this.xhr?.abort();
    this.debouncedLookupUsers.cancel();

    const userIds = this.input.split(',').map((s) => presence(s.trim())).filter(Boolean);
    if (userIds.length === 0) {
      this.busy = false;
      return;
    }

    try {
      this.xhr = apiLookupUsers(userIds);
      const response = await this.xhr;
      this.extractValidUsers(response.users);
    } catch (error) {
      if (!isJqXHR(error)) throw error;
      onError(error);
    } finally {
      runInAction(() => this.busy = false);
    }
  }


  private renderValidUsers() {
    return [...this.validUsers.values()].map((user) =>
      this.props.renderUser == null
        ? <UserCardBrick key={user.id} onRemoveClick={this.handleRemoveUser} user={user} />
        : this.props.renderUser(user, this.handleRemoveUser),
    );
  }

  @action
  private updateUsers(text: string, immediate: boolean) {
    this.debouncedLookupUsers.cancel();
    this.input = text;

    this.props.onValueChanged?.(this.input);

    // TODO: check if change is only whitespace.
    if (text.trim().length === 0) {
      this.xhr?.abort();
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

  private validUsersContain(userIdOrUsername?: string | null) {
    if (userIdOrUsername == null) return false;

    return this.validUsers.has(Number(userIdOrUsername))
      // maybe it's a username
      || [...this.validUsers.values()].some((user) => {
        const validUsernameLowercase = user.username.toLowerCase();
        return [validUsernameLowercase, `@${validUsernameLowercase}`].includes(userIdOrUsername.toLowerCase());
      });
  }
}

