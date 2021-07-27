// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { random } from 'lodash';

const initialConnectionDelay = 7500;
const maxConnectionDelay = 1800000; // 30 minutes

export default class ConnectionDelay {
  private connectionDelay = initialConnectionDelay;

  get() {
    const ret = this.connectionDelay + random(5000, 20000);

    this.connectionDelay = Math.min(this.connectionDelay * 2, maxConnectionDelay);

    return ret;
  }

  reset() {
    this.connectionDelay = initialConnectionDelay;
  }
}
