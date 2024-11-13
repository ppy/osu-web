// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { UserCard } from 'components/user-card';
import UserJson from 'interfaces/user-json';
import { debounce } from 'lodash';
import { action, autorun, computed, makeObservable, observable, runInAction } from 'mobx';
import { disposeOnUnmount, observer } from 'mobx-react';
import { userNotFoundJson } from 'models/user';
import core from 'osu-core-singleton';
import React from 'react';
import { onError } from 'utils/ajax';
import { classWithModifiers } from 'utils/css';
import { parseJsonNullable, storeJson } from 'utils/json';
import { trans, transChoice } from 'utils/lang';
import { toggleCart } from 'utils/store-cart';
import { currentUrlParams } from 'utils/turbolinks';
import { apiLookupUsers } from 'utils/user';

const jsonId = 'json-store-supporter-tag';

const maxValue = 52;
const minValue = 4;

interface Props {
  maxMessageLength: number;
}

interface SavedState {
  savedGiftMessage: string;
  sliderValue: number;
  username: string;
}

const monthPresets = [1, 2, 4, 6, 12, 18, 24] as const;

function durationToPrice(duration: number) {
  switch (true) {
    case duration >= 12: return Math.ceil(duration / 12.0 * 26);
    case duration === 10: return 24;
    case duration === 9: return 22;
    case duration === 8: return 20;
    case duration === 6: return 16;
    case duration === 4: return 12;
    case duration === 2: return 8;
    case duration === 1: return 4;
  }
}

@observer
export default class StoreSupporterTag extends React.Component<Props> {
  private readonly debouncedGetUser;
  private readonly giftMessageRef = React.createRef<HTMLTextAreaElement>();
  private readonly savedGiftMessage: string = '';
  private readonly sliderRef = React.createRef<HTMLDivElement>();
  @observable private sliderValue = minValue;
  @observable private user: UserJson | null;
  @observable private username = currentUrlParams().get('target') ?? '';
  private xhr: ReturnType<typeof apiLookupUsers> | null = null;

  @computed
  get cost() {
    return Math.floor(this.sliderValue);
  }

  get discount() {
    if (this.duration >= 12) {
      return 46;
    }

    const raw = ((1 - (this.cost / this.duration) / 4) * 100);
    return Math.max(0, Math.round(raw));
  }

  @computed
  get duration() {
    switch (true) {
      case this.cost >= 26: return Math.floor(this.cost / 26.0 * 12);
      case this.cost >= 24: return 10;
      case this.cost >= 22: return 9;
      case this.cost >= 20: return 8;
      case this.cost >= 16: return 6;
      case this.cost >= 12: return 4;
      case this.cost >= 8: return 2;
      case this.cost >= 4: return 1;
      default: return 0;
    }
  }

  get durationInYears() {
    return {
      months: Math.floor(this.duration % 12),
      years: Math.floor(this.duration / 12),
    };
  }

  get durationText() {
    // don't forget to update SupporterTag::getDurationText() in php
    const duration = this.durationInYears;
    const texts: string[] = [];

    if (duration.years > 0) {
      texts.push(transChoice('common.count.years', duration.years));
    }

    if (duration.months > 0) {
      texts.push(transChoice('common.count.months', duration.months));
    }

    return texts.join(', ');
  }

  get isGiftingSelf() {
    return this.user != null && this.user.id === core.currentUser?.id;
  }

  get isValidUser() {
    return this.user != null && Number.isFinite(this.user.id) && this.user.id > 0;
  }

  constructor(props: Props) {
    super(props);

    this.debouncedGetUser = debounce(this.getUser, 300);
    document.addEventListener('turbo:before-cache', this.handleBeforeCache);

    makeObservable(this);

    const json = parseJsonNullable<SavedState>(jsonId, true);
    if (json != null) {
      this.savedGiftMessage = json.savedGiftMessage;
      this.sliderValue = json.sliderValue;
      this.username = json.username;
    }

    if (this.username !== '') {
      this.user = null;
      this.debouncedGetUser(this.username);
    } else {
      this.user = core.currentUserOrFail;
    }

    disposeOnUnmount(
      this,
      autorun(() => {
        toggleCart(this.isValidUser);
        if (this.sliderRef.current != null) {
          $(this.sliderRef.current).slider({ disabled: !this.isValidUser });
        }
      }),
    );
  }

