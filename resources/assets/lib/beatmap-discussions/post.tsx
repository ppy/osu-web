// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsContext } from 'beatmap-discussions/beatmaps-context';
import { DiscussionsContext } from 'beatmap-discussions/discussions-context';
import Editor from 'beatmap-discussions/editor';
import { ReviewPost } from 'beatmap-discussions/review-post';
import BigButton from 'components/big-button';
import ClickToCopy from 'components/click-to-copy';
import { ReportReportable } from 'components/report-reportable';
import StringWithComponent from 'components/string-with-component';
import TimeWithTooltip from 'components/time-with-tooltip';
import { UserLink } from 'components/user-link';
import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import BeatmapsetDiscussionJson from 'interfaces/beatmapset-discussion-json';
import BeatmapsetDiscussionPostJson from 'interfaces/beatmapset-discussion-post-json';
import BeatmapsetJson, { BeatmapsetWithDiscussionsJson } from 'interfaces/beatmapset-json';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import { isEqual, throttle } from 'lodash';
import { makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import { deletedUser } from 'models/user';
import core from 'osu-core-singleton';
import * as React from 'react';
import TextareaAutosize from 'react-autosize-textarea';
import { onError } from 'utils/ajax';
import { badgeGroup, format, validMessageLength } from 'utils/beatmapset-discussion-helper';
import { classWithModifiers } from 'utils/css';
import { InputEventType, makeTextAreaHandler } from 'utils/input-handler';
import MessageLengthCounter from './message-length-counter';
import { UserCard } from './user-card';

const bn = 'beatmap-discussion-post';

interface Props {
  beatmap: BeatmapExtendedJson;
  beatmapset: BeatmapsetJson;
  canBeDeleted: boolean;
  canBeEdited: boolean;
  canBeRestored: boolean;
  discussion: BeatmapsetDiscussionJson;
  lastEditor: UserJson;
  post: BeatmapsetDiscussionPostJson;
  read: boolean;
  type: string;
  user: UserJson;
  users: Partial<Record<number, UserJson>>;
}

@observer
export class Post extends React.Component<Props> {
  @observable private canSave = true;
  @observable private editing = false;
  @observable private editorMinHeight = '0';
  @observable private message: string | null = null;
  @observable private posting = false;

  private readonly handleKeyDown;
  private readonly messageBodyRef = React.createRef<HTMLDivElement>();
  private readonly reviewEditor = React.createRef<Editor>();
  private readonly textareaRef = React.createRef<HTMLTextAreaElement>();
  private readonly throttledUpdatePost = throttle(() => this.updatePost(), 1000);
  private readonly xhr: Record<string, JQuery.jqXHR> = {};

  constructor(props: Props) {
    super(props);
    makeObservable(this);

    this.handleKeyDown = makeTextAreaHandler(this.handleKeyDownCallback);
  }

  componentWillUnmount() {
    this.throttledUpdatePost.cancel();

    return (() => {
      const result = [];
      for (const _id of Object.keys(this.xhr || {})) {
        const xhr = this.xhr[_id];
        result.push((xhr != null ? xhr.abort() : undefined));
      }
      return result;
    })();
  }


  render() {
    const topClasses = classWithModifiers(bn, this.props.type, {
      deleted: this.props.post.deleted_at != null,
      editing: this.editing,
      unread: !this.props.read && this.props.type !== 'discussion',
    });

    return (
      <div
        key={`${this.props.type}-${this.props.post.id}`}
        className={`${topClasses} js-beatmap-discussion-jump`}
        data-post-id={this.props.post.id}
        onClick={this.handleMarkRead}
      >
        <div className={`${bn}__content`}>
          {this.props.type === 'reply' && (
            <UserCard
              group={badgeGroup({
                beatmapset: this.props.beatmapset,
                currentBeatmap: this.props.beatmap,
                discussion: this.props.discussion,
                user: this.props.user,
              })}
              user={this.props.user}
            />
          )}
          {this.editing ? this.messageEditor() : this.messageViewer()}
        </div>
      </div>
    );
  }

  private canReport() {
    return core.currentUser != null && this.props.post.user_id !== core.currentUser.id;
  }

  private readonly editCancel = () => {
    this.setState({ editing: false });
  };

  private readonly editStart = () => {
    if (this.props.post.system) return;

    const editorMinHeight = this.messageBodyRef.current != null
      ? `${this.messageBodyRef.current.getBoundingClientRect().height + 50}px`
      : '0';

    return this.setState({
      editing: true,
      editorMinHeight,
      message: this.props.post.message,
    }, () => (this.textareaRef.current != null ? this.textareaRef.current.focus() : undefined));
  };

  private readonly handleKeyDownCallback = (type: InputEventType) => {
    if (type === InputEventType.Submit) {
      this.throttledUpdatePost();
    }
  };

  private readonly handleMarkRead = () => {
    $.publish('beatmapDiscussionPost:markRead', { id: this.props.post.id });
  };

  private isReview() {
    return this.props.discussion.message_type === 'review' && this.props.type === 'discussion';
  }

  private isTimeline() {
    return this.props.discussion.timestamp != null;
  }

  private messageEditor() {
    if (this.props.post.system) return;
    if (!this.props.canBeEdited) return;
    const canPost = !this.posting && this.canSave;

    const document = this.props.post.message;

    return (
      <div className={`${bn}__message-container`}>
        {this.isReview() ? (
          <DiscussionsContext.Consumer>
            {(discussions) => (
              <BeatmapsContext.Consumer>
                {(beatmaps) => (
                  <Editor
                    ref={this.reviewEditor}
                    beatmaps={beatmaps}
                    beatmapset={this.props.beatmapset}
                    currentBeatmap={this.props.beatmap}
                    discussion={this.props.discussion}
                    discussions={discussions}
                    document={document}
                    editMode
                    editing={this.editing}
                    onChange={this.updateCanSave}
                  />
                )}
              </BeatmapsContext.Consumer>
            )}
          </DiscussionsContext.Consumer>
        ) : (
          <>
            <TextareaAutosize
              ref={this.textareaRef}
              className={`${bn}__message ${bn}__message--editor`}
              disabled={this.posting}
              onChange={this.setMessage}
              onKeyDown={this.handleKeyDown}
              style={{ minHeight: this.editorMinHeight }}
              value={this.message ?? ''}
            />
            <MessageLengthCounter isTimeline={this.isTimeline()} message={this.message ?? ''} />
          </>
        )}
        <div className={`${bn}__actions`}>
          <div className={`${bn}__actions-group`}>
            <div className={`${bn}__actions-group`}>
              <div className={`${bn}__action`}>
                <BigButton
                  disabled={this.posting}
                  props={{ onClick: this.editCancel }}
                  text={osu.trans('common.buttons.cancel')}
                />
              </div>
            </div>
            <div className={`${bn}__action`}>
              <BigButton
                disabled={this.posting}
                props={{ onClick: this.editCancel }}
                text={osu.trans('common.buttons.cancel')}
              />
            </div>
            <BigButton
              disabled={!canPost}
              props={{ onClick: void this.throttledUpdatePost }}
              text={osu.trans('common.buttons.save')}
            />
          </div>
        </div>
      </div>
    );
  }

  private messageViewer() {
    if (this.props.post.system) return;

    const [controller, key, deleteModel] = this.props.type === 'reply'
      ? ['beatmapsets.discussions.posts', 'post', this.props.post]
      : ['beatmapsets.discussions', 'discussion', this.props.discussion];

    return (
      <div className={`${bn}__message-container`}>
        {this.isReview() ? (
          <div className={`${bn}__message`}>
            <ReviewPost
              message={this.props.post.message}
            />
          </div>
        ) : (
          <div
            ref={this.messageBodyRef}
            className={`${bn}__message`}
            dangerouslySetInnerHTML={{
              __html: format(this.props.post.message),
            }}
          />
        )}
        <div className={`${bn}__info-container`}>
          <span className={`${bn}__info`}>
            <TimeWithTooltip dateTime={this.props.post.created_at} relative />
          </span>
          {this.renderDeletedBy(deleteModel)}

          {this.props.post.updated_at !== this.props.post.created_at && this.props.lastEditor != null && (
            <span className={classWithModifiers(`${bn}__info`, 'edited')}>
              <StringWithComponent
                mappings={{
                  editor: <UserLink className={`${bn}__info-user`} user={this.props.lastEditor} />,
                  update_time: <TimeWithTooltip dateTime={this.props.post.updated_at} relative />,
                }}
                pattern={osu.trans('beatmaps.discussions.edited')}
              />
            </span>
          )}

          {this.props.type === 'discussion' && this.props.discussion.kudosu_denied && (
            <span className={classWithModifiers(`${bn}__info`, 'edited')}>
              {osu.trans('beatmaps.discussions.kudosu_denied')}
            </span>
          )}
        </div>
        <div className={`${bn}__actions`}>
          <div className={`${bn}__actions-group`}>
            <span className={`${bn}__action ${bn}__action--button`}>
              <ClickToCopy
                label={osu.trans('common.buttons.permalink')}
                value={BeatmapDiscussionHelper.url({ discussion: this.props.discussion, post: this.props.type === 'reply' ? this.props.post : undefined })}
                valueAsUrl
              />
            </span>
            {this.props.canBeEdited && (
              <button
                className={`${bn}__action ${bn}__action--button`}
                onClick={this.editStart}
              >
                {osu.trans('beatmaps.discussions.edit')}
              </button>
            )}

            {deleteModel.deleted_at == null && this.props.canBeDeleted && (
              <a
                className={`js-beatmapset-discussion-update ${bn}__action ${bn}__action--button`}
                data-confirm={osu.trans('common.confirmation')}
                data-method='DELETE'
                data-remote
                href={route(`${controller}.destroy`, { [key]: deleteModel.id })}
              >
                {osu.trans('beatmaps.discussions.delete')}
              </a>
            )}

            {deleteModel.deleted_at != null && this.props.canBeRestored && (
              <a
                className={`js-beatmapset-discussion-update ${bn}__action ${bn}__action--button`}
                data-confirm={osu.trans('common.confirmation')}
                data-method='POST'
                data-remote
                href={route(`${controller}.restore`, { [key]: deleteModel.id })}
              >
                {osu.trans('beatmaps.discussions.restore')}
              </a>
            )}

            {this.props.type === 'discussion' && this.props.discussion.current_user_attributes?.can_moderate_kudosu && this.renderKudosu()}

            {this.canReport() && (
              <ReportReportable
                className={`${bn}__action ${bn}__action--button`}
                reportableId={this.props.post.id.toString()}
                reportableType='beatmapset_discussion_post'
                user={this.props.user}
              />
            )}
          </div>
        </div>
      </div>
    );
  }

  private renderDeletedBy(model: BeatmapsetDiscussionJson | BeatmapsetDiscussionPostJson) {
    if (model.deleted_at == null) return null;
    const user = (
      model.deleted_by_id != null
        ? this.props.users[model.deleted_by_id]
        : null
    ) ?? deletedUser;

    return (
      <span className={classWithModifiers(`${bn}__info`, 'edited')}>
        <StringWithComponent
          mappings={{
            delete_time: <TimeWithTooltip dateTime={model.deleted_at} relative />,
            editor: (
              <UserLink
                className={`${bn}__info-user`}
                user={user}
              />
            ),
          }}
          pattern={osu.trans('beatmaps.discussions.deleted')}
        />
      </span>
    );
  }

  private renderKudosu() {
    if (this.props.discussion.can_grant_kudosu) {
      return (
        <a
          className={`js-beatmapset-discussion-update ${bn}__action ${bn}__action--button`}
          data-confirm={osu.trans('common.confirmation')}
          data-method='POST'
          data-remote
          href={route('beatmapsets.discussions.deny-kudosu', { discussion: this.props.discussion.id })}
        >
          {osu.trans('beatmaps.discussions.deny_kudosu')}
        </a>
      );
    } else if (this.props.discussion.kudosu_denied) {
      return (
        <a
          className={`js-beatmapset-discussion-update ${bn}__action ${bn}__action--button`}
          data-confirm={osu.trans('common.confirmation')}
          data-method='POST'
          data-remote
          href={route('beatmapsets.discussions.allow-kudosu', { discussion: this.props.discussion.id })}
        >
          {osu.trans('beatmaps.discussions.allow_kudosu')}
        </a>
      );
    }

    return null;
  }

  private readonly setMessage = (e: React.ChangeEvent<HTMLTextAreaElement>) => {
    this.setState({ message: e.target.value }, () => this.updateCanSave());
  };

  private readonly updateCanSave = () => {
    this.setState({ canSave: this.validPost() });
  };

  private updatePost() {
    if (this.props.post.system) return;
    let messageContent = this.message;

    if (this.isReview()) {
      if (this.reviewEditor.current == null) {
        console.error('reviewEditor is missing!');
        return;
      }

      messageContent = this.reviewEditor.current.serialize();

      if (isEqual(JSON.parse(this.props.post.message), JSON.parse(messageContent))) {
        this.setState({ editing: false });
        return;
      }

      if (!this.reviewEditor.current.showConfirmationIfRequired()) return;

      this.setState({ message: messageContent });
    }

    if (messageContent === this.props.post.message) {
      this.setState({ editing: false });
      return;
    }

    this.setState({ posting: true });

    if (this.xhr.updatePost != null) {
      this.xhr.updatePost.abort();
    }
    return this.xhr.updatePost = $.ajax(route('beatmapsets.discussions.posts.update', { post: this.props.post.id }), {
      data: {
        beatmap_discussion_post: {
          message: messageContent,
        },
      },
      method: 'PUT',
    }).done((data: BeatmapsetWithDiscussionsJson) => {
      this.setState({ editing: false });
      return $.publish('beatmapsetDiscussions:update', { beatmapset: data });
    }).fail(onError)
      .always(() => this.setState({ posting: false }));
  }

  private validPost() {
    if (this.isReview()) {
      return this.reviewEditor.current?.canSave ?? false;
    } else {
      return validMessageLength(this.message, this.isTimeline());
    }
  }
}
