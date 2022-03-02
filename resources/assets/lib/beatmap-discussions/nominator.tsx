// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BigButton from 'components/big-button';
import { Modal } from 'components/modal';
import BeatmapsetEventJson, { isBeatmapsetNominationEvent } from 'interfaces/beatmapset-event-json';
import BeatmapsetJson from 'interfaces/beatmapset-json';
import GameMode from 'interfaces/game-mode';
import UserExtendedJson from 'interfaces/user-extended-json';
import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import * as _ from 'lodash';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';

interface Props {
  beatmapset: BeatmapsetJson;
  currentHype: number;
  currentUser: UserExtendedJson;
  unresolvedIssues: number;
  users: UserJson[];
}

interface State {
  loading: boolean;
  selectedModes: GameMode[];
  visible: boolean;
}

export class Nominator extends React.PureComponent<Props, State> {
  private bn = 'nomination-dialog';
  private checkboxContainerRef = React.createRef<HTMLDivElement>();
  private xhr?: JQuery.jqXHR;

  constructor(props: Props) {
    super(props);

    this.state = {
      loading: false,
      selectedModes: this.hybridMode() ? [] : [_.keys(this.props.beatmapset.nominations?.required)[0] as GameMode],
      visible: false,
    };
  }

  componentWillUnmount() {
    this.xhr?.abort();
  }

  hasFullNomination = (mode: GameMode) => {
    const eventUserIsFullNominator = (event: BeatmapsetEventJson, gameMode?: GameMode) => {
      if (!event.user_id) {
        return false;
      }

      return _.some(this.props.users[event.user_id].groups, (group) => {
        if (gameMode !== undefined) {
          return (group.identifier === 'bng' || group.identifier === 'nat') && group.playmodes?.includes(gameMode);
        } else {
          return (group.identifier === 'bng' || group.identifier === 'nat');
        }
      });
    };

    return _.some(this.nominationEvents(), (event) => {
      if (isBeatmapsetNominationEvent(event)) {
        return event.comment.modes.includes(mode) && eventUserIsFullNominator(event, mode);
      } else {
        return eventUserIsFullNominator(event);
      }
    });
  };

  hideNominationModal = () => {
    this.setState({
      loading: false,
      selectedModes: this.hybridMode() ? [] : this.state.selectedModes,
      visible: false,
    });
  };

  hybridMode = () => _.keys(this.props.beatmapset.nominations?.required).length > 1;

  legacyMode = () => this.props.beatmapset.nominations?.legacy_mode;

  mapCanBeNominated = () => {
    const requiredHype = this.props.beatmapset.hype?.required;

    return this.props.beatmapset.status === 'pending' && requiredHype && this.props.currentHype >= requiredHype;
  };

  nominate = () => {
    this.xhr?.abort();

    this.setState({loading: true}, () => {
      const url = route('beatmapsets.nominate', {beatmapset: this.props.beatmapset.id});
      const params = {
        data: {
          playmodes: this.state.selectedModes,
        },
        method: 'PUT',
      };

      this.xhr = $.ajax(url, params)
        .done((response) => {
          $.publish('beatmapsetDiscussions:update', {beatmapset: response});
        })
        .fail(osu.ajaxError)
        .always(this.hideNominationModal);
    });
  };

  nominationCountMet = (mode: GameMode) => {
    if (
      this.props.beatmapset.nominations?.legacy_mode ||
      !this.props.beatmapset.nominations?.required[mode]
    ) {
      return false;
    }

    const req = this.props.beatmapset.nominations.required[mode];
    const curr = this.props.beatmapset.nominations.current[mode] || 0;

    if (!req) {
      return false;
    }

    return curr >= req;
  };

  nominationEvents = () => {
    const nominations: BeatmapsetEventJson[] = [];

    _.forEachRight(this.props.beatmapset.events ?? [], (event) => {
      if (event.type === 'nomination_reset') {
        return false;
      }

      if (event.type === 'nominate') {
        nominations.push(event);
      }
    });

    return nominations;
  };

  render(): React.ReactNode {
    return (
      <>
        {this.renderButton()}
        {this.state.visible && this.renderModal()}
      </>
    );
  }

  renderButton = () => {
    if (!this.mapCanBeNominated() || !this.userHasNominatePermission()) {
      return;
    }

    const button = (disabled = false) => (
      <BigButton
        disabled={disabled}
        icon='fas fa-thumbs-up'
        props={{
          onClick: this.showNominationModal,
        }}
        text={osu.trans('beatmaps.nominations.nominate')}
      />
    );

    if (this.props.unresolvedIssues > 0) {
      // add a wrapper for the tooltip (because titles on a disabled button don't show)
      return (
        <div title={osu.trans('beatmaps.nominations.unresolved_issues')}>
          {button(true)}
        </div>
      );
    } else {
      return button(this.props.beatmapset.nominations?.nominated || !this.userCanNominate());
    }
  };

