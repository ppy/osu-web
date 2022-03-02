// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.
/* eslint-disable max-classes-per-file */
import DispatcherAction from './dispatcher-action';

export default class FriendUpdated implements DispatcherAction {
  constructor(readonly userId: number) {}
}
