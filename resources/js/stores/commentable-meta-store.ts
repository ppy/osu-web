// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { CommentableMetaJson } from 'interfaces/comment-json';
import { action, makeObservable, observable } from 'mobx';

export default class CommentableMetaStore {
  @observable meta = observable.map<string | null, CommentableMetaJson>();

  constructor() {
    makeObservable(this);
  }

  @action
  flushStore() {
    this.meta.clear();
  }

  get(type: string, id: number): CommentableMetaJson | undefined {
    const obj = this.meta.get(`${type}-${id}`);

    return obj != null ? obj : this.meta.get(null);
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
