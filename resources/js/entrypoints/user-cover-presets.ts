// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserCoverPresetBatchActivate from 'user-cover-preset-batch-activate';

declare global {
  interface Window {
    userCoverPresetBatchActivate?: UserCoverPresetBatchActivate;
  }
}

window.userCoverPresetBatchActivate = new UserCoverPresetBatchActivate();
