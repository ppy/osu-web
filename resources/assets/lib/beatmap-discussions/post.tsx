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
import { BeatmapsetDiscussionMessagePostJson } from 'interfaces/beatmapset-discussion-post-json';
import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import { BeatmapsetWithDiscussionsJson } from 'interfaces/beatmapset-json';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import { isEqual } from 'lodash';
import { action, autorun, computed, makeObservable, observable, runInAction } from 'mobx';
import { disposeOnUnmount, observer } from 'mobx-react';
import { deletedUser } from 'models/user';
import core from 'osu-core-singleton';
import * as React from 'react';
import TextareaAutosize from 'react-autosize-textarea';
import { onError } from 'utils/ajax';
import { badgeGroup, canModeratePosts, format, validMessageLength } from 'utils/beatmapset-discussion-helper';
import { classWithModifiers } from 'utils/css';
import { InputEventType, makeTextAreaHandler } from 'utils/input-handler';
import { trans } from 'utils/lang';
import MessageLengthCounter from './message-length-counter';
import { UserCard } from './user-card';

const bn = 'beatmap-discussion-post';

interface Props {
  beatmap: BeatmapExtendedJson;
  beatmapset: BeatmapsetExtendedJson;
  discussion: BeatmapsetDiscussionJson;
  post: BeatmapsetDiscussionMessagePostJson;
  read: boolean;
  resolvedSystemPostId: number;
  type: string;
  user: UserJson;
  users: Partial<Record<number, UserJson>>;
}

@observer
export default class Post extends React.Component<Props> {
  @observable private canSave = true; // this isn't computed because Editor's onChange doesn't provide anything to react to.
  @observable private editing = false;
  private readonly handleTextareaKeyDown;
  @observable private message = '';
  private readonly messageBodyRef = React.createRef<HTMLDivElement>();
  private readonly reviewEditorRef = React.createRef<Editor>();
  @observable private textareaMinHeight = '0';
  private readonly textareaRef = React.createRef<HTMLTextAreaElement>();
  @observable private xhr: JQuery.jqXHR<BeatmapsetWithDiscussionsJson> | null = null;

  @computed
  private get canEdit() {
    return this.isAdmin || this.isOwn && this.props.post.id > this.props.resolvedSystemPostId && !this.props.beatmapset.discussion_locked;
  }

  @computed
  private get canReport() {
    return core.currentUser != null && this.props.post.user_id !== core.currentUser.id;
  }

  @computed
  private get deleteModel() {
    return this.props.type === 'reply' ? this.props.post : this.props.discussion;
  }

  @computed
  private get isAdmin() {
    return core.currentUser?.is_admin ?? false;
  }

  @computed
  private get isOwn() {
    return core.currentUser != null && core.currentUser.id === this.props.post.user_id;
  }

  @computed
  private get isPosting() {
    return this.xhr != null;
  }

  @computed
  private get isReview() {
    return this.props.discussion.message_type === 'review' && this.props.type === 'discussion';
  }

  @computed
  private get isTimeline() {
    return this.props.discussion.timestamp != null;
  }

  constructor(props: Props) {
    super(props);
    makeObservable(this);

    this.handleTextareaKeyDown = makeTextAreaHandler(this.handleTextareaKeyDownCallback);

    disposeOnUnmount(this, autorun(() => {
      if (this.editing) {
        setTimeout(() => this.textareaRef.current?.focus(), 0);
      }
    }));
  }

  componentWillUnmount() {
    this.xhr?.abort();
  }

  render() {
    const topClasses = classWithModifiers(bn, this.props.type, {
      deleted: this.props.post.deleted_at != null,
      editing: this.editing,
      unread: !this.props.read && this.props.type !== 'discussion',
    });

    return (
      <div
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
          {this.editing ? this.renderMessageEditor() : this.renderMessageViewer()}
        </div>
      </div>
    );
  }

  private deleteHref(op: 'destroy' | 'restore') {
    const [controller, key] = this.props.type === 'reply'
      ? ['beatmapsets.discussions.posts', 'post']
      : ['beatmapsets.discussions', 'discussion'];

    return route(`${controller}.${op}`, { [key]: this.deleteModel.id });
  }

