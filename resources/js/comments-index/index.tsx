// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Comment from 'components/comment';
import { computed, makeObservable } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { trans } from 'utils/lang';

const store = core.dataStore.commentStore;
const uiState = core.dataStore.uiState;

@observer
export default class CommentsIndex extends React.Component {
  @computed
  private get comments() {
    const ret = [];

    for (const id of uiState.comments.topLevelCommentIds) {
      const comment = store.comments.get(id);

      if (comment != null) {
        ret.push(comment);
      }
    }

    return ret;
  }

  constructor(props: Record<string, never>) {
    super(props);

    makeObservable(this);
  }

  render() {
    const comments = this.comments;

    return comments.length === 0
      ? (
        <div className='comments'>
          <div className='comments__items comments__items--empty'>
            {trans('comments.index.no_comments')}
          </div>
        </div>
      ) : comments.map((comment) => (
        <Comment
          key={comment.id}
          comment={comment}
          depth={0}
          expandReplies={false}
          linkParent
          modifiers='dark'
          showCommentableMeta
        />
      ));
  }
}
