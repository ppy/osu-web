// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import AchievementJson from 'interfaces/achievement-json';
import GameMode from 'interfaces/game-mode';
import Rank from 'interfaces/rank';
import * as React from 'react';
import { Modifiers } from 'utils/css';
import AchievementBadge from './achievement-badge';

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

export function isTypeOf<T extends keyof EventTypeMap>(value: Event, typeString: T): value is EventTypeMap[T] {
  return value.type === typeString;
}

function linkFn(className: string) {
  return function link(url: string, title: string) {
    return <a className={className} href={url}>{title}</a>;
  };
}

export function parseEvent(event: Event, classes: { badge: Modifiers; link: string }) {
  let badge: React.ReactNode = null;
  let mappings: Record<string, React.ReactNode> = {};
  const link = linkFn(classes.link);

  if (isTypeOf(event, 'achievement')) {
    badge = (
      <AchievementBadge
        achievement={event.achievement}
        modifiers={classes.badge}
        userAchievement={{
          achieved_at: event.created_at,
          achievement_id: event.achievement.id,
        }}
      />
    );

    mappings = {
      achievement: <strong>{event.achievement.name}</strong>,
      user: <strong><em>{link(event.user.url, event.user.username)}</em></strong>,
    };
  } else if (isTypeOf(event, 'beatmapPlaycount')) {
    mappings = {
      beatmap: link(event.beatmap.url, event.beatmap.title),
      count: event.count,
    };
  } else if (isTypeOf(event, 'beatmapsetApprove')) {
    mappings = {
      approval: osu.trans(`events.beatmapset_status.${event.approval}`),
      beatmapset: link(event.beatmapset.url, event.beatmapset.title),
      user: <strong>{link(event.user.url, event.user.username)}</strong>,
    };
  } else if (isTypeOf(event, 'beatmapsetDelete')) {
    mappings = {
      beatmapset: event.beatmapset.title,
    };
  } else if (isTypeOf(event, 'beatmapsetRevive')) {
    mappings = {
      beatmapset: link(event.beatmapset.url, event.beatmapset.title),
      user: <strong>{link(event.user.url, event.user.username)}</strong>,
    };
  } else if (isTypeOf(event, 'beatmapsetUpdate')) {
    mappings = {
      beatmapset: <em>{link(event.beatmapset.url, event.beatmapset.title)}</em>,
      user: <strong><em>{link(event.user.url, event.user.username)}</em></strong>,
    };
  } else if (isTypeOf(event, 'beatmapsetUpload')) {
    mappings = {
      beatmapset: link(event.beatmapset.url, event.beatmapset.title),
      user: <strong><em>{link(event.user.url, event.user.username)}</em></strong>,
    };
  } else if (isTypeOf(event, 'rank')) {
    badge = <div className={`score-rank score-rank--${event.scoreRank}`} />;

    mappings = {
      beatmap: <em>{link(event.beatmap.url, event.beatmap.title)}</em>,
      mode: osu.trans(`beatmaps.mode.${event.mode}`),
      rank: event.rank,
      user: <strong><em>{link(event.user.url, event.user.username)}</em></strong>,
    };
  } else if (isTypeOf(event, 'rankLost')) {
    mappings = {
      beatmap: <em>{link(event.beatmap.url, event.beatmap.title)}</em>,
      mode: osu.trans(`beatmaps.mode.${event.mode}`),
      user: <strong><em>{link(event.user.url, event.user.username)}</em></strong>,

    };
  } else if (isTypeOf(event, 'userSupportAgain')) {
    mappings = {
      user: <strong>{link(event.user.url, event.user.username)}</strong>,
    };
  } else if (isTypeOf(event, 'userSupportFirst')) {
    mappings = {
      user: <strong>{link(event.user.url, event.user.username)}</strong>,
    };
  } else if (isTypeOf(event, 'userSupportGift')) {
    mappings = {
      user: <strong>{link(event.user.url, event.user.username)}</strong>,
    };
  } else if (isTypeOf(event, 'usernameChange')) {
    mappings = {
      previousUsername: <strong>{event.user.previousUsername}</strong>,
      user: <strong><em>{link(event.user.url, event.user.username)}</em></strong>,
    };
  }

  return { badge, mappings };
}
