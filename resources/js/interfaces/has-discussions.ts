// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.


import DiscussionsState from 'beatmap-discussions/discussions-state';
import BeatmapsetDiscussionsShowStore from 'stores/beatmapset-discussions-show-store';
import BeatmapsetDiscussionsStore from './beatmapset-discussions-store';

export interface HasDiscussionsReadOnly {
  discussionsState?: never;
  store: BeatmapsetDiscussionsStore;
}

export interface HasDiscussionsEditable {
  discussionsState: DiscussionsState;
  store: BeatmapsetDiscussionsShowStore;
}
