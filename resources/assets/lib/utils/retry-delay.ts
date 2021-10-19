// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { random } from 'lodash';

export default class RetryDelay {
  private current: number;

  constructor(private initialDelay = 7500, private maxDelay = 1800000 /* 30 minutes */) {
    this.current = initialDelay;
  }

  get() {
    const ret = this.current + random(5000, 20000);

    this.current = Math.min(this.current * 2, this.maxDelay);

    return ret;
  }

  reset() {
    this.current = this.initialDelay;
  }
}
