// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { CommentableMetaJson } from 'interfaces/comment-json';
import { route } from 'laroute';
import { action, computed, makeObservable, observable, runInAction } from 'mobx';
import { observer } from 'mobx-react';
import { Comment } from 'models/comment';
import core from 'osu-core-singleton';
import * as React from 'react';
import TextareaAutosize from 'react-autosize-textarea';
import { onErrorWithCallback } from 'utils/ajax';
import { classWithModifiers, Modifiers } from 'utils/css';
import { InputEventType, makeTextAreaHandler, TextAreaCallback } from 'utils/input-handler';
import { trans } from 'utils/lang';
import { switchNever } from 'utils/switch-never';
import BigButton from './big-button';
import { Spinner } from './spinner';
import UserAvatar from './user-avatar';

type Mode = 'edit' | 'new' | 'reply';

interface CommentPostParams {
  comment: {
    commentable_id?: number;
    commentable_type?: string;
    message: string;
    parent_id?: number;
  };
}

interface Props {
  close?: () => void;
  commentableMeta?: CommentableMetaJson;
  focus?: boolean;
  id?: number;
  message?: string;
  modifiers?: Modifiers;
  onPosted?: (mode: Mode) => void;
  parent?: Comment;
}

const bn = 'comment-editor';

const buttonTextKey: Record<Mode, string> = {
  edit: 'save',
  new: 'post',
  reply: 'reply',
};

@observer
export default class CommentEditor extends React.Component<Props> {
  private readonly handleKeyDown;
  @observable private message: string;
  @observable private posting = false;
  private readonly textarea = React.createRef<HTMLTextAreaElement>();
  private xhr: JQuery.jqXHR<unknown> | null = null;

  @computed
  private get canComment() {
    if (core.currentUser == null) return false;

    return this.mode === 'edit' || this.canNewCommentReason == null;
  }

  private get canNewCommentReason() {
    return this.props.commentableMeta == null
      ? null
      : 'current_user_attributes' in this.props.commentableMeta
        ? this.props.commentableMeta.current_user_attributes.can_new_comment_reason
        : trans('authorization.comment.store.disabled');
  }

  private get isValid() {
    return this.message.length > 0;
  }

  private get initialMessage() {
    return this.props.message ?? '';
  }

  @computed
  private get mode() {
    return this.props.parent != null
      ? 'reply'
      : this.props.id != null
        ? 'edit'
        : 'new';
  }

  @computed
  private get placeholder() {
    return this.canComment
      ? trans(`comments.placeholder.${this.mode}`)
      : (this.canNewCommentReason ?? undefined);
  }

  constructor(props: Props) {
    super(props);

    this.handleKeyDown = makeTextAreaHandler(this.handleKeyDownCallback);
    this.message = this.initialMessage;

    makeObservable(this);
  }

  componentDidMount() {
    if ((this.props.focus ?? true) && this.textarea.current != null) {
      this.textarea.current.selectionStart = -1;
      this.textarea.current.focus();
    }
  }

  componentWillUnmount() {
    this.xhr?.abort();
  }

  render() {
    const blockClass = classWithModifiers(bn, this.props.modifiers, { fancy: this.mode === 'new' });

    return (
      <div className={blockClass}>
        {this.mode === 'new' &&
          <div className={`${bn}__avatar`}>
            <UserAvatar modifiers='full-circle' user={core.currentUser} />
          </div>
        }

        <TextareaAutosize
          ref={this.textarea}
          className={`${bn}__message`}
          disabled={!this.canComment || this.posting}
          onChange={this.onChange}
          onKeyDown={this.handleKeyDown}
          placeholder={this.placeholder}
          value={this.message}
        />
        <div className={`${bn}__footer`}>
          <div className={`${bn}__footer-item ${bn}__footer-item--notice hidden-xs`}>
            {this.canComment && trans('comments.editor.textarea_hint._', {
              action: trans(`comments.editor.textarea_hint.${this.mode}`),
            })}
          </div>

          {this.props.close != null &&
            <div className={`${bn}__footer-item`}>
              <BigButton
                disabled={this.posting}
                modifiers='comment-editor'
                props={{ onClick: this.props.close }}
                text={trans('common.buttons.cancel')}
              />
            </div>
          }

          {core.currentUser != null
            ? (
              <div className={`${bn}__footer-item`}>
                <BigButton
                  disabled={this.posting || !this.isValid}
                  isBusy={this.posting}
                  modifiers='comment-editor'
                  props={{ onClick: this.post }}
                  text={{
                    top: this.posting
                      ? <Spinner modifiers='center-inline' />
                      : trans(`common.buttons.${buttonTextKey[this.mode]}`),
                  }}
                />
              </div>
            ) : (
              <div className={`${bn}__footer-item`}>
                <BigButton
                  extraClasses={['js-user-link']}
                  modifiers='comment-editor'
                  text={trans(`comments.guest_button.${this.mode}`)}
                />
              </div>
            )
          }
        </div>
      </div>
    );
  }

  private readonly close = () => {
    if (this.props.close == null) return;

    if (this.initialMessage !== this.message && !confirm(trans('common.confirmation_unsaved'))) return;

    this.props.close();
  };

  private readonly handleKeyDownCallback: TextAreaCallback = (type) => {
    if (type === InputEventType.Cancel) {
      this.close();
    } else if (type === InputEventType.Submit) {
      this.post();
    }
  };

  @action
  private readonly onChange = (e: React.KeyboardEvent<HTMLTextAreaElement>) => {
    this.message = e.currentTarget.value;
  };

  private readonly post = () => {
    if (this.posting) return;

    if (this.mode === 'edit' && this.message === (this.props.message ?? '')) {
      this.props.close?.();

      return;
    }

    this.posting = true;
    const params: CommentPostParams = {
      comment: { message: this.message },
    };

    let url = route('comments.store');
    let method = 'POST';
    let resetMessage = true;
    let publishEvent = 'comments:new';

    switch (this.mode) {
      case 'edit':
        if (this.props.id == null) {
          throw new Error('missing post id in edit mode');
        }
        url = route('comments.update', { comment: this.props.id });
        method = 'PUT';
        resetMessage = false;
        publishEvent = 'comment:updated';
        break;

      case 'new':
        if (this.props.commentableMeta == null || !('id' in this.props.commentableMeta)) {
          throw new Error('missing commentable meta in new mode');
        }
        params.comment.commentable_type = this.props.commentableMeta.type;
        params.comment.commentable_id = this.props.commentableMeta.id;
        break;

      case 'reply':
        if (this.props.parent == null) {
          throw new Error('missing parent in reply mode');
        }
        params.comment.parent_id = this.props.parent.id;
        break;

      default:
        switchNever(this.mode);
    }

    this.xhr = $.ajax(url, { data: params, method });
    this.xhr
      .always(action(() => {
        this.posting = false;
      })).done((data) => runInAction(() => {
        if (resetMessage) {
          this.message = '';
        }
        $.publish(publishEvent, data);
        this.props.onPosted?.(this.mode);
        this.props.close?.();
      })).fail(onErrorWithCallback(this.post));
  };
}
