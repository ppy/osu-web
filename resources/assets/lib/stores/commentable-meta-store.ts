// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import DispatcherAction from 'actions/dispatcher-action';
import { UserLogoutAction } from 'actions/user-login-actions';
import { CommentableMetaJson } from 'interfaces/comment-json';
import { action, observable } from 'mobx';

export default class CommentableMetaStore {
  @observable meta = observable.map<string | null, CommentableMetaJson>();

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
  initialize(meta: CommentableMetaJson[] | undefined | null) {
    this.flushStore();
    this.updateWithJson(meta);
  }

  @action
  updateWithJson(data: CommentableMetaJson[] | undefined | null) {
    if (data == null) return;
    for (const json of data) {
      const key = 'id' in json ? `${json.type}-${json.id}` : null;
      this.meta.set(key, json);
    }
  }
}
