// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { trans, transChoice } from 'utils/lang';

export function durationToPrice(duration: number) {
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

export default class StoreSupporterTagPrice {
  constructor(private readonly _price: number) {
    // empty
  }

  get duration() {
    switch (true) {
      case this.price >= 26: return Math.floor(this.price / 26.0 * 12);
      case this.price >= 24: return 10;
      case this.price >= 22: return 9;
      case this.price >= 20: return 8;
      case this.price >= 16: return 6;
      case this.price >= 12: return 4;
      case this.price >= 8: return 2;
      case this.price >= 4: return 1;
      default: return 0;
    }
  }

  get price() {
    return this._price;
  }

  get discount() {
    if (this.duration >= 12) {
      return 46;
    }

    const raw = ((1 - (this.price / this.duration) / 4) * 100);
    return Math.max(0, Math.round(raw));
  }

  get discountText() {
    return trans('store.discount', { percent: this.discount });
  }

  get durationInYears() {
    const duration = this.duration;
    return {
      months: Math.floor(duration % 12),
      years: Math.floor(duration / 12),
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
}
