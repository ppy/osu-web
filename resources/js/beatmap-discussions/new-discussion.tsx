// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { DiscussionType, discussionTypeIcons, discussionTypes } from 'beatmap-discussions/discussion-type';
import BigButton from 'components/big-button';
import StringWithComponent from 'components/string-with-component';
import TimeWithTooltip from 'components/time-with-tooltip';
import UserAvatar from 'components/user-avatar';
import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import BeatmapsetDiscussionJson from 'interfaces/beatmapset-discussion-json';
import { BeatmapsetDiscussionPostStoreResponseJson } from 'interfaces/beatmapset-discussion-post-responses';
import BeatmapsetExtendedJson from 'interfaces/beatmapset-extended-json';
import BeatmapsetWithDiscussionsJson from 'interfaces/beatmapset-with-discussions-json';
import { route } from 'laroute';
import { action, computed, makeObservable, observable, runInAction } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import TextareaAutosize from 'react-autosize-textarea';
import { onError } from 'utils/ajax';
import { canModeratePosts, formatTimestamp, makeUrl, NearbyDiscussion, nearbyDiscussions, parseTimestamp, validMessageLength } from 'utils/beatmapset-discussion-helper';
import { downloadLimited, nominationsCount } from 'utils/beatmapset-helper';
import { classWithModifiers } from 'utils/css';
import { InputEventType, makeTextAreaHandler } from 'utils/input-handler';
import { joinComponents, trans } from 'utils/lang';
import { hideLoadingOverlay, showLoadingOverlay } from 'utils/loading-overlay';
import { present } from 'utils/string';
import CurrentDiscussions from './current-discussions';
import DiscussionMessageLengthCounter from './discussion-message-length-counter';
import DiscussionMode from './discussion-mode';

const bn = 'beatmap-discussion-new';

interface DiscussionsCache {
  beatmap: BeatmapExtendedJson;
  discussions: NearbyDiscussion<BeatmapsetDiscussionJson>[];
  timestamp: number | null;
}

interface Props {
  autoFocus: boolean;
  beatmapset: BeatmapsetExtendedJson & BeatmapsetWithDiscussionsJson;
  currentBeatmap: BeatmapExtendedJson;
  currentDiscussions: CurrentDiscussions;
  innerRef: React.RefObject<HTMLDivElement>;
  mode: DiscussionMode;
  pinned: boolean;
  setPinned: (flag: boolean) => void;
  stickTo: React.RefObject<HTMLElement>;
}

@observer
export class NewDiscussion extends React.Component<Props> {
  private readonly disposers = new Set<((() => void) | undefined)>();
  private readonly handleKeyDown;
  private readonly inputBox = React.createRef<HTMLTextAreaElement>();
  @observable private message = this.storedMessage;
  @observable private mounted = false;
  private nearbyDiscussionsCache: DiscussionsCache | null = null;
  @observable private posting: string | null = null;
  private postXhr: JQuery.jqXHR<BeatmapsetDiscussionPostStoreResponseJson> | null = null;
  @observable private stickToHeight: number | undefined;
  @observable private timestampConfirmed = false;

  private get canPost() {
    if (core.currentUser == null) return false;
    if (downloadLimited(this.props.beatmapset)) return false;

    return !core.currentUser.is_silenced
      && (!this.props.beatmapset.discussion_locked || canModeratePosts())
      && (this.props.currentBeatmap.deleted_at == null || this.props.mode === 'generalAll');
  }

  @computed
  private get cssTop() {
    if (this.mounted && this.props.pinned && this.stickToHeight != null) {
      return core.stickyHeader.headerHeight + this.stickToHeight;
    }
  }

  private get isTimeline() {
    return this.props.mode === 'timeline';
  }

  private get nearbyDiscussions() {
    const timestamp = this.timestamp;
    if (timestamp == null) return [];

    if (this.nearbyDiscussionsCache == null || (this.nearbyDiscussionsCache.beatmap !== this.props.currentBeatmap || this.nearbyDiscussionsCache.timestamp !== this.timestamp)) {
      this.nearbyDiscussionsCache = {
        beatmap: this.props.currentBeatmap,
        discussions: nearbyDiscussions(this.props.currentDiscussions.timelineAllUsers, timestamp),
        timestamp: this.timestamp,
      };
    }

    return this.nearbyDiscussionsCache?.discussions ?? [];
  }

