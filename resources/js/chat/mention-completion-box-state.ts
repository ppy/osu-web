// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute';
import { debounce } from 'lodash';
import { action, computed, makeObservable, observable, runInAction } from 'mobx';
import core from 'osu-core-singleton';
import * as React from 'react';
import { modulo } from 'utils/math';

const maxSearchLength = 20;
const searchRe = /(?<=^|\s|'|"|,|\.|\/)@([A-Za-z0-9-[\]_]*)/;

export interface UserSearchEntry {
  avatar_url: string;
  id: number;
  username: string;
}

export default class MentionCompletionBoxState {
  @observable query = '';
  @observable selectedIndex = 0;
  @observable visible = false;

  @observable private readonly cache: Partial<Record<string, UserSearchEntry[]>> = {};
  private readonly debouncedFetchSuggestions = debounce(() => this.fetchSuggestions(), 300);
  @observable private readonly fetching = new Set<string>();
  private newCursorPosition?: number;

  @computed
  get isFetchingCurrent() {
    return this.fetching.has(this.query);
  }

  @computed
  get users() {
    if (this.query.length >= maxSearchLength) {
      return [];
    }

    if (this.query.length > 0) {
      return this.cache[this.query];
    }

    const channel = this.selectedChannel;
    if (channel == null) return [];

    const users = new Map<number, UserSearchEntry>();
    for (const message of channel.messages.slice().reverse()) {
      if (!users.has(message.senderId)) {
        const user = message.sender;
        users.set(message.senderId, {
          avatar_url: user.avatarUrl,
          id: user.id,
          username: user.username,
        });

        if (users.size >= 10) {
          break;
        }
      }
    }

    return [...users.values()];
  }

  @computed
  private get hasBox() {
    return this.selectedChannel?.type === 'PUBLIC';
  }

  private get selectedChannel() {
    return core.dataStore.chatState.selectedChannel;
  }

  constructor(readonly inputBoxRef: React.RefObject<HTMLTextAreaElement>) {
    makeObservable(this);
  }

  @action
  readonly handleKey = (key: string) => {
    switch (key) {
      case 'ArrowDown':
        return void this.shiftSelectedIndex(1);
      case 'ArrowUp':
        return void this.shiftSelectedIndex(-1);
      case 'Escape':
        return void (this.visible = false);
      case 'Enter':
      case 'Tab':
        return void this.insertUsername(this.users?.[this.selectedIndex]);
    }
  };

  @action
  insertUsername(user?: UserSearchEntry) {
    const el = this.inputBoxRef.current;
    if (el != null && user != null) {
      const tailSlice = el.selectionStart;
      const headSlice = tailSlice - this.query.length;
      const separator = el.value[tailSlice] === ' ' ? '' : ' ';
      this.newCursorPosition = headSlice + user.username.length + 1;
      core.dataStore.chatState.selectedChannel?.setInputText(
        `${el.value.slice(0, headSlice)}${user.username.replace(/ /g, '_')}${separator}${el.value.slice(tailSlice)}`,
      );
      el.focus();
    }
    this.visible = false;
  }

  @action
  refreshState() {
    this.visible = false;
    const el = this.inputBoxRef.current;

    if (!this.hasBox || el == null || el.selectionStart !== el.selectionEnd) return;

    const value = el.value.slice(0, el.selectionStart);
    let query = '';
    if (value.includes('@')) {
      const mention = searchRe.exec(value);

      if (mention != null) {
        const start = mention.index;
        // this will only match the first @-mention
        const end = start + mention[0].length;
        this.visible = el.selectionStart >= start && el.selectionEnd <= end;
        if (this.visible) {
          query = mention[1];
        }
      }
    }
    this.updateQuery(query);
  }

  setCursorPosition() {
    const el = this.inputBoxRef.current;
    if (this.newCursorPosition != null && el != null) {
      el.selectionStart = el.selectionEnd = this.newCursorPosition;
      this.newCursorPosition = undefined;
    }
  }

  @action
  private readonly fetchSuggestions = () => {
    const query = this.query;

    if (query === '' || query.length >= maxSearchLength || this.cache[query] != null || this.fetching.has(query)) {
      return;
    }

    this.fetching.add(query);

    // always let the request to finish even if the query is changed midway
    // so it doesn't need to be re-requested the next time
    $.ajax(route('suggestions.user', { query }))
      .done((users: UserSearchEntry[]) => runInAction(() => {
        this.cache[query] = users;
      })).always(() => runInAction(() => {
        this.fetching.delete(query);
      }));
  };

  @action
  private shiftSelectedIndex(direction: number) {
    const size = this.users?.length ?? 0;

    this.selectedIndex = size === 0
      ? 0
      : modulo(this.selectedIndex + direction, size);
  }

  private updateQuery(newQuery: string) {
    if (this.query !== newQuery) {
      this.query = newQuery;
      this.selectedIndex = 0;
    }

    this.debouncedFetchSuggestions();
  }
}
