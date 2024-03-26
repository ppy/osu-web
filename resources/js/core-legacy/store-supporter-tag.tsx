// Copyright (c) ppy Pty Ltd <contact@.ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserJson from 'interfaces/user-json';
import { route } from 'laroute';
import { debounce } from 'lodash';
import { fadeToggle } from 'utils/fade';
import { toggleCart } from 'utils/store-cart';
import StoreSupporterTagPrice, { durationToPrice } from 'utils/store-supporter-tag-price';
import { present } from 'utils/string';

const maxValue = 52;
const minValue = 4;
const resolution = 8;

export default class StoreSupporterTag {
  private cost;
  private readonly debouncedGetUser;


  private readonly discountElement = this.el.querySelector<HTMLElement>('.js-discount');
  private readonly durationElement = this.el.querySelector<HTMLElement>('.js-duration');
  private readonly messageInput = this.el.querySelector<HTMLElement>('.js-store-supporter-tag-message');
  private readonly priceElement = this.el.querySelector<HTMLElement>('.js-price');
  private readonly reactElement = this.el.querySelector<HTMLElement>('.js-react--user-card-store');
  private searching = false;
  private readonly slider = this.el.querySelector<HTMLElement>('.js-slider');
  private readonly sliderPresets = this.el.querySelectorAll<HTMLElement>('.js-slider-preset');
  private readonly targetIdElement = this.el.querySelector<HTMLElement>('input[name="item[extra_data][target_id]"]');
  private user: UserJson;
  private readonly usernameInput = this.el.querySelector<HTMLElement>('.js-username-input');

  // Everything should be scoped under the root this.el
  constructor(private readonly el: HTMLElement) {
    if (window.currentUser.id == null) {
      throw new Error('StoreSupporterTag requires a logged in user.');
    }

    this.debouncedGetUser = debounce(this.getUser, 300);

    this.user = JSON.parse(this.reactElement?.dataset.user ?? '') as UserJson;
    if (this.user == null) {
      this.user = window.currentUser;
      if (this.reactElement != null) {
        this.reactElement.dataset.user = JSON.stringify(this.user);
      }
    }

    $(document).one('turbolinks:before-cache', () => {
      if (this.reactElement != null) {
        this.reactElement.dataset.user = JSON.stringify(this.user);
      }
    });

    this.cost = this.calculate(+this.initializeSlider().slider('value'));
    this.initializeSliderPresets();
    this.initializeUsernameInput();
    this.updateCostDisplay();

    // force initial values for consistency.
    this.updateSearchResult();

    if (this.usernameInput != null && this.usernameInput.value !== '') {
      $(this.usernameInput).trigger('input');
    }

  }

  static initialize() {
    for (const elem of document.getElementsByClassName('js-store-supporter-tag')) {
      if (elem instanceof HTMLElement) {
        new StoreSupporterTag(elem);
      }
    }
  }

  private calculate(position: number) {
    return new StoreSupporterTagPrice(Math.floor(position / resolution));
  }

  private readonly getUser = (username: string) => {
    if (!present(username)) { // reset to current user on empty
      this.user = window.currentUser;
      this.searching = false;
      this.updateSearchResult();
      return;
    }

    $.ajax({
      data: { username },
      dataType: 'json',
      type: 'POST',
      url: route('users.check-username-exists'),
    }).done((data) => {
      this.user = data;
    }).fail((xhr, status) => {
      $(this.usernameInput)
        .trigger('ajax:error', [xhr, status])
        .one('click', this.onInput);
    }).always(() => {
      this.searching = false;
      this.updateSearchResult();
    });
  };

  private initializeSlider() {
    // remove leftover from previous initialization
    $(this.slider).find('.ui-slider-range').remove();

    return $(this.slider).slider({
      range: 'min',
      value: this.slider.dataset.lastValue ?? this.sliderValue(minValue),
      min: this.sliderValue(minValue),
      max: this.sliderValue(maxValue),
      step: 1,
      animate: true,
      slide: this.onSliderValueChanged,
      change: this.onSliderValueChanged,
    });
  }

  private initializeSliderPresets() {
    $(this.sliderPresets).on('click', (event) => {
      const target = event.currentTarget;
      const price = durationToPrice(+(target.dataset?.months ?? 0));
      if (price != null) {
        $(this.slider).slider('value', this.sliderValue(price));
      }
    });
  }

  private initializeUsernameInput() {
    $(this.usernameInput).on('input', this.onInput);
  }

  private readonly onInput = (event) => {
    if (!this.searching) {
      this.searching = true;
      this.user = null;
      this.updateSearchResult();
    }
    this.debouncedGetUser(event.currentTarget.value);
  };

  private readonly onSliderValueChanged = (event, ui) => {
    this.slider.dataset.lastValue = ui.value;
    this.cost = this.calculate(ui.value);
    this.updateCostDisplay();
  };

  private sliderValue(price) {
    return price * resolution;
  }

  private updateCostDisplay() {
    this.el.querySelector<HTMLElement>('input[name="item[cost]"]').value = this.cost.price;
    this.priceElement.textContent = `USD ${this.cost.price}`;
    this.durationElement.textContent = this.cost.durationText;
    this.discountElement.textContent = this.cost.discountText;
    for (const elem of this.sliderPresets) {
      this.updateSliderPreset(elem, this.cost);
    }
  }

  private readonly updateSearchResult = () => {
    $.publish('store-supporter-tag:update-user', this.user);
    this.updateTargetId();
    this.updateUserInteraction();
  };

  private updateSliderPreset(elem: HTMLElement, cost: StoreSupporterTagPrice) {
    $(elem).toggleClass('js-slider-preset--active', cost.duration >= +elem.dataset.months);
  }

  private updateTargetId() {
    this.targetIdElement.value = this.user?.id;
  }

  private updateUserInteraction() {
    const enabled = this.user?.id != null && Number.isFinite(this.user.id) && this.user.id > 0;
    const messageInputVisible = enabled && this.user?.id !== window.currentUser.id;
    fadeToggle(this.messageInput, messageInputVisible);

    toggleCart(enabled);
    // TODO: need to elevate this element when switching over to new store design.
    $(this.el).toggleClass('js-store--disabled', !enabled);
    $('.js-slider').slider({ disabled: !enabled });
  }
}
