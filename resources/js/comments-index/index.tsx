// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Comment from 'components/comment';
import CommentsController from 'components/comments-controller';
import { observer } from 'mobx-react';
import * as React from 'react';
import { trans } from 'utils/lang';

interface Props {
  controllerStateSelector: string;
}

@observer
export default class CommentsIndex extends React.Component<Props> {
  private readonly controller;

  constructor(props: Props) {
    super(props);
    this.controller = new CommentsController(this.props.controllerStateSelector);
  }

  componentWillUnmount() {
    this.controller.destroy();
  }

  render() {
    const comments = this.controller.getComments(this.controller.state.commentIdsByParentId[-1] ?? []);

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
          controller={this.controller}
          depth={0}
          expandReplies={false}
          linkParent
          modifiers='dark'
          showCommentableMeta
        />
      ));
  }
}
