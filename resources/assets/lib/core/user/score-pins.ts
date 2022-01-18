// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ScoreJson from 'interfaces/score-json';
import { route } from 'laroute';
import { action, makeObservable, observable, runInAction } from 'mobx';
import OsuCore from 'osu-core';

export default class ScorePins {
  @observable pins = new Map<string, boolean>();

  constructor(private core: OsuCore) {
    makeObservable(this);
  }

  apiPin(score: ScoreJson, toPin: boolean): JQuery.jqXHR<void> {
    const pin = score.current_user_attributes.pin;
    if (pin == null) {
      throw new Error("can't pin score without current user attributes");
    }

    return $.ajax(route('score-pins.store'), {
      data: pin,
      dataType: 'json',
      method: toPin ? 'POST' : 'DELETE',
    // Use setTimeout to allow cleanup process to do their thing in `.done` callback
    // before announcing the score pin state has changed. Mainly relevant for
    // components which is gone after score is unpinned.
    }).done(() => window.setTimeout(action(() => {
      this.markPinned(score, toPin);
      $.publish('score:pin', [toPin, score]);
    })));
  }

  canBePinned(score: ScoreJson) {
    return this.core.currentUser != null && score.user_id === this.core.currentUser.id;
  }

  isPinned(score: ScoreJson) {
    const pin = score.current_user_attributes.pin;

    if (pin == null) {
      return false;
    }

    const mapKey = this.mapKey(pin);

    if (!this.pins.has(mapKey)) {
      runInAction(() => {
        this.pins.set(mapKey, pin.is_pinned);
      });
    }

    return this.pins.get(mapKey);
  }

  @action
  markPinned(score: ScoreJson, isPinned: boolean) {
    const pin = score.current_user_attributes.pin;
    if (pin == null) return;

    const mapKey = this.mapKey(pin);

    if (mapKey == null) {
      return null;
    }

    this.pins.set(mapKey, isPinned);
  }

  private mapKey(pin: Required<ScoreJson['current_user_attributes']>['pin']) {
    return `${pin.score_type}:${pin.score_id}`;
  }
}
