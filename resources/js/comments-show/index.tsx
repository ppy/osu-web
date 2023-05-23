// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Comment from 'components/comment';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';

const store = core.dataStore.commentStore;
const uiState = core.dataStore.uiState;

@observer
export default class CommentsShow extends React.Component {
  render() {
    const comment = store.comments.get(uiState.comments.topLevelCommentIds[0]);

    if (comment == null) {
      throw new Error('missing comment');
    }

    return (
      <Comment
        comment={comment}
        depth={0}
        linkParent
        modifiers={['dark', 'single']}
        showCommentableMeta
        showToolbar
      />
    );
  }
}
