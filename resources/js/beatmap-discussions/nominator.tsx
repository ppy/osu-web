// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BigButton from 'components/big-button';
import Modal from 'components/modal';
import BeatmapsetDiscussionsStore from 'interfaces/beatmapset-discussions-store';
import BeatmapsetEventJson from 'interfaces/beatmapset-event-json';
import BeatmapsetWithDiscussionsJson from 'interfaces/beatmapset-with-discussions-json';
import Ruleset from 'interfaces/ruleset';
import { route } from 'laroute';
import { forEachRight, map, uniq } from 'lodash';
import { action, computed, makeObservable, observable, runInAction } from 'mobx';
import { observer } from 'mobx-react';
import core from 'osu-core-singleton';
import * as React from 'react';
import { onError } from 'utils/ajax';
import { isOwner } from 'utils/beatmap-helper';
import { isUserFullNominator } from 'utils/beatmapset-discussion-helper';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import DiscussionsState from './discussions-state';

interface Props {
  discussionsState: DiscussionsState;
  store: BeatmapsetDiscussionsStore;
}

const bn = 'nomination-dialog';

@observer
export class Nominator extends React.Component<Props> {
  private readonly checkboxContainerRef = React.createRef<HTMLDivElement>();
  @observable private loading = false;
  @observable private visible = false;
  private xhr?: JQuery.jqXHR<BeatmapsetWithDiscussionsJson>;

  private get beatmapset() {
    return this.props.discussionsState.beatmapset;
  }

  private get calculatedMainRuleset() {
    return this.props.discussionsState.calculatedMainRuleset;
  }

  private get currentHype() {
    return this.props.discussionsState.totalHypeCount;
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
      : this.props.discussionsState.rulesetsWithoutDeletedBeatmaps;
  }

  private get selectedModes() {
    return this.props.discussionsState.selectedNominatedRulesets;
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
      || this.beatmapset.beatmaps.some((beatmap) => beatmap.deleted_at == null && isOwner(userId, beatmap));
  }

  private get userNominatableModes() {
    if (!this.mapCanBeNominated || !this.userHasNominatePermission) {
      return {};
    }

    return this.beatmapset.current_user_attributes.nomination_modes ?? {};
  }

  private get nominatorsWillBeDifferent() {
    if (this.props.discussionsState.previousNominatorIds == null) return false;

    const previousNominatorIds = new Set(this.props.discussionsState.previousNominatorIds);
    return [core.currentUserOrFail.id, ...this.props.discussionsState.nominators.map((user) => user.id)]
      .some((userId) => !previousNominatorIds.has(userId));
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

  private hasFullNomination(mode: Ruleset) {
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
    this.unselectCheckboxes();
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

  private nominationCountMet(mode: Ruleset) {
    if (this.beatmapset.nominations.legacy_mode) {
      return false;
    }

    const requiredMeta = this.beatmapset.nominations.required_meta;
    const req = mode === this.calculatedMainRuleset
      ? requiredMeta.main_ruleset
      : requiredMeta.non_main_ruleset;

    return this.nominationCountWithSelections(mode) >= req && this.calculatedMainRuleset != null;
  }

  private nominationCountWithSelections(mode: Ruleset) {
    if (this.beatmapset.nominations.legacy_mode) {
      throw new Error();
    }

    return (this.beatmapset.nominations.current[mode] ?? 0)
      + (this.selectedModes.includes(mode) ? 1 : 0);
  }

  private renderButton() {
    if (!this.mapCanBeNominated || !this.userHasNominatePermission) {
      return;
    }

    let tooltipText: string | undefined;
    if (this.props.discussionsState.unresolvedDiscussionTotalCount > 0) {
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
          {this.nominatorsWillBeDifferent && (
            <div className={`${bn}__warn`}>
              {trans('beatmapsets.nominate.dialog.different_nominator_warning')}
            </div>
          )}
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
    const currentMode = this.calculatedMainRuleset ?? 'undefined';

    return (
      <>
        {trans('beatmapsets.nominate.dialog.which_modes')}
        <span>{trans('beatmapsets.nominate.dialog.current_main_ruleset', { ruleset: trans(`beatmaps.mode.${currentMode}`) })}</span>
        <div ref={this.checkboxContainerRef} className={`${bn}__checkboxes`}>
          {this.playmodes?.map((mode: Ruleset) => {
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

  private requiresFullNomination(mode: Ruleset) {
    let req: number;
    let curr: number;

    if (this.beatmapset.nominations.legacy_mode) {
      req = this.beatmapset.nominations.required;
      curr = this.beatmapset.nominations.current;
    } else {
      const mainRuleset = this.calculatedMainRuleset;
      req = mainRuleset == null || mode === this.calculatedMainRuleset
        ? this.beatmapset.nominations.required_meta.main_ruleset
        : this.beatmapset.nominations.required_meta.non_main_ruleset;
      curr = this.beatmapset.nominations.current[mode] ?? 0;
    }

    return (curr === req - 1) && !this.hasFullNomination(mode);
  }

  @action
  private readonly showNominationModal = () => this.visible = true;

  private unselectCheckboxes() {
    this.checkboxContainerRef.current?.querySelectorAll<HTMLInputElement>('input[type=checkbox]').forEach((checkbox) => {
      checkbox.checked = false;
    });

    this.updateCheckboxes();
  }

  @action
  private readonly updateCheckboxes = () => {
    const checkedBoxes = map(this.checkboxContainerRef.current?.querySelectorAll<HTMLInputElement>('input[type=checkbox]:checked'), (node) => node.value);
    this.props.discussionsState.selectedNominatedRulesets = checkedBoxes as Ruleset[];
  };

  private userCanNominateMode(mode: Ruleset) {
    // Always enable the selected one so it can be unselected.
    if (this.selectedModes.includes(mode)) return true;

    if (!this.userHasNominatePermission || this.nominationCountMet(mode)) {
      return false;
    }

    const userNominatable = this.userNominatableModes;

    return userNominatable[mode] === 'full'
      || (userNominatable[mode] === 'limited' && !this.requiresFullNomination(mode));
  }
}
