// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { clamp } from 'lodash';

interface Params {
  bar: HTMLElement;
  endCallback?: Callback;
  initialEvent: JQuery.TouchStartEvent;
  moveCallback?: Callback;
}

type Callback = (slider: Slider) => void;

const getX = (e: JQuery.TouchMoveEvent | JQuery.TouchStartEvent) => e.clientX ?? e.touches[0].clientX;

let current: Slider | null = null;

export default class Slider {
  static readonly startEvents = 'mousedown touchstart';
  private active = true;

  private bar: HTMLElement;
  private endCallback?: Callback;
  private moveCallback?: Callback;
  private percentage = 0;

  private constructor(params: Params) {
    this.endCallback = params.endCallback;
    this.moveCallback = params.moveCallback;
    this.bar = params.bar;
    this.bar.dataset.audioDragging = '1';

    this.move(getX(params.initialEvent));
    $(document).on('mousemove touchmove', this.onMove);
    $(document).on('mouseup touchend', this.end);
    $(window).on('blur', this.end);
    $(document).on('turbolinks:before-cache', this.end);
  }

  static start(params: Params) {
    if (params.initialEvent.which !== 0 && params.initialEvent.which !== 1) {
      return;
    }

    if (current != null) {
      current.end();
    }

    current = new Slider(params);

    return current;
  }

  end = () => {
    this.active = false;

    $(document).off('mousemove touchmove', this.onMove);
    $(document).off('mouseup touchend', this.end);
    $(window).off('blur', this.end);
    $(document).off('turbolinks:before-cache', this.end);

    if (this.endCallback != null) {
      this.endCallback(this);
    }

    this.bar.style.removeProperty('--bar');
    this.bar.dataset.audioDragging = '0';

    current = null;
  };

  getPercentage = () => this.percentage;

  private move = (clientX: number) => {
    // this function is async (called by rAF) so make sure the object is still valid
    if (!this.active) return;

    const rect = this.bar.getBoundingClientRect();
    const x = clientX - rect.left;
    const width = rect.width;
    this.percentage = clamp(x / width, 0, 1);

    if (this.moveCallback != null) {
      this.moveCallback(this);
    }

    this.bar.style.setProperty('--bar', this.percentage.toString());
  };

  private onMove = (e: JQuery.TouchMoveEvent) => {
    const x = getX(e);

    requestAnimationFrame(() => {
      this.move(x);
    });
  };
}
