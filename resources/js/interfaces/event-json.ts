// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import AchievementJson from './achievement-json';
import GameMode from './game-mode';
import Rank from './rank';

const eventTypes = [
  'achievement',
  'beatmapPlaycount',
  'beatmapsetApprove',
  'beatmapsetDelete',
  'beatmapsetRevive',
  'beatmapsetUpdate',
  'beatmapsetUpload',
  'rank',
  'rankLost',
  'usernameChange',
  'userSupportAgain',
  'userSupportFirst',
  'userSupportGift',
] as const;

type EventType = (typeof eventTypes)[number];

interface EventBase {
  created_at: string;
  id: number;
  parse_error?: boolean;
  type: EventType;
}

interface EventBeatmap {
  title: string;
  url: string;
}

interface EventBeatmapset {
  title: string;
  url: string;
}

interface EventUser {
  url: string;
  username: string;
}

interface AchievementEvent extends EventBase {
  achievement: AchievementJson;
  type: 'achievement';
  user: EventUser;
}

interface BeatmapPlaycountEvent extends EventBase {
  beatmap: EventBeatmap;
  count: number;
  type: 'beatmapPlaycount';
}

interface BeatmapsetApproveEvent extends EventBase {
  approval: string;
  beatmapset: EventBeatmapset;
  type: 'beatmapsetApprove';
  user: EventUser;
}

interface BeatmapsetDeleteEvent extends EventBase {
  beatmapset: EventBeatmapset;
  type: 'beatmapsetDelete';
}

interface BeatmapsetReviveEvent extends EventBase {
  beatmapset: EventBeatmapset;
  type: 'beatmapsetRevive';
  user: EventUser;
}

interface BeatmapsetUpdateEvent extends EventBase {
  beatmapset: EventBeatmapset;
  type: 'beatmapsetUpdate';
  user: EventUser;
}

interface BeatmapsetUploadEvent extends EventBase {
  beatmapset: EventBeatmapset;
  type: 'beatmapsetUpload';
  user: EventUser;
}

interface RankEvent extends EventBase {
  beatmap: EventBeatmap;
  mode: GameMode;
  rank: number;
  scoreRank: Rank;
  type: 'rank';
  user: EventUser;
}

interface RankLostEvent extends EventBase {
  beatmap: EventBeatmap;
  mode: GameMode;
  type: 'rankLost';
  user: EventUser;
}

interface UsernameChangeEvent extends EventBase {
  type: 'usernameChange';
  user: EventUser & {
    previousUsername: string;
  };
}

interface UserSupportAgainEvent extends EventBase {
  type: 'userSupportAgain';
  user: EventUser;
}

interface UserSupportFirstEvent extends EventBase {
  type: 'userSupportFirst';
  user: EventUser;
}

interface UserSupportGiftEvent extends EventBase {
  type: 'userSupportGift';
  user: EventUser;
}

type EventJson =
  AchievementEvent
  | BeatmapPlaycountEvent
  | BeatmapsetApproveEvent
  | BeatmapsetDeleteEvent
  | BeatmapsetReviveEvent
  | BeatmapsetUpdateEvent
  | BeatmapsetUploadEvent
  | RankEvent
  | RankLostEvent
  | UserSupportAgainEvent
  | UserSupportFirstEvent
  | UserSupportGiftEvent
  | UsernameChangeEvent;

export default EventJson;
