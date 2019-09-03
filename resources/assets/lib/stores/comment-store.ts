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
import { CommentJSON } from 'interfaces/comment-json';
import { groupBy } from 'lodash';
import { action, observable } from 'mobx';
import { Comment } from 'models/comment';
import Store from 'stores/store';

export default class CommentStore extends Store {
  @observable comments = observable.map<number, Comment>();

  @action
  flushStore() {
    this.comments.clear();
  }

  getGroupedByParentId() {
    return groupBy(Object.values(this.comments.toPOJO()), 'parent_id');
  }

  handleDispatchAction(dispatchedAction: DispatcherAction) {
    if (dispatchedAction instanceof UserLogoutAction) {
      this.flushStore();
    }
  }

  updateWithJSON(data: CommentJSON[] | undefined | null) {
    if (data == null) { return; }
    for (const json of data) {
      const comment = Comment.fromJSON(json);
      this.comments.set(comment.id, comment);
    }
  }
}
