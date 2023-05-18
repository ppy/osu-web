// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { CommentableMetaJson } from 'interfaces/comment-json';
import { route } from 'laroute';
import { last } from 'lodash';
import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import { Comment } from 'models/comment';
import core from 'osu-core-singleton';
import * as React from 'react';
import { classWithModifiers, Modifiers } from 'utils/css';
import { trans } from 'utils/lang';
import ShowMoreLink from './show-more-link';
import { Spinner } from './spinner';

const uiState = core.dataStore.uiState;
const bn = 'comment-show-more';

interface Props {
  commentableMeta?: CommentableMetaJson;
  comments: Comment[];
  label?: string;
  modifiers?: Modifiers;
  parent?: Comment;
  top?: boolean;
  total: number;
}

@observer
export default class CommentShowMore extends React.Component<Props> {
  @observable private loading = false;
  private xhr?: JQuery.jqXHR<void>;

  private get hasMoreComments() {
    return uiState.comments.hasMoreComments[this.props.parent?.id ?? 'null'] ?? true;
  }

  constructor(props: Props) {
    super(props);
    makeObservable(this);
  }

  componentWillUnmount() {
    this.xhr?.abort();
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
          loading={this.loading}
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

  @action
  private readonly load = () => {
    if (this.loading) return;

    this.loading = true;

    const params: Partial<Record<string, unknown>> = { sort: uiState.comments.currentSort };
    if (this.props.parent == null) {
      params.parent_id = 0;

      if (this.props.commentableMeta != null && ('id' in this.props.commentableMeta)) {
        params.commentable_id = this.props.commentableMeta.id;
        params.commentable_type = this.props.commentableMeta.type;
      }
    } else {
      params.commentable_id = this.props.parent.commentableId;
      params.commentable_type = this.props.parent.commentableType;
      params.parent_id = this.props.parent.id;
    }

    const lastComment = last(this.props.comments);
    if (lastComment != null) {
      // TODO: convert to plain after_id params of some sort instead of cursor
      params.cursor = {
        created_at: lastComment.createdAt,
        id: lastComment.id,
        votes_count: lastComment.votesCount,
      };
    }

    this.xhr = $.ajax(route('comments.index'), { data: params, dataType: 'json' });
    this.xhr.done((data) => {
      $.publish('comments:added', data);
    }).always(action(() => {
      this.loading = false;
    }));
  };
}
