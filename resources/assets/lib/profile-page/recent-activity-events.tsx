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

interface EventBase {
  created_at: string;
  id: number;
  parse_error?: boolean;
  type: EventType;
}

export type Event =
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

function link(url: string, title: string) {
  return <a href={url}>{title}</a>;
}

export function parseEvent(event: Event, classes: { badge: Modifiers }) {
  let badge: React.ReactNode = null;
  let mappings: Record<string, React.ReactNode>;

  if (event.parse_error) return { badge, mappings: null };

  switch (event.type) {
    case 'achievement':
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
      break;

    case 'beatmapPlaycount':
      mappings = {
        beatmap: link(event.beatmap.url, event.beatmap.title),
        count: event.count,
      };
      break;

    case 'beatmapsetApprove':
      mappings = {
        approval: osu.trans(`events.beatmapset_status.${event.approval}`),
        beatmapset: link(event.beatmapset.url, event.beatmapset.title),
        user: <strong>{link(event.user.url, event.user.username)}</strong>,
      };
      break;

    case 'beatmapsetDelete':
      mappings = {
        beatmapset: event.beatmapset.title,
      };
      break;

    case 'beatmapsetRevive':
      mappings = {
        beatmapset: link(event.beatmapset.url, event.beatmapset.title),
        user: <strong>{link(event.user.url, event.user.username)}</strong>,
      };
      break;

    case 'beatmapsetUpdate':
      mappings = {
        beatmapset: <em>{link(event.beatmapset.url, event.beatmapset.title)}</em>,
        user: <strong><em>{link(event.user.url, event.user.username)}</em></strong>,
      };
      break;

    case 'beatmapsetUpload':
      mappings = {
        beatmapset: link(event.beatmapset.url, event.beatmapset.title),
        user: <strong><em>{link(event.user.url, event.user.username)}</em></strong>,
      };
      break;

    case 'rank':
      badge = <div className={`score-rank score-rank--${event.scoreRank}`} />;

      mappings = {
        beatmap: <em>{link(event.beatmap.url, event.beatmap.title)}</em>,
        mode: osu.trans(`beatmaps.mode.${event.mode}`),
        rank: event.rank,
        user: <strong><em>{link(event.user.url, event.user.username)}</em></strong>,
      };
      break;

    case 'rankLost':
      mappings = {
        beatmap: <em>{link(event.beatmap.url, event.beatmap.title)}</em>,
        mode: osu.trans(`beatmaps.mode.${event.mode}`),
        user: <strong><em>{link(event.user.url, event.user.username)}</em></strong>,
      };
      break;

    case 'userSupportAgain':
      mappings = {
        user: <strong>{link(event.user.url, event.user.username)}</strong>,
      };
      break;

    case 'userSupportFirst':
      mappings = {
        user: <strong>{link(event.user.url, event.user.username)}</strong>,
      };
      break;

    case 'userSupportGift':
      mappings = {
        user: <strong>{link(event.user.url, event.user.username)}</strong>,
      };
      break;

    case 'usernameChange':
      mappings = {
        previousUsername: <strong>{event.user.previousUsername}</strong>,
        user: <strong><em>{link(event.user.url, event.user.username)}</em></strong>,
      };
      break;

    default: {
      const never: never = event;
      // This assumes unknown events fail parsing in the response and there aren't missing cases.
      return never;
    }
  }

  return { badge, mappings };
}
