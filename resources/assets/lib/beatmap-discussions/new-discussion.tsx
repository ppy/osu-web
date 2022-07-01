// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { DiscussionType, discussionTypeIcons } from 'beatmap-discussions/discussion-type'
import BigButton from 'components/big-button'
import StringWithComponent from 'components/string-with-component'
import TimeWithTooltip from 'components/time-with-tooltip'
import UserAvatar from 'components/user-avatar'
import { route } from 'laroute'
import core from 'osu-core-singleton'
import * as React from 'react'
import TextareaAutosize from 'react-autosize-textarea'
import { nominationsCount } from 'utils/beatmapset-helper'
import { validMessageLength } from 'utils/beatmapset-discussion-helper'
import { InputEventType, makeTextAreaHandler } from 'utils/input-handler'
import { hideLoadingOverlay, showLoadingOverlay } from 'utils/loading-overlay'
import { linkHtml } from 'utils/url'
import MessageLengthCounter from './message-length-counter'
import BeatmapsetJson from 'interfaces/beatmapset-json'
import BeatmapJson from 'interfaces/beatmap-json'
import CurrentUserJson from 'interfaces/current-user-json'
import BeatmapsetDiscussionJson from 'interfaces/beatmapset-discussion-json'
import { BeatmapsetDiscussionPostStoreResponseJson } from 'interfaces/beatmapset-discussion-post-responses'
import { onError } from 'utils/ajax'
import { classWithModifiers } from 'utils/css'

const bn = 'beatmap-discussion-new'

interface Props {
  beatmapset: BeatmapsetJson;
  currentBeatmap: BeatmapJson;
  currentUser: CurrentUserJson;
  discussion: BeatmapsetDiscussionJson & Required<Pick<BeatmapsetDiscussionJson, 'current_user_attributes'>>;
}

interface State {
  cssTop: number | null;
  message: string;
  timestampConfirmed: boolean;
  posting: string | null;
}

export class NewDiscussion extends React.PureComponent<Props, State> {
  state: Readonly<State> = {
    cssTop: null,
    message: this.storedMessage,
    timestampConfirmed: false,
    posting: null,
  };

  private readonly disposers = new Set<(() => void | undefined)>();
  private readonly inputBox = new React.createRef<HTMLTextAreaElement>();
  private readonly handleKeyDown;
  private postXhr: JQuery.jqXHR<BeatmapsetDiscussionPostStoreResponseJson> | null = null;

  private get canPost() {
    return !this.props.currentUser.is_silenced
      && (!this.props.beatmapset.discussion_locked
        || BeatmapDiscussionHelper.canModeratePosts(this.props.currentUser))
      && (this.props.currentBeatmap.deleted_at == null || this.props.mode == 'generalAll');
  }

  private get isTimeline() {
    return this.props.mode === 'timeline';
  }

  private get storageKey() {
    return `beatmapset-discussion:store:${this.props.beatmapset.id}:message`;
  }

  private get storedMessage() {
    return localStorage.getItem(this.storageKey) ?? '';
  }

  private get validPost() {
    if (!validMessageLength(this.state.message, this.isTimeline)) return false;

    if (this.isTimeline) {
      this.timestamp() != null && (this.nearbyDiscussions().length == 0 || this.state.timestampConfirmed);
    }

    return true;
  }

  constructor(props: Props) {
    super(props)
    this.handleKeyDown = makeTextAreaHandler(this.handleKeyDownCallback);
  }

  componentDidMount() {
    this.setTop();
    $(window).on('resize', this.setTop);

    if (this.props.autoFocus) {
      this.disposers.add(core.reactTurbolinks.runAfterPageLoad(() => this.inputBox.current?.focus()));
    }
  }

  componentDidUpdate(prevProps: Readonly<Props>) {
    if (prevProps.beatmapset.id !== this.props.beatmapset.id) {
      this.setState({ message: this.storedMessage });
      return;
    }
    this.storeMessage();
  }

  componentWillUnmount() {
    $(window).off('resize', this.setTop);
    this.postXhr?.abort();
    this.disposers.forEach((disposer) => disposer?.())
  }

