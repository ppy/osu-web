import AchievementJson from 'interfaces/achievement-json';
import GameMode from 'interfaces/game-mode';
import Rank from 'interfaces/rank';

export const eventTypes = [
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

export type EventType = (typeof eventTypes)[number];

export function isTypeOf<T extends keyof EventTypeMap>(value: Event, typeString: T): value is EventTypeMap[T] {
  return value.type === typeString;
}

export interface Event {
  created_at: string;
  id: number;
  parse_error?: boolean;
  type: EventType;
}

export interface EventTypeMap extends Record<EventType, Event> {
  achievement: AchievementEvent;
  beatmapPlaycount: BeatmapPlaycountEvent;
  beatmapsetApprove: BeatmapsetApproveEvent;
  beatmapsetDelete: BeatmapsetDeleteEvent;
  beatmapsetRevive: BeatmapsetReviveEvent;
  beatmapsetUpdate: BeatmapsetUpdateEvent;
  beatmapsetUpload: BeatmapsetUploadEvent;
  rank: RankEvent;
  rankLost: RankLostEvent;
  userSupportAgain: UserSupportAgainEvent;
  userSupportFirst: UserSupportFirstEvent;
  userSupportGift: UserSupportGiftEvent;
  usernameChange: UsernameChangeEvent;
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

export interface AchievementEvent extends Event {
  achievement: AchievementJson;
  type: 'achievement';
  user: EventUser;
}

export interface BeatmapPlaycountEvent extends Event {
  beatmap: EventBeatmap;
  count: number;
  type: 'beatmapPlaycount';
}

export interface BeatmapsetApproveEvent extends Event {
  approval: string;
  beatmapset: EventBeatmapset;
  type: 'beatmapsetApprove';
  user: EventUser;
}

export interface BeatmapsetDeleteEvent extends Event {
  beatmapset: EventBeatmapset;
  type: 'beatmapsetDelete';
}

export interface BeatmapsetReviveEvent extends Event {
  beatmapset: EventBeatmapset;
  type: 'beatmapsetRevive';
  user: EventUser;
}

export interface BeatmapsetUpdateEvent extends Event {
  beatmapset: EventBeatmapset;
  type: 'beatmapsetUpdate';
  user: EventUser;
}

export interface BeatmapsetUploadEvent extends Event {
  beatmapset: EventBeatmapset;
  type: 'beatmapsetUpload';
  user: EventUser;
}

export interface RankEvent extends Event {
  beatmap: EventBeatmap;
  mode: GameMode;
  rank: number;
  scoreRank: Rank;
  type: 'rank';
  user: EventUser;
}

export interface RankLostEvent extends Event {
  beatmap: EventBeatmap;
  mode: GameMode;
  type: 'rankLost';
  user: EventUser;
}

export interface UsernameChangeEvent extends Event {
  type: 'usernameChange';
  user: EventUser & {
    previousUsername: string;
  };
}

export interface UserSupportAgainEvent extends Event {
  type: 'userSupportAgain';
  user: EventUser;
}

export interface UserSupportFirstEvent extends Event {
  type: 'userSupportFirst';
  user: EventUser;
}

export interface UserSupportGiftEvent extends Event {
  type: 'userSupportGift';
  user: EventUser;
}
