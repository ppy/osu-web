// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { ScoreCurrentUserPinJson } from 'interfaces/score-json';
import SoloScoreJson from 'interfaces/solo-score-json';
import { route } from 'laroute';
import { action, makeObservable, observable, runInAction } from 'mobx';

export default class ScorePins {
  @observable pins = new Map<string, boolean>();

  constructor() {
    makeObservable(this);
  }

  apiPin(score: SoloScoreJson, toPin: boolean) {
    const pin = score.current_user_attributes.pin;
    if (pin == null) {
      throw new Error("can't pin score without current user attributes");
    }

    return $.ajax(route('score-pins.store'), {
      data: pin,
      dataType: 'json',
      method: toPin ? 'POST' : 'DELETE',
    }).done(action(() => {
      this.markPinned(score, toPin);
      $.publish('score:pin', [toPin, score]);
    })) as JQuery.jqXHR<void>;
  }

  canBePinned(score: SoloScoreJson) {
    return score.current_user_attributes.pin != null;
  }

  isPinned(score: SoloScoreJson) {
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
  markPinned(score: SoloScoreJson, isPinned: boolean) {
    const pin = score.current_user_attributes.pin;
    if (pin == null) return;

    const mapKey = this.mapKey(pin);

    if (mapKey == null) {
      return null;
    }

    this.pins.set(mapKey, isPinned);
  }

  private mapKey(pin: ScoreCurrentUserPinJson) {
    return `${pin.score_type}:${pin.score_id}`;
  }
}
