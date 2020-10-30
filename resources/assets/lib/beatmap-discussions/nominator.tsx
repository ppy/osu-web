// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetJson, HybridNominationsInterface } from 'beatmapsets/beatmapset-json';
import { BigButton } from 'big-button';
import GameMode from 'interfaces/game-mode';
import UserJSONExtended from 'interfaces/user-json-extended';
import { route } from 'laroute';
import * as _ from 'lodash';
import { Modal } from 'modal';
import * as React from 'react';
import { modes as GameModes } from 'utils/beatmap-helper';

interface Props {
  beatmapset: BeatmapsetJson;
  currentHype: number;
  currentUser: UserJSONExtended;
  unresolvedIssues: number;
}

interface State {
  loading: boolean;
  selectedModes: GameMode[];
  visible: boolean;
}

type NominationMap = {
  [mode in GameMode]?: 'full' | 'limited' | undefined;
};

export class Nominator extends React.PureComponent<Props, State> {
  private bn = 'nomination-dialog';
  private checkboxContainerRef = React.createRef<HTMLDivElement>();
  private xhr?: JQuery.jqXHR;

  constructor(props: Props) {
    super(props);

    this.state = {
      loading: false,
      selectedModes: [],
      visible: false,
    };
  }

  componentWillUnmount() {
    this.xhr?.abort();
  }

  hideNominationModal = () => {
    this.setState({
      loading: false,
      selectedModes: [],
      visible: false,
    });
  }

  hybridMode = () => this.props.beatmapset.nominations?.hybrid_mode;

  hybridNominationsMet = (mode: GameMode) => {
    if (
      !this.props.beatmapset.nominations?.hybrid_mode ||
      !this.props.beatmapset.nominations.required[mode]
    ) {
      return false;
    }

    const req = this.props.beatmapset.nominations.required[mode];
    const curr = this.props.beatmapset.nominations.current[mode] || 0;

    if (!req) {
      return false;
    }

    return curr >= req;
  }

  mapCanBeNominated = () => {
    const requiredHype = this.props.beatmapset.hype?.required;

    return this.props.beatmapset.status === 'pending' && requiredHype && this.props.currentHype >= requiredHype;
  }

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
  }

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

    const button = (disabled = false) => {
      return (
        <BigButton
          text={osu.trans('beatmaps.nominations.nominate')}
          icon='fas fa-thumbs-up'
          props={{
            disabled,
            onClick: this.showNominationModal,
          }}
        />
      );
    };

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
  }

  renderModal = () => {
    const content = this.hybridMode() ? this.modalContentHybrid() : this.modalContentNormal();

    return (
      <Modal visible={this.state.visible} onClose={this.hideNominationModal}>
        <div className={`${this.bn}`}>
          <div className={`${this.bn}__header`}>{osu.trans('beatmapsets.nominate.dialog.header')}</div>
          {content}
          <div className={`${this.bn}__buttons`}>
            <BigButton
              text={osu.trans('beatmaps.nominations.nominate')}
              icon='fas fa-thumbs-up'
              isBusy={this.state.loading}
              props={{
                disabled: (this.hybridMode() && this.state.selectedModes.length < 1) || this.state.loading,
                onClick: this.nominate,
              }}
            />
            <BigButton
              text={osu.trans('common.buttons.cancel')}
              icon='fas fa-times'
              props={{
                disabled: this.state.loading,
                onClick: this.hideNominationModal,
              }}
            />
          </div>
        </div>
      </Modal>
    );
  }

  showNominationModal = () => this.setState({visible: true});

  updateCheckboxes = () => {
    const checkedBoxes = _.map(this.checkboxContainerRef.current?.querySelectorAll('input[type=checkbox]:checked'), (node: HTMLInputElement) => node.value);
    this.setState({selectedModes: checkedBoxes as GameMode[]});
  }

  userCanNominate = () => {
    if (!this.userHasNominatePermission()) {
      return false;
    }

    if (this.hybridMode()) {
      const userNominatable = this.userNominatableModes();

      return _.some(GameModes, (mode) => {
        if (
          (this.props.beatmapset.nominations as HybridNominationsInterface)?.required[mode] !== undefined &&
          userNominatable[mode] !== undefined &&
          !this.hybridNominationsMet(mode)
        ) {
          return true;
        }
      });
    }

    return true;
  }

  userHasNominatePermission = () => !this.userIsOwner() && (this.props.currentUser.is_admin || this.props.currentUser.is_bng || this.props.currentUser.is_nat);

  userIsOwner = () => this.props.currentUser?.id === this.props.beatmapset.user_id;

  userNominatableModes = () => {
    if (!this.mapCanBeNominated() || !this.userHasNominatePermission()) {
      return {};
    }

    const user = this.props.currentUser;
    const modes: NominationMap = {};

    if (user.is_nat) {
      user.groups?.find((group) => group.identifier === 'nat')?.playmodes?.forEach((mode) => {
        modes[mode] = 'full';
      });
    } else {
      if (user.is_full_bn) {
        user.groups?.find((group) => group.identifier === 'bng')?.playmodes?.forEach((mode) => {
          modes[mode] = 'full';
        });
      }
      if (user.is_limited_bn) {
        user.groups?.find((group) => group.identifier === 'bng_limited')?.playmodes?.forEach((mode) => {
          modes[mode] = 'limited';
        });
      }
    }

    return modes;
  }

  private modalContentHybrid = () => {
    const userNominatable = this.userNominatableModes();

    let renderPlaymodes;
    const playmodes = _.keys(this.props.beatmapset.nominations?.required);

    renderPlaymodes = _.map(playmodes, (mode: GameMode) => {
      const disabled = userNominatable[mode] === undefined || this.hybridNominationsMet(mode);
      return (
        <label
          className={osu.classWithModifiers('osu-switch-v2', disabled ? ['disabled'] : [])}
          key={mode}
        >
          <input
            className='osu-switch-v2__input'
            type='checkbox'
            name='nomination_modes'
            onChange={this.updateCheckboxes}
            value={mode}
            checked={this.state.selectedModes.includes(mode)}
            disabled={disabled}
          />
          <span className='osu-switch-v2__content'/>
          <div
            className={osu.classWithModifiers(`${this.bn}__label`, disabled ? ['disabled'] : [])}
          >
            <i className={`fal fa-extra-mode-${mode}`}/> {osu.trans(`beatmaps.mode.${mode}`)}
          </div>
        </label>
      );
    });

    return (
      <>
        {osu.trans('beatmapsets.nominate.dialog.which_modes')}
        <div className={`${this.bn}__checkboxes`} ref={this.checkboxContainerRef}>
          {renderPlaymodes}
        </div>
        <div className={`${this.bn}__warn`}>
          {osu.trans('beatmapsets.nominate.dialog.hybrid_warning')}
        </div>
      </>
    );
  }

  private modalContentNormal() {
    return osu.trans('beatmapsets.nominate.dialog.confirmation');
  }
}
