// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BigButton from 'components/big-button';
import Modal from 'components/modal';
import BeatmapsetEventJson from 'interfaces/beatmapset-event-json';
import BeatmapsetWithDiscussionsJson from 'interfaces/beatmapset-with-discussions-json';
import GameMode from 'interfaces/game-mode';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import { forEachRight, map, uniq } from 'lodash';
import { action, computed, makeObservable, observable } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { onError } from 'utils/ajax';
import { isUserFullNominator } from 'utils/beatmapset-discussion-helper';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';

interface Props {
  beatmapset: BeatmapsetWithDiscussionsJson;
  currentHype: number;
  unresolvedIssues: number;
  users: Partial<Record<number, UserJson>>;
}

const bn = 'nomination-dialog';

@observer
export class Nominator extends React.Component<Props> {
  private checkboxContainerRef = React.createRef<HTMLDivElement>();
  @observable private loading = false;
  @observable private selectedModes: GameMode[] = [];
  @observable private visible = false;
  private xhr?: JQuery.jqXHR<BeatmapsetWithDiscussionsJson>;

  private get mapCanBeNominated() {
    if (this.props.beatmapset.hype == null) {
      return false;
    }

    return this.props.beatmapset.status === 'pending' && this.props.currentHype >= this.props.beatmapset.hype.required;
  }

  private get nominationEvents() {
    const nominations: BeatmapsetEventJson[] = [];

    forEachRight(this.props.beatmapset.events, (event) => {
      if (event.type === 'nomination_reset') {
        return false;
      }

      if (event.type === 'nominate') {
        nominations.push(event);
      }
    });

    return nominations;
  }

  @computed
  private get playmodes() {
    return this.props.beatmapset.nominations.legacy_mode
      ? null
      : Object.keys(this.props.beatmapset.nominations.required) as GameMode[];
  }

  private get userCanNominate() {
    if (!this.userHasNominatePermission) {
      return false;
    }

    const nominationModes = this.playmodes ?? uniq(this.props.beatmapset.beatmaps.map((bm) => bm.mode));

    return nominationModes.some((mode) => this.userCanNominateMode(mode));
  }

  private get userHasNominatePermission() {
    const currentUser = core.currentUserOrFail;
    return currentUser.is_admin || (!this.userIsOwner && (currentUser.is_bng || currentUser.is_nat));
  }

  private get userIsOwner() {
    const userId = core.currentUserOrFail.id;

    return userId === this.props.beatmapset.user_id
      || this.props.beatmapset.beatmaps.some((beatmap) => beatmap.deleted_at == null && userId === beatmap.user_id);
  }

  private get userNominatableModes() {
    if (!this.mapCanBeNominated || !this.userHasNominatePermission) {
      return {};
    }

    return this.props.beatmapset.current_user_attributes.nomination_modes ?? {};
  }

  constructor(props: Props) {
    super(props);

    makeObservable(this);
  }

  componentWillUnmount() {
    this.xhr?.abort();
  }

  render() {
    if (core.currentUser == null) return null;

    return (
      <>
        {this.renderButton()}
        {this.visible && this.renderModal()}
      </>
    );
  }

  private hasFullNomination(mode: GameMode) {
    return this.nominationEvents.some((event) => {
      const user = event.user_id != null ? this.props.users[event.user_id] : null;

      return event.type === 'nominate' && event.comment != null
        ? event.comment.modes.includes(mode) && isUserFullNominator(user, mode)
        : isUserFullNominator(user);
    });
  }

  @action
  private readonly hideNominationModal = () => {
    this.visible = false;
  };

  @action
  private readonly nominate = () => {
    if (this.loading) return;

    this.loading = true;

    const url = route('beatmapsets.nominate', { beatmapset: this.props.beatmapset.id });
    const params = {
      data: {
        playmodes: this.playmodes != null && this.playmodes.length === 1 ? this.playmodes : this.selectedModes,
      },
      method: 'PUT',
    };

    this.xhr = $.ajax(url, params);
    this.xhr.done((response) => {
      $.publish('beatmapsetDiscussions:update', { beatmapset: response });
      this.hideNominationModal();
    })
      .fail(onError)
      .always(action(() => this.loading = false));
  };

  private nominationCountMet(mode: GameMode) {
    if (this.props.beatmapset.nominations.legacy_mode || this.props.beatmapset.nominations.required[mode] === 0) {
      return false;
    }

    const req = this.props.beatmapset.nominations.required[mode];
    const curr = this.props.beatmapset.nominations.current[mode] ?? 0;

    if (!req) {
      return false;
    }

    return curr >= req;
  }

