/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

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
