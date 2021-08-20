// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserExtendedJson from 'interfaces/user-extended-json';

export type BeatmapsetSection = 'favouriteBeatmapsets' | 'rankedBeatmapsets' | 'lovedBeatmapsets' | 'pendingBeatmapsets' | 'graveyardBeatmapsets';

interface Pagination {
  hasMore: boolean;
  loading: boolean;
}

export default interface ExtraPageProps {
  name: string;
  pagination: Record<BeatmapsetSection | 'recentlyReceivedKudosu', Pagination>;
  user: UserExtendedJson;
  withEdit: boolean;
}