  private renderButton() {
    if (!this.mapCanBeNominated || !this.userHasNominatePermission) {
      return;
    }

    let tooltipText: string | undefined;
    if (this.props.unresolvedIssues > 0) {
      tooltipText = trans('beatmaps.nominations.unresolved_issues');
    } else if (this.props.beatmapset.nominations.nominated) {
      tooltipText = trans('beatmaps.nominations.already_nominated');
    } else if (!this.userCanNominate) {
      tooltipText = trans('beatmaps.nominations.cannot_nominate');
    }

    return (
      <div title={tooltipText}>
        <BigButton
          disabled={tooltipText != null}
          icon='fas fa-thumbs-up'
          props={{
            onClick: this.showNominationModal,
          }}
          text={trans('beatmaps.nominations.nominate')}
        />
      </div>
    );
  }

  private renderModal() {
    const isHybrid = this.playmodes != null && this.playmodes.length > 1;

    return (
      <Modal onClose={this.hideNominationModal}>
        <div className={bn}>
          <div className={`${bn}__header`}>{trans('beatmapsets.nominate.dialog.header')}</div>
          {isHybrid ? this.renderModalContentHybrid() : this.renderModalContentNormal()}
          <div className={`${bn}__buttons`}>
            <BigButton
              disabled={(isHybrid && this.selectedModes.length < 1) || this.loading}
              icon='fas fa-thumbs-up'
              isBusy={this.loading}
              props={{
                onClick: this.nominate,
              }}
              text={trans('beatmaps.nominations.nominate')}
            />
            <BigButton
              disabled={this.loading}
              icon='fas fa-times'
              props={{
                onClick: this.hideNominationModal,
              }}
              text={trans('common.buttons.cancel')}
            />
          </div>
        </div>
      </Modal>
    );
  }

  private renderModalContentHybrid() {
    return (
      <>
        {trans('beatmapsets.nominate.dialog.which_modes')}
        <div ref={this.checkboxContainerRef} className={`${bn}__checkboxes`}>
          {this.playmodes?.map((mode: GameMode) => {
            const disabled = !this.userCanNominateMode(mode);
            return (
              <label
                key={mode}
                className={classWithModifiers('osu-switch-v2', { disabled })}
              >
                <input
                  checked={this.selectedModes.includes(mode)}
                  className='osu-switch-v2__input'
                  disabled={disabled}
                  name='nomination_modes'
                  onChange={this.updateCheckboxes}
                  type='checkbox'
                  value={mode}
                />
                <span className='osu-switch-v2__content' />
                <div
                  className={classWithModifiers(`${bn}__label`, { disabled })}
                >
                  <i className={`fal fa-extra-mode-${mode}`} /> {trans(`beatmaps.mode.${mode}`)}
                </div>
              </label>
            );
          })}
        </div>
        <div className={`${bn}__warn`}>
          {trans('beatmapsets.nominate.dialog.hybrid_warning')}
        </div>
      </>
    );
  }

  private renderModalContentNormal() {
    return trans('beatmapsets.nominate.dialog.confirmation');
  }

  private requiresFullNomination(mode: GameMode) {
    let req: number;
    let curr: number;

    if (this.props.beatmapset.nominations.legacy_mode) {
      req = this.props.beatmapset.nominations.required;
      curr = this.props.beatmapset.nominations.current;
    } else {
      req = this.props.beatmapset.nominations.required[mode] ?? 0;
      curr = this.props.beatmapset.nominations.current[mode] ?? 0;
    }

    return (curr === req - 1) && !this.hasFullNomination(mode);
  }

  @action
  private readonly showNominationModal = () => this.visible = true;

  @action
  private readonly updateCheckboxes = () => {
    const checkedBoxes = map(this.checkboxContainerRef.current?.querySelectorAll<HTMLInputElement>('input[type=checkbox]:checked'), (node) => node.value);
    this.selectedModes = checkedBoxes as GameMode[];
  };

  private userCanNominateMode(mode: GameMode) {
    if (!this.userHasNominatePermission || this.nominationCountMet(mode)) {
      return false;
    }

    const userNominatable = this.userNominatableModes;

    return userNominatable[mode] === 'full'
      || (userNominatable[mode] === 'limited' && !this.requiresFullNomination(mode));
  }
}
