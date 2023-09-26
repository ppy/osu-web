// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BigButton from 'components/big-button';
import Modal from 'components/modal';
import BeatmapsetDiscussions from 'interfaces/beatmapset-discussions';
import BeatmapsetEventJson from 'interfaces/beatmapset-event-json';
import BeatmapsetWithDiscussionsJson from 'interfaces/beatmapset-with-discussions-json';
import GameMode from 'interfaces/game-mode';
import { route } from 'laroute';
import { forEachRight, map, uniq } from 'lodash';
import { action, computed, makeObservable, observable, runInAction } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { onError } from 'utils/ajax';
import { isUserFullNominator } from 'utils/beatmapset-discussion-helper';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import DiscussionsState from './discussions-state';

interface Props {
  discussionsState: DiscussionsState;
  store: BeatmapsetDiscussions;
}

const bn = 'nomination-dialog';

@observer
export class Nominator extends React.Component<Props> {
  private readonly checkboxContainerRef = React.createRef<HTMLDivElement>();
  @observable private loading = false;
  @observable private selectedModes: GameMode[] = [];
  @observable private visible = false;
  private xhr?: JQuery.jqXHR<BeatmapsetWithDiscussionsJson>;

  private get beatmapset() {
    return this.props.discussionsState.beatmapset;
  }

  private get currentHype() {
    return this.props.discussionsState.totalHype;
  }

  private get mapCanBeNominated() {
    if (this.beatmapset.hype == null) {
      return false;
    }

    return this.beatmapset.status === 'pending' && this.currentHype >= this.beatmapset.hype.required;
  }

  private get nominationEvents() {
    const nominations: BeatmapsetEventJson[] = [];

    forEachRight(this.beatmapset.events, (event) => {
      if (event.type === 'nomination_reset' || event.type === 'disqualify') {
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
    return this.beatmapset.nominations.legacy_mode
      ? null
      : Object.keys(this.beatmapset.nominations.required) as GameMode[];
  }

  private get unresolvedIssues() {
    return this.props.discussionsState.unresolvedIssues;
  }

  private get users() {
    return this.props.store.users;
  }

  private get userCanNominate() {
    if (!this.userHasNominatePermission) {
      return false;
    }

    const nominationModes = this.playmodes ?? uniq(this.beatmapset.beatmaps.map((bm) => bm.mode));

    return nominationModes.some((mode) => this.userCanNominateMode(mode));
  }

  private get userHasNominatePermission() {
    const currentUser = core.currentUserOrFail;
    return currentUser.is_admin || (!this.userIsOwner && (currentUser.is_bng || currentUser.is_nat));
  }

  private get userIsOwner() {
    const userId = core.currentUserOrFail.id;

    return userId === this.beatmapset.user_id
      || this.beatmapset.beatmaps.some((beatmap) => beatmap.deleted_at == null && userId === beatmap.user_id);
  }

  private get userNominatableModes() {
    if (!this.mapCanBeNominated || !this.userHasNominatePermission) {
      return {};
    }

    return this.beatmapset.current_user_attributes.nomination_modes ?? {};
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
      const user = this.users.get(event.user_id);

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

    const url = route('beatmapsets.nominate', { beatmapset: this.beatmapset.id });
    const params = {
      data: {
        playmodes: this.playmodes != null && this.playmodes.length === 1 ? this.playmodes : this.selectedModes,
      },
      method: 'PUT',
    };

    this.xhr = $.ajax(url, params);
    this.xhr.done((beatmapset) => runInAction(() => {
      this.props.discussionsState.update({ beatmapset });
      this.hideNominationModal();
    }))
      .fail(onError)
      .always(action(() => this.loading = false));
  };

  private nominationCountMet(mode: GameMode) {
    if (this.beatmapset.nominations.legacy_mode || this.beatmapset.nominations.required[mode] === 0) {
      return false;
    }

    const req = this.beatmapset.nominations.required[mode];
    const curr = this.beatmapset.nominations.current[mode] ?? 0;

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
    if (this.unresolvedIssues > 0) {
      tooltipText = trans('beatmaps.nominations.unresolved_issues');
    } else if (this.beatmapset.nominations.nominated) {
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
              disabled={isHybrid && this.selectedModes.length < 1}
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

    if (this.beatmapset.nominations.legacy_mode) {
      req = this.beatmapset.nominations.required;
      curr = this.beatmapset.nominations.current;
    } else {
      req = this.beatmapset.nominations.required[mode] ?? 0;
      curr = this.beatmapset.nominations.current[mode] ?? 0;
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