  private get storageKey() {
    return `beatmapset-discussion:store:${this.props.beatmapset.id}:message`;
  }

  private get storedMessage() {
    return localStorage.getItem(this.storageKey) ?? '';
  }

  private get textareaPlaceholder() {
    if (core.currentUser == null) return;

    if (this.canPost) {
      return trans(`beatmaps.discussions.message_placeholder.${this.props.mode}`, { version: this.props.currentBeatmap.version });
    }

    if (core.currentUser.is_silenced) {
      return trans('beatmaps.discussions.message_placeholder_silenced');
    } else if (this.props.beatmapset.discussion_locked || downloadLimited(this.props.beatmapset)) {
      return trans('beatmaps.discussions.message_placeholder_locked');
    } else {
      return trans('beatmaps.discussions.message_placeholder_deleted_beatmap');
    }
  }

  @computed
  private get timestamp() {
    return this.props.mode === 'timeline'
      ? parseTimestamp(this.message)
      : null;
  }

  constructor(props: Props) {
    super(props);
    makeObservable(this);
    this.handleKeyDown = makeTextAreaHandler(this.handleKeyDownCallback);
  }

  componentDidMount() {
    this.updateStickToHeight();
    // watching for height changes on the stickTo element to handle horizontal scrollbars when they appear.
    $(window).on('resize', this.updateStickToHeight);
    this.disposers.add(core.reactTurbolinks.runAfterPageLoad(action(() => this.mounted = true)));
    if (this.props.autoFocus) {
      this.disposers.add(core.reactTurbolinks.runAfterPageLoad(() => this.inputBox.current?.focus()));
    }
  }

  componentDidUpdate(prevProps: Readonly<Props>) {
    if (prevProps.beatmapset.id !== this.props.beatmapset.id) {
      this.message = this.storedMessage;
      return;
    }
    this.storeMessage();
  }

  componentWillUnmount() {
    $(window).off('resize', this.updateStickToHeight);
    this.postXhr?.abort();
    this.disposers.forEach((disposer) => disposer?.());
  }

  render() {
    const cssClasses = classWithModifiers('beatmap-discussion-new-float', { pinned: this.props.pinned });

    return (
      <div
        className={cssClasses}
        style={{ top: this.cssTop }}
      >
        <div className='beatmap-discussion-new-float__floatable'>
          <div
            ref={this.props.innerRef}
            className='beatmap-discussion-new-float__content'
          >
            {this.renderBox()}
          </div>
        </div>
      </div>
    );
  }

  private readonly handleKeyDownCallback = (type: InputEventType | null) => {
    // Ignores SUBMIT, requiring shift-enter to add new line.
    if (type === InputEventType.Cancel) {
      this.setSticky(false);
    }
  };

  private readonly onFocus = () => this.setSticky(true);

  @action
  private readonly post = (e: React.SyntheticEvent<HTMLElement>) => {
    const type = e.currentTarget.dataset.type;
    if (type == null || !this.validPost(type) || this.postXhr != null) return;

    if (type === 'problem') {
      const problemType = this.problemType();
      if (problemType !== 'problem') {
        if (!confirm(trans(`beatmaps.nominations.reset_confirm.${problemType}`))) return;
      }
    }

    if (type === 'hype') {
      if (!confirm(trans('beatmaps.hype.confirm', { n: this.props.beatmapset.current_user_attributes.remaining_hype }))) return;
    }

    showLoadingOverlay();
    this.posting = type;

    const data = {
      beatmap_discussion: {
        beatmap_id: this.props.mode === 'generalAll' ? undefined : this.props.currentBeatmap.id,
        message_type: type,
        timestamp: this.timestamp,
      },
      beatmap_discussion_post: {
        message: this.message,
      },
      beatmapset_id: this.props.currentBeatmap.beatmapset_id,
    };

    this.postXhr = $.ajax(route('beatmapsets.discussions.posts.store'), {
      data,
      method: 'POST',
    });

    this.postXhr
      .done((json) => runInAction(() => {
        this.message = '';
        this.timestampConfirmed = false;
        $.publish('beatmapDiscussionPost:markRead', { id: json.beatmap_discussion_post_ids });
        $.publish('beatmapsetDiscussions:update', { beatmapset: json.beatmapset });
      }))
      .fail(onError)
      .always(action(() => {
        hideLoadingOverlay();
        this.postXhr = null;
        this.posting = null;
      }));
  };

