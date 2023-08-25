// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import Comment from 'components/comment';
import CommentsController from 'components/comments-controller';
import { observer } from 'mobx-react';
import * as React from 'react';

interface Props {
  controllerStateSelector: string;
}

@observer
export default class CommentsShow extends React.Component<Props> {
  private readonly controller;

  constructor(props: Props) {
    super(props);
    this.controller = new CommentsController(this.props.controllerStateSelector);
  }

  componentWillUnmount() {
    this.controller.destroy();
  }

  render() {
    const comment = this.controller.getComments(this.controller.state.commentIdsByParentId[0])[0];

    if (comment == null) {
      throw new Error('missing comment');
    }

    return (
      <Comment
        comment={comment}
        controller={this.controller}
        depth={0}
        linkParent
        modifiers={['dark', 'single']}
        showCommentableMeta
        showToolbar
      />
    );
  }
}
