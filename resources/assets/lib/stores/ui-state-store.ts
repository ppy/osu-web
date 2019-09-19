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
import ChatStateStore from 'chat/chat-state-store';
import { observable } from 'mobx';
import { CommentSort } from 'models/comment';
import Store from 'stores/store';

interface CommentsUIState {
  currentSort: CommentSort;
  hasMoreComments: Map<number, boolean>;
  isShowDeleted: boolean;
  loadingSort: CommentSort | null;
  topLevelCommentIds: number[];
}

export default class UIStateStore extends Store {
  chat = new ChatStateStore(this.root, this.dispatcher);
  @observable comments: CommentsUIState = {
    currentSort: 'new',
    hasMoreComments: new Map<number, boolean>(),
    isShowDeleted: false,
    loadingSort: null,
    topLevelCommentIds: [],
  };

  handleDispatchAction(action: DispatcherAction) { /* do nothing */}
}