  private problemType() {
    const canDisqualify = core.currentUser?.is_admin || core.currentUser?.is_moderator || core.currentUser?.is_full_bn;
    const willDisqualify = this.props.beatmapset.status === 'qualified';

    if (canDisqualify && willDisqualify) return 'disqualify';

    const canReset = core.currentUser?.is_admin || core.currentUser?.is_nat || core.currentUser?.is_bng;
    const currentNominations = nominationsCount(this.props.beatmapset.nominations, 'current');
    const willReset = this.props.beatmapset.status === 'pending' && currentNominations > 0;

    if (canReset && willReset) return 'nomination_reset';
    if (willDisqualify) return 'problem_warning';

    return 'problem';
  }

  private renderBox() {
    const canHype = this.props.beatmapset.current_user_attributes?.can_hype
      && this.props.beatmapset.can_be_hyped
      && this.props.mode === 'generalAll';

    const canPostNote = core.currentUser != null
        && (core.currentUser.id === this.props.beatmapset.user_id
          || (core.currentUser.id === this.props.currentBeatmap.user_id && ['general', 'timeline'].includes(this.props.mode))
          || core.currentUser.is_bng
          || canModeratePosts());

    const buttonCssClasses = classWithModifiers('btn-circle', { activated: this.props.pinned });

    return (
      <div className='osu-page osu-page--small'>
        <div className={bn}>
          <div className='page-title'>
            {trans('beatmaps.discussions.new.title')}

            <span className='page-title__button'>
              <span
                className={buttonCssClasses}
                onClick={this.toggleSticky}
                title={trans(`beatmaps.discussions.new.${this.props.pinned ? 'unpin' : 'pin'}`)}
              >
                <span className='btn-circle__content'>
                  <i className='fas fa-thumbtack' />
                </span>
              </span>
            </span>
          </div>
          <div className={`${bn}__content`}>
            <div className={`${bn}__avatar`}>
              <UserAvatar modifiers='full-rounded' user={core.currentUser} />
            </div>
            <div className={`${bn}__message`} id='new'>
              {this.renderTextarea()}
            </div>
          </div>

          <div className={`${bn}__footer`}>
            {this.renderTimestamp()}
            {this.renderHype()}
            <div className={`${bn}__footer-content ${bn}__footer-content--right`}>
              {canHype && this.submitButton('hype')}
              {canPostNote && this.submitButton('mapper_note')}
              {this.submitButton('praise')}
              {this.submitButton('suggestion')}
              {this.submitButton('problem')}
            </div>
          </div>
          {this.renderNearbyTimestamps()}
        </div>
      </div>
    );
  }

  private renderHype() {
    if (!(this.props.mode === 'generalAll' && this.props.beatmapset.can_be_hyped)) return null;

    return (
      <div className={`${bn}__footer-content js-hype--explanation js-flash-border`}>
        <div className={`${bn}__footer-message ${bn}__footer-message--label`}>
          {trans('beatmaps.hype.title')}
        </div>
        <div className={`${bn}__footer-message`}>
          {core.currentUser != null ? (
            <span>
              {this.props.beatmapset.current_user_attributes.can_hype ? trans('beatmaps.hype.explanation') : this.props.beatmapset.current_user_attributes.can_hype_reason}
              {(this.props.beatmapset.current_user_attributes.can_hype || this.props.beatmapset.current_user_attributes.remaining_hype <= 0) && (
                <>
                  <StringWithComponent
                    mappings={{ remaining: this.props.beatmapset.current_user_attributes.remaining_hype }}
                    pattern={` ${trans('beatmaps.hype.remaining')}`}
                  />
                  {this.props.beatmapset.current_user_attributes.new_hype_time != null && (
                    <StringWithComponent
                      mappings={{
                        new_time: <TimeWithTooltip dateTime={this.props.beatmapset.current_user_attributes.new_hype_time} relative />,
                      }}
                      pattern={` ${trans('beatmaps.hype.new_time')}`}
                    />
                  )}
                </>
              )}
            </span>
          ) : trans('beatmaps.hype.explanation_guest')}
        </div>
      </div>
    );
  }

