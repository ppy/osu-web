// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { observer } from 'mobx-react';
import Comment from 'models/comment';
import * as React from 'react';
import { classWithModifiers, Modifiers } from 'utils/css';
import { trans } from 'utils/lang';
import CommentsController from './comments-controller';
import ShowMoreLink from './show-more-link';
import { Spinner } from './spinner';

const bn = 'comment-show-more';

interface Props {
  comments: Comment[];
  controller: CommentsController;
  label?: string;
  modifiers?: Modifiers;
  parent?: Comment;
  top?: boolean;
  total: number;
}

@observer
export default class CommentShowMore extends React.Component<Props> {
  private get loading() {
    return this.props.controller.isLoading(this.props.parent);
  }

  private get hasMoreComments() {
    return this.props.parent == null
      ? true
      : (this.props.controller.state.hasMore[this.props.parent.id] ?? true);
  }

  render() {
    if (this.props.comments.length >= this.props.total) {
      return null;
    }
    if (!this.hasMoreComments) {
      return null;
    }

    return this.props.top ?? false
      ? (
        <ShowMoreLink
          callback={this.load}
          hasMore
          loading={this.props.controller.isLoading(this.props.parent)}
          modifiers='comments'
          remaining={this.props.total - this.props.comments.length}
        />
      ) : (
        <div className={classWithModifiers(bn, this.props.modifiers)}>
          {this.loading ?
            <Spinner />
            :
            <button className={`${bn}__link`} onClick={this.load}>
              {this.props.label ?? trans('common.buttons.show_more')}
            </button>
          }
        </div>
      );
  }

  private readonly load = () => {
    this.props.controller.apiLoadMore(this.props.parent);
  };
}
