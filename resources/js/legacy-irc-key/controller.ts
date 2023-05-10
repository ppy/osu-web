// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import LegacyIrcKeyJson from 'interfaces/legacy-irc-key-json';
import { route } from 'laroute';
import { action, makeObservable, observable, reaction, runInAction } from 'mobx';
import { onError } from 'utils/ajax';

interface State {
  legacy_irc_key: LegacyIrcKeyJson | null;
}

export default class Controller {
  @observable state;
  private stateSyncDisposer;
  @observable private xhrCreate?: JQuery.jqXHR<LegacyIrcKeyJson>;
  @observable private xhrDelete?: JQuery.jqXHR<void>;

  get isCreating() {
    return this.xhrCreate != null;
  }

  get isDeleting() {
    return this.xhrDelete != null;
  }

  get key() {
    return this.state.legacy_irc_key;
  }

  constructor(private container: HTMLElement) {
    this.state = JSON.parse(container.dataset.state ?? '') as State;

    makeObservable(this);

    this.stateSyncDisposer = reaction(
      () => JSON.stringify(this.state),
      (stateString) => this.container.dataset.state = stateString,
    );
  }

  @action
  createKey() {
    this.xhrCreate = $.ajax(route('legacy-irc-key.store'), {
      method: 'POST',
    });
    this.xhrCreate
      .done((json) => runInAction(() => {
        this.state.legacy_irc_key = json;
      })).always(action(() => {
        this.xhrCreate = undefined;
      }));

    return this.xhrCreate;
  }

  @action
  deleteKey() {
    this.xhrDelete = $.ajax(route('legacy-irc-key.destroy'), { method: 'DELETE' })
      .fail(onError)
      .done(action(() => {
        this.state.legacy_irc_key = null;
      })).always(action(() => {
        this.xhrDelete = undefined;
      }));
  }

  destroy() {
    this.xhrCreate?.abort();
    this.xhrDelete?.abort();
    this.stateSyncDisposer();
  }
}
