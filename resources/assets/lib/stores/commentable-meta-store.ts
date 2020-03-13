// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import DispatcherAction from 'actions/dispatcher-action';
import { UserLogoutAction } from 'actions/user-login-actions';
import { CommentableMetaJSON } from 'interfaces/comment-json';
import { action, observable } from 'mobx';
import Store from 'stores/store';

export default class CommentableMetaStore extends Store {
  @observable meta = observable.map<string | null, CommentableMetaJSON>();

  @action
  flushStore() {
    this.meta.clear();
  }

  get(type: string, id: number) {
    const obj = this.meta.get(`${type}-${id}`);

    return obj != null ? obj : this.meta.get(null);
  }

  handleDispatchAction(dispatchedAction: DispatcherAction) {
    if (dispatchedAction instanceof UserLogoutAction) {
      this.flushStore();
    }
  }

  @action
  initialize(meta: CommentableMetaJSON[] | undefined | null) {
    this.flushStore();
    this.updateWithJSON(meta);
  }

  @action
  updateWithJSON(data: CommentableMetaJSON[] | undefined | null) {
    if (data == null) { return; }
    for (const json of data) {
      const key = json.type != null && json.id != null ? `${json.type}-${json.id}` : null;
      this.meta.set(key, json);
    }
  }
}