  componentDidMount() {
    this.initializeSlider();
  }

  componentWillUnmount() {
    document.removeEventListener('turbo:before-cache', this.handleBeforeCache);
    this.xhr?.abort();
  }

  render() {
    return (
      <div className='store-supporter-tag'>
        <input defaultValue={this.cost} id='supporter-tag-form-price' name='item[cost]' type='hidden' />
        <input defaultValue={this.user?.id} name='item[extra_data][target_id]' type='hidden' />
        <div className='store-supporter-tag__user-search'>
          <UserCard user={this.user} />
          <input
            autoComplete='off'
            className='store-supporter-tag__input'
            id='username'
            name='item[extra_data][username]'
            onChange={this.handleUsernameChange}
            placeholder={trans('store.supporter_tag.gift')}
            value={this.username}
          />
          <div data-visibility={!this.isValidUser || this.isGiftingSelf ? 'hidden' : 'visible'}>
            <textarea
              ref={this.giftMessageRef}
              className='store-supporter-tag__input store-supporter-tag__input--message'
              defaultValue={this.savedGiftMessage}
              maxLength={this.props.maxMessageLength}
              name='item[extra_data][message]'
              placeholder={trans('store.supporter_tag.gift_message', { length: this.props.maxMessageLength })}
              rows={3}
            />
          </div>
        </div>
        <div className='store-slider'>
          <div ref={this.sliderRef} className={`${classWithModifiers('ui-slider', { disabled: !this.isValidUser })} ui-slider-horizontal`}>
            <div className='ui-slider-handle'>
              <div className='store-slider__fake-callout'>
                <div className='store-slider__callout'>
                  <div className='store-slider__bigtext'>USD {this.cost}</div>
                  <div>{this.durationText}</div>
                  <div className='store-slider__subtext'>{trans('store.discount', { percent: this.discount })}</div>
                </div>
              </div>
            </div>
          </div>
          <div className='store-slider__presets'>
            <span className='store-slider__presets-blurb'>{trans('supporter_tag.months')}</span>
            {monthPresets.map((preset) => (
              // TODO: button
              <div
                key={preset}
                className={classWithModifiers('store-slider__preset', {
                  active: this.duration >= preset,
                  disabled: !this.isValidUser,
                })}
                data-months={preset}
                onClick={this.handlePresetClick}
              >
                {preset}
              </div>
            ))}
          </div>
        </div>
      </div>
    );
  }

  @action
  private readonly getUser = (username: string) => {
    this.xhr = apiLookupUsers([`@${username}`]);

    this.xhr
      .done((response) => runInAction(() => {
        this.user = response.users[0] ?? userNotFoundJson;
      }))
      .fail(onError)
      .always(() => {
        this.xhr = null;
      });
  };

  private readonly handleBeforeCache = () => {
    storeJson<SavedState>(jsonId, {
      savedGiftMessage: this.giftMessageRef.current?.value ?? '',
      sliderValue: this.sliderValue,
      username: this.username,
    });
  };

  private readonly handlePresetClick = (event: React.SyntheticEvent<HTMLElement>) => {
    const price = durationToPrice(+(event.currentTarget.dataset?.months ?? 0));
    if (price != null && this.sliderRef.current != null) {
      $(this.sliderRef.current).slider('value', price);
    }
  };

  @action
  private readonly handleSliderValueChanged = (_event: JQueryEventObject, ui: SliderUIParams) => {
    if (ui.value == null) return;
    this.sliderValue = ui.value;
  };

  @action
  private readonly handleUsernameChange = (event: React.ChangeEvent<HTMLInputElement>) => {
    this.username = event.currentTarget.value;

    this.debouncedGetUser.cancel();
    this.xhr?.abort();

    // reset to current user on empty
    if (this.username === '') {
      this.user = core.currentUserOrFail;
    } else {
      this.user = null;
      this.debouncedGetUser(this.username);
    }
  };

  private initializeSlider() {
    const slider = this.sliderRef.current;
    if (slider == null) return;

    return $(slider).slider({
      animate: true,
      change: this.handleSliderValueChanged,
      max: maxValue,
      min: minValue,
      range: 'min',
      slide: this.handleSliderValueChanged,
      step: 0.125,
      value: this.sliderValue,
    });
  }
}