  @action
  private readonly editCancel = () => {
    this.editing = false;
  };

  @action
  private readonly editStart = () => {
    this.textareaMinHeight = this.messageBodyRef.current != null
      ? `${this.messageBodyRef.current.getBoundingClientRect().height + 50}px`
      : '0';

    this.editing = true;
    this.message = this.props.post.message;
  };

  @action
  private readonly handleEditorChange = () => {
    this.canSave = this.reviewEditorRef.current?.canSave ?? false;
  };

  private readonly handleMarkRead = () => {
    $.publish('beatmapDiscussionPost:markRead', { id: this.props.post.id });
  };

  @action
  private readonly handleTextareaChange = (e: React.ChangeEvent<HTMLTextAreaElement>) => {
    this.message = e.target.value;
    this.canSave = validMessageLength(this.message, this.isTimeline);
  };

  private readonly handleTextareaKeyDownCallback = (type: InputEventType) => {
    if (type === InputEventType.Submit) {
      this.updatePost();
    }
  };

  private renderDeletedBy() {
    if (this.deleteModel.deleted_at == null) return null;
    const user = (
      this.deleteModel.deleted_by_id != null
        ? this.props.users[this.deleteModel.deleted_by_id]
        : null
    ) ?? deletedUser;

    return (
      <span className={`${bn}__info`}>
        <StringWithComponent
          mappings={{
            delete_time: <TimeWithTooltip dateTime={this.deleteModel.deleted_at} relative />,
            editor: (
              <UserLink
                className={`${bn}__info-user`}
                user={user}
              />
            ),
          }}
          pattern={trans('beatmaps.discussions.deleted')}
        />
      </span>
    );
  }

  private renderEdited() {
    if (this.props.post.last_editor_id == null
      || this.props.post.updated_at === this.props.post.created_at) {
      return null;
    }

    const lastEditor = this.props.users[this.props.post.last_editor_id] ?? deletedUser.toJson();

    return (
      <span className={`${bn}__info`}>
        <StringWithComponent
          mappings={{
            editor: <UserLink className={`${bn}__info-user`} user={lastEditor} />,
            update_time: <TimeWithTooltip dateTime={this.props.post.updated_at} relative />,
          }}
          pattern={trans('beatmaps.discussions.edited')}
        />
      </span>
    );
  }

  private renderKudosuAction(op: 'allow' | 'deny') {
    return (
      <a
        className={`js-beatmapset-discussion-update ${bn}__action ${bn}__action--button`}
        data-confirm={trans('common.confirmation')}
        data-method='POST'
        data-remote
        href={route(`beatmapsets.discussions.${op}-kudosu`, { discussion: this.props.discussion.id })}
      >
        {trans(`beatmaps.discussions.${op}_kudosu`)}
      </a>
    );
  }

