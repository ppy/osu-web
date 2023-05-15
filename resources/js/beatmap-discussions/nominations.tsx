// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapsOwnerEditor from 'beatmap-discussions/beatmaps-owner-editor';
import LoveBeatmapModal from 'beatmap-discussions/love-beatmap-modal';
import { Nominator } from 'beatmap-discussions/nominator';
import PlainTextPreview from 'beatmap-discussions/plain-text-preview';
import BigButton from 'components/big-button';
import DiscreteBar from 'components/discrete-bar';
import Modal from 'components/modal';
import StringWithComponent from 'components/string-with-component';
import TimeWithTooltip from 'components/time-with-tooltip';
import UserLink from 'components/user-link';
import { BeatmapsetDiscussionJsonForShow } from 'interfaces/beatmapset-discussion-json';
import BeatmapsetEventJson from 'interfaces/beatmapset-event-json';
import { BeatmapsetNominationsInterface } from 'interfaces/beatmapset-json';
import BeatmapsetWithDiscussionsJson from 'interfaces/beatmapset-with-discussions-json';
import GameMode from 'interfaces/game-mode';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import { find, findLast, keys } from 'lodash';
import { action, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import { deletedUser } from 'models/user';
import moment from 'moment';
import core from 'osu-core-singleton';
import * as React from 'react';
import { onError } from 'utils/ajax';
import { canModeratePosts, makeUrl } from 'utils/beatmapset-discussion-helper';
import { nominationsCount } from 'utils/beatmapset-helper';
import { joinComponents, trans, transExists } from 'utils/lang';
import { hideLoadingOverlay, showImmediateLoadingOverlay } from 'utils/loading-overlay';
import { pageChange } from 'utils/page-change';
import { presence } from 'utils/string';
import { wikiUrl } from 'utils/url';
import CurrentDiscussions from './current-discussions';

const bn = 'beatmap-discussion-nomination';
const dateFormat = 'LL';
const flashClass = 'js-flash-border--on';
const hypeMessage = '.js-hype--explanation';

interface Props {
  beatmapset: BeatmapsetWithDiscussionsJson;
  currentDiscussions: CurrentDiscussions;
  discussions: Partial<Record<number, BeatmapsetDiscussionJsonForShow>>;
  events: BeatmapsetEventJson[];
  users: Partial<Record<number, UserJson>>;
}

type XhrType = 'delete' | 'discussionLock' | 'removeFromLoved';

function discussionIdFromEvent(event: BeatmapsetEventJson) {
  return event.comment != null
    && typeof event.comment === 'object'
    && 'beatmap_discussion_id' in event.comment
    ? event.comment.beatmap_discussion_id
    : null;
}

@observer
export class Nominations extends React.PureComponent<Props> {
  @observable private changeOwnerModal = false;
  private hypeFocusTimeout: number | undefined;
  @observable private loveBeatmapModal = false;

  private xhr: Partial<Record<XhrType, JQuery.jqXHR<BeatmapsetWithDiscussionsJson>>> = {};

  private get isHybridMode() {
    return keys(this.props.beatmapset.nominations?.required).length > 1;
  }

  private get userCanDisqualify() {
    return core.currentUser != null && (core.currentUser.is_admin || core.currentUser.is_moderator || core.currentUser.is_full_bn);
  }

  private get userIsOwner() {
    return core.currentUser != null && (core.currentUser.id === this.props.beatmapset.user_id);
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  componentDidMount() {
    pageChange();
  }

  componentDidUpdate() {
    pageChange();
  }

  componentWillUnmount() {
    Object.values(this.xhr).forEach((xhr) => xhr?.abort());
    window.clearTimeout(this.hypeFocusTimeout);
  }

  render() {
    return (
      <div className={bn}>
        {this.renderChangeOwnerModal()}
        {this.renderLoveBeatmapModal()}
        <div className={`${bn}__items ${bn}__items--messages`}>
          <div className={`${bn}__item`}>{this.renderStatusMessage()}</div>
          <div className={`${bn}__item`}>{this.renderHypeBar()}</div>
          <div className={`${bn}__item`}>{this.renderNominationBar()}</div>
          <div className={`${bn}__item`}>{this.renderDisqualificationMessage()}</div>
          <div className={`${bn}__item`}>{this.renderNominationResetMessage()}</div>
          <div className={`${bn}__item`}>{this.renderDiscussionLockMessage()}</div>
          <div className={`${bn}__item ${bn}__item--nominators`}>{this.renderNominatorsList()}</div>
        </div>
        <div className={`${bn}__items ${bn}__items--buttons`}>
          <div className={`${bn}__items-grouping`}>
            <div className={`${bn}__item`}>{this.renderFeedbackButton()}</div>
            <div className={`${bn}__item`}>{this.renderHypeButton()}</div>
            <div className={`${bn}__item`}>{this.renderDisqualifyButton()}</div>
            <div className={`${bn}__item`}>
              <Nominator
                beatmapset={this.props.beatmapset}
                currentHype={this.props.currentDiscussions.totalHype}
                unresolvedIssues={this.props.currentDiscussions.unresolvedIssues}
                users={this.props.users}
              />
            </div>
          </div>
          <div className={`${bn}__items-grouping`}>
            <div className={`${bn}__item`}>{this.renderDiscussionLockButton()}</div>
            <div className={`${bn}__item`}>{this.renderLoveButton()}</div>
            <div className={`${bn}__item`}>{this.renderRemoveFromLovedButton()}</div>
            <div className={`${bn}__item`}>{this.renderDeleteButton()}</div>
            <div className={`${bn}__item`}>{this.renderChangeOwnerButton()}</div>
          </div>
        </div>
      </div>
    );
  }

  private readonly delete = () => {
    if (this.xhr.delete != null) return;

    const message = this.userIsOwner
      ? trans('beatmaps.nominations.delete_own_confirm')
      : trans('beatmaps.nominations.delete_other_confirm');

    if (!confirm(message)) return;

    showImmediateLoadingOverlay();

    this.xhr.delete = $.ajax(
      route('beatmapsets.destroy', { beatmapset: this.props.beatmapset.id }),
      { method: 'DELETE' },
    )
      .done(() => Turbolinks.visit(route('users.show', { user: this.props.beatmapset.user_id })))
      .fail(onError)
      .always(action(() => {
        this.xhr.delete = undefined;
        hideLoadingOverlay();
      }));
  };

  private readonly discussionLock = () =>{
    if (this.xhr.discussionLock != null) return;

    const reason = presence(prompt(trans('beatmaps.discussions.lock.prompt.lock')));

    if (reason == null) return;

    this.xhr.discussionLock = $.ajax(
      route('beatmapsets.discussion-lock', { beatmapset: this.props.beatmapset.id }),
      { data: { reason }, method: 'POST' },
    );

    this.xhr.discussionLock
      .done((beatmapset) => {
        $.publish('beatmapsetDiscussions:update', { beatmapset });
      })
      .fail(onError)
      .always(action(() => {
        this.xhr.discussionLock = undefined;
        hideLoadingOverlay();
      }));
  };

  private readonly discussionUnlock = () =>{
    if (this.xhr.discussionLock != null) return;

    if (!confirm(trans('beatmaps.discussions.lock.prompt.unlock'))) return;

    showImmediateLoadingOverlay();

    this.xhr.discussionLock = $.ajax(
      route('beatmapsets.discussion-unlock', { beatmapset: this.props.beatmapset.id }),
      { method: 'POST' },
    );

    this.xhr.discussionLock
      .done((beatmapset) =>{
        $.publish('beatmapsetDiscussions:update', { beatmapset });
      })
      .fail(onError)
      .always(action(() => {
        this.xhr.discussionLock = undefined;
        hideLoadingOverlay();
      }));
  };

  private readonly focusHypeInput = () => {
    // switch to generalAll tab, set current filter to praises
    $.publish('beatmapsetDiscussions:update', {
      filter: 'praises',
      mode: 'generalAll',
    });

    this.hypeFocusTimeout = window.setTimeout(() => {
      this.focusNewDiscussion(() => {
        // flash border of hype description to emphasize input is required
        $(hypeMessage).addClass(flashClass);
        this.hypeFocusTimeout = window.setTimeout(() => {
          $(hypeMessage).removeClass(flashClass);
        }, 1000);
      });
    }, 0);
  };

  private focusNewDiscussion(this: void, callback: () => void) {
    const inputBox = $('.js-hype--input');
    inputBox.trigger('focus');

    // ensure input box is in view and focus it
    $.scrollTo(inputBox, 200, {
      interrupt: true,
      offset: -100,
      onAfter: callback,
    });
  }

  private focusNewDiscussionWithModeSwitch = () => {
    // Switch to generalAll tab just in case currently in event tab
    // and thus new discussion box isn't visible.
    $.publish('beatmapsetDiscussions:update', {
      callback: this.focusNewDiscussion,
      mode: 'generalAll',
      modeIf: 'events',
    });
  };

  @action
  private readonly handleChangeOwnerClick = () => this.changeOwnerModal = !this.changeOwnerModal;

  @action
  private readonly handleLoveBeatmapModal = () => this.loveBeatmapModal = !this.loveBeatmapModal;

  private parseEventData(event: BeatmapsetEventJson) {
    const user = event.user_id != null ? this.props.users[event.user_id] : null;
    const discussionId = discussionIdFromEvent(event);
    const discussion = discussionId != null ? this.props.discussions[discussionId] : null;
    const post = discussion?.posts[0];

    let link: React.ReactNode;
    let message: React.ReactNode;

    // extra conditionals are for typing.
    if (discussion != null && post != null && !post.system) {
      link = <a className='js-beatmap-discussion--jump' href={makeUrl({ discussion })}>{`#${discussion.id}`}</a>;
      message = <PlainTextPreview markdown={post.message} />;
    } else {
      link = discussionId != null ? `#${discussionId}` : null;
      message = trans('beatmaps.nominations.reset_message_deleted');
    }

    return { discussion, link, message, user };
  }

  private readonly removeFromLoved = () => {
    const reason = presence(prompt(trans('beatmaps.nominations.remove_from_loved_prompt')));

    if (reason == null) return;

    showImmediateLoadingOverlay();

    this.xhr.removeFromLoved = $.ajax(
      route('beatmapsets.remove-from-loved', { beatmapset: this.props.beatmapset.id }),
      { data: { reason }, method: 'DELETE' },
    );

    this.xhr.removeFromLoved
      .done((beatmapset) =>
        $.publish('beatmapsetDiscussions:update', { beatmapset }),
      )
      .fail(onError)
      .always(action(() => {
        this.xhr.removeFromLoved = undefined;
        hideLoadingOverlay();
      }));
  };

  private renderChangeOwnerButton() {
    if (!this.props.beatmapset.current_user_attributes?.can_beatmap_update_owner) return null;

    return (
      <BigButton
        icon='fas fa-pen'
        props={{
          onClick: this.handleChangeOwnerClick,
        }}
        text={trans('beatmap_discussions.owner_editor.button')}
      />
    );
  }

  private renderChangeOwnerModal() {
    if (!this.changeOwnerModal) return null;

    return (
      <Modal>
        <LoveBeatmapModal
          beatmapset={this.props.beatmapset}
          onClose={this.handleLoveBeatmapModal}
        />
      </Modal>
    );
  }

  private renderDeleteButton() {
    if (!this.props.beatmapset.current_user_attributes?.can_delete) return null;

    return (
      <BigButton
        disabled={this.xhr.delete != null}
        icon='fas fa-trash'
        modifiers='danger'
        props={{
          onClick: this.delete,
        }}
        text={trans('beatmaps.nominations.delete')}
      />
    );
  }

  private renderDiscussionLockButton() {
    if (!canModeratePosts()) return null;

    const buttonProps = this.props.beatmapset.discussion_locked
      ? {
        action: 'unlock',
        icon: 'fas fa-unlock',
        props: {
          onClick: this.discussionUnlock,
        },
      } : {
        action: 'lock',
        icon: 'fas fa-lock',
        props: {
          onClick: this.discussionLock,
        },
      };

    return <BigButton {...buttonProps} disabled={this.xhr.discussionLock != null} text={trans('beatmaps.nominations.disqualify')} />;
  }

  private renderDiscussionLockMessage() {
    if (!this.props.beatmapset.discussion_locked) return null;

    const lockEvent = findLast(this.props.events, { type: 'discussion_lock' });

    if (lockEvent == null || lockEvent.type !== 'discussion_lock') return null;

    return (
      <StringWithComponent
        mappings={{
          text: lockEvent.comment?.reason,
        }}
        pattern={trans('beatmapset_events.event.discussion_lock')}
      />
    );
  }

  private renderDisqualificationMessage() {
    const showHype = this.props.beatmapset.can_be_hyped;
    const disqualification = this.props.beatmapset.nominations.disqualification;
    const mapIsQualified = this.props.beatmapset.status === 'qualified';

    if (!showHype || mapIsQualified || disqualification == null) return null;

    return <div>{this.renderResetReason(disqualification)}</div>;
  }

  private renderDisqualifyButton() {
    const mapIsQualified = this.props.beatmapset.status === 'qualified';

    if (!(mapIsQualified && this.userCanDisqualify)) return null;

    return (
      <BigButton
        icon='fas fa-thumbs-down'
        modifiers='warning'
        props={{
          onClick: this.focusNewDiscussionWithModeSwitch,
        }}
        text={trans('beatmaps.nominations.disqualify')}
      />
    );
  }

  private renderFeedbackButton() {
    if (core.currentUser == null || this.userIsOwner || this.props.beatmapset.can_be_hyped || this.props.beatmapset.discussion_locked) {
      return null;
    }

    return (
      <BigButton
        icon='fas fa-bullhorn'
        props={{
          onClick: this.focusNewDiscussionWithModeSwitch,
        }}
        text={trans('beatmaps.feedback.button')}
      />
    );
  }

  private renderHypeBar() {
    if (!this.props.beatmapset.can_be_hyped || this.props.beatmapset.hype == null) return null;

    const requiredHype = this.props.beatmapset.hype.required;
    const hypeRaw = this.props.currentDiscussions.totalHype;
    const hype = Math.min(requiredHype, hypeRaw);

    return (
      <div>
        <div className={`${bn}__header`}>
          <span className={`${bn}__title`}>{trans('beatmaps.hype.section_title')}</span>
          <span>{`${hypeRaw} / ${requiredHype}`}</span>
        </div>
        <DiscreteBar
          current={hype}
          modifiers='beatmapset-hype'
          total={requiredHype}
        />
      </div>
    );
  }

  private renderHypeButton() {
    if (!this.props.beatmapset.can_be_hyped || core.currentUser == null || this.userIsOwner) return null;

    const userAlreadyHyped = find(this.props.currentDiscussions.byFilter.hype.generalAll, { user_id: core.currentUser.id }) != null;

    return (
      <BigButton
        disabled={!this.props.beatmapset.current_user_attributes.can_hype}
        icon='fas fa-bullhorn'
        modifiers='warning'
        props={{
          onClick: this.focusHypeInput,
          title: this.props.beatmapset.current_user_attributes?.can_hype_reason,
        }}
        text={userAlreadyHyped ? trans('beatmaps.hype.button_done') : trans('beatmaps.hype.button')}
      />
    );
  }

  // nominations = { 'current': { 'osu': 1, 'taiko': 0, ... }, 'required': { 'osu': 2, 'taiko': 2, ... }, ... };
  private renderLightsForNominations(nominations?: BeatmapsetNominationsInterface) {
    if (nominations == null) return null;

    if (nominations.legacy_mode || !this.isHybridMode) {
      let current: number;
      let required: number;

      if (nominations.legacy_mode) {
        current = nominations.current;
        required = nominations.required;
      } else {
        const mode = Object.keys(nominations.required)[0] as GameMode;
        current = nominations.current[mode] ?? 0;
        required = nominations.required[mode] ?? 0;
      }

      return <DiscreteBar current={current} modifiers='beatmapset-hype' total={required} />;
    } else {
      return (
        <div className={`${bn}__discrete-bar-group`}>
          {Object.entries(nominations.required).map(([ruleset, required]: [GameMode, number]) => (
            <DiscreteBar
              key={ruleset}
              current={nominations.current[ruleset] ?? 0}
              label={<i className={`fal fa-extra-mode-${ruleset}`} />}
              modifiers='beatmapset-nomination-hybrid'
              total={required}
            />
          ))}
        </div>
      );
    }
  }

  private renderLoveBeatmapModal() {
    if (!this.loveBeatmapModal) return null;

    return (
      <Modal>
        <BeatmapsOwnerEditor
          beatmapset={this.props.beatmapset}
          onClose={this.handleChangeOwnerClick}
          users={this.props.users}
        />
      </Modal>
    );
  }

  private renderLoveButton() {
    if (!this.props.beatmapset.current_user_attributes?.can_love) return null;

    return (
      <BigButton
        icon='fas fa-heart'
        modifiers='pink'
        props={{
          onClick: this.handleLoveBeatmapModal,
        }}
        text={trans('beatmaps.nominations.love')}
      />
    );
  }

  private renderNominationBar() {
    const requiredHype = this.props.beatmapset.hype?.required ?? 0; // TODO: skip if null?
    const hypeRaw = this.props.currentDiscussions.totalHype;
    const mapCanBeNominated = this.props.beatmapset.status === 'pending' && hypeRaw >= requiredHype;
    const mapIsQualified = this.props.beatmapset.status === 'qualified';

    if (!(mapCanBeNominated || mapIsQualified)) return null;

    const nominations = this.props.beatmapset.nominations;

    return (
      <div>
        <div className={`${bn}__header`}>
          <span className={`${bn}__title`}>{trans('beatmaps.nominations.title')}</span>
          <span>{` ${nominationsCount(nominations, 'current')} / ${nominationsCount(nominations, 'required')}`}</span>
        </div>
        {this.renderLightsForNominations(nominations)}
      </div>
    );
  }

  private renderNominationResetMessage() {
    const showHype = this.props.beatmapset.can_be_hyped;
    const nominationReset = this.props.beatmapset.nominations.nomination_reset;
    const mapIsQualified = this.props.beatmapset.status === 'qualified';

    if (!showHype || mapIsQualified || nominationReset == null) return null;

    return <div>{this.renderResetReason(nominationReset)}</div>;
  }

  private renderNominatorsList() {
    if (!['wip', 'pending', 'ranked', 'qualified'].includes(this.props.beatmapset.status)) return null;

    const nominators: UserJson[] = [];
    for (let i = this.props.events.length - 1; i >= 0; i--) {
      const event = this.props.events[i];
      if (event.type === 'disqualify' || event.type === 'nomination_reset') {
        break;
      }

      if (event.type === 'nominate' && event.user_id != null) {
        const user = this.props.users[event.user_id]; // for typing
        if (user != null) {
          nominators.unshift(user);
        }
      }
    }

    if (nominators.length === 0 ) return null;

    return (
      <span>
        <StringWithComponent
          mappings={{
            users: joinComponents(nominators.map((user) => <UserLink key={user.id} user={user} />)),
          }}
          pattern={trans('beatmaps.nominations.nominated_by')}
        />
      </span>
    );
  }

  private renderRemoveFromLovedButton() {
    if (!this.props.beatmapset.current_user_attributes?.can_remove_from_loved) return null;

    return (
      <BigButton
        disabled={this.xhr.removeFromLoved != null}
        icon='fas fa-heart-broken'
        modifiers='pink'
        props={{
          onClick: this.removeFromLoved,
        }}
        text={trans('beatmaps.nominations.remove_from_loved')}
      />
    );
  }

  private renderResetReason(event: BeatmapsetEventJson) {
    if (event.type === 'disqualify' && typeof event.comment !== 'object') {
      const reason = event.comment != null
        ? <PlainTextPreview markdown={event.comment} />
        : trans('beatmaps.nominations.disqualified_no_reason');

      return (
        <StringWithComponent
          mappings={{
            reason,
            time_ago: <TimeWithTooltip dateTime={event.created_at} relative />,
          }}
          pattern={trans('beatmaps.nominations.disqualified_at')}
        />
      );
    }

    const parsedEvent = this.parseEventData(event);

    return (
      <StringWithComponent
        mappings={{
          discussion: parsedEvent.link,
          message: parsedEvent.message,
          time_ago: <TimeWithTooltip dateTime={event.created_at} relative />,
          user: <UserLink user={parsedEvent.user ?? deletedUser} />,
        }}
        pattern={trans(`beatmaps.nominations.reset_at.${event.type}`)}
      />
    );
  }

  private renderStatusMessage() {
    switch (this.props.beatmapset.status) {
      case 'approved':
      case 'loved':
      case 'ranked':
        return trans(`beatmaps.discussions.status-messages.${this.props.beatmapset.status}`, { date: moment(this.props.beatmapset.ranked_date).format(dateFormat) });
      case 'graveyard':
        return trans('beatmaps.discussions.status-messages.graveyard', { date: moment(this.props.beatmapset.last_updated).format(dateFormat) });
      case 'wip':
        return trans('beatmaps.discussions.status-messages.wip');
      case 'qualified': {
        const rankingEta = this.props.beatmapset.nominations.ranking_eta;
        const date = rankingEta != null
          ? transExists('beatmaps.nominations.rank_estimate.on')
            ? trans('beatmaps.nominations.rank_estimate.on', { date: moment(rankingEta).format(dateFormat) })
            : moment(rankingEta).format(dateFormat)
          : trans('beatmaps.nominations.rank_estimate.soon');

        return (
          <StringWithComponent
            mappings={{
              date,
              position: this.props.beatmapset.nominations.ranking_queue_position,
              queue: (
                <a
                  href={wikiUrl('Beatmap_ranking_procedure/Ranking_queue')}
                  rel='noreferrer'
                  target='_blank'
                >
                  {trans('beatmaps.nominations.rank_estimate.queue')}
                </a>
              ),
            }}
            pattern={trans('beatmaps.nominations.rank_estimate._')}
          />
        );
      }
    }

    return null;
  }
}