  render() {
    const cssClasses = classWithModifiers('beatmap-discussion-new-float', { pinned: this.props.pinned })

    return (
      <div
        className={cssClasses}
        style={{ top: this.state.cssTop }}
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

  private cssTop(sticky) {
    if (!sticky || this.props.stickTo?.current == null) return;
    return core.stickyHeader.headerHeight + this.props.stickTo.current.getBoundingClientRect().height;

  }

  private handleKeyDownCallback = (type: InputEventType | null, event: React.KeyboardEvent<HTMLTextAreaElement>) => {
    // Ignores SUBMIT, requiring shift-enter to add new line.
    if (type === InputEventType.Cancel) {
      this.setSticky(false);
    }
  }

  private readonly onFocus = () => this.setSticky(true);

  private messagePlaceholder() {
    if (this.canPost) {
      return osu.trans(`beatmaps.discussions.message_placeholder.${this.props.mode}`, { version: this.props.currentBeatmap.version });
    }

    if (this.props.currentUser.is_silenced) {
      return osu.trans('beatmaps.discussions.message_placeholder_silenced')
    } else if (this.props.beatmapset.discussion_locked) {
      return osu.trans('beatmaps.discussions.message_placeholder_locked')
    } else {
      return osu.trans('beatmaps.discussions.message_placeholder_deleted_beatmap')
    }
  }

  private nearbyDiscussions() {
    if (this.timestamp() == null) return [];

    if (this.nearbyDiscussionsCache == null || (this.nearbyDiscussionsCache.beatmap != this.props.currentBeatmap || this.nearbyDiscussionsCache.timestamp != this.timestamp())) {
      this.nearbyDiscussionsCache = {
        beatmap: this.props.currentBeatmap,
        discussions: BeatmapDiscussionHelper.nearbyDiscussions(this.props.currentDiscussions.timelineAllUsers, this.timestamp()),
        timestamp: this.timestamp(),
      }
    }

    return this.nearbyDiscussionsCache.discussions;
  }

  private readonly post = (e: React.SyntheticEvent<HTMLElement>) => {
    if (!this.validPost || this.postXhr != null) return;

    const type = e.currentTarget.dataset.type

    if (type === 'problem') {
      const problemType = this.problemType();
      if (problemType !== 'problem') {
        if (!confirm(osu.trans(`beatmaps.nominations.reset_confirm.${problemType}`))) return;
      }
    }

    if (type === 'hype') {
      if (!confirm(osu.trans('beatmaps.hype.confirm', { n: this.props.beatmapset.current_user_attributes.remaining_hype }))) return;
    }

    showLoadingOverlay()
    this.setState({ posting: type });

    const data = {
      beatmapset_id: this.props.currentBeatmap.beatmapset_id,
      beatmap_discussion: {
        beatmap_id: this.props.mode === 'generalAll' ? undefined : this.props.currentBeatmap.id,
        timestamp: this.timestamp(),
        message_type: type,
      },
      beatmap_discussion_post: {
        message: this.state.message
      }
    };

    this.postXhr = $.ajax(route('beatmapsets.discussions.posts.store'), {
      data,
      method: 'POST',
    });

    this.postXhr
      .done((json) => {
        this.setState({
          message: '',
          timestampConfirmed: false,
        });
        $.publish('beatmapDiscussionPost:markRead', { id: json.beatmap_discussion_post_id });
        $.publish('beatmapsetDiscussions:update', { beatmapset: json.beatmapset });
      })
      .fail(onError)
      .always(() => {
        hideLoadingOverlay()
        this.postXhr = null;
        this.setState({ posting: null });
      });
  }

  private problemType() {
    const canDisqualify = currentUser.is_admin || currentUser.is_moderator || currentUser.is_full_bn;
    const willDisqualify = this.props.beatmapset.status === 'qualified';

    if (canDisqualify && willDisqualify) return 'disqualify';

    const canReset = currentUser.is_admin || currentUser.is_nat || currentUser.is_bng;
    const currentNominations = nominationsCount(this.props.beatmapset.nominations, 'current');
    const willReset = this.props.beatmapset.status === 'pending' && currentNominations > 0

    if (canReset && willReset) return 'nomination_reset';
    if (willDisqualify) return 'problem_warning';

    return 'problem';
  }

  private renderBox() {
    const canHype = this.props.beatmapset.current_user_attributes?.can_hype
      && this.props.beatmapset.can_be_hyped
      && this.props.mode == 'generalAll';

      const canPostNote =
        this.props.currentUser.id === this.props.beatmapset.user_id
          || (this.props.currentUser.id === this.props.currentBeatmap.user_id && this.props.mode in ['general', 'timeline'])
          || this.props.currentUser.is_bng
          || BeatmapDiscussionHelper.canModeratePosts(this.props.currentUser)

    const buttonCssClasses = classWithModifiers('btn-circle', { activated: this.props.pinned });

    return (
      <div className='osu-page osu-page--small'>
        <div className={bn}>
          <div className='page-title'>
            {osu.trans('beatmaps.discussions.new.title')}

            <span className='page-title__button'>
              <span
                className={buttonCssClasses}
                onClick={this.toggleSticky}
                title={osu.trans(`beatmaps.discussions.new.${this.props.pinned ? 'unpin' : 'pin'}`)}
              >
                <span className={'btn-circle__content'}>
                  <i className={'fas fa-thumbtack'} />
                </span>
              </span>
            </span>
          </div>
          <div className={`${bn}__content`}>
            <div className={`${bn}__avatar`}>
              <UserAvatar user={this.props.currentUser} modifiers='full-rounded' />
            </div>
            <div className={`${bn}__message`} id='new'>
              {this.props.currentUser?.id != null ? (
                <>
                  <TextareaAutosize
                    key='input'
                    className={`${bn}__message-area js-hype--input`}
                    disabled={this.state.posting != null || !this.canPost}
                    value={this.canPost ? this.state.message : ''}
                    onChange={this.setMessage}
                    onKeyDown={this.handleKeyDown}
                    onFocus={this.onFocus}
                    ref={this.inputBox}
                    placeholder={this.messagePlaceholder()}
                  />

                  <MessageLengthCounter
                    key='counter'
                    message={this.state.message}
                    isTimeline={this.isTimeline}
                  />
                </>
              ) : osu.trans('beatmaps.discussions.require-login')}
            </div>
          </div>

          <div className={`${bn}__footer`}>
            <div
              className={`${bn}__footer-content js-hype--explanation js-flash-border`}
              style={{
                opacity: this.props.mode !== 'timeline' && !(this.props.mode === 'generalAll' && this.props.beatmapset.can_be_hyped) ? '0' : undefined
              }}
            >
              <div key='label' className={`${bn}__timestamp-col ${bn}__timestamp-col--label`}>
                {/* # mode == 'generalAll' */}
                {this.props.mode === 'timeline' ? osu.trans('beatmaps.discussions.new.timestamp') : osu.trans('beatmaps.hype.title')}
              </div>
              <div key='timestamp' className={`${bn}__timestamp-col`}>
                {this.renderTimestamp()}
                {this.renderHype()}
                {this.renderGuest()}
              </div>
            </div>
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

  private renderTimestamp() {
    if (this.props.mode !== 'timeline') return null;

    return this.timestamp() != null ? BeatmapDiscussionHelper.formatTimestamp(this.timestamp()) : osu.trans('beatmaps.discussions.new.timestamp_missing')
  }

  private renderHype() {
    if (!(this.props.mode === 'generalAll' && this.props.beatmapset.can_be_hyped)) return null;
    if (this.props.currentUser?.id == null) return null;

    return (
      <>
        {this.props.beatmapset.current_user_attributes.can_hype ? osu.trans('beatmaps.hype.explanation') : this.props.beatmapset.current_user_attributes.can_hype_reason}
        {(this.props.beatmapset.current_user_attributes.can_hype || this.props.beatmapset.current_user_attributes.remaining_hype <= 0) && (
          <>
            <StringWithComponent
              mappings={{ remaining: this.props.beatmapset.current_user_attributes.remaining_hype }}
              pattern={` ${osu.trans('beatmaps.hype.remaining')}`}
            />
            {this.props.beatmapset.current_user_attributes.new_hype_time != null && (
              <StringWithComponent
                mappings={{
                  new_time: <TimeWithTooltip dateTime={this.props.beatmapset.current_user_attributes.new_hype_time} relative />
                }}
                pattern={` ${osu.trans('beatmaps.hype.new_time')}`}
              />
            )}
          </>
        )}
      </>
    );
  }

  private renderNearbyTimestamps() {
    if (!this.nearbyDiscussions()?.length) return;
    const currentTimestamp = BeatmapDiscussionHelper.formatTimestamp(this.timestamp());
    const timestamps = this.nearbyDiscussions().map((discussion) => (
      linkHtml(
        BeatmapDiscussionHelper.url({ discussion: discussion }),
        BeatmapDiscussionHelper.formatTimestamp(discussion.timestamp),
        { classNames: ['js-beatmap-discussion--jump'] }
      )
    ));

    const timestampsString = osu.transArray(timestamps);

    return (
      <div className={`${bn}__notice`}>
        <div
          className={`${bn}__notice-text`}
          dangerouslySetInnerHTML={{
            __html: osu.trans('beatmap_discussions.nearby_posts.notice', {
              existing_timestamps: timestampsString,
              timestamp: currentTimestamp,
            })
          }}
        />

        <label className={`${bn}__notice-checkbox`}>
          <div className={'osu-switch-v2'}>
            <input
              className={'osu-switch-v2__input'}
              type='checkbox'
              checked={this.state.timestampConfirmed}
              onChange={this.toggleTimestampConfirmation}
            />
            <span className={'osu-switch-v2__content'} />
          </div>
          osu.trans('beatmap_discussions.nearby_posts.confirm')
        </label>
      </div>
    );
  }

  private renderGuest() {
    if (!(this.props.mode === 'generalAll' && this.props.beatmapset.can_be_hyped)) return null;
    if (this.props.currentUser?.id != null) return null;
    return osu.trans('beatmaps.hype.explanation_guest');
  }

private readonly setMessage = (e: React.ChangeEvent<HTMLTextAreaElement>) => {
    this.setState({ message: e.target.value });
  };

  // TODO: to whoever refactors this - this 'sticky' behaviour was ported to new-review.tsx, so remember to refactor that too
  private readonly setSticky = (sticky = true) => {
    this.setState({ cssTop: this.cssTop(sticky) });
    this.props.setPinned?.(sticky);
  };

  private readonly setTop = () => {
    this.setState({ cssTop: this.cssTop(this.props.pinned) })
  };

  private storeMessage() {
    if (!osu.present(this.state.message)) {
      localStorage.removeItem(this.storageKey);
    } else {
      localStorage.setItem(this.storageKey, this.state.message);
    }
  }

  private submitButton(type: DiscussionType) {
    const typeText = type === 'problem' ? this.problemType() : type;
    const props = {
      'data-type': type,
      onClick: this.post,
    };

    return (
      <BigButton
        key={type}
        disabled={!this.validPost || this.state.posting != null || !this.canPost}
        icon={discussionTypeIcons[type]}
        isBusy={this.state.posting == type}
        modifiers={'beatmap-discussion-new'}
        text={osu.trans(`beatmaps.discussions.message_type.${typeText}`)}
        props={props}
      />
    )
  }

  private timestamp() {
    if (this.props.mode !== 'timeline') return;

    if (this.timestampCache?.message !== this.state.message) {
      this.timestampCache = null;
    }

    if (this.timestampCache == null) {
      this.timestampCache = {
        message: this.state.message,
        timestamp: BeatmapDiscussionHelper.parseTimestamp(this.state.message);
      };
    }

    return this.timestampCache.timestamp;
  }

  private readonly toggleSticky = () => {
    this.setSticky(!this.props.pinned);
  };

  private readonly toggleTimestampConfirmation = () => {
    this.setState({ timestampConfirmed: !this.state.timestampConfirmed })
  };
}