  renderModal = () => {
    const content = this.hybridMode() ? this.modalContentHybrid() : this.modalContentNormal();

    return (
      <Modal onClose={this.hideNominationModal} visible={this.state.visible}>
        <div className={this.bn}>
          <div className={`${this.bn}__header`}>{osu.trans('beatmapsets.nominate.dialog.header')}</div>
          {content}
          <div className={`${this.bn}__buttons`}>
            <BigButton
              disabled={(this.hybridMode() && this.state.selectedModes.length < 1) || this.state.loading}
              icon='fas fa-thumbs-up'
              isBusy={this.state.loading}
              props={{
                onClick: this.nominate,
              }}
              text={osu.trans('beatmaps.nominations.nominate')}
            />
            <BigButton
              disabled={this.state.loading}
              icon='fas fa-times'
              props={{
                onClick: this.hideNominationModal,
              }}
              text={osu.trans('common.buttons.cancel')}
            />
          </div>
        </div>
      </Modal>
    );
  };

  requiresFullNomination = (mode: GameMode) => {
    let req;
    let curr;

    if (this.props.beatmapset.nominations?.legacy_mode) {
      req = this.props.beatmapset.nominations?.required;
      curr = this.props.beatmapset.nominations?.current;
    } else {
      req = this.props.beatmapset.nominations?.required[mode];
      curr = this.props.beatmapset.nominations?.current[mode];
    }

    return (curr === (req ?? 0) - 1) && !this.hasFullNomination(mode);
  };

  showNominationModal = () => this.setState({visible: true});

  updateCheckboxes = () => {
    const checkedBoxes = _.map(this.checkboxContainerRef.current?.querySelectorAll<HTMLInputElement>('input[type=checkbox]:checked'), (node) => node.value);
    this.setState({selectedModes: checkedBoxes as GameMode[]});
  };

  userCanNominate = () => {
    if (!this.userHasNominatePermission()) {
      return false;
    }

    let nominationModes;
    if (this.legacyMode()) {
      nominationModes = _.uniq(this.props.beatmapset.beatmaps?.map((bm) => bm.mode));
    } else {
      nominationModes = Object.keys(this.props.beatmapset.nominations!.required) as GameMode[];
    }

    return _.some(nominationModes, (mode) => this.userCanNominateMode(mode));
  };

  userCanNominateMode = (mode: GameMode) => {
    if (!this.userHasNominatePermission() || this.nominationCountMet(mode)) {
      return false;
    }

    const userNominatable = this.userNominatableModes();

    return userNominatable[mode] === 'full' ||
      (userNominatable[mode] === 'limited' && !this.requiresFullNomination(mode));
  };

  userHasNominatePermission = () => this.props.currentUser.is_admin || (!this.userIsOwner() && (this.props.currentUser.is_bng || this.props.currentUser.is_nat));

  userIsOwner = () => {
    const userId = this.props.currentUser?.id;

    return (userId != null && (
      userId === this.props.beatmapset.user_id
      || (this.props.beatmapset.beatmaps ?? []).some((beatmap) => userId === beatmap.user_id)
    ));
  };

  userNominatableModes = () => {
    if (!this.mapCanBeNominated() || !this.userHasNominatePermission()) {
      return {};
    }

    return this.props.beatmapset.current_user_attributes?.nomination_modes ?? {};
  };

  private modalContentHybrid = () => {
    const playmodes = _.keys(this.props.beatmapset.nominations?.required);

    const renderPlaymodes = _.map(playmodes, (mode: GameMode) => {
      const disabled = !this.userCanNominateMode(mode);
      return (
        <label
          key={mode}
          className={classWithModifiers('osu-switch-v2', { disabled })}
        >
          <input
            checked={this.state.selectedModes.includes(mode)}
            className='osu-switch-v2__input'
            disabled={disabled}
            name='nomination_modes'
            onChange={this.updateCheckboxes}
            type='checkbox'
            value={mode}
          />
          <span className='osu-switch-v2__content'/>
          <div
            className={classWithModifiers(`${this.bn}__label`, { disabled })}
          >
            <i className={`fal fa-extra-mode-${mode}`}/> {osu.trans(`beatmaps.mode.${mode}`)}
          </div>
        </label>
      );
    });

    return (
      <>
        {osu.trans('beatmapsets.nominate.dialog.which_modes')}
        <div ref={this.checkboxContainerRef} className={`${this.bn}__checkboxes`}>
          {renderPlaymodes}
        </div>
        <div className={`${this.bn}__warn`}>
          {osu.trans('beatmapsets.nominate.dialog.hybrid_warning')}
        </div>
      </>
    );
  };

  private modalContentNormal() {
    return osu.trans('beatmapsets.nominate.dialog.confirmation');
  }
}
