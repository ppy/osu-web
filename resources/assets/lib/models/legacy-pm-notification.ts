/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

import { observable } from 'mobx';
import Notification from './notification';

export default class LegacyPmNotification extends Notification {
  @observable details = { count: 0 };
  isRead = false;
  name = 'legacy_pm';
  objectId = -1;
  objectType = 'legacy_pm';

  constructor() {
    super(-1);
  }
}