  private renderMessageEditor() {
    if (!this.canEdit) return;
    const canPost = !this.isPosting && this.canSave;

    const document = this.props.post.message;

    return (
      <div className={`${bn}__message-container`}>
        {this.isReview ? (
          <DiscussionsContext.Consumer>
            {(discussions) => (
              <BeatmapsContext.Consumer>
                {(beatmaps) => (
                  <Editor
                    ref={this.reviewEditorRef}
                    beatmaps={beatmaps}
                    beatmapset={this.props.beatmapset}
                    currentBeatmap={this.props.beatmap}
                    discussion={this.props.discussion}
                    discussions={discussions}
                    document={document}
                    editing={this.editing}
                    onChange={this.handleEditorChange}
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
              disabled={this.isPosting}
              onChange={this.handleTextareaChange}
              onKeyDown={this.handleTextareaKeyDown}
              style={{ minHeight: this.textareaMinHeight }}
              value={this.message}
            />
            <MessageLengthCounter isTimeline={this.isTimeline} message={this.message} />
          </>
        )}
        <div className={`${bn}__actions`}>
          <div className={`${bn}__actions-group`}>
            <div className={`${bn}__actions-group`}>
              <div className={`${bn}__action`}>
                <BigButton
                  disabled={this.isPosting}
                  props={{ onClick: this.editCancel }}
                  text={trans('common.buttons.cancel')}
                />
              </div>
            </div>
            <div className={`${bn}__action`}>
              <BigButton
                disabled={!canPost}
                props={{ onClick: this.updatePost }}
                text={trans('common.buttons.save')}
              />
            </div>
          </div>
        </div>
      </div>
    );
  }

  private renderMessageViewer() {
    return (
      <div className={`${bn}__message-container`}>
        {this.isReview ? (
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
          {this.renderDeletedBy()}
          {this.renderEdited()}

          {this.props.type === 'discussion' && this.props.discussion.kudosu_denied && (
            <span className={`${bn}__info`}>
              {trans('beatmaps.discussions.kudosu_denied')}
            </span>
          )}
        </div>

        {this.renderMessageViewerActions()}
      </div>
    );
  }


  private renderMessageViewerActions() {
    const canModerate = canModeratePosts();
    const canDelete = this.props.type === 'discussion' ? this.props.discussion.current_user_attributes?.can_destroy : canModerate || this.canEdit;

    return (
      <div className={`${bn}__actions`}>
        <div className={`${bn}__actions-group`}>
          <span className={`${bn}__action ${bn}__action--button`}>
            <ClickToCopy
              label={trans('common.buttons.permalink')}
              value={BeatmapDiscussionHelper.url({ discussion: this.props.discussion, post: this.props.type === 'reply' ? this.props.post : null })}
              valueAsUrl
            />
          </span>
          {this.canEdit && (
            <button
              className={`${bn}__action ${bn}__action--button`}
              onClick={this.editStart}
            >
              {trans('beatmaps.discussions.edit')}
            </button>
          )}

          {this.deleteModel.deleted_at == null && canDelete && (
            <a
              className={`js-beatmapset-discussion-update ${bn}__action ${bn}__action--button`}
              data-confirm={trans('common.confirmation')}
              data-method='DELETE'
              data-remote
              href={this.deleteHref('destroy')}
            >
              {trans('beatmaps.discussions.delete')}
            </a>
          )}

          {this.deleteModel.deleted_at != null && canModerate && (
            <a
              className={`js-beatmapset-discussion-update ${bn}__action ${bn}__action--button`}
              data-confirm={trans('common.confirmation')}
              data-method='POST'
              data-remote
              href={this.deleteHref('restore')}
            >
              {trans('beatmaps.discussions.restore')}
            </a>
          )}

          {this.props.type === 'discussion' && this.props.discussion.current_user_attributes?.can_moderate_kudosu && (
            this.props.discussion.can_grant_kudosu
              ? this.renderKudosuAction('deny')
              : this.props.discussion.kudosu_denied && this.renderKudosuAction('allow')
          )}

          {this.canReport && (
            <ReportReportable
              className={`${bn}__action ${bn}__action--button`}
              reportableId={this.props.post.id.toString()}
              reportableType='beatmapset_discussion_post'
              user={this.props.user}
            />
          )}
        </div>
      </div>
    );
  }


  @action
  private readonly updatePost = () => {
    if (this.isPosting) return;

    if (this.isReview) {
      if (this.reviewEditorRef.current == null) {
        console.error('reviewEditor is missing!');
        return;
      }

      const messageContent = this.reviewEditorRef.current.serialize();

      if (isEqual(JSON.parse(this.props.post.message), JSON.parse(messageContent))) {
        this.editing = false;
        return;
      }

      if (!this.reviewEditorRef.current.showConfirmationIfRequired()) return;

      this.message = messageContent;
    }

    if (this.message === this.props.post.message) {
      this.editing = false;
      return;
    }

    this.xhr = $.ajax(route('beatmapsets.discussions.posts.update', { post: this.props.post.id }), {
      data: {
        beatmap_discussion_post: {
          message: this.message,
        },
      },
      method: 'PUT',
    });

    this.xhr.done((beatmapset) => runInAction(() => {
      this.editing = false;
      $.publish('beatmapsetDiscussions:update', { beatmapset });
    }))
      .fail(onError)
      .always(action(() => this.xhr = null));
  };
}
