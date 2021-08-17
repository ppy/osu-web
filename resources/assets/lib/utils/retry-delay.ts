// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { random } from 'lodash';

const initialDelay = 7500;
const maxDelay = 1800000; // 30 minutes

export default class RetryDelay {
  private current = initialDelay;

  get() {
    const ret = this.current + random(5000, 20000);

    this.current = Math.min(this.current * 2, maxDelay);

    return ret;
  }

  reset() {
    this.current = initialDelay;
  }
}
