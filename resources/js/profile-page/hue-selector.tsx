// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import StringWithComponent from 'components/string-with-component';
import { route } from 'laroute';
import { action, autorun, makeObservable, observable } from 'mobx';
import { disposeOnUnmount, observer } from 'mobx-react';
import * as React from 'react';
import { classWithModifiers } from 'utils/css';
import { trans } from 'utils/lang';
import Controller from './controller';

function getDefaultHue() {
  // always cast and hope for the best
  return +window.getComputedStyle(window.newBody ?? document.body).getPropertyValue('--base-hue-default');
}

interface Props {
  controller: Controller;
}

@observer
export default class HueSelector extends React.Component<Props> {
  private readonly defaultHue: number;
  private resetHue = false;
  private readonly sliderRef = React.createRef<HTMLDivElement>();
  @observable private xhr?: JQuery.jqXHR<unknown>;

  private get canReset() {
    return this.selectedHue != null;
  }

  private get canSave() {
    return this.selectedHue !== this.userHue;
  }

  private get canSet() {
    return this.props.controller.state.user.is_supporter;
  }

  private get displayHue() {
    return this.selectedHue ?? this.defaultHue;
  }

  private get selectedHue() {
    return this.props.controller.selectedHue;
  }

  private get $slider() {
    return this.sliderRef.current == null
      ? undefined
      : $(this.sliderRef.current);
  }

  private get userHue() {
    return this.props.controller.state.user.profile_hue;
  }

  constructor(props: Props) {
    super(props);
    this.defaultHue = getDefaultHue();
    makeObservable(this);
  }

  componentDidMount() {
    this.initSlider();

    disposeOnUnmount(this, autorun(() => {
      this.resetHue = this.selectedHue == null;
      this.$slider?.slider({
        disabled: !this.canSet || this.xhr != null,
        value: this.displayHue,
      });
    }));
  }

  componentWillUnmount() {
    this.props.controller.setSelectedHue(this.userHue);
  }

  render() {
    return (
      <div className='profile-hue'>
        <h2 className='title title--profile-edit-popup'>
          {trans('users.show.edit.hue.title')}
        </h2>
        {this.renderSlider()}
        <div className='profile-hue__buttons'>
          <button
            className='btn-osu-big btn-osu-big--rounded'
            disabled={!this.canReset || this.xhr != null}
            onClick={this.onResetClick}
            type='button'
          >
            {trans('common.buttons.reset')}
          </button>
          <button
            className='btn-osu-big btn-osu-big--rounded'
            disabled={!this.canSave || this.xhr != null}
            onClick={this.onSaveClick}
            type='button'
          >
            {trans('common.buttons.save')}
          </button>
        </div>
        <div className='profile-hue__info'>
          {this.renderInfo()}
        </div>
      </div>
    );
  }

  @action
  private readonly apiSet = (value: number | null) => {
    if (this.xhr != null) return;

    this.xhr = this.props.controller.apiSetHue(value)
      .always(action(() => {
        this.xhr = undefined;
      }));
  };

  @action
  private initSlider() {
    this.$slider?.slider({
      animate: false,
      change: this.onSliderValueChange,
      max: 360,
      min: 1,
      range: 'min',
      slide: this.onSliderValueChange,
      step: 0.125,
      value: this.displayHue,
    });
  }

  @action
  private readonly onResetClick = () => {
    if (!this.canSet && !confirm(trans('users.show.edit.hue.reset_no_supporter'))) {

      return;
    }

    this.apiSet(null);
  };

  private readonly onSaveClick = () => {
    this.apiSet(this.selectedHue);
  };

  private readonly onSliderValueChange = (_event: unknown, ui: SliderUIParams) => {
    if (this.resetHue) {
      this.props.controller.setSelectedHue(null);
      this.resetHue = false;
    } else if (ui.value != null) {
      this.props.controller.setSelectedHue(Math.round(ui.value));
    }
  };

  private renderInfo() {
    return (
      <StringWithComponent
        mappings={{
          link: (
            <a
              href={route('store.products.show', { product: 'supporter-tag' })}
              rel='noreferrer'
              target='_blank'
            >
              {trans('users.show.edit.hue.supporter.link')}
            </a>
          ),
        }}
        pattern={trans('users.show.edit.hue.supporter._')}
      />
    );
  }

  private renderSlider() {
    return (
      <div
        ref={this.sliderRef}
        className='profile-hue-selector ui-slider ui-slider-horizontal'
      >
        <div className='profile-hue-selector__range' />

        <div
          className={`
            ${classWithModifiers('profile-hue-selector__handle', { default: this.selectedHue == null })}
            ui-slider-handle
          `}
          style={{ '--hue': this.displayHue } as React.CSSProperties}
        />
      </div>
    );
  }
}