  private renderNearbyTimestamps() {
    if (this.nearbyDiscussions.length === 0) return;
    const currentTimestamp = this.timestamp != null ? formatTimestamp(this.timestamp) : '';
    const timestamps = this.nearbyDiscussions.map((discussion) => (
      <a
        key={discussion.id}
        className='js-beatmap-discussion--jump'
        href={makeUrl({ discussion })}
      >
        {formatTimestamp(discussion.timestamp)}
      </a>
    ));

    return (
      <div className={`${bn}__notice`}>
        <div className={`${bn}__notice-text`}>
          <StringWithComponent
            mappings={{ existing_timestamps: joinComponents(timestamps), timestamp: currentTimestamp }}
            pattern={trans('beatmap_discussions.nearby_posts.notice')}
          />
        </div>

        <label className={`${bn}__notice-checkbox`}>
          <div className='osu-switch-v2'>
            <input
              checked={this.timestampConfirmed}
              className='osu-switch-v2__input'
              onChange={this.toggleTimestampConfirmation}
              type='checkbox'
            />
            <span className='osu-switch-v2__content' />
          </div>
          {trans('beatmap_discussions.nearby_posts.confirm')}
        </label>
      </div>
    );
  }

  private renderTextarea() {
    if (core.currentUser == null) return trans('beatmaps.discussions.require-login');

    return (
      <>
        <TextareaAutosize
          ref={this.inputBox}
          className={`${bn}__message-area js-hype--input`}
          disabled={this.posting != null || !this.canPost}
          onChange={this.setMessage}
          onFocus={this.onFocus}
          onKeyDown={this.handleKeyDown}
          placeholder={this.textareaPlaceholder}
          value={this.canPost ? this.message : ''}
        />

        <DiscussionMessageLengthCounter
          isTimeline={this.isTimeline}
          message={this.message}
        />
      </>
    );
  }

  private renderTimestamp() {
    if (this.props.mode !== 'timeline') return null;

    const timestamp = this.timestamp != null ? formatTimestamp(this.timestamp) : trans('beatmaps.discussions.new.timestamp_missing');

    return (
      <div className={`${bn}__footer-content`}>
        <div className={`${bn}__footer-message ${bn}__footer-message--label`}>
          {trans('beatmaps.discussions.new.timestamp')}
        </div>
        <div className={`${bn}__footer-message`}>
          {timestamp}
        </div>
      </div>
    );
  }

  @action
  private readonly setMessage = (e: React.ChangeEvent<HTMLTextAreaElement>) => {
    this.message = e.target.value;
  };

  @action
  private readonly setSticky = (sticky: boolean) => {
    this.props.setPinned(sticky);
    this.updateStickToHeight();
  };

  private storeMessage() {
    if (!present(this.message)) {
      localStorage.removeItem(this.storageKey);
    } else {
      localStorage.setItem(this.storageKey, this.message);
    }
  }

  private submitButton(type: DiscussionType) {
    const typeText = type === 'problem' ? this.problemType() : type;

    return (
      <BigButton
        disabled={!this.validPost(type) || this.posting != null || !this.canPost}
        icon={discussionTypeIcons[type]}
        isBusy={this.posting === type}
        props={{
          'data-type': type,
          onClick: this.post,
        }}
        text={trans(`beatmaps.discussions.message_type.${typeText}`)}
      />
    );
  }

  private readonly toggleSticky = () => {
    this.setSticky(!this.props.pinned);
  };

  @action
  private readonly toggleTimestampConfirmation = () => {
    this.timestampConfirmed = !this.timestampConfirmed;
  };

  @action
  private readonly updateStickToHeight = () => this.stickToHeight = this.props.stickTo?.current?.getBoundingClientRect().height;

  private validPost(type: string): type is DiscussionType {
    if (!(discussionTypes as Readonly<string[]>).includes(type)) return false;
    if (!validMessageLength(this.message, this.isTimeline)) return false;
    if (!this.isTimeline) return true;

    return this.timestamp != null
      && (type === 'mapper_note'
        || type === 'praise'
        || this.nearbyDiscussions.length === 0
        || this.timestampConfirmed);
  }
}
